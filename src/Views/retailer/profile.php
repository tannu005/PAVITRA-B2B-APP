<!-- B2B Wholesale Saree Profile Page -->
<div class="container-xl py-4" style="max-width: 600px; font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f5f5f6; min-height: 90vh; padding-bottom: 80px;">
    
    <!-- Header Bar -->
    <div class="d-flex align-items-center justify-content-between mb-4 bg-white p-3 border-bottom sticky-top" style="z-index: 100; margin: -24px -15px 24px -15px;">
        <div class="d-flex align-items-center gap-3">
            <a href="/" class="text-dark fs-5" style="text-decoration: none;"><i class="fa-solid fa-arrow-left"></i></a>
            <h5 class="fw-bold mb-0 text-dark" style="font-size: 1.1rem; letter-spacing: -0.2px;">Profile</h5>
        </div>
    </div>

    <!-- User Welcome Banner -->
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

    <!-- 2x2 Grid Cards -->
    <div class="row g-2 mb-4">
        <!-- Card 1: Orders -->
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
        <!-- Card 2: Custom Studio -->
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
        <!-- Card 3: Help Center -->
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
        <!-- Card 4: Wallet -->
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

    <!-- Vertical List Saree Wholesale Features -->
    <div class="bg-white rounded-3 border overflow-hidden mb-4">
        <!-- Item 1: B2B Credit & Trade Terms -->
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

        <!-- Collapsible B2B Verification Credentials -->
        <div id="b2b-terms-block" class="p-3 bg-light border-bottom text-muted" style="display: none; font-size: 0.82rem; line-height: 1.6;">
            <div class="mb-2"><strong>GST Identification Number (GSTIN):</strong> <code class="text-dark">09AAAAA1111A1Z1</code> (Verified)</div>
            <div class="mb-2"><strong>Tax registration type:</strong> Wholesaler / Retailer Composition Scheme</div>
            <div class="mb-2"><strong>Trade credit limit:</strong> <span class="text-dark fw-bold">₹1,00,000.00</span> (85,000.00 available)</div>
            <div><strong>Payment terms:</strong> Net-30 days billing terms on approved weaver loom invoices</div>
        </div>

        <!-- Item 2: Loom Booking & Customization -->
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

        <!-- Item 3: Weaver Direct Directory -->
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

        <!-- Item 4: Bulk Shipping & Logistics -->
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

        <!-- Item 5: Sample Swatch Requests -->
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

        <!-- Item 6: Manage Account Settings -->
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

        <!-- Collapsible Account Edit Form Block -->
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

        <!-- Item 7: Wishlist -->
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

        <!-- Item 8: General Notification Settings -->
        <div class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3" style="text-decoration: none;">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-gears" style="color: #7f8c8d;"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Settings</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Manage weaver notification channels & keys</p>
                </div>
            </div>
            <span style="color: #ccc; font-size: 0.75rem;"><i class="fa-solid fa-chevron-right"></i></span>
        </div>
    </div>

    <!-- Sign Out & Delete Account Actions -->
    <div class="d-grid gap-2 px-1">
        <!-- Log Out -->
        <a href="/logout" class="btn btn-outline-dark py-3 fw-bold text-uppercase" style="border-color: #282c3f; color: #282c3f; border-radius: 4px; font-size: 0.85rem; letter-spacing: 0.1em; background-color: #ffffff; transition: all 0.2s ease;">
            Log Out
        </a>
        
        <!-- Delete Account -->
        <button type="button" class="btn btn-outline-danger py-3 fw-bold text-uppercase border-danger mt-1" id="btn-delete-account" style="border-radius: 4px; font-size: 0.85rem; letter-spacing: 0.1em; transition: all 0.2s ease;">
            Delete Account
        </button>
    </div>

</div>

<!-- Delete Account Confirmation Modal -->
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
    // Collapsible sections
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

    // Trigger delete account confirmation modal
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
