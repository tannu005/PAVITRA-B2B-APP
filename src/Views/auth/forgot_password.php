<div class="container-xl py-5" style="min-height: 80vh; display: flex; align-items: center; justify-content: center; font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="p-4" style="width: 100%; max-width: 440px; background: transparent;">
        <?php if (!empty($token)): ?>
            <div class="text-center mb-5 position-relative">
                <a href="/login" class="btn btn-sm btn-link text-decoration-none text-muted position-absolute start-0 top-0 p-0" style="font-size: 0.8rem;"><i class="fa fa-arrow-left"></i> Login</a>
                <h2 class="mb-2" style="font-family: 'Rozha One', serif; font-size: 2.2rem; color: #1a1a1a; letter-spacing: -1px;">पवित्र</h2>
                <h4 class="fw-bold text-uppercase mb-1" style="letter-spacing: 0.15em; font-size: 1.15rem; color: #1a1a1a;">Reset Password</h4>
                <p class="text-muted" style="font-size: 0.85rem;">Enter your new secure password below</p>
            </div>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger py-2 px-3 mb-4 rounded-0" style="font-size: 0.82rem; border-left: 3px solid #dc3545;">
                    <ul class="mb-0 ps-3">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form action="/reset-password" method="POST">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                <div class="mb-4 position-relative">
                    <label for="password" class="form-label fw-bold text-muted mb-1" style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase;">New Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control pavitra-input" id="password" name="password" required placeholder="Minimum 6 characters" style="border: none; border-bottom: 1px solid #ccc; border-radius: 0; padding: 8px 30px 8px 0; outline: none; background: transparent; font-size: 0.95rem; width: 100%;">
                        <span id="toggle-password" style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); cursor: pointer; color: #888; z-index: 5;"><i class="fa-solid fa-eye"></i></span>
                    </div>
                </div>
                <div class="mb-5 position-relative">
                    <label for="confirm_password" class="form-label fw-bold text-muted mb-1" style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase;">Confirm New Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control pavitra-input" id="confirm_password" name="confirm_password" required placeholder="••••••••" style="border: none; border-bottom: 1px solid #ccc; border-radius: 0; padding: 8px 30px 8px 0; outline: none; background: transparent; font-size: 0.95rem; width: 100%;">
                        <span id="toggle-confirm-password" style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); cursor: pointer; color: #888; z-index: 5;"><i class="fa-solid fa-eye"></i></span>
                    </div>
                </div>
                <button type="submit" class="btn w-100 py-3 text-uppercase fw-bold" style="background-color: #1a1a1a; color: white; border: none; border-radius: 0; letter-spacing: 0.15em; font-size: 0.85rem; transition: background-color 0.2s ease;">
                    Update Password
                </button>
            </form>
        <?php else: ?>
            <div class="text-center mb-5 position-relative">
                <a href="/login" class="btn btn-sm btn-link text-decoration-none text-muted position-absolute start-0 top-0 p-0" style="font-size: 0.8rem;"><i class="fa fa-arrow-left"></i> Login</a>
                <h2 class="mb-2" style="font-family: 'Rozha One', serif; font-size: 2.2rem; color: #1a1a1a; letter-spacing: -1px;">पवित्र</h2>
                <h4 class="fw-bold text-uppercase mb-1" style="letter-spacing: 0.15em; font-size: 1.15rem; color: #1a1a1a; font-family: 'Plus Jakarta Sans', sans-serif;">Reset Password</h4>
                <p class="text-muted" style="font-size: 0.85rem;">Enter your email to receive a password reset link</p>
            </div>
            <?php if (!empty($success)): ?>
                <div class="alert alert-success py-3 px-3 mb-4 rounded-0" style="font-size: 0.82rem; border-left: 3px solid #2ecc71; background-color: rgba(46, 204, 113, 0.05); color: #27ae60;">
                    <i class="fa-solid fa-circle-check me-2"></i> <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger py-2 px-3 mb-4 rounded-0" style="font-size: 0.82rem; border-left: 3px solid #dc3545;">
                    <ul class="mb-0 ps-3">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form action="/forgot-password" method="POST">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
                <div class="mb-5">
                    <label for="email" class="form-label fw-bold text-muted mb-1" style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase;">Email Address</label>
                    <input type="email" class="form-control pavitra-input" id="email" name="email" required placeholder="name@company.com" value="<?= htmlspecialchars($email ?? '') ?>" style="border: none; border-bottom: 1px solid #ccc; border-radius: 0; padding: 8px 0; outline: none; background: transparent; font-size: 0.95rem; width: 100%;">
                </div>
                <button type="submit" class="btn w-100 py-3 text-uppercase fw-bold" style="background-color: #1a1a1a; color: white; border: none; border-radius: 0; letter-spacing: 0.15em; font-size: 0.85rem; transition: background-color 0.2s ease;">
                    Send Reset Link
                </button>
            </form>
        <?php endif; ?>
    </div>
</div>
<style>
.pavitra-input:focus {
    border-bottom-color: #1a1a1a !important;
    box-shadow: none !important;
}
.btn:hover {
    background-color: #333 !important;
}
</style>
<script>
$(document).ready(function() {
    $('#toggle-password').on('click', function() {
        var input = $('#password');
        var icon = $(this).find('i');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
    $('#toggle-confirm-password').on('click', function() {
        var input = $('#confirm_password');
        var icon = $(this).find('i');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
});
</script>
