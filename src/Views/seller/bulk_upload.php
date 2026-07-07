<div class="container-xl py-5" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1 text-pink"><i class="fa-solid fa-file-csv me-2"></i>Bulk CSV Product Import</h2>
            <p class="text-muted mb-0">Upload spreadsheets of new sarees and catalog designs direct to the marketplace in bulk.</p>
        </div>
        <a href="/seller/products" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> My Catalog</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card shadow-sm border border-light p-4 bg-white mb-4">
                <h5 class="fw-bold mb-3 text-pink border-bottom pb-2"><i class="fa-solid fa-upload me-2"></i>Select CSV Document</h5>
                
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger py-3 px-3 mb-4 rounded-0" style="font-size: 0.85rem; border-left: 3px solid #dc3545;">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i> <strong>Upload failed:</strong>
                        <ul class="mb-0 mt-2 ps-3">
                            <?php foreach ($errors as $err): ?>
                                <li><?= htmlspecialchars($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (isset($submitted) && $successCount > 0): ?>
                    <div class="alert alert-success py-3 px-3 mb-4 rounded-0" style="font-size: 0.85rem; border-left: 3px solid #2ecc71; background-color: rgba(46, 204, 113, 0.05); color: #27ae60;">
                        <i class="fa-solid fa-circle-check me-2"></i> <strong>Import successful!</strong>
                        <span class="d-block mt-1">Successfully parsed and uploaded <strong class="text-dark"><?= $successCount ?></strong> saree products.</span>
                        <span class="d-block mt-1 small text-muted">All uploaded products are pending admin approval before listing.</span>
                    </div>
                <?php endif; ?>

                <?php if (!empty($rowErrors)): ?>
                    <div class="alert alert-warning py-3 px-3 mb-4 rounded-0" style="font-size: 0.85rem; border-left: 3px solid #f39c12; background-color: rgba(243, 156, 18, 0.03); color: #d35400;">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i> <strong>Parsing Warnings:</strong>
                        <div style="max-height: 180px; overflow-y: auto;" class="mt-2">
                            <ul class="mb-0 ps-3">
                                <?php foreach ($rowErrors as $rowErr): ?>
                                    <li><?= htmlspecialchars($rowErr) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="/seller/products/bulk" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
                    
                    <div class="mb-4 text-center p-5 border border-dashed rounded-3 bg-light cursor-pointer position-relative" id="drop-zone" style="border-width: 2px;">
                        <span class="fs-1 text-muted mb-2 d-block"><i class="fa-solid fa-cloud-arrow-up text-pink"></i></span>
                        <h6 class="fw-bold text-dark mb-1">Drag and drop your spreadsheet here</h6>
                        <p class="text-muted small mb-3">Accepts standard .csv format files up to 5MB</p>
                        <button type="button" class="btn btn-outline-pink btn-sm fw-bold">Select File</button>
                        <input type="file" name="csv_file" id="csv-file-input" required accept=".csv" class="position-absolute start-0 top-0 w-100 h-100 opacity-0" style="cursor: pointer;">
                    </div>

                    <div class="mb-3 d-none" id="file-details-container">
                        <div class="p-3 border rounded bg-light-subtle d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <span class="fs-3 text-pink"><i class="fa-solid fa-file-csv"></i></span>
                                <div>
                                    <strong id="file-name-text" class="text-dark small">file.csv</strong>
                                    <span id="file-size-text" class="text-muted d-block small" style="font-size: 0.72rem;">0 KB</span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm text-danger" id="btn-remove-file"><i class="fa fa-times"></i></button>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-meesho-pink py-2.5 px-5 fw-bold"><i class="fa fa-upload me-1"></i> Start Batch Import</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-sm border border-light p-4 bg-white mb-4">
                <h5 class="fw-bold mb-3 text-pink border-bottom pb-2"><i class="fa-solid fa-circle-info me-2"></i>CSV File Guidelines</h5>
                <ol class="mb-4 ps-3 text-muted" style="font-size: 0.8rem; line-height: 1.7;">
                    <li class="mb-2">Download or prepare your CSV table with columns exactly as shown in the template.</li>
                    <li class="mb-2"><strong>Category ID mappings:</strong><br>
                        • <code>1</code> for Banarasi Brocade<br>
                        • <code>2</code> for Kanjeevaram Silk<br>
                        • <code>3</code> for Patola Silk<br>
                        • <code>4</code> for Chanderi Cotton Silk
                    </li>
                    <li class="mb-2"><strong>Prices:</strong> Wholesale price must be lower than the retail price.</li>
                    <li class="mb-2"><strong>SKUs:</strong> Must be unique. Duplicate SKU rows will fail to import.</li>
                </ol>

                <h5 class="fw-bold mb-3 text-pink border-bottom pb-2"><i class="fa-solid fa-code me-2"></i>Template & Sample Data</h5>
                <div class="mb-3">
                    <span class="text-muted d-block small mb-2">CSV Column Header Layout:</span>
                    <pre class="bg-light border rounded p-2 text-dark" style="font-size: 0.7rem; overflow-x: auto;">Title,Description,Category_ID,SKU,Color,Size,Price,Wholesale_Price,Bulk_Threshold,Stock,Image_URL</pre>
                </div>
                <div>
                    <span class="text-muted d-block small mb-2">Sample row:</span>
                    <pre class="bg-light border rounded p-2 text-dark" style="font-size: 0.7rem; overflow-x: auto;">"Banarasi Brocade Silk Saree","Traditional handwoven Banarasi silk saree with gold zari work",1,"BANARAS-001","Royal Blue","6.5 Meters",8500,4200,5,50,"/assets/images/products/banarasi.png"</pre>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-dashed {
    border-style: dashed !important;
}
.btn-outline-pink {
    border-color: var(--meesho-pink);
    color: var(--meesho-pink);
}
.btn-outline-pink:hover {
    background-color: var(--meesho-pink);
    color: #fff;
}
</style>

<script>
$(document).ready(function() {
    $('#csv-file-input').on('change', function(e) {
        var file = e.target.files[0];
        if (file) {
            $('#file-name-text').text(file.name);
            $('#file-size-text').text((file.size / 1024).toFixed(2) + ' KB');
            $('#file-details-container').removeClass('d-none');
            $('#drop-zone').addClass('d-none');
        }
    });

    $('#btn-remove-file').on('click', function() {
        $('#csv-file-input').val('');
        $('#file-details-container').addClass('d-none');
        $('#drop-zone').removeClass('d-none');
    });
});
</script>
