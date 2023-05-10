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

// mengambil id video dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    // jika id tidak tersedia, tampilkan pesan error
    echo "Video tidak tersedia!";
    exit;
}

// mengambil data video dari database
$query = "SELECT * FROM videos WHERE id=$id";
$result = mysqli_query($conn, $query);

if (!$result) {
    // jika query tidak berhasil, tampilkan pesan error
    echo "Query error: " . mysqli_error($conn);
    exit;
}

$video = mysqli_fetch_assoc($result);

// menampilkan judul video
echo "<h1>" . $video['judul'] . "</h1>";

// menampilkan video
$section = $video['section'];
$tingkat_kelas = $video['tingkat_kelas'];
$file_name = $video['file_name'];
$file_path = "videos/$section/$tingkat_kelas/$file_name";

// mendeteksi jenis perangkat pengguna
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$is_mobile = (bool)preg_match('/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i', $user_agent);

// menentukan ukuran resolusi video yang sesuai
if ($is_mobile) {
    $width = 1080;
    $height = 1920;
} else {
    $width = 1920;
    $height = 1080;
}

// menampilkan video
echo "<video width='$width' height='$height' controls>
        <source src='$file_path' type='video/mp4'>
      </video>";


mysqli_close($conn);
?>