<?php
$activeGroup = 'Categories';
if (!empty($activeCategory)) {

    foreach ($groupedCategories as $gName => $cats) {
        foreach ($cats as $c) {
            if ($c['slug'] === $activeCategory) {
                $activeGroup = $gName;
                break 2;
            }
        }
    }
} else {

    if (!empty($groupedCategories)) {
        $activeGroup = array_key_first($groupedCategories);
    }
}
?>
<div class="w-100" style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <div class="px-3 py-2 bg-white sticky-top d-flex align-items-center" style="z-index: 1020; border-bottom: 1px solid #eee;">
        <div class="input-group" style="border: 1px solid #ccc; border-radius: 20px; overflow: hidden;">
            <input type="text" class="form-control border-0 shadow-none ps-3" placeholder="Sarees 🔥" style="font-size: 0.9rem;">
            <span class="input-group-text bg-white border-0 text-muted px-2"><i class="fa-solid fa-camera"></i></span>
            <button class="btn btn-dark px-3 rounded-0 m-1 rounded-circle" style="background-color: #111; color: white;"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>


    <div class="row g-0" style="height: calc(100vh - 125px); margin-bottom: 60px;">
        

        <div class="col-4 col-md-3 bg-light overflow-y-auto" style="height: 100%;">
            <div class="list-group list-group-flush">
                <?php foreach($groupedCategories as $groupName => $cats): 

                    $firstCatSlug = $cats[0]['slug'] ?? '';
                    $isActive = ($activeGroup === $groupName);
                ?>
                    <a href="/categories?category=<?= $firstCatSlug ?>" 
                       class="list-group-item list-group-item-action py-3 px-2 border-0 text-center text-uppercase <?= $isActive ? 'active-group' : '' ?>" 
                       style="font-size: 0.75rem; letter-spacing: 0.5px; background-color: <?= $isActive ? 'white' : '#f8f9fa' ?>; color: <?= $isActive ? 'var(--pavitra-pink)' : '#555' ?>;">
                        <?= htmlspecialchars($groupName) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>


        <div class="col-8 col-md-9 bg-white overflow-y-auto pb-4" style="height: 100%;">
            
            <div class="d-flex justify-content-between align-items-center mb-3 mt-3 px-3">
                <h5 class="text-uppercase fw-bold mb-0" style="letter-spacing: 0.5px; font-size: 1.1rem; color: #111;">
                    <?= htmlspecialchars($activeGroup) ?>
                </h5>
                <a href="/categories" class="text-dark text-decoration-none" style="font-size: 0.8rem;">View all <i class="fa-solid fa-chevron-right" style="font-size: 0.7rem;"></i></a>
            </div>

            <?php if(empty($products)): ?>
                <div class="text-center py-5">
                    <div class="fs-1 text-muted mb-2"><i class="fa-solid fa-box-open"></i></div>
                    <p class="text-muted mb-4 small">No products found in this category.</p>
                </div>
            <?php else: ?>
                <div class="row row-cols-2 g-2 px-2">
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
                        <div class="col mb-2">
                            <a href="/product/<?= $p['id'] ?>" class="text-decoration-none d-block h-100">
                                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden product-card bg-white pb-2">
                                    <div class="position-relative bg-light" style="padding-top: 133.33%;">
                                        <img loading="lazy" src="<?= htmlspecialchars($p['image_url'] ?: '/assets/images/placeholder.png') ?>" 
                                             class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover;">
                                        
                                        <?php if ($discount > 0): ?>
                                            <span class="position-absolute top-0 start-0 text-white px-2 py-1 fw-bold" style="background-color: #f43f5e; font-size: 0.65rem; border-bottom-right-radius: 8px;">
                                                <?= $discount ?>% OFF
                                            </span>
                                        <?php endif; ?>
                                        

                                        <button class="btn btn-white rounded-circle position-absolute top-0 end-0 shadow-sm d-flex align-items-center justify-content-center m-1" style="width: 28px; height: 28px; background: white;" onclick="event.preventDefault(); window.showToast('Added to Wishlist ❤️');">
                                            <i class="fa-regular fa-heart" style="color: #f43f5e; font-size: 0.8rem;"></i>
                                        </button>
                                    </div>
                                    
                                    <div class="card-body p-2 d-flex flex-column">
                                        <div class="text-muted mb-1 text-truncate text-uppercase" style="font-size: 0.6rem; font-weight: 600; letter-spacing: 0.3px;">
                                            <?= htmlspecialchars($p['category_name']) ?>
                                        </div>
                                        <h6 class="card-title text-dark fw-bold mb-1 text-truncate" style="font-size: 0.8rem; color: #3e2723 !important;">
                                            <?= htmlspecialchars($p['title']) ?>
                                        </h6>
                                        <div class="d-flex align-items-baseline gap-1 mb-2">
                                            <span class="fw-bold text-dark" style="font-size: 0.9rem;">₹<?= number_format($wholesalePrice) ?></span>
                                            <span class="text-decoration-line-through text-muted" style="font-size: 0.65rem;">₹<?= $mrp ?></span>
                                        </div>
                                        
                                        <div class="mt-auto">
                                            <?php if(!empty($colors) && count($colors) > 1): ?>
                                                <span class="badge bg-light text-dark border fw-normal py-1" style="font-size: 0.6rem; border-color: #ddd !important; border-radius: 4px;">
                                                    <?= count($colors) ?> Colors
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-light text-dark border fw-normal py-1" style="font-size: 0.6rem; border-color: #ddd !important; border-radius: 4px;">
                                                    Single Color
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            

            <button class="btn btn-dark rounded-pill position-fixed shadow d-flex align-items-center gap-2" style="bottom: 80px; right: 20px; z-index: 1030; background-color: #222;">
                <i class="fa-solid fa-sliders"></i> Filters
            </button>
            
        </div>
    </div>
</div>

<style>

.list-group-item.active-group {
    border-left: 4px solid var(--pavitra-pink) !important;
    font-weight: 800 !important;
}


body {
    overflow: hidden;
}
</style>
