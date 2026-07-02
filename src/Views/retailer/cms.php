<?php
/** @var array $page */
?>
<div class="container-xl py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb" style="font-size: 0.85rem;">
                    <li class="breadcrumb-item"><a href="/" class="text-dark text-decoration-none"><i class="fa fa-home me-1"></i>Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($page['title']) ?></li>
                </ol>
            </nav>

            <!-- White Card Content -->
            <div class="card shadow-sm border border-light p-4 p-md-5 bg-white rounded-3">
                <div class="border-bottom pb-3 mb-4">
                    <h1 class="fw-extrabold text-pink mb-2" style="color: #482922; font-size: 2rem;"><?= htmlspecialchars($page['title']) ?></h1>
                    <?php if (!empty($page['meta_description'])): ?>
                        <p class="text-muted mb-0" style="font-size: 0.95rem; font-style: italic;"><?= htmlspecialchars($page['meta_description']) ?></p>
                    <?php endif; ?>
                </div>

                <div class="cms-content-body text-secondary" style="line-height: 1.8; font-size: 1rem;">
                    <?= $page['content'] ?>
                </div>
            </div>
            
            <!-- Guarantee Badge in Footer -->
            <div class="mt-4 p-4 text-center rounded border bg-light text-muted" style="font-size: 0.85rem;">
                🛡️ Verified compliance and handloom GI protection document of <strong><?= htmlspecialchars($config['company_name'] ?? 'Pavitra B2B') ?></strong>.
            </div>
        </div>
    </div>
</div>
