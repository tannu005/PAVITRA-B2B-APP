<?php
use Core\Application;
$user = Application::$app->getSessionUser();
$config = Application::$app->config;
$csrfToken = Application::$app->getCsrfToken();
$pageTitle = htmlspecialchars($params['title'] ?? $config['company_name'] ?? 'Viraasat B2B');
$pageDescription = htmlspecialchars($params['description'] ?? 'Enterprise-grade B2B wholesale marketplace for sellers, retailers, and delivery partners.');
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$canonicalPath = strtok($_SERVER['REQUEST_URI'] ?? '/', '?') ?: '/';
$canonicalUrl = $scheme . ($_SERVER['HTTP_HOST'] ?? 'localhost') . $canonicalPath;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= htmlspecialchars($csrfToken) ?>">
    <meta name="description" content="<?= $pageDescription ?>">
    <meta name="robots" content="index,follow">
    <meta name="theme-color" content="#482922">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>">
    <meta property="og:title" content="<?= $pageTitle ?>">
    <meta property="og:description" content="<?= $pageDescription ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= htmlspecialchars($config['brand_name'] ?? 'Viraasat B2B') ?>">
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
    <title><?= $pageTitle ?></title>
    <!-- Bootstrap 5.3+ CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rozha+One&family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Nunito:ital,wght@0,300..900;1,300..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <!-- Custom Meesho CSS -->
    <link rel="stylesheet" href="/assets/css/meesho.css?v=<?= time() ?>">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        window.__CSRF_TOKEN__ = <?= json_encode($csrfToken) ?>;
        $.ajaxSetup({
            headers: { 'X-CSRF-Token': window.__CSRF_TOKEN__ }
        });
    </script>
