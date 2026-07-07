<div class="container-xl py-4" style="max-width: 600px; font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f5f5f6; min-height: 90vh; padding-bottom: 80px;">
    
    <div class="d-flex align-items-center justify-content-between mb-4 bg-white p-3 border-bottom sticky-top" style="z-index: 100; margin: -24px -15px 24px -15px;">
        <div class="d-flex align-items-center gap-3">
            <a href="/" class="text-dark fs-5" style="text-decoration: none;"><i class="fa-solid fa-arrow-left"></i></a>
            <h5 class="fw-bold mb-0 text-dark" style="font-size: 1.1rem; letter-spacing: -0.2px;">Profile</h5>
        </div>
    </div>

    <div class="p-4 mb-4 rounded-3 border-0 position-relative overflow-hidden bg-white" style="border: 1px solid var(--premium-border) !important; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 64px; height: 64px; background-color: var(--meesho-pink-light); color: var(--meesho-pink); font-weight: 700; font-size: 1.6rem; border: 2px solid var(--meesho-pink);">
                <?= strtoupper(substr($user['name'], 0, 1)) ?>
            </div>
            <div>
                <h4 class="fw-bold text-dark mb-1" style="font-family: var(--font-headings); font-size: 1.5rem;"><?= htmlspecialchars($user['name']) ?></h4>
                <p class="text-muted mb-0" style="font-size: 0.8rem;"><i class="fa-regular fa-envelope me-1"></i> <?= htmlspecialchars($user['email']) ?></p>
                <p class="text-muted mb-0" style="font-size: 0.8rem;"><i class="fa-solid fa-phone me-1"></i> <?= htmlspecialchars($user['mobile']) ?></p>
            </div>
        </div>
    </div>

    <div class="row g-2 mb-4">
        <div class="col-6">
            <a href="/orders" class="bg-white p-3 rounded-3 border d-flex align-items-center justify-content-between text-decoration-none" style="transition: transform 0.2s ease;">
                <div class="d-flex align-items-center gap-3">
                    <span class="fs-4" style="color: var(--meesho-pink);"><i class="fa-solid fa-box-archive"></i></span>
                    <div>
                        <h6 class="fw-bold text-dark mb-0" style="font-size: 0.82rem;">My Orders</h6>
                        <span class="text-muted" style="font-size: 0.65rem;">Track shipments</span>
                    </div>
                </div>
                <span style="color: #888; font-size: 0.8rem;"><i class="fa-solid fa-chevron-right"></i></span>
            </a>
        </div>
        <div class="col-6">
            <a href="/customization" class="bg-white p-3 rounded-3 border d-flex align-items-center justify-content-between text-decoration-none" style="transition: transform 0.2s ease;">
                <div class="d-flex align-items-center gap-3">
                    <span class="fs-4" style="color: var(--premium-gold);"><i class="fa-solid fa-wand-magic-sparkles"></i></span>
                    <div>
                        <h6 class="fw-bold text-dark mb-0" style="font-size: 0.82rem;">Custom Studio</h6>
                        <span class="text-muted" style="font-size: 0.65rem;">Embroidery orders</span>
                    </div>
                </div>
                <span style="color: #888; font-size: 0.8rem;"><i class="fa-solid fa-chevron-right"></i></span>
            </a>
        </div>
        <div class="col-6">
            <a href="/support" class="bg-white p-3 rounded-3 border d-flex align-items-center justify-content-between text-decoration-none" style="transition: transform 0.2s ease;">
                <div class="d-flex align-items-center gap-3">
                    <span class="fs-4" style="color: #3498db;"><i class="fa-solid fa-headset"></i></span>
                    <div>
                        <h6 class="fw-bold text-dark mb-0" style="font-size: 0.82rem;">Help Desk</h6>
                        <span class="text-muted" style="font-size: 0.65rem;">Weaver chat support</span>
                    </div>
                </div>
                <span style="color: #888; font-size: 0.8rem;"><i class="fa-solid fa-chevron-right"></i></span>
            </a>
        </div>
        <div class="col-6">
            <a href="/wallet" class="bg-white p-3 rounded-3 border d-flex align-items-center justify-content-between text-decoration-none" style="transition: transform 0.2s ease;">
                <div class="d-flex align-items-center gap-3">
                    <span class="fs-4" style="color: #2ecc71;"><i class="fa-solid fa-wallet"></i></span>
                    <div>
                        <h6 class="fw-bold text-dark mb-0" style="font-size: 0.82rem;">My Wallet</h6>
                        <span class="text-muted" style="font-size: 0.65rem;">View trade balance</span>
                    </div>
                </div>
                <span style="color: #888; font-size: 0.8rem;"><i class="fa-solid fa-chevron-right"></i></span>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3 border overflow-hidden mb-4">
        <div class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 border-bottom cursor-pointer" id="toggle-b2b-terms">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-building-circle-check" style="color: var(--meesho-pink);"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">B2B Credit & Trade Terms</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Verify GSTIN credentials and trade credit limit</p>
                </div>
            </div>
            <span id="b2b-terms-chevron" style="color: #888; font-size: 0.8rem;"><i class="fa-solid fa-chevron-down"></i></span>
        </div>

        <div id="b2b-terms-block" class="p-3 bg-light border-bottom text-muted" style="display: none; font-size: 0.82rem; line-height: 1.6;">
            <div class="mb-2"><strong>GST Identification Number (GSTIN):</strong> <code class="text-dark">09AAAAA1111A1Z1</code> (Verified)</div>
            <div class="mb-2"><strong>Tax registration type:</strong> Wholesaler / Retailer Composition Scheme</div>
            <div class="mb-2"><strong>Trade credit limit:</strong> <span class="text-dark fw-bold">₹1,00,000.00</span> (85,000.00 available)</div>
            <div><strong>Payment terms:</strong> Net-30 days billing terms on approved weaver loom invoices</div>
        </div>

        <a href="/customization" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 border-bottom" style="text-decoration: none;">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-scissors" style="color: var(--premium-gold);"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Loom Booking & Customization</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Book active handloom weaver machines for custom borders</p>
                </div>
            </div>
            <span style="color: #ccc; font-size: 0.75rem;"><i class="fa-solid fa-chevron-right"></i></span>
        </a>

        <div class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 border-bottom cursor-pointer" id="toggle-weaver-dir">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-map-location-dot" style="color: #16a085;"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Weaver Direct Clusters</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Explore geographical GI-tagged weaver source cities</p>
                </div>
            </div>
            <span id="weaver-dir-chevron" style="color: #888; font-size: 0.8rem;"><i class="fa-solid fa-chevron-down"></i></span>
        </div>

        <div id="weaver-dir-block" class="p-3 bg-light border-bottom text-muted" style="display: none; font-size: 0.82rem;">
            <ul class="mb-0 ps-3">
                <li class="mb-1"><strong>Banaras (UP):</strong> Brocade, Katan Silk, Georgette Handlooms</li>
                <li class="mb-1"><strong>Kanchipuram (TN):</strong> Heavy Zari Mulberry Silk Weavers</li>
                <li class="mb-1"><strong>Patan (GJ):</strong> Double-Ikat Patola Master Weavers</li>
                <li class="mb-1"><strong>Mysore (KA):</strong> Royal Crepe Silk weaving cooperatives</li>
                <li><strong>Santipur (WB):</strong> Muslin and Jamdani traditional hand-spin looms</li>
            </ul>
        </div>

        <div class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 border-bottom cursor-pointer" id="toggle-logistics">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-truck-moving" style="color: #34495e;"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Bulk Shipping & Logistics</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Estimate freight charges and view logistic partners</p>
                </div>
            </div>
            <span id="logistics-chevron" style="color: #888; font-size: 0.8rem;"><i class="fa-solid fa-chevron-down"></i></span>
        </div>

        <div id="logistics-block" class="p-3 bg-light border-bottom text-muted" style="display: none; font-size: 0.82rem;">
            <div class="mb-1"><strong>Weaver-to-Store Logistics:</strong> BlueDart Heavy & Gati Transport</div>
            <div class="mb-1"><strong>Estimated Transport Time:</strong> 3-5 business days weaver direct</div>
            <div><strong>Bulk Rates:</strong> Free transport logistics for orders exceeding 25 pieces</div>
        </div>

        <a href="/support/create" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 border-bottom" style="text-decoration: none;">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-palette" style="color: #e74c3c;"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Request Yarn & Swatches</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Submit thread sample queries to weavers before bulk ordering</p>
                </div>
            </div>
            <span style="color: #ccc; font-size: 0.75rem;"><i class="fa-solid fa-chevron-right"></i></span>
        </a>

        <div class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 border-bottom cursor-pointer" id="toggle-account-settings" style="text-decoration: none;">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-user-gear" style="color: #7f8c8d;"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Manage Account Settings</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Manage your login contact name and email settings</p>
                </div>
            </div>
            <span id="settings-chevron" style="color: #888; font-size: 0.8rem;"><i class="fa-solid fa-chevron-down"></i></span>
        </div>

        <div id="account-settings-form-block" class="p-4 bg-light border-bottom" style="display: none;">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger py-2 px-3 mb-3" style="font-size: 0.8rem;">
                    <ul class="mb-0 ps-3">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="/profile" method="POST">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
                <div class="mb-3">
                    <label for="name" class="form-label small fw-bold text-muted text-uppercase" style="font-size: 0.65rem;">Full Name</label>
                    <input type="text" class="form-control rounded-0" id="name" name="name" required value="<?= htmlspecialchars($user['name']) ?>" style="font-size: 0.9rem;">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label small fw-bold text-muted text-uppercase" style="font-size: 0.65rem;">Email Address</label>
                    <input type="email" class="form-control rounded-0" id="email" name="email" required value="<?= htmlspecialchars($user['email']) ?>" style="font-size: 0.9rem;">
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label small fw-bold text-muted text-uppercase" style="font-size: 0.65rem;">Mobile</label>
                        <input type="text" class="form-control rounded-0 bg-light-subtle text-muted" value="<?= htmlspecialchars($user['mobile']) ?>" disabled style="font-size: 0.85rem;">
                    </div>
                    <div class="col-6">
                        <label class="form-label small fw-bold text-muted text-uppercase" style="font-size: 0.65rem;">Role</label>
                        <input type="text" class="form-control rounded-0 bg-light-subtle text-muted" value="<?= htmlspecialchars($user['role']) ?>" disabled style="font-size: 0.85rem;">
                    </div>
                </div>
                <button type="submit" class="btn text-white text-uppercase fw-bold rounded-0" style="background-color: var(--meesho-pink); font-size: 0.78rem; letter-spacing: 0.05em; padding: 8px 16px;">Save Changes</button>
            </form>
        </div>

        <a href="/wishlist" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 border-bottom" style="text-decoration: none;">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-heart" style="color: var(--meesho-pink);"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Wishlist</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Your saved saree designs</p>
                </div>
            </div>
            <span style="color: #ccc; font-size: 0.75rem;"><i class="fa-solid fa-chevron-right"></i></span>
        </a>

        <div class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 border-bottom" style="text-decoration: none;">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-gears" style="color: #7f8c8d;"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Settings</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Manage weaver notification channels & keys</p>
                </div>
            </div>
            <span style="color: #ccc; font-size: 0.75rem;"><i class="fa-solid fa-chevron-right"></i></span>
        </div>

        <div class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 border-bottom cursor-pointer" id="toggle-2fa">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-shield-halved" style="color: #e74c3c;"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Two-Factor Authentication (2FA)</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Protect your wholesale account with TOTP authenticator</p>
                </div>
            </div>
            <span id="twofa-chevron" style="color: #888; font-size: 0.8rem;"><i class="fa-solid fa-chevron-down"></i></span>
        </div>

        <div id="twofa-block" class="p-4 bg-light border-bottom" style="display: none; font-size: 0.82rem;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <strong>Status:</strong> 
                    <span id="twofa-status-badge" class="badge <?= !empty($user['two_factor_secret']) ? 'bg-success' : 'bg-secondary' ?>">
                        <?= !empty($user['two_factor_secret']) ? 'Enabled' : 'Disabled' ?>
                    </span>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="twofa-switch" <?= !empty($user['two_factor_secret']) ? 'checked' : '' ?> style="cursor: pointer; width: 2.5em; height: 1.25em;">
                </div>
            </div>

            <div id="twofa-setup-container" class="text-center p-3 border rounded bg-white mt-3" style="display: none;">
                <p class="mb-3 text-muted" style="font-size: 0.75rem;">Scan this QR code using Google Authenticator or Microsoft Authenticator, then copy the 2FA secret.</p>
                <div class="mb-3">
                    <img id="twofa-qr-image" src="" alt="2FA QR Code" class="img-fluid border p-2 bg-light" style="max-width: 180px;">
                </div>
                <div class="mb-2">
                    <span class="text-muted d-block small mb-1">Secret Key (Manual Entry):</span>
                    <code id="twofa-secret-key" class="text-dark fw-bold px-2 py-1 bg-light border rounded" style="font-size: 1rem; letter-spacing: 1px;"></code>
                </div>
                <p class="mb-0 text-success fw-semibold small"><i class="fa-solid fa-circle-check"></i> 2FA is now active! It will be required on your next login.</p>
            </div>
        </div>

        <div class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 border-bottom cursor-pointer" id="toggle-devices">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-display" style="color: #2980b9;"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Device & Sessions Management</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">View logged-in devices and sign out of other sessions</p>
                </div>
            </div>
            <span id="devices-chevron" style="color: #888; font-size: 0.8rem;"><i class="fa-solid fa-chevron-down"></i></span>
        </div>

        <div id="devices-block" class="p-3 bg-light border-bottom text-muted" style="display: none; font-size: 0.82rem;">
            <div class="mb-3">
                <span class="fw-bold text-dark d-block mb-2">Active Devices:</span>
                <div class="list-group rounded-0">
                    <?php if (!empty($activeSessions)): ?>
                        <?php foreach ($activeSessions as $sess): ?>
                            <?php $isCurrent = ($sess['token'] === ($_SESSION['session_token'] ?? '')); ?>
                            <div class="list-group-item bg-white border p-2 mb-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold text-dark small">
                                        <?= htmlspecialchars(substr($sess['user_agent'], 0, 55)) ?><?= strlen($sess['user_agent']) > 55 ? '...' : '' ?>
                                        <?php if ($isCurrent): ?>
                                            <span class="badge bg-primary ms-1">Current Session</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="text-muted small" style="font-size: 0.7rem;">
                                        IP Address: <?= htmlspecialchars($sess['ip_address']) ?> • Active: <?= htmlspecialchars($sess['last_active']) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-2 text-muted">No active sessions found.</div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (count($activeSessions) > 1): ?>
                <form action="/profile/sessions/revoke-others" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100 rounded-0 py-2 fw-bold text-uppercase" style="font-size: 0.75rem;"><i class="fa-solid fa-right-from-bracket me-1"></i> Sign out of other devices</button>
                </form>
            <?php else: ?>
                <button class="btn btn-outline-secondary btn-sm w-100 rounded-0 py-2 fw-bold text-uppercase" disabled style="font-size: 0.75rem;"><i class="fa-solid fa-circle-check me-1"></i> Secure: No other active devices</button>
            <?php endif; ?>
        </div>

        <div class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 cursor-pointer" id="toggle-help-policies" style="text-decoration: none;">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-circle-info" style="color: #482922;"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Help & Policies</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Contact support, track orders, size guide, & legal policies</p>
                </div>
            </div>
            <span id="help-policies-chevron" style="color: #888; font-size: 0.8rem;"><i class="fa-solid fa-chevron-down"></i></span>
        </div>

        <div id="help-policies-block" class="p-3 bg-light" style="display: none; font-size: 0.8rem;">
            <div class="row">
                <div class="col-6 mb-2">
                    <div class="fw-bold text-uppercase mb-1 small text-dark" style="letter-spacing: 0.05em; font-size: 0.68rem;">Help & Support</div>
                    <a href="/support" class="d-block text-muted text-decoration-none py-1"><i class="fa-solid fa-headset me-1.5"></i> Contact Us</a>
                    <a href="/orders" class="d-block text-muted text-decoration-none py-1"><i class="fa-solid fa-truck me-1.5"></i> Track Order</a>
                    <a href="/about-us" class="d-block text-muted text-decoration-none py-1"><i class="fa-solid fa-circle-user me-1.5"></i> About Us</a>
                    <a href="/support" class="d-block text-muted text-decoration-none py-1"><i class="fa-solid fa-circle-question me-1.5"></i> FAQs</a>
                    <a href="/about-us" class="d-block text-muted text-decoration-none py-1"><i class="fa-solid fa-ruler-horizontal me-1.5"></i> Size Guide</a>
                </div>
                <div class="col-6 mb-2">
                    <div class="fw-bold text-uppercase mb-1 small text-dark" style="letter-spacing: 0.05em; font-size: 0.68rem;">Policies</div>
                    <a href="/about-us" class="d-block text-muted text-decoration-none py-1"><i class="fa-solid fa-file-invoice-dollar me-1.5"></i> Shipping Info</a>
                    <a href="/about-us" class="d-block text-muted text-decoration-none py-1"><i class="fa-solid fa-rotate-left me-1.5"></i> Returns & Refunds</a>
                    <a href="/about-us" class="d-block text-muted text-decoration-none py-1"><i class="fa-solid fa-shield-halved me-1.5"></i> Privacy Policy</a>
                    <a href="/about-us" class="d-block text-muted text-decoration-none py-1"><i class="fa-solid fa-file-contract me-1.5"></i> Terms of Service</a>
                </div>
            </div>
        </div>
    </div>

    <div class="d-grid gap-2 px-1">
        <a href="/logout" class="btn btn-outline-dark py-3 fw-bold text-uppercase" style="border-color: #282c3f; color: #282c3f; border-radius: 4px; font-size: 0.85rem; letter-spacing: 0.1em; background-color: #ffffff; transition: all 0.2s ease;">
            Log Out
        </a>
        
        <button type="button" class="btn btn-outline-danger py-3 fw-bold text-uppercase border-danger mt-1" id="btn-delete-account" style="border-radius: 4px; font-size: 0.85rem; letter-spacing: 0.1em; transition: all 0.2s ease;">
            Delete Account
        </button>
    </div>

