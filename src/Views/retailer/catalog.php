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
$isFiltered = !empty($selectedCategory) || !empty($searchQuery) || !empty($sort) || ($minPrice > 0) || ($maxPrice > 0) || !empty($_GET['all_sarees']);
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
                <a href="/?all_sarees=true" class="text-decoration-none text-uppercase fw-bold ms-3 nisho-section-link" style="color: #482922; border-bottom: 1px solid #482922;">Shop All →</a>
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
                <a href="/?all_sarees=true" class="text-decoration-none text-uppercase fw-bold ms-3 nisho-section-link" style="color: #482922; border-bottom: 1px solid #482922;">Shop All →</a>
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
    $(document).on('click', '.product-card-trigger', function(e) {
        if ($(e.target).closest('.wishlist-heart-btn').length > 0) return;
        let p = $(this).data('json');
        if (!p) {
            const raw = $(this).attr('data-json');
            if (raw) {
                try { p = JSON.parse(raw); } catch(err) { console.error("JSON parse error:", err); }
            }
        }
        if (!p) return;

        const modalEl = document.getElementById('productDetailModal');
        if (modalEl) {
            if (window.bootstrap) {
                bootstrap.Modal.getOrCreateInstance(modalEl).show();
            } else {
                $(modalEl).modal('show');
            }
        }

        const wf = parseFloat(p.wholesale_price).toLocaleString('en-IN');
        const mrp = (parseFloat(p.wholesale_price) + 8500).toLocaleString('en-IN');
        const bankOfferPrice = (parseFloat(p.wholesale_price) - 149).toLocaleString('en-IN');

        $('#modal-content-body').html(`
            <div style="font-family: 'Plus Jakarta Sans', sans-serif; color: #282c3f;">
                <!-- Full-bleed Image with Video Overlays -->
                <div class="position-relative overflow-hidden bg-light text-center mb-3" style="margin: -15px -15px 15px -15px;">
                    <img src="${p.image_url || '/assets/images/placeholder.png'}" class="img-fluid w-100 zoomable-saree-img" style="max-height: 520px; object-fit: cover;" title="Zoom Saree Pattern">
                    
                    <!-- Rating Badge (Screenshot styled) -->
                    <span class="position-absolute bg-white px-2 py-1 shadow-sm rounded-3 d-flex align-items-center gap-1 fw-bold" style="bottom: 15px; right: 15px; font-size: 0.72rem; border: 1px solid #eaeaec;">
                        <span>4.1</span>
                        <span class="text-success"><i class="fa-solid fa-star"></i></span>
                        <span class="text-muted border-start ps-1" style="font-weight: 500;">7.3k</span>
                    </span>

                    <!-- Video Preview Circle -->
                    <div class="position-absolute d-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm" style="bottom: 15px; left: 15px; width: 44px; height: 44px; border: 2px solid var(--meesho-pink); cursor: pointer;" title="Play drape walkthrough">
                        <i class="fa-solid fa-play" style="color: var(--meesho-pink); font-size: 0.95rem; margin-left: 2px;"></i>
                    </div>
                </div>

                <!-- Three Action Pills Below Image -->
                <div class="d-flex justify-content-between gap-2 mb-3">
                    <button class="btn btn-sm bg-white border w-33 py-2 d-flex align-items-center justify-content-center gap-2 fw-semibold text-muted modal-size-guide-btn" style="font-size: 0.75rem; border-radius: 4px;">
                        <i class="fa-solid fa-ruler-horizontal"></i> Size Guide
                    </button>
                    <button class="btn btn-sm bg-white border w-33 py-2 d-flex align-items-center justify-content-center gap-2 fw-semibold text-muted modal-wishlist-btn" style="font-size: 0.75rem; border-radius: 4px;">
                        <i class="fa-regular fa-heart text-danger"></i> Wishlist
                    </button>
                    <button class="btn btn-sm bg-white border w-33 py-2 d-flex align-items-center justify-content-center gap-2 fw-semibold text-muted modal-share-btn" style="font-size: 0.75rem; border-radius: 4px;">
                        <i class="fa-solid fa-share-nodes"></i> Share
                    </button>
                </div>

                <!-- Brand & Title Block -->
                <div class="mb-3 px-1">
                    <h5 class="fw-bold text-dark mb-1" style="font-size: 1.1rem; letter-spacing: -0.2px;">Anouk</h5>
                    <p class="text-muted mb-2" style="font-size: 0.85rem; line-height: 1.4;">${p.title}</p>
                    
                    <!-- Price block (Screenshot exact) -->
                    <div class="d-flex align-items-baseline gap-2 mb-1">
                        <span class="fs-4 fw-bold text-dark">₹${wf}</span>
                        <span class="text-decoration-line-through text-muted small">MRP ₹${mrp}</span>
                        <span class="fw-bold text-warning small">(₹8,500 OFF)</span>
                    </div>
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle fw-bold" style="font-size: 0.65rem; padding: 3px 6px;">Thunder Deal</span>
                </div>

                <!-- Offers Card (Screenshot exact) -->
                <div class="p-3 mb-3 bg-white border rounded-3 d-flex justify-content-between align-items-center" style="border-color: #eaeaec !important; box-shadow: 0 4px 10px rgba(0,0,0,0.01);">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge bg-success text-white text-uppercase" style="font-size: 0.58rem; padding: 3px 6px;">MEGA DEAL</span>
                            <span class="fw-bold text-dark" style="font-size: 0.82rem;">Get at ₹${bankOfferPrice}</span>
                        </div>
                        <p class="text-muted mb-0" style="font-size: 0.72rem;"><span style="color: #3498db;"><i class="fa-solid fa-building-columns me-1"></i></span>Extra ₹149 Off with select B2B partner cards</p>
                    </div>
                    <span style="color: var(--meesho-pink); font-size: 0.78rem; font-weight: 700; cursor: pointer;">Details <i class="fa-solid fa-chevron-right ms-1"></i></span>
                </div>

                <!-- Color selector scrolling circles -->
                <div class="mb-3 px-1">
                    <h6 class="fw-bold text-muted text-uppercase mb-2" style="font-size: 0.65rem; letter-spacing: 0.05em;">Colour: Multi</h6>
                    <div class="d-flex gap-2 overflow-auto pb-1" style="scrollbar-width: none;">
                        <div class="rounded-circle p-0.5 border border-dark" style="width: 48px; height: 48px; overflow: hidden; cursor: pointer;">
                            <img src="${p.image_url || '/assets/images/placeholder.png'}" class="w-100 h-100" style="object-fit: cover; border-radius: 50%;">
                        </div>
                        <div class="rounded-circle p-0.5 border" style="width: 48px; height: 48px; overflow: hidden; opacity: 0.7; filter: hue-rotate(60deg); cursor: pointer;">
                            <img src="${p.image_url || '/assets/images/placeholder.png'}" class="w-100 h-100" style="object-fit: cover; border-radius: 50%;">
                        </div>
                        <div class="rounded-circle p-0.5 border" style="width: 48px; height: 48px; overflow: hidden; opacity: 0.7; filter: hue-rotate(150deg); cursor: pointer;">
                            <img src="${p.image_url || '/assets/images/placeholder.png'}" class="w-100 h-100" style="object-fit: cover; border-radius: 50%;">
                        </div>
                        <div class="rounded-circle p-0.5 border" style="width: 48px; height: 48px; overflow: hidden; opacity: 0.7; filter: hue-rotate(240deg); cursor: pointer;">
                            <img src="${p.image_url || '/assets/images/placeholder.png'}" class="w-100 h-100" style="object-fit: cover; border-radius: 50%;">
                        </div>
                    </div>
                </div>

                <!-- Size selector -->
                <div class="mb-4 px-1">
                    <h6 class="fw-bold text-muted text-uppercase mb-2" style="font-size: 0.65rem; letter-spacing: 0.05em;">Size: Onesize</h6>
                    <button class="btn btn-outline-dark fw-bold rounded-2 px-4 py-2" style="font-size: 0.8rem; border-color: #282c3f;">Onesize</button>
                </div>

                <!-- Delivery & Services block -->
                <div class="p-3 mb-4 bg-white border rounded-3" style="border-color: #eaeaec !important;">
                    <h6 class="fw-bold text-dark mb-3" style="font-size: 0.82rem;"><i class="fa-solid fa-truck me-2" style="color: #7f8c8d;"></i>Delivery & Services</h6>
                    
                    <!-- Pincode Checker -->
                    <div class="d-flex align-items-center justify-content-between mb-2 border p-2.5 rounded-2 bg-light-subtle">
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted" style="font-size: 0.85rem;"><i class="fa-solid fa-location-dot"></i></span>
                            <span class="fw-bold text-dark" style="font-size: 0.78rem;" id="modal-delivery-address-label">Check Delivery Availability</span>
                        </div>
                        <span class="fw-bold text-uppercase pincode-change-trigger" style="font-size: 0.72rem; color: var(--meesho-pink); cursor: pointer;">Check</span>
                    </div>

                    <!-- Collapsible pincode check input -->
                    <div id="pincode-input-wrapper" style="display: none;" class="mb-3 border p-3 rounded-2 bg-light">
                        <label class="form-label small fw-bold text-muted text-uppercase mb-1" style="font-size: 0.65rem;">Enter Pincode</label>
                        <div class="input-group">
                            <input type="text" class="form-control rounded-0" id="delivery-pincode-input" placeholder="e.g. 110001" maxlength="6" style="font-size: 0.85rem;">
                            <button class="btn btn-dark rounded-0 px-3 fw-bold text-uppercase" id="btn-apply-pincode" style="font-size: 0.75rem;">Apply</button>
                        </div>
                        <span class="text-danger small" id="pincode-error" style="display: none; font-size: 0.7rem;">Please enter a valid 6-digit pincode.</span>
                    </div>

                    <!-- Delivery Date (Screenshot exact) -->
                    <div class="p-2.5 rounded-2 border mb-3" style="background-color: #fff9fa; border-color: #ffe6e8 !important;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-danger" style="font-size: 0.82rem;"><i class="fa-solid fa-circle-check"></i></span>
                                <span class="fw-bold text-dark" style="font-size: 0.78rem;">Delivery in 2 days</span>
                            </div>
                            <span class="text-muted small">MRP ₹${mrp}</span>
                        </div>
                    </div>

                    <div class="text-muted" style="font-size: 0.78rem;">
                        <div class="mb-2"><i class="fa-solid fa-ban text-danger me-2"></i>Pay on Delivery is not available for bulk trial orders</div>
                        <div><i class="fa-solid fa-rotate-left text-success me-2"></i>Hassle free 7 days Return & Exchange</div>
                    </div>
                </div>

                <!-- Product Specifications Grid (Screenshot exact) -->
                <div class="p-3 mb-4 bg-white border rounded-3" style="border-color: #eaeaec !important;">
                    <h6 class="fw-bold text-dark mb-3" style="font-size: 0.82rem;">Product Specifications</h6>
                    <div class="row g-3 text-muted mb-3" style="font-size: 0.82rem;">
                        <div class="col-6">
                            <div class="small text-muted">Border</div>
                            <div class="fw-bold text-dark">Embroidered Zari</div>
                        </div>
                        <div class="col-6">
                            <div class="small text-muted">Saree Fabric</div>
                            <div class="fw-bold text-dark">${p.category_name}</div>
                        </div>
                        <div class="col-6">
                            <div class="small text-muted">Ornamentation</div>
                            <div class="fw-bold text-dark">Sequinned Weaves</div>
                        </div>
                        <div class="col-6">
                            <div class="col-6">
                                <div class="small text-muted">Print or Pattern Types</div>
                                <div class="fw-bold text-dark">Embellished Motifs</div>
                            </div>
                        </div>
                    </div>
                    
                    <hr>

                    <!-- Product Details Description -->
                    <h6 class="fw-bold text-dark mb-2" style="font-size: 0.82rem;">Product Details</h6>
                    <p class="text-muted mb-0" style="font-size: 0.78rem; line-height: 1.6;">${p.description}</p>
                </div>

                <!-- Ratings & Reviews Section (Screenshot exact) -->
                <div class="p-3 mb-4 bg-white border rounded-3" style="border-color: #eaeaec !important;">
                    <h6 class="fw-bold text-dark mb-3" style="font-size: 0.85rem;">Ratings & Reviews</h6>
                    
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

                    <!-- Scrollable Customer review pictures row -->
                    <div class="d-flex gap-2 overflow-auto pb-2 mb-3" style="scrollbar-width: none;">
                        <!-- Photo 1: Saree Video Walkthrough -->
                        <div class="position-relative bg-light rounded-3" style="min-width: 90px; width: 90px; height: 110px; overflow: hidden; border: 1px solid #eaeaec;">
                            <img src="${p.image_url || '/assets/images/placeholder.png'}" class="w-100 h-100" style="object-fit: cover;">
                            <span class="position-absolute bg-black bg-opacity-50 text-white px-1.5 py-0.5 rounded-pill d-flex align-items-center gap-1" style="bottom: 8px; right: 8px; font-size: 0.58rem; font-weight: 700;">
                                <i class="fa-solid fa-play"></i> 0:42
                            </span>
                        </div>
                        <!-- Photo 2: User Drape sitting -->
                        <div class="bg-light rounded-3" style="min-width: 90px; width: 90px; height: 110px; overflow: hidden; border: 1px solid #eaeaec; filter: hue-rotate(40deg);">
                            <img src="${p.image_url || '/assets/images/placeholder.png'}" class="w-100 h-100" style="object-fit: cover;">
                        </div>
                        <!-- Photo 3: User Drape standing -->
                        <div class="bg-light rounded-3" style="min-width: 90px; width: 90px; height: 110px; overflow: hidden; border: 1px solid #eaeaec; filter: hue-rotate(180deg);">
                            <img src="${p.image_url || '/assets/images/placeholder.png'}" class="w-100 h-100" style="object-fit: cover;">
                        </div>
                        <!-- Photo 4: +1168 count -->
                        <div class="position-relative bg-dark rounded-3" style="min-width: 90px; width: 90px; height: 110px; overflow: hidden; border: 1px solid #eaeaec;">
                            <img src="${p.image_url || '/assets/images/placeholder.png'}" class="w-100 h-100 opacity-50" style="object-fit: cover;">
                            <span class="position-absolute translate-middle start-50 top-50 text-white fw-bold" style="font-size: 0.95rem;">+1168</span>
                        </div>
                    </div>

                    <!-- Customer Reviews List -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold text-dark" style="font-size: 0.85rem;">Customer Reviews (1354)</span>
                        <span class="fw-bold text-decoration-underline" style="font-size: 0.78rem; color: var(--meesho-pink); cursor: pointer;">View All</span>
                    </div>

                    <!-- Example top comment -->
                    <div class="pt-2 border-top">
                        <div class="d-flex align-items-center gap-1 mb-1" style="font-size: 0.72rem;">
                            <span class="text-success"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
                            <span class="text-muted border-start ps-1 ms-1">Anil S. (Verified Wholesaler)</span>
                        </div>
                        <p class="text-muted mb-0" style="font-size: 0.75rem; line-height: 1.4;">"Fabric and border quality exceeded our expectations. The zari thread work has a brilliant shine. Ordering 12 sets next."</p>
                    </div>
                </div>

                <!-- Sticky bottom floating action buttons (Screenshot styled) -->
                <div class="row g-2 pt-3 border-top mt-3" style="position: sticky; bottom: 0; background: #fff; padding-bottom: 10px; z-index: 10;">
                    <div class="col-4">
                        <select class="form-select border-dark rounded-2 py-2.5 fw-bold text-center" id="modal-qty-select" style="font-size: 0.85rem; border-color: #282c3f !important;">
                            ${[...Array(15).keys()].map(i => `<option value="${i+1}">${i+1} Pcs</option>`).join('')}
                        </select>
                    </div>
                    <div class="col-8 d-flex gap-2">
                        <button class="btn btn-outline-dark w-50 py-2.5 fw-bold text-uppercase" id="modal-buy-now-btn" style="border-radius: 4px; font-size: 0.8rem; letter-spacing: 0.05em; border-color: var(--meesho-pink); color: var(--meesho-pink);">
                            Buy Now
                        </button>
                        <button class="btn w-50 py-2.5 fw-bold text-uppercase text-white" id="modal-add-cart-btn" data-variant-id="${p.variant_id}" style="background: var(--meesho-pink); border-radius: 4px; font-size: 0.8rem; letter-spacing: 0.05em; border: none;">
                            <i class="fa-solid fa-bag-shopping me-1"></i> Add to Bag
                        </button>
                    </div>
                </div>
            </div>
        `);
    });

    // Add to Cart
    $(document).on('click', '#modal-add-cart-btn', function() {
        const btn = $(this);
        const variantId = btn.attr('data-variant-id');
        const qty = parseInt($('#modal-qty-select').val() || 1);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Adding...');
        $.ajax({
            url: '/cart/add', method: 'POST', contentType: 'application/json',
            data: JSON.stringify({ variant_id: variantId, quantity: qty }), dataType: 'json',
            success: function() {
                const modalEl = document.getElementById('productDetailModal');
                if (modalEl && window.bootstrap) {
                    bootstrap.Modal.getOrCreateInstance(modalEl).hide();
                } else {
                    $('#productDetailModal').modal('hide');
                }
                $('#cart-trigger-btn').click();
            },
            error: function(xhr) {
                alert(xhr.responseJSON ? xhr.responseJSON.error : 'Failed to add to cart');
                btn.prop('disabled', false).html('<i class="fa fa-shopping-bag me-2"></i> Add to Bag');
            }
        });
    });

    // Buy Now Handler
    $(document).on('click', '#modal-buy-now-btn', function() {
        const btn = $(this);
        const modalBtn = $('#modal-add-cart-btn');
        const variantId = modalBtn.attr('data-variant-id');
        const qty = parseInt($('#modal-qty-select').val() || 1);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        
        $.ajax({
            url: '/cart/add',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ variant_id: variantId, quantity: qty }),
            dataType: 'json',
            success: function() {
                const modalEl = document.getElementById('productDetailModal');
                if (modalEl && window.bootstrap) {
                    bootstrap.Modal.getOrCreateInstance(modalEl).hide();
                } else {
                    $('#productDetailModal').modal('hide');
                }
                window.location.href = '/cart'; // Redirect directly to checkout/cart
            },
            error: function(xhr) {
                alert(xhr.responseJSON ? xhr.responseJSON.error : 'Failed to buy now');
                btn.prop('disabled', false).html('Buy Now');
            }
        });
    });

    // Size Guide Handler
    $(document).on('click', '.modal-size-guide-btn', function() {
        alert('Saree Size Guide:\nStandard Length: 5.5 meters\nBlouse Piece: 0.8 meters (unstitched)\nTotal Width: 1.1 meters');
    });

    // Wishlist Handler inside Modal
    $(document).on('click', '.modal-wishlist-btn', function() {
        $(this).toggleClass('active');
        const isActive = $(this).hasClass('active');
        $(this).find('i').toggleClass('fa-regular fa-solid').css('color', isActive ? '#e74c3c' : '');
        showToast(isActive ? 'Added to Wishlist ❤️' : 'Removed from Wishlist');
    });

    // Share Handler inside Modal
    $(document).on('click', '.modal-share-btn', function() {
        navigator.clipboard.writeText(window.location.origin + '/?show_product=' + $('#modal-add-cart-btn').attr('data-variant-id'));
        showToast('Product link copied to clipboard! 🔗');
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
    // Pincode collapsible checking form handlers
    $(document).on('click', '.pincode-change-trigger', function() {
        $('#pincode-input-wrapper').slideToggle(200);
    });

    $(document).on('click', '#btn-apply-pincode', function() {
        const pin = $('#delivery-pincode-input').val().trim();
        if (/^\d{6}$/.test(pin)) {
            $('#pincode-error').hide();
            $('#modal-delivery-address-label').text(`Deliver to Store - Pincode ${pin}`);
            $('#pincode-input-wrapper').slideUp(200);
        } else {
            $('#pincode-error').show();
        }
    });
});
</script>

