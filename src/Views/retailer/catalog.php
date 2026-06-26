<!-- Meesho-Style B2B Catalog Storefront -->
<div class="container-xl py-4">
    <!-- Promotional Hero Banner -->
    <div class="meesho-promo-banner d-flex flex-column flex-md-row align-items-md-center justify-content-between p-4 p-md-5 mb-4">
        <div class="meesho-promo-text mb-3 mb-md-0">
            <span class="badge bg-danger text-uppercase px-3 py-2 mb-2" style="letter-spacing: 1px; font-size: 0.75rem;">DIRECT FROM WEAVERS</span>
            <h2 class="fw-extrabold text-pink mt-1">Varanasi Handloom Cluster B2B</h2>
            <p class="text-muted mb-0 fs-5">Buy in wholesale lots at authentic local cost. Direct settlement & fast dispatch.</p>
        </div>
        <div class="meesho-promo-badge bg-white p-3 rounded shadow-sm border border-pink text-center" style="min-width: 180px;">
            <div class="fs-6 fw-bold text-muted text-uppercase" style="font-size: 0.7rem !important;">MOQ Starts At</div>
            <div class="fs-2 fw-black text-pink">3-5 Pcs</div>
            <div class="text-secondary small">Viraasat Woven Guarantee</div>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar Filters -->
        <aside class="col-lg-3 mb-4">
            <form id="filter-form" method="GET" action="/" class="meesho-filter-panel shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                    <h5 class="fw-bold mb-0" style="font-size: 1.05rem;"><i class="fa-solid fa-sliders me-2 text-pink"></i>Filters</h5>
                    <a href="/" class="text-pink text-decoration-none small fw-semibold">Clear All</a>
                </div>

                <!-- Search Carryover (hidden) -->
                <?php if (!empty($searchQuery)): ?>
                    <input type="hidden" name="search" value="<?= htmlspecialchars($searchQuery) ?>">
                <?php endif; ?>

                <!-- Sort Carryover (hidden) -->
                <?php if (!empty($sort)): ?>
                    <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
                <?php endif; ?>

                <!-- Category Filter -->
                <div class="meesho-filter-section">
                    <h6 class="meesho-filter-title">Weaving Category</h6>
                    <div class="d-flex flex-column gap-2" style="max-height: 200px; overflow-y: auto;">
                        <label class="meesho-filter-option mb-0">
                            <input type="radio" name="category" value="" <?= empty($selectedCategory) ? 'checked' : '' ?> onchange="this.form.submit()">
                            <span>All Categories</span>
                        </label>
                        <?php foreach ($categoriesList as $cat): ?>
                            <label class="meesho-filter-option mb-0">
                                <input type="radio" name="category" value="<?= htmlspecialchars($cat['name']) ?>" <?= $selectedCategory === $cat['name'] ? 'checked' : '' ?> onchange="this.form.submit()">
                                <span><?= htmlspecialchars($cat['name']) ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Price Range Filter -->
                <div class="meesho-filter-section">
                    <h6 class="meesho-filter-title">Wholesale Price (₹)</h6>
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <input type="number" name="min_price" class="form-control form-control-sm" placeholder="Min" value="<?= $minPrice > 0 ? intval($minPrice) : '' ?>">
                        </div>
                        <div class="col-6">
                            <input type="number" name="max_price" class="form-control form-control-sm" placeholder="Max" value="<?= $maxPrice > 0 ? intval($maxPrice) : '' ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-meesho-pink btn-sm w-100 py-1">Apply Price</button>
                </div>

                <!-- Guarantee Tag -->
                <div class="bg-light p-3 rounded border" style="font-size: 0.75rem;">
                    <div class="fw-bold text-success mb-1"><i class="fa fa-circle-check me-1"></i>Viraasat Certified</div>
                    All weavers are registered under GI tag registry and verified by our operational team.
                </div>
            </form>
        </aside>

        <!-- Product Grid & Sorting -->
        <section class="col-lg-9">
            <!-- Grid Header Controls -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 bg-white p-3 rounded border shadow-sm gap-2">
                <div class="text-muted" style="font-size: 0.9rem;">
                    Showing <span class="fw-semibold text-dark"><?= count($products) ?></span> handloom products
                    <?php if (!empty($selectedCategory)): ?>
                        in <span class="badge bg-pink-light text-pink fs-7"><?= htmlspecialchars($selectedCategory) ?></span>
                    <?php endif; ?>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-nowrap text-muted" style="font-size: 0.85rem;">Sort By:</span>
                    <select class="form-select form-select-sm border-secondary-subtle" id="sort-selector" style="width: 170px;">
                        <option value="" <?= empty($sort) ? 'selected' : '' ?>>Trending / New</option>
                        <option value="price_low" <?= $sort === 'price_low' ? 'selected' : '' ?>>Price: Low to High</option>
                        <option value="price_high" <?= $sort === 'price_high' ? 'selected' : '' ?>>Price: High to Low</option>
                    </select>
                </div>
            </div>

            <!-- Products Feed Grid -->
            <?php if (empty($products)): ?>
                <div class="card p-5 text-center shadow-sm border border-light">
                    <i class="fa-solid fa-face-frown text-muted mb-3" style="font-size: 3rem;"></i>
                    <h5 class="fw-bold">No Products Found</h5>
                    <p class="text-muted mb-0">Try clearing price filters or search query to view active inventory.</p>
                </div>
            <?php else: ?>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                    <?php foreach ($products as $p): ?>
                        <div class="col">
                            <!-- Meesho Card -->
                            <div class="meesho-product-card product-card-trigger" data-id="<?= $p['id'] ?>">
                                <div class="meesho-card-img-wrapper">
                                    <img src="<?= htmlspecialchars($p['image_url'] ?: '/assets/images/placeholder.png') ?>" alt="<?= htmlspecialchars($p['title']) ?>" class="meesho-card-img">
                                </div>
                                <div class="meesho-card-body">
                                    <div class="small text-pink fw-semibold text-uppercase mb-1" style="font-size: 0.65rem;"><?= htmlspecialchars($p['category_name']) ?></div>
                                    <h6 class="meesho-card-title mb-1"><?= htmlspecialchars($p['title']) ?></h6>
                                    
                                    <!-- Price Row -->
                                    <div class="meesho-card-price-row align-items-center">
                                        <span class="meesho-price-wholesale">₹<?= number_format($p['wholesale_price']) ?></span>
                                        <span class="meesho-price-retail text-decoration-line-through text-muted small">₹<?= number_format($p['price']) ?></span>
                                        <span class="meesho-price-discount fw-bold small text-pink"><?= intval((($p['price'] - $p['wholesale_price']) / $p['price']) * 100) ?>% Off</span>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <!-- Rating -->
                                        <div class="meesho-rating-badge">
                                            <span>4.2</span> <i class="fa-solid fa-star" style="font-size: 0.65rem;"></i>
                                        </div>
                                        <!-- SKU code -->
                                        <span class="text-muted" style="font-size: 0.75rem;">SKU: <?= htmlspecialchars($p['sku']) ?></span>
                                    </div>

                                    <!-- MOQ alert -->
                                    <div class="meesho-moq-tag">
                                        MOQ: <?= $p['bulk_threshold'] ?> Pcs
                                    </div>

                                    <div class="meesho-delivery-tag mt-3 w-100 text-center">
                                        🛡 Weaver-Direct Verified Delivery
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </div>
</div>

