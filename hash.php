<?php
// Example: hash "admin123" and "12345"
echo "admin123: " . password_hash("admin123", PASSWORD_DEFAULT) . "<br>";
echo "12345: " . password_hash("12345", PASSWORD_DEFAULT) . "<br>";
?>
