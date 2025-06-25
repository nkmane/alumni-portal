<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = "INSERT INTO messages (name, email, subject, message) 
            VALUES ('$name', '$email', '$subject', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Message sent successfully');</script>";
    } else {
        echo "<script>alert('Failed to send message');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    
    /* Contact Form */
    .contact-section {
      display: flex;
      justify-content: center;
      align-items: center;
      flex: 1;
      padding: 40px 0;
    }

    .form-container {
      background-color: #f9f9f9;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      width: 350px;
      text-align: center;
    }

    .form-container h2 {
      margin-bottom: 20px;
      font-size: 24px;
    }

    .contact-form input,
    .contact-form textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
    }

    .contact-form textarea {
      height: 100px;
      resize: none;
    }

    .contact-form button {
      width: 100%;
      padding: 12px;
      background-color: orange;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    .contact-form button:hover {
      background-color: #e69500;
    }

  
  </style>
</head>
<body>

<?php include 'header.php';?>

<!-- CONTACT FORM SECTION -->
<div class="contact-section">
  <div class="form-container">
    <h2>Contact Us</h2>
    <form method="POST" action="" class="contact-form">
      <input type="text" name="name" placeholder="Your Name" required>
      <input type="email" name="email" placeholder="Your Email" required>
      <input type="text" name="subject" placeholder="Subject" required>
      <textarea name="message" placeholder="Your Message" required></textarea>
      <button type="submit" name="submit">Send Message</button>
    </form>
  </div>
</div>

<!-- Footer -->
<?php include 'footer.php';?>
</body>
</html>
