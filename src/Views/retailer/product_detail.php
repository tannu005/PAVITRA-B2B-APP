<?php
// =============================================
// Pavitra Designer SAREE MARKETPLACE
// DEDICATED PRODUCT DETAIL VIEW PAGE
// =============================================

$p = $product;
$wholesalePrice = floatval($p['wholesale_price']);
$price = floatval($p['price']);
$discVal = $price > $wholesalePrice ? round((($price - $wholesalePrice) / $price) * 100) : 0;
$mrp = number_format($price > 0 ? $price : $wholesalePrice + 8500);
$saving = number_format(($price > 0 ? $price : $wholesalePrice + 8500) - $wholesalePrice);
?>

<div class="container-xl py-3" style="font-family: 'Plus Jakarta Sans', sans-serif; color: #282c3f; min-height: 80vh;">
    <!-- Breadcrumbs / Back Navigation -->
    <div class="d-flex align-items-center gap-2 mb-3 d-md-flex">
        <a href="/" class="btn btn-sm btn-outline-dark rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px; padding: 0;">
            <i class="fa-solid fa-arrow-left" style="font-size: 0.85rem;"></i>
        </a>
        <span class="text-muted small">Back to Collections / <?= htmlspecialchars($p['category_name']) ?></span>
    </div>

    <div class="row g-4">
        <!-- Left Column: Product Image Gallery & Interaction -->
        <div class="col-lg-6 col-md-12">
            <div class="position-relative overflow-hidden bg-light border rounded-3 text-center mb-3">
                <!-- Saree Image with Zoom capability -->
                <img id="detail-saree-img" src="<?= htmlspecialchars($p['image_url'] ?: '/assets/images/placeholder.png') ?>" class="img-fluid w-100 zoomable-saree-img" style="max-height: 580px; object-fit: cover; cursor: zoom-in;" title="Click to zoom saree pattern">
                
                <!-- Brand Badge -->
                <span class="position-absolute bg-dark text-white px-2 py-1 small fw-bold" style="top: 15px; left: 15px; background-color: #7952B3 !important; font-size: 0.65rem; border-radius: 2px;">
                    House of Brands
                </span>

                <!-- Rating Badge (Screenshot styled) -->
                <span class="position-absolute bg-white px-2.5 py-1.5 shadow-sm rounded-pill d-flex align-items-center gap-1 fw-bold" style="bottom: 15px; right: 15px; font-size: 0.72rem; border: 1px solid #eaeaec;">
                    <span>4</span>
                    <span class="text-success" style="color: #03a685 !important;"><i class="fa-solid fa-star"></i></span>
                    <span class="text-muted border-start ps-1" style="font-weight: 500;">7.3k</span>
                </span>

                <!-- Video Preview Circle -->
                <div class="position-absolute d-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm" style="bottom: 15px; left: 15px; width: 48px; height: 48px; border: 2px solid var(--meesho-pink); cursor: pointer;" onclick="showToast('Loading saree draping video walkthrough... 🎥');">
                    <i class="fa-solid fa-play" style="color: var(--meesho-pink); font-size: 1rem; margin-left: 2px;"></i>
                </div>
            </div>

            <!-- Action Pills under Image -->
            <div class="d-flex justify-content-between gap-2 mb-4">
                <button class="btn btn-sm bg-white border w-33 py-2 d-flex align-items-center justify-content-center gap-2 fw-semibold text-muted" onclick="alert('Saree Size Guide:\nStandard Length: 5.5 meters\nBlouse Piece: 0.8 meters (unstitched)\nTotal Width: 1.1 meters');" style="font-size: 0.78rem; border-radius: 6px;">
                    <i class="fa-solid fa-ruler-horizontal"></i> Size Guide
                </button>
                <button class="btn btn-sm bg-white border w-33 py-2 d-flex align-items-center justify-content-center gap-2 fw-semibold text-muted detail-wishlist-btn" style="font-size: 0.78rem; border-radius: 6px;">
                    <i class="fa-regular fa-heart text-danger"></i> Wishlist
                </button>
                <button class="btn btn-sm bg-white border w-33 py-2 d-flex align-items-center justify-content-center gap-2 fw-semibold text-muted" onclick="navigator.clipboard.writeText(window.location.href); showToast('Product link copied to clipboard! 🔗');" style="font-size: 0.78rem; border-radius: 6px;">
                    <i class="fa-solid fa-share-nodes"></i> Share
                </button>
            </div>
        </div>

        <!-- Right Column: Product Info & Order Specifications -->
        <div class="col-lg-6 col-md-12">
            <div class="ps-lg-3">
                <h4 class="fw-bold mb-1" style="color: #482922;"><?= htmlspecialchars($p['title']) ?></h4>
                <p class="text-muted mb-3" style="font-size: 0.88rem;"><?= htmlspecialchars($p['description']) ?></p>

                <!-- Prices Block -->
                <div class="mb-3">
                    <span class="text-decoration-line-through text-muted me-2" style="font-size: 0.95rem;">MRP ₹<?= $mrp ?></span>
                    <span class="fs-4 fw-bold text-dark me-2">₹<?= number_format($wholesalePrice) ?></span>
                    <span class="fw-bold text-success" style="font-size: 0.95rem;">(Rs. <?= $saving ?> OFF)</span>
                </div>

                <div class="mb-4">
                    <span class="badge bg-warning text-dark text-uppercase fw-bold py-2 px-3" style="font-size: 0.7rem; letter-spacing: 0.05em; background-color: #FFF3CD !important; border: 1px solid #FFEBAA;">
                        Thunder Deal
                    </span>
                </div>

                <!-- Quantity Selector -->
                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted text-uppercase mb-2">Select Quantity</label>
                    <div style="max-width: 120px;">
                        <select class="form-select border-dark rounded-2 py-2 fw-bold text-center" id="detail-qty-select" style="font-size: 0.9rem; border-color: #482922 !important;">
                            <?php for ($i = 1; $i <= 15; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?> Pcs</option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <!-- Delivery & Services Block -->
                <div class="p-3 mb-4 bg-white border rounded-3" style="border-color: #eaeaec !important;">
                    <h6 class="fw-bold text-dark mb-3" style="font-size: 0.85rem;"><i class="fa-solid fa-truck me-2" style="color: #7f8c8d;"></i>Delivery & Services</h6>
                    
                    <!-- Pincode Checker -->
                    <div class="d-flex align-items-center justify-content-between mb-2 border p-2.5 rounded-2 bg-light-subtle">
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted" style="font-size: 0.85rem;"><i class="fa-solid fa-location-dot"></i></span>
                            <span class="fw-bold text-dark" style="font-size: 0.78rem;" id="detail-delivery-address-label">Check Delivery Availability</span>
                        </div>
                        <span class="fw-bold text-uppercase pincode-change-trigger" style="font-size: 0.72rem; color: var(--meesho-pink); cursor: pointer;">Check</span>
                    </div>

                    <!-- Collapsible pincode check input -->
                    <div id="detail-pincode-wrapper" style="display: none;" class="mb-3 border p-3 rounded-2 bg-light">
                        <label class="form-label small fw-bold text-muted text-uppercase mb-1" style="font-size: 0.65rem;">Enter Pincode</label>
                        <div class="input-group">
                            <input type="text" class="form-control rounded-0" id="detail-pincode-input" placeholder="e.g. 110001" maxlength="6" style="font-size: 0.85rem;">
                            <button class="btn btn-dark rounded-0 px-3 fw-bold text-uppercase" id="btn-detail-pincode" style="font-size: 0.75rem;">Apply</button>
                        </div>
                        <span class="text-danger small" id="detail-pincode-error" style="display: none; font-size: 0.7rem;">Please enter a valid 6-digit pincode.</span>
                    </div>

                    <div class="text-muted" style="font-size: 0.78rem;">
                        <div class="mb-2"><i class="fa-solid fa-ban text-danger me-2"></i>Pay on Delivery is not available for bulk trial orders</div>
                        <div><i class="fa-solid fa-rotate-left text-success me-2"></i>Hassle free 7 days Return & Exchange</div>
                    </div>
                </div>

                <!-- Product Specifications -->
                <div class="p-3 mb-4 bg-white border rounded-3" style="border-color: #eaeaec !important;">
                    <h6 class="fw-bold text-dark mb-3" style="font-size: 0.85rem;">Product Specifications</h6>
                    <div class="row g-3 text-muted mb-0" style="font-size: 0.82rem;">
                        <div class="col-6">
                            <div class="small text-muted">Border</div>
                            <div class="fw-bold text-dark">Embroidered Zari</div>
                        </div>
                        <div class="col-6">
                            <div class="small text-muted">Saree Fabric</div>
                            <div class="fw-bold text-dark"><?= htmlspecialchars($p['category_name']) ?></div>
                        </div>
                        <div class="col-6">
                            <div class="small text-muted">Ornamentation</div>
                            <div class="fw-bold text-dark">Sequinned Weaves</div>
                        </div>
                        <div class="col-6">
                            <div class="small text-muted">Print or Pattern Types</div>
                            <div class="fw-bold text-dark">Embellished Motifs</div>
                        </div>
                        <div class="col-6">
                            <div class="small text-muted">SKU</div>
                            <div class="fw-bold text-dark"><?= htmlspecialchars($p['sku']) ?></div>
                        </div>
                        <div class="col-6">
                            <div class="small text-muted">Weight</div>
                            <div class="fw-bold text-dark"><?= htmlspecialchars($p['weight']) ?> g</div>
                        </div>
                    </div>
                </div>

                <!-- Ratings & Reviews Section (Screenshot exact) -->
                <div class="p-3 mb-4 bg-white border rounded-3" style="border-color: #eaeaec !important;">
                    <h6 class="fw-bold text-dark mb-3" style="font-size: 0.85rem;">Customer Reviews (1354)</h6>
                    
                    <!-- Star count and pill details -->
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="bg-success text-white px-2 py-1 fw-bold rounded-2 d-inline-flex align-items-center gap-1" style="font-size: 1.1rem; background-color: #03a685 !important;">
                            4 <i class="fa-solid fa-star" style="font-size: 0.75rem;"></i>
                        </span>
                        <span class="bg-light border px-3 py-1.5 rounded-pill text-muted fw-semibold d-inline-flex align-items-center justify-content-between" style="font-size: 0.78rem; width: 220px; cursor: pointer;">
                            <span>7293 ratings | 1354 reviews</span>
                            <span class="ms-1" style="font-size: 0.65rem;"><i class="fa-solid fa-chevron-right"></i></span>
                        </span>
                    </div>

                    <!-- Customer Review Images Row (from screenshot) -->
                    <div class="d-flex gap-2 mb-3 mt-2 overflow-auto" style="scrollbar-width: none;">
                        <!-- Thumbnail 1 (Video) -->
                        <div class="position-relative border rounded-3 overflow-hidden" style="width: 76px; height: 76px; min-width: 76px; border-color: #eaeaec !important;">
                            <img src="/saree-banner1.png" style="width: 100%; height: 100%; object-fit: cover;">
                            <div class="position-absolute start-0 top-0 w-100 h-100 d-flex align-items-end p-1" style="background: rgba(0,0,0,0.15);">
                                <span class="text-white fw-bold d-flex align-items-center gap-1" style="font-size: 0.58rem; background: rgba(0,0,0,0.5); padding: 1px 4px; border-radius: 4px;">
                                    <i class="fa-solid fa-play" style="font-size: 0.5rem;"></i> 0:42
                                </span>
                            </div>
                        </div>
                        <!-- Thumbnail 2 -->
                        <div class="border rounded-3 overflow-hidden" style="width: 76px; height: 76px; min-width: 76px; border-color: #eaeaec !important;">
                            <img src="/saree-banner2.png" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <!-- Thumbnail 3 -->
                        <div class="border rounded-3 overflow-hidden" style="width: 76px; height: 76px; min-width: 76px; border-color: #eaeaec !important;">
                            <img src="/saree-banner3.png" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <!-- Thumbnail 4 (More count overlay) -->
                        <div class="position-relative border rounded-3 overflow-hidden" style="width: 76px; height: 76px; min-width: 76px; border-color: #eaeaec !important;">
                            <img src="/saree-banner4.png" style="width: 100%; height: 100%; object-fit: cover;">
                            <div class="position-absolute start-0 top-0 w-100 h-100 d-flex align-items-center justify-content-center text-white fw-bold" style="background: rgba(0,0,0,0.45); font-size: 0.85rem;">
                                +1168
                            </div>
                        </div>
                    </div>

                    <!-- Scrollable Review Cards Row -->
                    <div class="d-flex gap-3 overflow-auto pb-3 mb-3" style="scrollbar-width: none;">
                        <!-- Card 1 -->
                        <div class="p-3 bg-light border rounded-3" style="min-width: 280px; max-width: 280px; border-color: #eaeaec !important;">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge bg-success d-inline-flex align-items-center gap-1" style="font-size: 0.7rem; background-color: #03a685 !important;">
                                    5 <i class="fa-solid fa-star" style="font-size: 0.55rem;"></i>
                                </span>
                                <span class="text-muted small">Feb 21, 2026</span>
                            </div>
                            <div class="fw-bold text-dark small mb-1"><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i> Absolutely Stunning Saree – Pure Grace & Elegance!</div>
                            <p class="text-muted mb-2 text-truncate" style="font-size: 0.75rem;">... read more</p>
                            <div class="d-flex align-items-center gap-1 text-success fw-semibold" style="font-size: 0.72rem;">
                                <i class="fa-solid fa-circle-check"></i> satrajit hore
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="p-3 bg-light border rounded-3" style="min-width: 280px; max-width: 280px; border-color: #eaeaec !important;">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge bg-success d-inline-flex align-items-center gap-1" style="font-size: 0.7rem; background-color: #03a685 !important;">
                                    5 <i class="fa-solid fa-star" style="font-size: 0.55rem;"></i>
                                </span>
                                <span class="text-muted small">Mar 02, 2026</span>
                            </div>
                            <div class="fw-bold text-dark small mb-1">Absolutely beautiful fabric and shine. Highly recommended for bridal store stock.</div>
                            <p class="text-muted mb-2 text-truncate" style="font-size: 0.75rem;">... read more</p>
                            <div class="d-flex align-items-center gap-1 text-success fw-semibold" style="font-size: 0.72rem;">
                                <i class="fa-solid fa-circle-check"></i> Manas
                            </div>
                        </div>
                    </div>

                    <!-- Trust Seal Icons (Screenshot exact) -->
                    <div class="d-flex align-items-center justify-content-around border-top pt-3 mt-2 text-center">
                        <div class="d-flex flex-column align-items-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/9322/9322127.png" style="width: 48px; height: 48px; object-fit: contain;" class="mb-1">
                            <div class="fw-bold text-danger text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.05em; color: #DC3545 !important;">Genuine Product</div>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/9552/9552523.png" style="width: 48px; height: 48px; object-fit: contain;" class="mb-1">
                            <div class="fw-bold text-success text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.05em; color: #198754 !important;">Quality Checked</div>
                        </div>
                    </div>
                </div>

                <!-- More Information (Screenshot exact) -->
                <div class="p-3 mb-4 bg-white border rounded-3" style="border-color: #eaeaec !important;">
                    <h6 class="fw-bold text-dark mb-2" style="font-size: 0.85rem;">More Information</h6>
                    <div class="small text-muted mb-2">Product Code: <span class="text-dark fw-semibold">3333<?= htmlspecialchars($p['id']) ?></span></div>
                    <a href="javascript:void(0)" class="fw-bold text-decoration-none" style="font-size: 0.78rem; color: var(--meesho-pink);" onclick="alert('Product Details:\nColor: <?= htmlspecialchars($p['color'] ?? 'Dual-tone') ?>\nDimensions: <?= htmlspecialchars($p['dimensions'] ?? 'Standard Saree') ?>\nSKU: <?= htmlspecialchars($p['sku']) ?>');">View More</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sticky Bottom Floating Action Buttons Bar (Screenshot styled) -->
<div class="w-100 border-top bg-white py-2.5 sticky-bottom-bar" style="position: sticky; bottom: 0; left: 0; z-index: 1020; box-shadow: 0 -4px 12px rgba(0,0,0,0.05);">
    <div class="container-xl">
        <div class="row g-2 justify-content-end align-items-center">
            <div class="col-6 col-md-3">
                <button class="btn btn-outline-dark w-100 py-2.5 fw-bold text-uppercase d-flex align-items-center justify-content-center gap-2" id="detail-buy-now-btn" data-variant-id="<?= htmlspecialchars($p['variant_id']) ?>" style="border-radius: 4px; font-size: 0.85rem; letter-spacing: 0.05em; border-color: var(--meesho-pink) !important; color: var(--meesho-pink) !important;">
                    <i class="fa-solid fa-bag-shopping"></i> Buy Now
                </button>
            </div>
            <div class="col-6 col-md-3">
                <button class="btn w-100 py-2.5 fw-bold text-uppercase text-white d-flex align-items-center justify-content-center gap-2" id="detail-add-bag-btn" data-variant-id="<?= htmlspecialchars($p['variant_id']) ?>" style="background: var(--meesho-pink); border-radius: 4px; font-size: 0.85rem; letter-spacing: 0.05em; border: none;">
                    <i class="fa-solid fa-bag-shopping"></i> Add to Bag
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Image Zoom Modal Overlay (Pure Premium CSS + JS) -->
<div id="imageZoomOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.9); z-index: 9999; align-items: center; justify-content: center; cursor: zoom-out;">
    <img id="zoomed-saree-img" src="" class="img-fluid" style="max-height: 90vh; max-width: 90vw; object-fit: contain; transform: scale(1); transition: transform 0.25s ease;">
    <!-- Zoom controls bottom bar -->
    <div class="position-absolute d-flex gap-3" style="bottom: 30px; left: 50%; transform: translateX(-50%); z-index: 10000;">
        <button class="btn btn-dark btn-sm rounded-circle d-flex align-items-center justify-content-center" id="btn-zoom-in" style="width: 40px; height: 40px;"><i class="fa-solid fa-plus fs-5"></i></button>
        <button class="btn btn-dark btn-sm rounded-circle d-flex align-items-center justify-content-center" id="btn-zoom-out" style="width: 40px; height: 40px;"><i class="fa-solid fa-minus fs-5"></i></button>
    </div>
</div>

<script>
$(document).ready(function() {
    // Zoom In/Out Image Interaction
    let zoomLevel = 1;
    $('.zoomable-saree-img').on('click', function() {
        const src = $(this).attr('src');
        $('#zoomed-saree-img').attr('src', src);
        $('#imageZoomOverlay').css('display', 'flex');
        zoomLevel = 1;
        $('#zoomed-saree-img').css('transform', 'scale(1)');
    });

    $('#imageZoomOverlay').on('click', function(e) {
        if ($(e.target).closest('#btn-zoom-in, #btn-zoom-out').length === 0) {
            $('#imageZoomOverlay').hide();
        }
    });

    $('#btn-zoom-in').on('click', function(e) {
        e.stopPropagation();
        if (zoomLevel < 3) {
            zoomLevel += 0.25;
            $('#zoomed-saree-img').css('transform', `scale(${zoomLevel})`);
        }
    });

    $('#btn-zoom-out').on('click', function(e) {
        e.stopPropagation();
        if (zoomLevel > 0.5) {
            zoomLevel -= 0.25;
            $('#zoomed-saree-img').css('transform', `scale(${zoomLevel})`);
        }
    });

    // Pincode Availability check collapsible
    $('.pincode-change-trigger').on('click', function() {
        $('#detail-pincode-wrapper').slideToggle(200);
    });

    $('#btn-detail-pincode').on('click', function() {
        const pin = $('#detail-pincode-input').val().trim();
        if (/^\d{6}$/.test(pin)) {
            $('#detail-pincode-error').hide();
            $('#detail-delivery-address-label').text(`Deliver to Store - Pincode ${pin}`);
            $('#detail-pincode-wrapper').slideUp(200);
            showToast(`Delivery is available for Pincode ${pin}! 🚚`);
        } else {
            $('#detail-pincode-error').show();
        }
    });

    // Add To Bag Handler
    $('#detail-add-bag-btn').on('click', function() {
        const btn = $(this);
        const variantId = btn.attr('data-variant-id');
        const qty = parseInt($('#detail-qty-select').val() || 1);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Adding...');
        
        $.ajax({
            url: '/cart/add',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ variant_id: variantId, quantity: qty }),
            dataType: 'json',
            success: function() {
                btn.prop('disabled', false).html('<i class="fa-solid fa-bag-shopping"></i> Add to Bag');
                showToast('Product added to bag successfully! 🛍️');
                // Trigger global header cart updates
                if (typeof window.updateCartCount === 'function') {
                    window.updateCartCount();
                } else {
                    location.reload();
                }
            },
            error: function(xhr) {
                alert(xhr.responseJSON ? xhr.responseJSON.error : 'Failed to add to bag');
                btn.prop('disabled', false).html('<i class="fa-solid fa-bag-shopping"></i> Add to Bag');
            }
        });
    });

    // Buy Now Handler
    $('#detail-buy-now-btn').on('click', function() {
        const btn = $(this);
        const variantId = btn.attr('data-variant-id');
        const qty = parseInt($('#detail-qty-select').val() || 1);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        
        $.ajax({
            url: '/cart/add',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ variant_id: variantId, quantity: qty }),
            dataType: 'json',
            success: function() {
                window.location.href = '/cart'; // Redirect directly to checkout/cart
            },
            error: function(xhr) {
                alert(xhr.responseJSON ? xhr.responseJSON.error : 'Failed to buy now');
                btn.prop('disabled', false).html('<i class="fa-solid fa-bag-shopping"></i> Buy Now');
            }
        });
    });

    // Wishlist Toggle inside Details Page
    $('.detail-wishlist-btn').on('click', function() {
        $(this).toggleClass('active');
        const isActive = $(this).hasClass('active');
        $(this).find('i').toggleClass('fa-regular fa-solid').css('color', isActive ? '#e74c3c' : '');
        showToast(isActive ? 'Added to Wishlist ❤️' : 'Removed from Wishlist');
    });
});
</script>
