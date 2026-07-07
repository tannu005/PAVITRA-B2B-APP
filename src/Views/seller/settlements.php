<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-credit-card text-pink me-2"></i>My Payouts & Settlements</h2>
            <p class="text-muted mb-0">Track completed wholesale payouts, service commissions, and tax deductions.</p>
        </div>
        <a href="/seller" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
    </div>
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card shadow-sm border border-light p-4 bg-white mb-4">
                <h5 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-clock-rotate-left text-pink me-2"></i>Settlement Policy</h5>
                <p class="text-muted small mb-3">Pavitra Designer operates on a standard <strong>T+3 settlement cycle</strong> for handloom weavers. Payouts are computed as follows:</p>
                <div class="p-3 bg-light rounded text-secondary small mb-3" style="font-size: 0.8rem;">
                    <div class="mb-1"><strong>Commission:</strong> 8.5% platform service charge.</div>
                    <div><strong>Tax (GST):</strong> 5% HSN fabric tax rate deducted at source.</div>
                </div>
                <div class="text-muted small">Once courier driver confirms delivery, payouts are credited to your bank details on record within 3 business days.</div>
            </div>
            
            <div class="card shadow-sm border border-light bg-light p-3 text-muted" style="font-size: 0.75rem;">
                <div class="fw-bold text-dark mb-1"><i class="fa-solid fa-building-columns me-1"></i>Linked Bank Details</div>
                • Bank: State Bank of India<br>
                • Holder: Pavitra Designer Weavers Ltd.<br>
                • Account: ••••4567<br>
                • IFSC Code: SBIN0001234
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm border border-light p-4 bg-white">
                <h5 class="fw-bold mb-4 text-dark"><i class="fa-solid fa-file-invoice-dollar text-pink me-2"></i>Payout Settlement Ledger</h5>

                <?php if (empty($settlements)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fa-solid fa-receipt fs-1 opacity-25 mb-2"></i>
                        <p class="mb-0">No bank settlements recorded for your shop yet.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table align-middle" style="font-size: 0.9rem;">
                            <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem;">
                                <tr>
                                    <th>Settlement ID</th>
                                    <th>Order #</th>
                                    <th>Sales Total</th>
                                    <th>Commission</th>
                                    <th>Tax Deducted</th>
                                    <th>Net Payout</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($settlements as $s): ?>
                                    <tr>
                                        <td><code>#<?= htmlspecialchars($s['settlement_number']) ?></code></td>
                                        <td><span class="text-pink fw-semibold"><?= htmlspecialchars($s['order_number']) ?></span></td>
                                        <td class="text-dark fw-medium">₹<?= number_format($s['sales_amount'], 2) ?></td>
                                        <td class="text-danger">- ₹<?= number_format($s['commission_deducted'], 2) ?></td>
                                        <td class="text-secondary">- ₹<?= number_format($s['tax_deducted'], 2) ?></td>
                                        <td class="text-success fw-bold">₹<?= number_format($s['net_payout'], 2) ?></td>
                                        <td>
                                            <?php if ($s['status'] === 'SUCCESS'): ?>
                                                <span class="badge bg-success-subtle text-success border border-success-subtle">Credited</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle">Processing</span>
                                            <?php endif; ?>
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
