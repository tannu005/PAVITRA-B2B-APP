<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Response;
use Core\Application;
use App\Utils\EmailService;
use App\Utils\SmsService;

class AuthController extends Controller {
    protected function createWebSession(array $user, string $context = 'WEB_LOGIN'): void {
        $db = Application::$app->db;
        $token = bin2hex(random_bytes(32));
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
        $agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Web-Browser';

        $stmtSession = $db->prepare("INSERT INTO user_sessions (user_id, token, ip_address, user_agent) VALUES (?, ?, ?, ?)");
        $stmtSession->execute([$user['id'], $token, $ip, $agent]);

        $_SESSION['session_token'] = $token;
        $_SESSION['session_device'] = $agent;

        $stmtLog = $db->prepare("INSERT INTO activity_logs (user_id, activity, details, ip_address) VALUES (?, ?, ?, ?)");
        $stmtLog->execute([
            $user['id'],
            $context,
            $agent,
            $ip
        ]);
    }

    public function loginView(Request $request, Response $response) {
        if (Application::$app->getSessionUser()) {
            $response->redirect('/');
        }
        return $this->render('auth/login', ['title' => 'Sign In - Pavitra Designer']);
    }

    public function login(Request $request, Response $response) {
        $body = $request->getBody();
        $email = trim($body['email'] ?? '');
        $password = $body['password'] ?? '';
        
        $errors = [];
        if (empty($email)) $errors[] = 'Email address is required.';
        if (empty($password)) $errors[] = 'Password is required.';

        if (empty($errors)) {
            $db = Application::$app->db;
            $stmt = $db->prepare("SELECT u.*, r.name as role FROM users u JOIN roles r ON u.role_id = r.id WHERE u.email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password_hash'])) {
                if ($user['status'] !== 'ACTIVE') {
                    $errors[] = 'Your account has been blocked or is pending approval.';
                } else {
                    if (!empty($user['two_factor_secret'])) {
                        $_SESSION['mfa_pending_user_id'] = $user['id'];
                        $response->redirect('/login/mfa');
                        return;
                    }

                    session_regenerate_id(true);
                    $_SESSION['user_id'] = $user['id'];

                    $this->createWebSession($user, 'LOGIN');

                    if (in_array($user['role'], ['SUPER_ADMIN', 'ADMIN'])) {
                        $response->redirect('/admin');
                    } else if ($user['role'] === 'SELLER') {
                        $response->redirect('/seller');
                    } else if ($user['role'] === 'DELIVERY') {
                        $response->redirect('/delivery');
                    } else {
                        $response->redirect('/');
                    }
                    return;
                }
            } else {
                $errors[] = 'Invalid email address or password.';
            }
        }

        return $this->render('auth/login', [
            'title' => 'Sign In - Pavitra Designer',
            'errors' => $errors,
            'email' => $email
        ]);
    }

    public function registerView(Request $request, Response $response) {
        if (Application::$app->getSessionUser()) {
            $response->redirect('/');
        }
        
        $db = Application::$app->db;
        $stmt = $db->query("SELECT * FROM roles WHERE name IN ('SELLER', 'RETAILER', 'DELIVERY')");
        $roles = $stmt->fetchAll();

        return $this->render('auth/register', [
            'title' => 'Create B2B Account - Pavitra Designer',
            'roles' => $roles
        ]);
    }

