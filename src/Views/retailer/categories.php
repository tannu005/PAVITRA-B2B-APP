<?php
?>
<div class="container-xl py-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="row g-4">
        <div class="col-lg-3 d-none d-lg-block">
            <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 80px; overflow: hidden;">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-bold text-uppercase" style="letter-spacing: 0.05em; color: var(--pavitra-pink);">Shop Directory</h6>
                </div>
                <div class="card-body p-0" style="max-height: calc(100vh - 150px); overflow-y: auto;">
                    <div class="accordion accordion-flush" id="categoriesAccordion">
                        <?php $accIndex = 0; foreach($groupedCategories as $groupName => $cats): ?>
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="heading<?= $accIndex ?>">
                                    <button class="accordion-button <?= $accIndex > 0 ? 'collapsed' : '' ?> fw-bold bg-light text-dark" style="box-shadow: none;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $accIndex ?>" aria-expanded="<?= $accIndex === 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $accIndex ?>">
                                        <?= htmlspecialchars($groupName) ?>
                                    </button>
                                </h2>
                                <div id="collapse<?= $accIndex ?>" class="accordion-collapse collapse <?= $accIndex === 0 ? 'show' : '' ?>" aria-labelledby="heading<?= $accIndex ?>">
                                    <div class="accordion-body p-0">
                                        <div class="list-group list-group-flush">
                                            <?php foreach($cats as $cat): ?>
                                                <a href="/categories?category=<?= $cat['slug'] ?>" class="list-group-item list-group-item-action py-2 px-4 border-0 <?= $activeCategory === $cat['slug'] ? 'active' : '' ?>" style="<?= $activeCategory === $cat['slug'] ? 'background-color: var(--pavitra-pink); color: white; font-weight: bold;' : 'color: #555; font-weight: 500; font-size: 0.9rem;' ?>">
                                                    <?= htmlspecialchars($cat['name']) ?>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $accIndex++; endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-dark mb-0"><?= !empty($activeCategory) ? htmlspecialchars(str_replace('+', ' ', $activeCategory)) : 'All Collections' ?></h4>
                <span class="text-muted small fw-semibold"><?= count($products) ?> Products</span>
            </div>
            
            <?php if(empty($products)): ?>
                <div class="text-center py-5 my-5 bg-white rounded-4 shadow-sm">
                    <div class="fs-1 text-muted mb-3"><i class="fa-solid fa-box-open"></i></div>
                    <h5 class="fw-bold text-dark">No products found</h5>
                    <p class="text-muted mb-4">We couldn't find any products in this category.</p>
                    <a href="/categories" class="btn text-white fw-bold px-4 rounded-pill" style="background-color: var(--pavitra-pink);">View All Categories</a>
                </div>
            <?php else: ?>
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
                    <?php foreach ($products as $p): 
                        $wholesalePrice = floatval($p['wholesale_price']);
                        $price = floatval($p['price']);
                        $mrp = number_format($price > 0 ? $price : $wholesalePrice + 8500);
                        $discount = $price > $wholesalePrice ? round((($price - $wholesalePrice) / $price) * 100) : 0;
                        
                        $colors = [];
                        if(!empty($p['all_colors'])) {
                            $colors = array_filter(array_unique(explode('|', $p['all_colors'])));
                        }
                    ?>
                        <div class="col">
                            <a href="/product/<?= $p['id'] ?>" class="text-decoration-none d-block h-100">
                                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden product-card" style="transition: transform 0.2s ease, box-shadow 0.2s ease;">
                                    <div class="position-relative bg-light" style="padding-top: 133.33%;">
                                        <img loading="lazy" src="<?= htmlspecialchars($p['image_url'] ?: '/assets/images/placeholder.png') ?>" 
                                             class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover;">
                                        <?php if ($discount > 0): ?>
                                            <span class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 fw-bold" style="font-size: 0.65rem; border-bottom-right-radius: 8px;">
                                                <?= $discount ?>% OFF
                                            </span>
                                        <?php endif; ?>
                                        <button class="btn btn-light rounded-circle position-absolute top-0 end-0 m-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" onclick="event.preventDefault(); window.showToast('Added to Wishlist ❤️');">
                                            <i class="fa-regular fa-heart text-danger"></i>
                                        </button>
                                    </div>
                                    <div class="card-body p-3 d-flex flex-column">
                                        <div class="text-muted mb-1 text-truncate" style="font-size: 0.7rem; font-weight: 600; text-transform: uppercase;"><?= htmlspecialchars($p['category_name']) ?></div>
                                        <h6 class="card-title text-dark fw-bold mb-1 text-truncate" style="font-size: 0.85rem; color: #482922 !important;"><?= htmlspecialchars($p['title']) ?></h6>
                                        <div class="d-flex align-items-baseline gap-2 mb-2">
                                            <span class="fw-bold fs-6 text-dark">₹<?= number_format($wholesalePrice) ?></span>
                                            <span class="text-decoration-line-through text-muted" style="font-size: 0.75rem;">₹<?= $mrp ?></span>
                                        </div>
                                        
                                        <?php if(!empty($colors) && count($colors) > 1): ?>
                                            <div class="d-flex flex-wrap gap-1 mt-auto pt-2">
                                                <?php 
                                                $displayCount = min(4, count($colors));
                                                for($i = 0; $i < $displayCount; $i++): 
                                                    $c = strtolower(trim($colors[$i]));
                                                    $cssColors = ['white', 'black', 'red', 'blue', 'green', 'yellow', 'pink', 'purple', 'orange', 'teal', 'grey', 'brown', 'navy', 'maroon', 'olive', 'silver', 'gold', 'cyan', 'magenta', 'beige', 'mustard', 'peach', 'lavender', 'coral', 'mint'];
                                                    $bg = in_array($c, $cssColors) ? $c : '#ccc';
                                                ?>
                                                    <a href="/product/<?= $p['id'] ?>?color=<?= urlencode(trim($colors[$i])) ?>" class="rounded-circle border d-inline-block" style="width: 14px; height: 14px; background-color: <?= $bg ?>;" title="<?= htmlspecialchars($colors[$i]) ?>"></a>
                                                <?php endfor; ?>
                                                <?php if(count($colors) > 4): ?>
                                                    <span class="text-muted fw-bold" style="font-size: 0.65rem; line-height: 14px;">+<?= count($colors) - 4 ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="mt-auto pt-2">
                                                <span class="badge bg-light text-dark border fw-normal" style="font-size: 0.65rem;">Single Color</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<style>
.product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.1) !important;
}
</style>
