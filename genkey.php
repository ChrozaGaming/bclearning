<?php
session_start();

// cek apakah user sudah login atau belum
if (!isset($_SESSION['siswa_id'])) {
    // jika belum, arahkan ke halaman login
    header('Location: login.php');
    exit;
}

// membuat koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "elearning";
$conn = mysqli_connect($host, $user, $password, $database);

// cek apakah form telah disubmit
if (isset($_POST['submit'])) {
    // generate license key
    $license_key = generate_license_key();

    // simpan license key ke dalam database
    $siswa_id = $_SESSION['siswa_id'];
    $id = mysqli_insert_id($conn);
    $query = "INSERT INTO license_keys (id, license_key) VALUES ('$id', '$license_key')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // jika berhasil disimpan, tampilkan license key
        echo "License key Anda: <strong>$license_key</strong>";
    } else {
        // jika gagal disimpan, tampilkan pesan error
        echo "Gagal menyimpan license key!";
    }
}

// fungsi untuk generate license key
function generate_license_key() {
    // karakter yang digunakan untuk generate license key
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // panjang license key
    $length = 24;

    $license_key = '';

    // generate license key secara random
    for ($i = 0; $i < $length; $i++) {
        $license_key .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $license_key;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Generate License Key</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            margin: auto;
            max-width: 600px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Generate License Key</h1>
    <form method="POST">
        <input type="submit" name="submit" value="Generate">
    </form>
    <a href="panel_siswa.php">Kembali ke Panel Siswa</a>
</div>
</body>
</html>
