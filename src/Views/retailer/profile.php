<!-- Retailer Profile Settings -->
<div class="container-xl py-5">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border border-light p-4">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                    <div>
                        <h3 class="fw-bold mb-1 text-dark"><i class="fa-regular fa-id-card text-pink me-2"></i>Account & Shop Settings</h3>
                        <p class="text-muted mb-0">Update contact credentials and shop location addresses.</p>
                    </div>
                    <a href="/" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Go to Storefront</a>
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

                <form action="/profile" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
                    <div class="row g-3 mb-4">
                        <!-- Full Name -->
                        <div class="col-md-6">
                            <label for="name" class="form-label small fw-semibold text-muted text-uppercase">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required value="<?= htmlspecialchars($user['name']) ?>">
                        </div>
                        
                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label small fw-semibold text-muted text-uppercase">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars($user['email']) ?>">
                        </div>

                        <!-- Mobile (Disabled) -->
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted text-uppercase">Registered Mobile</label>
                            <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($user['mobile']) ?>" disabled>
                            <span class="text-muted" style="font-size: 0.75rem;"><i class="fa fa-lock me-1"></i>Mobile is verified and locked.</span>
                        </div>

                        <!-- Role (Disabled) -->
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-muted text-uppercase">Role Portal</label>
                            <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($user['role']) ?>" disabled>
                            <span class="text-muted" style="font-size: 0.75rem;"><i class="fa-solid fa-shield me-1"></i>Dynamic permissions active.</span>
                        </div>
                    </div>

                    <!-- Business profile cards -->
                    <div class="p-3 bg-light rounded border mb-4">
                        <h6 class="fw-bold mb-2 text-dark"><i class="fa fa-building me-1 text-pink"></i>B2B Verification Credentials</h6>
                        <div class="row g-2 text-secondary" style="font-size: 0.85rem;">
                            <div class="col-sm-6">
                                <strong>GST Identification:</strong> 09AAAAA1111A1Z1 (Verified)
                            </div>
                            <div class="col-sm-6">
                                <strong>Permanent Account Number (PAN):</strong> AAAAA1111A
                            </div>
                            <div class="col-sm-6">
                                <strong>Shop Registry Name:</strong> Heritage Boutique Retail Point
                            </div>
                            <div class="col-sm-6">
                                <strong>Available Trade Credit Limit:</strong> ₹1,00,000.00
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-meesho-pink px-4 py-2">Save Personal Settings</button>
                </form>
            </div>
        </div>
    </div>
</div>