<!-- Product Details Modal Overlay -->
<div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content meesho-modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="productDetailModalLabel">Saree Specification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-content-body">
                <!-- Loaded dynamically via AJAX -->
                <div class="text-center py-5">
                    <div class="spinner-border text-pink" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page Specific JS -->
<script>
    $(document).ready(function() {
        // Sorting filter selector submit
        $('#sort-selector').on('change', function() {
            const val = $(this).val();
            const urlParams = new URLSearchParams(window.location.search);
            if (val) {
                urlParams.set('sort', val);
            } else {
                urlParams.delete('sort');
            }
            window.location.search = urlParams.toString();
        });

        // Trigger Detail Modal
        $('.product-card-trigger').on('click', function(e) {
            // Prevent trigger if they click an internal button
            if ($(e.target).closest('button').length > 0) return;
            
            const productId = $(this).data('id');
            $('#productDetailModal').modal('show');
            $('#modal-content-body').html(`
                <div class="text-center py-5">
                    <div class="spinner-border text-danger" style="color: var(--meesho-pink) !important;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `);

            $.ajax({
                url: '/product/' + productId,
                method: 'GET',
                dataType: 'json',
                success: function(p) {
                    const priceFormatted = parseFloat(p.price).toLocaleString('en-IN');
                    const wholesaleFormatted = parseFloat(p.wholesale_price).toLocaleString('en-IN');
                    const discount = Math.round(((p.price - p.wholesale_price) / p.price) * 100);

                    const html = `
                        <div class="row g-4">
                            <!-- Image Column -->
                            <div class="col-md-5">
                                <img src="${p.image_url || '/assets/images/placeholder.png'}" class="img-fluid rounded border w-100" style="max-height: 450px; object-fit: cover;">
                            </div>
                            <!-- Content Details Column -->
                            <div class="col-md-7">
                                <div class="badge bg-pink text-white mb-2" style="background-color: var(--meesho-pink);">${p.category_name}</div>
                                <h4 class="fw-bold mb-2">${p.title}</h4>
                                <p class="text-muted small mb-3">SKU: <code class="text-dark">${p.sku}</code></p>
                                
                                <!-- Pricing block -->
                                <div class="bg-light p-3 rounded mb-3 border">
                                    <div class="d-flex align-items-baseline gap-2 mb-1">
                                        <span class="fs-3 fw-bold text-dark">₹${wholesaleFormatted}</span>
                                        <span class="text-decoration-line-through text-muted">₹${priceFormatted}</span>
                                        <span class="text-pink fw-bold">${discount}% OFF</span>
                                    </div>
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-1 mb-2">Wholesale Tier Rate</span>
                                    <p class="small text-muted mb-0">Buy <strong>${p.bulk_threshold} or more pieces</strong> of this item to activate the wholesale rate. Single pieces are sold at ₹${priceFormatted}.</p>
                                </div>

                                <!-- Specs -->
                                <h6 class="fw-bold text-uppercase text-muted" style="font-size: 0.75rem;">Saree Specification</h6>
                                <table class="table table-sm table-bordered mb-3 text-secondary" style="font-size: 0.85rem;">
                                    <tr>
                                        <th class="bg-light" style="width: 30%;">Color</th>
                                        <td>${p.color || 'Standard Woven'}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Size / Length</th>
                                        <td>${p.size || '6.3 Meters (With Blouse Piece)'}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Weight</th>
                                        <td>${p.weight ? p.weight + ' g' : 'Approx 700g'}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Dimensions</th>
                                        <td>${p.dimensions || '6.3m x 1.2m'}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">In Stock</th>
                                        <td><span class="badge bg-success-subtle text-success">${p.stock} units available</span></td>
                                    </tr>
                                </table>

                                <!-- Description -->
                                <h6 class="fw-bold text-uppercase text-muted" style="font-size: 0.75rem;">Weaving Craft Description</h6>
                                <p style="font-size: 0.85rem; line-height: 1.6; color: #555;">${p.description}</p>

                                <!-- Add to Cart Row -->
                                <div class="row g-2 align-items-center mt-3 pt-3 border-top">
                                    <div class="col-4 col-sm-3">
                                        <select class="form-select border-secondary-subtle" id="modal-qty-select">
                                            ${[...Array(15).keys()].map(i => `<option value="${i+1}">${i+1}</option>`).join('')}
                                        </select>
                                    </div>
                                    <div class="col-8 col-sm-9">
                                        <button class="btn btn-meesho-pink w-100 py-2" id="modal-add-cart-btn" data-variant-id="${p.variant_id}">
                                            <i class="fa fa-shopping-bag me-2"></i> Add to Wholesale Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#modal-content-body').html(html);
                },
                error: function() {
                    $('#modal-content-body').html('<p class="text-danger text-center py-5">Product details failed to load.</p>');
                }
            });
        });

        // Add to Cart from Modal
        $(document).on('click', '#modal-add-cart-btn', function() {
            const variantId = $(this).data('variant-id');
            const qty = parseInt($('#modal-qty-select').val() || 1);
            
            $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Adding...');

            $.ajax({
                url: '/cart/add',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ variant_id: variantId, quantity: qty }),
                dataType: 'json',
                success: function(res) {
                    $('#productDetailModal').modal('hide');
                    // Trigger slider open
                    $('#cart-trigger-btn').click();
                },
                error: function(xhr) {
                    const err = xhr.responseJSON ? xhr.responseJSON.error : 'Failed to add item to cart';
                    alert(err);
                    $('#modal-add-cart-btn').prop('disabled', false).html('<i class="fa fa-shopping-bag me-2"></i> Add to Wholesale Cart');
                }
            });
        });
    });
</script>
