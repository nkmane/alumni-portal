<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch received messages with sender info
$sql = "SELECT m.*, u.full_name AS sender_name, u.email AS sender_email
        FROM messages m
        JOIN users u ON m.sender_id = u.id
        WHERE m.receiver_id = ?
        ORDER BY m.sent_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include 'header.php'; ?>

<style>
body {
  font-family: 'Segoe UI', sans-serif;
  background-color: #f0f2f5;
  margin: 0;
  padding: 0;
}

.wrapper {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.container {
  flex: 1;
  max-width: 950px;
  margin: 40px auto;
  background: #fff;
  padding: 35px;
  border-radius: 10px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}

.container h2 {
  text-align: center;
  color: #333;
  margin-bottom: 25px;
}

.message {
  background-color: #f8f8f8;
  padding: 20px;
  margin-bottom: 20px;
  border-left: 6px solid #ffa500;
  border-radius: 10px;
}

.message p {
  margin: 8px 0;
  font-size: 16px;
}

.message small {
  display: block;
  color: gray;
  margin-top: 10px;
}

.reply-link {
  display: inline-block;
  margin-top: 10px;
  text-decoration: none;
  color: #007bff;
  font-weight: bold;
}

.reply-link:hover {
  text-decoration: underline;
}

.footer {
  background-color: #333;
  color: #ccc;
  text-align: center;
  padding: 15px;
}
</style>

<div class="wrapper">
  <div class="container">
    <h2>Inbox - Received Messages</h2>

    <?php if ($result->num_rows > 0): ?>
      <?php while ($msg = $result->fetch_assoc()): ?>
        <div class="message">
          <p><strong>From:</strong> <?= htmlspecialchars($msg['sender_name']) ?> (<?= htmlspecialchars($msg['sender_email']) ?>)</p>
          <p><strong>Message:</strong><br> <?= nl2br(htmlspecialchars($msg['message'])) ?></p>
          <?php if (!empty($msg['reply'])): ?>
            <p><strong>Your Reply:</strong><br> <?= nl2br(htmlspecialchars($msg['reply'])) ?></p>
          <?php endif; ?>
          <small>Received at: <?= htmlspecialchars($msg['sent_at']) ?></small>
          <a href="reply_message.php?msg_id=<?= $msg['id'] ?>" class="reply-link">Reply</a>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p style="text-align:center;">📭 No messages received yet.</p>
    <?php endif; ?>
  </div>

  <?php include'footer.php';?>

</div>
