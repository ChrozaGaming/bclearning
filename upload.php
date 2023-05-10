<?php
// cek apakah form telah di-submit
if (isset($_POST['submit'])) {
    // ambil data dari form
    $judul = $_POST['judul'];
    $section = $_POST['section'];
    $tingkat_kelas = $_POST['tingkat_kelas'];

    // ambil informasi file yang di-upload
    $file_name = $_FILES['video']['name'];
    $file_size = $_FILES['video']['size'];
    $file_tmp = $_FILES['video']['tmp_name'];

    // ambil tipe file
    $file_type = pathinfo($file_name, PATHINFO_EXTENSION);

    // buat nama file baru
    $new_file_name = time() . '.' . $file_type;

    // tentukan direktori penyimpanan file
    $upload_dir = "videos/";

    // pindahkan file ke direktori penyimpanan
    move_uploaded_file($file_tmp, $upload_dir . $new_file_name);

    // simpan informasi file ke dalam database
    $con = mysqli_connect("localhost", "root", "", "elearning");
    mysqli_query($con, "INSERT INTO videos (judul, section, tingkat_kelas, file_name, file_size) VALUES ('$judul', '$section', '$tingkat_kelas', '$new_file_name', '$file_size')");

    // tampilkan notifikasi
    echo "<script>alert('Video berhasil diunggah: \\n\\nJudul: $judul \\nSection: $section \\nTingkat Kelas: $tingkat_kelas \\nFile: $new_file_name'); window.location.href='member.php';</script>";

    exit;
}

?>

    <!-- Tampilkan form upload -->
<!DOCTYPE html>
<html>
<head>
    <title>Upload Video Pembelajaran</title>
</head>
<body>
<h2>Upload Video Pembelajaran</h2>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <label>Judul:</label>
    <input type="text" name="judul">
    <label>Section:</label>
    <select name="section">
        <option value="matematika">Matematika</option>
        <option value="fisika">Fisika</option>
        <option value="kimia">Kimia</option>
    </select>
    <label>Tingkat Kelas:</label>
    <select name="tingkat_kelas">
        <option value="7">Kelas 7 SMP</option>
        <option value="8">Kelas 8 SMP</option>
        <option value="9">Kelas 9 SMP</option>
        <option value="10">Kelas 10 SMA</option>
        <option value="11">Kelas 11 SMA</option>
        <option value="12">Kelas 12 SMA</option>
    </select>
    <label>Video:</label>
    <input type="file" name="video">
    <input type="submit" name="submit" value="Upload">
</form>
</body>
</html>


<style>
    body {
        font-family: sans-serif;
    }
    h2 {
        text-align: center;
        animation: pulse 3s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.5); }
        100% { transform: scale(1); }
    }


    form {
        width: 500px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    label {
        display: block;
        margin-bottom: 5px;
    }
    input[type="text"],
    select {
        display: block;
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 10px;
    }
    input[type="file"] {
        margin-bottom: 20px;
    }
    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
    }
    input[type="submit"]:hover {
        background-color: #3e8e41;
    }
    .error {
        color: red;
        margin-bottom: 10px;
    }
    .success {
        color: green;
        margin-bottom: 10px;
    }
</style>