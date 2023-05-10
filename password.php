<?php
if (isset($_GET['password'])) {
    $password = $_GET['password'];
    echo "<h2>Password Anda</h2>";
    echo "<p>Berikut adalah password acak Anda: <strong>$password</strong></p>";
}
else {
    echo "<h2>Error</h2>";
    echo "<p>Maaf, terjadi kesalahan. Silakan coba lagi nanti.</p>";
}
?>
<?php
