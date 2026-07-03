<?php
// =============================================
// PAVITRA WHOLESALE SAREE MARKETPLACE
// NISHORAMA-STYLE 10-SECTION LANDING PAGE
// =============================================

// Reusable helper function to render a product card matching Nishorama specifications
function renderProductCard($p) {
    $hoverImg = '/saree-banner1.png';
    if (strpos($p['image_url'], 'kanjeevaram') !== false) {
        $hoverImg = '/saree-banner2.png';
    } else if (strpos($p['image_url'], 'patola') !== false) {
        $hoverImg = '/saree-banner3.png';
    } else if (strpos($p['image_url'], 'tissue') !== false) {
        $hoverImg = '/saree-banner4.png';
    } else if (strpos($p['image_url'], 'banarasi') !== false) {
        $hoverImg = '/saree-banner1.png';
    }
    
    $price = floatval($p['price']);
    $wholesalePrice = floatval($p['wholesale_price']);
    $discVal = $price > $wholesalePrice ? round((($price - $wholesalePrice) / $price) * 100) : 0;
    
    $badges = ['New In', 'Most Popular', 'Limited Stock', 'Best Seller'];
    $badgeColors = ['#1a1a1a', '#8B6914', '#C75000', '#2E7D32'];
    $badgeIdx = $p['id'] % 4;
    
    ob_start();
    ?>
    <div class="meesho-product-card minimal product-card-trigger" data-id="<?= $p['id'] ?>" data-json="<?= htmlspecialchars(json_encode($p), ENT_QUOTES, 'UTF-8') ?>">
        <div class="nisho-card-img-wrapper position-relative">
            <img src="<?= htmlspecialchars($p['image_url'] ?: '/assets/images/placeholder.png') ?>" alt="<?= htmlspecialchars($p['title']) ?>" class="nisho-card-img" loading="lazy">
            <img src="<?= $hoverImg ?>" alt="<?= htmlspecialchars($p['title']) ?> Back View" class="nisho-card-img-hover" loading="lazy">
            <!-- Wishlist Heart -->
            <button class="wishlist-heart-btn" onclick="event.stopPropagation(); $(this).toggleClass('active'); showToast($(this).hasClass('active') ? 'Added to Wishlist ❤️' : 'Removed from Wishlist');">
                <i class="fa-solid fa-heart"></i>
            </button>
            <!-- Badge -->
            <?php if ($discVal > 0): ?>
                <span class="badge position-absolute border-0 text-white" style="top: 8px; left: 8px; font-size: 0.6rem; border-radius: 2px; font-weight: 700; padding: 4px 8px; letter-spacing: 0.05em; text-transform: uppercase; background-color: <?= $badgeColors[$badgeIdx] ?>;"><?= $discVal ?>% OFF</span>
            <?php else: ?>
                <span class="badge position-absolute border-0 text-white" style="top: 8px; left: 8px; font-size: 0.6rem; border-radius: 2px; font-weight: 700; padding: 4px 8px; letter-spacing: 0.05em; text-transform: uppercase; background-color: <?= $badgeColors[$badgeIdx] ?>;"><?= $badges[$badgeIdx] ?></span>
            <?php endif; ?>
            <!-- Quick Add -->
            <button class="nisho-quick-add-btn position-absolute w-100 py-2 border-0 text-white text-uppercase fw-bold nisho-section-link" style="bottom: 0; left: 0; background-color: rgba(72, 41, 34, 0.95); transition: transform 0.3s ease, opacity 0.3s ease; transform: translateY(100%);">
                + Quick Add
            </button>
        </div>
        <div class="meesho-card-body text-center pt-2 pb-3">
            <h6 class="meesho-card-title mb-1 text-uppercase nisho-product-title"><?= htmlspecialchars($p['title']) ?></h6>
            <div class="meesho-price-wholesale fw-bold text-dark mb-1 nisho-product-price">
                Rs. <?= number_format($wholesalePrice) ?>
                <?php if ($price > $wholesalePrice): ?>
                    <span class="text-decoration-line-through text-muted fw-normal ms-1 nisho-product-price-compare">Rs. <?= number_format($price) ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

// Detect if filters are active
$isFiltered = !empty($selectedCategory) || !empty($searchQuery) || !empty($sort) || ($minPrice > 0) || ($maxPrice > 0);
?>

<!-- Meesho-Style Catalog Storefront -->
<div class="container-xl py-2 py-md-4">
    <!-- Mobile Category Pills (Horizontal Scroll) -->
    <div class="meesho-category-scroll d-flex d-md-none px-3 mb-2">
        <a href="/" class="category-circle-item <?= empty($selectedCategory) ? 'active' : '' ?>">
            <?php if (empty($selectedCategory)): ?>
                <div class="category-circle-img d-flex align-items-center justify-content-center text-white fw-bold" style="font-size: 1rem; border: none; background-color: var(--meesho-pink) !important;">All</div>
            <?php else: ?>
                <div class="category-circle-img d-flex align-items-center justify-content-center bg-light text-dark fw-semibold" style="font-size: 1rem; border: 1px solid #ECEFF1;">All</div>
            <?php endif; ?>
            <div class="category-circle-title">All Sarees</div>
        </a>
        <a href="/?category=Kanjeevaram+Silk" class="category-circle-item <?= $selectedCategory === 'Kanjeevaram Silk' ? 'active' : '' ?>">
            <img src="/kanjeevaram_1782883481838.png" class="category-circle-img" alt="Kanjeevaram">
            <div class="category-circle-title">Kanjeevaram</div>
        </a>
        <a href="/?category=Banarasi+Brocade" class="category-circle-item <?= $selectedCategory === 'Banarasi Brocade' ? 'active' : '' ?>">
            <img src="/banarasi_1782883519429.png" class="category-circle-img" alt="Banarasi">
            <div class="category-circle-title">Banarasi</div>
        </a>
        <a href="/?category=Patola+Silk" class="category-circle-item <?= $selectedCategory === 'Patola Silk' ? 'active' : '' ?>">
            <img src="/patola_1782883499288.png" class="category-circle-img" alt="Patola">
            <div class="category-circle-title">Patola</div>
        </a>
        <a href="/?category=Organza+Silk" class="category-circle-item <?= $selectedCategory === 'Organza Silk' ? 'active' : '' ?>">
            <img src="/tissue_1782883588057.png" class="category-circle-img" alt="Organza">
            <div class="category-circle-title">Organza</div>
        </a>
        <a href="/?category=Chanderi+Weave" class="category-circle-item <?= $selectedCategory === 'Chanderi Weave' ? 'active' : '' ?>">
            <img src="/banarasi_1782883568122.png" class="category-circle-img" alt="Chanderi">
            <div class="category-circle-title">Chanderi</div>
        </a>
        <a href="/?category=Mysore+Crepe+Silk" class="category-circle-item <?= $selectedCategory === 'Mysore Crepe Silk' ? 'active' : '' ?>">
            <img src="/kanjeevaram_1782883536799.png" class="category-circle-img" alt="Mysore Silk">
            <div class="category-circle-title">Mysore Silk</div>
        </a>
        <a href="/?category=Jamdani+Muslin" class="category-circle-item <?= $selectedCategory === 'Jamdani Muslin' ? 'active' : '' ?>">
            <img src="/patola_1782883552751.png" class="category-circle-img" alt="Jamdani">
            <div class="category-circle-title">Jamdani</div>
        </a>
    </div>

    <?php if (!$isFiltered): ?>
    <!-- ========================================== -->
    <!-- NISHORAMA 10-SECTION EDITORIAL HOMEPAGE    -->
    <!-- ========================================== -->

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 1: HERO BANNER (Full Width, 65vh)  -->
    <!-- ═══════════════════════════════════════════ -->
    <div id="heroCarousel" class="carousel slide carousel-fade mb-0" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
        </div>
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="w-100 position-relative" style="background-image: linear-gradient(rgba(0,0,0,0.05), rgba(0,0,0,0.35)), url('/saree-banner1.png'); height: 65vh; min-height: 420px; max-height: 650px; background-size: cover; background-position: center;">
                    <div class="position-absolute start-0 top-0 p-4 text-white text-uppercase d-none d-md-block" style="font-size: 0.85rem; font-weight: 700; letter-spacing: 0.15em; text-shadow: 0 2px 8px rgba(0,0,0,0.5);">
                        <span style="border-left: 3px solid #FFF; padding-left: 12px;">Wedding Season 2026</span>
                    </div>
                    <div class="position-absolute start-50 translate-middle-x text-center text-white" style="bottom: 60px; width: 90%;">
                        <h1 class="mb-2 nisho-hero-title" style="text-shadow: 0 4px 20px rgba(0,0,0,0.6); color: #FFF !important;">Shaadi Ka Ghar</h1>
                        <p class="mb-3 nisho-hero-subtitle" style="color: rgba(255,255,255,0.7);">Pavitra Banarasi Bridal Collection</p>
                        <a href="/?category=Banarasi+Brocade" class="btn btn-light rounded-0 px-5 py-2 text-uppercase fw-bold nisho-hero-cta" style="color: #482922;">Shop Now</a>
                    </div>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="w-100 position-relative" style="background-image: linear-gradient(rgba(0,0,0,0.05), rgba(0,0,0,0.35)), url('/saree-banner2.png'); height: 65vh; min-height: 420px; max-height: 650px; background-size: cover; background-position: center;">
                    <div class="position-absolute start-0 top-0 p-4 text-white text-uppercase d-none d-md-block" style="font-size: 0.85rem; font-weight: 700; letter-spacing: 0.15em; text-shadow: 0 2px 8px rgba(0,0,0,0.5);">
                        <span style="border-left: 3px solid #FFF; padding-left: 12px;">Handloomed Zari Heritage</span>
                    </div>
                    <div class="position-absolute start-50 translate-middle-x text-center text-white" style="bottom: 60px; width: 90%;">
                        <h1 class="mb-2 nisho-hero-title" style="text-shadow: 0 4px 20px rgba(0,0,0,0.6); color: #FFF !important;">Royal Kanjeevaram</h1>
                        <p class="mb-3 nisho-hero-subtitle" style="color: rgba(255,255,255,0.7);">Wholesale Temple Silk Weaves</p>
                        <a href="/?category=Kanjeevaram+Silk" class="btn btn-light rounded-0 px-5 py-2 text-uppercase fw-bold nisho-hero-cta" style="color: #482922;">Shop Now</a>
                    </div>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="w-100 position-relative" style="background-image: linear-gradient(rgba(0,0,0,0.05), rgba(0,0,0,0.35)), url('/saree-banner3.png'); height: 65vh; min-height: 420px; max-height: 650px; background-size: cover; background-position: center;">
                    <div class="position-absolute start-0 top-0 p-4 text-white text-uppercase d-none d-md-block" style="font-size: 0.85rem; font-weight: 700; letter-spacing: 0.15em; text-shadow: 0 2px 8px rgba(0,0,0,0.5);">
                        <span style="border-left: 3px solid #FFF; padding-left: 12px;">Double Ikat Masterpiece</span>
                    </div>
                    <div class="position-absolute start-50 translate-middle-x text-center text-white" style="bottom: 60px; width: 90%;">
                        <h1 class="mb-2 nisho-hero-title" style="text-shadow: 0 4px 20px rgba(0,0,0,0.6); color: #FFF !important;">Patan Patola</h1>
                        <p class="mb-3 nisho-hero-subtitle" style="color: rgba(255,255,255,0.7);">GI-Tagged Handloom Craft</p>
                        <a href="/?category=Patola+Silk" class="btn btn-light rounded-0 px-5 py-2 text-uppercase fw-bold nisho-hero-cta" style="color: #482922;">Shop Now</a>
                    </div>
                </div>
            </div>
            <!-- Slide 4 -->
            <div class="carousel-item">
                <div class="w-100 position-relative" style="background-image: linear-gradient(rgba(0,0,0,0.05), rgba(0,0,0,0.35)), url('/saree-banner4.png'); height: 65vh; min-height: 420px; max-height: 650px; background-size: cover; background-position: center;">
                    <div class="position-absolute start-0 top-0 p-4 text-white text-uppercase d-none d-md-block" style="font-size: 0.85rem; font-weight: 700; letter-spacing: 0.15em; text-shadow: 0 2px 8px rgba(0,0,0,0.5);">
                        <span style="border-left: 3px solid #FFF; padding-left: 12px;">Sheer Elegance</span>
                    </div>
                    <div class="position-absolute start-50 translate-middle-x text-center text-white" style="bottom: 60px; width: 90%;">
                        <h1 class="mb-2 nisho-hero-title" style="text-shadow: 0 4px 20px rgba(0,0,0,0.6); color: #FFF !important;">Organza & Tissue</h1>
                        <p class="mb-3 nisho-hero-subtitle" style="color: rgba(255,255,255,0.7);">Lightweight Premium Drapes</p>
                        <a href="/?category=Organza+Silk" class="btn btn-light rounded-0 px-5 py-2 text-uppercase fw-bold nisho-hero-cta" style="color: #482922;">Shop Now</a>
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

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 2: CAROUSEL #1 — PAVITRA MUSE      -->
    <!-- ═══════════════════════════════════════════ -->
    <div class="carousel-section-wrapper position-relative my-5 py-3" style="font-family: 'Nunito', sans-serif;">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="text-uppercase fw-normal mb-0 nisho-section-title">Pavitra Muse</h2>
                <p class="text-muted text-uppercase mb-0 nisho-section-subtitle">Curated Most Wanted Wholesale Handlooms</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <div class="d-none d-md-flex gap-2">
                    <button class="btn btn-outline-dark rounded-circle nisho-carousel-prev" style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-width: 1.5px;"><i class="fa fa-chevron-left" style="font-size: 0.7rem;"></i></button>
                    <button class="btn btn-outline-dark rounded-circle nisho-carousel-next" style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-width: 1.5px;"><i class="fa fa-chevron-right" style="font-size: 0.7rem;"></i></button>
                </div>
                <a href="/?sort=price_high" class="text-decoration-none text-uppercase fw-bold ms-3 nisho-section-link" style="color: #482922; border-bottom: 1px solid #482922;">Shop All →</a>
            </div>
        </div>
        <div class="nisho-carousel-container">
            <?php
            $museCollection = $products;
            usort($museCollection, function($a, $b) { return $b['wholesale_price'] <=> $a['wholesale_price']; });
            foreach (array_slice($museCollection, 0, 8) as $item): ?>
                <div class="nisho-carousel-item"><?= renderProductCard($item) ?></div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 3: PROMOTIONAL BANNER — SHAADI     -->
    <!-- Parallax full-width image + text overlay    -->
    <!-- ═══════════════════════════════════════════ -->
    <div class="w-100 my-5 nisho-parallax-container" style="height: 45vh; min-height: 320px; max-height: 480px;">
        <div class="nisho-parallax-bg" style="background-image: linear-gradient(rgba(0,0,0,0.35), rgba(0,0,0,0.45)), url('/shaadi-banner.png');"></div>
        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-center text-white p-4" style="position: relative; z-index: 2;">
            <p class="text-uppercase mb-2 nisho-hero-subtitle" style="color: rgba(255,255,255,0.6);">Wholesale Wedding Collection</p>
            <h2 class="text-uppercase mb-3 nisho-hero-title" style="text-shadow: 0 4px 15px rgba(0,0,0,0.5); color: #FFF !important;">Tyoharcore</h2>
            <p class="mb-4" style="font-size: 0.85rem; color: rgba(255,255,255,0.7); max-width: 500px;">Festive silks handpicked for the bridal season. Bulk orders with exclusive wholesale margins.</p>
            <a href="/?category=Banarasi+Brocade" class="btn btn-outline-light rounded-0 px-5 py-2 text-uppercase fw-bold nisho-hero-cta" style="border-width: 2px;">Explore Collection</a>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 4: CAROUSEL #2 — NEW ARRIVALS       -->
    <!-- ═══════════════════════════════════════════ -->
    <div class="carousel-section-wrapper position-relative my-5 py-3" style="font-family: 'Nunito', sans-serif;">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="text-uppercase fw-normal mb-0 nisho-section-title">New Arrivals</h2>
                <p class="text-muted text-uppercase mb-0 nisho-section-subtitle">Fresh Off the Handloom — Just Landed</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <div class="d-none d-md-flex gap-2">
                    <button class="btn btn-outline-dark rounded-circle nisho-carousel-prev" style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-width: 1.5px;"><i class="fa fa-chevron-left" style="font-size: 0.7rem;"></i></button>
                    <button class="btn btn-outline-dark rounded-circle nisho-carousel-next" style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-width: 1.5px;"><i class="fa fa-chevron-right" style="font-size: 0.7rem;"></i></button>
                </div>
                <a href="/" class="text-decoration-none text-uppercase fw-bold ms-3 nisho-section-link" style="color: #482922; border-bottom: 1px solid #482922;">Shop All →</a>
            </div>
        </div>
        <div class="nisho-carousel-container">
            <?php foreach (array_slice($products, 0, 8) as $item): ?>
                <div class="nisho-carousel-item"><?= renderProductCard($item) ?></div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 5: CATEGORY SHOWCASE GRID           -->
    <!-- 4 large tiles with hover zoom effects       -->
    <!-- ═══════════════════════════════════════════ -->
    <div class="my-5 py-4" id="home-categories-grid">
        <div class="text-center mb-5">
            <h2 class="text-uppercase fw-normal nisho-section-title">Shop by Weaving Style</h2>
            <p class="text-muted text-uppercase mb-0 nisho-section-subtitle">Weaver-Direct GI-Tagged Handloom Masterpieces</p>
        </div>
        <div class="row g-3 g-md-4 justify-content-center">
            <?php
            $cats = [
                ['name' => 'Banarasi', 'img' => '/saree-banner1.png', 'link' => '/?category=Banarasi+Brocade', 'count' => '120+ designs'],
                ['name' => 'Kanjeevaram', 'img' => '/saree-banner2.png', 'link' => '/?category=Kanjeevaram+Silk', 'count' => '85+ designs'],
                ['name' => 'Patan Patola', 'img' => '/saree-banner3.png', 'link' => '/?category=Patola+Silk', 'count' => '45+ designs'],
                ['name' => 'Organza', 'img' => '/saree-banner4.png', 'link' => '/?category=Organza+Silk', 'count' => '60+ designs'],
            ];
            foreach ($cats as $cat): ?>
            <div class="col-6 col-md-3">
                <a href="<?= $cat['link'] ?>" class="nisho-cat-block position-relative d-block overflow-hidden" style="height: 400px; text-decoration: none;">
                    <div class="nisho-cat-img w-100 h-100" style="background-image: url('<?= $cat['img'] ?>'); background-size: cover; background-position: center; transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);"></div>
                    <div class="nisho-cat-overlay position-absolute d-flex flex-column justify-content-end p-4 text-white" style="background: linear-gradient(transparent 40%, rgba(0,0,0,0.7)); top: 0; left: 0; right: 0; bottom: 0;">
                        <h4 class="fw-bold text-uppercase mb-0 nisho-section-title" style="color: #FFF !important;"><?= $cat['name'] ?></h4>
                        <span class="text-white-50 text-uppercase nisho-section-subtitle" style="color: rgba(255,255,255,0.5) !important;"><?= $cat['count'] ?> — Explore →</span>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 6: CAROUSEL #3 — GOODBYE DEALS     -->
    <!-- ═══════════════════════════════════════════ -->
    <div class="carousel-section-wrapper position-relative my-5 py-3" style="font-family: 'Nunito', sans-serif;">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="text-uppercase fw-normal mb-0 nisho-section-title">Goodbye Deals <span style="font-size: 1.2rem;">;)</span></h2>
                <p class="text-muted text-uppercase mb-0 nisho-section-subtitle">Last Pieces at Best Wholesale Discounts</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <div class="d-none d-md-flex gap-2">
                    <button class="btn btn-outline-dark rounded-circle nisho-carousel-prev" style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-width: 1.5px;"><i class="fa fa-chevron-left" style="font-size: 0.7rem;"></i></button>
                    <button class="btn btn-outline-dark rounded-circle nisho-carousel-next" style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-width: 1.5px;"><i class="fa fa-chevron-right" style="font-size: 0.7rem;"></i></button>
                </div>
                <a href="/?sort=price_low" class="text-decoration-none text-uppercase fw-bold ms-3 nisho-section-link" style="color: #482922; border-bottom: 1px solid #482922;">Shop All →</a>
            </div>
        </div>
        <div class="nisho-carousel-container">
            <?php
            $deals = $products;
            usort($deals, function($a, $b) { return $a['wholesale_price'] <=> $b['wholesale_price']; });
            foreach (array_slice($deals, 0, 8) as $item): ?>
                <div class="nisho-carousel-item"><?= renderProductCard($item) ?></div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 7: VALUE PROPOSITION                -->
    <!-- 3 columns with icons                        -->
    <!-- ═══════════════════════════════════════════ -->
    <div class="my-5 py-5 border-top border-bottom" style="background-color: #FAF8F6; font-family: 'Nunito', sans-serif;">
        <div class="row g-4 text-center">
            <div class="col-4">
                <div class="mb-3"><i class="fa-solid fa-truck-fast" style="font-size: 2rem; color: #482922;"></i></div>
                <h6 class="fw-bold text-uppercase nisho-section-subtitle" style="color: #1c1c1c;">Fast Shipping</h6>
                <p class="text-secondary mb-0 px-2" style="font-size: 0.75rem;">Dispatched in 24-48 hours from weaver hubs across India.</p>
            </div>
            <div class="col-4">
                <div class="mb-3"><i class="fa-solid fa-arrow-rotate-left" style="font-size: 2rem; color: #482922;"></i></div>
                <h6 class="fw-bold text-uppercase nisho-section-subtitle" style="color: #1c1c1c;">7-Day Easy Returns</h6>
                <p class="text-secondary mb-0 px-2" style="font-size: 0.75rem;">Hassle-free returns and exchanges on all wholesale orders.</p>
            </div>
            <div class="col-4">
                <div class="mb-3"><i class="fa-solid fa-certificate" style="font-size: 2rem; color: #482922;"></i></div>
                <h6 class="fw-bold text-uppercase nisho-section-subtitle" style="color: #1c1c1c;">Premium Quality</h6>
                <p class="text-secondary mb-0 px-2" style="font-size: 0.75rem;">100% GI-certified authentic handloom with weaver verification.</p>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 8: EDITORIAL VIDEO BANNER           -->
    <!-- Full-width looping video with overlay        -->
    <!-- ═══════════════════════════════════════════ -->
    <div class="my-5">
        <section class="nisho-video-banner position-relative overflow-hidden w-100">
            <video class="nisho-video-media" autoplay loop muted playsinline poster="/saree-banner4.png" preload="metadata">
                <source src="https://assets.mixkit.co/videos/preview/mixkit-waving-red-fabric-surface-40294-large.mp4" type="video/mp4">
            </video>
            <div class="nisho-video-overlay"></div>
            <div class="nisho-video-content position-absolute d-flex flex-column justify-content-center align-items-center text-center text-white p-4">
                <p class="text-uppercase mb-2 nisho-hero-subtitle" style="color: rgba(255,255,255,0.6);">Heritage Storytelling</p>
                <h2 class="text-uppercase mb-3 nisho-hero-title" style="text-shadow: 0 4px 15px rgba(0,0,0,0.5); color: #FFF !important;">Desi Romance</h2>
                <p class="mb-4 nisho-video-copy">A rhythmic celebration of warp and weft. Traditional sarees reimagined for the modern wholesale buyer.</p>
                <a href="/?category=Organza+Silk" class="btn btn-light rounded-0 px-5 py-2 text-uppercase fw-bold nisho-hero-cta" style="color: #482922;">Explore Story</a>
            </div>
        </section>
    </div>

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 9: CAROUSEL #4 — BESTSELLERS        -->
    <!-- ═══════════════════════════════════════════ -->
    <div class="carousel-section-wrapper position-relative my-5 py-3" style="font-family: 'Nunito', sans-serif;">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="text-uppercase fw-normal mb-0 nisho-section-title">Wholesale Bestsellers</h2>
                <p class="text-muted text-uppercase mb-0 nisho-section-subtitle">Top-Selling Sarees Among Our B2B Retailers</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <div class="d-none d-md-flex gap-2">
                    <button class="btn btn-outline-dark rounded-circle nisho-carousel-prev" style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-width: 1.5px;"><i class="fa fa-chevron-left" style="font-size: 0.7rem;"></i></button>
                    <button class="btn btn-outline-dark rounded-circle nisho-carousel-next" style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-width: 1.5px;"><i class="fa fa-chevron-right" style="font-size: 0.7rem;"></i></button>
                </div>
                <a href="/" class="text-decoration-none text-uppercase fw-bold ms-3 nisho-section-link" style="color: #482922; border-bottom: 1px solid #482922;">Shop All →</a>
            </div>
        </div>
        <div class="nisho-carousel-container">
            <?php
            $bestsellers = $products;
            shuffle($bestsellers);
            foreach (array_slice($bestsellers, 0, 8) as $item): ?>
                <div class="nisho-carousel-item"><?= renderProductCard($item) ?></div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════ -->
    <!-- SECTION 10: NEWSLETTER / CTA                -->
    <!-- ═══════════════════════════════════════════ -->
    <div class="w-100 py-5 mt-5" style="background-color: #482922; font-family: 'Nunito', sans-serif;">
        <div class="container text-center py-4">
            <h3 class="text-uppercase fw-bold mb-2 nisho-section-title" style="color: #FFF !important;">Join the Movement</h3>
            <p class="mb-4" style="font-size: 0.85rem; letter-spacing: 0.04em; color: rgba(255,255,255,0.55);">Get 10% off your first wholesale order. Stay updated on exclusive handloom drops.</p>
            <form class="d-flex justify-content-center gap-2 mx-auto" style="max-width: 480px;" onsubmit="event.preventDefault(); showToast('Subscribed successfully! 🎉'); $(this).find('input').val('');">
                <input type="email" class="form-control rounded-0 border-0 py-2 px-3 nisho-newsletter-input" placeholder="Enter your email address" required style="font-size: 0.85rem; background: rgba(255,255,255,0.12); color: #FFF !important;">
                <button type="submit" class="btn btn-light rounded-0 px-4 text-uppercase fw-bold" style="font-size: 0.8rem; letter-spacing: 0.12em; color: #482922; white-space: nowrap;">Subscribe</button>
            </form>
        </div>
    </div>

    <?php else: ?>
    <!-- ========================================== -->
    <!-- FILTERED PRODUCT CATALOG GRID VIEW         -->
    <!-- ========================================== -->

    <!-- Refinement Bar -->
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

