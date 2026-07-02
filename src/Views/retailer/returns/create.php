<div class="container-xl py-5">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border border-light p-4 p-md-5 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                    <div>
                        <h3 class="fw-bold mb-1 text-dark"><i class="fa-solid fa-rotate-left text-pink me-2"></i>Request Wholesale Return</h3>
                        <p class="text-muted mb-0">Select the items and quantities from Order <strong>#<?= htmlspecialchars($order['order_number']) ?></strong> you wish to return.</p>
                    </div>
                    <a href="/orders" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Orders</a>
                </div>

                <?php if (isset($_SESSION['return_error'])): ?>
                    <div class="alert alert-danger py-2 px-3 mb-4" style="font-size: 0.9rem;">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i><?= htmlspecialchars($_SESSION['return_error']); unset($_SESSION['return_error']); ?>
                    </div>
                <?php endif; ?>

                <form action="/orders/return/<?= $order['id'] ?>" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
                    <h5 class="fw-bold mb-3 text-pink border-bottom pb-2">Select Items to Return</h5>
                    
                    <div class="table-responsive mb-4">
                        <table class="table align-middle" style="font-size: 0.9rem;">
                            <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem;">
                                <tr>
                                    <th style="width: 80px;">Saree Image</th>
                                    <th>Item specifications</th>
                                    <th>Ordered Qty</th>
                                    <th>Unit Cost</th>
                                    <th style="width: 150px;">Return Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item): ?>
                                    <tr>
                                        <td>
                                            <img src="<?= htmlspecialchars($item['image_url'] ?: '/assets/images/placeholder.png') ?>" alt="" class="rounded border" style="width: 50px; height: 60px; object-fit: cover;">
                                        </td>
                                        <td>
                                            <h6 class="fw-semibold text-dark mb-0"><?= htmlspecialchars($item['title']) ?></h6>
                                        </td>
                                        <td class="fw-bold"><?= $item['quantity'] ?> units</td>
                                        <td class="fw-bold text-pink">
                                            ₹<?= number_format($item['wholesale_price'] ?: $item['price']) ?>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" name="quantities[<?= $item['id'] ?>]" min="0" max="<?= $item['quantity'] ?>" value="0" placeholder="0">
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-4">
                        <label for="reason" class="form-label small fw-semibold text-muted text-uppercase">Return & Refund Reason <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required placeholder="State why these items are being returned (e.g. damaged brocades, shade mismatched, weave discrepancies)..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-meesho-pink w-100 py-3 fw-bold fs-6">Submit Return Request for Review</button>
                </form>
            </div>
        </div>
    </div>
</div>
