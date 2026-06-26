<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-headset text-pink me-2"></i>Operations Helpdesk Queue</h2>
            <p class="text-muted mb-0">Inspect boutique retailer tickets, manage response priorities, and solve customer complaints.</p>
        </div>
        <a href="/admin" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
    </div>

    <div class="card shadow-sm border border-light p-4 bg-white">
        <?php if (empty($tickets)): ?>
            <div class="text-center py-5 text-muted">
                <i class="fa-solid fa-headset fs-1 opacity-25 mb-2"></i>
                <p class="mb-0">Excellent! No support tickets in the helpdesk queue.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table align-middle" style="font-size: 0.9rem;">
                    <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem;">
                        <tr>
                            <th>Ticket ID</th>
                            <th>Retailer Account</th>
                            <th>Subject</th>
                            <th>Priority</th>
                            <th>Status State</th>
                            <th>Opened Date</th>
                            <th class="text-end">Oversight Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tickets as $t): ?>
                            <tr>
                                <td><code>#<?= htmlspecialchars($t['ticket_number']) ?></code></td>
                                <td>
                                    <h6 class="fw-semibold text-dark mb-0"><?= htmlspecialchars($t['buyer_name']) ?></h6>
                                    <span class="text-muted small"><?= htmlspecialchars($t['buyer_email']) ?></span>
                                </td>
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
                                    <a href="/admin/support/ticket/<?= $t['id'] ?>" class="btn btn-meesho-pink btn-sm">
                                        <i class="fa fa-screwdriver-wrench me-1"></i> Resolve Ticket
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
