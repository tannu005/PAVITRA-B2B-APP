<!-- Super Admin Settings Configuration Panel -->
<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-sliders text-pink me-2"></i>Platform Control settings</h2>
            <p class="text-muted mb-0">Modify B2B corporate parameters, compliance identifiers, mail servers, and gateway credentials.</p>
        </div>
        <a href="/admin" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
    </div>

    <?php if (isset($_SESSION['settings_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show py-2 px-3 mb-4" role="alert" style="font-size: 0.9rem;">
            <i class="fa fa-circle-check me-2"></i><?= htmlspecialchars($_SESSION['settings_success']); unset($_SESSION['settings_success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 0.75rem 1rem;"></button>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger py-2 px-3 mb-4" style="font-size: 0.9rem;">
            <i class="fa-solid fa-triangle-exclamation me-2"></i><?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="/admin/settings" method="POST">
        <div class="row g-4">
            <!-- Left Side: Company Identity & Compliance -->
            <div class="col-lg-7">
                <div class="card shadow-sm border border-light p-4 bg-white mb-4">
                    <h5 class="fw-bold mb-3 text-pink border-bottom pb-2"><i class="fa-solid fa-building me-2"></i>Corporate Identity</h5>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="company_name" class="form-label small fw-semibold text-muted text-uppercase">Legal Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" value="<?= htmlspecialchars($settings['company_name'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="brand_name" class="form-label small fw-semibold text-muted text-uppercase">Trade Brand Name</label>
                            <input type="text" class="form-control" id="brand_name" name="brand_name" value="<?= htmlspecialchars($settings['brand_name'] ?? '') ?>" required>
                        </div>
                        <div class="col-12">
                            <label for="logo_url" class="form-label small fw-semibold text-muted text-uppercase">Corporate Logo URL</label>
                            <input type="text" class="form-control" id="logo_url" name="logo_url" value="<?= htmlspecialchars($settings['logo_url'] ?? '') ?>">
                        </div>
                        <div class="col-12">
                            <label for="office_address" class="form-label small fw-semibold text-muted text-uppercase">Registered Office Address</label>
                            <textarea class="form-control" id="office_address" name="office_address" rows="2" required><?= htmlspecialchars($settings['office_address'] ?? '') ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border border-light p-4 bg-white">
                    <h5 class="fw-bold mb-3 text-pink border-bottom pb-2"><i class="fa-solid fa-file-shield me-2"></i>Compliance & Registration</h5>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="gst_number" class="form-label small fw-semibold text-muted text-uppercase">GSTIN / Tax ID</label>
                            <input type="text" class="form-control" id="gst_number" name="gst_number" value="<?= htmlspecialchars($settings['gst_number'] ?? '') ?>" placeholder="e.g. 09AAAAA1111A1Z1">
                        </div>
                        <div class="col-md-4">
                            <label for="cin_number" class="form-label small fw-semibold text-muted text-uppercase">CIN Corporate Number</label>
                            <input type="text" class="form-control" id="cin_number" name="cin_number" value="<?= htmlspecialchars($settings['cin_number'] ?? '') ?>" placeholder="e.g. U17110UP2026PTC123456">
                        </div>
                        <div class="col-md-4">
                            <label for="pan_number" class="form-label small fw-semibold text-muted text-uppercase">PAN Income Tax ID</label>
                            <input type="text" class="form-control" id="pan_number" name="pan_number" value="<?= htmlspecialchars($settings['pan_number'] ?? '') ?>" placeholder="e.g. AAAAA1111A">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: API configurations, Gateways, Contact details -->
            <div class="col-lg-5">
                <div class="card shadow-sm border border-light p-4 bg-white mb-4">
                    <h5 class="fw-bold mb-3 text-pink border-bottom pb-2"><i class="fa-solid fa-envelope me-2"></i>Customer Support Channels</h5>
                    
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="support_email" class="form-label small fw-semibold text-muted text-uppercase">Support Mailbox</label>
                            <input type="email" class="form-control" id="support_email" name="support_email" value="<?= htmlspecialchars($settings['support_email'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="support_mobile" class="form-label small fw-semibold text-muted text-uppercase">Support Hotline</label>
                            <input type="text" class="form-control" id="support_mobile" name="support_mobile" value="<?= htmlspecialchars($settings['support_mobile'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="whatsapp_number" class="form-label small fw-semibold text-muted text-uppercase">WhatsApp API</label>
                            <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" value="<?= htmlspecialchars($settings['whatsapp_number'] ?? '') ?>">
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border border-light p-4 bg-white mb-4">
                    <h5 class="fw-bold mb-3 text-pink border-bottom pb-2"><i class="fa-solid fa-share-nodes me-2"></i>Gateway SMTP Server</h5>
                    
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label for="smtp_host" class="form-label small fw-semibold text-muted text-uppercase">SMTP Server Host</label>
                            <input type="text" class="form-control" id="smtp_host" name="smtp_host" value="<?= htmlspecialchars($settings['smtp_host'] ?? '') ?>" placeholder="smtp.mailtrap.io">
                        </div>
                        <div class="col-md-4">
                            <label for="smtp_port" class="form-label small fw-semibold text-muted text-uppercase">Port</label>
                            <input type="text" class="form-control" id="smtp_port" name="smtp_port" value="<?= htmlspecialchars($settings['smtp_port'] ?? '') ?>" placeholder="2525">
                        </div>
                        <div class="col-md-6">
                            <label for="smtp_user" class="form-label small fw-semibold text-muted text-uppercase">SMTP Username</label>
                            <input type="text" class="form-control" id="smtp_user" name="smtp_user" value="<?= htmlspecialchars($settings['smtp_user'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="smtp_password" class="form-label small fw-semibold text-muted text-uppercase">SMTP Password</label>
                            <input type="password" class="form-control" id="smtp_password" name="smtp_password" value="<?= htmlspecialchars($settings['smtp_password'] ?? '') ?>">
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border border-light p-4 bg-white mb-4">
                    <h5 class="fw-bold mb-3 text-pink border-bottom pb-2"><i class="fa-solid fa-credit-card me-2"></i>Razorpay Gateway API</h5>
                    
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="payment_gateway_key" class="form-label small fw-semibold text-muted text-uppercase">Razorpay Key ID</label>
                            <input type="text" class="form-control" id="payment_gateway_key" name="payment_gateway_key" value="<?= htmlspecialchars($settings['payment_gateway_key'] ?? '') ?>" placeholder="rzp_test_...">
                        </div>
                        <div class="col-12">
                            <label for="payment_gateway_secret" class="form-label small fw-semibold text-muted text-uppercase">Razorpay Secret Key</label>
                            <input type="password" class="form-control" id="payment_gateway_secret" name="payment_gateway_secret" value="<?= htmlspecialchars($settings['payment_gateway_secret'] ?? '') ?>" placeholder="••••••••••••••••">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-meesho-pink py-2 px-5 fw-bold"><i class="fa fa-save me-1"></i> Save Platform Configurations</button>
        </div>
    </form>
</div>