</head>
<body>

    <!-- Promotion Nav -->
    <div class="py-2 hide-on-mobile text-center" style="background-color: #F8F9FA; border-bottom: 1px solid #ECEFF1; color: #555;">
        ⚡ Lowest Prices • Free Shipping on Bulk Orders • Weaver-Direct Verified Quality
    </div>

    <!-- Meesho-Style Mobile Top Header -->
    <header class="meesho-mobile-header">
        <div class="mobile-header-top-row">
            <div class="d-flex align-items-center">
                <?php if ($_SERVER['REQUEST_URI'] !== '/' && $_SERVER['REQUEST_URI'] !== ''): ?>
                    <a href="javascript:history.back()" class="mobile-header-back-arrow">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                <?php else: ?>
                    <a href="/" class="nisho-logo" style="margin-right: 10px;">प</a>
                <?php endif; ?>
            </div>

            <a href="/" style="text-decoration: none;">
                <span class="refer-badge">
                    <i class="fa-solid fa-gift"></i> Refer & Earn
                </span>
            </a>

            <div class="mobile-header-icons">
                <a href="/support" title="Support"><i class="fa-solid fa-headset"></i></a>
                <a href="javascript:void(0)" id="cart-trigger-btn-mobile" title="Cart">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span class="badge bg-danger rounded-circle position-absolute p-1" id="cart-count-badge-mobile" style="display: none; font-size: 0.52rem; top: -5px; right: -5px;">0</span>
                </a>
            </div>
        </div>

        <div class="meesho-mobile-search">
            <form id="search-form-mobile" method="GET" action="/">
                <i class="fa fa-search meesho-mobile-search-icon"></i>
                <input type="text" name="search" class="meesho-mobile-search-input" placeholder="Search by Keyword or Product ID" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                <div class="meesho-mobile-search-right-icons">
                    <i class="fa-solid fa-microphone"></i>
                    <i class="fa-solid fa-camera ms-2"></i>
                </div>
            </form>
        </div>
    </header>

    <!-- Header Navigation (Desktop/Tablet) -->
    <header class="meesho-header py-2">
        <div class="container-xl d-flex align-items-center justify-content-between">
            <!-- Brand Logo (Hindi character) -->
            <a href="/" class="nisho-logo">प</a>

            <!-- Center Menu Links (Nisho Muse Two-Row style) -->
            <div class="nisho-desktop-menu d-flex flex-column align-items-center gap-1">
                <div class="menu-row-1 d-flex gap-4">
                    <a href="/?category=Organza+Silk" class="nisho-menu-link">PAVITRA MUSE</a>
                    <a href="/?sort=price_high" class="nisho-menu-link">MOST WANTED</a>
                    <a href="/" class="nisho-menu-link">NEW ARRIVALS</a>
                    <a href="/" class="nisho-menu-link">ALL SAREES</a>
                    <a href="/?category=Banarasi+Brocade" class="nisho-menu-link">BANARASI</a>
                    <a href="/?category=Kanjeevaram+Silk" class="nisho-menu-link">KANJEEVARAM</a>
                    <a href="/?category=Patola+Silk" class="nisho-menu-link">PATOLA</a>
                </div>
                <div class="menu-row-2 d-flex gap-4">
                    <a href="/?category=Organza+Silk" class="nisho-menu-link">ORGANZA</a>
                    <a href="/?category=Chanderi+Weave" class="nisho-menu-link">CHANDERI</a>
                    <a href="/?category=Mysore+Crepe+Silk" class="nisho-menu-link">MYSORE SILK</a>
                    <a href="/?category=Jamdani+Muslin" class="nisho-menu-link">JAMDANI</a>
                    <div class="dropdown d-inline-block collections-dropdown">
                        <a href="#" class="dropdown-toggle text-decoration-none text-dark nisho-menu-link" data-bs-toggle="dropdown" aria-expanded="false">COLLECTIONS</a>
                        <ul class="dropdown-menu mt-2 rounded-0 border text-center" style="min-width: 220px; font-family: 'Plus Jakarta Sans', sans-serif; border-color: #eee !important; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                            <li><a class="dropdown-item py-2 fw-semibold text-uppercase" href="/?category=Organza+Silk" style="font-size: 0.8rem; color: #482922; letter-spacing: 0.05em;">PavitraOffice-SS2</a></li>
                            <li><a class="dropdown-item py-2 fw-semibold text-uppercase" href="/?category=Kanjeevaram+Silk" style="font-size: 0.8rem; color: #482922; letter-spacing: 0.05em;">PAVITRA OFFICE-SS1</a></li>
                            <li><a class="dropdown-item py-2 fw-semibold text-uppercase" href="/?category=Patola+Silk" style="font-size: 0.8rem; color: #482922; letter-spacing: 0.05em;">PAVITRAHAVELI - SS2</a></li>
                            <li><a class="dropdown-item py-2 fw-semibold text-uppercase" href="/?category=Mysore+Crepe+Silk" style="font-size: 0.8rem; color: #482922; letter-spacing: 0.05em;">DESI ROMANCE</a></li>
                            <li><a class="dropdown-item py-2 fw-semibold text-uppercase" href="/?category=Chanderi+Weave" style="font-size: 0.8rem; color: #482922; letter-spacing: 0.05em;">SHAADI KA GHAR</a></li>
                            <li><a class="dropdown-item py-2 fw-semibold text-uppercase" href="/?category=Jamdani+Muslin" style="font-size: 0.8rem; color: #482922; letter-spacing: 0.05em;">JEANS & JHUMKA</a></li>
                        </ul>
                    </div>
                    <a href="/?sort=price_low" class="text-danger fw-bold nisho-menu-link" style="color: #dc3545 !important;">GOODBYE DEALS ;)</a>
                </div>
            </div>

            <!-- Right Navigation Controls -->
            <div class="meesho-nav-items gap-3 align-items-center">
                <!-- Search Trigger Toggle -->
                <a href="javascript:void(0)" class="text-dark me-2" onclick="$('#search-dropdown').toggle()"><i class="fa-solid fa-magnifying-glass fs-5"></i></a>
                
                <?php if ($user): ?>
                    <!-- Profile dropdown -->
                    <div class="dropdown d-inline-block">
                        <button class="bg-transparent border-0 p-0 text-dark dropdown-toggle no-caret" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-user fs-5"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="/profile"><i class="fa-regular fa-id-card me-2 text-muted"></i> My Profile</a></li>
                            <li><a class="dropdown-item" href="/orders"><i class="fa-solid fa-box-open me-2 text-muted"></i> My Orders</a></li>
                            <li><a class="dropdown-item" href="/wallet"><i class="fa-solid fa-wallet me-2 text-muted"></i> Wallet (₹<?= number_format($user['balance'] ?? 0, 2) ?>)</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="/logout"><i class="fa-solid fa-sign-out-alt me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="/login" class="text-dark"><i class="fa-regular fa-user fs-5"></i></a>
                <?php endif; ?>
                
                <a href="/support" class="text-dark"><i class="fa-regular fa-heart fs-5"></i></a>
                
                <button class="bg-transparent border-0 p-0 text-dark position-relative" id="cart-trigger-btn">
                    <i class="fa-solid fa-bag-shopping fs-5"></i>
                    <span class="badge bg-danger rounded-circle position-absolute p-1" id="cart-count-badge" style="display: none; font-size: 0.52rem; top: -5px; right: -5px;">0</span>
                </button>
            </div>
        </div>
        
        <!-- Dropdown Search input -->
        <div class="container-xl py-2" id="search-dropdown" style="display: none; border-top: 1px solid #eee;">
            <form class="meesho-search-form w-100 max-width-none" id="search-form" method="GET" action="/">
                <i class="fa fa-search meesho-search-icon"></i>
                <input type="text" name="search" class="meesho-search-input" placeholder="Search by Keyword or Product ID..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            </form>
        </div>
    </header>

    <!-- Main Content Rendering -->
    <main>
        {{content}}
    </main>

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
            <div class="d-flex justify-content-between align-items-center mb-2" style="font-size: 0.85rem;">
                <span class="fw-semibold text-muted">Subtotal</span>
                <span class="fw-bold text-dark" id="cart-subtotal-display">₹0.00</span>
            </div>

            <!-- Coupon Apply Form -->
            <div class="mb-3 border-bottom pb-3">
                <label class="form-label text-uppercase fw-semibold text-muted" style="font-size: 0.65rem; letter-spacing: 0.5px;">B2B Coupon Code</label>
                <div class="input-group input-group-sm">
                    <input type="text" id="coupon-code-input" class="form-control" placeholder="e.g. WELCOMB2B" style="text-transform: uppercase;">
                    <button class="btn btn-outline-secondary" type="button" id="apply-coupon-btn" style="border-color: #482922; color: #482922;">Apply</button>
                </div>
                <div id="coupon-message" class="small mt-1" style="display: none; font-size: 0.75rem;"></div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-2 text-success" id="coupon-discount-row" style="display: none; font-size: 0.85rem;">
                <span class="fw-semibold">Discount (<span id="coupon-applied-code"></span>)</span>
                <span class="fw-bold" id="cart-discount-display">-₹0.00</span>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="fw-bold text-dark">Estimated Total</span>
                <span class="fs-4 fw-bold text-pink" id="cart-total-display" style="color: #482922;">₹0.00</span>
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
            $('#cart-trigger-btn, #cart-trigger-btn-mobile').on('click', function() {
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
                    $('#cart-count-badge, #cart-count-badge-mobile').hide();
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
                $('#cart-subtotal-display').text('₹' + parseFloat(res.subtotal).toLocaleString('en-IN', {minimumFractionDigits: 2}));
                
                if (res.discount > 0) {
                    $('#coupon-discount-row').show();
                    $('#coupon-applied-code').text(res.coupon_code);
                    $('#cart-discount-display').text('-₹' + parseFloat(res.discount).toLocaleString('en-IN', {minimumFractionDigits: 2}));
                    $('#coupon-message').text('Coupon applied successfully!').removeClass('text-danger').addClass('text-success').show();
                    $('#coupon-code-input').val(res.coupon_code);
                } else {
                    $('#coupon-discount-row').hide();
                    $('#coupon-message').hide();
                }

                $('#cart-total-display').text('₹' + parseFloat(res.total).toLocaleString('en-IN', {minimumFractionDigits: 2}));
                $('#cart-drawer-footer').show();
                
                // Set Badge count
                const count = res.items.reduce((sum, item) => sum + parseInt(item.quantity), 0);
                $('#cart-count-badge, #cart-count-badge-mobile').text(count).show();
            }

            // Apply Coupon click event
            $('#apply-coupon-btn').on('click', function() {
                const code = $('#coupon-code-input').val().trim();
                const subtotalDisplay = $('#cart-subtotal-display').text().replace(/[^\d.]/g, '');
                const subtotal = parseFloat(subtotalDisplay) || 0;

                if (code === '') {
                    $('#coupon-message').text('Please enter a coupon code.').removeClass('text-success').addClass('text-danger').show();
                    return;
                }

                $.ajax({
                    url: '/cart/coupon',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ code: code, subtotal: subtotal }),
                    dataType: 'json',
                    success: function(res) {
                        if (res.success) {
                            loadCartItems();
                        } else {
                            $('#coupon-message').text(res.error || 'Failed to apply coupon.').removeClass('text-success').addClass('text-danger').show();
                        }
                    },
                    error: function(xhr) {
                        const err = xhr.responseJSON ? xhr.responseJSON.error : 'Invalid coupon code or minimum cart value constraint.';
                        $('#coupon-message').text(err).removeClass('text-success').addClass('text-danger').show();
                    }
                });
            });

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

            // Scrolled sticky header animation
            $(window).on('scroll', function() {
                if ($(window).scrollTop() > 30) {
                    $('.meesho-header').addClass('scrolled');
                } else {
                    $('.meesho-header').removeClass('scrolled');
                }
            });

            // Scroll Intersection Observer for fading-in product cards
            if ('IntersectionObserver' in window) {
                const cardObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            $(entry.target).addClass('visible');
                        }
                    });
                }, { threshold: 0.05 });

                // Bind observer to existing and future minimal cards
                $(document).find('.meesho-product-card.minimal').each(function() {
                    cardObserver.observe(this);
                });
            }

            // Global Toast Notification Helper
            window.showToast = function(msg) {
                $('#toast-message').text(msg);
                const toastEl = document.getElementById('app-toast');
                if (toastEl && window.bootstrap) {
                    const toast = window.bootstrap.Toast.getOrCreateInstance(toastEl);
                    toast.show();
                } else {
                    alert(msg);
                }
            };
        });
    </script>
    
    <!-- Toast Notification Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 2000;">
        <div id="app-toast" class="toast align-items-center text-white bg-dark border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toast-message"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    
    <!-- ═══════════ NISHORAMA PREMIUM FOOTER ═══════════ -->
    <footer class="nisho-footer">
        <div class="container">
            <div class="row g-4">
                <!-- About Column -->
                <div class="col-lg-3 col-md-6">
                    <a href="/" class="nisho-logo d-inline-block mb-3" style="font-size: 2rem; color: #FFF !important;">प</a>
                    <p style="font-size: 0.82rem; line-height: 1.8; color: rgba(255,255,255,0.4);">India's premier wholesale saree marketplace. Weaver-direct GI-tagged handlooms for discerning retailers.</p>
                    <div class="nisho-footer-social mt-3">
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h5>Quick Links</h5>
                    <a href="/">New Arrivals</a>
                    <a href="/?category=Banarasi+Brocade">Banarasi</a>
                    <a href="/?category=Kanjeevaram+Silk">Kanjeevaram</a>
                    <a href="/?category=Patola+Silk">Patola</a>
                    <a href="/?category=Organza+Silk">Organza</a>
                </div>
                <!-- Help -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h5>Help & Support</h5>
                    <a href="/support">Contact Us</a>
                    <a href="/orders">Track Order</a>
                    <a href="/about-us">About Us</a>
                    <a href="/support">FAQs</a>
                    <a href="/about-us">Size Guide</a>
                </div>
                <!-- Policies -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h5>Policies</h5>
                    <a href="/about-us">Shipping Info</a>
                    <a href="/about-us">Returns & Refunds</a>
                    <a href="/about-us">Privacy Policy</a>
                    <a href="/about-us">Terms of Service</a>
                </div>
                <!-- Wholesale Info -->
                <div class="col-lg-3 col-md-6">
                    <h5>Wholesale Enquiry</h5>
                    <p style="font-size: 0.82rem; line-height: 1.8; color: rgba(255,255,255,0.4);">Minimum order: 5 pieces per design. Bulk discounts available for orders of 50+ pieces.</p>
                    <div class="d-flex gap-2 mt-3 flex-wrap">
                        <span style="font-size: 1.4rem; color: rgba(255,255,255,0.3);"><i class="fa-brands fa-cc-visa"></i></span>
                        <span style="font-size: 1.4rem; color: rgba(255,255,255,0.3);"><i class="fa-brands fa-cc-mastercard"></i></span>
                        <span style="font-size: 1.4rem; color: rgba(255,255,255,0.3);"><i class="fa-brands fa-google-pay"></i></span>
                        <span style="font-size: 1.4rem; color: rgba(255,255,255,0.3);"><i class="fa-brands fa-cc-amex"></i></span>
                    </div>
                </div>
            </div>
            <!-- Footer Bottom -->
            <div class="nisho-footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center">
                <span>© 2026 Pavitra Wholesale Sarees. All Rights Reserved.</span>
                <span class="mt-2 mt-md-0">Crafted with ❤️ for Indian Handloom Heritage</span>
            </div>
        </div>
    </footer>

    <!-- Nishorama-Style Mobile Bottom Navigation Bar -->
    <div class="meesho-mobile-nav">
        <a href="/" class="mobile-nav-item <?= $_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '' ? 'active' : '' ?>">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>
        <a href="/about-us" class="mobile-nav-item <?= str_contains($_SERVER['REQUEST_URI'], '/about-us') ? 'active' : '' ?>">
            <i class="fa-solid fa-border-all"></i>
            <span>Categories</span>
        </a>
        <a href="/support" class="mobile-nav-item <?= str_contains($_SERVER['REQUEST_URI'], '/support') ? 'active' : '' ?>">
            <i class="fa-solid fa-heart"></i>
            <span>Wishlist</span>
        </a>
        <a href="/profile" class="mobile-nav-item <?= str_contains($_SERVER['REQUEST_URI'], '/profile') ? 'active' : '' ?>">
            <i class="fa-solid fa-user"></i>
            <span>Account</span>
        </a>
    </div>
    
</body>
</html>
