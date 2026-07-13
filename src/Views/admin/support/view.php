<div class="container-xl py-5">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border border-light p-4 bg-white mb-4">
                <div class="d-flex justify-content-between align-items-center pb-3 border-bottom mb-3">
                    <div>
                        <span class="badge bg-secondary-subtle text-dark border mb-1">Ticket #<?= htmlspecialchars($ticket['ticket_number']) ?></span>
                        <h4 class="fw-bold mb-0 text-dark"><?= htmlspecialchars($ticket['subject']) ?></h4>
                    </div>
                    <a href="/admin/support" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Queue</a>
                </div>

                <h6 class="fw-bold mb-3 border-bottom pb-2 text-pink">Operations Conversation Log</h6>
                <div class="d-flex flex-column gap-3 mb-4" style="max-height: 450px; overflow-y: auto; padding-right: 5px;">
                    <?php foreach ($messages as $msg): ?>
                        <?php 
                            $isInternal = ($msg['is_internal'] == 1);
                            $bubbleAlign = $isInternal ? 'align-self-center text-center w-100' : (($msg['sender_id'] == $_SESSION['user_id']) ? 'align-self-end text-end' : 'align-self-start');
                            
                            if ($isInternal) {
                                $bubbleBg = 'bg-warning-subtle text-warning-emphasis border border-warning';
                                $senderLabel = 'INTERNAL NOTE • ' . htmlspecialchars($msg['sender_name']);
                            } else {
                                $isMe = ($msg['sender_id'] == $_SESSION['user_id']);
                                $bubbleBg = $isMe ? 'bg-pink text-white' : 'bg-light border text-dark';
                                $senderLabel = htmlspecialchars($msg['sender_name']) . ' (' . htmlspecialchars($msg['sender_role']) . ')';
                            }
                        ?>
                        <div class="d-flex flex-column <?= $bubbleAlign ?> <?= $isInternal ? '' : 'max-w-75' ?>">
                            <span class="text-muted" style="font-size: 0.7rem; margin-bottom: 2px;"><?= $senderLabel ?></span>
                            <div class="p-3 rounded-3 <?= $bubbleBg ?>" style="font-size: 0.9rem; border-radius: 12px; display: inline-block; text-align: left; max-width: 100%; word-break: break-word;">
                                <?= nl2br(htmlspecialchars($msg['message'])) ?>
                            </div>
                            <span class="text-muted" style="font-size: 0.65rem; margin-top: 2px;">
                                <?= date('d M, h:i A', strtotime($msg['created_at'])) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <form action="/admin/support/ticket/<?= $ticket['id'] ?>/reply" method="POST" class="border-top pt-3">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
                    <div class="mb-3">
                        <label for="message" class="form-label small fw-semibold text-muted text-uppercase">Post Message Reply</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required placeholder="Type your support response..."></textarea>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_internal" value="1" id="is_internal">
                            <label class="form-check-label small fw-semibold text-warning" for="is_internal">
                                Save as Internal Admin Note (Hidden from Customer)
                            </label>
                        </div>
                        <button type="submit" class="btn btn-pavitra-pink py-2 px-4 fw-bold small"><i class="fa fa-reply me-1"></i> Send Reply</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border border-light p-4 bg-white mb-4">
                <h5 class="fw-bold mb-3 text-pink border-bottom pb-2">Ticket State</h5>
                
                <form action="/admin/support/ticket/<?= $ticket['id'] ?>/status" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
                    <div class="mb-3">
                        <label for="status" class="form-label small fw-semibold text-muted text-uppercase">Oversight Status</label>
                        <select class="form-select form-select-sm" id="status" name="status" onchange="this.form.submit()">
                            <option value="OPEN" <?= $ticket['status'] === 'OPEN' ? 'selected' : '' ?>>Open</option>
                            <option value="IN_PROGRESS" <?= $ticket['status'] === 'IN_PROGRESS' ? 'selected' : '' ?>>In Progress</option>
                            <option value="RESOLVED" <?= $ticket['status'] === 'RESOLVED' ? 'selected' : '' ?>>Resolved</option>
                            <option value="CLOSED" <?= $ticket['status'] === 'CLOSED' ? 'selected' : '' ?>>Closed</option>
                        </select>
                    </div>
                </form>

                <div class="small text-secondary">
                    <div class="mb-1"><strong>Priority Scope:</strong> <span class="badge bg-light text-dark border"><?= $ticket['priority'] ?></span></div>
                    <div><strong>Last Update:</strong> <?= date('d M Y, h:i A', strtotime($ticket['updated_at'])) ?></div>
                </div>
            </div>

            <div class="card shadow-sm border border-light p-4 bg-white">
                <h5 class="fw-bold mb-3 text-pink border-bottom pb-2">Buyer Boutique Profile</h5>
                <h6 class="fw-bold text-dark mb-1"><?= htmlspecialchars($ticket['buyer_name']) ?></h6>
                <p class="text-secondary small mb-3">Customer ID: <code>#USR-<?= sprintf('%04d', $ticket['user_id']) ?></code></p>
                
                <div class="small text-secondary">
                    <div class="mb-1"><i class="fa fa-envelope me-2"></i><?= htmlspecialchars($ticket['buyer_email']) ?></div>
                    <div><i class="fa fa-phone me-2"></i><?= htmlspecialchars($ticket['buyer_mobile']) ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.max-w-75 {
    max-width: 75%;
}
</style>

