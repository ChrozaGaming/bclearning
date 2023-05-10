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
    header('Location: login.html');
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

// mencari id video berikutnya
$query_next = "SELECT id FROM videos WHERE id > $id LIMIT 1";
$result_next = mysqli_query($conn, $query_next);

if (!$result_next) {
    // jika query tidak berhasil, tampilkan pesan error
    echo "Query error: " . mysqli_error($conn);
    exit;
}

$next_video = mysqli_fetch_assoc($result_next);


//if ($is_mobile && $next_video) {
//    echo "<a href='watch.php?id=" . $next_video['id'] . "' class='button-3d'>Next Video</a>";
//}


mysqli_close($conn);
?>
<!--<h1>--><?php //echo $video['judul']; ?><!--</h1>-->




<div class="container">


</div>

<?php
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
//echo "<video width='$width' height='$height' controls>
//        <source src='$file_path' type='video/mp4'>
//      </video>";

//mysqli_close($conn);

?>

<a href="panel_siswa.php?tingkat_kelas=<?php echo $tingkat_kelas; ?>" class="button-3d">Kembali ke Panel Siswa</a>
<?php
if ($next_video) {
echo "<a href='watch.php?id=" . $next_video['id'] . "' class='button-3d'>Next Video</a>";
}
?>
<style>
    body {
        background-image: url('background.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        font-family: 'Helvetica Neue', sans-serif;
        color: #333;
    }

    h1, h2, h3 {
        font-family: 'Montserrat', sans-serif;
        color: #222;
        text-shadow: 2px 2px #ccc;
        text-align: center;
    }

    button, a {
        background-color: #d4af37;
        color: #fff;
        border-radius: 5px;
        padding: 10px 20px;
        text-decoration: none;
        transition: background-color 0.5s ease;
    }

    button:hover, a:hover {
        background-color: #b38f2f;
        cursor: pointer;
    }

    .navbar {
        background-color: rgba(255, 255, 255, 0.8);
        border-bottom: 1px solid #ccc;
        padding: 20px;
    }

    .navbar ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    .navbar li {
        margin-right: 20px;
    }

    .navbar a {
        text-decoration: none;
        color: #222;
        font-weight: bold;
        text-shadow: 2px 2px #ccc;
    }

    video {
        display: block;
        margin: 0 auto;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .button-3d {
        display: inline-block;
        text-align: center;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        box-shadow: 0 5px 0 #555;
        background-color: #777;
        color: #fff;
        font-size: 1.2rem;
        text-decoration: none;
        text-transform: uppercase;
        transition: all 0.2s ease;
    }


    .button-3d:hover {
        box-shadow: 0 2px 0 #555;
        transform: translateY(3px);
    }


</style>