    public function register(Request $request, Response $response) {
        $body = $request->getBody();
        $name = trim($body['name'] ?? '');
        $email = trim($body['email'] ?? '');
        $mobile = trim($body['mobile'] ?? '');
        $password = $body['password'] ?? '';
        $roleId = intval($body['role_id'] ?? 0);
        $shopCompanyName = trim($body['shop_company_name'] ?? '');

        $errors = [];
        if (empty($name)) $errors[] = 'Full name is required.';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email is required.';
        if (empty($mobile)) $errors[] = 'Mobile number is required.';
        if (strlen($password) < 6) $errors[] = 'Password must be at least 6 characters.';
        if ($roleId <= 0) $errors[] = 'Please select a profile role to register.';
        if (empty($shopCompanyName)) $errors[] = 'Shop or company name is required.';

        $db = Application::$app->db;

        if (empty($errors)) {
            $stmt = $db->prepare("SELECT id FROM users WHERE email = ? OR mobile = ?");
            $stmt->execute([$email, $mobile]);
            if ($stmt->fetch()) {
                $errors[] = 'An account with this email or mobile number already exists.';
            }
        }

        if (empty($errors)) {
            try {
                $db->beginTransaction();

                $passwordHash = password_hash($password, PASSWORD_BCRYPT);
                $stmtRole = $db->prepare("SELECT name FROM roles WHERE id = ?");
                $stmtRole->execute([$roleId]);
                $role = $stmtRole->fetch();

                if (!$role) {
                    throw new \Exception("Invalid registration role selected.");
                }

                $status = ($role['name'] === 'SELLER') ? 'PENDING' : 'ACTIVE';

                $stmtInsert = $db->prepare("
                    INSERT INTO users (name, email, mobile, password_hash, role_id, status, is_verified_email, is_verified_mobile) 
                    VALUES (?, ?, ?, ?, ?, ?, 1, 1)
                ");
                $stmtInsert->execute([$name, $email, $mobile, $passwordHash, $roleId, $status]);
                $userId = $db->lastInsertId();

                if ($role['name'] === 'SELLER') {
                    $stmtProfile = $db->prepare("INSERT INTO seller_profiles (user_id, company_name, commission_rate) VALUES (?, ?, 8.50)");
                    $stmtProfile->execute([$userId, $shopCompanyName]);
                } else if ($role['name'] === 'RETAILER') {
                    $stmtProfile = $db->prepare("INSERT INTO retailer_profiles (user_id, shop_name, credit_limit) VALUES (?, ?, 50000.00)");
                    $stmtProfile->execute([$userId, $shopCompanyName]);
                } else if ($role['name'] === 'DELIVERY') {
                    $stmtProfile = $db->prepare("INSERT INTO delivery_partner_profiles (user_id, vehicle_type, is_online) VALUES (?, 'Bike/Scooter', 1)");
                    $stmtProfile->execute([$userId]);
                }

                $stmtWallet = $db->prepare("INSERT INTO wallets (user_id, balance) VALUES (?, 0.00)");
                $stmtWallet->execute([$userId]);

                $stmtLog = $db->prepare("INSERT INTO activity_logs (user_id, activity, details, ip_address) VALUES (?, 'REGISTER', ?, ?)");
                $stmtLog->execute([$userId, 'Registered from web signup form', $_SERVER['REMOTE_ADDR'] ?? '']);

                $db->commit();

                EmailService::send($email, "Welcome to Pavitra B2B", "<h2>Welcome, $name!</h2><p>Your B2B account has been created successfully.</p>");
                SmsService::send($mobile, "Welcome to Pavitra B2B, $name! Your account is active.");

                $_SESSION['user_id'] = $userId;
                $this->createWebSession(['id' => $userId], 'REGISTER');
                
                if ($role['name'] === 'SELLER') {
                    $response->redirect('/seller');
                } else if ($role['name'] === 'DELIVERY') {
                    $response->redirect('/delivery');
                } else {
                    $response->redirect('/');
                }
                return;

            } catch (\Throwable $e) {
                $db->rollBack();
                $errors[] = 'Registration failed: ' . $e->getMessage();
            }
        }

        $stmtRoles = $db->query("SELECT * FROM roles WHERE name IN ('SELLER', 'RETAILER', 'DELIVERY')");
        $roles = $stmtRoles->fetchAll();

        return $this->render('auth/register', [
            'title' => 'Create B2B Account - Pavitra Designer',
            'errors' => $errors,
            'roles' => $roles,
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'shop_company_name' => $shopCompanyName,
            'role_id' => $roleId
        ]);
    }

    public function logout(Request $request, Response $response) {
        $db = Application::$app->db;
        if (!empty($_SESSION['session_token'])) {
            try {
                $stmt = $db->prepare("DELETE FROM user_sessions WHERE token = ?");
                $stmt->execute([$_SESSION['session_token']]);
            } catch (\Throwable $e) {
            }
        }

        if (!empty($_SESSION['user_id'])) {
            try {
                $stmt = $db->prepare("INSERT INTO activity_logs (user_id, activity, details, ip_address) VALUES (?, 'LOGOUT', 'User logged out', ?)");
                $stmt->execute([$_SESSION['user_id'], $_SERVER['REMOTE_ADDR'] ?? '']);
            } catch (\Throwable $e) {
            }
        }

        unset($_SESSION['user_id']);
        unset($_SESSION['session_token']);
        unset($_SESSION['session_device']);
        session_destroy();
        session_start();
        session_regenerate_id(true);
        $response->redirect('/login');
    }

    public function forgotPasswordView(Request $request, Response $response) {
        if (Application::$app->getSessionUser()) {
            $response->redirect('/');
        }
        return $this->render('auth/forgot_password', ['title' => 'Reset Password - Pavitra Designer']);
    }

    public function forgotPassword(Request $request, Response $response) {
        $body = $request->getBody();
        $email = trim($body['email'] ?? '');
        
        $errors = [];
        $success = null;

        if (empty($email)) {
            $errors[] = 'Email address is required.';
        } else {
            $db = Application::$app->db;
            $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user) {
                $token = bin2hex(random_bytes(32));
                $stmtUpdate = $db->prepare("UPDATE users SET reset_token = ?, reset_token_expires = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?");
                $stmtUpdate->execute([$token, $email]);

                $resetLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/reset-password?token=" . $token;
                
                $success = "A password reset link has been generated: <a href='" . $resetLink . "' class='alert-link fw-bold text-decoration-underline'>" . $resetLink . "</a>. Please click it to reset your password.";
            } else {
                $errors[] = 'No account with this email address was found.';
            }
        }

        return $this->render('auth/forgot_password', [
            'title' => 'Reset Password - Pavitra Designer',
            'errors' => $errors,
            'success' => $success,
            'email' => $email
        ]);
    }

