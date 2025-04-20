<?php require base_path('views/partials/auth/auth.php') ?>
    <main style="max-width: 1200px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif; background-color: #f4f7fa;">
        <!-- Complaint Details Section -->
        <section style="background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px;">
            <h2 style="color: #333; margin: 0 0 15px; font-size: 24px;">Complaint #<?= $complaint['id'] ?></h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <p style="margin: 5px 0; color: #555;"><strong>Subject:</strong> <?=$complaint['subject']?></p>
                    <p style="margin: 5px 0; color: #555;"><strong>Complainant:</strong> <?= $complaint['complainant_name'] ?></p>
                    <p style="margin: 5px 0; color: #555;"><strong>Accused:</strong> <?= $complaint['accused_id'] == 1 ? 'System' : $complaint['accused_name'] ?></p>
                    <p style="margin: 5px 0; color: #555;"><strong>Status:</strong>
                        <?php if ($complaint['status'] == 'pending'): ?>
                            <span style="background-color: var(--color-primary); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Pending</span>
                        <?php elseif ($complaint['status'] == 'in_review'): ?>
                            <span style="background-color: var(--yellow-500); color: white; padding-inline: 0.6rem; padding-block: 0.2rem; border-radius: 100px; font-size: 0.8rem">In Review</span>
                        <?php elseif ($complaint['status'] == 'resolved'): ?>
                            <span style="background-color: var(--emerald-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Resolved</span>
                        <?php elseif ($complaint['status'] == 'rejected'): ?>
                            <span style="background-color: var(--red-700); color: white; padding-inline: 0.6rem; padding-block: 0.4rem; border-radius: 100px; font-size: 0.8rem">Rejected</span>
                        <?php endif; ?>
                    </p>
                </div>
                <div>
                    <p style="margin: 5px 0; color: #555;"><strong>Date Filed:</strong> <?= date('d M Y', strtotime($complaint['created_at'])) ?></p>
<!--                    <p style="margin: 5px 0; color: #555;"><strong>Complaint Type:</strong> Workplace Issue</p>-->
                </div>
            </div>
            <div style="margin-top: 20px;">
                <h3 style="color: #333; font-size: 18px; margin: 0 0 10px;">Description</h3>
                <p style="color: #555; line-height: 1.6; background: #f9f9f9; padding: 15px; border-radius: 6px;">
                    <?= $complaint['description'] ?>
                </p>
            </div>
        </section>

        <!-- Chat Section -->
        <section style="background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h2 style="color: #333; margin: 0 0 15px; font-size: 24px;">Conversation</h2>
            <div style="max-height: 400px; overflow-y: auto; padding: 10px; border: 1px solid #e0e0e0; border-radius: 6px; margin-bottom: 20px;">
                <?php foreach($complaint_messages as $message): ?>
                    <?php if($message['sender_id'] == auth_user()['id']): ?>
                        <!-- Message 2 -->
                        <div style="margin-bottom: 15px; text-align: right;">
                            <p style="margin: 0; color: #555; font-size: 14px;"><strong><?= $message['sender_name'] ?></strong> <span style="color: #888;"><?= date('d-m-Y H:i', strtotime($message['created_at'])) ?></span></p>
                            <p style="background: #c8e6c9; padding: 10px; border-radius: 6px; margin: 5px 0; color: #333; display: inline-block;">
                                <?= $message['message'] ?>
                            </p>
                        </div>
                    <?php else: ?>
                        <!-- Message 1 -->
                        <div style="margin-bottom: 15px;">
                            <p style="margin: 0; color: #555; font-size: 14px;"><strong>Admin</strong> <span style="color: #888;"><?= date('d-m-Y H:i', strtotime($message['created_at'])) ?></span></p>
                            <p style="background: #e3f2fd; padding: 10px; border-radius: 6px; margin: 5px 0; color: #333;">
                                <?= $message['message'] ?>
                            </p>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
            </div>

            <!-- Message Input -->
            <div style="display: flex; gap: 10px;">
                <textarea style="flex: 1; padding: 10px; border: 1px solid #e0e0e0; border-radius: 6px; resize: vertical; font-size: 14px;" placeholder="Type your message..."></textarea>
                <button class="button">
                    Send
                </button>
            </div>
        </section>
    </main>
<?php require base_path('views/partials/auth/auth-close.php') ?>