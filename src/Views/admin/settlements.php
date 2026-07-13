<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-credit-card text-pink me-2"></i>Weaver Settlements Room</h2>
            <p class="text-muted mb-0">Close B2B sales periods, deduct platform service fees, and process payout settlements.</p>
        </div>
        <a href="/admin" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
    </div>

    <div class="card shadow-sm border border-light p-4 bg-white mb-5">
        <h5 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-hourglass-half text-warning me-2"></i>Pending Settlements Run</h5>
        <p class="text-muted small">Orders below are marked as <strong>DELIVERED</strong> but have not yet been settled. Check items to execute bank disbursements.</p>
        
        <?php if (empty($unsettledOrders)): ?>
            <div class="alert alert-success py-3 mb-0" style="font-size: 0.85rem;">
                <i class="fa fa-circle-check me-1"></i> All completed orders have been successfully settled with weavers.
            </div>
        <?php else: ?>
            <form id="settlement-run-form">
                <div class="table-responsive mb-3">
                    <table class="table align-middle" style="font-size: 0.9rem;">
                        <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem;">
                            <tr>
                                <th style="width: 40px;"><input type="checkbox" id="select-all-orders"></th>
                                <th>Order #</th>
                                <th>Weaver / Seller</th>
                                <th>Boutique buyer</th>
                                <th>Order Total</th>
                                <th>Commission Rate</th>
                                <th>Fabric GST (5%)</th>
                                <th>Net Payout (Est)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($unsettledOrders as $o): ?>
                                <?php
                                    $sales = floatval($o['total_amount']);
                                    $comm = ($sales * floatval($o['commission_rate'])) / 100.00;
                                    $tax = ($sales * 5.00) / 100.00;
                                    $payout = $sales - $comm - $tax;
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="order_ids[]" value="<?= $o['id'] ?>" class="order-select-chk"></td>
                                    <td><code class="text-pink"><?= htmlspecialchars($o['order_number']) ?></code></td>
                                    <td class="fw-semibold"><?= htmlspecialchars($o['seller_name']) ?></td>
                                    <td class="small text-secondary"><?= htmlspecialchars($o['buyer_name']) ?></td>
                                    <td class="fw-bold">₹<?= number_format($sales, 2) ?></td>
                                    <td class="text-danger">- ₹<?= number_format($comm, 2) ?> (<?= $o['commission_rate'] ?>%)</td>
                                    <td class="text-secondary">- ₹<?= number_format($tax, 2) ?></td>
                                    <td class="text-success fw-bold">₹<?= number_format($payout, 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-pavitra-pink py-2 px-4" id="run-settlement-btn">Execute Bank Settlement Run</button>
            </form>
        <?php endif; ?>
    </div>

    <div class="card shadow-sm border border-light p-4 bg-white">
        <h5 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-clock-rotate-left text-pink me-2"></i>Disbursement History Log</h5>
        
        <?php if (empty($settledList)): ?>
            <div class="text-center py-5 text-muted">
                <i class="fa-solid fa-receipt fs-1 opacity-25 mb-2"></i>
                <p class="mb-0">No disbursements processed yet.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table align-middle" style="font-size: 0.9rem;">
                    <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem;">
                        <tr>
                            <th>Settlement ID</th>
                            <th>Order Number</th>
                            <th>Weaver Name</th>
                            <th>Sales Amount</th>
                            <th>Commission Deducted</th>
                            <th>Tax Deducted</th>
                            <th>Net Payout</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($settledList as $s): ?>
                            <tr>
                                <td><code>#<?= htmlspecialchars($s['settlement_number']) ?></code></td>
                                <td><span class="text-pink fw-semibold"><?= htmlspecialchars($s['order_number']) ?></span></td>
                                <td class="small fw-semibold"><?= htmlspecialchars($s['seller_name']) ?></td>
                                <td>₹<?= number_format($s['sales_amount'], 2) ?></td>
                                <td class="text-danger">- ₹<?= number_format($s['commission_deducted'], 2) ?></td>
                                <td class="text-secondary">- ₹<?= number_format($s['tax_deducted'], 2) ?></td>
                                <td class="text-success fw-bold">₹<?= number_format($s['net_payout'], 2) ?></td>
                                <td>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1">Disbursed</span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    $('#select-all-orders').on('change', function() {
        $('.order-select-chk').prop('checked', $(this).prop('checked'));
    });

    $('#settlement-run-form').on('submit', function(e) {
        e.preventDefault();
        
        const checked = $('.order-select-chk:checked');
        if (checked.length === 0) {
            window.showToast('Please select at least one order to settle.');
            return;
        }

        const ids = [];
        checked.each(function() {
            ids.push($(this).val());
        });

        const btn = $('#run-settlement-btn');
        btn.prop('disabled', true).text('Processing Settlements Run...');

        $.ajax({
            url: '/admin/settlements/process',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ order_ids: ids }),
            success: function(res) {
                if (res.success) {
                    window.showToast('Settlement processed successfully! Funds transferred to weaver profiles.');
                    window.location.reload();
                } else {
                    window.showToast(res.error || 'Failed to process settlements');
                    btn.prop('disabled', false).text('Execute Bank Settlement Run');
                }
            },
            error: function() {
                window.showToast('Network error executing settlement.');
                btn.prop('disabled', false).text('Execute Bank Settlement Run');
            }
        });
    });
</script>

