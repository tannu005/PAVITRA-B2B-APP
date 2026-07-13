<div class="container-xl py-5" style="min-height: 80vh; display: flex; align-items: center; justify-content: center; font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="p-4" style="width: 100%; max-width: 440px; background: transparent;">
        <div class="text-center mb-5 position-relative">
            <a href="/login" class="btn btn-sm btn-link text-decoration-none text-muted position-absolute start-0 top-0 p-0" style="font-size: 0.8rem;"><i class="fa fa-arrow-left"></i> Login</a>
            <h2 class="mb-2" style="font-family: 'Rozha One', serif; font-size: 2.2rem; color: #1a1a1a; letter-spacing: -1px;">पवित्र</h2>
            <h4 class="fw-bold text-uppercase mb-1" style="letter-spacing: 0.15em; font-size: 1.15rem; color: #1a1a1a; font-family: 'Plus Jakarta Sans', sans-serif;">2FA Verification</h4>
            <p class="text-muted" style="font-size: 0.85rem;">Enter the 6-digit verification code from your Google Authenticator app.</p>
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

        <form action="/login/mfa" method="POST" id="mfa-form">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
            <div class="mb-5 text-center">
                <label for="code" class="form-label fw-bold text-muted mb-3 d-block" style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase;">Verification Code</label>
                <input type="text" class="form-control text-center code-input" id="code" name="code" required maxlength="6" autofocus placeholder="000000" autocomplete="one-time-code" style="border: none; border-bottom: 2px solid #ccc; border-radius: 0; padding: 10px 0; outline: none; background: transparent; font-size: 2rem; font-weight: bold; letter-spacing: 12px; width: 200px; margin: 0 auto; text-indent: 6px;">
            </div>

            <button type="submit" class="btn w-100 py-3 text-uppercase fw-bold" style="background-color: #1a1a1a; color: white; border: none; border-radius: 0; letter-spacing: 0.15em; font-size: 0.85rem; transition: background-color 0.2s ease;">
                Verify & Sign In
            </button>
        </form>

        <div class="text-center mt-4" style="font-size: 0.85rem;">
            <span class="text-muted">Trouble verifying?</span>
            <a href="/support" class="fw-bold text-decoration-none ms-1 text-dark border-bottom border-dark">Contact Support</a>
        </div>
    </div>
</div>

<style>
.code-input:focus {
    border-bottom-color: #1a1a1a !important;
    box-shadow: none !important;
}
.btn:hover {
    background-color: #333 !important;
}
</style>

