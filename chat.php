<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
$receiver_id = $_GET['id']; // target user
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Alumni Chat</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; padding: 30px; }
    .chat-box { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 10px; height: 400px; overflow-y: auto; }
    .message { margin: 10px 0; }
    .message.sent { text-align: right; }
    .message.received { text-align: left; }
    textarea { width: 80%; height: 60px; }
    button { height: 60px; }
  </style>
</head>
<body>

<h2>Chat with User #<?php echo $receiver_id; ?></h2>

<div class="chat-box" id="chatBox"></div>

<form action="send_message.php" method="POST">
  <input type="hidden" name="receiver_id" value="<?= $alumni['id'] ?>">
  <textarea name="message" placeholder="Write your message..." required></textarea>
  <button type="submit">Send Message</button>
</form>

<script>
function loadMessages() {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "fetch_messages.php?id=<?php echo $receiver_id; ?>", true);
  xhr.onload = function() {
    document.getElementById("chatBox").innerHTML = this.responseText;
  };
  xhr.send();
}
setInterval(loadMessages, 2000); // Refresh every 2s

document.getElementById("chatForm").onsubmit = function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  fetch("send_chat.php", { method: "POST", body: formData }).then(() => {
    document.getElementById("msg").value = "";
    loadMessages();
  });
};
</script>

</body>
</html>
