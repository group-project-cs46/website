<?php require base_path('views/partials/auth/auth.php'); ?>

<link rel="stylesheet" href="/styles/PDC/Complaints&Feedback.css" />

<main class="main-content">
  <header class="header">
    <div class="msg-above">
      <div class="above-left">
        <i class="fa-brands fa-readme" style="font-size: 40px;"></i>
        <h2>Complaint #<?= $complaint['id'] ?></h2>
      </div>
      <div class="above-right">
        <a href="/PDC/complaints&feedback" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>
  </header>

  <section class="content">
    <div class="complaint-details">
      <p><strong>Subject:</strong> <?= htmlspecialchars($complaint['subject']) ?></p>
      <p><strong>Complainant:</strong> Company (ID: <?= $complaint['complainant_id'] ?>)</p>
      <p><strong>Accused:</strong> <?= $complaint['complaint_type'] === 'system' ? 'System' : 'Student (ID: ' . $complaint['accused_id'] . ')' ?></p>
      <p><strong>Status:</strong> <span class="status <?= strtolower($complaint['status']) ?>"><?= $complaint['status'] ?: 'Pending' ?></span></p>
      <p><strong>Date Filed:</strong> <?= date('d M Y', strtotime($complaint['created_at'])) ?></p>
    </div>

    <div class="complaint-description">
      <h3>Description</h3>
      <p><?= htmlspecialchars($complaint['description']) ?></p>
    </div>

    <div class="complaint-messages">
      <h3>Conversation</h3>
      <div class="chat-box" id="chatBox">
        <?php if (empty($complaint_messages)): ?>
          <p>No messages yet.</p>
        <?php else: ?>
          <?php foreach ($complaint_messages as $message): ?>
            <div class="message <?= $message['sender_id'] == auth_user()['id'] ? 'sent' : 'received' ?>">
              <p><strong><?= htmlspecialchars($message['sender_name']) ?>:</strong> <?= htmlspecialchars($message['message']) ?></p>
              <span class="timestamp"><?= date('Y-m-d H:i', strtotime($message['created_at'])) ?></span>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
      <form class="message-form" method="POST" action="/PDC/messages">
        <input type="hidden" name="complaint_id" value="<?= $complaint['id'] ?>">
        <textarea name="message" placeholder="Type your message..." required></textarea>
        <button type="submit" class="send-btn">Send</button>
      </form>
    </div>
  </section>
</main>

<script>
  
  const chatBox = document.getElementById('chatBox');
  chatBox.scrollTop = chatBox.scrollHeight;
</script>

<?php require base_path('views/partials/auth/auth-close.php') ?>