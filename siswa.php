<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JK" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">E-Learning</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="matematika12.php">Matematika</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="fisika.php">Fisika</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="kimia.php">Kimia</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container my-4">
    <h2 class="text-center mb-4">Video Pembelajaran</h2>
    <div class="row">
        <?php
        // koneksi ke database
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'elearning';

        $conn = mysqli_connect($host, $user, $password, $database);

        if (!$conn) {
            die('Koneksi gagal: ' . mysqli_connect_error());
        }

        // ambil data video dari database
        $sql = 'SELECT * FROM videos ORDER BY created_at DESC';
        $result = mysqli_query($conn, $sql);

        // tampilkan video pada halaman
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-md-4">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['title'] . '</h5>';
                echo '<p class="card-text">' . $row['description'] . '</p>';
                echo '<video width="100%" height="240" controls>';
                echo '<source src="videos/' . $row['file_name'] . '" type="video/mp4">';
                echo '</video>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p class="text-center">Tidak ada video pembelajaran yang tersedia.</p>';
        }

        mysqli_close($conn);
        ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script
    src="https://code      jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
    integrity="sha384-MmI0NLfMqw+BHNCdM0JX9c8tjzzzPf4GMY4/rEm0Z8BYEQ1TVI2DyS/l/VyKnsmX"
    crossorigin="anonymous"></script>
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JK"
    crossorigin="anonymous"></script>
</body>
</html>