<!-- Filters Modal (Luxury Split-Screen Tabbed Sidebar Format) -->
<div class="modal fade" id="filtersModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 550px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; background-color: #FFFDF8;">
            <!-- Header -->
            <div class="modal-header border-0 pb-2" style="background-color: var(--premium-light-bg); border-top-left-radius: 16px; border-top-right-radius: 16px; padding: 1.25rem;">
                <h5 class="modal-title fw-bold" style="font-family: var(--font-headings); color: var(--meesho-pink);"><i class="fa-solid fa-sliders me-2" style="color: var(--premium-gold);"></i>Refine Sarees</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body p-0">
                <form method="GET" action="/" id="saree-filters-form">
                    <?php if (!empty($searchQuery)): ?>
                        <input type="hidden" name="search" value="<?= htmlspecialchars($searchQuery) ?>">
                    <?php endif; ?>
                    
                    <div class="filter-split-container">
                        <!-- Left Sidebar Tabs -->
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
                        
                        <!-- Right Content Panels -->
                        <div class="filter-content-panel">
                            
                            <!-- 1. Fabric / Material -->
                            <div class="filter-pane-group active" id="pane-fabric">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--meesho-pink); letter-spacing:0.05em;">Fabric / Material</h6>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach (['Silk (Kanjeevaram, Banarasi)', 'Cotton', 'Georgette', 'Chiffon', 'Crepe', 'Linen', 'Satin', 'Synthetic Blends'] as $f): ?>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size:0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_fabric[]" value="<?= htmlspecialchars($f) ?>"> <?= htmlspecialchars($f) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <!-- 2. Color Palette & Spectrum -->
                            <div class="filter-pane-group" id="pane-color">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--meesho-pink); letter-spacing:0.05em;">Color Palette</h6>
                                <div class="d-flex flex-column gap-2 mb-3">
                                    <?php foreach (['Red' => '#e74c3c', 'Blue' => '#3498db', 'Green' => '#2ecc71', 'Yellow' => '#f1c40f', 'Peach' => '#ffb8b8', 'Lavender' => '#dec9e9', 'White' => '#ffffff', 'Black' => '#000000', 'Beige' => '#f5f5dc', 'Ombre' => 'linear-gradient(to right, #6b1d1d, #c9972e)'] as $colorName => $colorHex): ?>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size:0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_color[]" value="<?= $colorName ?>"> 
                                            <span style="display:inline-block; width:12px; height:12px; border-radius:50%; background:<?= $colorHex ?>; border:1px solid #ddd;"></span>
                                            <?= $colorName ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                                <div class="border-top pt-2">
                                    <label class="form-label mb-1" style="font-size: 0.7rem; font-weight:700;">Custom Picker</label>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="color" class="form-control-color border-0 p-0" name="custom_color_picker" value="#6B1D1D" style="width:30px; height:30px; cursor:pointer; background:none;">
                                        <span class="text-muted small" style="font-size:0.65rem;">Tap block for custom colors</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 3. Occasion / Usage -->
                            <div class="filter-pane-group" id="pane-occasion">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--meesho-pink); letter-spacing:0.05em;">Occasion & Usage</h6>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach (['Casual / Daily wear', 'Office / Formal', 'Festive / Traditional', 'Wedding / Bridal', 'Party / Cocktail'] as $occ): ?>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size:0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_occasion[]" value="<?= htmlspecialchars($occ) ?>"> <?= htmlspecialchars($occ) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <!-- 4. Wholesale Price Range -->
                            <div class="filter-pane-group" id="pane-price">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--meesho-pink); letter-spacing:0.05em;">Wholesale Price (₹)</h6>
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
                            
                            <!-- 5. Pattern / Design -->
                            <div class="filter-pane-group" id="pane-pattern">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--meesho-pink); letter-spacing:0.05em;">Pattern / Design</h6>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach (['Plain / Solid', 'Printed (Floral/Motifs)', 'Embroidered / Zari / Sequined', 'Patchwork / Appliqué', 'Block Print / Handloom'] as $pat): ?>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size:0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_pattern[]" value="<?= htmlspecialchars($pat) ?>"> <?= htmlspecialchars($pat) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <!-- 6. Saree Type / Regional Style -->
                            <div class="filter-pane-group" id="pane-style">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--meesho-pink); letter-spacing:0.05em;">Weaving Styles</h6>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach ($categoriesList as $cat): ?>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size:0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_regional[]" value="<?= htmlspecialchars($cat['name']) ?>" <?= $selectedCategory === $cat['name'] ? 'checked' : '' ?>> <?= htmlspecialchars($cat['name']) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <!-- 7. Blouse Style / Options -->
                            <div class="filter-pane-group" id="pane-blouse">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--meesho-pink); letter-spacing:0.05em;">Blouse Customization</h6>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach (['Matching blouse included', 'Full Sleeve options', 'Short Sleeve / Sleeveless', 'Customizable blouse specs'] as $bl): ?>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size:0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_blouse[]" value="<?= htmlspecialchars($bl) ?>"> <?= htmlspecialchars($bl) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <!-- 8. Length & Width -->
                            <div class="filter-pane-group" id="pane-dimensions">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--meesho-pink); letter-spacing:0.05em;">Saree Size</h6>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach (['Standard length (5.5–6.5m)', 'Plus-size / Extended drape', 'Custom width variations'] as $dim): ?>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size:0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_dimensions[]" value="<?= htmlspecialchars($dim) ?>"> <?= htmlspecialchars($dim) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <!-- 9. User Ratings -->
                            <div class="filter-pane-group" id="pane-ratings">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--meesho-pink); letter-spacing:0.05em;">Ratings & Popularity</h6>
                                <div class="d-flex flex-column gap-2">
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="checkbox" name="filter_rating" value="4_star_above"> <span style="color:var(--premium-gold);"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span> 4-Star & Above
                                    </label>
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="checkbox" name="filter_popular" value="trending"> <i class="fa-solid fa-fire me-1" style="color:#e67e22;"></i> Trending
                                    </label>
                                </div>
                            </div>
                            
                            <!-- 10. Brand / Artisan Hub -->
                            <div class="filter-pane-group" id="pane-brand">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--meesho-pink); letter-spacing:0.05em;">Brand & Artisan Hubs</h6>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach (['Local Handloom Co-ops', 'Weaver Artisan Labels', 'Exclusive Boutique Brands'] as $br): ?>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size:0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_brand[]" value="<?= htmlspecialchars($br) ?>"> <?= htmlspecialchars($br) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <!-- 11. Care Instructions -->
                            <div class="filter-pane-group" id="pane-care">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--meesho-pink); letter-spacing:0.05em;">Care Instructions</h6>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach (['Dry clean only', 'Machine washable', 'Gentle handwash recommended'] as $care): ?>
                                        <label class="d-flex align-items-center gap-2 mb-0" style="font-size:0.8rem; cursor:pointer;">
                                            <input type="checkbox" name="filter_care[]" value="<?= htmlspecialchars($care) ?>"> <?= htmlspecialchars($care) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <!-- 12. Availability & Logistics -->
                            <div class="filter-pane-group" id="pane-delivery">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--meesho-pink); letter-spacing:0.05em;">Availability</h6>
                                <div class="d-flex flex-column gap-2">
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="checkbox" name="filter_stock" value="in_stock" checked> In Stock / Ready to Ship
                                    </label>
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="checkbox" name="filter_shipping" value="fast_delivery"> Same-Day Shipping
                                    </label>
                                </div>
                            </div>
                            
                            <!-- 13. New Arrivals & Discounts -->
                            <div class="filter-pane-group" id="pane-deals">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--meesho-pink); letter-spacing:0.05em;">New & Deals</h6>
                                <div class="d-flex flex-column gap-2">
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="checkbox" name="filter_newest" value="yes"> Recently Loomed (New)
                                    </label>
                                    <label class="d-flex align-items-center gap-2 mb-0" style="font-size: 0.8rem; cursor:pointer;">
                                        <input type="checkbox" name="filter_discount" value="yes"> Discounted Bundles
                                    </label>
                                </div>
                            </div>
                            
                            <!-- 14. Sustainability -->
                            <div class="filter-pane-group" id="pane-green">
                                <h6 class="fw-bold mb-3 text-uppercase" style="font-size:0.7rem; color:var(--meesho-pink); letter-spacing:0.05em;">Ethical Sourcing</h6>
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

                    <!-- Apply & Reset Buttons footer style -->
                    <div class="p-3 border-0 d-flex gap-2" style="background-color: var(--premium-light-bg); border-bottom-left-radius: 16px; border-bottom-right-radius: 16px; border-top: 1px solid var(--premium-border);">
                        <button type="button" class="btn btn-outline-secondary w-50 py-2 rounded-0 text-uppercase fw-bold" style="font-size: 0.72rem; letter-spacing: 0.05em;" onclick="document.getElementById('saree-filters-form').reset()">Clear All</button>
                        <button type="submit" class="btn btn-meesho-pink w-50 py-2 rounded-0 text-uppercase fw-bold" style="font-size: 0.72rem; letter-spacing: 0.05em;">Apply Filters</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
