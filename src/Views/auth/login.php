<div class="container-xl py-5" style="min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div class="card p-4 p-md-5" style="width: 100%; max-width: 480px; border-radius: 8px; border: 1px solid var(--meesho-border); background: white; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-1" style="color: var(--meesho-pink); letter-spacing: -0.5px;">Viraasat Wholesale</h2>
            <p class="text-muted" style="font-size: 0.9rem;">Sign in to your B2B account</p>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger py-2 px-3 mb-3" style="font-size: 0.85rem;">
                <ul class="mb-0 ps-3">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="/login" method="POST" id="login-form">
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold text-muted" style="font-size: 0.75rem; text-transform: uppercase;">Email Address</label>
                <input type="email" class="form-control py-2" id="email" name="email" required placeholder="name@company.com" value="<?= htmlspecialchars($email ?? '') ?>">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="form-label fw-semibold text-muted" style="font-size: 0.75rem; text-transform: uppercase;">Password</label>
                <input type="password" class="form-control py-2" id="password" name="password" required placeholder="••••••••">
            </div>

            <!-- Sign In Button -->
            <button type="submit" class="btn btn-meesho-pink w-100 py-2 fs-6 mb-3">
                Sign In
            </button>
        </form>

        <div class="text-center mt-3" style="font-size: 0.85rem;">
            <span class="text-muted">Don't have an account?</span>
            <a href="/register" class="fw-semibold text-decoration-none ms-1" style="color: var(--meesho-pink);">Register Here</a>
        </div>
        
        <hr class="my-4 text-muted opacity-25">
        
        <div class="bg-light p-3 rounded" style="font-size: 0.75rem; color: #666; border: 1px solid #EAEAEA;">
            <strong>Demo Credentials:</strong><br>
            • Retailer/Buyer: <code>boutique@meeshob2b.com</code> / <code>password123</code><br>
            • Seller/Weaver: <code>weaver@meeshob2b.com</code> / <code>password123</code><br>
            • Super Admin: <code>admin@meeshob2b.com</code> / <code>password123</code><br>
            • Delivery Partner: <code>delivery@meeshob2b.com</code> / <code>password123</code>
        </div>
    </div>
</div>
