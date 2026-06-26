<!-- Seller Panel Dashboard -->
<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-shop text-pink me-2"></i>Weaver Hub Central</h2>
            <p class="text-muted mb-0">Manage catalog uploads, track boutique orders, and review GST tax settlements.</p>
        </div>
        <div>
            <a href="/seller/products/create" class="btn btn-meesho-pink btn-sm"><i class="fa fa-plus me-1"></i> Upload New Saree</a>
        </div>
    </div>

    <!-- Stat cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border border-light p-3 bg-white">
                <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Direct Ledger Balance</span>
                <h3 class="fw-bold text-dark mt-2 mb-0">₹<?= number_format($balance, 2) ?></h3>
                <div class="text-success small mt-1"><i class="fa fa-circle-check"></i> Available for withdrawal</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border border-light p-3 bg-white">
                <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Weaver Net Earnings</span>
                <h3 class="fw-bold text-pink mt-2 mb-0">₹<?= number_format($totalEarnings, 2) ?></h3>
                <div class="text-secondary small mt-1">From completed B2B sales</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border border-light p-3 bg-white">
                <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Wholesale Orders</span>
                <h3 class="fw-bold text-dark mt-2 mb-0"><?= $totalOrders ?></h3>
                <div class="text-secondary small mt-1">Boutique purchases</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border border-light p-3 bg-white">
                <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Saree Catalog Items</span>
                <h3 class="fw-bold text-dark mt-2 mb-0"><?= $totalProducts ?></h3>
                <div class="text-secondary small mt-1">Live active sarees</div>
            </div>
        </div>
    </div>

    <!-- Navigation Control Grid -->
    <div class="row g-4">
        <!-- Quick Actions Panel -->
        <div class="col-lg-4">
            <div class="card shadow-sm border border-light p-4 bg-white h-100">
                <h5 class="fw-bold mb-3 text-dark">Quick Navigation</h5>
                <div class="d-flex flex-column gap-2">
                    <a href="/seller/products" class="btn btn-light border text-start py-2 px-3 fw-semibold"><i class="fa fa-shirt text-pink me-2"></i> My Saree Catalog</a>
                    <a href="/seller/inventory" class="btn btn-light border text-start py-2 px-3 fw-semibold"><i class="fa fa-warehouse text-pink me-2"></i> Inventory Manager</a>
                    <a href="/seller/orders" class="btn btn-light border text-start py-2 px-3 fw-semibold"><i class="fa fa-box-open text-pink me-2"></i> Dispatch Shipments</a>
                    <a href="/seller/settlements" class="btn btn-light border text-start py-2 px-3 fw-semibold"><i class="fa-solid fa-file-invoice-dollar text-pink me-2"></i> Settlement & Payout Reports</a>
                </div>
            </div>
        </div>

        <!-- Recent Incoming Orders -->
        <div class="col-lg-8">
            <div class="card shadow-sm border border-light p-4 bg-white h-100">
                <h5 class="fw-bold mb-3 text-dark">Recent Bulk Orders</h5>
                <?php if (empty($recentOrders)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fa-solid fa-cart-shopping fs-1 opacity-25 mb-2"></i>
                        <p class="mb-0">No active incoming orders received yet.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light text-uppercase text-muted" style="font-size: 0.7rem;">
                                <tr>
                                    <th>Order #</th>
                                    <th>Buyer Store</th>
                                    <th>Net Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentOrders as $o): ?>
                                    <tr>
                                        <td><code class="text-pink"><?= htmlspecialchars($o['order_number']) ?></code></td>
                                        <td class="small fw-semibold"><?= htmlspecialchars($o['buyer_name']) ?></td>
                                        <td>₹<?= number_format($o['net_amount'], 2) ?></td>
                                        <td>
                                            <span class="badge bg-pink-light text-pink"><?= htmlspecialchars($o['status']) ?></span>
                                        </td>
                                        <td>
                                            <a href="/seller/orders" class="btn btn-link text-decoration-none text-pink fw-bold p-0 small">Process</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