<!-- Product Details Modal -->
<div class="modal fade" id="productDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content meesho-modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Saree Specification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modal-content-body">
                <div class="text-center py-5">
                    <div class="spinner-border" style="color: #482922;" role="status"><span class="visually-hidden">Loading...</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page JS -->
<script>
$(document).ready(function() {
    // Carousel arrow navigation
    $('.nisho-carousel-prev').on('click', function() {
        const c = $(this).closest('.carousel-section-wrapper').find('.nisho-carousel-container');
        c.animate({ scrollLeft: c.scrollLeft() - 320 }, 300);
    });
    $('.nisho-carousel-next').on('click', function() {
        const c = $(this).closest('.carousel-section-wrapper').find('.nisho-carousel-container');
        c.animate({ scrollLeft: c.scrollLeft() + 320 }, 300);
    });

    // Sort selector
    $('#sort-selector').on('change', function() {
        const val = $(this).val();
        const u = new URLSearchParams(window.location.search);
        val ? u.set('sort', val) : u.delete('sort');
        window.location.search = u.toString();
    });

    // Product detail modal - rendered instantly from pre-loaded JSON properties
    $('.product-card-trigger').on('click', function(e) {
        if ($(e.target).closest('.wishlist-heart-btn').length > 0) return;
        const p = $(this).data('json');
        if (!p) return;

        $('#productDetailModal').modal('show');

        const wf = parseFloat(p.wholesale_price).toLocaleString('en-IN');
        const pf = parseFloat(p.price).toLocaleString('en-IN');
        const disc = Math.round(((p.price - p.wholesale_price) / p.price) * 100);

        $('#modal-content-body').html(`
            <div class="row g-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                <div class="col-md-5">
                    <img src="${p.image_url || '/assets/images/placeholder.png'}" class="img-fluid w-100" style="max-height: 500px; object-fit: cover;">
                </div>
                <div class="col-md-7">
                    <div class="text-uppercase text-muted mb-1" style="font-size: 0.62rem; letter-spacing: 0.12em; font-weight: 700;">${p.category_name}</div>
                    <h3 class="fw-bold text-uppercase mb-2" style="font-size: 1.3rem; letter-spacing: 0.04em; color: #1c1c1c;">${p.title}</h3>
                    <p class="text-muted small mb-3">SKU: <code class="text-dark">${p.sku}</code></p>
                    <div class="mb-4">
                        <span class="fs-3 fw-bold text-dark">Rs. ${wf}</span>
                        <span class="text-decoration-line-through text-muted ms-2" style="font-size: 0.88rem;">Rs. ${pf}</span>
                        <span class="text-danger small fw-bold ms-2">${disc}% OFF</span>
                        <div class="small text-muted mt-1" style="font-size: 0.72rem;">Wholesale Rate (Min Order: ${p.bulk_threshold} Pcs)</div>
                    </div>
                    <div class="mb-4 border-top pt-3">
                        <h6 class="fw-bold text-uppercase text-dark mb-2" style="font-size: 0.7rem; letter-spacing: 0.08em;">Details</h6>
                        <div class="d-flex flex-column gap-1 text-muted" style="font-size: 0.8rem;">
                            <div><strong>Color:</strong> ${p.color || 'Traditional Woven'}</div>
                            <div><strong>Weight:</strong> ${p.weight ? p.weight + 'g' : '~700g'}</div>
                            <div><strong>Dimensions:</strong> ${p.dimensions || '6.3m × 1.2m'}</div>
                            <div><strong>Stock:</strong> <span class="badge bg-success-subtle text-success border border-success-subtle">${p.stock} units</span></div>
                        </div>
                    </div>
                    <div class="mb-3"><p style="font-size: 0.8rem; line-height: 1.6; color: #555;">${p.description}</p></div>
                    <div class="row g-2 align-items-center pt-3 border-top">
                        <div class="col-4 col-sm-3">
                            <select class="form-select border-dark rounded-0 py-2" id="modal-qty-select" style="font-size: 0.82rem;">
                                ${[...Array(15).keys()].map(i => `<option value="${i+1}">${i+1}</option>`).join('')}
                            </select>
                        </div>
                        <div class="col-8 col-sm-9">
                            <button class="btn w-100 py-2 text-uppercase fw-bold" id="modal-add-cart-btn" data-variant-id="${p.variant_id}" style="background:#1a1a1a; color:white; border:none; border-radius:0; letter-spacing:0.15em; font-size:0.82rem;">
                                <i class="fa fa-shopping-bag me-2"></i> Add to Bag
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `);
    });

    // Add to Cart
    $(document).on('click', '#modal-add-cart-btn', function() {
        const btn = $(this);
        const variantId = btn.data('variant-id');
        const qty = parseInt($('#modal-qty-select').val() || 1);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Adding...');
        $.ajax({
            url: '/cart/add', method: 'POST', contentType: 'application/json',
            data: JSON.stringify({ variant_id: variantId, quantity: qty }), dataType: 'json',
            success: function() {
                $('#productDetailModal').modal('hide');
                $('#cart-trigger-btn').click();
            },
            error: function(xhr) {
                alert(xhr.responseJSON ? xhr.responseJSON.error : 'Failed to add to cart');
                btn.prop('disabled', false).html('<i class="fa fa-shopping-bag me-2"></i> Add to Bag');
            }
        });
    });
    
    // Filter modal trigger
    $('#refinement-filters-btn').on('click', function() { $('#filtersModal').modal('show'); });

    // Auto-scroll to products when filtered
    const u = new URLSearchParams(window.location.search);
    if (u.has('category') || u.has('sort') || u.has('search') || u.has('min_price') || u.has('all_sarees')) {
        setTimeout(function() {
            const t = $('#product-feed-section');
            if (t.length) { $('html, body').animate({ scrollTop: t.offset().top - 120 }, 600); }
        }, 200);
    }

    // ═══ NISHORAMA SCROLL-TRIGGERED ANIMATIONS ═══
    if ('IntersectionObserver' in window) {
        // Animate carousel sections, banners, category grid, value props
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    sectionObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('.carousel-section-wrapper, #home-categories-grid, .nisho-footer').forEach(el => {
            el.classList.add('nisho-anim-section');
            sectionObserver.observe(el);
        });

        // Animate individual product cards with stagger
        const cardObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    $(entry.target).addClass('visible');
                    cardObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.05 });
        document.querySelectorAll('.meesho-product-card.minimal').forEach(el => cardObserver.observe(el));

        // Animate category tiles
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
        document.querySelectorAll('.nisho-cat-block').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1)';
            tileObserver.observe(el);
        });
    }

    // ═══ HERO CAROUSEL: Pause on hover ═══
    const heroCarousel = document.getElementById('heroCarousel');
    if (heroCarousel) {
        heroCarousel.addEventListener('mouseenter', () => {
            bootstrap.Carousel.getInstance(heroCarousel)?.pause();
        });
        heroCarousel.addEventListener('mouseleave', () => {
            bootstrap.Carousel.getInstance(heroCarousel)?.cycle();
        });
    }

    // ═══ SMOOTH CAROUSEL DRAG-TO-SCROLL ═══
    document.querySelectorAll('.nisho-carousel-container').forEach(container => {
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
        container.style.cursor = 'grab';
    });
});
</script>

