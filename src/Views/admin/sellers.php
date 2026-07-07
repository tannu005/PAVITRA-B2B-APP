<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa fa-users text-pink me-2"></i>Merchants Queue</h2>
            <p class="text-muted mb-0">Inspect user accounts, merchant registration statuses, and block/activate accounts.</p>
        </div>
        <a href="/admin" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
    </div>

    <div class="card shadow-sm border border-light p-4 bg-white">
        <div class="table-responsive">
            <table class="table align-middle" style="font-size: 0.9rem;">
                <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem;">
                    <tr>
                        <th>User ID</th>
                        <th>Merchant Name</th>
                        <th>Registered Contacts</th>
                        <th>Profile Type</th>
                        <th>Trade Name / Shop</th>
                        <th>Account Status</th>
                        <th class="text-end">Oversight Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usersList as $u): ?>
                        <tr>
                            <td><code>#USR-<?= sprintf('%04d', $u['id']) ?></code></td>
                            <td><h6 class="fw-semibold text-dark mb-0"><?= htmlspecialchars($u['name']) ?></h6></td>
                            <td>
                                <div class="text-secondary small"><?= htmlspecialchars($u['email']) ?></div>
                                <div class="text-secondary small"><?= htmlspecialchars($u['mobile']) ?></div>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-dark border"><?= htmlspecialchars($u['role']) ?></span>
                            </td>
                            <td class="small text-secondary fw-semibold">
                                <?= htmlspecialchars($u['trade_name'] ?: 'N/A') ?>
                            </td>
                            <td>
                                <?php if ($u['status'] === 'ACTIVE'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1"><?= htmlspecialchars($u['status']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <?php if ($u['status'] === 'ACTIVE'): ?>
                                    <button class="btn btn-danger btn-sm change-user-btn" data-id="<?= $u['id'] ?>" data-status="BLOCKED">
                                        Block Merchant
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-success btn-sm change-user-btn" data-id="<?= $u['id'] ?>" data-status="ACTIVE">
                                        Activate Merchant
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
    $('.change-user-btn').on('click', function() {
        const userId = $(this).data('id');
        const targetStatus = $(this).data('status');
        const btn = $(this);
        
        btn.prop('disabled', true).text('Updating...');

        $.ajax({
            url: '/admin/sellers/approve',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ user_id: userId, status: targetStatus }),
            success: function(res) {
                if (res.success) {
                    alert('Merchant status updated successfully!');
                    window.location.reload();
                } else {
                    alert(res.error || 'Failed to update user');
                    window.location.reload();
                }
            },
            error: function() {
                alert('Network error updating status.');
                window.location.reload();
            }
        });
    });
</script>
