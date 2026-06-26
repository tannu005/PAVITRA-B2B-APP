<!-- Delivery Partner Mobile Portal -->
<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-truck text-pink me-2"></i>Logistics Handover</h2>
            <p class="text-muted mb-0">Claim shipments, track pickup warehouses, and confirm handovers with OTP verification.</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Earnings Widget -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 bg-dark text-white p-4 mb-4" style="border-radius: 12px;">
                <div class="small text-uppercase fw-semibold mb-1 opacity-75">My Payout Earnings</div>
                <h1 class="fw-bold mb-3">₹<?= number_format($balance, 2) ?></h1>
                <div class="d-flex justify-content-between align-items-center pt-3 border-top border-secondary small">
                    <span>Attendance Status: <strong class="text-success">Online</strong></span>
                    <i class="fa-solid fa-circle-check text-success"></i>
                </div>
            </div>
            
            <div class="card shadow-sm border border-light bg-light p-3 rounded" style="font-size: 0.8rem;">
                <div class="fw-bold text-dark mb-1"><i class="fa fa-info-circle me-1 text-pink"></i>Logistics Protocol</div>
                • Collect package from weaver warehouse.<br>
                • Verify the package seal before driving.<br>
                • Ask the boutique owner for their 4-digit OTP code to complete delivery.
            </div>
        </div>

        <!-- Assignments list -->
        <div class="col-lg-8">
            <div class="card shadow-sm border border-light p-4 bg-white">
                <h5 class="fw-bold mb-4 text-dark"><i class="fa-solid fa-list-check text-pink me-2"></i>My Delivery Assignments</h5>
                
                <?php if (empty($assignments)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fa-solid fa-truck-pickup fs-1 opacity-25 mb-2"></i>
                        <p class="mb-0">No active shipments assigned to your vehicle yet.</p>
                    </div>
                <?php else: ?>
                    <div class="d-flex flex-column gap-3">
                        <?php foreach ($assignments as $a): ?>
                            <div class="p-3 border rounded shadow-sm">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-8">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span class="badge bg-pink text-white fw-bold" style="background-color: var(--meesho-pink) !important;">
                                                <?= str_replace('_', ' ', $a['assignment_status']) ?>
                                            </span>
                                            <code class="text-secondary">#<?= htmlspecialchars($a['shipment_number']) ?></code>
                                        </div>
                                        <div class="small">
                                            <div class="mb-1"><strong>From (Weaver):</strong> <?= htmlspecialchars($a['seller_name']) ?></div>
                                            <div class="mb-1"><strong>To (Boutique):</strong> <?= htmlspecialchars($a['buyer_name']) ?></div>
                                            <div class="mb-1"><strong>Client Phone:</strong> <?= htmlspecialchars($a['buyer_mobile']) ?></div>
                                            <div><strong>Delivery Route Location:</strong> Varanasi Handloom Cluster Point, UP</div>
                                        </div>
                                        
                                        <!-- Demo notice to make testing OTP verification easy -->
                                        <?php if ($a['assignment_status'] === 'OUT_FOR_DELIVERY'): ?>
                                            <div class="mt-2 bg-warning-subtle text-warning border border-warning-subtle p-2 rounded small" style="font-size: 0.8rem;">
                                                🔑 <strong>Demo Access Handover OTP:</strong> <code class="text-dark fw-bold"><?= $a['otp_code'] ?></code>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="col-md-4 text-md-end">
                                        <?php if ($a['assignment_status'] === 'ASSIGNED'): ?>
                                            <button class="btn btn-meesho-pink btn-sm w-100 py-2 change-assignment-status-btn" data-id="<?= $a['assignment_id'] ?>" data-status="PICKED_UP">
                                                Collect / Picked Up
                                            </button>
                                        <?php elseif ($a['assignment_status'] === 'PICKED_UP'): ?>
                                            <button class="btn btn-warning btn-sm text-dark w-100 py-2 change-assignment-status-btn" data-id="<?= $a['assignment_id'] ?>" data-status="OUT_FOR_DELIVERY">
                                                Depart / Out For Delivery
                                            </button>
                                        <?php elseif ($a['assignment_status'] === 'OUT_FOR_DELIVERY'): ?>
                                            <div class="input-group input-group-sm mb-2">
                                                <input type="text" class="form-control" placeholder="Enter OTP" id="otp-input-<?= $a['assignment_id'] ?>">
                                                <button class="btn btn-success verify-otp-btn" data-id="<?= $a['assignment_id'] ?>">Verify & Handover</button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    // Status change AJAX
    $('.change-assignment-status-btn').on('click', function() {
        const assignId = $(this).data('id');
        const nextStatus = $(this).data('status');
        const btn = $(this);

        btn.prop('disabled', true).text('Updating...');

        $.ajax({
            url: '/delivery/status',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ assignment_id: assignId, status: nextStatus }),
            success: function(res) {
                if (res.success) {
                    alert('Delivery status updated successfully!');
                    window.location.reload();
                } else {
                    alert(res.error || 'Failed to update delivery status');
                    window.location.reload();
                }
            },
            error: function() {
                alert('Network error updating status.');
                window.location.reload();
            }
        });
    });

    // Verify OTP Handover
    $('.verify-otp-btn').on('click', function() {
        const assignId = $(this).data('id');
        const otpVal = $('#otp-input-' + assignId).val().trim();

        if (otpVal === '') {
            alert('Please enter the 4-digit handover OTP.');
            return;
        }

        const btn = $(this);
        btn.prop('disabled', true).text('Checking...');

        $.ajax({
            url: '/delivery/verify-otp',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ assignment_id: assignId, otp: otpVal }),
            success: function(res) {
                if (res.success) {
                    alert('Logistics delivery verified! Payout release and order completed.');
                    window.location.reload();
                } else {
                    alert(res.error || 'Incorrect OTP code');
                    btn.prop('disabled', false).text('Verify');
                }
            },
            error: function(xhr) {
                const err = xhr.responseJSON ? xhr.responseJSON.error : 'Handover failed';
                alert(err);
                btn.prop('disabled', false).text('Verify');
            }
        });
    });
</script>
