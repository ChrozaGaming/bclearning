</label>
<input type="text" name="email"><br><br>
<label>Tingkat Kelas:</label>
<select name="tingkat_kelas">
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
</select><br><br>
<label>Password:</label>
<input type="password" name="password"><br><br>
<label>Konfirmasi Password:</label>
<input type="password" name="konfirmasi_password"><br><br>
<input type="submit" value="Daftar">
</form>
</body>
</html>
<?php
$nama_lengkap = $_POST['nama_lengkap'];
$no_telp = $_POST['no_telp'];
$email = $_POST['email'];
$tingkat_kelas = $_POST['tingkat_kelas'];
$password = $_POST['password'];
$konfirmasi_password = $_POST['konfirmasi_password'];

// validasi input
if(empty($nama_lengkap) || empty($no_telp) || empty($email) || empty($tingkat_kelas) || empty($password) || empty($konfirmasi_password)) {
    $error_message = "Semua field harus diisi!";
    include('register_siswa.php');
    exit;
}

if($password !== $konfirmasi_password) {
    $error_message = "Konfirmasi password tidak sama!";
    include('register_siswa.php');
    exit;
}

// enkripsi password menggunakan md5
$password_md5 = md5($password);

// koneksi ke database
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'elearning';
$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn) {
    $error_message = "Koneksi ke database gagal: " . mysqli_connect_error();
    include('register_siswa.php');
    exit;
}

// simpan data siswa ke database
$sql = "INSERT INTO siswa (nama_lengkap, no_telp, email, tingkat_kelas, password) VALUES ('$nama_lengkap', '$no_telp', '$email', '$tingkat_kelas', '$password_md5')";

if(mysqli_query($conn, $sql)) {
    $success_message = "Pendaftaran berhasil!";
    include('register_siswa.php');
} else {
    $error_message = "Pendaftaran gagal: " . mysqli_error($conn);
    include('register_siswa.php');
}

mysqli_close($conn);
?>