    public function resetPasswordView(Request $request, Response $response) {
        $body = $request->getBody();
        $token = trim($body['token'] ?? '');

        if (empty($token)) {
            $response->redirect('/forgot-password');
            return;
        }

        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_token_expires > NOW()");
        $stmt->execute([$token]);
        $user = $stmt->fetch();

        if (!$user) {
            return $this->render('auth/forgot_password', [
                'title' => 'Reset Password - Pavitra Designer',
                'errors' => ['The password reset link is invalid or has expired. Please request a new one.']
            ]);
        }

        return $this->render('auth/forgot_password', [
            'title' => 'Update Password - Pavitra Designer',
            'token' => $token
        ]);
    }

    public function resetPassword(Request $request, Response $response) {
        $body = $request->getBody();
        $token = trim($body['token'] ?? '');
        $password = $body['password'] ?? '';
        $confirmPassword = $body['confirm_password'] ?? '';

        $errors = [];

        if (empty($token)) {
            $response->redirect('/forgot-password');
            return;
        }

        if (strlen($password) < 6) {
            $errors[] = 'Password must be at least 6 characters.';
        }
        if ($password !== $confirmPassword) {
            $errors[] = 'Passwords do not match.';
        }

        $db = Application::$app->db;
        
        $stmt = $db->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_token_expires > NOW()");
        $stmt->execute([$token]);
        $user = $stmt->fetch();

        if (!$user) {
            $errors[] = 'The reset link is invalid or has expired.';
        }

        if (empty($errors)) {
            try {
                $db->beginTransaction();
                
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);
                $stmtUpdate = $db->prepare("UPDATE users SET password_hash = ?, reset_token = NULL, reset_token_expires = NULL WHERE id = ?");
                $stmtUpdate->execute([$passwordHash, $user['id']]);

                $stmtLog = $db->prepare("INSERT INTO activity_logs (user_id, activity, details, ip_address) VALUES (?, 'PASSWORD_RESET', 'Password was successfully reset by token link', ?)");
                $stmtLog->execute([$user['id'], $_SERVER['REMOTE_ADDR'] ?? '']);

                $db->commit();

                return $this->render('auth/login', [
                    'title' => 'Sign In - Pavitra Designer',
                    'errors' => [],
                    'email' => '',
                    'success' => 'Your password has been successfully reset! You can now log in using your new credentials.'
                ]);

            } catch (\Throwable $e) {
                $db->rollBack();
                $errors[] = 'Failed to reset password: ' . $e->getMessage();
            }
        }

