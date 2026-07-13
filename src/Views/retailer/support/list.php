<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-headset text-pink me-2"></i>Help & Support Desk</h2>
            <p class="text-muted mb-0">Open tickets, file complaints, and check responses from our operations team.</p>
        </div>
        <div>
            <a href="/" class="btn btn-outline-secondary btn-sm me-2"><i class="fa fa-arrow-left"></i> Go to Shop</a>
            <a href="/support/create" class="btn btn-pavitra-pink btn-sm"><i class="fa fa-plus me-1"></i> Open New Ticket</a>
        </div>
    </div>

    <div class="card shadow-sm border border-light p-4 bg-white">
        <?php if (empty($tickets)): ?>
            <div class="text-center py-5 text-muted">
                <i class="fa-solid fa-comments fs-1 opacity-25 mb-3"></i>
                <h5 class="fw-bold text-dark">No Support Tickets Found</h5>
                <p class="text-muted mb-3">Everything looks smooth! If you need help with shipping delays, wallets, or KYC approvals, open a ticket.</p>
                <a href="/support/create" class="btn btn-pavitra-pink btn-sm">Get Help Now</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table align-middle" style="font-size: 0.9rem;">
                    <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem;">
                        <tr>
                            <th>Ticket ID</th>
                            <th>Subject</th>
                            <th>Priority</th>
                            <th>Current Status</th>
                            <th>Date Opened</th>
                            <th class="text-end">Oversight Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tickets as $t): ?>
                            <tr>
                                <td><code class="text-pink">#<?= htmlspecialchars($t['ticket_number']) ?></code></td>
                                <td><strong><?= htmlspecialchars($t['subject']) ?></strong></td>
                                <td>
                                    <?php
                                        $pClass = 'bg-secondary';
                                        if ($t['priority'] === 'CRITICAL') $pClass = 'bg-danger';
                                        elseif ($t['priority'] === 'HIGH') $pClass = 'bg-warning text-dark';
                                        elseif ($t['priority'] === 'MEDIUM') $pClass = 'bg-info text-dark';
                                    ?>
                                    <span class="badge <?= $pClass ?> border"><?= htmlspecialchars($t['priority']) ?></span>
                                </td>
                                <td>
                                    <?php if ($t['status'] === 'OPEN'): ?>
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-1">Open</span>
                                    <?php elseif ($t['status'] === 'IN_PROGRESS'): ?>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1">In Progress</span>
                                    <?php elseif ($t['status'] === 'RESOLVED'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1">Resolved</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-1">Closed</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-secondary small">
                                    <?= date('d M Y, h:i A', strtotime($t['created_at'])) ?>
                                </td>
                                <td class="text-end">
                                    <a href="/support/ticket/<?= $t['id'] ?>" class="btn btn-outline-pink btn-sm">
                                        <i class="fa fa-envelope-open me-1"></i> Open Workspace
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

