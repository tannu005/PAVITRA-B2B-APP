<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa fa-warehouse text-pink me-2"></i>Inventory Manager</h2>
            <p class="text-muted mb-0">Track warehouse reserves, check stock depletion alerts, and log refills.</p>
        </div>
        <a href="/seller" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border border-light p-4 bg-white">
                <h5 class="fw-bold mb-3 text-dark">Weaver Reserves</h5>
                
                <?php if (empty($variants)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fa-solid fa-boxes-stacked fs-1 opacity-25 mb-2"></i>
                        <p class="mb-0">No active products in catalog to manage inventory.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem;">
                                <tr>
                                    <th>SKU Code</th>
                                    <th>Saree Title</th>
                                    <th>Color / Size</th>
                                    <th>Stock Level</th>
                                    <th class="text-end">Refill Adjustment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($variants as $v): ?>
                                    <tr>
                                        <td><code><?= htmlspecialchars($v['sku']) ?></code></td>
                                        <td class="small fw-semibold"><?= htmlspecialchars($v['title']) ?></td>
                                        <td class="small text-secondary"><?= htmlspecialchars($v['color'] ?: 'N/A') ?> / <?= htmlspecialchars($v['size'] ?: 'N/A') ?></td>
                                        <td>
                                            <?php if ($v['stock'] <= 5): ?>
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle" id="stock-badge-<?= $v['variant_id'] ?>"><?= $v['stock'] ?> units (Critical)</span>
                                            <?php else: ?>
                                                <span class="badge bg-success-subtle text-success border border-success-subtle" id="stock-badge-<?= $v['variant_id'] ?>"><?= $v['stock'] ?> units</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end">
                                            <div class="input-group input-group-sm ms-auto" style="max-width: 140px;">
                                                <input type="number" class="form-control restock-qty-input" placeholder="Qty" min="1" id="restock-input-<?= $v['variant_id'] ?>">
                                                <button class="btn btn-pavitra-pink restock-btn" data-id="<?= $v['variant_id'] ?>">Refill</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border border-light p-4 bg-white mb-4">
                <h5 class="fw-bold mb-3 text-dark">Multi-Warehouse Strategy</h5>
                <p class="text-muted small">Pavitra Designer coordinates warehouse nodes at:</p>
                <ul class="small text-secondary ps-3 mb-0">
                    <li>Varanasi Handloom Cluster Hub (Primary)</li>
                    <li>Kanchipuram Woven Registry Center</li>
                    <li>Surat Textile Trade Depot</li>
                </ul>
            </div>
            
            <div class="card shadow-sm border border-light bg-light p-3 text-muted" style="font-size: 0.75rem;">
                <div class="fw-bold text-dark mb-1"><i class="fa fa-info-circle me-1"></i>Audit Logs Active</div>
                All stock entries and sales dispatch cycles automatically generate immutable audit logs to resolve inventory differences.
            </div>
        </div>
    </div>
</div>

<script>
    $('.restock-btn').on('click', function() {
        const variantId = $(this).data('id');
        const qtyVal = parseInt($('#restock-input-' + variantId).val());

        if (isNaN(qtyVal) || qtyVal <= 0) {
            window.showToast('Please enter a valid stock refill quantity.');
            return;
        }

        const btn = $(this);
        btn.prop('disabled', true).text('...');

        $.ajax({
            url: '/seller/inventory/update',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ variant_id: variantId, qty: qtyVal }),
            success: function(res) {
                if (res.success) {
                    window.showToast('Inventory refilled successfully!');
                    window.location.reload();
                } else {
                    window.showToast(res.error || 'Failed to update stock');
                    btn.prop('disabled', false).text('Refill');
                }
            },
            error: function(xhr) {
                const err = xhr.responseJSON ? xhr.responseJSON.error : 'Network error';
                window.showToast(err);
                btn.prop('disabled', false).text('Refill');
            }
        });
    });
</script>
