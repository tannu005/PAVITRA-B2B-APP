<?php
function renderProductCard($p) {
$hoverImg = !empty($p['hover_image_url']) ? $p['hover_image_url'] : ($p['image_url'] ?: '/assets/images/placeholder.png');
    $price = floatval($p['price']);
    $wholesalePrice = floatval($p['wholesale_price']);
    $discVal = $price > $wholesalePrice ? round((($price - $wholesalePrice) / $price) * 100) : 0;
    $badges = ['New In', 'Most Popular', 'Limited Stock', 'Best Seller'];
    $badgeColors = ['#1a1a1a', '#8B6914', '#C75000', '#2E7D32'];
    $badgeIdx = $p['id'] % 4;
    ob_start();
    ?>
    <div class="pavitra-product-card minimal product-card-trigger" data-id="<?= $p['id'] ?>" data-json="<?= htmlspecialchars(json_encode($p), ENT_QUOTES, 'UTF-8') ?>">
        <div class="pavitra-card-img-wrapper position-relative">
            <img loading="lazy" src="<?= htmlspecialchars($p['image_url'] ?: '/assets/images/placeholder.png') ?>" alt="<?= htmlspecialchars($p['title']) ?>" class="pavitra-card-img" loading="lazy">
            <img loading="lazy" src="<?= $hoverImg ?>" alt="<?= htmlspecialchars($p['title']) ?> Back View" class="pavitra-card-img-hover" loading="lazy">
            <button class="wishlist-heart-btn" onclick="event.stopPropagation(); $(this).toggleClass('active'); showToast($(this).hasClass('active') ? 'Added to Wishlist ❤️' : 'Removed from Wishlist');">
                <i class="fa-solid fa-heart"></i>
            </button>
            <?php if ($discVal > 0): ?>
                <span class="badge position-absolute border-0 text-white" style="top: 8px; left: 8px; font-size: 0.6rem; border-radius: 2px; font-weight: 700; padding: 4px 8px; letter-spacing: 0.05em; text-transform: uppercase; background-color: <?= $badgeColors[$badgeIdx] ?>;"><?= $discVal ?>% OFF</span>
            <?php else: ?>
                <span class="badge position-absolute border-0 text-white" style="top: 8px; left: 8px; font-size: 0.6rem; border-radius: 2px; font-weight: 700; padding: 4px 8px; letter-spacing: 0.05em; text-transform: uppercase; background-color: <?= $badgeColors[$badgeIdx] ?>;"><?= $badges[$badgeIdx] ?></span>
            <?php endif; ?>
            <button class="pavitra-quick-add-btn position-absolute w-100 py-2 border-0 text-white text-uppercase fw-bold" data-variant-id="<?= $p['variant_id'] ?>" style="bottom: 0; left: 0; background-color: rgba(72, 41, 34, 0.95); transition: transform 0.3s ease, opacity 0.3s ease; transform: translateY(100%);">
                + Quick Add
            </button>
        </div>
        <div class="pavitra-card-body text-start pt-2 pb-3 px-2">

            <div class="text-muted fw-bold mb-1 custom-caps" style="font-size: 0.85rem; color: #555 !important;"><?= htmlspecialchars($p['brand_name'] ?? 'Pavitra') ?></div>
            <h6 class="pavitra-card-title mb-1 pavitra-product-title custom-caps" style="font-weight: normal; color: #333; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; height: 40px;"><?= htmlspecialchars($p['title']) ?></h6>
            <div class="pavitra-price-wholesale fw-bold text-dark mt-2 pavitra-product-price" style="font-size: 1.1rem;">
                ₹<?= number_format($wholesalePrice) ?>
                <?php if ($price > $wholesalePrice): ?>
                    <span class="text-decoration-line-through text-muted fw-normal ms-1 pavitra-product-price-compare" style="font-size: 0.8rem;">₹<?= number_format($price) ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
$isFiltered = !empty($selectedCategory) || !empty($searchQuery) || !empty($sort) || ($minPrice > 0) || ($maxPrice > 0) || !empty($_GET['all_sarees']);
?>
<div class="container-xl py-2 py-md-4">
    <div class="pavitra-category-scroll d-flex d-md-none px-3 mb-2">
        <a href="/" class="category-circle-item <?= empty($selectedCategory) ? 'active' : '' ?>">
            <?php if (empty($selectedCategory)): ?>
                <div class="category-circle-img d-flex align-items-center justify-content-center text-white fw-bold" style="font-size: 1rem; border: none; background-color: var(--pavitra-pink) !important;">All</div>
            <?php else: ?>
                <div class="category-circle-img d-flex align-items-center justify-content-center bg-light text-dark fw-semibold" style="font-size: 1rem; border: 1px solid #ECEFF1;">All</div>
            <?php endif; ?>
            <div class="category-circle-title">All Sarees</div>
        </a>
        <?php 
        $occasionTypes = ['Wedding Wear', 'Bridal Sarees', 'Party Wear', 'Festival Wear', 'Office Wear', 'Daily Wear', 'Reception', 'Haldi'];
        $placeholders = ['/kanjeevaram.png', '/banarasi.png', '/patola.png', '/tissue.png', '/kanjeevaram_1782883481838.png', '/banarasi_1782883519429.png', '/patola_1782883499288.png', '/tissue_1782883588057.png'];
        foreach (array_slice($occasionTypes, 0, 8) as $idx => $catName): 
            $img = $placeholders[$idx % count($placeholders)];
        ?>
        <a href="/?category=<?= urlencode($catName) ?>" class="category-circle-item <?= $selectedCategory === $catName ? 'active' : '' ?>">
            <img src="<?= $img ?>" class="category-circle-img" alt="<?= htmlspecialchars($catName) ?>" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 1px solid #ECEFF1; display: block; margin: 0 auto;">
            <div class="category-circle-title mt-1" style="font-size: 0.75rem; text-align: center; color: #333; font-weight: 600;"><?= htmlspecialchars(explode(' ', $catName)[0]) ?></div>
        </a>
        <?php endforeach; ?>
    </div>
    <?php if (!$isFiltered): ?>
    <div id="heroCarousel" class="carousel slide carousel-fade mb-0" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="w-100 position-relative" style="background-image: linear-gradient(rgba(0,0,0,0.05), rgba(0,0,0,0.35)), url('/saree-banner1.png'); height: 65vh; min-height: 420px; max-height: 650px; background-size: cover; background-position: center;">
                    <div class="position-absolute start-0 top-0 p-4 text-white text-uppercase d-none d-md-block" style="font-size: 0.85rem; font-weight: 700; letter-spacing: 0.15em; text-shadow: 0 2px 8px rgba(0,0,0,0.5);">
                        <span style="border-left: 3px solid #FFF; padding-left: 12px;">Wedding Season 2026</span>
                    </div>
                    <div class="position-absolute start-50 translate-middle-x text-center text-white" style="bottom: 60px; width: 90%;">
                        <h1 class="mb-2 pavitra-hero-title" style="text-shadow: 0 4px 20px rgba(0,0,0,0.6); color: #FFF !important;">Shaadi Ka Ghar</h1>
                        <p class="mb-3 pavitra-hero-subtitle" style="color: rgba(255,255,255,0.7);">Pavitra Banarasi Bridal Collection</p>
                        <a href="/?category=Banarasi+Sarees" class="btn btn-light rounded-0 px-5 py-2 text-uppercase fw-bold pavitra-hero-cta" style="color: #482922;">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="w-100 position-relative" style="background-image: linear-gradient(rgba(0,0,0,0.05), rgba(0,0,0,0.35)), url('/saree-banner3.png'); height: 65vh; min-height: 420px; max-height: 650px; background-size: cover; background-position: center;">
                    <div class="position-absolute start-0 top-0 p-4 text-white text-uppercase d-none d-md-block" style="font-size: 0.85rem; font-weight: 700; letter-spacing: 0.15em; text-shadow: 0 2px 8px rgba(0,0,0,0.5);">
                        <span style="border-left: 3px solid #FFF; padding-left: 12px;">Handloomed Zari Heritage</span>
                    </div>
                    <div class="position-absolute start-50 translate-middle-x text-center text-white" style="bottom: 60px; width: 90%;">
                        <h1 class="mb-2 pavitra-hero-title" style="text-shadow: 0 4px 20px rgba(0,0,0,0.6); color: #FFF !important;">Royal Silk</h1>
                        <p class="mb-3 pavitra-hero-subtitle" style="color: rgba(255,255,255,0.7);">Wholesale Silk Weaves</p>
                        <a href="/?category=Silk+Sarees" class="btn btn-light rounded-0 px-5 py-2 text-uppercase fw-bold pavitra-hero-cta" style="color: #482922;">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="w-100 position-relative" style="background-image: linear-gradient(rgba(0,0,0,0.05), rgba(0,0,0,0.35)), url('/saree-banner2.png'); height: 65vh; min-height: 420px; max-height: 650px; background-size: cover; background-position: center;">
                    <div class="position-absolute start-0 top-0 p-4 text-white text-uppercase d-none d-md-block" style="font-size: 0.85rem; font-weight: 700; letter-spacing: 0.15em; text-shadow: 0 2px 8px rgba(0,0,0,0.5);">
                        <span style="border-left: 3px solid #FFF; padding-left: 12px;">Double Ikat Masterpiece</span>
                    </div>
                    <div class="position-absolute start-50 translate-middle-x text-center text-white" style="bottom: 60px; width: 90%;">
                        <h1 class="mb-2 pavitra-hero-title" style="text-shadow: 0 4px 20px rgba(0,0,0,0.6); color: #FFF !important;">Bandhej & Leheriya</h1>
                        <p class="mb-3 pavitra-hero-subtitle" style="color: rgba(255,255,255,0.7);">Traditional Handloom Craft</p>
                        <a href="/?category=Bandhej+Sarees" class="btn btn-light rounded-0 px-5 py-2 text-uppercase fw-bold pavitra-hero-cta" style="color: #482922;">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="w-100 position-relative" style="background-image: linear-gradient(rgba(0,0,0,0.05), rgba(0,0,0,0.35)), url('/saree-banner4.png'); height: 65vh; min-height: 420px; max-height: 650px; background-size: cover; background-position: center;">
                    <div class="position-absolute start-0 top-0 p-4 text-white text-uppercase d-none d-md-block" style="font-size: 0.85rem; font-weight: 700; letter-spacing: 0.15em; text-shadow: 0 2px 8px rgba(0,0,0,0.5);">
                        <span style="border-left: 3px solid #FFF; padding-left: 12px;">Sheer Elegance</span>
                    </div>
                    <div class="position-absolute start-50 translate-middle-x text-center text-white" style="bottom: 60px; width: 90%;">
                        <h1 class="mb-2 pavitra-hero-title" style="text-shadow: 0 4px 20px rgba(0,0,0,0.6); color: #FFF !important;">Organza & Tissue</h1>
                        <p class="mb-3 pavitra-hero-subtitle" style="color: rgba(255,255,255,0.7);">Lightweight Premium Drapes</p>
                        <a href="/?category=Organza+Sarees" class="btn btn-light rounded-0 px-5 py-2 text-uppercase fw-bold pavitra-hero-cta" style="color: #482922;">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
    <div class="carousel-section-wrapper position-relative my-5 py-3" style="font-family: 'Nunito', sans-serif;">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="text-uppercase fw-normal mb-0 pavitra-section-title">Pavitra Muse</h2>
                <p class="text-muted text-uppercase mb-0 pavitra-section-subtitle">Curated Most Wanted Wholesale Handlooms</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <div class="d-none d-md-flex gap-2">
                    <button class="btn btn-outline-dark rounded-circle pavitra-carousel-prev" style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-width: 1.5px;"><i class="fa fa-chevron-left" style="font-size: 0.7rem;"></i></button>
                    <button class="btn btn-outline-dark rounded-circle pavitra-carousel-next" style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-width: 1.5px;"><i class="fa fa-chevron-right" style="font-size: 0.7rem;"></i></button>
                </div>
                <a href="/?sort=price_high" class="text-decoration-none text-uppercase fw-bold ms-3 pavitra-section-link" style="color: #482922; border-bottom: 1px solid #482922;">Shop All →</a>
            </div>
        </div>
        <div class="pavitra-carousel-container">
            <?php
            $museCollection = $products;
            usort($museCollection, function($a, $b) { return $b['wholesale_price'] <=> $a['wholesale_price']; });
            foreach (array_slice($museCollection, 0, 8) as $item): ?>
                <div class="pavitra-carousel-item"><?= renderProductCard($item) ?></div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="w-100 my-5 pavitra-parallax-container" style="height: 45vh; min-height: 320px; max-height: 480px;">
        <div class="pavitra-parallax-bg" style="background-image: linear-gradient(rgba(0,0,0,0.35), rgba(0,0,0,0.45)), url('/shaadi-banner.png');"></div>
        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-center text-white p-4" style="position: relative; z-index: 2;">
            <p class="text-uppercase mb-2 pavitra-hero-subtitle" style="color: rgba(255,255,255,0.6);">Wholesale Wedding Collection</p>
            <h2 class="text-uppercase mb-3 pavitra-hero-title" style="text-shadow: 0 4px 15px rgba(0,0,0,0.5); color: #FFF !important;">Tyoharcore</h2>
            <p class="mb-4" style="font-size: 0.85rem; color: rgba(255,255,255,0.7); max-width: 500px;">Festive silks handpicked for the bridal season. Bulk orders with exclusive wholesale margins.</p>
            <a href="/?category=Bridal+Sarees" class="btn btn-outline-light rounded-0 px-5 py-2 text-uppercase fw-bold pavitra-hero-cta" style="border-width: 2px;">Explore Collection</a>
        </div>
    </div>
    <div class="carousel-section-wrapper position-relative my-5 py-3" style="font-family: 'Nunito', sans-serif;">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="text-uppercase fw-normal mb-0 pavitra-section-title">New Arrivals</h2>
                <p class="text-muted text-uppercase mb-0 pavitra-section-subtitle">Fresh Off the Handloom — Just Landed</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <div class="d-none d-md-flex gap-2">
                    <button class="btn btn-outline-dark rounded-circle pavitra-carousel-prev" style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-width: 1.5px;"><i class="fa fa-chevron-left" style="font-size: 0.7rem;"></i></button>
                    <button class="btn btn-outline-dark rounded-circle pavitra-carousel-next" style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-width: 1.5px;"><i class="fa fa-chevron-right" style="font-size: 0.7rem;"></i></button>
                </div>
                <a href="/?all_sarees=true" class="text-decoration-none text-uppercase fw-bold ms-3 pavitra-section-link" style="color: #482922; border-bottom: 1px solid #482922;">Shop All →</a>
            </div>
        </div>
        <div class="pavitra-carousel-container">
            <?php foreach (array_slice($products, 0, 8) as $item): ?>
                <div class="pavitra-carousel-item"><?= renderProductCard($item) ?></div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="my-5 py-4" id="home-categories-grid">
        <div class="text-center mb-5">
            <h2 class="text-uppercase fw-normal pavitra-section-title">Shop by Weaving Style</h2>
            <p class="text-muted text-uppercase mb-0 pavitra-section-subtitle">Weaver-Direct GI-Tagged Handloom Masterpieces</p>
        </div>
        <div class="row g-3 g-md-4 justify-content-center">
            <?php
            $cats = [];
            $fallbackImages = ['/kanjeevaram.png', '/banarasi.png', '/patola.png', '/tissue.png'];
            foreach (array_slice($categoriesList, 0, 4) as $idx => $c) {
                
                $catImg = $fallbackImages[$idx % count($fallbackImages)]; 
                if (isset($products) && is_array($products)) {
                    foreach($products as $p) {
                        if($p['category_name'] == $c['name'] && !empty($p['image_url'])) {
                            $catImg = $p['image_url'];
                            break;
                        }
                    }
                }
                
                $cats[] = [
                    'name' => $c['name'], 
                    'img' => $catImg, 
                    'link' => '/?category=' . urlencode($c['name']), 
                    'count' => rand(40, 150) . '+ designs'
                ];
            }
            foreach ($cats as $cat): ?>
            <div class="col-6 col-md-3">
                <a href="<?= $cat['link'] ?>" class="pavitra-cat-block position-relative d-block overflow-hidden" style="height: 400px; text-decoration: none;">
                    <div class="pavitra-cat-img w-100 h-100" style="background-image: url('<?= $cat['img'] ?>'); background-size: cover; background-position: center; transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);"></div>
                    <div class="pavitra-cat-overlay position-absolute d-flex flex-column justify-content-end p-4 text-white" style="background: linear-gradient(transparent 40%, rgba(0,0,0,0.7)); top: 0; left: 0; right: 0; bottom: 0;">
                        <h4 class="fw-bold text-uppercase mb-0 pavitra-section-title" style="color: #FFF !important;"><?= $cat['name'] ?></h4>
                        <span class="text-white-50 text-uppercase pavitra-section-subtitle" style="color: rgba(255,255,255,0.5) !important;"><?= $cat['count'] ?> — Explore →</span>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="carousel-section-wrapper position-relative my-5 py-3" style="font-family: 'Nunito', sans-serif;">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="text-uppercase fw-normal mb-0 pavitra-section-title">Goodbye Deals <span style="font-size: 1.2rem;">;)</span></h2>
                <p class="text-muted text-uppercase mb-0 pavitra-section-subtitle">Last Pieces at Best Wholesale Discounts</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <div class="d-none d-md-flex gap-2">
                    <button class="btn btn-outline-dark rounded-circle pavitra-carousel-prev" style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-width: 1.5px;"><i class="fa fa-chevron-left" style="font-size: 0.7rem;"></i></button>
                    <button class="btn btn-outline-dark rounded-circle pavitra-carousel-next" style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-width: 1.5px;"><i class="fa fa-chevron-right" style="font-size: 0.7rem;"></i></button>
                </div>
                <a href="/?sort=price_low" class="text-decoration-none text-uppercase fw-bold ms-3 pavitra-section-link" style="color: #482922; border-bottom: 1px solid #482922;">Shop All →</a>
            </div>
        </div>
        <div class="pavitra-carousel-container">
            <?php
            $deals = $products;
            usort($deals, function($a, $b) { return $a['wholesale_price'] <=> $b['wholesale_price']; });
            foreach (array_slice($deals, 0, 8) as $item): ?>
                <div class="pavitra-carousel-item"><?= renderProductCard($item) ?></div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="my-5 py-5 border-top border-bottom" style="background-color: #FAF8F6; font-family: 'Nunito', sans-serif;">
        <div class="row g-4 text-center">
            <div class="col-4">
                <div class="mb-3"><i class="fa-solid fa-truck-fast" style="font-size: 2rem; color: #482922;"></i></div>
                <h6 class="fw-bold text-uppercase pavitra-section-subtitle" style="color: #1c1c1c;">Fast Shipping</h6>
                <p class="text-secondary mb-0 px-2" style="font-size: 0.75rem;">Dispatched in 24-48 hours from weaver hubs across India.</p>
            </div>
            <div class="col-4">
                <div class="mb-3"><i class="fa-solid fa-arrow-rotate-left" style="font-size: 2rem; color: #482922;"></i></div>
                <h6 class="fw-bold text-uppercase pavitra-section-subtitle" style="color: #1c1c1c;">7-Day Easy Returns</h6>
                <p class="text-secondary mb-0 px-2" style="font-size: 0.75rem;">Hassle-free returns and exchanges on all wholesale orders.</p>
            </div>
            <div class="col-4">
                <div class="mb-3"><i class="fa-solid fa-certificate" style="font-size: 2rem; color: #482922;"></i></div>
                <h6 class="fw-bold text-uppercase pavitra-section-subtitle" style="color: #1c1c1c;">Premium Quality</h6>
                <p class="text-secondary mb-0 px-2" style="font-size: 0.75rem;">100% GI-certified authentic handloom with weaver verification.</p>
            </div>
        </div>
    </div>
    <div class="my-5">
        <section class="pavitra-video-banner position-relative overflow-hidden w-100" style="min-height: 450px;">
            <img src="/uploads/products/desi-romance-bg.jpg" class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover;" alt="Desi Romance Background">
            <div class="pavitra-video-overlay" style="background: rgba(0,0,0,0.3); position: absolute; inset: 0;"></div>
            <div class="pavitra-video-content position-absolute d-flex flex-column justify-content-center align-items-center text-center text-white p-4" style="inset: 0; z-index: 2;">
                <p class="text-uppercase mb-2 pavitra-hero-subtitle" style="color: rgba(255,255,255,0.6);">Heritage Storytelling</p>
                <h2 class="text-uppercase mb-3 pavitra-hero-title" style="text-shadow: 0 4px 15px rgba(0,0,0,0.5); color: #FFF !important;">Desi Romance</h2>
                <p class="mb-4 pavitra-video-copy">A rhythmic celebration of warp and weft. Traditional sarees reimagined for the modern wholesale buyer.</p>
                <a href="/?category=Organza+Sarees" class="btn btn-light rounded-0 px-5 py-2 text-uppercase fw-bold pavitra-hero-cta" style="color: #482922;">Explore Story</a>
            </div>
        </section>
    </div>
    <div class="carousel-section-wrapper position-relative my-5 py-3" style="font-family: 'Nunito', sans-serif;">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="text-uppercase fw-normal mb-0 pavitra-section-title">Wholesale Bestsellers</h2>
                <p class="text-muted text-uppercase mb-0 pavitra-section-subtitle">Top-Selling Sarees Among Our B2B Retailers</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <div class="d-none d-md-flex gap-2">
                    <button class="btn btn-outline-dark rounded-circle pavitra-carousel-prev" style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-width: 1.5px;"><i class="fa fa-chevron-left" style="font-size: 0.7rem;"></i></button>
                    <button class="btn btn-outline-dark rounded-circle pavitra-carousel-next" style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-width: 1.5px;"><i class="fa fa-chevron-right" style="font-size: 0.7rem;"></i></button>
                </div>
                <a href="/?all_sarees=true" class="text-decoration-none text-uppercase fw-bold ms-3 pavitra-section-link" style="color: #482922; border-bottom: 1px solid #482922;">Shop All →</a>
            </div>
        </div>
        <div class="pavitra-carousel-container">
            <?php
            $bestsellers = $products;
            shuffle($bestsellers);
            foreach (array_slice($bestsellers, 0, 8) as $item): ?>
                <div class="pavitra-carousel-item"><?= renderProductCard($item) ?></div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="w-100 py-5 mt-5" style="background-color: #482922; font-family: 'Nunito', sans-serif;">
        <div class="container text-center py-4">
            <h3 class="text-uppercase fw-bold mb-2 pavitra-section-title" style="color: #FFF !important;">Join the Movement</h3>
            <p class="mb-4" style="font-size: 0.85rem; letter-spacing: 0.04em; color: rgba(255,255,255,0.55);">Get 10% off your first wholesale order. Stay updated on exclusive handloom drops.</p>
            <form class="d-flex justify-content-center gap-2 mx-auto" style="max-width: 480px;" onsubmit="event.preventDefault(); showToast('Subscribed successfully! 🎉'); $(this).find('input').val('');">
                <input type="email" class="form-control rounded-0 border-0 py-2 px-3 pavitra-newsletter-input" placeholder="Enter your email address" required style="font-size: 0.85rem; background: rgba(255,255,255,0.12); color: #FFF !important;">
                <button type="submit" class="btn btn-light rounded-0 px-4 text-uppercase fw-bold" style="font-size: 0.8rem; letter-spacing: 0.12em; color: #482922; white-space: nowrap;">Subscribe</button>
            </form>
        </div>
    </div>
    <?php else: ?>
    <div class="d-flex justify-content-between align-items-center py-2 px-3 border rounded-3 mb-4 refinement-toolbar" style="font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FAF8F5; border-color: #EFECE6 !important;">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-outline-dark btn-sm rounded-pill border-0 text-uppercase fw-bold p-0 d-flex align-items-center" id="refinement-filters-btn" style="font-size: 0.65rem; letter-spacing: 0.08em; color: #482922; background: transparent;">
                <span class="d-inline-flex align-items-center justify-content-center bg-white border rounded-circle me-1" style="width: 24px; height: 24px; border-color: #EFECE6 !important;"><i class="fa-solid fa-sliders" style="font-size: 0.7rem;"></i></span> Filter
            </button>
            <span class="text-uppercase text-muted d-inline-block border-start ps-2" style="font-size: 0.62rem; letter-spacing: 0.06em; font-weight: 600; border-color: #EFECE6 !important; padding-top: 2px;">
                <?= count($products) ?> Pcs
                <?php if (!empty($selectedCategory)): ?>
                    / <span class="text-dark fw-bold"><?= htmlspecialchars(str_replace(' Silk', '', str_replace(' Brocade', '', str_replace(' Weave', '', $selectedCategory)))) ?></span>
                <?php endif; ?>
            </span>
        </div>
        <div class="d-flex align-items-center gap-1">
            <span class="text-nowrap text-secondary text-uppercase d-none d-sm-inline" style="font-size: 0.65rem; letter-spacing: 0.08em; font-weight: 700;">Sort:</span>
            <select class="form-select form-select-sm border-0 bg-transparent rounded-0 py-0" id="sort-selector" style="font-size: 0.68rem; text-transform: uppercase; font-weight: 700; padding: 2px 20px 2px 4px; letter-spacing: 0.04em; color: #1a1a1a; cursor: pointer;">
                <option value="" <?= empty($sort) ? 'selected' : '' ?>>Featured</option>
                <option value="price_low" <?= $sort === 'price_low' ? 'selected' : '' ?>>Price: L-H</option>
                <option value="price_high" <?= $sort === 'price_high' ? 'selected' : '' ?>>Price: H-L</option>
            </select>
        </div>
    </div>
    <div class="row">
        <section class="col-12" id="product-feed-section">
            <?php if (empty($products)): ?>
                <div class="text-center py-5">
                    <i class="fa-solid fa-box-open text-muted mb-3" style="font-size: 3.5rem;"></i>
                    <h5 class="fw-bold">No Products Found</h5>
                    <p class="text-muted mb-3">Try adjusting your filters or search for something else.</p>
                    <a href="/" class="btn btn-dark rounded-0 px-4 py-2 text-uppercase fw-bold" style="font-size: 0.8rem; letter-spacing: 0.1em;">← Back to Collections</a>
                </div>
            <?php else: ?>
                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-3 g-md-4">
                    <?php foreach ($products as $p): ?>
                        <div class="col"><?= renderProductCard($p) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </div>
    <?php endif; ?>
