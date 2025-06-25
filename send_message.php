<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$from_id = $_SESSION['user_id'];
$to_id = isset($_GET['to_id']) ? intval($_GET['to_id']) : 0;

// Fetch receiver name
$receiver_sql = $conn->prepare("SELECT full_name FROM users WHERE id = ?");
$receiver_sql->bind_param("i", $to_id);
$receiver_sql->execute();
$receiver_result = $receiver_sql->get_result();
$receiver = $receiver_result->fetch_assoc();
$receiver_name = $receiver ? $receiver['full_name'] : "Unknown User";

// Send message
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $from_id, $to_id, $message);
    $stmt->execute();
    $success = true;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Send Message</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .container {
      max-width: 600px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    textarea {
      width: 100%;
      padding: 15px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
      resize: vertical;
      min-height: 150px;
    }

    button {
      background-color: orange;
      color: #fff;
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 15px;
    }

    button:hover {
      background-color: darkorange;
    }

    .footer {
      background-color: #333;
      color: #ccc;
      text-align: center;
      padding: 15px;
      margin-top: auto;
    }

    .back-link {
      display: block;
      margin-top: 20px;
      text-align: center;
    }

    .success-msg {
      background: #d4edda;
      color: #155724;
      padding: 10px;
      border-radius: 6px;
      margin-top: 20px;
      text-align: center;
    }

    a {
      text-decoration: none;
      color: blue;
    }
  </style>
</head>
<body>

<!-- Header -->
<?php include 'header.php'; ?>


<div class="container">
  <h2>Send Message to <?= htmlspecialchars($receiver_name) ?></h2>

  <?php if (!empty($success)): ?>
    <div class="success-msg">
      ✅ Message sent successfully! <br>
      <a href="sent_messages.php">Go to Sent Messages</a>
    </div>
  <?php else: ?>
    <form method="POST" action="">
      <textarea name="message" required placeholder="Write your message..."></textarea>
      <br>
      <button type="submit">Send</button>
    </form>
  <?php endif; ?>

  <div class="back-link">
    <a href="alumni.php">&larr; Back to Alumni List</a>
  </div>
</div>

<!-- Footer -->
<?php include 'footer.php';?>
</body>
</html>
