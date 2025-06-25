<?php include 'header.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Alumni Portal - Home</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
    }

    .hero {
      background-image: url('images/bg.jpg'); /* Replace with your image path */
      background-size: cover;
      background-position: center;
      height: 100vh;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background: rgba(0, 0, 0, 0.5);
    }

    .hero-content {
      position: relative;
      text-align: center;
      color: #fff;
      z-index: 2;
      animation: fadeIn 1.5s ease-in;
    }

    .hero-content h1 {
      font-size: 48px;
      margin-bottom: 10px;
    }

    .hero-content p {
      font-size: 20px;
      margin-bottom: 30px;
    }

    .hero-content .btn-group {
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
    }

    .hero-content a {
      text-decoration: none;
      padding: 12px 25px;
      background-color: orange;
      color: white;
      border-radius: 5px;
      font-size: 16px;
      transition: background 0.3s ease;
    }

    .hero-content a:hover {
      background-color: darkorange;
    }


    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
      .hero-content h1 {
        font-size: 34px;
      }

      .hero-content p {
        font-size: 16px;
      }

  </style>
  </head>



<!-- Hero Section -->
<div class="hero">
  <div class="overlay"></div>
  <div class="hero-content">
    <h1>Welcome to Alumni Connect</h1>
    <p>Reconnecting Hearts. Rekindling Memories.</p>
    <div class="btn-group">
      <a href="register.php">Join Now</a>
      <a href="login.php">Login</a>
      <a href="alumni.php">Click Me</a>
    </div>
  </div>
</div>



<?php include 'footer.php'; ?>



</body>
</html>
