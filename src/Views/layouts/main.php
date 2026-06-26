<?php
use Core\Application;
$user = Application::$app->getSessionUser();
$config = Application::$app->config;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($params['title'] ?? $config['company_name'] ?? 'Viraasat B2B') ?></title>
    <!-- Bootstrap 5.3+ CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Custom Meesho CSS -->
    <link rel="stylesheet" href="/assets/css/meesho.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

    <!-- Promotion Nav -->
    <div style="background-color: #F8F9FA; border-bottom: 1px solid #ECEFF1; font-size: 0.75rem; font-weight: 500; color: #555;" class="py-2 hide-on-mobile text-center">
        ⚡ Lowest Prices • Free Shipping on Bulk Orders • Weaver-Direct Verified Quality
    </div>

    <!-- Header Navigation -->
    <header class="meesho-header">
        <div class="container-xl">
            <div class="meesho-header-top">
                <!-- Brand Logo -->
                <a href="/" class="meesho-logo">
                    <?= htmlspecialchars($config['brand_name'] ?? 'Viraasat') ?>
                </a>

                <!-- Search box -->
                <form class="meesho-search-form" id="search-form" method="GET" action="/">
                    <i class="fa fa-search meesho-search-icon"></i>
                    <input type="text" name="search" class="meesho-search-input" placeholder="Try Saree, Kanjeevaram, Silk, Banarasi..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                </form>

                <!-- Navigation Controls -->
                <div class="meesho-nav-items">
                    <?php if ($user): ?>
                        <!-- Profile Trigger / Dropdown -->
                        <div class="dropdown">
                            <button class="meesho-nav-item dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-regular fa-user"></i>
                                <span><?= htmlspecialchars(explode(' ', $user['name'])[0]) ?></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="profileDropdown">
                                <li><a class="dropdown-item" href="/profile"><i class="fa-regular fa-id-card me-2 text-muted"></i> My Profile</a></li>
                                <li><a class="dropdown-item" href="/orders"><i class="fa-solid fa-box-open me-2 text-muted"></i> My Orders</a></li>
                                <li><a class="dropdown-item" href="/wallet"><i class="fa-solid fa-wallet me-2 text-muted"></i> Wallet (₹<?= number_format($user['balance'] ?? 0, 2) ?>)</a></li>
                                
                                <?php if (in_array($user['role'], ['SUPER_ADMIN', 'ADMIN'])): ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-primary fw-semibold" href="/admin"><i class="fa-solid fa-chart-line me-2"></i> Admin Suite</a></li>
                                <?php elseif ($user['role'] === 'SELLER'): ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-primary fw-semibold" href="/seller"><i class="fa-solid fa-shop me-2"></i> Seller Panel</a></li>
                                <?php elseif ($user['role'] === 'DELIVERY'): ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-primary fw-semibold" href="/delivery"><i class="fa-solid fa-truck me-2"></i> Delivery Panel</a></li>
                                <?php endif; ?>
                                
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="/logout"><i class="fa-solid fa-sign-out-alt me-2"></i> Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- Guest Sign In Link -->
                        <a href="/login" class="meesho-nav-item text-decoration-none">
                            <i class="fa-regular fa-user"></i>
                            <span>Sign In</span>
                        </a>
                    <?php endif; ?>

                    <!-- Notifications Dropdown -->
                    <div class="dropdown">
                        <button class="meesho-nav-item" type="button" id="notifButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-bell"></i>
                            <span>Alerts</span>
                            <span class="meesho-badge" id="notif-count" style="display: none;">0</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end mt-2 p-3" aria-labelledby="notifButton" style="width: 320px; max-height: 400px; overflow-y: auto;">
                            <h6 class="dropdown-header px-0 pb-2 border-bottom mb-2 d-flex justify-content-between align-items-center">
                                <span>Notifications</span>
                                <button class="btn btn-sm btn-link text-decoration-none p-0 text-pink" id="mark-all-read-btn" style="font-size: 0.75rem; display: none;">Clear all</button>
                            </h6>
                            <div id="notif-list" class="text-center py-3 text-muted" style="font-size: 0.85rem;">
                                No new notifications
                            </div>
                        </div>
                    </div>

                    <!-- Cart Drawer Trigger -->
                    <button class="meesho-nav-item" id="cart-trigger-btn">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span>Cart</span>
                        <span class="meesho-badge" id="cart-count-badge" style="display: none;">0</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Subheader Category Navigation -->
    <nav class="meesho-subcategory-bar">
        <div class="container-xl">
            <ul class="meesho-subcategory-list" id="category-nav">
                <li><a href="/" class="meesho-subcategory-link <?= empty($_GET['category']) ? 'active' : '' ?>">All Sarees</a></li>
                <!-- Loaded dynamically or static seeder categories -->
                <li><a href="/?category=Kanjeevaram+Silk" class="meesho-subcategory-link <?= ($_GET['category'] ?? '') === 'Kanjeevaram Silk' ? 'active' : '' ?>">Kanjeevaram</a></li>
                <li><a href="/?category=Banarasi+Brocade" class="meesho-subcategory-link <?= ($_GET['category'] ?? '') === 'Banarasi Brocade' ? 'active' : '' ?>">Banarasi</a></li>
                <li><a href="/?category=Patola+Silk" class="meesho-subcategory-link <?= ($_GET['category'] ?? '') === 'Patola Silk' ? 'active' : '' ?>">Patola</a></li>
                <li><a href="/?category=Chanderi+Weave" class="meesho-subcategory-link <?= ($_GET['category'] ?? '') === 'Chanderi Weave' ? 'active' : '' ?>">Chanderi</a></li>
                <li><a href="/?category=Organza+Silk" class="meesho-subcategory-link <?= ($_GET['category'] ?? '') === 'Organza Silk' ? 'active' : '' ?>">Organza</a></li>
                <li><a href="/?category=Mysore+Crepe+Silk" class="meesho-subcategory-link <?= ($_GET['category'] ?? '') === 'Mysore Crepe Silk' ? 'active' : '' ?>">Mysore Silk</a></li>
                <li><a href="/?category=Jamdani+Muslin" class="meesho-subcategory-link <?= ($_GET['category'] ?? '') === 'Jamdani Muslin' ? 'active' : '' ?>">Jamdani</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content Rendering -->
    <main>
        {{content}}
    </main>

    <!-- Saree B2B Footer -->
    <footer style="background-color: #222; color: #FFF; border-top: 4px solid var(--meesho-pink);" class="py-5 mt-5">
        <div class="container-xl">
            <div class="row">
                <!-- Column 1: Brand & Bio -->
                <div class="col-md-5 mb-4">
                    <h5 class="text-uppercase fw-bold text-pink mb-3" style="color: #F43397; font-size: 1.2rem; letter-spacing: 0.5px;"><?= htmlspecialchars($config['brand_name'] ?? 'Viraasat B2B') ?></h5>
                    <p class="text-white-50" style="font-size: 0.9rem; line-height: 1.7; max-width: 420px;">
                        Preserving the rich Indian textile heritage by bridging local master weavers directly with boutique retailers. Scalable, commission-controlled, and fully automated wholesale transactions.
                    </p>
                </div>
                <!-- Column 2: Corporate Address & Contact -->
                <div class="col-md-4 mb-4">
                    <h6 class="text-uppercase fw-semibold text-pink mb-3" style="color: #F43397; font-size: 0.9rem; letter-spacing: 0.5px;">Corporate Office</h6>
                    <p class="text-white-50 mb-0" style="font-size: 0.9rem; line-height: 1.7;">
                        <?= htmlspecialchars($config['office_address'] ?? 'Varanasi Handloom Cluster, Uttar Pradesh') ?><br>
                        <span class="d-block mt-2"><strong>Email:</strong> <?= htmlspecialchars($config['support_email'] ?? 'wholesale@viraasat.com') ?></span>
                        <span class="d-block"><strong>Support Mobile:</strong> <?= htmlspecialchars($config['support_mobile'] ?? '+91 9999999999') ?></span>
                    </p>
                </div>
                <!-- Column 3: Quick Links & CMS Policies -->
                <div class="col-md-3 mb-4">
                    <h6 class="text-uppercase fw-semibold text-pink mb-3" style="color: #F43397; font-size: 0.9rem; letter-spacing: 0.5px;">Marketplace Info</h6>
                    <div class="d-flex flex-column gap-2" style="font-size: 0.9rem;">
                        <a href="/about-us" class="footer-link">About Us</a>
                        <a href="/contact-us" class="footer-link">Contact Support</a>
                        <a href="/privacy-policy" class="footer-link">Privacy Policy</a>
                        <a href="/terms-conditions" class="footer-link">Terms & Conditions</a>
                        <a href="/refund-policy" class="footer-link">Refund & Return Policy</a>
                        <a href="/shipping-policy" class="footer-link">Shipping Policy</a>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="background-color: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.1);">
            <div class="row" style="font-size: 0.8rem; color: rgba(255,255,255,0.4);">
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                    © <?= date('Y') ?> <?= htmlspecialchars($config['company_name'] ?? 'Viraasat Textiles Private Limited') ?>. All rights reserved.
                </div>
                <div class="col-md-6 text-center text-md-end text-white-50">
                    Designed for Handloom GI Weaving Clusters
                </div>
            </div>
        </div>
    </footer>

    <!-- Cart Sliding Drawer -->
    <div class="cart-drawer-backdrop" id="cart-backdrop"></div>
    <div class="cart-drawer" id="cart-drawer-box">
        <div class="p-4 d-flex justify-between align-items-center border-bottom">
            <h5 class="m-0 fw-bold">Wholesale Cart</h5>
            <button class="btn btn-close p-0" id="cart-close-btn"></button>
        </div>
        <!-- Scrollable items area -->
        <div class="flex-grow-1 overflow-auto p-4" id="cart-drawer-items">
            <!-- Loaded dynamically via AJAX -->
        </div>
        <!-- Totals & Checkout -->
        <div class="p-4 border-top" id="cart-drawer-footer" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="fw-semibold text-muted">Estimated Subtotal</span>
                <span class="fs-4 fw-bold text-pink" id="cart-total-display" style="color: #F43397;">₹0.00</span>
            </div>
            
            <div class="mb-4">
                <label for="shipping-address-box" class="form-label text-uppercase fw-semibold text-muted" style="font-size: 0.7rem;">Delivery Shipping Address <span class="text-danger">*</span></label>
                <textarea id="shipping-address-box" class="form-control" rows="2" placeholder="Street, City, State, PIN Code..." style="font-size: 0.85rem; resize: none;"></textarea>
            </div>
            
            <button class="btn btn-meesho-pink w-100 py-2 fs-6" id="checkout-order-btn">
                Place Wholesale Order <i class="fa fa-arrow-right ms-1"></i>
            </button>
        </div>
    </div>

    <!-- Bootstrap 5.3+ Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Global Cart & Core AJAX Script -->
    <script>
        $(document).ready(function() {
            // Notifications & Cart Handlers
            $('#cart-trigger-btn').on('click', function() {
                openCart();
            });

            $('#cart-close-btn, #cart-backdrop').on('click', function() {
                closeCart();
            });

            function openCart() {
                $('#cart-backdrop').addClass('show');
                $('#cart-drawer-box').addClass('open');
                loadCartItems();
            }

            function closeCart() {
                $('#cart-backdrop').removeClass('show');
                $('#cart-drawer-box').removeClass('open');
            }

            // Load Cart Items AJAX
            function loadCartItems() {
                // We'll write the JS interface that communicates with /cart endpoint
                $.ajax({
                    url: '/cart',
                    method: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        renderCart(res);
                    },
                    error: function() {
                        $('#cart-drawer-items').html('<p class="text-danger text-center">Failed to load cart items.</p>');
                    }
                });
            }

            function renderCart(res) {
                // If cart is empty
                if (!res.items || res.items.length === 0) {
                    $('#cart-drawer-items').html(`
                        <div class="text-center py-5 text-muted">
                            <i class="fa fa-shopping-bag mb-3 fs-1 opacity-50"></i>
                            <p class="mb-3">Your wholesale cart is empty.</p>
                            <button class="btn btn-meesho-pink btn-sm" onclick="$('#cart-close-btn').click()">Shop Sarees</button>
                        </div>
                    `);
                    $('#cart-drawer-footer').hide();
                    $('#cart-count-badge').hide();
                    return;
                }

                // Render cart items
                let html = '<div class="d-flex flex-column gap-3">';
                res.items.forEach(function(item) {
                    const priceFormatted = parseFloat(item.price).toLocaleString('en-IN');
                    const totalFormatted = parseFloat(item.total).toLocaleString('en-IN');
                    
                    html += `
                        <div class="d-flex gap-3 pb-3 border-bottom align-items-center">
                            <img src="${item.image_url || '/assets/images/placeholder.png'}" class="rounded" style="width: 60px; height: 75px; object-fit: cover; border: 1px solid var(--meesho-border);">
                            <div class="flex-grow-1" style="min-width: 0;">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h6 class="fw-semibold mb-0 text-truncate" style="font-size: 0.9rem;">${item.title}</h6>
                                    <button class="btn btn-link text-muted p-0 remove-item-btn" data-id="${item.variant_id}"><i class="fa fa-trash-can"></i></button>
                                </div>
                                <span class="badge text-secondary bg-light border mt-1" style="font-size: 0.65rem;">Min Wholesale MOQ: ${item.bulk_threshold}</span>
                                
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <!-- Qty Selector -->
                                    <div class="d-flex align-items-center border rounded">
                                        <button class="btn btn-sm btn-light py-0 px-2 qty-btn minus" data-id="${item.variant_id}">-</button>
                                        <span class="px-2 fw-bold text-center" style="font-size: 0.85rem; min-width: 25px;">${item.quantity}</span>
                                        <button class="btn btn-sm btn-light py-0 px-2 qty-btn plus" data-id="${item.variant_id}">+</button>
                                    </div>
                                    <div class="text-end">
                                        ${item.is_wholesale ? 
                                            `<span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-1 mb-1" style="font-size: 0.55rem;">Wholesale Active</span>
                                             <div class="fw-bold text-pink" style="font-size: 0.95rem;">₹${totalFormatted}</div>` : 
                                            `<div class="fw-bold" style="font-size: 0.95rem;">₹${totalFormatted}</div>
                                             <div class="text-warning" style="font-size: 0.65rem; font-weight: 500;">Add ${item.bulk_threshold - item.quantity} more for Wholesale!</div>`
                                        }
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                html += '</div>';

                $('#cart-drawer-items').html(html);
                $('#cart-total-display').text('₹' + parseFloat(res.subtotal).toLocaleString('en-IN', {minimumFractionDigits: 2}));
                $('#cart-drawer-footer').show();
                
                // Set Badge count
                const count = res.items.reduce((sum, item) => sum + parseInt(item.quantity), 0);
                $('#cart-count-badge').text(count).show();
            }

            // Handle Qty Add/Subtract & Delete
            $(document).on('click', '.qty-btn', function() {
                const variantId = $(this).data('id');
                const isPlus = $(this).hasClass('plus');
                const change = isPlus ? 1 : -1;
                
                $.ajax({
                    url: '/cart/update',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ variant_id: variantId, change: change }),
                    dataType: 'json',
                    success: function(res) {
                        renderCart(res);
                    }
                });
            });

            $(document).on('click', '.remove-item-btn', function() {
                const variantId = $(this).data('id');
                $.ajax({
                    url: '/cart/remove',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ variant_id: variantId }),
                    dataType: 'json',
                    success: function(res) {
                        renderCart(res);
                    }
                });
            });

            // Initial Cart Sync
            $.ajax({
                url: '/cart',
                method: 'GET',
                dataType: 'json',
                success: function(res) {
                    if (res.items && res.items.length > 0) {
                        const count = res.items.reduce((sum, item) => sum + parseInt(item.quantity), 0);
                        $('#cart-count-badge').text(count).show();
                    }
                }
            });

            // Checkout Order Placing AJAX
            $('#checkout-order-btn').on('click', function() {
                const address = $('#shipping-address-box').val().trim();
                if (address === '') {
                    alert('Please enter a delivery shipping address.');
                    return;
                }

                $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Processing Order...');

                $.ajax({
                    url: '/checkout',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ address: address }),
                    dataType: 'json',
                    success: function(res) {
                        if (res.success) {
                            alert('Wholesale orders successfully placed! Redirecting to orders tab...');
                            window.location.href = '/orders';
                        } else {
                            alert(res.error || 'Failed to place order.');
                            $('#checkout-order-btn').prop('disabled', false).html('Place Wholesale Order <i class="fa fa-arrow-right ms-1"></i>');
                        }
                    },
                    error: function(xhr) {
                        const err = xhr.responseJSON ? xhr.responseJSON.error : 'Network error during checkout';
                        alert(err);
                        $('#checkout-order-btn').prop('disabled', false).html('Place Wholesale Order <i class="fa fa-arrow-right ms-1"></i>');
                    }
                });
            });

            // Dynamic categories loading from backend if needed
            // Currently categories are loaded on the subheader directly
        });
    </script>
</body>
</html>