<!-- Filters Modal (Luxury 14-Criteria Accordion Format) -->
<div class="modal fade" id="filtersModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 520px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; background-color: #FFFDF8;">
            <div class="modal-header border-0 pb-0" style="background-color: var(--premium-light-bg); border-top-left-radius: 16px; border-top-right-radius: 16px; padding: 1.25rem;">
                <h5 class="modal-title fw-bold" style="font-family: var(--font-headings); color: var(--meesho-pink);"><i class="fa-solid fa-sliders me-2" style="color: var(--premium-gold);"></i>Refine Sarees</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <form method="GET" action="/" id="saree-filters-form">
                    <?php if (!empty($searchQuery)): ?>
                        <input type="hidden" name="search" value="<?= htmlspecialchars($searchQuery) ?>">
                    <?php endif; ?>
                    
                    <div class="accordion accordion-flush" id="filterAccordion">
                        
                        <!-- 1. Fabric / Material -->
                        <div class="accordion-item" style="background:none;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-uppercase" style="font-size:0.75rem; letter-spacing:0.05em; background:none; color: var(--premium-dark);" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFabric">
                                    1. Fabric & Material
                                </button>
                            </h2>
                            <div id="collapseFabric" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body py-2">
                                    <div class="d-flex flex-wrap gap-2">
                                        <?php foreach (['Silk (Kanjeevaram, Banarasi)', 'Cotton', 'Georgette', 'Chiffon', 'Crepe', 'Linen', 'Satin', 'Synthetic Blends'] as $f): ?>
                                            <input type="checkbox" class="btn-check" id="f-<?= md5($f) ?>" name="filter_fabric[]" value="<?= htmlspecialchars($f) ?>">
                                            <label class="btn btn-outline-dark btn-sm rounded-0 text-uppercase" style="font-size:0.65rem;" for="f-<?= md5($f) ?>"><?= htmlspecialchars($f) ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Color Palette & Spectrum -->
                        <div class="accordion-item" style="background:none;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-uppercase" style="font-size:0.75rem; letter-spacing:0.05em; background:none; color: var(--premium-dark);" type="button" data-bs-toggle="collapse" data-bs-target="#collapseColor">
                                    2. Color & Spectrum Selector
                                </button>
                            </h2>
                            <div id="collapseColor" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body py-2">
                                    <div class="mb-3">
                                        <div class="d-flex flex-wrap gap-2 mb-2">
                                            <?php foreach (['Red' => '#e74c3c', 'Blue' => '#3498db', 'Green' => '#2ecc71', 'Yellow' => '#f1c40f', 'Peach' => '#ffb8b8', 'Lavender' => '#dec9e9', 'White' => '#ffffff', 'Black' => '#000000', 'Beige' => '#f5f5dc', 'Ombre' => 'linear-gradient(to right, #6b1d1d, #c9972e)'] as $colorName => $colorHex): ?>
                                                <input type="checkbox" class="btn-check" id="col-<?= $colorName ?>" name="filter_color[]" value="<?= $colorName ?>">
                                                <label class="btn btn-outline-dark btn-sm rounded-0 d-flex align-items-center gap-1" style="font-size:0.65rem;" for="col-<?= $colorName ?>">
                                                    <span style="display:inline-block; width:12px; height:12px; border-radius:50%; background:<?= $colorHex ?>; border:1px solid #ddd;"></span><?= $colorName ?>
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="border-top pt-2">
                                        <label class="form-label mb-1" style="font-size: 0.72rem; font-weight:700;">Precise Spectrum Selector</label>
                                        <div class="d-flex align-items-center gap-2">
                                            <input type="color" class="form-control-color border-0 p-0" name="custom_color_picker" value="#6B1D1D" style="width:34px; height:34px; cursor:pointer; background:none;">
                                            <span class="text-muted small" style="font-size:0.68rem;">Tap color block to filter by custom color value</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Occasion / Usage -->
                        <div class="accordion-item" style="background:none;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-uppercase" style="font-size:0.75rem; letter-spacing:0.05em; background:none; color: var(--premium-dark);" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOccasion">
                                    3. Occasion & Usage
                                </button>
                            </h2>
                            <div id="collapseOccasion" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body py-2">
                                    <div class="d-flex flex-wrap gap-2">
                                        <?php foreach (['Casual / Daily wear', 'Office / Formal', 'Festive / Traditional', 'Wedding / Bridal', 'Party / Cocktail'] as $occ): ?>
                                            <input type="checkbox" class="btn-check" id="occ-<?= md5($occ) ?>" name="filter_occasion[]" value="<?= htmlspecialchars($occ) ?>">
                                            <label class="btn btn-outline-dark btn-sm rounded-0 text-uppercase" style="font-size:0.65rem;" for="occ-<?= md5($occ) ?>"><?= htmlspecialchars($occ) ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Wholesale Price Range -->
                        <div class="accordion-item" style="background:none;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-uppercase" style="font-size:0.75rem; letter-spacing:0.05em; background:none; color: var(--premium-dark);" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrice">
                                    4. Price Range (₹)
                                </button>
                            </h2>
                            <div id="collapsePrice" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body py-2">
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <label class="small text-muted mb-1" style="font-size:0.68rem;">Minimum</label>
                                            <input type="number" name="min_price" class="form-control form-control-sm rounded-0" placeholder="Min" value="<?= $minPrice > 0 ? intval($minPrice) : '' ?>">
                                        </div>
                                        <div class="col-6">
                                            <label class="small text-muted mb-1" style="font-size:0.68rem;">Maximum</label>
                                            <input type="number" name="max_price" class="form-control form-control-sm rounded-0" placeholder="Max" value="<?= $maxPrice > 0 ? intval($maxPrice) : '' ?>">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column gap-2 border-top pt-2">
                                        <label class="small text-muted" style="font-size:0.68rem; font-weight:700;">Predefined Brackets</label>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                            <input type="radio" name="price_bracket" value="under_1000" onchange="this.form.min_price.value=''; this.form.max_price.value='1000';"> Under ₹1,000
                                        </label>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                            <input type="radio" name="price_bracket" value="1000_5000" onchange="this.form.min_price.value='1000'; this.form.max_price.value='5000';"> ₹1,000 – ₹5,000
                                        </label>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                            <input type="radio" name="price_bracket" value="5001_10000" onchange="this.form.min_price.value='5001'; this.form.max_price.value='10000';"> ₹5,001 – ₹10,000
                                        </label>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                            <input type="radio" name="price_bracket" value="above_10000" onchange="this.form.min_price.value='10001'; this.form.max_price.value='';"> ₹10,000+
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Pattern / Design -->
                        <div class="accordion-item" style="background:none;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-uppercase" style="font-size:0.75rem; letter-spacing:0.05em; background:none; color: var(--premium-dark);" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePattern">
                                    5. Pattern & Design
                                </button>
                            </h2>
                            <div id="collapsePattern" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body py-2">
                                    <div class="d-flex flex-wrap gap-2">
                                        <?php foreach (['Plain / Solid', 'Printed (Floral/Motifs)', 'Embroidered / Zari / Sequined', 'Patchwork / Appliqué', 'Block Print / Handloom'] as $pat): ?>
                                            <input type="checkbox" class="btn-check" id="pat-<?= md5($pat) ?>" name="filter_pattern[]" value="<?= htmlspecialchars($pat) ?>">
                                            <label class="btn btn-outline-dark btn-sm rounded-0 text-uppercase" style="font-size:0.65rem;" for="pat-<?= md5($pat) ?>"><?= htmlspecialchars($pat) ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 6. Saree Type / Regional Style -->
                        <div class="accordion-item" style="background:none;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-uppercase" style="font-size:0.75rem; letter-spacing:0.05em; background:none; color: var(--premium-dark);" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRegional">
                                    6. Saree Type & Weaving Style
                                </button>
                            </h2>
                            <div id="collapseRegional" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body py-2">
                                    <div class="d-flex flex-wrap gap-2">
                                        <?php foreach ($categoriesList as $cat): ?>
                                            <input type="checkbox" class="btn-check" id="reg-<?= md5($cat['name']) ?>" name="filter_regional[]" value="<?= htmlspecialchars($cat['name']) ?>" <?= $selectedCategory === $cat['name'] ? 'checked' : '' ?>>
                                            <label class="btn btn-outline-dark btn-sm rounded-0 text-uppercase" style="font-size:0.65rem;" for="reg-<?= md5($cat['name']) ?>"><?= htmlspecialchars($cat['name']) ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 7. Blouse Style / Options -->
                        <div class="accordion-item" style="background:none;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-uppercase" style="font-size:0.75rem; letter-spacing:0.05em; background:none; color: var(--premium-dark);" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBlouse">
                                    7. Blouse Style & Customization
                                </button>
                            </h2>
                            <div id="collapseBlouse" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body py-2">
                                    <div class="d-flex flex-wrap gap-2">
                                        <?php foreach (['Matching blouse included', 'Full Sleeve options', 'Short Sleeve / Sleeveless', 'Customizable blouse specs'] as $bl): ?>
                                            <input type="checkbox" class="btn-check" id="bl-<?= md5($bl) ?>" name="filter_blouse[]" value="<?= htmlspecialchars($bl) ?>">
                                            <label class="btn btn-outline-dark btn-sm rounded-0 text-uppercase" style="font-size:0.65rem;" for="bl-<?= md5($bl) ?>"><?= htmlspecialchars($bl) ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 8. Length & Width -->
                        <div class="accordion-item" style="background:none;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-uppercase" style="font-size:0.75rem; letter-spacing:0.05em; background:none; color: var(--premium-dark);" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDimensions">
                                    8. Length & Width Dimensions
                                </button>
                            </h2>
                            <div id="collapseDimensions" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body py-2">
                                    <div class="d-flex flex-wrap gap-2">
                                        <?php foreach (['Standard length (5.5–6.5m)', 'Plus-size / Extended drape', 'Custom width variations'] as $dim): ?>
                                            <input type="checkbox" class="btn-check" id="dim-<?= md5($dim) ?>" name="filter_dimensions[]" value="<?= htmlspecialchars($dim) ?>">
                                            <label class="btn btn-outline-dark btn-sm rounded-0 text-uppercase" style="font-size:0.65rem;" for="dim-<?= md5($dim) ?>"><?= htmlspecialchars($dim) ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 9. User Ratings -->
                        <div class="accordion-item" style="background:none;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-uppercase" style="font-size:0.75rem; letter-spacing:0.05em; background:none; color: var(--premium-dark);" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRatings">
                                    9. User Ratings & Popularity
                                </button>
                            </h2>
                            <div id="collapseRatings" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body py-2">
                                    <div class="d-flex flex-column gap-2">
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_rating" value="4_star_above"> <span style="color:var(--premium-gold);"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span> 4-Star & Above
                                        </label>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_popular" value="trending"> <i class="fa-solid fa-fire me-1" style="color:#e67e22;"></i> Most Popular / Trending
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 10. Brand / Artisan Hub -->
                        <div class="accordion-item" style="background:none;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-uppercase" style="font-size:0.75rem; letter-spacing:0.05em; background:none; color: var(--premium-dark);" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBrand">
                                    10. Brand & Weaver Hubs
                                </button>
                            </h2>
                            <div id="collapseBrand" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body py-2">
                                    <div class="d-flex flex-wrap gap-2">
                                        <?php foreach (['Local Handloom Co-ops', 'Weaver Artisan Labels', 'Exclusive Boutique Brands'] as $br): ?>
                                            <input type="checkbox" class="btn-check" id="br-<?= md5($br) ?>" name="filter_brand[]" value="<?= htmlspecialchars($br) ?>">
                                            <label class="btn btn-outline-dark btn-sm rounded-0 text-uppercase" style="font-size:0.65rem;" for="br-<?= md5($br) ?>"><?= htmlspecialchars($br) ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 11. Care Instructions -->
                        <div class="accordion-item" style="background:none;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-uppercase" style="font-size:0.75rem; letter-spacing:0.05em; background:none; color: var(--premium-dark);" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCare">
                                    11. Care Instructions
                                </button>
                            </h2>
                            <div id="collapseCare" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body py-2">
                                    <div class="d-flex flex-wrap gap-2">
                                        <?php foreach (['Dry clean only', 'Machine washable', 'Gentle handwash recommended'] as $care): ?>
                                            <input type="checkbox" class="btn-check" id="care-<?= md5($care) ?>" name="filter_care[]" value="<?= htmlspecialchars($care) ?>">
                                            <label class="btn btn-outline-dark btn-sm rounded-0 text-uppercase" style="font-size:0.65rem;" for="care-<?= md5($care) ?>"><?= htmlspecialchars($care) ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 12. Availability & Logistics -->
                        <div class="accordion-item" style="background:none;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-uppercase" style="font-size:0.75rem; letter-spacing:0.05em; background:none; color: var(--premium-dark);" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDelivery">
                                    12. Availability & Same-day Shipping
                                </button>
                            </h2>
                            <div id="collapseDelivery" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body py-2">
                                    <div class="d-flex flex-column gap-2">
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_stock" value="in_stock" checked> In Stock / Ready to Ship
                                        </label>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_shipping" value="fast_delivery"> Same-Day Shipping / Express Dispatch
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 13. New Arrivals & Discounts -->
                        <div class="accordion-item" style="background:none;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-uppercase" style="font-size:0.75rem; letter-spacing:0.05em; background:none; color: var(--premium-dark);" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDeals">
                                    13. New Arrivals & Bundle Discounts
                                </button>
                            </h2>
                            <div id="collapseDeals" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body py-2">
                                    <div class="d-flex flex-column gap-2">
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_newest" value="yes"> Recently Loomed (New Arrivals)
                                        </label>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_discount" value="yes"> Discounted Wholesale Bundles / Coupons
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 14. Sustainability / Ethical Production -->
                        <div class="accordion-item" style="background:none; border-bottom:0;">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-uppercase" style="font-size:0.75rem; letter-spacing:0.05em; background:none; color: var(--premium-dark);" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGreen">
                                    14. Sustainability & Ethical Sourcing
                                </button>
                            </h2>
                            <div id="collapseGreen" class="accordion-collapse collapse" data-bs-parent="#filterAccordion">
                                <div class="accordion-body py-2">
                                    <div class="d-flex flex-column gap-2">
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_organic" value="organic"> Organic Handloomed Cotton / Natural Silk
                                        </label>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_fairtrade" value="fairtrade"> Weaver Fair Trade Certified
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Apply & Reset Buttons footer style -->
                    <div class="p-3 border-0 d-flex gap-2" style="background-color: var(--premium-light-bg); border-bottom-left-radius: 16px; border-bottom-right-radius: 16px;">
                        <button type="button" class="btn btn-outline-secondary w-50 py-2 rounded-0 text-uppercase fw-bold" style="font-size: 0.72rem; letter-spacing: 0.05em;" onclick="document.getElementById('saree-filters-form').reset()">Clear All</button>
                        <button type="submit" class="btn btn-meesho-pink w-50 py-2 rounded-0 text-uppercase fw-bold" style="font-size: 0.72rem; letter-spacing: 0.05em;">Apply Filters</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
