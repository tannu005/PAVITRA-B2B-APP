<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-address-card text-pink me-2"></i>KYC Compliance Deck</h2>
            <p class="text-muted mb-0">Verify legal trade certificates, Aadhaar identity cards, GST certificates, and bank passbooks.</p>
        </div>
        <a href="/admin" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
    </div>
    <div class="card shadow-sm border border-light p-4 bg-white">
        <?php if (empty($kycList)): ?>
            <div class="text-center py-5 text-muted">
                <i class="fa-solid fa-file-shield fs-1 opacity-25 mb-2"></i>
                <p class="mb-3">No compliance documents submitted for verification.</p>
                <button class="btn btn-pavitra-pink btn-sm" id="simulate-kyc-btn">Simulate Demo KYC Submission</button>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table align-middle" style="font-size: 0.9rem;">
                    <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem;">
                        <tr>
                            <th>Merchants Account</th>
                            <th>Document Type</th>
                            <th>Certificate ID / Number</th>
                            <th>Attached File Link</th>
                            <th>Submission Date</th>
                            <th>Audit Status</th>
                            <th class="text-end">Oversight Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kycList as $k): ?>
                            <tr>
                                <td>
                                    <h6 class="fw-semibold text-dark mb-0"><?= htmlspecialchars($k['user_name']) ?></h6>
                                    <span class="text-muted small"><?= htmlspecialchars($k['user_email']) ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-dark border"><?= htmlspecialchars($k['document_type']) ?></span>
                                </td>
                                <td>
                                    <code><?= htmlspecialchars($k['document_number']) ?></code>
                                </td>
                                <td>
                                    <a href="<?= htmlspecialchars($k['file_path']) ?>" target="_blank" class="text-pink fw-semibold text-decoration-none small">
                                        <i class="fa fa-eye me-1"></i> View Document Attachment
                                    </a>
                                </td>
                                <td class="text-secondary small">
                                    <?= date('d M Y, h:i A', strtotime($k['created_at'])) ?>
                                </td>
                                <td>
                                    <?php if ($k['status'] === 'VERIFIED'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1">Verified</span>
                                    <?php elseif ($k['status'] === 'REJECTED'): ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1">Rejected</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-1"><?= htmlspecialchars($k['status']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <?php if ($k['status'] === 'SUBMITTED' || $k['status'] === 'PENDING'): ?>
                                        <button class="btn btn-success btn-sm kyc-verify-btn" data-id="<?= $k['id'] ?>" data-status="VERIFIED">Approve</button>
                                        <button class="btn btn-outline-danger btn-sm kyc-verify-btn" data-id="<?= $k['id'] ?>" data-status="REJECTED">Reject</button>
                                    <?php else: ?>
                                        <span class="text-muted small">Checked</span>
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
<script>
    $(document).on('click', '.kyc-verify-btn', function() {
        const kycId = $(this).data('id');
        const targetStatus = $(this).data('status');
        const btn = $(this);
        btn.prop('disabled', true);
        $.ajax({
            url: '/admin/kyc/verify',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ kyc_id: kycId, status: targetStatus }),
            success: function(res) {
                if (res.success) {
                    window.showToast('KYC audit log updated to status: ' + targetStatus);
                    window.location.reload();
                } else {
                    window.showToast(res.error || 'Failed to update KYC');
                    window.location.reload();
                }
            },
            error: function() {
                window.showToast('Network error updating compliance.');
                window.location.reload();
            }
        });
    });
    $('#simulate-kyc-btn').on('click', function() {
        $(this).prop('disabled', true).text('Simulating...');
        $.ajax({
            url: '/api/kyc/simulate',
            method: 'POST',
            success: function() {
                window.showToast('Demo KYC document submission simulated!');
                window.location.reload();
            },
            error: function() {
                window.showToast('Simulate API requires API seeder trigger.');
                window.location.reload();
            }
        });
    });
</script>
