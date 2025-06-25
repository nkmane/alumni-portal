<?php
session_start();
include 'db.php';
$user_id = $_SESSION['user_id'];
$other_id = $_GET['id'];

$query = "SELECT * FROM messages WHERE 
          (sender_id=$user_id AND receiver_id=$other_id) OR 
          (sender_id=$other_id AND receiver_id=$user_id) 
          ORDER BY created_at ASC";
$result = $conn->query($query);

while($row = $result->fetch_assoc()) {
  $class = $row['sender_id'] == $user_id ? 'sent' : 'received';
  echo "<div class='message $class'><strong>{$row['message']}</strong></div>";
}
?>
