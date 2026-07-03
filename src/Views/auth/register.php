<div class="container-xl py-5" style="min-height: 80vh; display: flex; align-items: center; justify-content: center; font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="p-4" style="width: 100%; max-width: 540px; background: transparent;">
        <div class="text-center mb-5 position-relative">
            <a href="/" class="btn btn-sm btn-link text-decoration-none text-muted position-absolute start-0 top-0 p-0" style="font-size: 0.8rem;"><i class="fa fa-arrow-left"></i> Home</a>
            <h2 class="mb-2" style="font-family: 'Rozha One', serif; font-size: 2.2rem; color: #1a1a1a; letter-spacing: -1px;">पवित्र</h2>
            <h4 class="fw-bold text-uppercase mb-1" style="letter-spacing: 0.15em; font-size: 1.15rem; color: #1a1a1a; font-family: 'Plus Jakarta Sans', sans-serif;">Create Account</h4>
            <p class="text-muted" style="font-size: 0.85rem;">Register your wholesale profile</p>
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

        <form action="/register" method="POST" id="register-form">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
            <!-- Full Name -->
            <div class="mb-4">
                <label for="name" class="form-label fw-bold text-muted mb-1" style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase;">Full Name</label>
                <input type="text" class="form-control nisho-input" id="name" name="name" required placeholder="e.g. Ramesh Kumar" value="<?= htmlspecialchars($name ?? '') ?>" style="border: none; border-bottom: 1px solid #ccc; border-radius: 0; padding: 8px 0; outline: none; background: transparent; font-size: 0.95rem; width: 100%;">
            </div>

            <!-- Email & Mobile row -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="email" class="form-label fw-bold text-muted mb-1" style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase;">Email Address</label>
                    <input type="email" class="form-control nisho-input" id="email" name="email" required placeholder="name@company.com" value="<?= htmlspecialchars($email ?? '') ?>" style="border: none; border-bottom: 1px solid #ccc; border-radius: 0; padding: 8px 0; outline: none; background: transparent; font-size: 0.95rem; width: 100%;">
                </div>
                <div class="col-md-6 mb-4">
                    <label for="mobile" class="form-label fw-bold text-muted mb-1" style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase;">Mobile Number</label>
                    <input type="text" class="form-control nisho-input" id="mobile" name="mobile" required placeholder="e.g. +91 9999999999" value="<?= htmlspecialchars($mobile ?? '') ?>" style="border: none; border-bottom: 1px solid #ccc; border-radius: 0; padding: 8px 0; outline: none; background: transparent; font-size: 0.95rem; width: 100%;">
                </div>
            </div>

            <!-- Password -->
            <div class="mb-4 position-relative">
                <label for="password" class="form-label fw-bold text-muted mb-1" style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase;">Password</label>
                <div class="position-relative">
                    <input type="password" class="form-control nisho-input" id="password" name="password" required placeholder="Minimum 6 characters" style="border: none; border-bottom: 1px solid #ccc; border-radius: 0; padding: 8px 30px 8px 0; outline: none; background: transparent; font-size: 0.95rem; width: 100%;">
                    <span id="toggle-password" style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); cursor: pointer; color: #888; z-index: 5;"><i class="fa-solid fa-eye"></i></span>
                </div>
            </div>

            <!-- Role Dropdown ("Join As") -->
            <div class="mb-4">
                <label for="role_id" class="form-label fw-bold text-muted mb-1" style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase;">Join Platform As</label>
                <select class="form-select nisho-input" id="role_id" name="role_id" required style="border: none; border-bottom: 1px solid #ccc; border-radius: 0; padding: 8px 0; outline: none; background: transparent; font-size: 0.95rem; width: 100%;">
                    <option value="" class="text-dark">Select Profile Role...</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['id'] ?>" <?= intval($role_id ?? 0) === intval($role['id']) ? 'selected' : '' ?> class="text-dark">
                            <?php 
                                if ($role['name'] === 'RETAILER') echo 'Retailer / Boutique Owner (Buyer)';
                                elseif ($role['name'] === 'SELLER') echo 'Master Weaver / Wholesaler (Seller)';
                                elseif ($role['name'] === 'DELIVERY') echo 'Logistics Driver / Courier (Delivery Partner)';
                                else echo htmlspecialchars($role['name']);
                            ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Shop / Company Name -->
            <div class="mb-5">
                <label id="shop-label" for="shop_company_name" class="form-label fw-bold text-muted mb-1" style="font-size: 0.68rem; letter-spacing: 0.1em; text-transform: uppercase;">Shop / Company Name</label>
                <input type="text" class="form-control nisho-input" id="shop_company_name" name="shop_company_name" required placeholder="e.g. Sri Lakshmi Saree Loom" value="<?= htmlspecialchars($shop_company_name ?? '') ?>" style="border: none; border-bottom: 1px solid #ccc; border-radius: 0; padding: 8px 0; outline: none; background: transparent; font-size: 0.95rem; width: 100%;">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn w-100 py-3 text-uppercase fw-bold" style="background-color: #1a1a1a; color: white; border: none; border-radius: 0; letter-spacing: 0.15em; font-size: 0.85rem; transition: background-color 0.2s ease;">
                Create Account
            </button>
        </form>

        <div class="text-center mt-4" style="font-size: 0.85rem;">
            <span class="text-muted">Already have an account?</span>
            <a href="/login" class="fw-bold text-decoration-none ms-1 text-dark border-bottom border-dark">Sign In Here</a>
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
        // Dynamic label text based on selected role
        $('#role_id').on('change', function() {
            const roleText = $(this).find('option:selected').text();
            if (roleText.includes('Weaver')) {
                $('#shop-label').text('Weaving Guild / Company Name');
                $('#shop_company_name').attr('placeholder', 'e.g. Sri Lakshmi Handlooms Ltd.');
            } else if (roleText.includes('Driver')) {
                $('#shop-label').text('Logistics Agency / Driver Name');
                $('#shop_company_name').attr('placeholder', 'e.g. Speed Logistics or Self-Employed');
            } else {
                $('#shop-label').text('Shop / Company Name');
                $('#shop_company_name').attr('placeholder', 'e.g. Heritage Saree Boutique');
            }
        });

        // Show/Hide password toggle
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
