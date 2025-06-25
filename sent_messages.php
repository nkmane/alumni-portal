<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch sent messages with receiver info
$sql = "SELECT m.*, u.full_name AS receiver_name, u.email AS receiver_email
        FROM messages m
        JOIN users u ON m.receiver_id = u.id
        WHERE m.sender_id = ?
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
  margin: 0;
  padding: 0;
  background-color: #f9f9f9;
}

.wrapper {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.container {
  flex: 1;
  max-width: 900px;
  margin: 40px auto;
  background: #fff;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.container h2 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}

.message {
  background-color: #f4f4f4;
  padding: 15px;
  margin-bottom: 15px;
  border-radius: 8px;
  border-left: 5px solid orange;
}

.message strong {
  color: #333;
}

.message p {
  margin: 5px 0;
}

.message small {
  color: gray;
  font-size: 12px;
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
    <h2>Sent Messages</h2>

    <?php if ($result->num_rows > 0): ?>
      <?php while ($msg = $result->fetch_assoc()): ?>
        <div class="message">
          <p><strong>To:</strong> <?= htmlspecialchars($msg['receiver_name']) ?> (<?= htmlspecialchars($msg['receiver_email']) ?>)</p>
          <p><strong>Message:</strong> <?= nl2br(htmlspecialchars($msg['message'])) ?></p>
          <?php if (!empty($msg['reply'])): ?>
            <p><strong>Reply:</strong> <?= nl2br(htmlspecialchars($msg['reply'])) ?></p>
          <?php endif; ?>
          <small>Sent at: <?= htmlspecialchars($msg['sent_at']) ?></small>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p style="text-align:center;">You haven't sent any messages yet.</p>
    <?php endif; ?>
  </div>

 <?php include 'footer.php';?>