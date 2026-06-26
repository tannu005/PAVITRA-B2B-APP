<!-- Admin Products Catalog Validation -->
<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa fa-shirt text-pink me-2"></i>Validate Catalog</h2>
            <p class="text-muted mb-0">Approve or reject saree uploads from registered weavers before they appear in storefront searches.</p>
        </div>
        <a href="/admin" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
    </div>

    <div class="card shadow-sm border border-light p-4 bg-white">
        <div class="table-responsive">
            <table class="table align-middle" style="font-size: 0.9rem;">
                <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem;">
                    <tr>
                        <th style="width: 80px;">Saree Image</th>
                        <th>Product Specification</th>
                        <th>Weaver / Seller</th>
                        <th>Category</th>
                        <th>SKU Code</th>
                        <th>Wholesale price</th>
                        <th>Live Stock</th>
                        <th>Approval State</th>
                        <th class="text-end">Oversight Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productsList as $p): ?>
                        <tr>
                            <td>
                                <img src="<?= htmlspecialchars($p['image_url'] ?: '/assets/images/placeholder.png') ?>" alt="" class="rounded border" style="width: 50px; height: 60px; object-fit: cover;">
                            </td>
                            <td>
                                <h6 class="fw-semibold mb-1 text-dark"><?= htmlspecialchars($p['title']) ?></h6>
                                <span class="text-muted d-block text-truncate small" style="max-width: 200px;"><?= htmlspecialchars($p['description']) ?></span>
                            </td>
                            <td class="small fw-semibold"><?= htmlspecialchars($p['seller_name']) ?></td>
                            <td>
                                <span class="badge bg-light text-secondary border"><?= htmlspecialchars($p['category_name']) ?></span>
                            </td>
                            <td><code><?= htmlspecialchars($p['sku']) ?></code></td>
                            <td class="fw-bold text-pink">₹<?= number_format($p['wholesale_price']) ?></td>
                            <td>
                                <span class="badge bg-light border text-dark"><?= $p['stock'] ?> pcs</span>
                            </td>
                            <td>
                                <?php if ($p['is_approved'] == 1): ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Approved</span>
                                <?php else: ?>
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1">Pending Gate</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <?php if ($p['is_approved'] == 1): ?>
                                    <button class="btn btn-outline-danger btn-sm approve-prod-btn" data-id="<?= $p['id'] ?>" data-approve="0">
                                        Revoke Approval
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-meesho-pink btn-sm approve-prod-btn" data-id="<?= $p['id'] ?>" data-approve="1">
                                        Approve Saree
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $('.approve-prod-btn').on('click', function() {
        const prodId = $(this).data('id');
        const actionApprove = $(this).data('approve');
        const btn = $(this);
        
        btn.prop('disabled', true).text('Updating...');

        $.ajax({
            url: '/admin/products/approve',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ product_id: prodId, approve: actionApprove }),
            success: function(res) {
                if (res.success) {
                    alert('Product catalog status updated successfully!');
                    window.location.reload();
                } else {
                    alert(res.error || 'Failed to update catalog status');
                    window.location.reload();
                }
            },
            error: function() {
                alert('Network error updating catalog.');
                window.location.reload();
            }
        });
    });
</script>
