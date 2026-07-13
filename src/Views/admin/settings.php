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
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
        <div class="row g-4">
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
                            <label for="favicon_url" class="form-label small fw-semibold text-muted text-uppercase">Favicon URL</label>
                            <input type="text" class="form-control" id="favicon_url" name="favicon_url" value="<?= htmlspecialchars($settings['favicon_url'] ?? '') ?>">
                        </div>
                        <div class="col-12">
                            <label for="cdn_prefix" class="form-label small fw-semibold text-muted text-uppercase">Cloudflare CDN Prefix URL</label>
                            <input type="text" class="form-control" id="cdn_prefix" name="cdn_prefix" value="<?= htmlspecialchars($settings['cdn_prefix'] ?? '') ?>" placeholder="e.g. https://cdn.Pavitra Designer.com">
                        </div>
                        <div class="col-12">
                            <label for="registered_office_address" class="form-label small fw-semibold text-muted text-uppercase">Registered Office Address</label>
                            <textarea class="form-control" id="registered_office_address" name="registered_office_address" rows="2" required><?= htmlspecialchars($settings['registered_office_address'] ?? ($settings['office_address'] ?? '')) ?></textarea>
                        </div>
                        <div class="col-12">
                            <label for="corporate_office_address" class="form-label small fw-semibold text-muted text-uppercase">Corporate Office Address</label>
                            <textarea class="form-control" id="corporate_office_address" name="corporate_office_address" rows="2"><?= htmlspecialchars($settings['corporate_office_address'] ?? '') ?></textarea>
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
                        <div class="col-md-6">
                            <label for="google_maps_api_key" class="form-label small fw-semibold text-muted text-uppercase">Google Maps API Key</label>
                            <input type="text" class="form-control" id="google_maps_api_key" name="google_maps_api_key" value="<?= htmlspecialchars($settings['google_maps_api_key'] ?? '') ?>">
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
                    <h5 class="fw-bold mb-3 text-pink border-bottom pb-2"><i class="fa-solid fa-share-nodes me-2"></i>Social & Delivery Integrations</h5>

                    <div class="row g-3">
                        <div class="col-12">
                            <label for="social_facebook" class="form-label small fw-semibold text-muted text-uppercase">Facebook Link</label>
                            <input type="text" class="form-control" id="social_facebook" name="social_facebook" value="<?= htmlspecialchars($settings['social_facebook'] ?? '') ?>">
                        </div>
                        <div class="col-12">
                            <label for="social_instagram" class="form-label small fw-semibold text-muted text-uppercase">Instagram Link</label>
                            <input type="text" class="form-control" id="social_instagram" name="social_instagram" value="<?= htmlspecialchars($settings['social_instagram'] ?? '') ?>">
                        </div>
                        <div class="col-12">
                            <label for="social_youtube" class="form-label small fw-semibold text-muted text-uppercase">YouTube Link</label>
                            <input type="text" class="form-control" id="social_youtube" name="social_youtube" value="<?= htmlspecialchars($settings['social_youtube'] ?? '') ?>">
                        </div>
                        <div class="col-12">
                            <label for="social_linkedin" class="form-label small fw-semibold text-muted text-uppercase">LinkedIn Link</label>
                            <input type="text" class="form-control" id="social_linkedin" name="social_linkedin" value="<?= htmlspecialchars($settings['social_linkedin'] ?? '') ?>">
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

                <div class="card shadow-sm border border-light p-4 bg-white mb-4">
                    <h5 class="fw-bold mb-3 text-pink border-bottom pb-2"><i class="fa-solid fa-shield-halved me-2"></i>Cloudflare & Messaging Keys</h5>

                    <div class="row g-3">
                        <div class="col-12">
                            <label for="cloudflare_account_id" class="form-label small fw-semibold text-muted text-uppercase">Cloudflare Account ID</label>
                            <input type="text" class="form-control" id="cloudflare_account_id" name="cloudflare_account_id" value="<?= htmlspecialchars($settings['cloudflare_account_id'] ?? '') ?>">
                        </div>
                        <div class="col-12">
                            <label for="cloudflare_api_token" class="form-label small fw-semibold text-muted text-uppercase">Cloudflare API Token</label>
                            <input type="password" class="form-control" id="cloudflare_api_token" name="cloudflare_api_token" value="<?= htmlspecialchars($settings['cloudflare_api_token'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="sms_gateway_key" class="form-label small fw-semibold text-muted text-uppercase">SMS Gateway Key</label>
                            <input type="text" class="form-control" id="sms_gateway_key" name="sms_gateway_key" value="<?= htmlspecialchars($settings['sms_gateway_key'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="sms_gateway_secret" class="form-label small fw-semibold text-muted text-uppercase">SMS Gateway Secret</label>
                            <input type="password" class="form-control" id="sms_gateway_secret" name="sms_gateway_secret" value="<?= htmlspecialchars($settings['sms_gateway_secret'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="whatsapp_api_key" class="form-label small fw-semibold text-muted text-uppercase">WhatsApp API Key</label>
                            <input type="text" class="form-control" id="whatsapp_api_key" name="whatsapp_api_key" value="<?= htmlspecialchars($settings['whatsapp_api_key'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="whatsapp_api_secret" class="form-label small fw-semibold text-muted text-uppercase">WhatsApp API Secret</label>
                            <input type="password" class="form-control" id="whatsapp_api_secret" name="whatsapp_api_secret" value="<?= htmlspecialchars($settings['whatsapp_api_secret'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="twilio_sid" class="form-label small fw-semibold text-muted text-uppercase">Twilio SID</label>
                            <input type="text" class="form-control" id="twilio_sid" name="twilio_sid" value="<?= htmlspecialchars($settings['twilio_sid'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="twilio_auth_token" class="form-label small fw-semibold text-muted text-uppercase">Twilio Auth Token</label>
                            <input type="password" class="form-control" id="twilio_auth_token" name="twilio_auth_token" value="<?= htmlspecialchars($settings['twilio_auth_token'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="twilio_phone_number" class="form-label small fw-semibold text-muted text-uppercase">Twilio Phone Number</label>
                            <input type="text" class="form-control" id="twilio_phone_number" name="twilio_phone_number" value="<?= htmlspecialchars($settings['twilio_phone_number'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="sendgrid_api_key" class="form-label small fw-semibold text-muted text-uppercase">SendGrid API Key</label>
                            <input type="password" class="form-control" id="sendgrid_api_key" name="sendgrid_api_key" value="<?= htmlspecialchars($settings['sendgrid_api_key'] ?? '') ?>">
                        </div>
                        <div class="col-12">
                            <label for="sendgrid_from_email" class="form-label small fw-semibold text-muted text-uppercase">SendGrid From Email</label>
                            <input type="email" class="form-control" id="sendgrid_from_email" name="sendgrid_from_email" value="<?= htmlspecialchars($settings['sendgrid_from_email'] ?? '') ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-pavitra-pink py-2 px-5 fw-bold"><i class="fa fa-save me-1"></i> Save Platform Configurations</button>
        </div>
    </form>
</div>

