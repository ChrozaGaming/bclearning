<?php
session_start();

// membersihkan session atau cookie yang digunakan
session_unset();
session_destroy();
setcookie('login', '', time() - 3600);

// mengalihkan halaman ke halaman login
header('Location: login.php');
exit;
?>
