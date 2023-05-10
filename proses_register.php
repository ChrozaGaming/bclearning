<?php
// membuat koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "elearning";
$koneksi = mysqli_connect($host, $user, $password, $database);

// memeriksa apakah form registrasi telah di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {}
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
    // jika email belum terdaftar sebelumnya, cek license key yang dimasukkan
    $license_key = $_POST['license_key'];
    $query = "SELECT * FROM license_keys WHERE license_key = '$license_key'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        // jika license key sesuai, simpan data siswa ke database dan hapus license key yang digunakan
        $query = "INSERT INTO siswa (nama, email, password, no_telepon, alamat, tingkat_kelas)
            VALUES ('$nama', '$email', '$password', '$no_telepon', '$alamat', '$tingkat_kelas')";
        mysqli_query($koneksi, $query);

        $query = "DELETE FROM license_keys WHERE license_key = '$license_key'";
        mysqli_query($koneksi, $query);

        // mengalihkan halaman ke halaman sukses
        header('Location: sukses_register.php');
        exit;
    } else {
        // jika license key tidak sesuai, tampilkan pesan error
        echo "License key yang dimasukkan tidak sesuai!";
    }
}
if (isset($error_message)) { ?>
    <div class="error"><?php echo $error_message; ?></div>
<?php } ?>

<?php if (isset($notification_message)) { ?>
    <div class="notification"><?php echo $notification_message; ?></div>
<?php } ?>


<style>
    .error {
        background-color: #f44336;
        color: white;
        padding: 12px;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .notification {
        background-color: #4CAF50;
        color: white;
        padding: 12px;
        margin-bottom: 10px;
        border-radius: 5px;
    }
</style>
