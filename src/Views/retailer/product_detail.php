<?php
$p = $product;
$wholesalePrice = floatval($p['wholesale_price']);
$price = floatval($p['price']);
$discVal = $price > $wholesalePrice ? round((($price - $wholesalePrice) / $price) * 100) : 0;
$mrp = number_format($price > 0 ? $price : $wholesalePrice + 8500);
$saving = number_format(($price > 0 ? $price : $wholesalePrice + 8500) - $wholesalePrice);
?>
<div class="container-xl py-3" style="font-family: 'Plus Jakarta Sans', sans-serif; color: #282c3f; min-height: 80vh;">
    <div class="d-flex align-items-center gap-2 mb-3 d-md-flex">
        <a href="/" class="btn btn-sm btn-outline-dark rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px; padding: 0;">
            <i class="fa-solid fa-arrow-left" style="font-size: 0.85rem;"></i>
        </a>
        <span class="text-muted small">Back to Collections / <?= htmlspecialchars($p['category_name']) ?></span>
    </div>
    <div class="row g-4">
        <div class="col-lg-6 col-md-12">
            <div class="position-relative overflow-hidden bg-light border rounded-3 text-center mb-3" id="main-media-container" style="min-height: 400px; display: flex; align-items: center; justify-content: center;">
                <img id="detail-saree-img" src="<?= htmlspecialchars($p['image_url'] ?: '/assets/images/placeholder.png') ?>" class="img-fluid w-100 zoomable-saree-img" style="max-height: 580px; object-fit: cover; cursor: zoom-in;" title="Click to zoom saree pattern">
                <video id="detail-saree-video" src="" controls style="display: none; max-height: 580px; width: 100%;"></video>
                <iframe id="detail-saree-iframe" src="" frameborder="0" allowfullscreen style="display: none; height: 400px; width: 100%;"></iframe>
                <span class="position-absolute bg-dark text-white px-2 py-1 small fw-bold" style="top: 15px; left: 15px; background-color: #7952B3 !important; font-size: 0.65rem; border-radius: 2px;">
                    House of Brands
                </span>
                <span class="position-absolute bg-white px-2.5 py-1.5 shadow-sm rounded-pill d-flex align-items-center gap-1 fw-bold" style="bottom: 15px; right: 15px; font-size: 0.72rem; border: 1px solid #eaeaec;">
                    <span>4</span>
                    <span class="text-success" style="color: #03a685 !important;"><i class="fa-solid fa-star"></i></span>
                    <span class="text-muted border-start ps-1" style="font-weight: 500;">7.3k</span>
                </span>
            </div>
            <?php if (!empty($images) || !empty($videos)): ?>
            <div class="d-flex gap-2 overflow-auto pb-2 mb-3 px-1 custom-scrollbar">
                <?php if (!empty($p['image_url'])): ?>
                <div class="border rounded-2 overflow-hidden flex-shrink-0 cursor-pointer thumbnail-item border-dark" style="width: 70px; height: 70px;" onclick="changeMainMedia('<?= htmlspecialchars($p['image_url']) ?>', 'image', this)">
                    <img src="<?= htmlspecialchars($p['image_url']) ?>" class="w-100 h-100" style="object-fit: cover;">
                </div>
                <?php endif; ?>
                <?php foreach($images as $img): ?>
                <?php if($img['image_url'] !== $p['image_url']): ?>
                <div class="border rounded-2 overflow-hidden flex-shrink-0 cursor-pointer thumbnail-item opacity-75" style="width: 70px; height: 70px;" onclick="changeMainMedia('<?= htmlspecialchars($img['image_url']) ?>', 'image', this)">
                    <img src="<?= htmlspecialchars($img['image_url']) ?>" class="w-100 h-100" style="object-fit: cover;">
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php foreach($videos as $vid): ?>
                <div class="border rounded-2 overflow-hidden flex-shrink-0 cursor-pointer thumbnail-item opacity-75 position-relative" style="width: 70px; height: 70px;" onclick="changeMainMedia('<?= htmlspecialchars($vid['video_url']) ?>', 'video', this)">
                    <div class="w-100 h-100 bg-dark d-flex align-items-center justify-content-center text-white"><i class="fa-solid fa-play"></i></div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <div class="d-flex justify-content-between gap-2 mb-4">
                <button class="btn btn-sm bg-white border w-33 py-2 d-flex align-items-center justify-content-center gap-2 fw-semibold text-muted" onclick="window.showToast('Saree Size Guide:\nStandard Length: 5.5 meters\nBlouse Piece: 0.8 meters (unstitched)\nTotal Width: 1.1 meters');" style="font-size: 0.78rem; border-radius: 6px;">
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
        <div class="col-lg-6 col-md-12">
            <div class="ps-lg-3">
                <h4 class="fw-bold mb-1 custom-caps" style="color: #482922;"><?= htmlspecialchars($p['title']) ?></h4>
                <p class="text-muted mb-3" style="font-size: 0.88rem;"><?= htmlspecialchars($p['description']) ?></p>
                <div class="mb-3">
                    <span class="text-decoration-line-through text-muted me-2" style="font-size: 0.95rem;" id="detail-mrp">MRP ₹<?= $mrp ?></span>
                    <span class="fs-4 fw-bold text-dark me-2" id="detail-wholesale-price">₹<?= number_format($wholesalePrice) ?></span>
                    <span class="fw-bold text-success" style="font-size: 0.95rem;" id="detail-saving">(Rs. <?= $saving ?> OFF)</span>
                </div>
                <div class="mb-4">
                    <span class="badge bg-warning text-dark text-uppercase fw-bold py-2 px-3" style="font-size: 0.7rem; letter-spacing: 0.05em; background-color: #FFF3CD !important; border: 1px solid #FFEBAA;">
                        Thunder Deal
                    </span>
                </div>
                <?php 
                    $displayVariants = $variants ?? [];
                    if (empty($displayVariants) || count($displayVariants) <= 1) {
                        $base = !empty($variants) ? $variants[0] : [
                            'id' => 0, 'sku' => 'DUMMY', 'price' => $price, 'wholesale_price' => $wholesalePrice, 'image_url' => $p['image_url'] ?? ''
                        ];
                        
                        $availableImages = [];
                        if (!empty($p['image_url'])) {
                            $availableImages[] = $p['image_url'];
                        }
                        if (!empty($images)) {
                            foreach($images as $img) {
                                if (!in_array($img['image_url'], $availableImages)) {
                                    $availableImages[] = $img['image_url'];
                                }
                            }
                        }
                        
                        $dummyColors = ['Pink', 'Black', 'Blue', 'Orange', 'Purple', 'Teal'];
                        $displayVariants = [];
                        foreach ($dummyColors as $idx => $c) {
                            $v = $base;
                            $v['color'] = $c;
                            if (!empty($availableImages)) {
                                $v['image_url'] = $availableImages[$idx % count($availableImages)];
                            }
                            $displayVariants[] = $v;
                        }
                    }
                ?>
                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted text-uppercase mb-2">Select Color</label>
                    <div class="d-flex flex-wrap gap-2" id="color-swatches-container">
                        <?php foreach($displayVariants as $index => $v): ?>
                            <?php 
                                $colorClass = 'color-default';
                                $lowerColor = strtolower(trim($v['color']));
                                $cssColors = ['white', 'black', 'red', 'blue', 'green', 'yellow', 'pink', 'purple', 'orange', 'teal', 'grey', 'brown', 'navy', 'maroon', 'olive', 'silver', 'gold', 'cyan', 'magenta', 'beige', 'mustard', 'peach', 'lavender', 'coral', 'mint'];
                                foreach ($cssColors as $cc) {
                                    if (strpos($lowerColor, $cc) !== false) {
                                        $colorClass = 'color-' . $cc;
                                        break;
                                    }
                                }
                            ?>
                            <div class="color-swatch-wrapper <?= $index === 0 ? 'active' : '' ?>" style="border: 2px solid <?= $index === 0 ? '#999' : 'transparent' ?>; border-radius: 50%; padding: 2px; display: inline-flex; cursor: pointer; transition: all 0.2s;">
                                <div class="color-swatch shadow-sm" 
                                     title="<?= htmlspecialchars($v['color']) ?>"
                                     data-variant-id="<?= $v['id'] ?>"
                                     data-sku="<?= htmlspecialchars($v['sku']) ?>"
                                     data-price="<?= $v['price'] ?>"
                                     data-wholesale="<?= $v['wholesale_price'] ?>"
                                     data-mrp="<?= number_format($v['price'] > 0 ? $v['price'] : $v['wholesale_price'] + 8500) ?>"
                                     data-saving="<?= number_format(($v['price'] > 0 ? $v['price'] : $v['wholesale_price'] + 8500) - $v['wholesale_price']) ?>"
                                     data-image="<?= htmlspecialchars($v['image_url']) ?>"
                                     style="width: 28px; height: 28px; border: 1px solid rgba(0,0,0,0.15) !important; margin: 0; border-radius: 50%; background-color: <?= in_array($lowerColor, $cssColors) ? $lowerColor : '#ccc' ?>; <?= !empty($v['image_url']) ? 'background-image: url(\'' . htmlspecialchars($v['image_url']) . '\'); background-size: cover; background-position: center;' : '' ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
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
                <div class="p-3 mb-4 bg-white border rounded-3" style="border-color: #eaeaec !important;">
                    <h6 class="fw-bold text-dark mb-3" style="font-size: 0.85rem;"><i class="fa-solid fa-truck me-2" style="color: #7f8c8d;"></i>Delivery & Services</h6>
                    <div class="d-flex align-items-center justify-content-between mb-2 border p-2.5 rounded-2 bg-light-subtle">
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted" style="font-size: 0.85rem;"><i class="fa-solid fa-location-dot"></i></span>
                            <span class="fw-bold text-dark" style="font-size: 0.78rem;" id="detail-delivery-address-label">Check Delivery Availability</span>
                        </div>
                        <span class="fw-bold text-uppercase pincode-change-trigger" style="font-size: 0.72rem; color: var(--pavitra-pink); cursor: pointer;">Check</span>
                    </div>
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
                            <div class="fw-bold text-dark" id="detail-sku"><?= htmlspecialchars($p['sku']) ?></div>
                        </div>
                        <div class="col-6">
                            <div class="small text-muted">Weight</div>
                            <div class="fw-bold text-dark"><?= htmlspecialchars($p['weight']) ?> g</div>
                        </div>
                    </div>
                </div>
                <div class="p-3 mb-4 bg-white border rounded-3" style="border-color: #eaeaec !important;">
                    <h6 class="fw-bold text-dark mb-3" style="font-size: 0.85rem;">Customer Reviews (1354)</h6>
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="bg-success text-white px-2 py-1 fw-bold rounded-2 d-inline-flex align-items-center gap-1" style="font-size: 1.1rem; background-color: #03a685 !important;">
                            4 <i class="fa-solid fa-star" style="font-size: 0.75rem;"></i>
                        </span>
                        <span class="bg-light border px-3 py-1.5 rounded-pill text-muted fw-semibold d-inline-flex align-items-center justify-content-between" style="font-size: 0.78rem; width: 220px; cursor: pointer;">
                            <span>7293 ratings | 1354 reviews</span>
                            <span class="ms-1" style="font-size: 0.65rem;"><i class="fa-solid fa-chevron-right"></i></span>
                        </span>
                    </div>
                    <div class="d-flex gap-2 mb-3 mt-2 overflow-auto" style="scrollbar-width: none;">
                        <div class="position-relative border rounded-3 overflow-hidden" style="width: 76px; height: 76px; min-width: 76px; border-color: #eaeaec !important;">
                            <img src="/saree-banner1.png" style="width: 100%; height: 100%; object-fit: cover;">
                            <div class="position-absolute start-0 top-0 w-100 h-100 d-flex align-items-end p-1" style="background: rgba(0,0,0,0.15);">
                                <span class="text-white fw-bold d-flex align-items-center gap-1" style="font-size: 0.58rem; background: rgba(0,0,0,0.5); padding: 1px 4px; border-radius: 4px;">
                                    <i class="fa-solid fa-play" style="font-size: 0.5rem;"></i> 0:42
                                </span>
                            </div>
                        </div>
                        <div class="border rounded-3 overflow-hidden" style="width: 76px; height: 76px; min-width: 76px; border-color: #eaeaec !important;">
                            <img src="/saree-banner2.png" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="border rounded-3 overflow-hidden" style="width: 76px; height: 76px; min-width: 76px; border-color: #eaeaec !important;">
                            <img src="/saree-banner3.png" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="position-relative border rounded-3 overflow-hidden" style="width: 76px; height: 76px; min-width: 76px; border-color: #eaeaec !important;">
                            <img src="/saree-banner4.png" style="width: 100%; height: 100%; object-fit: cover;">
                            <div class="position-absolute start-0 top-0 w-100 h-100 d-flex align-items-center justify-content-center text-white fw-bold" style="background: rgba(0,0,0,0.45); font-size: 0.85rem;">
                                +1168
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-3 overflow-auto pb-3 mb-3" style="scrollbar-width: none;">
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
                <div class="p-3 mb-4 bg-white border rounded-3" style="border-color: #eaeaec !important;">
                    <h6 class="fw-bold text-dark mb-2" style="font-size: 0.85rem;">More Information</h6>
                    <div class="small text-muted mb-2">Product Code: <span class="text-dark fw-semibold">3333<?= htmlspecialchars($p['id']) ?></span></div>
                    <a href="#moreDetailsCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="moreDetailsCollapse" class="fw-bold text-decoration-none" style="font-size: 0.78rem; color: var(--pavitra-pink);">
                        View More <i class="fa fa-chevron-down ms-1" style="font-size: 0.7rem;"></i>
                    </a>
                    <div class="collapse mt-3" id="moreDetailsCollapse">
                        <div class="card card-body border-0 bg-light p-3" style="font-size: 0.8rem; border-radius: 8px;">
                            <div class="row g-2">
                                <div class="col-5 text-muted fw-semibold">Color:</div>
                                <div class="col-7 text-dark fw-bold"><?= htmlspecialchars($p['color'] ?? 'Dual-tone') ?></div>
                                <div class="col-5 text-muted fw-semibold">Dimensions:</div>
                                <div class="col-7 text-dark fw-bold"><?= htmlspecialchars($p['dimensions'] ?? 'Standard Saree') ?></div>
                                <div class="col-5 text-muted fw-semibold">SKU:</div>
                                <div class="col-7 text-dark fw-bold"><?= htmlspecialchars($p['sku']) ?></div>
                                <div class="col-5 text-muted fw-semibold">Weight:</div>
                                <div class="col-7 text-dark fw-bold"><?= htmlspecialchars($p['weight'] ?? 'N/A') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="w-100 border-top bg-white py-2.5 sticky-bottom-bar" style="position: sticky; bottom: 0; left: 0; z-index: 1020; box-shadow: 0 -4px 12px rgba(0,0,0,0.05);">
    <div class="container-xl">
        <div class="row g-2 justify-content-end align-items-center">
            <div class="col-6 col-md-3">
                <button class="btn btn-outline-dark w-100 py-2.5 fw-bold text-uppercase d-flex align-items-center justify-content-center gap-2" id="detail-buy-now-btn" data-variant-id="<?= htmlspecialchars($p['variant_id']) ?>" style="border-radius: 4px; font-size: 0.85rem; letter-spacing: 0.05em; border-color: var(--pavitra-pink) !important; color: var(--pavitra-pink) !important;">
                    <i class="fa-solid fa-bag-shopping"></i> Buy Now
                </button>
            </div>
            <div class="col-6 col-md-3">
                <button class="btn w-100 py-2.5 fw-bold text-uppercase text-white d-flex align-items-center justify-content-center gap-2" id="detail-add-bag-btn" data-variant-id="<?= htmlspecialchars($p['variant_id']) ?>" style="background: var(--pavitra-pink); border-radius: 4px; font-size: 0.85rem; letter-spacing: 0.05em; border: none;">
                    <i class="fa-solid fa-bag-shopping"></i> Add to Bag
                </button>
            </div>
        </div>
    </div>
