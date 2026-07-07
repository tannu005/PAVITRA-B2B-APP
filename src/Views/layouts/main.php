<?php
use Core\Application;
$user = Application::$app->getSessionUser();
$config = Application::$app->config;
$csrfToken = Application::$app->getCsrfToken();
$pageTitle = htmlspecialchars($params['title'] ?? $config['company_name'] ?? 'Pavitra Designer');
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
    <meta name="theme-color" content="#6B1D1D">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>">
    <meta property="og:title" content="<?= $pageTitle ?>">
    <meta property="og:description" content="<?= $pageDescription ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= htmlspecialchars($config['brand_name'] ?? 'Pavitra Designer') ?>">
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
    <title><?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Italiana&family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&family=Cinzel:wght@400;600;700&family=Rozha+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= Application::assetUrl('/assets/css/meesho.css?v=' . time()) ?>">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        window.__CSRF_TOKEN__ = <?= json_encode($csrfToken) ?>;
        $.ajaxSetup({
            headers: { 'X-CSRF-Token': window.__CSRF_TOKEN__ }
        });
    </script>
    <script>
        if (navigator.userAgent.indexOf('PavitraB2B-Android-APK') > -1) {
            document.documentElement.classList.add('android-apk');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
</head>
<body>

    <div class="py-2 hide-on-mobile text-center" style="background-color: #F8F9FA; border-bottom: 1px solid #ECEFF1; color: #555;">
        ⚡ Lowest Prices • Free Shipping on Bulk Orders • Weaver-Direct Verified Quality
    </div>

    <header class="meesho-mobile-header">
        <div class="mobile-header-top-row">
            <div class="d-flex align-items-center">
                <a class="text-dark me-3" data-bs-toggle="modal" href="#qrScannerModal" role="button" title="Scan Saree QR">
                    <i class="fa-solid fa-qrcode fs-5"></i>
                </a>
                <?php if ($_SERVER['REQUEST_URI'] !== '/' && $_SERVER['REQUEST_URI'] !== '' && !str_contains($_SERVER['REQUEST_URI'], '?category') && !str_contains($_SERVER['REQUEST_URI'], 'catalog')): ?>
                    <a href="javascript:history.back()" class="mobile-header-back-arrow" style="margin-right:10px;">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                <?php else: ?>
                    <a href="/" class="nisho-logo" style="margin-right: 10px; text-decoration: none;">
                        <svg viewBox="0 0 180 45" width="110" height="32" xmlns="http://www.w3.org/2000/svg" class="pavitra-logo-svg" style="display: block;">
                            <path d="M 6 30 L 52 30" stroke="#7A4B30" stroke-width="3" stroke-linecap="round" />
                            <circle cx="14" cy="30" r="0.8" fill="#FFEAA7" />
                            <circle cx="20" cy="30" r="0.8" fill="#FFEAA7" />
                            <circle cx="26" cy="30" r="0.8" fill="#FFEAA7" />
                            <circle cx="32" cy="30" r="0.8" fill="#FFEAA7" />
                            <circle cx="38" cy="30" r="0.8" fill="#FFEAA7" />
                            
                            <path d="M 12 30 C 8 16, 18 4, 36 4 C 22 10, 16 18, 18 30 Z" fill="#E84118" />
                            <path d="M 20 30 C 16 18, 24 8, 40 8 C 28 13, 24 20, 26 30 Z" fill="#4CD137" />
                            <path d="M 28 30 C 24 20, 30 12, 44 12 C 34 16, 32 22, 34 30 Z" fill="#0097E6" />
                            
                            <path d="M 50 30 C 40 18, 38 10, 45 6 C 47 8, 49 14, 50 30" fill="none" stroke="#C5A059" stroke-width="0.8" />
                            <path d="M 50 30 C 60 18, 62 10, 55 6 C 53 8, 51 14, 50 30" fill="none" stroke="#C5A059" stroke-width="0.8" />
                            <path d="M 50 29 C 44 18, 44 12, 50 8 C 56 12, 56 18, 50 29 Z" fill="#C5A059" />
                            <path d="M 50 28 C 46 19, 46 14, 50 11 C 54 14, 54 19, 50 28 Z" fill="#009432" />
                            <circle cx="50" cy="18" r="2.5" fill="#0652DD" />
                            <circle cx="50" cy="18" r="1.2" fill="#12CBC4" />
                            
                            <text x="62" y="23" font-family="'Rozha One', serif" font-size="20" font-weight="700" fill="#282c3f">पवित्रा</text>
                            <text x="62" y="34" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="700" fill="#d5a249" letter-spacing="0.5">DESIGNER</text>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>


            <div class="mobile-header-icons d-flex align-items-center gap-3">
                <a href="javascript:void(0)" class="position-relative text-dark" title="Notifications" data-bs-toggle="modal" data-bs-target="#notificationsModal">
                    <i class="fa-regular fa-bell fs-5"></i>
                    <span class="badge bg-danger rounded-circle position-absolute p-0 style-badge" style="width: 14px; height: 14px; font-size: 0.52rem; top: -5px; right: -5px; line-height: 14px; text-align: center;">1</span>
                </a>
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
                    <i class="fa-solid fa-microphone voice-search-btn" title="Voice Search" style="cursor:pointer;"></i>
                    <i class="fa-solid fa-camera camera-search-btn ms-2" title="Search by Image" style="cursor:pointer;"></i>
                </div>
            </form>
        </div>
    </header>

    <header class="meesho-header py-2">
        <div class="container-xl d-flex align-items-center justify-content-between">
            <a href="/" class="nisho-logo" style="text-decoration: none;">
                <svg viewBox="0 0 180 45" width="130" height="38" xmlns="http://www.w3.org/2000/svg" class="pavitra-logo-svg" style="display: block;">
                    <path d="M 6 30 L 52 30" stroke="#7A4B30" stroke-width="3" stroke-linecap="round" />
                    <circle cx="14" cy="30" r="0.8" fill="#FFEAA7" />
                    <circle cx="20" cy="30" r="0.8" fill="#FFEAA7" />
                    <circle cx="26" cy="30" r="0.8" fill="#FFEAA7" />
                    <circle cx="32" cy="30" r="0.8" fill="#FFEAA7" />
                    <circle cx="38" cy="30" r="0.8" fill="#FFEAA7" />
                    
                    <path d="M 12 30 C 8 16, 18 4, 36 4 C 22 10, 16 18, 18 30 Z" fill="#E84118" />
                    <path d="M 20 30 C 16 18, 24 8, 40 8 C 28 13, 24 20, 26 30 Z" fill="#4CD137" />
                    <path d="M 28 30 C 24 20, 30 12, 44 12 C 34 16, 32 22, 34 30 Z" fill="#0097E6" />
                    
                    <path d="M 50 30 C 40 18, 38 10, 45 6 C 47 8, 49 14, 50 30" fill="none" stroke="#C5A059" stroke-width="0.8" />
                    <path d="M 50 30 C 60 18, 62 10, 55 6 C 53 8, 51 14, 50 30" fill="none" stroke="#C5A059" stroke-width="0.8" />
                    <path d="M 50 29 C 44 18, 44 12, 50 8 C 56 12, 56 18, 50 29 Z" fill="#C5A059" />
                    <path d="M 50 28 C 46 19, 46 14, 50 11 C 54 14, 54 19, 50 28 Z" fill="#009432" />
                    <circle cx="50" cy="18" r="2.5" fill="#0652DD" />
                    <circle cx="50" cy="18" r="1.2" fill="#12CBC4" />
                    
                    <text x="62" y="23" font-family="'Rozha One', serif" font-size="20" font-weight="700" fill="#282c3f">पवित्रा</text>
                    <text x="62" y="34" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="700" fill="#d5a249" letter-spacing="0.5">DESIGNER</text>
                </svg>
            </a>

            <div class="nisho-desktop-menu d-flex flex-column align-items-center gap-1">
                <div class="menu-row-1 d-flex gap-4">
                    <a href="/?category=Organza+Silk" class="nisho-menu-link">Pavitra MUSE</a>
                    <a href="/?sort=price_high" class="nisho-menu-link">MOST WANTED</a>
                    <a href="/?sort=newest" class="nisho-menu-link">NEW ARRIVALS</a>
                    <a href="/?all_sarees=true" class="nisho-menu-link">ALL SAREES</a>
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
                            <li><a class="dropdown-item py-2 fw-semibold text-uppercase" href="/?category=Kanjeevaram+Silk" style="font-size: 0.8rem; color: #482922; letter-spacing: 0.05em;">Pavitra OFFICE-SS1</a></li>
                            <li><a class="dropdown-item py-2 fw-semibold text-uppercase" href="/?category=Patola+Silk" style="font-size: 0.8rem; color: #482922; letter-spacing: 0.05em;">PavitraHAVELI - SS2</a></li>
                            <li><a class="dropdown-item py-2 fw-semibold text-uppercase" href="/?category=Mysore+Crepe+Silk" style="font-size: 0.8rem; color: #482922; letter-spacing: 0.05em;">DESI ROMANCE</a></li>
                            <li><a class="dropdown-item py-2 fw-semibold text-uppercase" href="/?category=Chanderi+Weave" style="font-size: 0.8rem; color: #482922; letter-spacing: 0.05em;">SHAADI KA GHAR</a></li>
                            <li><a class="dropdown-item py-2 fw-semibold text-uppercase" href="/?category=Jamdani+Muslin" style="font-size: 0.8rem; color: #482922; letter-spacing: 0.05em;">JEANS & JHUMKA</a></li>
                        </ul>
                    </div>
                    <a href="/?sort=price_low" class="text-danger fw-bold nisho-menu-link" style="color: #dc3545 !important;">GOODBYE DEALS ;)</a>
                    <a href="/customization" class="fw-bold nisho-menu-link text-uppercase" style="color: var(--premium-gold-dark) !important; border-bottom: 1.5px dashed var(--premium-gold-dark);">Custom Studio</a>
                </div>
            </div>

            <div class="meesho-nav-items gap-3 align-items-center">
                <a href="javascript:void(0)" class="text-dark me-2" onclick="$('#search-dropdown').toggle()"><i class="fa-solid fa-magnifying-glass fs-5"></i></a>
                
                <?php if ($user): ?>
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
                
                <a href="javascript:void(0)" class="position-relative text-dark me-1" title="Notifications" data-bs-toggle="modal" data-bs-target="#notificationsModal">
                    <i class="fa-regular fa-bell fs-5"></i>
                    <span class="badge bg-danger rounded-circle position-absolute p-0" style="width: 14px; height: 14px; font-size: 0.52rem; top: -5px; right: -5px; line-height: 14px; text-align: center;">1</span>
                </a>
                
                <a href="/wishlist" class="text-dark" title="My Wishlist"><i class="fa-regular fa-heart fs-5"></i></a>
                
                <button class="bg-transparent border-0 p-0 text-dark position-relative" id="cart-trigger-btn">
                    <i class="fa-solid fa-bag-shopping fs-5"></i>
                    <span class="badge bg-danger rounded-circle position-absolute p-1" id="cart-count-badge" style="display: none; font-size: 0.52rem; top: -5px; right: -5px;">0</span>
                </button>
            </div>
        </div>
        
        <div class="container-xl py-2" id="search-dropdown" style="display: none; border-top: 1px solid #eee;">
            <form class="meesho-search-form w-100 max-width-none position-relative" id="search-form" method="GET" action="/">
                <i class="fa fa-search meesho-search-icon"></i>
                <input type="text" name="search" class="meesho-search-input" placeholder="Search by Keyword or Product ID..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                <div class="meesho-mobile-search-right-icons" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); display: flex; align-items: center; gap: 12px; cursor: pointer; color: var(--premium-dark-muted); z-index: 10 !important; pointer-events: auto !important;">
                    <i class="fa-solid fa-microphone voice-search-btn" title="Voice Search"></i>
                    <i class="fa-solid fa-camera camera-search-btn" title="Search by Image"></i>
                </div>
            </form>
        </div>
    </header>

    <main>
        {{content}}
    </main>

    <div class="cart-drawer-backdrop" id="cart-backdrop"></div>
    <div class="cart-drawer" id="cart-drawer-box">
        <div class="p-4 d-flex justify-between align-items-center border-bottom">
            <h5 class="m-0 fw-bold">Wholesale Cart</h5>
            <button class="btn btn-close p-0" id="cart-close-btn"></button>
        </div>
        <div class="flex-grow-1 overflow-auto p-4" id="cart-drawer-items">
        </div>
        <div class="p-4 border-top" id="cart-drawer-footer" style="display: none;">
            <div class="d-flex justify-content-between align-items-center mb-2" style="font-size: 0.85rem;">
                <span class="fw-semibold text-muted">Subtotal</span>
                <span class="fw-bold text-dark" id="cart-subtotal-display">₹0.00</span>
            </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
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

            function loadCartItems() {
                $.ajax({
                    url: '/cart',
                    method: 'GET',
                    dataType: 'json',
                    cache: false,
                    success: function(res) {
                        renderCart(res);
                    },
                    error: function() {
                        $('#cart-drawer-items').html('<p class="text-danger text-center">Failed to load cart items.</p>');
                    }
                });
            }

            function renderCart(res) {
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
                
                const count = res.items.reduce((sum, item) => sum + parseInt(item.quantity), 0);
                $('#cart-count-badge, #cart-count-badge-mobile').text(count).show();
            }

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

            $.ajax({
                url: '/cart',
                method: 'GET',
                dataType: 'json',
                cache: false,
                success: function(res) {
                    if (res.items && res.items.length > 0) {
                        const count = res.items.reduce((sum, item) => sum + parseInt(item.quantity), 0);
                        $('#cart-count-badge').text(count).show();
                    }
                }
            });

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

            $(window).on('scroll', function() {
                if ($(window).scrollTop() > 30) {
                    $('.meesho-header').addClass('scrolled');
                } else {
                    $('.meesho-header').removeClass('scrolled');
                }
            });

            if ('IntersectionObserver' in window) {
                const cardObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            $(entry.target).addClass('visible');
                        }
                    });
                }, { threshold: 0.05 });

                $(document).find('.meesho-product-card.minimal').each(function() {
                    cardObserver.observe(this);
                });
            }

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
    
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 2000;">
        <div id="app-toast" class="toast align-items-center text-white bg-dark border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toast-message"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="cameraSearchModal" tabindex="-1" aria-hidden="true" style="backdrop-filter: blur(10px); background-color: rgba(0, 0, 0, 0.65);">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; background-color: #FFFDF8; overflow: hidden;">
                <div class="modal-header border-0 pb-2" style="background-color: var(--premium-light-bg); padding: 1.25rem;">
                    <h5 class="modal-title fw-bold" style="font-family: var(--font-headings); color: var(--meesho-pink);"><i class="fa-solid fa-camera me-2" style="color: var(--premium-gold);"></i>Saree Image Matcher</h5>
                    <button type="button" class="btn-close" id="btn-close-scanner-modal" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <p class="small text-muted mb-3">Snap a photo of a saree pattern or color to scan and search our weaver looms.</p>
                    
                    <div class="scanner-container position-relative overflow-hidden mb-3 bg-dark d-flex align-items-center justify-content-center" style="height: 280px; border-radius: 12px; border: 2px solid var(--premium-gold);">
                        <video id="scanner-video" autoplay playsinline style="width: 100%; height: 100%; object-fit: cover; display: none;"></video>
                        <div class="scanner-laser" style="display: none; position: absolute; top: 0; left: 0; width: 100%; height: 3px; background-color: #e74c3c; box-shadow: 0 0 10px #e74c3c; z-index: 10; animation: scanAnimation 2s linear infinite;"></div>
                        <div class="scanner-reticle" style="position: absolute; width: 180px; height: 180px; border: 2px dashed rgba(201, 151, 46, 0.5); border-radius: 8px; z-index: 5;"></div>
                        
                        <div id="scanner-cta" class="text-white p-3 z-3">
                            <i class="fa-solid fa-camera fa-3x mb-3 text-warning" style="color: var(--premium-gold) !important;"></i>
                            <h6 class="fw-bold">Camera Access Required</h6>
                            <p style="font-size: 0.72rem; color: rgba(255, 255, 255, 0.7);">Allow browser camera access or upload an image file from your gallery.</p>
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <button type="button" class="btn btn-sm btn-outline-light rounded-0 px-3" id="btn-start-camera">Use Camera</button>
                                <label class="btn btn-sm btn-warning rounded-0 px-3 text-dark mb-0" style="background-color: var(--premium-gold); border-color: var(--premium-gold); cursor:pointer;">
                                    Upload File
                                    <input type="file" id="scanner-file-input" accept="image/*" style="display:none;">
                                </label>
                            </div>
                        </div>
                        
                        <div id="scanner-loading" class="position-absolute w-100 h-100 top-0 left-0 bg-dark bg-opacity-75 d-flex flex-column align-items-center justify-content-center text-white" style="display: none; z-index: 15;">
                            <div class="spinner-border text-warning mb-3" style="color: var(--premium-gold) !important;" role="status"></div>
                            <h6 class="fw-bold mb-1" id="scanner-loading-text">Analyzing weaves...</h6>
                            <p style="font-size: 0.65rem; color: rgba(255,255,255,0.7);">Matching textures and color spectrums</p>
                        </div>
                    </div>
                    
                    <div id="scanner-camera-controls" style="display: none;">
                        <button type="button" class="btn btn-meesho-pink px-4 py-2 text-uppercase fw-bold rounded-0" style="font-size:0.75rem; letter-spacing:0.05em;" id="btn-capture-match">Capture & Match</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="nisho-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <a href="/" class="nisho-logo d-inline-block mb-3">
                        <svg viewBox="0 0 180 45" width="130" height="38" xmlns="http://www.w3.org/2000/svg" class="pavitra-logo-svg" style="display: block;">
                            <path d="M 6 30 L 52 30" stroke="#7A4B30" stroke-width="3" stroke-linecap="round" />
                            <circle cx="14" cy="30" r="0.8" fill="#FFEAA7" />
                            <circle cx="20" cy="30" r="0.8" fill="#FFEAA7" />
                            <circle cx="26" cy="30" r="0.8" fill="#FFEAA7" />
                            <circle cx="32" cy="30" r="0.8" fill="#FFEAA7" />
                            <circle cx="38" cy="30" r="0.8" fill="#FFEAA7" />
                            
                            <path d="M 12 30 C 8 16, 18 4, 36 4 C 22 10, 16 18, 18 30 Z" fill="#E84118" />
                            <path d="M 20 30 C 16 18, 24 8, 40 8 C 28 13, 24 20, 26 30 Z" fill="#4CD137" />
                            <path d="M 28 30 C 24 20, 30 12, 44 12 C 34 16, 32 22, 34 30 Z" fill="#0097E6" />
                            
                            <path d="M 50 30 C 40 18, 38 10, 45 6 C 47 8, 49 14, 50 30" fill="none" stroke="#C5A059" stroke-width="0.8" />
                            <path d="M 50 30 C 60 18, 62 10, 55 6 C 53 8, 51 14, 50 30" fill="none" stroke="#C5A059" stroke-width="0.8" />
                            <path d="M 50 29 C 44 18, 44 12, 50 8 C 56 12, 56 18, 50 29 Z" fill="#C5A059" />
                            <path d="M 50 28 C 46 19, 46 14, 50 11 C 54 14, 54 19, 50 28 Z" fill="#009432" />
                            <circle cx="50" cy="18" r="2.5" fill="#0652DD" />
                            <circle cx="50" cy="18" r="1.2" fill="#12CBC4" />
                            
                            <text x="62" y="23" font-family="'Rozha One', serif" font-size="20" font-weight="700" fill="#ffffff">पवित्रा</text>
                            <text x="62" y="34" font-family="'Plus Jakarta Sans', sans-serif" font-size="7.5" font-weight="700" fill="#d5a249" letter-spacing="0.5">Designer Saree</text>
                        </svg>
                    </a>
                    <p style="font-size: 0.82rem; line-height: 1.8; color: rgba(255,255,255,0.4);">India's premier wholesale saree marketplace. Weaver-direct GI-tagged handlooms for discerning retailers.</p>
                    <div class="nisho-footer-social mt-3">
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                    <h5>Quick Links</h5>
                    <a href="/catalog?sort=newest">New Arrivals</a>
                    <a href="/catalog?category=Banarasi+Brocade">Banarasi</a>
                    <a href="/catalog?category=Kanjeevaram+Silk">Kanjeevaram</a>
                    <a href="/catalog?category=Patola+Silk">Patola</a>
                    <a href="/catalog?category=Organza+Silk">Organza</a>
                </div>
                <div class="col-lg-2 col-md-6 col-6 d-none d-lg-block">
                    <h5>Help & Support</h5>
                    <a href="/support">Contact Us</a>
                    <a href="/orders">Track Order</a>
                    <a href="/about-us">About Us</a>
                    <a href="/support">FAQs</a>
                    <a href="/about-us">Size Guide</a>
                </div>
                <div class="col-lg-2 col-md-6 col-6 d-none d-lg-block">
                    <h5>Policies</h5>
                    <a href="/about-us">Shipping Info</a>
                    <a href="/about-us">Returns & Refunds</a>
                    <a href="/about-us">Privacy Policy</a>
                    <a href="/about-us">Terms of Service</a>
                </div>
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
            <div class="nisho-footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center">
                <span>© 2026 Pavitra Designer. All Rights Reserved.</span>
                <span class="mt-2 mt-md-0">Crafted with ❤️ for Indian Handloom Heritage</span>
            </div>
        </div>
    </footer>

    <div class="meesho-mobile-nav">
        <a href="/" class="mobile-nav-item <?= $_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '' ? 'active' : '' ?>">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>
        <a href="/categories" class="mobile-nav-item <?= str_contains($_SERVER['REQUEST_URI'], '/categories') ? 'active' : '' ?>">
            <i class="fa-solid fa-border-all"></i>
            <span>Categories</span>
        </a>
        <a href="/wishlist" class="mobile-nav-item <?= str_contains($_SERVER['REQUEST_URI'], '/wishlist') ? 'active' : '' ?>">
            <i class="fa-solid fa-heart"></i>
            <span>Wishlist</span>
        </a>
        <a href="/profile" class="mobile-nav-item <?= str_contains($_SERVER['REQUEST_URI'], '/profile') ? 'active' : '' ?>">
            <i class="fa-solid fa-user"></i>
            <span>Account</span>
        </a>
    </div>


    <script>
        $(document).ready(function() {
            var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            if (SpeechRecognition) {
                var recognition = new SpeechRecognition();
                recognition.continuous = false;
                recognition.lang = 'en-IN'; // set to Indian English accents
                recognition.interimResults = false;
                recognition.maxAlternatives = 1;

                $('.voice-search-btn').on('click', function() {
                    var btn = $(this);
                    btn.addClass('text-danger animate-pulse').css('animation', 'nishoPulse 1s infinite');
                    window.showToast("Listening... Speak now!");
                    recognition.start();
                });

                recognition.onresult = function(event) {
                    var transcript = event.results[0][0].transcript;
                    $('.meesho-mobile-search-input, .meesho-search-input').val(transcript);
                    window.showToast("Voice matched: " + transcript);
                    setTimeout(function() {
                        $('#search-form-mobile, #search-form').submit();
                    }, 800);
                };

                recognition.onspeechend = function() {
                    recognition.stop();
                };

                recognition.onerror = function(event) {
                    $('.voice-search-btn').removeClass('text-danger animate-pulse').css('animation', 'none');
                    window.showToast("Voice search error: " + event.error);
                };

                recognition.onend = function() {
                    $('.voice-search-btn').removeClass('text-danger animate-pulse').css('animation', 'none');
                };
            } else {
                $('.voice-search-btn').on('click', function() {
                    window.showToast("Voice search not supported in this browser.");
                });
            }

            var stream = null;
            
            function startScannerCamera() {
                if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
                    .then(function(s) {
                        stream = s;
                        var video = document.getElementById('scanner-video');
                        video.srcObject = stream;
                        video.style.display = 'block';
                        $('.scanner-laser').show();
                        $('.scanner-reticle').show();
                        $('#scanner-cta').hide();
                        $('#scanner-camera-controls').show();
                    })
                    .catch(function(err) {
                        $('#scanner-video').hide();
                        $('.scanner-laser').hide();
                        $('.scanner-reticle').hide();
                        $('#scanner-cta').show();
                        $('#scanner-camera-controls').hide();
                        window.showToast("Camera access error: " + err.message);
                    });
                } else {
                    $('#scanner-video').hide();
                    $('.scanner-laser').hide();
                    $('.scanner-reticle').hide();
                    $('#scanner-cta').show();
                    $('#scanner-camera-controls').hide();
                }
            }

            $('.camera-search-btn').on('click', function(e) {
                e.preventDefault();
                if (window.bootstrap) {
                    bootstrap.Modal.getOrCreateInstance(document.getElementById('cameraSearchModal')).show();
                } else {
                    $('#cameraSearchModal').modal('show');
                }
            });

            $('#cameraSearchModal').on('shown.bs.modal', function () {
                startScannerCamera();
            });

            $('#btn-start-camera').on('click', function() {
                startScannerCamera();
            });

            $('#scanner-file-input').on('change', function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        localStorage.setItem('captured_saree_pattern', e.target.result);
                    };
                    reader.readAsDataURL(file);
                    
                    startScanSimulation("Analyzing Pattern Motifs...");
                }
            });

            $('#btn-capture-match').on('click', function() {
                var video = document.getElementById('scanner-video');
                if (video && stream) {
                    try {
                        var canvas = document.createElement('canvas');
                        canvas.width = video.videoWidth || 640;
                        canvas.height = video.videoHeight || 480;
                        var ctx = canvas.getContext('2d');
                        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                        var dataURL = canvas.toDataURL('image/jpeg');
                        localStorage.setItem('captured_saree_pattern', dataURL);
                    } catch (e) {
                        console.log("Canvas capture failed: " + e.message);
                    }
                }
                startScanSimulation("Matching Weaver Colors...");
            });

            function startScanSimulation(text) {
                $('#scanner-video').hide();
                $('#scanner-cta').hide();
                $('#scanner-camera-controls').hide();
                $('.scanner-laser').hide();
                $('.scanner-reticle').hide();
                
                $('#scanner-loading-text').text(text);
                $('#scanner-loading').css('display', 'flex'); // Show analyzing overlay cleanly
                
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                    stream = null;
                }
                
                setTimeout(function() {
                    var categories = ["Banarasi Brocade", "Kanjeevaram Silk", "Patola Silk", "Organza Silk", "Mysore Crepe Silk", "Jamdani Muslin"];
                    var matchedCategory = categories[Math.floor(Math.random() * categories.length)];
                    
                    window.showToast("Loom match: " + matchedCategory + " found!");
                    
                    setTimeout(function() {
                        window.location.href = "/?category=" + encodeURIComponent(matchedCategory);
                    }, 1000);
                }, 2500);
            }

            $('#cameraSearchModal').on('hidden.bs.modal', function () {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                    stream = null;
                }
                var video = document.getElementById('scanner-video');
                video.srcObject = null;
                video.style.display = 'none';
                $('.scanner-laser').hide();
                $('.scanner-reticle').hide();
                $('#scanner-cta').show();
                $('#scanner-camera-controls').hide();
                $('#scanner-loading').css('display', 'none');
            });


            $('#pavitra-edge-trigger-btn').on('click', function(e) {
                e.stopPropagation();
                $(this).fadeOut(150);
                $('#pavitra-edge-sidebar').addClass('open');
            });

            $('#pavitra-edge-close-btn').on('click', function(e) {
                e.stopPropagation();
                closeEdgePanel();
            });

            $(document).on('click', function(event) {
                if (!$(event.target).closest('#pavitra-edge-sidebar, #pavitra-edge-trigger-btn').length) {
                    closeEdgePanel();
                }
            });

            function closeEdgePanel() {
                $('#pavitra-edge-sidebar').removeClass('open');
                $('#pavitra-edge-trigger-btn').fadeIn(150);
            }

            $('#pavitra-edge-filter-btn').on('click', function(e) {
                e.stopPropagation();
                closeEdgePanel();
                const filterModalEl = document.getElementById('filtersModal');
                if (filterModalEl) {
                    if (window.bootstrap) {
                        bootstrap.Modal.getOrCreateInstance(filterModalEl).show();
                    } else {
                        $('#filtersModal').modal('show');
                    }
                } else {
                    window.location.href = '/?show_filters=true';
                }
            });

            $(window).trigger('scroll');
        });
    </script>


    <?php
        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        $isLandingPage = ($requestUri === '/' || $requestUri === '' || $requestUri === '/index.php');
        $isSellerPage = strpos($requestUri, '/seller') !== false;
        if (!$isLandingPage): 
    ?>
    <button class="pavitra-edge-trigger" id="pavitra-edge-trigger-btn" title="Quick Access Menu">
        <i class="fa-solid fa-chevron-left"></i>
    </button>

    <div class="pavitra-edge-panel" id="pavitra-edge-sidebar">
        <?php if ($isSellerPage): ?>
            <div class="pavitra-edge-item" data-bs-toggle="modal" data-bs-target="#chatbotModal" title="Ask Pavitra AI">
                <div class="pavitra-edge-icon-circle">
                    <i class="fa-solid fa-robot"></i>
                </div>
                <span>Chatbot</span>
            </div>
            
            <a href="/seller/products/bulk" class="pavitra-edge-item" title="Bulk Upload">
                <div class="pavitra-edge-icon-circle">
                    <i class="fa-solid fa-file-csv"></i>
                </div>
                <span>Upload</span>
            </a>
            
            <a href="https://wa.me/919876543210?text=Hello%20Pavitra%20B2B%20Support!%20I%20have%20a%20question%20about%20my%20saree%20bulk%20order." class="pavitra-edge-item" target="_blank" title="Chat on WhatsApp">
                <div class="pavitra-edge-icon-circle" style="background: linear-gradient(135deg, #25D366 0%, #128C7E 100%); color: #FFF; border-color: #128C7E;">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <span>WhatsApp</span>
            </a>
            
            <a href="/seller/orders" class="pavitra-edge-item" title="Order Management">
                <div class="pavitra-edge-icon-circle">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <span>Orders</span>
            </a>
        <?php else: ?>
            <a href="/customization" class="pavitra-edge-item" title="Saree Customization Studio">
                <div class="pavitra-edge-icon-circle">
                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                </div>
                <span>Custom</span>
            </a>

            <a href="https://wa.me/919876543210?text=Hello%20Pavitra%20B2B%20Support!%20I%20have%20a%20question%20about%20my%20saree%20bulk%20order." class="pavitra-edge-item" target="_blank" title="Chat on WhatsApp">
                <div class="pavitra-edge-icon-circle" style="background: linear-gradient(135deg, #25D366 0%, #128C7E 100%); color: #FFF; border-color: #128C7E;">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <span>WhatsApp</span>
            </a>

            <div class="pavitra-edge-item" id="pavitra-edge-filter-btn" title="Filter Products">
                <div class="pavitra-edge-icon-circle">
                    <i class="fa-solid fa-sliders"></i>
                </div>
                <span>Filters</span>
            </div>
            
            <div class="pavitra-edge-item" data-bs-toggle="modal" data-bs-target="#chatbotModal" title="Ask Pavitra AI">
                <div class="pavitra-edge-icon-circle">
                    <i class="fa-solid fa-robot"></i>
                </div>
                <span>Chatbot</span>
            </div>
        <?php endif; ?>

        <div class="pavitra-edge-close" id="pavitra-edge-close-btn" title="Close Menu">
            <i class="fa-solid fa-chevron-right"></i>
        </div>
    </div>
    <?php endif; ?>

    <div class="modal fade" id="qrScannerModal" tabindex="-1" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.9);">
        <div class="modal-dialog modal-fullscreen m-0">
            <div class="modal-content bg-transparent border-0 h-100">
                <div class="modal-header border-0 pt-4 px-4">
                    <a href="javascript:void(0)" class="text-white fs-4" data-bs-dismiss="modal" style="text-decoration:none;"><i class="fa-solid fa-arrow-left"></i></a>
                    <h6 class="modal-title text-white mx-auto fw-semibold" style="letter-spacing: 0.5px; opacity: 0; transition: opacity 0.3s;" id="qr-scan-title">Scan Saree QR</h6>
                    <a href="javascript:void(0)" class="text-white fs-4" style="text-decoration:none;"><i class="fa-regular fa-circle-question"></i></a>
                </div>
                <div class="modal-body d-flex flex-column align-items-center justify-content-center position-relative p-0 overflow-hidden">
                    
                    <div id="qr-scanner-viewfinder" class="position-relative" style="width: 280px; height: 280px; border-radius: 16px; overflow: hidden; display: none; margin-bottom: 20vh;">
                        <video id="qr-video" class="w-100 h-100 object-fit-cover" autoplay playsinline muted style="background-color: #222;"></video>
                        <div class="position-absolute top-0 start-0 border-top border-start" style="border-color: #FFD814 !important; width: 40px; height: 40px; border-width: 4px !important; border-top-left-radius: 16px;"></div>
                        <div class="position-absolute top-0 end-0 border-top border-end" style="border-color: #FFD814 !important; width: 40px; height: 40px; border-width: 4px !important; border-top-right-radius: 16px;"></div>
                        <div class="position-absolute bottom-0 start-0 border-bottom border-start" style="border-color: #FFD814 !important; width: 40px; height: 40px; border-width: 4px !important; border-bottom-left-radius: 16px;"></div>
                        <div class="position-absolute bottom-0 end-0 border-bottom border-end" style="border-color: #FFD814 !important; width: 40px; height: 40px; border-width: 4px !important; border-bottom-right-radius: 16px;"></div>
                        <div class="position-absolute w-100 shadow-sm" style="background-color: #FFD814; height: 2px; top: 0; left: 0; animation: scanline 2s linear infinite; box-shadow: 0 0 10px rgba(255,216,20,0.8);"></div>
                    </div>

                    <div id="qr-permission-prompt" class="bg-white p-4 shadow position-absolute w-100" style="bottom: 0; left: 0; right: 0; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold m-0" style="color: #111; font-size: 1.1rem;">Allow camera access to scan Saree QR code</h6>
                            <i class="fa-solid fa-xmark fs-5 text-muted" data-bs-dismiss="modal" style="cursor:pointer;"></i>
                        </div>
                        <p class="text-muted small mb-2" style="font-size: 0.9rem;">We use your camera so that you can:</p>
                        <ul class="text-muted small ps-3 mb-4" style="line-height: 1.8; font-size: 0.9rem;">
                            <li>Scan QR codes on physical saree tags to view details instantly</li>
                            <li>Quick-add scanned products directly to your wholesale cart</li>
                        </ul>
                        <div class="form-check mb-4 d-flex align-items-start gap-2">
                            <input class="form-check-input mt-1" type="checkbox" id="rememberCameraChoice" style="width: 1.2rem; height: 1.2rem;">
                            <label class="form-check-label text-muted small" for="rememberCameraChoice" style="font-size: 0.85rem; padding-top: 2px;">
                                Allow this Pavitra app to access your camera and skip this step in the future.
                            </label>
                        </div>
                        <p class="text-muted mb-4" style="font-size: 0.8rem;">
                            You can manage this access at any time in <a href="#" class="text-info text-decoration-none">permissions settings</a>.
                        </p>
                        <div class="d-flex gap-3">
                            <button type="button" class="btn btn-outline-secondary flex-fill py-2" data-bs-dismiss="modal" style="border-color: #ddd; color: #333;">Not now</button>
                            <button type="button" class="btn flex-fill fw-semibold py-2" id="qr-allow-access-btn" style="background-color: #FFD814; color: #111; border: 1px solid #FCD200;">Allow access</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="notificationsModal" tabindex="-1" aria-hidden="true" style="backdrop-filter: blur(5px); background-color: rgba(0, 0, 0, 0.4);">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; background-color: #FFFDF8;">
                <div class="modal-header border-0 pb-0" style="padding: 1.25rem 1.25rem 0.5rem 1.25rem;">
                    <h5 class="modal-title fw-bold d-flex align-items-center gap-2" style="font-family: var(--font-headings); color: #482922;">
                        <i class="fa-solid fa-bell" style="color: var(--premium-gold);"></i> Notifications
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="d-flex gap-3 p-3 bg-white border rounded-3 mb-2" style="border-color: #eaeaec !important;">
                        <div class="text-success"><i class="fa-solid fa-circle-check fs-4"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1" style="font-size: 0.85rem; color: #482922;">GSTIN Verified Successfully</h6>
                            <p class="text-muted mb-0" style="font-size: 0.75rem; line-height: 1.4;">Your composition trade profile has been approved. Active limit: ₹1,50,000 credit.</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 p-3 bg-white border rounded-3" style="border-color: #eaeaec !important;">
                        <div class="text-primary" style="color: var(--meesho-pink) !important;"><i class="fa-solid fa-truck fs-4"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1" style="font-size: 0.85rem; color: #482922;">New Banaras Loom Alert</h6>
                            <p class="text-muted mb-0" style="font-size: 0.75rem; line-height: 1.4;">Weaver direct Katan Silk collection has been updated in your area.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebarMenu" aria-labelledby="mobileSidebarMenuLabel" style="width: 280px; border-right: none;">
        <div class="offcanvas-header" style="background-color: #FDFBF7; border-bottom: 1px solid #ECEFF1;">
            <h5 class="offcanvas-title" id="mobileSidebarMenuLabel" style="font-family: 'Rozha One', serif; font-size: 1.3rem; color: #482922;">पवित्रा</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="list-group list-group-flush rounded-0">
                <a href="/customization" class="list-group-item list-group-item-action py-3 border-0" style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 500;">
                    <i class="fa-solid fa-wand-magic-sparkles me-3" style="color: var(--meesho-pink);"></i> Custom
                </a>
                
                <a href="/?show_filters=true" class="list-group-item list-group-item-action py-3 border-0" style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 500;">
                    <i class="fa-solid fa-sliders me-3" style="color: var(--meesho-pink);"></i> Filters
                </a>
                
                <a href="#" data-bs-toggle="modal" data-bs-target="#chatbotModal" class="list-group-item list-group-item-action py-3 border-0" style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 500;">
                    <i class="fa-solid fa-robot me-3 text-primary"></i> Ask Pavitra AI (Chatbot)
                </a>

                <div class="border-top my-2"></div>
                
                <a href="https://wa.me/919876543210" class="list-group-item list-group-item-action py-3 border-0 text-success" style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 500;">
                    <i class="fa-brands fa-whatsapp me-3 fs-5"></i> WhatsApp Support
                </a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="chatbotModal" tabindex="-1" aria-labelledby="chatbotModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; background-color: #FFFDF8;">
                <div class="modal-header border-0 pb-0" style="padding: 1.25rem 1.25rem 0.5rem 1.25rem; background-color: var(--premium-gold); color: white; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                    <h5 class="modal-title fw-bold d-flex align-items-center gap-2" style="font-family: 'Rozha One', serif; color: #482922;">
                        <i class="fa-solid fa-robot"></i> Pavitra AI Assistant
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0 d-flex flex-column" style="height: 400px; max-height: 70vh;">
                    <div id="chatbot-messages" class="flex-grow-1 p-3" style="overflow-y: auto; background-color: #F8F9FA;">
                        <div class="d-flex mb-3">
                            <div class="me-2 mt-auto mb-1">
                                <div class="d-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, var(--premium-gold), #8B5A2B);">
                                    <i class="fa-solid fa-robot text-white" style="font-size: 0.8rem;"></i>
                                </div>
                            </div>
                            <div class="bg-white p-3 shadow-sm border" style="font-size: 0.9rem; max-width: 80%; border-radius: 16px 16px 16px 0px !important; border-color: #E2E8F0 !important;">
                                <h6 class="fw-bold mb-2" style="color: #482922;"><i class="fa-solid fa-sparkles text-warning"></i> Namaste!</h6>
                                I am the Pavitra AI Assistant. I can help you navigate our wholesale catalog and answer questions about bulk orders.<br><br>
                                <span style="font-size: 0.8rem;" class="text-success"><i class="fa-solid fa-shield-halved"></i> Your privacy is fully protected and encrypted.</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-3 bg-white border-top">
                        <div class="input-group shadow-sm" style="border-radius: 20px; overflow: hidden;">
                            <input type="text" id="chatbot-input" class="form-control border-0 bg-light px-3" placeholder="Type your question..." aria-label="Type your question" style="box-shadow: none;">
                            <button class="btn text-white px-4 border-0" id="chatbot-send-btn" type="button" style="background-color: var(--meesho-pink);">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            const chatMessages = $('#chatbot-messages');
            const chatInput = $('#chatbot-input');
            const chatSendBtn = $('#chatbot-send-btn');

            function appendMessage(sender, text) {
                let html = '';
                if (sender === 'user') {
                    html = `
                    <div class="d-flex mb-3 justify-content-end">
                        <div class="p-3 text-white shadow-sm" style="font-size: 0.9rem; max-width: 85%; background-color: var(--meesho-pink); border-radius: 16px 0px 16px 16px;">
                            ${text}
                        </div>
                    </div>`;
                } else {
                    html = `
                    <div class="d-flex mb-3">
                        <div class="me-2 mt-auto mb-1">
                            <div class="d-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, var(--premium-gold), #8B5A2B);">
                                <i class="fa-solid fa-robot text-white" style="font-size: 0.8rem;"></i>
                            </div>
                        </div>
                        <div class="bg-white p-3 shadow-sm border" style="font-size: 0.9rem; max-width: 80%; border-radius: 16px 16px 16px 0px; border-color: #E2E8F0 !important;">
                            ${text}
                        </div>
                    </div>`;
                }
                chatMessages.append(html);
                chatMessages.scrollTop(chatMessages[0].scrollHeight);
            }

            function handleSend() {
                const text = chatInput.val().trim();
                if (!text) return;
                
                appendMessage('user', text);
                chatInput.val('');
                
                const typingId = 'typing-' + Date.now();
                const typingHtml = `
                <div id="${typingId}" class="d-flex mb-3">
                    <div class="me-2 mt-auto mb-1">
                        <div class="d-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, var(--premium-gold), #8B5A2B);">
                            <i class="fa-solid fa-robot text-white" style="font-size: 0.8rem;"></i>
                        </div>
                    </div>
                    <div class="bg-white p-2 shadow-sm border text-muted d-flex align-items-center gap-1" style="font-size: 0.8rem; border-radius: 16px 16px 16px 0px; height: 36px; margin-top: auto;">
                        <i class="fa-solid fa-circle text-muted" style="font-size: 6px; animation: blink 1.4s infinite;"></i>
                        <i class="fa-solid fa-circle text-muted" style="font-size: 6px; animation: blink 1.4s infinite 0.2s;"></i>
                        <i class="fa-solid fa-circle text-muted" style="font-size: 6px; animation: blink 1.4s infinite 0.4s;"></i>
                    </div>
                </div>`;
                chatMessages.append(typingHtml);
                chatMessages.scrollTop(chatMessages[0].scrollHeight);

                setTimeout(() => {
                    $('#' + typingId).remove();
                    
                    let response = `I'd be happy to guide you! Here is a step-by-step guide on how to use Pavitra Designer for your wholesale business:<br><br>
                    <b>Step 1: Browse & Filter</b><br>
                    Tap the 'Filters' button in the side menu to find exactly what you need (Silk, Banarasi, etc.).<br><br>
                    <b>Step 2: Add to Cart</b><br>
                    Click '+ Quick Add' on the sarees you want. Remember, our wholesale MOQ is 4 pieces.<br><br>
                    <b>Step 3: Complete KYC</b><br>
                    Before your first checkout, go to your <b>Profile</b> to upload your GST/Shop License for B2B verification.<br><br>
                    <b>Step 4: Place Order</b><br>
                    Go to your cart to securely checkout. We offer Free Shipping on orders over ₹10,000!<br><br>
                    <i>Need a custom weave? Tap 'Custom' in the side menu!</i><br><br>
                    Which step would you like more details about?`;
                    
                    if (text.toLowerCase().includes('price') || text.toLowerCase().includes('cost') || text.toLowerCase().includes('rate')) {
                        response = "Wholesale pricing requires a minimum order quantity (MOQ) of 4 pieces. Would you like me to filter the catalog for the best bulk deals?";
                    } else if (text.toLowerCase().includes('shipping') || text.toLowerCase().includes('delivery') || text.toLowerCase().includes('track')) {
                        response = "We offer Free Shipping on all wholesale orders above ₹10,000 via our verified delivery partners. You can track orders from your Profile.";
                    } else if (text.toLowerCase().includes('custom') || text.toLowerCase().includes('weave')) {
                        response = "Our Customization Studio allows you to submit custom loom requests directly to our Banarasi weavers. Head over to the Custom tab in the menu!";
                    } else if (text.toLowerCase().includes('hello') || text.toLowerCase().includes('hi') || text.toLowerCase().includes('hey')) {
                        response = "Namaste! I'm here to guide you. Would you like a step-by-step explanation of how to place a bulk order, or do you have a specific question about our sarees?";
                    }
                    
                    appendMessage('bot', response);
                }, 1500);
            }

            chatSendBtn.on('click', handleSend);
            chatInput.on('keypress', function(e) {
                if (e.which === 13) handleSend();
            });
            
            if (!$('style#chatbot-styles').length) {
                $('head').append(`
                <style id="chatbot-styles">
                    @keyframes blink { 0% { opacity: 0.2; } 20% { opacity: 1; } 100% { opacity: 0.2; } }
                    @keyframes scanline { 0% { top: 0; } 50% { top: 100%; } 100% { top: 0; } }
                </style>
                `);
            }

            $('#qrScannerModal').on('show.bs.modal', function () {
                $('#qr-scanner-viewfinder').hide();
                $('#qr-scan-title').css('opacity', '0');
                $('#qr-permission-prompt').show();
            });

            $('#qrScannerModal').on('hidden.bs.modal', function () {
                const video = document.getElementById('qr-video');
                if (video && video.srcObject) {
                    video.srcObject.getTracks().forEach(track => track.stop());
                }
            });

            $('#qr-allow-access-btn').on('click', function() {
                $('#qr-permission-prompt').slideUp(300);
                $('#qr-scan-title').css('opacity', '1');
                $('#qr-scanner-viewfinder').fadeIn(500);
                
                if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                    
                    function startCamera(constraints) {
                        return navigator.mediaDevices.getUserMedia(constraints)
                            .then(function(stream) {
                                const video = document.getElementById('qr-video');
                                video.srcObject = stream;
                                video.setAttribute("playsinline", true);
                                video.muted = true;
                                video.play();
                                
                                requestAnimationFrame(tick);
                                
                                function tick() {
                                    if (video.readyState === video.HAVE_ENOUGH_DATA) {
                                        const canvasElement = document.createElement("canvas");
                                        canvasElement.width = video.videoWidth;
                                        canvasElement.height = video.videoHeight;
                                        const canvas = canvasElement.getContext("2d");
                                        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
                                        var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
                                        
                                        if (typeof jsQR !== 'undefined') {
                                            var code = jsQR(imageData.data, imageData.width, imageData.height, {
                                                inversionAttempts: "dontInvert",
                                            });
                                            if (code && code.data) {
                                                video.srcObject.getTracks().forEach(track => track.stop());
                                                alert("Scanned Saree QR: " + code.data);
                                                $('#qrScannerModal').modal('hide');
                                                
                                                if (code.data.startsWith('http') || code.data.startsWith('/')) {
                                                    window.location.href = code.data;
                                                }
                                                return;
                                            }
                                        }
                                    }
                                    if ($('#qrScannerModal').is(':visible')) {
                                        requestAnimationFrame(tick);
                                    }
                                }
                            });
                    }

                    startCamera({ video: { facingMode: "environment" } })
                        .catch(function(err) {
                            console.warn("Environment camera failed, trying default:", err);
                            return startCamera({ video: true });
                        })
                        .catch(function(err) {
                            console.error("Camera access denied or error:", err);
                            alert("Direct camera access failed (often happens in WebViews). We will now open your device's native camera.");
                            
                            let fileInput = document.getElementById('qr-fallback-input');
                            if (!fileInput) {
                                fileInput = document.createElement('input');
                                fileInput.type = 'file';
                                fileInput.accept = 'image/*';
                                fileInput.capture = 'environment';
                                fileInput.id = 'qr-fallback-input';
                                fileInput.style.display = 'none';
                                document.body.appendChild(fileInput);
                                
                                fileInput.addEventListener('change', function(e) {
                                    if (e.target.files && e.target.files.length > 0) {
                                        const file = e.target.files[0];
                                        const reader = new FileReader();
                                        reader.onload = function(event) {
                                            const img = new Image();
                                            img.onload = function() {
                                                const canvas = document.createElement('canvas');
                                                canvas.width = img.width;
                                                canvas.height = img.height;
                                                const ctx = canvas.getContext('2d');
                                                ctx.drawImage(img, 0, 0, img.width, img.height);
                                                const imageData = ctx.getImageData(0, 0, img.width, img.height);
                                                
                                                if (typeof jsQR !== 'undefined') {
                                                    const code = jsQR(imageData.data, imageData.width, imageData.height, {
                                                        inversionAttempts: "dontInvert",
                                                    });
                                                    if (code && code.data) {
                                                        alert("Scanned Saree QR: " + code.data);
                                                        $('#qrScannerModal').modal('hide');
                                                        if (code.data.startsWith('http') || code.data.startsWith('/')) {
                                                            window.location.href = code.data;
                                                        }
                                                    } else {
                                                        alert("Could not detect a QR code in the image. Please try again.");
                                                    }
                                                }
                                            };
                                            img.src = event.target.result;
                                        };
                                        reader.readAsDataURL(file);
                                    }
                                });
                            }
                            fileInput.click();
                        });
                } else {
                    alert("Your browser does not support direct camera access.");
                }
            });
        });
    </script>

</body>
</html>
