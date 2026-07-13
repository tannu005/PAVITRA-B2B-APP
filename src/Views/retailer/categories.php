<?php
?>
<div class="container py-4 my-2" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="card border-0 mb-5 overflow-hidden shadow-sm" style="border-radius: 16px; background: linear-gradient(135deg, var(--pavitra-pink) 0%, #3D0A0A 100%); border: 1px solid rgba(201, 151, 46, 0.25) !important;">
        <div class="card-body p-4 p-md-5 text-white position-relative">
            <div class="row align-items-center g-4">
                <div class="col-lg-8 col-12">
                    <span class="badge text-uppercase px-3 py-2 mb-2" style="font-size:0.65rem; letter-spacing:0.1em; background: var(--premium-gold-gradient); color: #FFF;">Exclusive B2B Service</span>
                    <h3 class="h2 text-uppercase mb-2" style="font-family: var(--font-headings); letter-spacing: 0.08em; color: #FFF !important;">Bespoke Handloom Customization</h3>
                    <p class="mb-0 text-white-50" style="font-size: 0.85rem; max-width: 600px;">Directly order custom weaves, color dye spectrums, zari border sizes, and matching custom blouse fits straight from artisan looms.</p>
                </div>
                <div class="col-lg-4 col-12 text-lg-end">
                    <a href="/customization" class="btn btn-light rounded-0 px-4 py-2.5 text-uppercase fw-bold" style="font-size:0.75rem; letter-spacing:0.05em; color: var(--pavitra-pink); border: 2px solid #FFF;">Open Design Studio</a>
                </div>
            </div>
            <div style="position: absolute; right: -50px; top: -50px; width: 200px; height: 200px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.04); pointer-events:none;"></div>
        </div>
    </div>
    <div class="text-center mb-5">
        <h2 class="text-uppercase fw-normal mb-1" style="font-family: var(--font-headings); letter-spacing: 0.12em; color: var(--pavitra-pink);">Weaver Business Directory</h2>
        <p class="text-muted small text-uppercase" style="letter-spacing: 0.08em;">Direct Hubs & Specialty Saree Stores</p>
        <div style="width: 40px; height: 1.5px; background-color: var(--premium-gold); margin: 12px auto 0;"></div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($stores as $store): ?>
            <div class="col">
                <a href="/?category=<?= $store['slug'] ?>" class="text-decoration-none text-dark d-block h-100">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center pavitra-store-card" style="border-radius: 16px; background-color: #FFFDF8; border: 1px solid var(--premium-border) !important; transition: all 0.35s ease;">
                        <div class="d-flex justify-content-center mb-3">
                            <div class="img-wrapper" style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 3px solid #FFF; box-shadow: 0 8px 24px rgba(107,29,29,0.12); position:relative;">
                                <img src="<?= htmlspecialchars($store['image']) ?>" alt="<?= htmlspecialchars($store['name']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                        <span class="badge bg-gold-light text-uppercase mb-2 px-2.5 py-1.5" style="font-size:0.6rem; letter-spacing:0.08em; background-color: var(--premium-gold-light); color: var(--premium-gold-dark); font-weight:700;">
                            <?= htmlspecialchars($store['speciality']) ?>
                        </span>
                        <h4 class="h6 text-uppercase fw-bold mb-1" style="letter-spacing: 0.05em; color: var(--pavitra-pink);"><?= htmlspecialchars($store['name']) ?></h4>
                        <div class="text-muted mb-2 small d-flex align-items-center justify-content-center gap-1" style="font-size:0.7rem;">
                            <i class="fa-solid fa-user-tie" style="color:var(--premium-gold);"></i> <span><?= htmlspecialchars($store['artisan']) ?></span>
                        </div>
                        <div class="text-muted mb-3 small d-flex align-items-center justify-content-center gap-1" style="font-size:0.7rem;">
                            <i class="fa-solid fa-location-dot" style="color:var(--premium-gold);"></i> <span><?= htmlspecialchars($store['location']) ?></span>
                        </div>
                        <p class="text-muted mb-4 small" style="line-height:1.6; min-height:60px; font-size:0.78rem;"><?= htmlspecialchars($store['desc']) ?></p>
                        <div class="d-flex align-items-center justify-content-between border-top pt-3 mt-auto">
                            <span class="small" style="font-weight:700; color:var(--premium-gold-dark);"><i class="fa fa-star me-1 text-warning"></i><?= $store['rating'] ?></span>
                            <span class="text-uppercase fw-bold" style="font-size: 0.72rem; letter-spacing: 0.08em; color: var(--pavitra-pink);">Visit Store →</span>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<style>
.pavitra-store-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 36px rgba(107,29,29,0.08) !important;
    background-color: #FFF !important;
    border-color: var(--premium-gold) !important;
}
.pavitra-store-card:hover .img-wrapper {
    box-shadow: 0 12px 30px rgba(201,151,46,0.3) !important;
    transform: scale(1.05);
    transition: all 0.35s ease;
}
</style>
