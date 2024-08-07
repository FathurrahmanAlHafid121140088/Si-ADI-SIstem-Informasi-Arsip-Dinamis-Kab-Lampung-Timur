<?php
session_start();

// Ketika melakukan logout maka akan menghancurkan semua data session
session_destroy();

// Redirect ke halaman login
header("Location: home.php");
exit();
?>