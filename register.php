<style>
    body {
        font-family: Arial, sans-serif;
    }
    label {
        display: block;
        margin-bottom: 10px;
    }

    input[type=text], input[type=email], input[type=password], select, textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        margin-bottom: 20px;
    }

    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    .container {
        margin: auto;
        max-width: 600px;
        padding: 20px;
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

<?php
session_start();

// membuat koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "elearning";
$conn = mysqli_connect($host, $user, $password, $database);

// memeriksa apakah form pendaftaran telah di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // memeriksa apakah license key yang dimasukkan valid
    $license_key = $_POST['license_key'];
    $query = "SELECT * FROM license_keys WHERE license_key = '$license_key'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // jika license key valid, simpan data siswa ke database
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $no_telepon = $_POST['no_telepon'];
        $alamat = $_POST['alamat'];
        $tingkat_kelas = $_POST['tingkat_kelas'];

        // memeriksa apakah email telah terdaftar sebelumnya
        $query = "SELECT * FROM siswa WHERE email='$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // jika email telah terdaftar sebelumnya, tampilkan pesan error
            $error_message = "Email telah terdaftar sebelumnya!";
        } else {
            // jika email belum terdaftar sebelumnya, simpan data siswa ke database
            $query = "INSERT INTO siswa (nama, email, password, no_telepon, alamat, tingkat_kelas)
                VALUES ('$nama', '$email', '$password', '$no_telepon', '$alamat', '$tingkat_kelas')";
            mysqli_query($conn, $query);

            // hapus license key yang telah digunakan
            $query = "DELETE FROM license_keys WHERE license_key = '$license_key'";
            mysqli_query($conn, $query);

            // mengalihkan halaman ke halaman sukses
            header('Location: sukses_register.php');
            exit;
        }
    } else {
        // jika license key tidak valid, tampilkan pesan error
        $error_message = "License key tidak valid!";
    }
}

?>

<!DOCTYPE html>
<html lang="zxx">
<!-- Mirrored from storage.googleapis.com/theme-vessel-items/checking-sites/oddo-2-html/HTML/main/register-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 May 2023 11:06:21 GMT -->
<head>
    <title>ODDO - Login and Register Form HTML5 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8" />
    <!-- External CSS libraries -->
    <link
            type="text/css"
            rel="stylesheet"
            href="assets/css/bootstrap.min.css"
    />
    <link
            type="text/css"
            rel="stylesheet"
            href="assets/fonts/font-awesome/css/font-awesome.min.css"
    />
    <link
            type="text/css"
            rel="stylesheet"
            href="assets/fonts/flaticon/font/flaticon.css"
    />

    <!-- Favicon icon -->
    <link
            rel="shortcut icon"
            href="assets/img/favicon.ico"
            type="image/x-icon"
    />

    <!-- Google fonts -->
    <link
            href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap"
            rel="stylesheet"
    />

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="assets/css/style.css" />
</head>
<body id="top">
<div class="page_loader"></div>

<!-- Login 1 start -->
<div class="login-1">
    <div class="container-fluid">
        <div class="row login-box">
            <div class="col-lg-6 align-self-center pad-0 form-section">
                <div class="form-inner">
                    <a href="login-1.html" class="logo">
                        <h1>- BIG COURSE - </h1>
                    </a>
                    <h3>Registrasi Akun Paket Pembelajaran</h3>
                    <div
                            class="alert alert-success alert-dismissible fade show"
                            role="alert"
                    >
                        <strong>Informasi:</strong> Silahkan isi data diri anda dengan benar!
                        <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"
                        ></button>
                    </div>
                    <form action="#" method="POST" id="commonForm">
                        <div class="form-group position-relative clearfix">
                            <input
                                    name="nama"
                                    type="text"
                                    id="nama"
                                    class="form-control"
                                    placeholder="Full Name"
                                    aria-label="Full Name"
                            />
                        </div>
                        <div class="form-group position-relative clearfix">
                            <input
                                    name="email"
                                    type="email"
                                    id="email"
                                    class="form-control"
                                    placeholder="Email Address"
                                    aria-label="Email Address"
                            />
                            <div
                                    class="login-popover login-popover-abs"
                                    data-bs-toggle="popover"
                                    data-bs-trigger="hover"
                                    title="Sticky Notes"
                                    data-bs-content="Isi Alamat Email Anda yang Aktif"
                            >
                                <i class="fa fa-info-circle"></i>
                            </div>
                        </div>
                        <div
                                class="form-group clearfix position-relative password-wrapper">
                            <input
                                    name="password"
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    autocomplete="off"
                                    placeholder="Password"
                                    aria-label="Password"
                            />
                            <i class="fa fa-eye password-indicator"></i>
                        </div>
                        <div
                        <div class="form-group position-relative clearfix">
                            <input
                                    name="no_telepon"
                                    type="text"
                                    id="no_telepon"
                                    class="form-control"
                                    autocomplete="off"
                                    placeholder="No Telepon"
                                    aria-label="No Telepon"
                            />
                        </div>
                        <div
                        <div class="form-group position-relative clearfix">
                            <input
                                    name="alamat"
                                    type="alamat"
                                    id="alamat"
                                    class="form-control"
                                    autocomplete="off"
                                    placeholder="Alamat"
                                    aria-label="Alamat"
                            />
                        </div>
                        <label for="tingkat_kelas">Jenjang Tingkat Kelas</label>
                        <select name="tingkat_kelas">
                            <option value="7">KELAS 7 SMP</option>
                            <option value="8">KELAS 8 SMP</option>
                            <option value="9">KELAS 9 SMP</option>
                            <option value="10">KELAS 10 SMA</option>
                            <option value="11">KELAS 11 SMA</option>
                            <option value="12">KELAS 12 SMA</option>
                        </select><br><br>
                        <div class="form-group position-relative clearfix">
                            <input
                                    name="license_key"
                                    type="text"
                                    id="license_key"
                                    class="form-control"
                                    autocomplete="off"
                                    placeholder="License Key"
                                    aria-label="License Key"
                            <input/>
                        </div>
