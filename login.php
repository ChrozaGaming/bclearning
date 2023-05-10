<?php
session_start();

if (isset($_SESSION['siswa_id'])) {
    // jika user sudah login, arahkan ke panel_siswa.php dengan parameter tingkat_kelas
    $tingkat_kelas = $_GET['tingkat_kelas'] ?? '';
    header("Location: panel_siswa.php?tingkat_kelas=$tingkat_kelas");
    exit;
}

// membuat koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "elearning";
$koneksi = mysqli_connect($host, $user, $password, $database);

// mengambil tingkat_kelas dari URL
if (isset($_GET['tingkat_kelas'])) {
    $tingkat_kelas = $_GET['tingkat_kelas'];
} else {
    // jika tingkat_kelas tidak tersedia, tampilkan pesan error
    header('Location: login.html');
    exit;
}

// menampilkan seluruh section video sesuai dengan tingkat_kelas
$query = "SELECT DISTINCT section FROM videos WHERE tingkat_kelas=$tingkat_kelas";
$result = mysqli_query($koneksi, $query);
$sections = mysqli_fetch_all($result, MYSQLI_ASSOC);

// menampilkan video dari setiap section
foreach ($sections as $section) {
    echo "<h2>Section " . ucfirst($section['section']) . "</h2>";

    // mengambil video dari section tertentu
    $query = "SELECT * FROM videos WHERE section='" . $section['section'] . "' AND tingkat_kelas=$tingkat_kelas";
    $result = mysqli_query($koneksi, $query);
    $videos = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // menampilkan daftar video dari section tertentu
    echo "<ul>";
    foreach ($videos as $video) {
        echo "<li><a href=\"watch.php?video_id=" . $video['id'] . "\">" . $video['judul'] . "</a></li>";
    }
    echo "</ul>";
}

// menutup koneksi ke database
mysqli_close($koneksi);
?>
