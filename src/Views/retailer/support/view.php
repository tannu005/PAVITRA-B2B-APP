<div class="container-xl py-5">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow-sm border border-light p-4 bg-white mb-4">
                <div class="d-flex justify-content-between align-items-center pb-3 border-bottom mb-3">
                    <div>
                        <span class="badge bg-secondary-subtle text-dark border mb-1">Ticket #<?= htmlspecialchars($ticket['ticket_number']) ?></span>
                        <h4 class="fw-bold mb-0 text-dark"><?= htmlspecialchars($ticket['subject']) ?></h4>
                    </div>
                    <a href="/support" class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Helpdesk</a>
                </div>
                <div class="row g-3 text-secondary small">
                    <div class="col-md-4">
                        <strong>Priority:</strong>
                        <span class="badge bg-light border text-dark ms-1"><?= htmlspecialchars($ticket['priority']) ?></span>
                    </div>
                    <div class="col-md-4">
                        <strong>Status:</strong>
                        <span class="badge bg-light border text-dark ms-1"><?= htmlspecialchars($ticket['status']) ?></span>
                    </div>
                    <div class="col-md-4">
                        <strong>Date Opened:</strong>
                        <span class="ms-1"><?= date('d M Y, h:i A', strtotime($ticket['created_at'])) ?></span>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm border border-light p-4 bg-white mb-4">
                <h6 class="fw-bold mb-3 border-bottom pb-2 text-pink">Conversation Log</h6>
                <div class="d-flex flex-column gap-3 mb-4" style="max-height: 400px; overflow-y: auto; padding-right: 5px;">
                    <?php foreach ($messages as $msg): ?>
                        <?php 
                            $isUserSender = ($msg['sender_id'] == $_SESSION['user_id']);
                            $bubbleAlign = $isUserSender ? 'align-self-end text-end' : 'align-self-start';
                            $bubbleBg = $isUserSender ? 'bg-pink text-white' : 'bg-light border text-dark';
                            $senderLabel = $isUserSender ? 'Me' : htmlspecialchars($msg['sender_name']) . ' (' . htmlspecialchars($msg['sender_role']) . ')';
                        ?>
                        <div class="d-flex flex-column <?= $bubbleAlign ?> max-w-75">
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
                <?php if ($ticket['status'] !== 'CLOSED'): ?>
                    <form action="/support/ticket/<?= $ticket['id'] ?>/reply" method="POST" class="border-top pt-3">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Core\Application::$app->getCsrfToken()) ?>">
                        <div class="mb-3">
                            <label for="message" class="form-label small fw-semibold text-muted text-uppercase">Post Response Reply</label>
                            <textarea class="form-control" id="message" name="message" rows="3" required placeholder="Type your reply message here..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-pavitra-pink py-2 px-4 fw-bold small"><i class="fa fa-reply me-1"></i> Send Reply</button>
                    </form>
                <?php else: ?>
                    <div class="alert alert-secondary text-center py-2 mb-0" style="font-size: 0.85rem;">
                        <i class="fa fa-lock me-1"></i> This ticket is <strong>CLOSED</strong>. If you still need help, please open a new ticket.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<style>
.max-w-75 {
    max-width: 75%;
}
</style>
