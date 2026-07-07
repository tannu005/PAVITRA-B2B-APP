<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa fa-shirt text-pink me-2"></i>My Saree Catalog</h2>
            <p class="text-muted mb-0">Inspect approval status, retail values, and live inventory balances.</p>
        </div>
        <div>
            <a href="/seller" class="btn btn-outline-secondary btn-sm me-2"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
            <a href="/seller/products/bulk" class="btn btn-outline-pink btn-sm me-2"><i class="fa-solid fa-file-csv me-1"></i> Bulk Upload</a>
            <button class="btn btn-outline-secondary btn-sm me-2" onclick="openPrintQRModal()"><i class="fa-solid fa-qrcode me-1"></i> Print QR Labels</button>
            <a href="/seller/products/create" class="btn btn-meesho-pink btn-sm"><i class="fa fa-plus me-1"></i> Upload Saree</a>
        </div>
    </div>

    <?php if (empty($products)): ?>
        <div class="card p-5 text-center shadow-sm border border-light">
            <i class="fa-solid fa-store-slash text-muted mb-3" style="font-size: 3.5rem;"></i>
            <h4 class="fw-bold">No Products Uploaded</h4>
            <p class="text-muted mb-3">Begin marketing your weavers' handloom craft by uploading your first saree variant.</p>
            <div>
                <a href="/seller/products/create" class="btn btn-meesho-pink px-4">Upload First Item</a>
            </div>
        </div>
    <?php else: ?>
        <div class="card shadow-sm border border-light p-4">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem;">
                        <tr>
                            <th style="width: 80px;">Image</th>
                            <th>Saree Details</th>
                            <th>Category</th>
                            <th>SKU Code</th>
                            <th>Prices (Wholesale / Retail)</th>
                            <th>Stock Status</th>
                            <th>Admin Verification</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $p): ?>
                            <tr>
                                <td>
                                    <img src="<?= htmlspecialchars($p['image_url'] ?: '/assets/images/placeholder.png') ?>" alt="" class="rounded border" style="width: 50px; height: 60px; object-fit: cover;">
                                </td>
                                <td>
                                    <h6 class="fw-bold text-dark mb-1"><?= htmlspecialchars($p['title']) ?></h6>
                                    <span class="text-muted d-block text-truncate" style="max-width: 250px; font-size: 0.75rem;"><?= htmlspecialchars($p['description']) ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border"><?= htmlspecialchars($p['category_name']) ?></span>
                                </td>
                                <td>
                                    <code><?= htmlspecialchars($p['sku']) ?></code>
                                </td>
                                <td>
                                    <div class="fw-bold text-pink" style="font-size: 0.95rem;">₹<?= number_format($p['wholesale_price']) ?></div>
                                    <div class="text-muted text-decoration-line-through" style="font-size: 0.8rem;">₹<?= number_format($p['price']) ?></div>
                                </td>
                                <td>
                                    <?php if ($p['stock'] <= 5): ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle"><?= $p['stock'] ?> units (Low stock)</span>
                                    <?php else: ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle"><?= $p['stock'] ?> units</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($p['is_approved'] == 1): ?>
                                        <span class="badge bg-success px-2 py-1"><i class="fa fa-circle-check me-1"></i>Approved</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark px-2 py-1"><i class="fa fa-clock me-1"></i>Pending Review</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="modal fade" id="printQrModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header d-print-none border-0 pt-4 px-4">
                <h5 class="modal-title fw-bold" style="color: #482922;"><i class="fa-solid fa-print me-2 text-pink"></i>Printable QR Labels</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light" id="printable-qr-area">
                <div class="row g-4">
                    <?php $hasActiveProducts = false; foreach ($products as $p): ?>
                        <?php if ($p['status'] === 'ACTIVE' && $p['is_approved'] == 1): $hasActiveProducts = true; ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card h-100 border-2 text-center p-3 qr-label-card bg-white" style="border-color: #333 !important; border-style: dashed !important; border-radius: 12px;">
                                <div class="mb-2 text-truncate fw-bold text-dark" style="font-size: 0.85rem;"><?= htmlspecialchars($p['title']) ?></div>
                                <div class="text-muted small mb-2 text-truncate">SKU: <?= htmlspecialchars($p['sku']) ?></div>
                                <div class="mx-auto bg-white p-2 border rounded qr-code-container d-flex justify-content-center align-items-center" data-url="/product/<?= $p['id'] ?>" style="width: 130px; height: 130px;">
                                </div>
                                <div class="mt-3 fw-bold text-pink" style="font-size: 1.1rem;">₹<?= number_format($p['wholesale_price']) ?></div>
                                <div style="font-size: 0.7rem;" class="text-muted mt-1"><i class="fa-solid fa-camera me-1"></i>Scan to buy via Pavitra</div>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if (!$hasActiveProducts): ?>
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">You have no active, approved products to generate labels for.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="modal-footer d-print-none bg-white border-top-0 pb-4 pe-4">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-meesho-pink px-5" onclick="window.print()" <?= !$hasActiveProducts ? 'disabled' : '' ?>><i class="fa-solid fa-print me-2"></i> Print Labels</button>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #printQrModal, #printable-qr-area, #printable-qr-area * {
        visibility: visible;
    }
    #printable-qr-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        background-color: white !important;
        padding: 0 !important;
    }
    .modal-dialog {
        max-width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    .modal-content, .modal-body {
        border: none !important;
        box-shadow: none !important;
    }
    .qr-label-card {
        border-style: solid !important;
        border-color: #000 !important;
        page-break-inside: avoid;
        margin-bottom: 20px;
    }
    
    ::-webkit-scrollbar {
        display: none;
    }
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    let qrsGenerated = false;
    function openPrintQRModal() {
        var myModal = new bootstrap.Modal(document.getElementById('printQrModal'));
        myModal.show();
        
        if (!qrsGenerated) {
            $('.qr-code-container').each(function() {
                var url = $(this).data('url');
                var fullUrl = window.location.origin + url;
                new QRCode(this, {
                    text: fullUrl,
                    width: 110,
                    height: 110,
                    colorDark : "#482922",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.L
                });
            });
            qrsGenerated = true;
        }
    }
</script>
