<div class="container-xl py-5" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1 text-pink"><i class="fa-solid fa-file-signature me-2"></i>Legal & CMS Page Manager</h2>
            <p class="text-muted mb-0">Modify company profiles, compliance, terms, privacy, returns, and shipping policies with block content builders.</p>
        </div>
        <a href="/admin" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Dashboard</a>
    </div>
    <?php if (isset($_SESSION['settings_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show py-2 px-3 mb-4" role="alert" style="font-size: 0.9rem;">
            <i class="fa fa-circle-check me-2"></i><?= htmlspecialchars($_SESSION['settings_success']); unset($_SESSION['settings_success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 0.75rem 1rem;"></button>
        </div>
    <?php endif; ?>
    <div class="card shadow-sm border border-light p-4">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light text-uppercase text-muted" style="font-size: 0.75rem;">
                    <tr>
                        <th>Page Title</th>
                        <th>Web URL Slug</th>
                        <th>Meta Title Prefix</th>
                        <th>Meta Description</th>
                        <th>Visibility</th>
                        <th style="width: 120px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pages)): ?>
                        <?php foreach ($pages as $p): ?>
                            <tr>
                                <td>
                                    <h6 class="fw-bold text-dark mb-1"><?= htmlspecialchars($p['title']) ?></h6>
                                </td>
                                <td>
                                    <code class="text-pink">/<?= htmlspecialchars($p['slug']) ?></code>
                                </td>
                                <td>
                                    <span class="text-muted small"><?= htmlspecialchars($p['meta_title']) ?></span>
                                </td>
                                <td>
                                    <span class="text-muted d-block text-truncate small" style="max-width: 250px;"><?= htmlspecialchars($p['meta_description']) ?></span>
                                </td>
                                <td>
                                    <?php if ($p['active'] == 1): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle">Active / Published</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary border">Hidden / Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <a href="/admin/cms/edit/<?= $p['id'] ?>" class="btn btn-sm btn-pink py-1 px-3 fw-bold"><i class="fa-solid fa-pen-to-square me-1"></i> Edit Blocks</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No CMS pages found in the system database.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
