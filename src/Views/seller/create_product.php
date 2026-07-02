<!-- Seller Create Product Form -->
<div class="container-xl py-5">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow-sm border border-light p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                    <div>
                        <h3 class="fw-bold mb-1 text-dark">Upload Saree Masterpiece</h3>
                        <p class="text-muted mb-0">Upload specifications, pricing thresholds, and media URLs to sync to the retailer search feeds.</p>
                    </div>
                    <a href="/seller/products" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Catalog</a>
                </div>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger py-2 px-3 mb-4" style="font-size: 0.85rem;">
                        <ul class="mb-0 ps-3">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="/seller/products/create" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
                    <!-- Core Specs -->
                    <h5 class="fw-bold mb-3 text-pink">1. Saree Information</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-8">
                            <label for="title" class="form-label small fw-semibold text-muted text-uppercase">Saree Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required placeholder="e.g. Pure Banarasi Katan Silk Floral Zari Saree" value="<?= htmlspecialchars($title_val ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="category_id" class="form-label small fw-semibold text-muted text-uppercase">Weaving Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Select Category...</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= ($category_id ?? 0) == $cat['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label small fw-semibold text-muted text-uppercase">Description / Craft Heritage</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Provide background on the fabric, yarn count, motifs, and weaver heritage..."><?= htmlspecialchars($description_val ?? '') ?></textarea>
                        </div>
                    </div>

                    <!-- Variant & Inventory Specs -->
                    <h5 class="fw-bold mb-3 text-pink">2. Attributes & Stock</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label for="sku" class="form-label small fw-semibold text-muted text-uppercase">SKU / Item Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="sku" name="sku" required placeholder="e.g. BAN-KAT-105" value="<?= htmlspecialchars($sku_val ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="color" class="form-label small fw-semibold text-muted text-uppercase">Weft Color</label>
                            <input type="text" class="form-control" id="color" name="color" placeholder="e.g. Emerald Gold" value="<?= htmlspecialchars($color_val ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="size" class="form-label small fw-semibold text-muted text-uppercase">Size / Length</label>
                            <input type="text" class="form-control" id="size" name="size" placeholder="e.g. 6.3 Mtr (With Blouse)" value="<?= htmlspecialchars($size_val ?? '6.3 Meters') ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="stock" class="form-label small fw-semibold text-muted text-uppercase">Initial Stock <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="stock" name="stock" required placeholder="10" min="0" value="<?= isset($stock_val) ? intval($stock_val) : '15' ?>">
                        </div>
                    </div>

                    <!-- Pricing & Tiers -->
                    <h5 class="fw-bold mb-3 text-pink">3. Pricing Tiers (B2B Wholesale)</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="price" class="form-label small fw-semibold text-muted text-uppercase">Single Purchase Price (₹) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="price" name="price" required placeholder="18000" min="1" value="<?= htmlspecialchars($price_val ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="wholesale_price" class="form-label small fw-semibold text-muted text-uppercase">Wholesale Discounted Price (₹) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="wholesale_price" name="wholesale_price" required placeholder="14500" min="1" value="<?= htmlspecialchars($wholesale_price_val ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="bulk_threshold" class="form-label small fw-semibold text-muted text-uppercase">MOQ Threshold (Qty) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="bulk_threshold" name="bulk_threshold" required placeholder="5" min="1" value="<?= isset($bulk_threshold_val) ? intval($bulk_threshold_val) : '5' ?>">
                        </div>
                    </div>

                    <!-- Image Attachment -->
                    <h5 class="fw-bold mb-3 text-pink">4. Media URL</h5>
                    <div class="mb-4">
                        <label for="image_url" class="form-label small fw-semibold text-muted text-uppercase">Product Image URL</label>
                        <input type="text" class="form-control" id="image_url" name="image_url" placeholder="/banarasi.png" value="<?= htmlspecialchars($image_url_val ?? '/banarasi.png') ?>">
                        <span class="text-muted" style="font-size: 0.75rem;">In production, this connects to your cloud CDN or file storage bucket.</span>
                    </div>

                    <button type="submit" class="btn btn-meesho-pink w-100 py-3 fs-6 fw-bold">Upload to Catalog & Request Verification</button>
                </form>
            </div>
        </div>
    </div>
</div>
