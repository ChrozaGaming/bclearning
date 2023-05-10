<?php
// membuat koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "elearning";
$koneksi = mysqli_connect($host, $user, $password, $database);

// memeriksa apakah form registrasi telah di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];
    $tingkat_kelas = $_POST['tingkat_kelas'];

// memeriksa apakah email telah terdaftar sebelumnya
    $query = "SELECT * FROM siswa WHERE email='$email'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        // jika email telah terdaftar sebelumnya, tampilkan pesan error
        echo "Email telah terdaftar sebelumnya!";
    } else {
        // jika email belum terdaftar sebelumnya, simpan data siswa ke database
        $query = "INSERT INTO siswa (nama, email, password, no_telepon, alamat, tingkat_kelas)
            VALUES ('$nama', '$email', '$password', '$no_telepon', '$alamat', '$tingkat_kelas')";
        mysqli_query($koneksi, $query);

        // mengalihkan halaman ke halaman sukses
        header('Location: sukses_register.php');
        exit;
    }

}
?>
