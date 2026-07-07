<div class="container-xl py-5" style="min-height: 80vh; display: flex; align-items: center; justify-content: center; font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="p-4" style="width: 100%; max-width: 440px; background: transparent;">
        <div class="text-center mb-5 position-relative">
            <a href="/" class="btn btn-sm btn-link text-decoration-none text-muted position-absolute start-0 top-0 p-0" style="font-size: 0.8rem;"><i class="fa fa-arrow-left"></i> Home</a>
            <h2 class="mb-2" style="font-family: 'Rozha One', serif; font-size: 2.2rem; color: #1a1a1a; letter-spacing: -1px;">पवित्र</h2>
            <h4 class="fw-bold text-uppercase mb-1" style="letter-spacing: 0.15em; font-size: 1.15rem; color: #1a1a1a; font-family: 'Plus Jakarta Sans', sans-serif;">Join the Movement</h4>
            <p class="text-muted" style="font-size: 0.85rem;">Sign in to your wholesale profile</p>
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

        <form action="/login" method="POST" id="login-form">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
            <div class="mb-4">
                <label for="email" class="form-label fw-bold text-muted mb-1" style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase;">Email Address</label>
                <input type="email" class="form-control nisho-input" id="email" name="email" required placeholder="name@company.com" value="<?= htmlspecialchars($email ?? '') ?>" style="border: none; border-bottom: 1px solid #ccc; border-radius: 0; padding: 8px 0; outline: none; background: transparent; font-size: 0.95rem; width: 100%;">
            </div>

            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="password" class="form-label fw-bold text-muted mb-0" style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase;">Password</label>
                    <a href="/forgot-password" class="text-decoration-none text-muted fw-bold" style="font-size: 0.68rem; letter-spacing: 0.05em; text-transform: uppercase;">Forgot?</a>
                </div>
                <div class="position-relative">
                    <input type="password" class="form-control nisho-input" id="password" name="password" required placeholder="••••••••" style="border: none; border-bottom: 1px solid #ccc; border-radius: 0; padding: 8px 30px 8px 0; outline: none; background: transparent; font-size: 0.95rem; width: 100%;">
                    <span id="toggle-password" style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); cursor: pointer; color: #888; z-index: 5;"><i class="fa-solid fa-eye"></i></span>
                </div>
            </div>

            <button type="submit" class="btn w-100 py-3 text-uppercase fw-bold" style="background-color: #1a1a1a; color: white; border: none; border-radius: 0; letter-spacing: 0.15em; font-size: 0.85rem; transition: background-color 0.2s ease;">
                Sign In
            </button>
        </form>

        <div class="text-center mt-4" style="font-size: 0.85rem;">
            <span class="text-muted">Don't have an account?</span>
            <a href="/register" class="fw-bold text-decoration-none ms-1 text-dark border-bottom border-dark">Register Here</a>
        </div>
        
        <hr class="my-5 opacity-25">
        
        <div class="p-3 bg-light border-start border-dark" style="font-size: 0.75rem; color: #555; background-color: #f8f9fa;">
            <strong class="text-dark">Demo Credentials:</strong><br>
            • Retailer/Buyer: <code>boutique@meeshob2b.com</code> / <code>password123</code><br>
            • Seller/Weaver: <code>weaver@meeshob2b.com</code> / <code>password123</code><br>
            • Super Admin: <code>admin@meeshob2b.com</code> / <code>password123</code><br>
            • Delivery Partner: <code>delivery@meeshob2b.com</code> / <code>password123</code>
        </div>
    </div>
</div>

<style>
.nisho-input:focus {
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
});
</script>
