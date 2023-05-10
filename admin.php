<!DOCTYPE html>
<html>
<head>
    <title>Upload Video</title>
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // membuat koneksi ke database
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "elearning";
    $koneksi = mysqli_connect($host, $user, $password, $database);

    // mengambil data dari form upload
    $judul_video = $_POST['judul_video'];
    $deskripsi_video = $_POST['deskripsi_video'];
    $section = $_POST['section'];
    $tingkat_kelas = $_POST['tingkat_kelas'];

    // memeriksa apakah file video telah di-upload
    if (isset($_FILES['file_video'])) {
        $file_video = $_FILES['file_video'];
        $file_name = $file_video['name'];
        $file_tmp = $file_video['tmp_name'];
        $file_size = $file_video['size'];
        $file_error = $file_video['error'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // daftar ekstensi file yang diperbolehkan
        $allowed_ext = array('mp4');

        // memeriksa apakah ekstensi file video diperbolehkan
        if (in_array($file_ext, $allowed_ext)) {
            // memeriksa apakah ukuran file tidak melebihi 50MB
            // membuat direktori untuk menyimpan file video
            $dir = 'videos/';
            if (!is_dir($dir)) {
                mkdir($dir);
            }

            // menentukan direktori untuk menyimpan file video berdasarkan section dan tingkat_kelas
            if ($section == 'fisika') {
                $dir .= 'fisika/';
            } else {
                $dir .= $section . '/' . $tingkat_kelas . '/';
            }

            if (!is_dir($dir)) {
                mkdir($dir);
            }

            // menentukan nama file video
            $file_new_name = $section . '_' . $tingkat_kelas . '_' . time() . '.' . $file_ext;

            // memindahkan file video ke direktori yang ditentukan
            move_uploaded_file($file_tmp, $dir . $file_new_name);

            // menyimpan data video ke database
            $query = "INSERT INTO videos (judul, deskripsi, section, file_name, file_size, tingkat_kelas) VALUES ('$judul_video', '$deskripsi_video', '$section', '$file_new_name', $file_size, '$tingkat_kelas')";
            mysqli_query($koneksi, $query);

            echo 'File berhasil diupload!';
        } else {
            echo 'Ukuran file video terlalu besar!';
        }
    } else {
        echo 'Ekstensi file video tidak diperbolehkan!';
    }
} else {
    echo 'File video tidak ditemukan!';
}
?>

<h1>Upload Video</h1>

<form action="" method="post" enctype="multipart/form-data">
    <label for="judul_video">Judul Video:</label>
    <input type="text" name="judul_video" required><br><br>

    <label for="deskripsi_video">Deskripsi Video:</label>
    <textarea name="deskripsi_video" required></textarea><br><br>

    <label for="section">Section:</label>
    <select name="section" required>
        <option value="matematika">Matematika</option>
        <option value="fisika">Fisika</option>
        <option value="kimia">Kimia</option>
    </select><br><br>

    <label for="tingkat_kelas">Tingkat Kelas:</label>
    <select name="tingkat_kelas" required>
        <option value="7">Kelas 7</option>
        <option value="8">Kelas 8</option>
        <option value="9">Kelas 9</option>
        <option value="10">Kelas 10</option>
        <option value="11">Kelas 11</option>
        <option value="12">Kelas 12</option>
    </select><br><br>

    <label for="file_video">File Video:</label>
    <input type="file" name="file_video" accept=".mp4" required><br><br>

    <input type="submit" value="Upload">
</form>

</body>
</html>
