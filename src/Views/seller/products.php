<!-- Seller Catalog List -->
<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa fa-shirt text-pink me-2"></i>My Saree Catalog</h2>
            <p class="text-muted mb-0">Inspect approval status, retail values, and live inventory balances.</p>
        </div>
        <div>
            <a href="/seller" class="btn btn-outline-secondary btn-sm me-2"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
            <a href="/seller/products/create" class="btn btn-meesho-pink btn-sm"><i class="fa fa-plus me-1"></i> Upload Saree</a>
        </div>
    </div>

    <?php if (empty($products)): ?>
        <div class="card p-5 text-center shadow-sm border border-light">
            <i class="fa-solid fa-store-slash text-muted mb-3" style="font-size: 3.5rem;"></i>
            <h4 class="fw-bold">No Products Uploaded</h4>
            <p class="text-muted mb-3">Begin marketing your weavers' handloom craft by uploading your first saree variant.</p>
            <div>
                <a href="/seller/products/create" class="btn btn-meesho-pink px-4">Upload First Item</a>
            </div>
        </div>
    <?php else: ?>
        <div class="card shadow-sm border border-light p-4">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem;">
                        <tr>
                            <th style="width: 80px;">Image</th>
                            <th>Saree Details</th>
                            <th>Category</th>
                            <th>SKU Code</th>
                            <th>Prices (Wholesale / Retail)</th>
                            <th>Stock Status</th>
                            <th>Admin Verification</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $p): ?>
                            <tr>
                                <td>
                                    <img src="<?= htmlspecialchars($p['image_url'] ?: '/assets/images/placeholder.png') ?>" alt="" class="rounded border" style="width: 50px; height: 60px; object-fit: cover;">
                                </td>
                                <td>
                                    <h6 class="fw-bold text-dark mb-1"><?= htmlspecialchars($p['title']) ?></h6>
                                    <span class="text-muted d-block text-truncate" style="max-width: 250px; font-size: 0.75rem;"><?= htmlspecialchars($p['description']) ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border"><?= htmlspecialchars($p['category_name']) ?></span>
                                </td>
                                <td>
                                    <code><?= htmlspecialchars($p['sku']) ?></code>
                                </td>
                                <td>
                                    <div class="fw-bold text-pink" style="font-size: 0.95rem;">₹<?= number_format($p['wholesale_price']) ?></div>
                                    <div class="text-muted text-decoration-line-through" style="font-size: 0.8rem;">₹<?= number_format($p['price']) ?></div>
                                </td>
                                <td>
                                    <?php if ($p['stock'] <= 5): ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle"><?= $p['stock'] ?> units (Low stock)</span>
                                    <?php else: ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle"><?= $p['stock'] ?> units</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($p['is_approved'] == 1): ?>
                                        <span class="badge bg-success px-2 py-1"><i class="fa fa-circle-check me-1"></i>Approved</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark px-2 py-1"><i class="fa fa-clock me-1"></i>Pending Review</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>
