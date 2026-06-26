<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-rotate-left text-pink me-2"></i>Returns & Refund Requests</h2>
            <p class="text-muted mb-0">Manage customer returns, inspect returned items, and verify them to process wallet payouts reversal.</p>
        </div>
        <a href="/seller" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
    </div>

    <?php if (isset($_SESSION['return_verify_error'])): ?>
        <div class="alert alert-danger py-2 px-3 mb-4" style="font-size: 0.9rem;">
            <i class="fa-solid fa-triangle-exclamation me-2"></i><?= htmlspecialchars($_SESSION['return_verify_error']); unset($_SESSION['return_verify_error']); ?>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border border-light p-4 bg-white">
        <?php if (empty($returns)): ?>
            <div class="text-center py-5 text-muted">
                <i class="fa-solid fa-face-smile fs-1 opacity-25 mb-2 text-success"></i>
                <p class="mb-0">Excellent! No returns requested for your products.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table align-middle" style="font-size: 0.9rem;">
                    <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem;">
                        <tr>
                            <th>Return Number</th>
                            <th>Order ID</th>
                            <th>Buyer Boutique</th>
                            <th>Returned Saree Items</th>
                            <th>Reason</th>
                            <th>Status State</th>
                            <th class="text-end">Oversight Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($returns as $r): ?>
                            <tr class="align-top">
                                <td><code class="text-pink">#<?= htmlspecialchars($r['return_number']) ?></code></td>
                                <td><code>#<?= htmlspecialchars($r['order_number']) ?></code></td>
                                <td><h6 class="fw-semibold text-dark mb-0"><?= htmlspecialchars($r['buyer_name']) ?></h6></td>
                                <td>
                                    <div class="d-flex flex-column gap-2" style="font-size: 0.85rem;">
                                        <?php foreach ($r['items'] as $item): ?>
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="<?= htmlspecialchars($item['image_url'] ?: '/assets/images/placeholder.png') ?>" alt="" class="rounded border" style="width: 30px; height: 35px; object-fit: cover;">
                                                <span><?= htmlspecialchars($item['title']) ?> (<strong><?= $item['quantity'] ?> units</strong>)</span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </td>
                                <td style="max-width: 200px; font-size: 0.85rem;" class="text-muted">
                                    <?= htmlspecialchars($r['reason']) ?>
                                </td>
                                <td>
                                    <?php if ($r['status'] === 'REQUESTED'): ?>
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1">Requested</span>
                                    <?php elseif ($r['status'] === 'APPROVED'): ?>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">Approved</span>
                                    <?php elseif ($r['status'] === 'COMPLETED'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Completed</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1"><?= htmlspecialchars($r['status']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <?php if ($r['status'] === 'REQUESTED'): ?>
                                        <div class="d-flex flex-column gap-1 align-items-end">
                                            <form action="/seller/returns/<?= $r['id'] ?>/approve" method="POST">
                                                <button type="submit" class="btn btn-primary btn-sm w-100">Approve Request</button>
                                            </form>
                                            <form action="/seller/returns/<?= $r['id'] ?>/verify" method="POST">
                                                <button type="submit" class="btn btn-success btn-sm w-100">Approve & Refund Reversal</button>
                                            </form>
                                        </div>
                                    <?php elseif ($r['status'] === 'APPROVED'): ?>
                                        <form action="/seller/returns/<?= $r['id'] ?>/verify" method="POST">
                                            <button type="submit" class="btn btn-success btn-sm"><i class="fa-solid fa-circle-check me-1"></i> Verify & Process Refund</button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-muted small">Refunded Success</span>
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
