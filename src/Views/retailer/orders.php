<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-box-open me-2 text-pink"></i>My Bulk Orders</h2>
            <p class="text-muted mb-0">Track delivery status, dispatch history, and tax invoices.</p>
        </div>
        <a href="/" class="btn btn-pavitra-outline btn-sm"><i class="fa fa-shopping-bag me-1"></i> Continue Shopping</a>
    </div>

    <?php if (empty($orders)): ?>
        <div class="card p-5 text-center shadow-sm border border-light">
            <i class="fa-solid fa-receipt text-muted mb-3" style="font-size: 3.5rem;"></i>
            <h4 class="fw-bold text-dark">No Orders Placed Yet</h4>
            <p class="text-muted mb-4">Explore our authentic GI-tagged saree catalog direct from Banarasi and Kanjeevaram weavers.</p>
            <div>
                <a href="/" class="btn btn-pavitra-pink px-4">Browse Catalog</a>
            </div>
        </div>
    <?php else: ?>
        <div class="d-flex flex-column gap-4">
            <?php foreach ($orders as $order): ?>
                <div class="card shadow-sm border border-light overflow-hidden">
                    <div class="card-header bg-light py-3 border-bottom px-4">
                        <div class="row align-items-center g-3">
                            <div class="col-md-3">
                                <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem;">Order ID</span>
                                <h6 class="fw-bold text-dark mb-0 mt-1"><?= htmlspecialchars($order['order_number']) ?></h6>
                            </div>
                            <div class="col-md-2">
                                <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem;">Date Woven</span>
                                <div class="text-dark small fw-medium mt-1"><?= date('d M Y, h:i A', strtotime($order['created_at'])) ?></div>
                            </div>
                            <div class="col-md-2">
                                <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem;">Total Paid</span>
                                <div class="fw-bold text-pink mt-1">₹<?= number_format($order['net_amount'], 2) ?></div>
                            </div>
                            <div class="col-md-2">
                                <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.7rem;">Payment Method</span>
                                <div class="text-dark small mt-1">
                                    <span class="badge bg-secondary-subtle text-secondary border"><?= htmlspecialchars($order['payment_method']) ?></span>
                                </div>
                            </div>
                            <div class="col-md-3 text-md-end">
                                <span class="badge <?= $order['payment_status'] === 'PAID' ? 'bg-success' : 'bg-warning' ?> px-3 py-2 fs-7">
                                    <i class="fa fa-check-circle me-1"></i><?= htmlspecialchars($order['payment_status']) ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-lg-7">
                                <h6 class="fw-bold text-uppercase text-muted mb-3" style="font-size: 0.75rem;">Wholesale Items</h6>
                                <div class="d-flex flex-column gap-3">
                                    <?php foreach ($order['items'] as $item): ?>
                                        <div class="d-flex gap-3 align-items-center">
                                            <img src="<?= htmlspecialchars($item['image_url'] ?: '/assets/images/placeholder.png') ?>" alt="" class="rounded border" style="width: 50px; height: 60px; object-fit: cover;">
                                            <div class="flex-grow-1" style="min-width: 0;">
                                                <h6 class="fw-semibold mb-0 text-truncate" style="font-size: 0.9rem;"><?= htmlspecialchars($item['title']) ?></h6>
                                                <span class="text-muted small">Quantity: <strong><?= $item['quantity'] ?> units</strong> • Rate: ₹<?= number_format($item['wholesale_price']) ?></span>
                                            </div>
                                            <div class="text-end fw-bold">
                                                ₹<?= number_format($item['wholesale_price'] * $item['quantity']) ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="col-lg-5 border-start-lg">
                                <h6 class="fw-bold text-uppercase text-muted mb-2" style="font-size: 0.75rem;">Weaver & Shipping Details</h6>
                                <div class="mb-3 small">
                                    <div class="mb-1"><strong>Weaver/Seller:</strong> <?= htmlspecialchars($order['seller_name']) ?></div>
                                    <div class="text-muted"><strong>Deliver To Address:</strong> Varanasi Handloom Cluster Hub, UP</div>
                                </div>

                                <?php if ($order['status'] === 'DELIVERED'): ?>
                                    <div class="mt-3 mb-2 d-flex gap-2">
                                        <a href="/orders/return/<?= $order['id'] ?>" class="btn btn-outline-pink btn-sm flex-grow-1 py-1 fw-bold" style="border-color: #482922; color: #482922;"><i class="fa fa-rotate-left me-1"></i> Return Items</a>
                                        <a href="/order/invoice/<?= $order['id'] ?>" target="_blank" class="btn btn-outline-secondary btn-sm flex-grow-1 py-1 fw-bold"><i class="fa fa-file-invoice me-1"></i> Invoice</a>
                                    </div>
                                <?php endif; ?>

                                <h6 class="fw-bold text-uppercase text-muted mb-3" style="font-size: 0.75rem;">Delivery Roadmap</h6>
                                <?php
                                    $statuses = ['PLACED', 'ACCEPTED', 'PACKED', 'SHIPPED', 'OUT_FOR_DELIVERY', 'DELIVERED'];
                                    $currentIndex = array_search($order['status'], $statuses);
                                    if ($currentIndex === false) $currentIndex = -1; // If cancelled/returned
                                ?>

                                <?php if (in_array($order['status'], ['CANCELLED', 'RETURNED', 'REFUNDED'])): ?>
                                    <div class="alert alert-danger py-2 mb-0" style="font-size: 0.85rem;">
                                        <i class="fa fa-info-circle me-1"></i> Order state is marked as <strong><?= htmlspecialchars($order['status']) ?></strong>.
                                    </div>
                                <?php else: ?>
                                    <div class="d-flex justify-content-between text-center mt-2 position-relative" style="font-size: 0.65rem;">
                                        <div class="progress position-absolute start-0 end-0 top-50 translate-y-middle bg-secondary-subtle" style="height: 3px; z-index: 1;">
                                            <div class="progress-bar bg-pink" role="progressbar" style="width: <?= $currentIndex * 20 ?>%; background-color: var(--pavitra-pink);"></div>
                                        </div>

                                        <?php foreach ($statuses as $index => $st): ?>
                                            <div class="position-relative" style="z-index: 2; width: 16%;">
                                                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center border" 
                                                     style="width: 20px; height: 20px; font-size: 0.6rem; background-color: <?= $index <= $currentIndex ? 'var(--pavitra-pink)' : 'white' ?>; color: <?= $index <= $currentIndex ? 'white' : '#AAA' ?>; border-color: <?= $index <= $currentIndex ? 'var(--pavitra-pink)' : '#CCC' ?>;">
                                                    <?php if ($index <= $currentIndex): ?>
                                                        ✓
                                                    <?php else: ?>
                                                        •
                                                    <?php endif; ?>
                                                </div>
                                                <div class="mt-1 fw-bold text-uppercase" style="color: <?= $index <= $currentIndex ? 'var(--pavitra-text-main)' : '#AAA' ?>; font-size: 0.55rem; letter-spacing: -0.2px;">
                                                    <?= str_replace('_', ' ', $st) ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
