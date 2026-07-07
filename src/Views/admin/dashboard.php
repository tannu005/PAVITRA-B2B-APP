<!-- Super Admin Dashboard Console -->
<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-chart-line text-pink me-2"></i>Super Admin Console</h2>
            <p class="text-muted mb-0">Platform stats, KYC verification queue, weavers settlement runs, and error diagnostic logs.</p>
        </div>
        <a href="/" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Go to Storefront</a>
    </div>

    <!-- Stat Grid -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border border-light p-3 bg-white">
                <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Total Sales (PAID)</span>
                <h3 class="fw-bold text-dark mt-2 mb-0">₹<?= number_format($stats['sales'], 2) ?></h3>
                <div class="text-secondary small mt-1">Platform gross transaction volume</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border border-light p-3 bg-white">
                <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Platform Commissions</span>
                <h3 class="fw-bold text-pink mt-2 mb-0">₹<?= number_format($stats['commission'], 2) ?></h3>
                <div class="text-secondary small mt-1">Net service fee earnings</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border border-light p-3 bg-white">
                <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Registered Users</span>
                <h3 class="fw-bold text-dark mt-2 mb-0"><?= $stats['sellers'] + $stats['retailers'] ?></h3>
                <div class="text-secondary small mt-1">Sellers: <?= $stats['sellers'] ?> | Retailers: <?= $stats['retailers'] ?></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border border-light p-3 bg-white">
                <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Catalog / Pending Gateway</span>
                <h3 class="fw-bold text-dark mt-2 mb-0"><?= $stats['products'] ?></h3>
                <div class="text-danger small mt-1"><i class="fa fa-clock"></i> <?= $stats['pending_products'] ?> sarees pending review</div>
            </div>
        </div>
    </div>

    <!-- Quick Navigation Hub -->
    <h5 class="fw-bold mb-3 text-dark">Administrative Sections</h5>
    <div class="row g-3">
        <div class="col-6 col-md-4 col-lg-2">
            <a href="/admin/sellers" class="card shadow-sm border text-center p-3 h-100 text-decoration-none hover-card">
                <i class="fa fa-users text-pink mb-2 fs-3"></i>
                <div class="fw-semibold text-dark small">Merchants Queue</div>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="/admin/products" class="card shadow-sm border text-center p-3 h-100 text-decoration-none hover-card">
                <i class="fa fa-shirt text-pink mb-2 fs-3"></i>
                <div class="fw-semibold text-dark small">Validate Catalog</div>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="/admin/kyc" class="card shadow-sm border text-center p-3 h-100 text-decoration-none hover-card">
                <i class="fa-solid fa-address-card text-pink mb-2 fs-3"></i>
                <div class="fw-semibold text-dark small">KYC Deck</div>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="/admin/commissions" class="card shadow-sm border text-center p-3 h-100 text-decoration-none hover-card">
                <i class="fa-solid fa-calculator text-pink mb-2 fs-3"></i>
                <div class="fw-semibold text-dark small">Commissions Config</div>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="/admin/settlements" class="card shadow-sm border text-center p-3 h-100 text-decoration-none hover-card">
                <i class="fa-solid fa-credit-card text-pink mb-2 fs-3"></i>
                <div class="fw-semibold text-dark small">Weaver Settlements</div>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="/admin/errors" class="card shadow-sm border text-center p-3 h-100 text-decoration-none hover-card">
                <i class="fa-solid fa-triangle-exclamation text-pink mb-2 fs-3"></i>
                <div class="fw-semibold text-dark small">Trace Errors <span class="badge bg-danger ms-1"><?= $stats['errors'] ?></span></div>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="/admin/settings" class="card shadow-sm border text-center p-3 h-100 text-decoration-none hover-card">
                <i class="fa-solid fa-sliders text-pink mb-2 fs-3"></i>
                <div class="fw-semibold text-dark small">Platform Settings</div>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="/admin/cms" class="card shadow-sm border text-center p-3 h-100 text-decoration-none hover-card">
                <i class="fa-solid fa-file-signature text-pink mb-2 fs-3"></i>
                <div class="fw-semibold text-dark small">Legal Page CMS</div>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="/admin/support" class="card shadow-sm border text-center p-3 h-100 text-decoration-none hover-card">
                <i class="fa-solid fa-headset text-pink mb-2 fs-3"></i>
                <div class="fw-semibold text-dark small">Helpdesk Queue</div>
            </a>
        </div>
    </div>
</div>

<style>
.hover-card {
    transition: transform 0.2s, box-shadow 0.2s;
}
.hover-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.05);
}
</style>
