<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registrasi Siswa</title>
    <h1>Registrasi Siswa</h1>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        form {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0,0,0,0.3);
        }

        h1 {
            text-align: center;
        }

        input[type="text"],
        input[type="password"],
        select {
            display: block;
            margin-bottom: 10px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            display: block;
            margin-top: 10px;
            padding: 10px;
            width: 100%;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #00e204;
        }

        form:last-child {
            margin-top: 20px;
        }

        form:last-child input[type="submit"] {
            background-color: #008CBA;
        }

        form:last-child input[type="submit"]:hover {
            background-color: #006380;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
<?php
require_once 'koneksi.php'; // Koneksi ke database

/**
 * Cegah akses ke halaman login saat sedang login.
 */
if(isset($_SESSION['is_login']) || isset($_COOKIE['_logged'])) {
    header('location: /');
}

if(isset($_POST['submit'])) {
    /**
     * Mendapatkan data dari formulir pendaftaran.
     * Data: Email, Kata Sandi, Nama Lengkap, dan NIM.
     */
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];
    $tingkat_kelas = $_POST['tingkat_kelas'];

    if(empty($email) || empty($password) || empty($name) || empty($tingkat_kelas)) {
        /**
         * Cek apakah formulir telah terisi data.
         */
        echo '<p style="color: red; font-weight: bold; text-align: center;">Warning! Silahkan isi data yang dicantumkan.</p>';

    } else {
        /**
         * Memasukkan data ke database.
         */
        $insert = $conn->query("INSERT INTO mahasiswa (email, password, nama_lengkap, tingkat_kelas) VALUES ('$email', '".password_hash($password, PASSWORD_BCRYPT)."', '$name', '$tingkat_kelas')");

        if($insert) {
            echo 'Pendaftaran berhasil!';
        } else {
            echo 'Pendaftaran gagal!';
        }
    }
}
?>


<form method="POST">
    <input type="text" name="email" value="" autocomplete="off" placeholder="Email">
    <br/>
    <input type="password" name="password" value="" autocomplete="off" placeholder="Kata sandi">
    <br/>
    <input type="text" name="name" value="" autocomplete="off" placeholder="Nama lengkap">
    <br/>
    <label>Tingkat Kelas:</label>
    <br>
    <select name="tingkat_kelas">
        <option value="7">Kelas 7 SMP</option>
        <option value="8">Kelas 8 SMP</option>
        <option value="9">Kelas 9 SMP</option>
        <option value="10">Kelas 10 SMA</option>
        <option value="11">Kelas 11 SMA</option>
        <option value="12">Kelas 12 SMA</option>
    </select><br><br>
    <input type="submit" name="submit" value="Daftar Sekarang!">
</form>
    <form method="POST" action="login.php">
        <h2>Menu Login</h2>
        <input type="submit" value="Login">
    </form>
</body>
</html>
