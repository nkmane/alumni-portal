<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      margin: 0;
      padding: 0;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #222;
      color: white;
      padding: 15px 30px;
      flex-wrap: wrap;
    }

    .navbar .logo {
      font-size: 24px;
      font-weight: bold;
      color: orange;
      text-decoration: none;
    }

    .nav-links {
      display: flex;
      list-style: none;
      gap: 20px;
      flex-wrap: wrap;
    }

    .nav-links li a {
      text-decoration: none;
      color: white;
      font-size: 16px;
      padding: 8px 12px;
      transition: background 0.3s;
      border-radius: 5px;
    }

    .nav-links li a:hover {
      background-color: orange;
      color: #000;
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        align-items: flex-start;
      }
      .nav-links {
        flex-direction: column;
        gap: 10px;
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>

  <nav class="navbar">
    <a class="logo" href="index.php">Alumni Portal</a>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="alumni.php">Alumni</a></li>
      <li><a href="register.php">Register</a></li>
      <li><a href="login.php">Login</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="inbox.php">Inbox</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>