        return $this->render('auth/forgot_password', [
            'title' => 'Update Password - Pavitra Designer',
            'token' => $token,
            'errors' => $errors
        ]);
    }

    public function mfaView(Request $request, Response $response) {
        if (!isset($_SESSION['mfa_pending_user_id'])) {
            $response->redirect('/login');
            return;
        }
        return $this->render('auth/mfa', ['title' => '2FA Verification - Pavitra Designer']);
    }

    public function mfaVerify(Request $request, Response $response) {
        if (!isset($_SESSION['mfa_pending_user_id'])) {
            $response->redirect('/login');
            return;
        }

        $body = $request->getBody();
        $code = trim($body['code'] ?? '');
        $userId = $_SESSION['mfa_pending_user_id'];

        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT u.*, r.name as role FROM users u JOIN roles r ON u.role_id = r.id WHERE u.id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();

        $errors = [];
        if (empty($code)) {
            $errors[] = 'Please enter the 6-digit verification code.';
        } else if (!$user) {
            $errors[] = 'Invalid user session. Please log in again.';
        } else {
            if (\Core\Totp::verify($user['two_factor_secret'], $code)) {
                $_SESSION['user_id'] = $user['id'];
                unset($_SESSION['mfa_pending_user_id']);

                $this->createWebSession($user, 'LOGIN_MFA');

                if (in_array($user['role'], ['SUPER_ADMIN', 'ADMIN'])) {
                    $response->redirect('/admin');
                } else if ($user['role'] === 'SELLER') {
                    $response->redirect('/seller');
                } else if ($user['role'] === 'DELIVERY') {
                    $response->redirect('/delivery');
                } else {
                    $response->redirect('/');
                }
                return;
            } else {
                $errors[] = 'Invalid verification code. Please try again.';
            }
        }

        return $this->render('auth/mfa', [
            'title' => '2FA Verification - Pavitra Designer',
            'errors' => $errors
        ]);
    }

    public function toggle2fa(Request $request, Response $response) {
        $user = Application::$app->getSessionUser();
        if (!$user) {
            return $response->json(['error' => 'Unauthorized'], 401);
        }

        $body = $request->getBody();
        $enable = isset($body['enable']) ? (bool)$body['enable'] : false;

        $db = Application::$app->db;

        if ($enable) {
            $secret = \Core\Totp::generateSecret();
            $stmt = $db->prepare("UPDATE users SET two_factor_secret = ? WHERE id = ?");
            $stmt->execute([$secret, $user['id']]);

            $qrCodeUrl = \Core\Totp::getQrCodeUrl($user['email'], $secret);

            return $response->json([
                'success' => true,
                'secret' => $secret,
                'qr_code_url' => $qrCodeUrl
            ]);
        } else {
            $stmt = $db->prepare("UPDATE users SET two_factor_secret = NULL WHERE id = ?");
            $stmt->execute([$user['id']]);
            return $response->json(['success' => true]);
        }
    }
}


