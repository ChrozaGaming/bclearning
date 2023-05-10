<?php
session_start();

// membuat koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "elearning";
$conn = mysqli_connect($host, $user, $password, $database);

// memeriksa apakah form login telah di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // mencari siswa dengan email dan password yang cocok
    $query = "SELECT * FROM siswa WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    // jika ditemukan siswa dengan email dan password yang cocok
    if (mysqli_num_rows($result) == 1) {
        $siswa = mysqli_fetch_assoc($result);

        // menyimpan data siswa ke session
        $_SESSION['siswa_id'] = $siswa['id'];

        // mengalihkan halaman ke panel siswa sesuai dengan tingkat_kelas
        $tingkat_kelas = $siswa['tingkat_kelas'];
        header("Location: panel_siswa.php?tingkat_kelas=$tingkat_kelas");
        exit;
    } else {
        // jika email atau password tidak cocok, tampilkan pesan error
        header('Location: wrongdatalogin.php');
    }
}

mysqli_close($conn);
?>
