<?php require base_path('views/partials/auth/auth.php') ?>
<main style="max-width: 1200px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif; background-color: #f4f7fa;">
    <!-- Complaint Details Section -->
    <section style="background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px;">
        <h2 style="color: #333; margin: 0 0 15px; font-size: 24px;">Complaint #<?= $COMPLAINT['id'] ?></h2>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <p style="margin: 5px 0; color: #555;"><strong>Subject:</strong> <?= $COMPLAINT['subject'] ?></p>
                <p style="margin: 5px 0; color: #555;"><strong>Complainant:</strong> <?= $COMPLAINT['complainant_name'] ?></p>
                <p style="margin: 5px 0; color: #555;"><strong>Accused:</strong> <?= $COMPLAINT['accused_id'] == 1 ? 'System' : $COMPLAINT['accused_name'] ?></p>
                <p style="margin: 5px 0; color: #555;"><strong>Status:</strong> 
                    <span style="color: #e67e22; background: #fff3e0; padding: 2px 8px; border-radius: 12px;"> <?= $COMPLAINT['status'] ?> </span>
                </p>
            </div>
            <div>
                <p style="margin: 5px 0; color: #555;"><strong>Date Filed:</strong> <?= date('Y-m-d H:i', strtotime($COMPLAINT['created_at'])) ?></p>
                <p style="margin: 5px 0; color: #555;"><strong>Complaint Type:</strong> <?= $COMPLAINT['complaint_type'] ?></p>
            </div>
        </div>
        <div style="margin-top: 20px;">
            <h3 style="color: #333; font-size: 18px; margin: 0 0 10px;">Description</h3>
            <p style="color: #555; line-height: 1.6; background: #f9f9f9; padding: 15px; border-radius: 6px;">
                <?= $COMPLAINT['description'] ?>
            </p>
        </div>
    </section>

    <!-- Chat Section -->
    <section style="background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="color: #333; margin: 0 0 15px; font-size: 24px;">Conversation</h2>
        <div style="max-height: 400px; overflow-y: auto; padding: 10px; border: 1px solid #e0e0e0; border-radius: 6px; margin-bottom: 20px;">
            <?php foreach ($MESSAGES as $message): ?>
                <?php if ($message['sender_id'] == auth_user()['id']): ?>
                    <!-- Message from current user -->
                    <div style="margin-bottom: 15px; text-align: right;">
                        <p style="margin: 0; color: #555; font-size: 14px;"><strong><?= htmlspecialchars($message['sender_name']) ?></strong> 
                            <span style="color: #888;"><?= date('Y-m-d H:i', strtotime($message['created_at'])) ?></span>
                        </p>
                        <p style="background: #c8e6c9; padding: 10px; border-radius: 6px; margin: 5px 0; color: #333; display: inline-block;">
                            <?= nl2br(htmlspecialchars($message['message'])) ?>
                        </p>
                    </div>
                <?php else: ?>
                    <!-- Message from others (admin or other parties) -->
                    <div style="margin-bottom: 15px;">
                        <p style="margin: 0; color: #555; font-size: 14px;"><strong><?= htmlspecialchars($message['sender_name']) ?></strong> 
                            <span style="color: #888;"><?= date('Y-m-d H:i', strtotime($message['created_at'])) ?></span>
                        </p>
                        <p style="background: #e3f2fd; padding: 10px; border-radius: 6px; margin: 5px 0; color: #333; width: fit-content;">
                            <?= nl2br(htmlspecialchars($message['message'])) ?>
                        </p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Message Input -->
        <form method="POST" action="/students/complaints/messages" style="display: flex; gap: 10px;">
            <textarea name="message" placeholder="Type your message..." style="flex: 1; padding: 10px; border: 1px solid #e0e0e0; border-radius: 6px; resize: vertical; font-size: 14px;"></textarea>
            <input type="hidden" name="complaint_id" value="<?= $COMPLAINT['id'] ?>">
            <button style="padding: 10px 20px; background: #1976d2; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 14px; transition: background 0.2s;">
                Send
            </button>
        </form>
    </section>
</main>
<?php require base_path('views/partials/auth/auth-close.php') ?>
