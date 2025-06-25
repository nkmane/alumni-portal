<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<!-- Footer -->
<footer class="footer">
  <div class="footer-content">
    <p>&copy; 2025 Alumni Connect. All rights reserved.</p>
    <p>Developed by Nikita Mane</p>
  </div>
</footer>

<style>
.footer {
  background-color: #333;
  color: #ccc;
  text-align: center;
  padding: 15px;
  margin-top: auto;
}
</style>
