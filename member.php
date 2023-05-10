<?php
require_once 'koneksi.php'; // Koneksi ke database.
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo (isset($_SESSION['is_login']) || isset($_COOKIE['_logged']) ? 'Beranda | '.$_SESSION['is_login'] : 'Beranda'); ?></title>
</head>
<body>
<p>
    <?php
    echo (isset($_SESSION['is_login']) || isset($_COOKIE['_logged']) ? 'Hi, '.$_SESSION['is_login'].' - <a href="logout.php">KELUAR >></a>' : 'Silahkan <a href="login.php">LOGIN</a> | <a href="register.html.php">REGISTER</a>');
    ?>
</p>
</body>
</html>