<!--                        <div class="form-group checkbox clearfix">-->
<!--                            <div class="clearfix float-start">-->
<!--                                <div class="form-check">-->
<!--<!--                                    <input-->
<!--<!--                                            class="form-check-input"-->
<!--<!--                                            type="checkbox"-->
<!--<!--                                            id="rememberme"-->
<!--<!--                                    />-->
<!--<!--                                    <label class="form-check-label" for="rememberme">-->
<!--<!--                                        Saya telah menyetujui seluruh persyaratan yang ada-->
<!--<!--                                    </label>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="form-group clearfix">
                            <button
                                    value="Daftar"
                                    type="submit"
                                    class="btn btn-primary btn-lg btn-theme"
                            >
                                Register
                            </button>
                        </div>
<!--                        <div class="extra-login clearfix">-->
<!--                            <span>Or Login With</span>-->
<!--                        </div>-->
                    </form>
<!--                    <div class="clearfix"></div>-->
<!--                    <div class="social-list clearfix">-->
<!--                        <div class="icon facebook">-->
<!--                            <div class="tooltip">Facebook</div>-->
<!--                            <span><i class="fa fa-facebook"></i></span>-->
<!--                        </div>-->
<!--                        <div class="icon twitter">-->
<!--                            <div class="tooltip">Twitter</div>-->
<!--                            <span><i class="fa fa-twitter"></i></span>-->
<!--                        </div>-->
<!--                        <div class="icon instagram">-->
<!--                            <div class="tooltip">Google</div>-->
<!--                            <span><i class="fa fa-google"></i></span>-->
<!--                        </div>-->
<!--                        <div class="icon github mr-0">-->
<!--                            <div class="tooltip">Linkedin</div>-->
<!--                            <span><i class="fa fa-linkedin"></i></span>-->
<!--                        </div>-->
<!--                    </div>-->
                    <p><a href="login.html">Login</a></p>
                </div>
            </div>
            <div class="col-lg-6 pad-0 none-992 bg-img">
                <div class="lines">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
                <div class="info">
                    <div class="animated-text">
                        <h1>
                            Welcome
                            <span
                            >to<br />
                    BIG COURSE</span
                            >
                        </h1>
                    </div>
                    <p>
                        BIG COURSE adalah sebuah aplikasi video pembelajaran melalui internet yang sangat berguna bagi para pelajar yang ingin mempelajari mata pelajaran seperti matematika, fisika, dan kimia. Aplikasi ini menawarkan guru/mastertutor yang ahli dan berpengalaman di bidangnya, sehingga para pengguna bisa memperoleh pengetahuan secara mendalam dan terstruktur dalam bidang tersebut.</p><br><br>

                    <p>Dalam BIG COURSE, guru/mastertutor yang tergabung di dalamnya memiliki latar belakang pendidikan yang sangat kuat di bidang matematika, fisika, dan kimia. Mereka juga memiliki pengalaman mengajar yang luas, baik di tingkat sekolah maupun di level perguruan tinggi. Selain itu, aplikasi ini juga menyediakan beragam fitur menarik seperti tanya jawab langsung dengan guru/mastertutor melalui chat, diskusi kelompok, dan video pembelajaran yang dapat diakses kapan saja dan di mana saja. Dengan begitu, para pengguna dapat memperoleh bimbingan yang terpersonalisasi dan sesuai dengan kebutuhan belajar masing-masing individu.</p>

                    <p> </p>
                    </p>
                    <br>
                    <h2>License Key hanya bisa didapatkan jika kamu membeli paket pembelajaran dari platform <b>BIG COURSE</b></h2>
                    <h5>Dilarang Membeli License Key Diluar Platform <b>BIG COURSE</b></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login 1 end -->

<!-- External JS libraries -->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/app.js"></script>
<!-- Custom JS Script -->
</body>

<!-- Mirrored from storage.googleapis.com/theme-vessel-items/checking-sites/oddo-2-html/HTML/main/register-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 May 2023 11:06:25 GMT -->
</html>
