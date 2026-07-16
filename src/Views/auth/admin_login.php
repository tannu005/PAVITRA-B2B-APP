<div class="container-xl py-5" style="min-height: 80vh; display: flex; align-items: center; justify-content: center; font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="p-4" style="width: 100%; max-width: 440px; background: transparent;">
        <div class="text-center mb-5 position-relative">
            <h2 class="mb-2" style="font-family: 'Rozha One', serif; font-size: 2.2rem; color: #1a1a1a; letter-spacing: -1px;">पवित्र</h2>
            <h4 class="fw-bold text-uppercase mb-1" style="letter-spacing: 0.15em; font-size: 1.15rem; color: #1a1a1a; font-family: 'Plus Jakarta Sans', sans-serif;">Admin Portal</h4>
            <p class="text-muted" style="font-size: 0.85rem;">Secure access for authorized personnel only</p>
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
        
        <form action="/admin/login" method="POST" id="admin-login-form">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
            
            <div class="mb-4">
                <label for="email" class="form-label fw-bold text-muted mb-1" style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase;">Admin Email</label>
                <input type="email" class="form-control pavitra-input" id="email" name="email" required placeholder="admin@company.com" value="<?= htmlspecialchars($email ?? '') ?>" style="border: none; border-bottom: 1px solid #ccc; border-radius: 0; padding: 8px 0; outline: none; background: transparent; font-size: 0.95rem; width: 100%;">
            </div>
            
            <div class="mb-5">
                <div class="position-relative">
                    <label for="password" class="form-label fw-bold text-muted mb-1" style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase;">Secure Password</label>
                    <input type="password" class="form-control pavitra-input" id="password" name="password" required placeholder="••••••••" style="border: none; border-bottom: 1px solid #ccc; border-radius: 0; padding: 8px 30px 8px 0; outline: none; background: transparent; font-size: 0.95rem; width: 100%;">
                    <span id="toggle-password" style="position: absolute; right: 0; bottom: 8px; cursor: pointer; color: #888; z-index: 5;"><i class="fa-solid fa-eye"></i></span>
                </div>
            </div>
            
            <button type="submit" class="btn w-100 py-3 text-uppercase fw-bold" style="background-color: #1a1a1a; color: white; border: none; border-radius: 0; letter-spacing: 0.15em; font-size: 0.85rem; transition: background-color 0.2s ease;">
                Secure Login
            </button>
        </form>
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
    });
</script>
