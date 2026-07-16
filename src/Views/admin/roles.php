<div class="container-fluid py-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Role-Based Access Control (RBAC)</h3>
        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createRoleModal">
            <i class="fa fa-plus me-1"></i> Create Custom Role
        </button>
    </div>

    <div class="row g-4">
        <?php foreach ($roles as $role): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-header bg-white border-bottom pt-4 pb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold mb-0 text-dark"><?= htmlspecialchars($role['name']) ?></h5>
                            <?php if (in_array($role['name'], ['SUPER_ADMIN', 'SELLER', 'RETAILER', 'DELIVERY'])): ?>
                                <span class="badge bg-secondary">System Default</span>
                            <?php else: ?>
                                <span class="badge bg-primary">Custom Role</span>
                            <?php endif; ?>
                        </div>
                        <p class="text-muted small mb-0 mt-2"><?= htmlspecialchars($role['description'] ?? 'No description provided') ?></p>
                    </div>
                    
                    <div class="card-body bg-light">
                        <form action="/admin/roles/assign" method="POST">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
                            <input type="hidden" name="role_id" value="<?= $role['id'] ?>">
                            
                            <h6 class="fw-bold text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.1em;">Assigned Permissions</h6>
                            <div class="row g-2 mt-2">
                                <?php foreach ($permissions as $perm): ?>
                                    <?php 
                                        $isChecked = isset($mapping[$role['id']]) && in_array($perm['id'], $mapping[$role['id']]);
                                        $isLocked = $role['name'] === 'SUPER_ADMIN'; // Super admin has all, cannot be unchecked visually here
                                    ?>
                                    <div class="col-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="<?= $perm['id'] ?>" id="perm_<?= $role['id'] ?>_<?= $perm['id'] ?>" <?= $isChecked || $isLocked ? 'checked' : '' ?> <?= $isLocked ? 'disabled' : '' ?>>
                                            <label class="form-check-label small" for="perm_<?= $role['id'] ?>_<?= $perm['id'] ?>"><?= htmlspecialchars($perm['name']) ?></label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <?php if ($role['name'] !== 'SUPER_ADMIN'): ?>
                                <div class="mt-4 text-end">
                                    <button type="submit" class="btn btn-sm btn-outline-dark">Update Permissions</button>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Create Role Modal -->
<div class="modal fade" id="createRoleModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="/admin/roles/create" method="POST" class="modal-content">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold">Create Custom Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold text-uppercase">Role Identifier</label>
                    <input type="text" class="form-control" name="name" required placeholder="e.g. CATALOG_MANAGER" style="text-transform: uppercase;">
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold text-uppercase">Description</label>
                    <input type="text" class="form-control" name="description" placeholder="e.g. Can manage product approvals">
                </div>
            </div>
            <div class="modal-footer border-top-0 pt-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-dark">Create Role</button>
            </div>
        </form>
    </div>
</div>