// jQuery Script for Tab Toggles
$(document).ready(function() {
    $('.filter-tab-btn').on('click', function() {
        // Toggle active class on sidebar tabs
        $('.filter-tab-btn').removeClass('active');
        $(this).addClass('active');
        
        // Show target panel and hide others
        var targetPane = $(this).data('target');
        $('.filter-pane-group').removeClass('active');
        $('#' + targetPane).addClass('active');
    });

    // ══════════════════════════════════════════════════════
    // SAREE IMAGE ZOOM LIGHTBOX LOGIC
    // ══════════════════════════════════════════════════════
    $(document).on('click', '.zoomable-saree-img', function(e) {
        var src = $(this).attr('src');
        if (!src) return;

        // Create lightbox structure dynamically
        var lightboxHtml = `
            <div class="pavitra-zoom-lightbox">
                <button class="pavitra-zoom-close" title="Close"><i class="fa-solid fa-xmark"></i></button>
                <div class="pavitra-zoom-wrapper">
                    <img src="${src}" class="pavitra-zoom-img" alt="Zoom Saree">
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

        // Zoom In
        $('.btn-zoom-in').on('click', function(e) {
            e.stopPropagation();
            scale = Math.min(scale + 0.5, 4);
            updateTransform();
        });

        // Zoom Out
        $('.btn-zoom-out').on('click', function(e) {
            e.stopPropagation();
            scale = Math.max(scale - 0.5, 0.5);
            if (scale === 1) {
                posX = 0;
                posY = 0;
            }
            updateTransform();
        });

        // Reset Zoom
        $('.btn-zoom-reset').on('click', function(e) {
            e.stopPropagation();
            scale = 1;
            posX = 0;
            posY = 0;
            updateTransform();
        });

        // Close Lightbox
        $('.pavitra-zoom-close, .pavitra-zoom-lightbox').on('click', function(e) {
            if (e.target !== this && !$(e.target).closest('.pavitra-zoom-close').length) return;
            $('.pavitra-zoom-lightbox').removeClass('show');
            setTimeout(function() {
                $('.pavitra-zoom-lightbox').remove();
            }, 300);
        });

        // Drag/Pan Functionality
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

        // Mouse Wheel Zoom
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
