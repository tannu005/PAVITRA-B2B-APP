<div class="container-xl py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-calculator text-pink me-2"></i>Commissions Configurator</h2>
            <p class="text-muted mb-0">Set category-wise or weaver-specific platform fee percentages.</p>
        </div>
        <a href="/admin" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card shadow-sm border border-light p-4 bg-white">
                <h5 class="fw-bold mb-3 text-dark">Add Commission Rule</h5>
                <form id="comm-rule-form">
                    <div class="mb-3">
                        <label for="category_id" class="form-label small fw-semibold text-muted text-uppercase">Weaving Category Scope</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="">Apply Globally (All categories)...</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="text-muted" style="font-size: 0.7rem;">Leave empty if applying to a specific weaver.</span>
                    </div>

                    <div class="mb-3">
                        <label for="seller_id" class="form-label small fw-semibold text-muted text-uppercase">Specific Weaver/Seller Scope</label>
                        <select class="form-select" id="seller_id" name="seller_id">
                            <option value="">Apply Globally (All sellers)...</option>
                            <?php foreach ($sellers as $sel): ?>
                                <option value="<?= $sel['id'] ?>"><?= htmlspecialchars($sel['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="text-muted" style="font-size: 0.7rem;">Select a merchant to overwrite default rates.</span>
                    </div>

                    <div class="mb-4">
                        <label for="rate" class="form-label small fw-semibold text-muted text-uppercase">Commission Percentage (%)</label>
                        <div class="input-group">
                            <input type="number" step="0.1" class="form-control" id="rate" name="rate" required placeholder="8.5" min="0" max="100">
                            <span class="input-group-text bg-light">%</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-pavitra-pink w-100 py-2" id="save-rule-btn">Save Commission Rule</button>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm border border-light p-4 bg-white">
                <h5 class="fw-bold mb-3 text-dark">Active B2B Commission Rules</h5>
                
                <?php if (empty($rules)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fa-solid fa-calculator fs-1 opacity-25 mb-2"></i>
                        <p class="mb-0">No custom commission rules registered. Default platform rate is 5.0%.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table align-middle" style="font-size: 0.9rem;">
                            <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem;">
                                <tr>
                                    <th>Rule ID</th>
                                    <th>Category Scope</th>
                                    <th>Weaver Scope</th>
                                    <th>Service Fee Rate</th>
                                    <th>Date Applied</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rules as $r): ?>
                                    <tr>
                                        <td><code>#RUL-<?= sprintf('%03d', $r['id']) ?></code></td>
                                        <td>
                                            <?= $r['category_name'] ? '<span class="badge bg-light border text-dark">'.htmlspecialchars($r['category_name']).'</span>' : '<span class="text-muted">Global Default</span>' ?>
                                        </td>
                                        <td>
                                            <?= $r['seller_name'] ? '<span class="badge bg-pink-light text-pink">'.htmlspecialchars($r['seller_name']).'</span>' : '<span class="text-muted">Global Default</span>' ?>
                                        </td>
                                        <td class="fw-bold text-dark"><?= number_format($r['rate'], 2) ?>%</td>
                                        <td class="text-secondary small">
                                            <?= date('d M Y', strtotime($r['created_at'])) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    $('#comm-rule-form').on('submit', function(e) {
        e.preventDefault();
        
        const cat = $('#category_id').val();
        const sel = $('#seller_id').val();
        const r = parseFloat($('#rate').val());

        if (isNaN(r) || r < 0 || r > 100) {
            window.showToast('Please select a valid commission percentage between 0 and 100.');
            return;
        }

        const btn = $('#save-rule-btn');
        btn.prop('disabled', true).text('Saving...');

        $.ajax({
            url: '/admin/commissions/rule',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ category_id: cat, seller_id: sel, rate: r }),
            success: function(res) {
                if (res.success) {
                    window.showToast('Commission rule saved successfully!');
                    window.location.reload();
                } else {
                    window.showToast(res.error || 'Failed to save commission rule');
                    btn.prop('disabled', false).text('Save Commission Rule');
                }
            },
            error: function() {
                window.showToast('Network error saving commission rule.');
                btn.prop('disabled', false).text('Save Commission Rule');
            }
        });
    });
</script>