</div>

<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content border-0" style="border-radius: 8px;">
            <div class="modal-body p-4 text-center">
                <span class="text-danger fs-1 mb-2 d-inline-block"><i class="fa-solid fa-triangle-exclamation"></i></span>
                <h5 class="fw-bold text-dark mb-2">Delete Account Permanently?</h5>
                <p class="text-muted mb-4" style="font-size: 0.82rem; line-height: 1.5;">This action is irreversible. All of your orders, address logs, wishlist records, and wholesale profile credits will be deleted forever.</p>
                
                <form action="/profile/delete-account" method="POST" id="delete-account-form">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-light w-50 py-2.5 fw-bold rounded-0" data-bs-dismiss="modal" style="font-size: 0.82rem;">Cancel</button>
                        <button type="submit" class="btn btn-danger w-50 py-2.5 fw-bold rounded-0" style="font-size: 0.82rem;">Yes, Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.list-group-item-action:hover {
    background-color: #f9f9fa !important;
}
.cursor-pointer {
    cursor: pointer;
}
</style>

<script>
$(document).ready(function() {
    function setupCollapse(triggerId, blockId, chevronId) {
        $(triggerId).on('click', function(e) {
            e.preventDefault();
            var block = $(blockId);
            var chevron = $(chevronId).find('i');
            if (block.is(':visible')) {
                block.slideUp(200);
                chevron.removeClass('fa-chevron-up').addClass('fa-chevron-down');
            } else {
                block.slideDown(200);
                chevron.removeClass('fa-chevron-down').addClass('fa-chevron-up');
            }
        });
    }

    setupCollapse('#toggle-account-settings', '#account-settings-form-block', '#settings-chevron');
    setupCollapse('#toggle-b2b-terms', '#b2b-terms-block', '#b2b-terms-chevron');
    setupCollapse('#toggle-weaver-dir', '#weaver-dir-block', '#weaver-dir-chevron');
    setupCollapse('#toggle-logistics', '#logistics-block', '#logistics-chevron');
    setupCollapse('#toggle-2fa', '#twofa-block', '#twofa-chevron');
    setupCollapse('#toggle-devices', '#devices-block', '#devices-chevron');
    setupCollapse('#toggle-help-policies', '#help-policies-block', '#help-policies-chevron');

    // 2FA Switch Event
    $('#twofa-switch').on('change', function() {
        var isChecked = $(this).is(':checked');
        var badge = $('#twofa-status-badge');
        var setupContainer = $('#twofa-setup-container');

        $.ajax({
            url: '/profile/2fa/toggle',
            method: 'POST',
            data: { enable: isChecked ? 1 : 0 },
            success: function(response) {
                if (response.success) {
                    if (isChecked) {
                        badge.removeClass('bg-secondary').addClass('bg-success').text('Enabled');
                        $('#twofa-qr-image').attr('src', 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + encodeURIComponent(response.qr_code_url));
                        $('#twofa-secret-key').text(response.secret);
                        setupContainer.slideDown(300);
                    } else {
                        badge.removeClass('bg-success').addClass('bg-secondary').text('Disabled');
                        setupContainer.slideUp(200);
                    }
                } else {
                    alert('Error toggling 2FA: ' + (response.error || 'Unknown error'));
                    $('#twofa-switch').prop('checked', !isChecked);
                }
            },
            error: function(xhr) {
                alert('Connection error toggling 2FA.');
                $('#twofa-switch').prop('checked', !isChecked);
            }
        });
    });

    $('#btn-delete-account').on('click', function() {
        if (window.bootstrap) {
            var myModal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
            myModal.show();
        } else {
            $('#deleteAccountModal').modal('show');
        }
    });
});
</script>
