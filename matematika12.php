<?php
session_start();

// cek apakah siswa sudah login
if (!isset($_SESSION['siswa_id'])) {
    header('Location: login.php');
    exit;
}

// cek tingkat kelas siswa
$tingkat_kelas = $_SESSION['tingkat_kelas'];

// jika tingkat kelas siswa bukan 12, redirect ke halaman utama siswa
if ($tingkat_kelas != '12') {
    header('Location: panel_siswa.php');
    exit;
}

// mencari video matematika untuk tingkat kelas 12
$section = 'matematika';
$video_dir = 'videos/';

// mencari semua file di direktori videos
$files = scandir($video_dir);

// looping setiap file di direktori videos
foreach ($files as $file) {
    // cek apakah file memiliki ekstensi .mp4
    if (pathinfo($file, PATHINFO_EXTENSION) == 'mp4') {
        // cek apakah file sesuai dengan kriteria
        $filename_parts = explode('_', $file);
        $file_section = $filename_parts[0];
        $file_tingkat_kelas = str_replace('.mp4', '', $filename_parts[1]);
        if ($file_section == $section && $file_tingkat_kelas == $tingkat_kelas) {
            // tampilkan video
            echo '<video width="320" height="240" controls>';
            echo '<source src="' . $video_dir . $file . '" type="video/mp4">';
            echo 'Your browser does not support the video tag.';
            echo '</video>';
            break;
        }
    }
}
?>
