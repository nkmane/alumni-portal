<?php
session_start();
include 'db.php';
$sender = $_SESSION['user_id'];
$receiver = $_POST['receiver_id'];
$msg = trim($_POST['msg']);

if (!empty($msg)) {
  $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
  $stmt->bind_param("iis", $sender, $receiver, $msg);
  $stmt->execute();
}
?>
