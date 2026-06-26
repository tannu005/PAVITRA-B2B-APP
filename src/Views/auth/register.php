<div class="container-xl py-5" style="min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div class="card p-4 p-md-5" style="width: 100%; max-width: 520px; border-radius: 8px; border: 1px solid var(--meesho-border); background: white; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-1" style="color: var(--meesho-pink); letter-spacing: -0.5px;">Join Viraasat</h2>
            <p class="text-muted" style="font-size: 0.9rem;">Register your B2B wholesale profile</p>
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

        <form action="/register" method="POST" id="register-form">
            <!-- Full Name -->
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold text-muted" style="font-size: 0.75rem; text-transform: uppercase;">Full Name</label>
                <input type="text" class="form-control py-2" id="name" name="name" required placeholder="e.g. Ramesh Kumar" value="<?= htmlspecialchars($name ?? '') ?>">
            </div>

            <!-- Email & Mobile row -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label fw-semibold text-muted" style="font-size: 0.75rem; text-transform: uppercase;">Email Address</label>
                    <input type="email" class="form-control py-2" id="email" name="email" required placeholder="name@company.com" value="<?= htmlspecialchars($email ?? '') ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mobile" class="form-label fw-semibold text-muted" style="font-size: 0.75rem; text-transform: uppercase;">Mobile Number</label>
                    <input type="text" class="form-control py-2" id="mobile" name="mobile" required placeholder="e.g. +91 9999999999" value="<?= htmlspecialchars($mobile ?? '') ?>">
                </div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold text-muted" style="font-size: 0.75rem; text-transform: uppercase;">Password</label>
                <input type="password" class="form-control py-2" id="password" name="password" required placeholder="Minimum 6 characters">
            </div>

            <!-- Role Dropdown ("Join As") -->
            <div class="mb-3">
                <label for="role_id" class="form-label fw-semibold text-muted" style="font-size: 0.75rem; text-transform: uppercase;">Join Platform As</label>
                <select class="form-select py-2" id="role_id" name="role_id" required>
                    <option value="">Select Profile Role...</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['id'] ?>" <?= intval($role_id ?? 0) === intval($role['id']) ? 'selected' : '' ?>>
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
            <div class="mb-4">
                <label id="shop-label" for="shop_company_name" class="form-label fw-semibold text-muted" style="font-size: 0.75rem; text-transform: uppercase;">Shop / Company Name</label>
                <input type="text" class="form-control py-2" id="shop_company_name" name="shop_company_name" required placeholder="e.g. Sri Lakshmi Saree Loom" value="<?= htmlspecialchars($shop_company_name ?? '') ?>">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-meesho-pink w-100 py-2 fs-6 mb-3">
                Create Account
            </button>
        </form>

        <div class="text-center mt-2" style="font-size: 0.85rem;">
            <span class="text-muted">Already have an account?</span>
            <a href="/login" class="fw-semibold text-decoration-none ms-1" style="color: var(--meesho-pink);">Sign In Here</a>
        </div>
    </div>
</div>

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
    });
</script>
