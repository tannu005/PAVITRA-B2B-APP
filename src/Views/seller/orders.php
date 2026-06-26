<!-- Seller Orders List -->
<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa fa-box-open text-pink me-2"></i>Dispatch Shipments</h2>
            <p class="text-muted mb-0">Track boutique order lifecycles and advance dispatch statuses.</p>
        </div>
        <a href="/seller" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
    </div>

    <?php if (empty($orders)): ?>
        <div class="card p-5 text-center shadow-sm border border-light bg-white">
            <i class="fa-solid fa-truck-ramp-box text-muted mb-3" style="font-size: 3.5rem;"></i>
            <h4 class="fw-bold">No Orders to Process</h4>
            <p class="text-muted mb-0">When boutique retailers buy your sarees in bulk, they will appear here for packaging.</p>
        </div>
    <?php else: ?>
        <div class="d-flex flex-column gap-4">
            <?php foreach ($orders as $order): ?>
                <div class="card shadow-sm border border-light overflow-hidden bg-white">
                    <!-- Order Header -->
                    <div class="card-header bg-light py-3 border-bottom px-4">
                        <div class="row align-items-center">
                            <div class="col-sm-4">
                                <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem;">Order Code</span>
                                <h6 class="fw-bold text-dark mb-0 mt-1"><?= htmlspecialchars($order['order_number']) ?></h6>
                            </div>
                            <div class="col-sm-3">
                                <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem;">Retailer boutique</span>
                                <div class="text-dark small fw-medium mt-1"><?= htmlspecialchars($order['buyer_name']) ?></div>
                            </div>
                            <div class="col-sm-2">
                                <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem;">Items Amount</span>
                                <div class="fw-bold text-pink mt-1">₹<?= number_format($order['net_amount'], 2) ?></div>
                            </div>
                            <div class="col-sm-3 text-sm-end">
                                <span class="badge bg-pink text-white px-3 py-2 fs-7" style="background-color: var(--meesho-pink) !important;">
                                    <?= htmlspecialchars($order['status']) ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Order Body -->
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <!-- Items -->
                            <div class="col-md-7">
                                <h6 class="fw-bold text-uppercase text-muted mb-3" style="font-size: 0.75rem;">Items Woven</h6>
                                <div class="d-flex flex-column gap-3">
                                    <?php foreach ($order['items'] as $item): ?>
                                        <div class="d-flex gap-3 align-items-center">
                                            <img src="<?= htmlspecialchars($item['image_url'] ?: '/assets/images/placeholder.png') ?>" alt="" class="rounded border" style="width: 50px; height: 60px; object-fit: cover;">
                                            <div class="flex-grow-1" style="min-width: 0;">
                                                <h6 class="fw-semibold mb-0 text-truncate" style="font-size: 0.9rem;"><?= htmlspecialchars($item['title']) ?></h6>
                                                <span class="text-muted small">Quantity: <strong><?= $item['quantity'] ?> units</strong> • B2B Rate: ₹<?= number_format($item['wholesale_price']) ?></span>
                                            </div>
                                            <div class="text-end fw-bold">
                                                ₹<?= number_format($item['wholesale_price'] * $item['quantity']) ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Actions & Dispatch Progress -->
                            <div class="col-md-5 border-start-md">
                                <h6 class="fw-bold text-uppercase text-muted mb-3" style="font-size: 0.75rem;">Packaging & Dispatch Actions</h6>
                                
                                <div class="d-flex flex-column gap-2 mb-3">
                                    <?php if ($order['status'] === 'PLACED'): ?>
                                        <button class="btn btn-meesho-pink w-100 py-2 change-status-btn" data-id="<?= $order['id'] ?>" data-status="ACCEPTED">
                                            <i class="fa fa-circle-check me-2"></i> Accept Wholesale Order
                                        </button>
                                        <button class="btn btn-outline-danger w-100 py-2 change-status-btn" data-id="<?= $order['id'] ?>" data-status="CANCELLED">
                                            Cancel Order
                                        </button>
                                    <?php elseif ($order['status'] === 'ACCEPTED'): ?>
                                        <button class="btn btn-meesho-pink w-100 py-2 change-status-btn" data-id="<?= $order['id'] ?>" data-status="PACKED">
                                            <i class="fa-solid fa-box me-2"></i> Mark as Packed / Sealed
                                        </button>
                                        <button class="btn btn-outline-danger w-100 py-2 change-status-btn" data-id="<?= $order['id'] ?>" data-status="CANCELLED">
                                            Cancel Order
                                        </button>
                                    <?php elseif ($order['status'] === 'PACKED'): ?>
                                        <button class="btn btn-meesho-pink w-100 py-2 change-status-btn" data-id="<?= $order['id'] ?>" data-status="SHIPPED">
                                            <i class="fa-solid fa-truck me-2"></i> Dispatch & Ship Package
                                        </button>
                                    <?php elseif ($order['status'] === 'SHIPPED'): ?>
                                        <div class="alert alert-info py-2 mb-0" style="font-size: 0.85rem;">
                                            <i class="fa fa-info-circle me-1"></i> Dispatched. A delivery driver has been assigned. OTP check active.
                                        </div>
                                    <?php elseif ($order['status'] === 'OUT_FOR_DELIVERY'): ?>
                                        <div class="alert alert-warning py-2 mb-0 text-dark" style="font-size: 0.85rem;">
                                            <i class="fa fa-clock me-1"></i> Package is out for delivery. Courier driver is heading to retail shop point.
                                        </div>
                                    <?php elseif ($order['status'] === 'DELIVERED'): ?>
                                        <div class="alert alert-success py-2 mb-0" style="font-size: 0.85rem;">
                                            <i class="fa fa-circle-check me-1"></i> Handed over. Payment released to Weaver Ledger balance.
                                        </div>
                                    <?php elseif ($order['status'] === 'CANCELLED'): ?>
                                        <div class="alert alert-danger py-2 mb-0" style="font-size: 0.85rem;">
                                            <i class="fa-solid fa-circle-xmark me-1"></i> Cancelled & Refunded to buyer wallet.
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="bg-light p-3 rounded" style="font-size: 0.75rem; color: #666;">
                                    <strong>GST Details:</strong> Includes 5% HSN fabric tax rate. Automatic e-invoices are created on Shipped status.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- AJAX Status Update Script -->
<script>
    $('.change-status-btn').on('click', function() {
        const orderId = $(this).data('id');
        const newStatus = $(this).data('status');
        
        if (newStatus === 'CANCELLED' && !confirm('Are you sure you want to cancel this order and refund the retailer?')) {
            return;
        }

        const btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');

        $.ajax({
            url: '/seller/orders/status',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ order_id: orderId, status: newStatus }),
            success: function(res) {
                if (res.success) {
                    alert('Order updated to status: ' + newStatus);
                    window.location.reload();
                } else {
                    alert(res.error || 'Failed to update order status');
                    window.location.reload();
                }
            },
            error: function(xhr) {
                const err = xhr.responseJSON ? xhr.responseJSON.error : 'Network error';
                alert(err);
                window.location.reload();
            }
        });
    });
</script>
