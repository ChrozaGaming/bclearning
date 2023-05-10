<?php
session_start();
if (!isset($_SESSION['siswa_id'])) {
    header('Location: login.html');
    exit;
}

$siswa_id = $_SESSION['siswa_id'];

// membuat koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "elearning";
$conn = mysqli_connect($host, $user, $password, $database);

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
$result = mysqli_query($conn, $query);

if (!$result) {
    // jika query tidak berhasil, tampilkan pesan error
    echo "Query error: " . mysqli_error($conn);
    exit;
}

$sections = mysqli_fetch_all($result, MYSQLI_ASSOC);

// menampilkan video dari setiap section
foreach ($sections as $section) {
    echo "<h2>" . ucfirst($section['section']) . "</h2>";

    $section_name = $section['section'];

    // mengambil video dari database berdasarkan section dan tingkat kelas
    $query = "SELECT * FROM videos WHERE section='$section_name' AND tingkat_kelas=$tingkat_kelas";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        // jika query tidak berhasil, tampilkan pesan error
        echo "Query error: " . mysqli_error($conn);
        exit;
    }

    $videos = mysqli_fetch_all($result, MYSQLI_ASSOC);

// menampilkan daftar video
    echo "<ul>";
    foreach ($videos as $video) {
        echo "<li><a href='watch.php?id=" . $video['id'] . "'>" . $video['judul'] . "</a></li>";
    }
    echo "</ul>";

}

mysqli_close($conn);
?>