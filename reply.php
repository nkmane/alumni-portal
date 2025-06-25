<?php
// reply_message.php
session_start();
include 'db.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message_id = $_POST['message_id'];
    $reply = trim($_POST['reply']);
    $user_id = $_SESSION['user_id'];

    if (!empty($reply)) {
        $stmt = $conn->prepare("UPDATE messages SET reply = ?, is_read = 0 WHERE id = ? AND receiver_id = ?");
        $stmt->bind_param("sii", $reply, $message_id, $user_id);
        if ($stmt->execute()) {
            echo "<script>alert('Reply sent successfully!'); window.location='inbox.php';</script>";
        } else {
            echo "Error: Unable to send reply.";
        }
    } else {
        echo "<script>alert('Reply cannot be empty.'); window.location='inbox.php';</script>";
    }
} else {
    header("Location: inbox.php");
    exit();
}
?>
