<?php
session_start();
session_unset();
session_destroy();

// Redirect to homepage or login page
header("Location: index.php");  // or use "login.php"
exit;
?>
