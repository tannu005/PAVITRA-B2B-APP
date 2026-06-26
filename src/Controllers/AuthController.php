<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Response;
use Core\Application;

class AuthController extends Controller {
    public function loginView(Request $request, Response $response) {
        if (Application::$app->getSessionUser()) {
            $response->redirect('/');
        }
        return $this->render('auth/login', ['title' => 'Sign In - Viraasat B2B']);
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
                    // Success log-in
                    $_SESSION['user_id'] = $user['id'];
                    
                    // Log activity
                    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
                    $stmtLog = $db->prepare("INSERT INTO activity_logs (user_id, activity, details, ip_address) VALUES (?, 'LOGIN', 'Successful login via web interface', ?)");
                    $stmtLog->execute([$user['id'], $ip]);

                    // Redirect based on role
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
            'title' => 'Sign In - Viraasat B2B',
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
            'title' => 'Create B2B Account - Viraasat B2B',
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
            // Check duplicates
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
                // Fetch the role name
                $stmtRole = $db->prepare("SELECT name FROM roles WHERE id = ?");
                $stmtRole->execute([$roleId]);
                $role = $stmtRole->fetch();

                if (!$role) {
                    throw new \Exception("Invalid registration role selected.");
                }

                // If registering as seller/delivery, we default to ACTIVE or PENDING based on flow. Let's make all active for demo
                $status = 'ACTIVE';

                $stmtInsert = $db->prepare("
                    INSERT INTO users (name, email, mobile, password_hash, role_id, status, is_verified_email, is_verified_mobile) 
                    VALUES (?, ?, ?, ?, ?, ?, 1, 1)
                ");
                $stmtInsert->execute([$name, $email, $mobile, $passwordHash, $roleId, $status]);
                $userId = $db->lastInsertId();

                // Create profile entries
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

                // Create wallet entry
                $stmtWallet = $db->prepare("INSERT INTO wallets (user_id, balance) VALUES (?, 0.00)");
                $stmtWallet->execute([$userId]);

                $db->commit();

                // Auto login
                $_SESSION['user_id'] = $userId;
                
                // Redirect
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
            'title' => 'Create B2B Account - Viraasat B2B',
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
        unset($_SESSION['user_id']);
        session_destroy();
        $response->redirect('/login');
    }
}
