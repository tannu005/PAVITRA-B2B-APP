<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-wallet text-pink me-2"></i>Wallet & Financial Ledger</h2>
            <p class="text-muted mb-0">Monitor wholesale credit limits, transaction debits/credits, and refill balances.</p>
        </div>
        <a href="/" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Go to Storefront</a>
    </div>
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 bg-pink text-white p-4 mb-4" style="background-color: var(--pavitra-pink) !important; border-radius: 12px;">
                <div class="small text-uppercase fw-semibold mb-1 opacity-75">Available Wallet Balance</div>
                <h1 class="fw-bold mb-3">₹<?= number_format($wallet['balance'] ?? 0, 2) ?></h1>
                
                <div class="d-flex justify-content-between align-items-center pt-3 border-top border-white-50 small">
                    <div>
                        <div class="opacity-75">Wholesale Credit Limit</div>
                        <div class="fw-bold">₹1,00,000.00</div>
                    </div>
                    <i class="fa-solid fa-wallet fs-1 opacity-25"></i>
                </div>
            </div>

            <div class="card shadow-sm border border-light p-4 mb-4">
                <h5 class="fw-bold mb-3 text-dark"><i class="fa-solid fa-money-bill-transfer text-pink me-2"></i>Add Cash / Deposit Request</h5>
                <p class="text-muted small">Simulate credit/deposit into your B2B wholesale wallet. Balance can be used instantly to buy sarees from weavers.</p>
                
                <form action="/wallet/deposit" method="POST" id="deposit-form">
                    <div class="mb-3">
                        <label for="amount" class="form-label small fw-semibold text-muted text-uppercase">Deposit Amount (₹)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted">₹</span>
                            <input type="number" class="form-control" id="amount" name="amount" required placeholder="5000" min="500">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-pavitra-pink w-100 py-2">Submit Simulated Deposit</button>
                </form>
            </div>
            
            <div class="card shadow-sm border border-light bg-light p-3 rounded" style="font-size: 0.8rem;">
                <div class="fw-bold text-dark mb-1"><i class="fa-solid fa-circle-info text-primary me-1"></i>B2B Payment Settlement</div>
                Payment is protected by escrow. Invoices are automatically compiled with HSN and seller GST rates. Credit terms of T+3 are processed dynamically.
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm border border-light p-4">
                <h5 class="fw-bold mb-4 text-dark"><i class="fa-solid fa-receipt text-pink me-2"></i>Transaction Ledger & Statement</h5>
                
                <?php if (empty($transactions)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fa-solid fa-file-invoice mb-3 fs-1 opacity-25"></i>
                        <p class="mb-0">No ledger transactions found for your account.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table align-middle" style="font-size: 0.9rem;">
                            <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem;">
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Reference Type</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th class="text-end">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transactions as $tx): ?>
                                    <tr>
                                        <td>
                                            <code class="text-pink">#TX-<?= sprintf('%05d', $tx['id']) ?></code>
                                        </td>
                                        <td>
                                            <span class="badge bg-light border text-dark"><?= htmlspecialchars($tx['reference_type']) ?></span>
                                        </td>
                                        <td class="text-nowrap text-secondary">
                                            <?= date('d M Y, h:i A', strtotime($tx['created_at'])) ?>
                                        </td>
                                        <td class="text-secondary small">
                                            <?= htmlspecialchars($tx['description']) ?>
                                        </td>
                                        <td class="text-end fw-bold">
                                            <?php if ($tx['type'] === 'CREDIT'): ?>
                                                <span class="text-success">+ ₹<?= number_format($tx['amount'], 2) ?></span>
                                            <?php else: ?>
                                                <span class="text-danger">- ₹<?= number_format($tx['amount'], 2) ?></span>
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

<script>
    $('#deposit-form').on('submit', function(e) {
        e.preventDefault();
        const amt = parseFloat($('#amount').val());
        if (isNaN(amt) || amt <= 0) return;

        const btn = $(this).find('button');
        btn.prop('disabled', true).text('Processing Deposit...');

        $.ajax({
            url: '/api/wallet/deposit',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ amount: amt }),
            success: function(res) {
                window.showToast('Simulated deposit of ₹' + amt.toLocaleString('en-IN') + ' successful!');
                window.location.reload();
            },
            error: function() {
                window.showToast('Failed to simulate deposit. In demo, check routing.');
                btn.prop('disabled', false).text('Submit Simulated Deposit');
            }
        });
    });
</script>
