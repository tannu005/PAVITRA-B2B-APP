<?php
?>
<div class="container-xl py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb" style="font-size: 0.85rem;">
                    <li class="breadcrumb-item"><a href="/" class="text-dark text-decoration-none"><i class="fa fa-home me-1"></i>Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($page['title']) ?></li>
                </ol>
            </nav>
            <div class="card shadow-sm border border-light p-4 p-md-5 bg-white rounded-3">
                <div class="border-bottom pb-3 mb-4">
                    <h1 class="fw-extrabold text-pink mb-2" style="color: #482922; font-size: 2rem;"><?= htmlspecialchars($page['title']) ?></h1>
                    <?php if (!empty($page['meta_description'])): ?>
                        <p class="text-muted mb-0" style="font-size: 0.95rem; font-style: italic;"><?= htmlspecialchars($page['meta_description']) ?></p>
                    <?php endif; ?>
                </div>
                <div class="cms-content-body text-secondary" style="line-height: 1.8; font-size: 1rem;">
                    <?php
                    $content = $page['content'];
                    $blocks = json_decode($content, true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($blocks)):
                        foreach ($blocks as $block):
                            if ($block['type'] === 'text'): ?>
                                <div class="mb-4 text-block"><?= $block['content'] ?></div>
                            <?php elseif ($block['type'] === 'heading'): 
                                $tag = in_array($block['level'] ?? 'h2', ['h1', 'h2', 'h3', 'h4', 'h5', 'h6']) ? $block['level'] : 'h2'; ?>
                                <<?= $tag ?> class="fw-bold mb-3 mt-4 text-dark"><?= htmlspecialchars($block['text']) ?></<?= $tag ?>>
                            <?php elseif ($block['type'] === 'accordion'): 
                                $accId = 'accordion-' . substr(md5(serialize($block)), 0, 8); ?>
                                <div class="accordion mb-4" id="<?= $accId ?>">
                                    <?php foreach ($block['items'] as $index => $item): 
                                        $itemId = $accId . '-item-' . $index; ?>
                                        <div class="accordion-item border border-light shadow-sm mb-2 rounded-2 overflow-hidden">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $itemId ?>">
                                                    <?= htmlspecialchars($item['title']) ?>
                                                </button>
                                            </h2>
                                            <div id="<?= $itemId ?>" class="accordion-collapse collapse" data-bs-parent="#<?= $accId ?>">
                                                <div class="accordion-body bg-light text-secondary" style="font-size: 0.95rem; line-height: 1.7;">
                                                    <?= $item['content'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif;
                        endforeach;
                    else:
                        echo $content;
                    endif;
                    ?>
                </div>
            </div>
            <div class="mt-4 p-4 text-center rounded border bg-light text-muted" style="font-size: 0.85rem;">
                🛡️ Verified compliance and handloom GI protection document of <strong><?= htmlspecialchars($config['company_name'] ?? 'Pavitra Designer') ?></strong>.
            </div>
        </div>
    </div>
</div>
