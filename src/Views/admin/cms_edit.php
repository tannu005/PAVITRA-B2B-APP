<?php
$content = $page['content'];
$blocks = json_decode($content, true);
if (json_last_error() !== JSON_ERROR_NONE || !is_array($blocks)) {
    $blocks = [
        [
            'type' => 'text',
            'content' => $content
        ]
    ];
}
?>
<div class="container-xl py-5" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h2 class="fw-bold mb-1 text-pink"><i class="fa-solid fa-square-pen me-2"></i>Block Page Content Builder</h2>
            <p class="text-muted mb-0">Customize headings, accordions, and paragraphs for <strong><?= htmlspecialchars($page['title']) ?></strong>.</p>
        </div>
        <a href="/admin/cms" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Pages List</a>
    </div>

    <form id="cms-builder-form">
        <input type="hidden" name="id" value="<?= $page['id'] ?>">
        
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border border-light p-4 bg-white mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                        <h5 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-cubes text-pink me-2"></i>Content Blocks</h5>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-pink dropdown-toggle fw-bold" type="button" data-bs-toggle="dropdown">
                                <i class="fa fa-plus me-1"></i> Add Block
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-add-block" href="#" data-type="heading"><i class="fa-solid fa-heading me-2"></i> Heading Block</a></li>
                                <li><a class="dropdown-item btn-add-block" href="#" data-type="text"><i class="fa-solid fa-align-left me-2"></i> Rich Text Paragraph</a></li>
                                <li><a class="dropdown-item btn-add-block" href="#" data-type="accordion"><i class="fa-solid fa-list-check me-2"></i> Accordion Dropdowns</a></li>
                            </ul>
                        </div>
                    </div>

                    <div id="blocks-container" class="d-flex flex-column gap-3">
                    </div>

                    <div class="text-center py-4 bg-light rounded border border-dashed mt-3 d-none" id="empty-blocks-alert">
                        <i class="fa-solid fa-folder-open text-muted mb-2" style="font-size: 2rem;"></i>
                        <h6 class="fw-bold mb-1">No content blocks added yet</h6>
                        <p class="text-muted small mb-0">Click the "Add Block" button above to add headers, paragraphs, or accordions.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border border-light p-4 bg-white mb-4">
                    <h5 class="fw-bold mb-3 text-pink border-bottom pb-2"><i class="fa-solid fa-gear me-2"></i>Page Configuration</h5>
                    
                    <div class="mb-3">
                        <label for="title" class="form-label small fw-semibold text-muted text-uppercase">Page Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($page['title']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label small fw-semibold text-muted text-uppercase">Web URL Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="<?= htmlspecialchars($page['slug']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="active" class="form-label small fw-semibold text-muted text-uppercase">Publish Status</label>
                        <select class="form-select" id="active" name="active">
                            <option value="1" <?= $page['active'] == 1 ? 'selected' : '' ?>>Active / Published</option>
                            <option value="0" <?= $page['active'] == 0 ? 'selected' : '' ?>>Draft / Hidden</option>
                        </select>
                    </div>
                </div>

                <div class="card shadow-sm border border-light p-4 bg-white mb-4">
                    <h5 class="fw-bold mb-3 text-pink border-bottom pb-2"><i class="fa-solid fa-magnifying-glass me-2"></i>SEO Metadata</h5>
                    
                    <div class="mb-3">
                        <label for="meta_title" class="form-label small fw-semibold text-muted text-uppercase">Meta Title Prefix</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= htmlspecialchars($page['meta_title'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="meta_description" class="form-label small fw-semibold text-muted text-uppercase">Meta Description</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3"><?= htmlspecialchars($page['meta_description'] ?? '') ?></textarea>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-meesho-pink py-3 fw-bold text-uppercase"><i class="fa fa-save me-1"></i> Save CMS Changes</button>
                    <a href="/admin/cms" class="btn btn-outline-secondary py-2 fw-semibold">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
.border-dashed {
    border-style: dashed !important;
}
.cms-block-card {
    transition: all 0.2s ease;
    border-left: 4px solid var(--meesho-pink) !important;
}
.cms-block-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
.drag-handle {
    cursor: move;
}
</style>

<script>
var blocks = <?= json_encode($blocks) ?>;

$(document).ready(function() {
    function renderBlocks() {
        var container = $('#blocks-container');
        container.empty();
        
        if (blocks.length === 0) {
            $('#empty-blocks-alert').removeClass('d-none');
            return;
        } else {
            $('#empty-blocks-alert').addClass('d-none');
        }

        blocks.forEach(function(block, index) {
            var blockHtml = '';

            if (block.type === 'heading') {
                blockHtml = `
                <div class="card cms-block-card border p-3 bg-white" data-index="${index}">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted"><i class="fa-solid fa-grip-vertical"></i></span>
                            <span class="badge bg-primary text-uppercase">Heading Block</span>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete-block" data-index="${index}"><i class="fa fa-trash"></i></button>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-9">
                            <label class="form-label small fw-semibold text-muted">Heading Text</label>
                            <input type="text" class="form-control block-val-text" value="${block.text || ''}" placeholder="Enter heading...">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold text-muted">Level</label>
                            <select class="form-select block-val-level">
                                <option value="h1" ${block.level === 'h1' ? 'selected' : ''}>H1 (Main)</option>
                                <option value="h2" ${block.level === 'h2' ? 'selected' : ''}>H2 (Section)</option>
                                <option value="h3" ${block.level === 'h3' ? 'selected' : ''}>H3 (Sub-section)</option>
                                <option value="h4" ${block.level === 'h4' ? 'selected' : ''}>H4</option>
                            </select>
                        </div>
                    </div>
                </div>`;
            } else if (block.type === 'text') {
                blockHtml = `
                <div class="card cms-block-card border p-3 bg-white" data-index="${index}">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted"><i class="fa-solid fa-grip-vertical"></i></span>
                            <span class="badge bg-success text-uppercase">Rich Text Paragraph</span>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete-block" data-index="${index}"><i class="fa fa-trash"></i></button>
                    </div>
                    <div>
                        <label class="form-label small fw-semibold text-muted">HTML/Text Body Content</label>
                        <textarea class="form-control block-val-content" rows="4" placeholder="Enter paragraph content...">${block.content || ''}</textarea>
                    </div>
                </div>`;
            } else if (block.type === 'accordion') {
                var itemsHtml = '';
                var items = block.items || [];
                
                items.forEach(function(item, itemIdx) {
                    itemsHtml += `
                    <div class="border p-3 rounded mb-2 bg-light accordion-item-builder" data-item-index="${itemIdx}">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <strong class="small text-dark">Accordion Tab #${itemIdx + 1}</strong>
                            <button type="button" class="btn btn-sm btn-link text-danger p-0 btn-delete-accordion-item" data-item-index="${itemIdx}"><i class="fa fa-times"></i> Delete Tab</button>
                        </div>
                        <div class="mb-2">
                            <input type="text" class="form-control form-control-sm accordion-item-title" value="${item.title || ''}" placeholder="Tab Header Title (e.g. Refund terms)">
                        </div>
                        <div>
                            <textarea class="form-control form-control-sm accordion-item-content" rows="2" placeholder="Tab Content body...">${item.content || ''}</textarea>
                        </div>
                    </div>`;
                });

                blockHtml = `
                <div class="card cms-block-card border p-3 bg-white" data-index="${index}">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted"><i class="fa-solid fa-grip-vertical"></i></span>
                            <span class="badge bg-warning text-dark text-uppercase">Accordion List</span>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary btn-add-accordion-item" data-index="${index}"><i class="fa fa-plus"></i> Add Tab</button>
                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete-block" data-index="${index}"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                    
                    <div class="accordion-items-container">
                        ${itemsHtml}
                        ${items.length === 0 ? '<div class="text-center py-2 text-muted small">No tabs added. Click "Add Tab" to create accordions.</div>' : ''}
                    </div>
                </div>`;
            }

            container.append(blockHtml);
        });
    }

    $('.btn-add-block').on('click', function(e) {
        e.preventDefault();
        var type = $(this).data('type');
        var newBlock = { type: type };

        if (type === 'heading') {
            newBlock.text = '';
            newBlock.level = 'h2';
        } else if (type === 'text') {
            newBlock.content = '';
        } else if (type === 'accordion') {
            newBlock.items = [];
        }

        blocks.push(newBlock);
        renderBlocks();
    });

    $(document).on('click', '.btn-delete-block', function() {
        var index = $(this).data('index');
        blocks.splice(index, 1);
        renderBlocks();
    });

    $(document).on('click', '.btn-add-accordion-item', function() {
        var index = $(this).data('index');
        saveCurrentInputs();
        blocks[index].items.push({ title: '', content: '' });
        renderBlocks();
    });

    $(document).on('click', '.btn-delete-accordion-item', function() {
        var blockIdx = $(this).closest('.cms-block-card').data('index');
        var itemIdx = $(this).data('item-index');
        saveCurrentInputs();
        blocks[blockIdx].items.splice(itemIdx, 1);
        renderBlocks();
    });

    function saveCurrentInputs() {
        $('.cms-block-card').each(function() {
            var index = $(this).data('index');
            var block = blocks[index];

            if (block.type === 'heading') {
                block.text = $(this).find('.block-val-text').val();
                block.level = $(this).find('.block-val-level').val();
            } else if (block.type === 'text') {
                block.content = $(this).find('.block-val-content').val();
            } else if (block.type === 'accordion') {
                var items = [];
                $(this).find('.accordion-item-builder').each(function() {
                    items.push({
                        title: $(this).find('.accordion-item-title').val(),
                        content: $(this).find('.accordion-item-content').val()
                    });
                });
                block.items = items;
            }
        });
    }

    $('#cms-builder-form').on('submit', function(e) {
        e.preventDefault();
        saveCurrentInputs();

        var formData = {
            id: $('input[name="id"]').val(),
            title: $('#title').val(),
            slug: $('#slug').val(),
            active: $('#active').val(),
            meta_title: $('#meta_title').val(),
            meta_description: $('#meta_description').val(),
            content: JSON.stringify(blocks) // Serialize blocks array
        };

        $.ajax({
            url: '/admin/cms/save',
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    alert('CMS Page blocks saved successfully!');
                    window.location.href = '/admin/cms';
                } else {
                    alert('Failed to save: ' + (response.error || 'Unknown error'));
                }
            },
            error: function(xhr) {
                alert('Connection error saving CMS page.');
            }
        });
    });

    renderBlocks();
});
</script>
