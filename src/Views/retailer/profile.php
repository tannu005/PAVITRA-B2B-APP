<!-- Myntra-Style Premium Profile Page -->
<div class="container-xl py-4" style="max-width: 600px; font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f5f5f6; min-height: 90vh; padding-bottom: 80px;">
    
    <!-- Header Bar -->
    <div class="d-flex align-items-center justify-content-between mb-4 bg-white p-3 border-bottom sticky-top" style="z-index: 100; margin: -24px -15px 24px -15px;">
        <div class="d-flex align-items-center gap-3">
            <a href="/" class="text-dark fs-5" style="text-decoration: none;"><i class="fa-solid fa-arrow-left"></i></a>
            <h5 class="fw-bold mb-0 text-dark" style="font-size: 1.1rem; letter-spacing: -0.2px;">Profile</h5>
        </div>
        <div class="d-flex align-items-center gap-1 bg-light px-2 py-1 rounded-pill border" style="font-size: 0.8rem; font-weight: 700; color: #282c3f;">
            <span style="color: #ff3f6c;"><i class="fa-solid fa-ticket-simple"></i></span>
            <span>₹15</span>
        </div>
    </div>

    <!-- User Insider Welcome Banner -->
    <div class="p-4 mb-4 rounded-3 border-0 position-relative overflow-hidden" style="background: linear-gradient(135deg, #fffdfa 0%, #f9f2e7 100%); border: 1px solid rgba(213,162,73,0.15) !important; box-shadow: 0 4px 15px rgba(213,162,73,0.05);">
        <div class="row align-items-center">
            <div class="col-8">
                <h4 class="fw-bold text-dark mb-1" style="font-family: var(--font-headings); font-size: 1.6rem;"><?= htmlspecialchars($user['name']) ?> !</h4>
                <div class="text-uppercase fw-bold mb-2" style="font-size: 0.65rem; color: #d5a249; letter-spacing: 0.1em;"><i class="fa-solid fa-crown me-1"></i> M INSIDER</div>
                <p class="text-muted mb-3" style="font-size: 0.78rem; line-height: 1.4;">Become An Insider To Avail <strong style="color: #d5a249;">Extra Rewards</strong> and <strong style="color: #d5a249;">Better Discounts!</strong></p>
                <a href="/customization" class="btn text-white px-3 py-1.5 fw-bold text-uppercase" style="background-color: #d5a249; font-size: 0.72rem; letter-spacing: 0.05em; border-radius: 4px; border: none; box-shadow: 0 4px 10px rgba(213, 162, 73, 0.2);">Know More</a>
            </div>
            <div class="col-4 text-end position-relative">
                <!-- Golden crown graphic floating -->
                <i class="fa-solid fa-crown text-warning fa-4x opacity-25" style="color: #d5a249 !important; transform: rotate(15deg);"></i>
            </div>
        </div>
    </div>

    <!-- Shopping for User Profile Switcher -->
    <div class="bg-white p-3 rounded-3 border mb-4">
        <h6 class="fw-bold text-dark mb-3" style="font-size: 0.85rem;">Shopping for <?= htmlspecialchars($user['name']) ?></h6>
        <div class="d-flex gap-4 overflow-auto pb-1" style="scrollbar-width: none;">
            <!-- Profile Avatar 1 (Current) -->
            <div class="text-center" style="min-width: 60px;">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-1 position-relative" style="width: 50px; height: 50px; background-color: #ffeef2; border: 2px solid #ff3f6c; color: #ff3f6c; font-weight: 700; font-size: 1.2rem;">
                    <?= strtoupper(substr($user['name'], 0, 1)) ?>
                    <span class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle" style="width: 10px; height: 10px;" title="Active"></span>
                </div>
                <span class="d-block text-truncate text-dark fw-bold" style="font-size: 0.7rem; max-width: 65px;"><?= htmlspecialchars($user['name']) ?></span>
            </div>
            
            <!-- Profile Avatar 2 (Buyer Partner) -->
            <div class="text-center" style="min-width: 60px; opacity: 0.6;">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-1" style="width: 50px; height: 50px; background-color: #e8f5e9; border: 1px solid #c8e6c9; color: #2e7d32; font-weight: 600; font-size: 1.1rem;">
                    B
                </div>
                <span class="d-block text-truncate text-muted" style="font-size: 0.7rem; max-width: 65px;">Buyer</span>
            </div>

            <!-- Profile Avatar 3 (Admin Mode) -->
            <div class="text-center" style="min-width: 60px; opacity: 0.6;">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-1 position-relative" style="width: 50px; height: 50px; background-color: #e3f2fd; border: 1px solid #bbdefb; color: #1565c0; font-weight: 600; font-size: 1.1rem;">
                    A
                    <span class="position-absolute translate-middle-x start-50 badge bg-dark text-white" style="font-size: 0.45rem; bottom: -5px; padding: 2px 4px; border-radius: 4px;">Admin</span>
                </div>
                <span class="d-block text-truncate text-muted" style="font-size: 0.7rem; max-width: 65px;">Store Admin</span>
            </div>

            <!-- Profile Avatar 4 (Add new) -->
            <div class="text-center" style="min-width: 60px; cursor: pointer;">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-1 border border-dashed" style="width: 50px; height: 50px; background-color: #fafafa; color: #888; font-size: 1.2rem;">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <span class="d-block text-muted" style="font-size: 0.7rem;">Add User</span>
            </div>
        </div>
    </div>

    <!-- Action Pills Row -->
    <div class="d-flex gap-2 overflow-auto mb-4 pb-1" style="scrollbar-width: none;">
        <button class="btn btn-sm bg-white border rounded-pill px-3 py-1.5 fw-bold text-dark" style="font-size: 0.75rem; white-space: nowrap;">Basics <i class="fa-solid fa-chevron-right ms-1" style="font-size: 0.6rem; color: #888;"></i></button>
        <button class="btn btn-sm bg-white border rounded-pill px-3 py-1.5 fw-bold text-dark" style="font-size: 0.75rem; white-space: nowrap;">Size Details <i class="fa-solid fa-chevron-right ms-1" style="font-size: 0.6rem; color: #888;"></i></button>
        <button class="btn btn-sm bg-white border rounded-pill px-3 py-1.5 fw-bold text-dark" style="font-size: 0.75rem; white-space: nowrap;">Skin & Hair <i class="fa-solid fa-chevron-right ms-1" style="font-size: 0.6rem; color: #888;"></i></button>
    </div>

    <!-- Daily Myncash Magic Card -->
    <div class="p-3 mb-4 rounded-3 border-0 d-flex align-items-center justify-content-between" style="background: linear-gradient(90deg, #fff3d6 0%, #ffe09d 100%); border: 1px solid rgba(213, 162, 73, 0.1) !important; box-shadow: 0 4px 12px rgba(213, 162, 73, 0.05);">
        <div class="d-flex align-items-center gap-3">
            <span style="font-size: 1.8rem; color: #ff9f43;"><i class="fa-solid fa-calendar-check animate-bounce"></i></span>
            <div>
                <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Daily Myncash Magic!</h6>
                <p class="text-muted mb-0" style="font-size: 0.7rem;">Win up to <strong class="text-dark">₹200 now</strong></p>
            </div>
        </div>
        <a href="/customization" class="btn btn-sm btn-dark text-white fw-bold text-uppercase px-3 rounded-pill" style="font-size: 0.68rem; background-color: #282c3f; border: none;">Play</a>
    </div>

    <!-- 2x2 Grid Cards -->
    <div class="row g-2 mb-4">
        <!-- Card 1: Orders -->
        <div class="col-6">
            <a href="/orders" class="bg-white p-3 rounded-3 border d-flex align-items-center justify-content-between text-decoration-none" style="transition: transform 0.2s ease;">
                <div class="d-flex align-items-center gap-3">
                    <span class="fs-4" style="color: #ff3f6c;"><i class="fa-solid fa-box-archive"></i></span>
                    <div>
                        <h6 class="fw-bold text-dark mb-0" style="font-size: 0.82rem;">Orders</h6>
                        <span class="text-muted" style="font-size: 0.65rem;">Track shipments</span>
                    </div>
                </div>
                <span style="color: #888; font-size: 0.8rem;"><i class="fa-solid fa-chevron-right"></i></span>
            </a>
        </div>
        <!-- Card 2: Insider -->
        <div class="col-6">
            <a href="/customization" class="bg-white p-3 rounded-3 border d-flex align-items-center justify-content-between text-decoration-none" style="transition: transform 0.2s ease;">
                <div class="d-flex align-items-center gap-3">
                    <span class="fs-4" style="color: #d5a249;"><i class="fa-solid fa-crown"></i></span>
                    <div>
                        <h6 class="fw-bold text-dark mb-0" style="font-size: 0.82rem;">Insider</h6>
                        <span class="text-muted" style="font-size: 0.65rem;">Gold tier benefits</span>
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
                        <h6 class="fw-bold text-dark mb-0" style="font-size: 0.82rem;">Help Center</h6>
                        <span class="text-muted" style="font-size: 0.65rem;">24/7 weaver chat</span>
                    </div>
                </div>
                <span style="color: #888; font-size: 0.8rem;"><i class="fa-solid fa-chevron-right"></i></span>
            </a>
        </div>
        <!-- Card 4: Coupons -->
        <div class="col-6">
            <a href="/wallet" class="bg-white p-3 rounded-3 border d-flex align-items-center justify-content-between text-decoration-none" style="transition: transform 0.2s ease;">
                <div class="d-flex align-items-center gap-3">
                    <span class="fs-4" style="color: #e67e22;"><i class="fa-solid fa-ticket-simple"></i></span>
                    <div>
                        <h6 class="fw-bold text-dark mb-0" style="font-size: 0.82rem;">Coupons</h6>
                        <span class="text-muted" style="font-size: 0.65rem;">Active discounts</span>
                    </div>
                </div>
                <span style="color: #888; font-size: 0.8rem;"><i class="fa-solid fa-chevron-right"></i></span>
            </a>
        </div>
    </div>

    <!-- Vertical List Options -->
    <div class="bg-white rounded-3 border overflow-hidden mb-4">
        <!-- Item 1: Ultimate Glam Clan -->
        <a href="/customization" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 border-bottom" style="text-decoration: none;">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-wand-magic-sparkles" style="color: #9b59b6;"></i></span>
                <div>
                    <div class="d-flex align-items-center gap-2">
                        <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Ultimate Glam Clan</h6>
                        <span class="badge bg-danger rounded-pill" style="font-size: 0.55rem; padding: 2px 6px;">NEW</span>
                    </div>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Pavitra Influencer program for buyers</p>
                </div>
            </div>
            <span style="color: #ccc; font-size: 0.75rem;"><i class="fa-solid fa-chevron-right"></i></span>
        </a>

        <!-- Item 2: Cashback Offer -->
        <a href="/wallet" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 border-bottom" style="text-decoration: none;">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-credit-card" style="color: #ff3f6c;"></i></span>
                <div>
                    <div class="d-flex align-items-center gap-2">
                        <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Get 7.5% Cashback on Store</h6>
                        <span class="badge bg-danger rounded-pill" style="font-size: 0.55rem; padding: 2px 6px;">NEW</span>
                    </div>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Joining fee waived on SBI Card co-brand</p>
                </div>
            </div>
            <span style="color: #ccc; font-size: 0.75rem;"><i class="fa-solid fa-chevron-right"></i></span>
        </a>

        <!-- Item 3: Personal Loan -->
        <div class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 border-bottom" style="text-decoration: none;">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-hand-holding-dollar" style="color: #2ecc71;"></i></span>
                <div>
                    <div class="d-flex align-items-center gap-2">
                        <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Business Credit Loan</h6>
                        <span class="badge bg-danger rounded-pill" style="font-size: 0.55rem; padding: 2px 6px;">NEW</span>
                    </div>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Get instant credit limit up to Rs.10,00,000</p>
                </div>
            </div>
            <span style="color: #ccc; font-size: 0.75rem;"><i class="fa-solid fa-chevron-right"></i></span>
        </div>

        <!-- Item 4: Payments & Currencies -->
        <div class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 border-bottom cursor-pointer" style="text-decoration: none;">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-wallet" style="color: #e67e22;"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Payments & Currencies</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">View balance and saved payment methods</p>
                </div>
            </div>
            <span style="color: #888; font-size: 0.8rem;"><i class="fa-solid fa-chevron-down"></i></span>
        </div>

        <!-- Item 5: Earn & Redeem -->
        <div class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 border-bottom cursor-pointer" style="text-decoration: none;">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-gift" style="color: #e74c3c;"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Earn & Redeem</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">View rewards balance and prize cards</p>
                </div>
            </div>
            <span style="color: #888; font-size: 0.8rem;"><i class="fa-solid fa-chevron-down"></i></span>
        </div>

        <!-- Item 6: Manage Account Settings -->
        <div class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 border-bottom cursor-pointer" id="toggle-account-settings" style="text-decoration: none;">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-user-gear" style="color: #34495e;"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Manage Account Settings</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Manage your contact name and email settings</p>
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
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-heart" style="color: #ff3f6c;"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Wishlist</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Your most loved saree styles</p>
                </div>
            </div>
            <span style="color: #ccc; font-size: 0.75rem;"><i class="fa-solid fa-chevron-right"></i></span>
        </a>

        <!-- Item 8: Suggestions -->
        <div class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 border-bottom" style="text-decoration: none;">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-wand-magic-sparkles" style="color: #f1c40f;"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Pavitra Suggests</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">100% personalized loom recommendations for you</p>
                </div>
            </div>
            <span style="color: #ccc; font-size: 0.75rem;"><i class="fa-solid fa-chevron-right"></i></span>
        </a>

        <!-- Item 9: Settings -->
        <div class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3" style="text-decoration: none;">
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 1rem; width: 20px; text-align: center;"><i class="fa-solid fa-gears" style="color: #7f8c8d;"></i></span>
                <div>
                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">Settings</h6>
                    <p class="text-muted mb-0" style="font-size: 0.7rem;">Manage push notifications and security keys</p>
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
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-4px); }
}
.animate-bounce {
    animation: bounce 2s infinite;
}
</style>

<script>
$(document).ready(function() {
    // Toggle collapsible account edit form
    $('#toggle-account-settings').on('click', function(e) {
        e.preventDefault();
        var block = $('#account-settings-form-block');
        var chevron = $('#settings-chevron').find('i');
        if (block.is(':visible')) {
            block.slideUp(200);
            chevron.removeClass('fa-chevron-up').addClass('fa-chevron-down');
        } else {
            block.slideDown(200);
            chevron.removeClass('fa-chevron-down').addClass('fa-chevron-up');
        }
    });

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
