<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-triangle-exclamation text-pink me-2"></i>Trace Logs & Exceptions</h2>
            <p class="text-muted mb-0">Inspect recorded system warnings, fatal PDO syntax exceptions, and PHP fatal errors.</p>
        </div>
        <a href="/admin" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
    </div>
    <div class="card shadow-sm border border-light p-4 bg-white">
        <?php if (empty($errorsList)): ?>
            <div class="text-center py-5 text-muted">
                <i class="fa-solid fa-square-check fs-1 opacity-25 mb-2 text-success"></i>
                <p class="mb-0">Excellent! No application trace errors recorded in the system logs.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table align-middle" style="font-size: 0.85rem;">
                    <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem;">
                        <tr>
                            <th style="width: 60px;">ID</th>
                            <th>Error Details & Message</th>
                            <th>Source File & Line</th>
                            <th>Request URL</th>
                            <th>IP / User</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($errorsList as $err): ?>
                            <tr class="align-top">
                                <td><code>#<?= $err['id'] ?></code></td>
                                <td class="text-danger" style="max-width: 300px; overflow-wrap: break-word;">
                                    <strong><?= htmlspecialchars($err['message']) ?></strong>
                                </td>
                                <td class="text-secondary" style="max-width: 250px; overflow-wrap: break-word;">
                                    <code><?= htmlspecialchars(basename($err['file_name'])) ?>:L<?= $err['line_number'] ?></code>
                                </td>
                                <td>
                                    <span class="badge bg-light border text-dark"><?= htmlspecialchars($err['url']) ?></span>
                                </td>
                                <td class="text-secondary small">
                                    <strong>IP:</strong> <?= htmlspecialchars($err['ip_address']) ?><br>
                                    <strong>User ID:</strong> <?= $err['user_id'] ? '#'.$err['user_id'] : 'Guest' ?>
                                </td>
                                <td class="text-secondary text-nowrap">
                                    <?= date('d M Y, h:i A', strtotime($err['created_at'])) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