</div>
<script>
$(document).ready(function() {
    $('.pavitra-carousel-prev').on('click', function() {
        const c = $(this).closest('.carousel-section-wrapper').find('.pavitra-carousel-container');
        c.animate({ scrollLeft: c.scrollLeft() - 320 }, 300);
    });
    $('.pavitra-carousel-next').on('click', function() {
        const c = $(this).closest('.carousel-section-wrapper').find('.pavitra-carousel-container');
        c.animate({ scrollLeft: c.scrollLeft() + 320 }, 300);
    });
    $('#sort-selector').on('change', function() {
        const val = $(this).val();
        const u = new URLSearchParams(window.location.search);
        val ? u.set('sort', val) : u.delete('sort');
        window.location.search = u.toString();
    });
    $(document).on('click', '.product-card-trigger', function(e) {
        if ($(e.target).closest('.wishlist-heart-btn, .pavitra-quick-add-btn').length > 0) return;
        const productId = $(this).attr('data-id');
        if (productId) {
            window.location.href = '/product/' + productId;
        }
    });
    $(document).on('click', '.pavitra-quick-add-btn', function(e) {
        e.stopPropagation();
        const btn = $(this);
        const variantId = btn.attr('data-variant-id');
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            url: '/cart/add',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ variant_id: variantId, quantity: 1 }),
            dataType: 'json',
            success: function() {
                btn.prop('disabled', false).html('+ Quick Add');
                showToast('Product added to bag successfully! 🛍️');
                if (typeof window.updateCartCount === 'function') {
                    window.updateCartCount();
                } else {
                    location.reload();
                }
            },
            error: function(xhr) {
                btn.prop('disabled', false).html('+ Quick Add');
                window.showToast(xhr.responseJSON ? xhr.responseJSON.error : 'Failed to add to bag');
            }
        });
    });
    $('#refinement-filters-btn').on('click', function() { $('#filtersModal').modal('show'); });
    const u = new URLSearchParams(window.location.search);
    if (u.has('category') || u.has('sort') || u.has('search') || u.has('min_price') || u.has('all_sarees')) {
        setTimeout(function() {
            const t = $('#product-feed-section');
            if (t.length) { $('html, body').animate({ scrollTop: t.offset().top - 120 }, 600); }
        }, 200);
    }
    if ('IntersectionObserver' in window) {
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    sectionObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
        document.querySelectorAll('.carousel-section-wrapper, #home-categories-grid, .pavitra-footer').forEach(el => {
            el.classList.add('pavitra-anim-section');
            sectionObserver.observe(el);
        });
        const cardObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    $(entry.target).addClass('visible');
                    cardObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.05 });
        document.querySelectorAll('.pavitra-product-card.minimal').forEach(el => cardObserver.observe(el));
        const tileObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, i * 120);
                    tileObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        document.querySelectorAll('.pavitra-cat-block').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1)';
            tileObserver.observe(el);
        });
    }
    const heroCarousel = document.getElementById('heroCarousel');
    if (heroCarousel) {
        heroCarousel.addEventListener('mouseenter', () => {
            bootstrap.Carousel.getInstance(heroCarousel)?.pause();
        });
        heroCarousel.addEventListener('mouseleave', () => {
            bootstrap.Carousel.getInstance(heroCarousel)?.cycle();
        });
    }
    document.querySelectorAll('.pavitra-carousel-container').forEach(container => {
        let isDown = false, startX, scrollLeft;
        container.addEventListener('mousedown', (e) => {
            isDown = true; container.style.cursor = 'grabbing';
            startX = e.pageX - container.offsetLeft;
            scrollLeft = container.scrollLeft;
        });
        container.addEventListener('mouseleave', () => { isDown = false; container.style.cursor = 'grab'; });
        container.addEventListener('mouseup', () => { isDown = false; container.style.cursor = 'grab'; });
        container.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - container.offsetLeft;
            container.scrollLeft = scrollLeft - (x - startX) * 1.5;
        });
    });
});
</script>
<div class="modal fade" id="filtersModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 550px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; background-color: #FFFDF8;">
            <div class="modal-header border-0 pb-2" style="background-color: var(--premium-light-bg); border-top-left-radius: 16px; border-top-right-radius: 16px; padding: 1.25rem;">
                <h5 class="modal-title fw-bold" style="font-family: var(--font-headings); color: var(--pavitra-pink);"><i class="fa-solid fa-sliders me-2" style="color: var(--premium-gold);"></i>Refine Sarees</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <form method="GET" action="/" id="saree-filters-form">
                    <?php if (!empty($searchQuery)): ?>
                        <input type="hidden" name="search" value="<?= htmlspecialchars($searchQuery) ?>">
                    <?php endif; ?>
                    <div class="filter-split-container">
                        <div class="filter-sidebar-menu">
                            <button type="button" class="filter-tab-btn active" data-target="pane-fabric">Fabric</button>
                            <button type="button" class="filter-tab-btn" data-target="pane-color">Color</button>
                            <button type="button" class="filter-tab-btn" data-target="pane-occasion">Occasion</button>
                            <button type="button" class="filter-tab-btn" data-target="pane-price">Price</button>
                            <button type="button" class="filter-tab-btn" data-target="pane-pattern">Pattern</button>
                            <button type="button" class="filter-tab-btn" data-target="pane-style">Weaving</button>
                            <button type="button" class="filter-tab-btn" data-target="pane-blouse">Blouse</button>
                            <button type="button" class="filter-tab-btn" data-target="pane-dimensions">Size</button>
                            <button type="button" class="filter-tab-btn" data-target="pane-ratings">Ratings</button>
                            <button type="button" class="filter-tab-btn" data-target="pane-brand">Brand</button>
                            <button type="button" class="filter-tab-btn" data-target="pane-care">Care</button>
                            <button type="button" class="filter-tab-btn" data-target="pane-delivery">Delivery</button>
                            <button type="button" class="filter-tab-btn" data-target="pane-deals">Deals</button>
                            <button type="button" class="filter-tab-btn" data-target="pane-green">Green</button>
                        </div>
                        <div class="filter-content-panel">
                            <div class="filter-pane-group active" id="pane-fabric">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--pavitra-pink); letter-spacing:0.05em;">Fabric / Material</h6>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach (['Pure Silk', 'Soft Silk', 'Organza', 'Georgette', 'Chiffon', 'Cotton', 'Tissue', 'Linen'] as $f): ?>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size:0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_fabric[]" value="<?= htmlspecialchars($f) ?>"> <?= htmlspecialchars($f) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                              </div>
                            <div class="filter-pane-group" id="pane-occasion">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--pavitra-pink); letter-spacing:0.05em;">Occasion & Usage</h6>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach (['Wedding Wear', 'Party Wear', 'Festival Wear', 'Office Wear', 'Daily Wear', 'Reception Collection', 'Haldi Collection', 'Mehendi Collection', 'Sangeet Collection'] as $occ): ?>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size:0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_occasion[]" value="<?= htmlspecialchars($occ) ?>"> <?= htmlspecialchars($occ) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="filter-pane-group" id="pane-price">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--pavitra-pink); letter-spacing:0.05em;">Wholesale Price (₹)</h6>
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <input type="number" name="min_price" class="form-control form-control-sm rounded-0" placeholder="Min" value="<?= $minPrice > 0 ? intval($minPrice) : '' ?>">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="max_price" class="form-control form-control-sm rounded-0" placeholder="Max" value="<?= $maxPrice > 0 ? intval($maxPrice) : '' ?>">
                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-2 border-top pt-2">
                                    <label class="small text-muted" style="font-size:0.65rem; font-weight:700;">Price Brackets</label>
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="radio" name="price_bracket" value="under_1000" onchange="document.getElementsByName('min_price')[0].value=''; document.getElementsByName('max_price')[0].value='1000';"> Under ₹1,000
                                    </label>
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="radio" name="price_bracket" value="1000_5000" onchange="document.getElementsByName('min_price')[0].value='1000'; document.getElementsByName('max_price')[0].value='5000';"> ₹1,000 – ₹5,000
                                    </label>
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="radio" name="price_bracket" value="5001_10000" onchange="document.getElementsByName('min_price')[0].value='5001'; document.getElementsByName('max_price')[0].value='10000';"> ₹5,001 – ₹10,000
                                    </label>
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="radio" name="price_bracket" value="above_10000" onchange="document.getElementsByName('min_price')[0].value='10001'; document.getElementsByName('max_price')[0].value='';"> ₹10,000+
                                    </label>
                                </div>
                            </div>
                            <div class="filter-pane-group" id="pane-pattern">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--pavitra-pink); letter-spacing:0.05em;">Pattern / Design</h6>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach (['Plain / Solid', 'Printed (Floral/Motifs)', 'Embroidered / Zari / Sequined', 'Patchwork / Appliqué', 'Block Print / Handloom'] as $pat): ?>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size:0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_pattern[]" value="<?= htmlspecialchars($pat) ?>"> <?= htmlspecialchars($pat) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="filter-pane-group" id="pane-style">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--pavitra-pink); letter-spacing:0.05em;">Weaving Styles</h6>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach ($categoriesList as $cat): ?>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size:0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_regional[]" value="<?= htmlspecialchars($cat['name']) ?>" <?= $selectedCategory === $cat['name'] ? 'checked' : '' ?>> <?= htmlspecialchars($cat['name']) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="filter-pane-group" id="pane-blouse">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--pavitra-pink); letter-spacing:0.05em;">Blouse Customization</h6>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach (['Matching blouse included', 'Full Sleeve options', 'Short Sleeve / Sleeveless', 'Customizable blouse specs'] as $bl): ?>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size:0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_blouse[]" value="<?= htmlspecialchars($bl) ?>"> <?= htmlspecialchars($bl) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="filter-pane-group" id="pane-dimensions">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--pavitra-pink); letter-spacing:0.05em;">Saree Size</h6>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach (['Standard length (5.5–6.5m)', 'Plus-size / Extended drape', 'Custom width variations'] as $dim): ?>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size:0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_dimensions[]" value="<?= htmlspecialchars($dim) ?>"> <?= htmlspecialchars($dim) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="filter-pane-group" id="pane-ratings">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--pavitra-pink); letter-spacing:0.05em;">Ratings & Popularity</h6>
                                <div class="d-flex flex-column gap-2">
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="checkbox" name="filter_rating" value="4_star_above"> <span style="color:var(--premium-gold);"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span> 4-Star & Above
                                    </label>
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="checkbox" name="filter_popular" value="trending"> <i class="fa-solid fa-fire me-1" style="color:#e67e22;"></i> Trending
                                    </label>
                                </div>
                            </div>
                            <div class="filter-pane-group" id="pane-brand">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--pavitra-pink); letter-spacing:0.05em;">Brand & Artisan Hubs</h6>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach (['Local Handloom Co-ops', 'Weaver Artisan Labels', 'Exclusive Boutique Brands'] as $br): ?>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size:0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_brand[]" value="<?= htmlspecialchars($br) ?>"> <?= htmlspecialchars($br) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="filter-pane-group" id="pane-care">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--pavitra-pink); letter-spacing:0.05em;">Care Instructions</h6>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach (['Dry clean only', 'Machine washable', 'Gentle handwash recommended'] as $care): ?>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size:0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_care[]" value="<?= htmlspecialchars($care) ?>"> <?= htmlspecialchars($care) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="filter-pane-group" id="pane-delivery">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--pavitra-pink); letter-spacing:0.05em;">Availability</h6>
                                <div class="d-flex flex-column gap-2">
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="checkbox" name="filter_stock" value="in_stock" checked> In Stock / Ready to Ship
                                    </label>
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="checkbox" name="filter_shipping" value="fast_delivery"> Same-Day Shipping
                                    </label>
                                </div>
                            </div>
                            <div class="filter-pane-group" id="pane-deals">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--pavitra-pink); letter-spacing:0.05em;">New & Deals</h6>
                                <div class="d-flex flex-column gap-2">
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="checkbox" name="filter_newest" value="yes"> Recently Loomed (New)
                                    </label>
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="checkbox" name="filter_discount" value="yes"> Discounted Bundles
                                    </label>
                                </div>
                            </div>
                            <div class="filter-pane-group" id="pane-green">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--pavitra-pink); letter-spacing:0.05em;">Ethical Sourcing</h6>
                                <div class="d-flex flex-column gap-2">
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="checkbox" name="filter_organic" value="organic"> Organic Cotton / Silk
                                    </label>
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="checkbox" name="filter_fairtrade" value="fairtrade"> Weaver Fair Trade
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 border-0 d-flex gap-2" style="background-color: var(--premium-light-bg); border-bottom-left-radius: 16px; border-bottom-right-radius: 16px; border-top: 1px solid var(--premium-border);">
                        <button type="button" class="btn btn-outline-secondary w-50 py-2 rounded-0 text-uppercase fw-bold" style="font-size: 0.72rem; letter-spacing: 0.05em;" onclick="document.getElementById('saree-filters-form').reset()">Clear All</button>
                        <button type="submit" class="btn btn-pavitra-pink w-50 py-2 rounded-0 text-uppercase fw-bold" style="font-size: 0.72rem; letter-spacing: 0.05em;">Apply Filters</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.filter-tab-btn').on('click', function() {
        $('.filter-tab-btn').removeClass('active');
        $(this).addClass('active');
        var targetPane = $(this).data('target');
        $('.filter-pane-group').removeClass('active');
        $('#' + targetPane).addClass('active');
    });
    $(document).on('click', '.zoomable-saree-img', function(e) {
        var src = $(this).attr('src');
        if (!src) return;
        var lightboxHtml = `
            <div class="pavitra-zoom-lightbox">
                <button class="pavitra-zoom-close" title="Close"><i class="fa-solid fa-xmark"></i></button>
                <div class="pavitra-zoom-wrapper">
                    <img loading="lazy" src="${src}" class="pavitra-zoom-img" alt="Zoom Saree">
                </div>
                <div class="pavitra-zoom-controls">
                    <button class="pavitra-zoom-btn btn-zoom-out" title="Zoom Out"><i class="fa-solid fa-minus"></i></button>
                    <button class="pavitra-zoom-btn btn-zoom-reset" style="font-size: 0.8rem; font-weight: bold;" title="Reset Zoom">1:1</button>
                    <button class="pavitra-zoom-btn btn-zoom-in" title="Zoom In"><i class="fa-solid fa-plus"></i></button>
                </div>
            </div>
        `;
        $('body').append(lightboxHtml);
        setTimeout(function() {
            $('.pavitra-zoom-lightbox').addClass('show');
        }, 10);
        var scale = 1;
        var posX = 0, posY = 0;
        var startX = 0, startY = 0;
        var isDragging = false;
        var $img = $('.pavitra-zoom-img');
        var $wrapper = $('.pavitra-zoom-wrapper');
        function updateTransform() {
            $img.css('transform', `translate3d(${posX}px, ${posY}px, 0) scale(${scale})`);
        }
        $('.btn-zoom-in').on('click', function(e) {
            e.stopPropagation();
            scale = Math.min(scale + 0.5, 4);
            updateTransform();
        });
        $('.btn-zoom-out').on('click', function(e) {
            e.stopPropagation();
            scale = Math.max(scale - 0.5, 0.5);
            if (scale === 1) {
                posX = 0;
                posY = 0;
            }
            updateTransform();
        });
        $('.btn-zoom-reset').on('click', function(e) {
            e.stopPropagation();
            scale = 1;
            posX = 0;
            posY = 0;
            updateTransform();
        });
        $('.pavitra-zoom-close, .pavitra-zoom-lightbox').on('click', function(e) {
            if (e.target !== this && !$(e.target).closest('.pavitra-zoom-close').length) return;
            $('.pavitra-zoom-lightbox').removeClass('show');
            setTimeout(function() {
                $('.pavitra-zoom-lightbox').remove();
            }, 300);
        });
        $wrapper.on('mousedown touchstart', function(e) {
            e.preventDefault();
            isDragging = true;
            var clientX = e.clientX || (e.originalEvent.touches ? e.originalEvent.touches[0].clientX : 0);
            var clientY = e.clientY || (e.originalEvent.touches ? e.originalEvent.touches[0].clientY : 0);
            startX = clientX - posX;
            startY = clientY - posY;
        });
        $(document).on('mousemove touchmove', function(e) {
            if (!isDragging) return;
            var clientX = e.clientX || (e.originalEvent.touches ? e.originalEvent.touches[0].clientX : 0);
            var clientY = e.clientY || (e.originalEvent.touches ? e.originalEvent.touches[0].clientY : 0);
            posX = clientX - startX;
            posY = clientY - startY;
            updateTransform();
        });
        $(document).on('mouseup touchend', function() {
            isDragging = false;
        });
        $wrapper.on('wheel', function(e) {
            e.preventDefault();
            var delta = e.originalEvent.deltaY;
            if (delta < 0) {
                scale = Math.min(scale + 0.25, 4);
            } else {
                scale = Math.max(scale - 0.25, 0.5);
            }
            updateTransform();
        });
    });
});
</script>