</div>
<div id="imageZoomOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.9); z-index: 9999; align-items: center; justify-content: center; cursor: zoom-out;">
    <img id="zoomed-saree-img" src="" class="img-fluid" style="max-height: 90vh; max-width: 90vw; object-fit: contain; transform: scale(1); transition: transform 0.25s ease;">
    <div class="position-absolute d-flex gap-3" style="bottom: 30px; left: 50%; transform: translateX(-50%); z-index: 10000;">
        <button class="btn btn-dark btn-sm rounded-circle d-flex align-items-center justify-content-center" id="btn-zoom-in" style="width: 40px; height: 40px;"><i class="fa-solid fa-plus fs-5"></i></button>
        <button class="btn btn-dark btn-sm rounded-circle d-flex align-items-center justify-content-center" id="btn-zoom-out" style="width: 40px; height: 40px;"><i class="fa-solid fa-minus fs-5"></i></button>
    </div>
</div>
<script>
$(document).ready(function() {
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
                if (typeof window.updateCartCount === 'function') {
                    window.updateCartCount();
                } else {
                    location.reload();
                }
            },
            error: function(xhr) {
                window.showToast(xhr.responseJSON ? xhr.responseJSON.error : 'Failed to add to bag');
                btn.prop('disabled', false).html('<i class="fa-solid fa-bag-shopping"></i> Add to Bag');
            }
        });
    });
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
                if (typeof window.openCart === 'function') {
                    window.openCart();
                } else {
                    window.location.href = '/';
                }
            },
            error: function(xhr) {
                window.showToast(xhr.responseJSON ? xhr.responseJSON.error : 'Failed to buy now');
                btn.prop('disabled', false).html('<i class="fa-solid fa-bag-shopping"></i> Buy Now');
            }
        });
    });
    $('.detail-wishlist-btn').on('click', function() {
        $(this).toggleClass('active');
        const isActive = $(this).hasClass('active');
        $(this).find('i').toggleClass('fa-regular fa-solid').css('color', isActive ? '#e74c3c' : '');
        showToast(isActive ? 'Added to Wishlist ❤️' : 'Removed from Wishlist');
    });
    $('.color-swatch').on('click', function() {
        $('.color-swatch-wrapper').removeClass('active').css('border-color', 'transparent');
        $(this).closest('.color-swatch-wrapper').addClass('active').css('border-color', '#999');
        const variantId = $(this).attr('data-variant-id');
        const wholesale = parseInt($(this).attr('data-wholesale')).toLocaleString('en-IN');
        const mrp = $(this).attr('data-mrp');
        const saving = $(this).attr('data-saving');
        const image = $(this).attr('data-image');
        const sku = $(this).attr('data-sku');
        $('#detail-add-bag-btn').attr('data-variant-id', variantId);
        $('#detail-buy-now-btn').attr('data-variant-id', variantId);
        $('#detail-wholesale-price').text('₹' + wholesale);
        $('#detail-mrp').text('MRP ₹' + mrp);
        $('#detail-saving').text('(Rs. ' + saving + ' OFF)');
        $('#detail-sku').text(sku);
        if(image && image !== '') {
            $('#detail-saree-img').attr('src', image);
        }
    });
});
function changeMainMedia(url, type, element) {
    $('.thumbnail-item').removeClass('border-dark').addClass('opacity-75');
    if (element) {
        $(element).removeClass('opacity-75').addClass('border-dark');
    }
    $('#detail-saree-img').hide();
    $('#detail-saree-video').hide();
    $('#detail-saree-iframe').hide();
    if (type === 'image') {
        $('#detail-saree-img').attr('src', url).show();
    } else if (type === 'video') {
        if (url.includes('youtube.com') || url.includes('vimeo.com')) {
            $('#detail-saree-iframe').attr('src', url).show();
        } else {
            $('#detail-saree-video').attr('src', url).show();
        }
    }
}
</script>
