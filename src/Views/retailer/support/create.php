<div class="container-xl py-5">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border border-light p-4 p-md-5 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                    <div>
                        <h3 class="fw-bold mb-1 text-dark"><i class="fa-solid fa-headset text-pink me-2"></i>Open Support Ticket</h3>
                        <p class="text-muted mb-0">Describe your inquiry or order problem, and our team will get back to you shortly.</p>
                    </div>
                    <a href="/support" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Helpdesk</a>
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

                <form action="/support/create" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
                    <div class="row g-3 mb-4">
                        <div class="col-md-8">
                            <label for="subject" class="form-label small fw-semibold text-muted text-uppercase">Ticket Subject <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="subject" name="subject" required placeholder="e.g. Wallet refill amount not credited" value="<?= htmlspecialchars($subject ?? '') ?>">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="priority" class="form-label small fw-semibold text-muted text-uppercase">Priority Level</label>
                            <select class="form-select" id="priority" name="priority">
                                <option value="LOW" <?= ($priority ?? '') === 'LOW' ? 'selected' : '' ?>>Low</option>
                                <option value="MEDIUM" <?= ($priority ?? '') === 'MEDIUM' ? 'selected' : '' ?>>Medium</option>
                                <option value="HIGH" <?= ($priority ?? '') === 'HIGH' ? 'selected' : '' ?>>High</option>
                                <option value="CRITICAL" <?= ($priority ?? '') === 'CRITICAL' ? 'selected' : '' ?>>Critical</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="message" class="form-label small fw-semibold text-muted text-uppercase">Detailed Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="5" required placeholder="Describe what happened, including any order IDs or payment IDs..."><?= htmlspecialchars($message ?? '') ?></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-meesho-pink w-100 py-3 fw-bold fs-6">Submit Ticket to Operations Queue</button>
                </form>
            </div>
        </div>
    </div>
</div>
