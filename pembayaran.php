<!DOCTYPE html>
<html>
<head>
    <title>Form Pembelian Paket Belajar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type=text], input[type=email], select {
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
</head>
<body>
<div class="container">
    <h1>Form Pembelian Paket Belajar</h1>
    <?php
    // check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // validate input fields
        $errors = array();

        if (empty($_POST['nama'])) {
            $errors[] = 'Nama harus diisi';
        } else {
            $nama = trim($_POST['nama']);
        }

        if (empty($_POST['email'])) {
            $errors[] = 'Email harus diisi';
        } else {
            $email = trim($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Format email tidak valid';
            }
        }

        if (empty($_POST['paket'])) {
            $errors[] = 'Pilih paket yang akan dibeli';
        } else {
            $paket = $_POST['paket'];
        }

        if (empty($_POST['nomor_rekening'])) {
            $errors[] = 'Nomor rekening harus diisi';
        } else {
            $nomor_rekening = trim($_POST['nomor_rekening']);
            if (!is_numeric($nomor_rekening)) {
                $errors[] = 'Nomor rekening harus berupa angka';
            }
        }

        if (empty($errors)) {
            // all input fields are valid, process payment and show success message
            // TODO: process payment and show success message
            $success_message = 'Pembelian berhasil';
        } else {
            // show errors
            foreach ($errors as $error) {
                echo "<div class='error'>$error</div>";
            }
        }
    }
    ?>
    <?php if (isset($success_message)) { ?>
        <div class="success"><?php echo $success_message; ?></div>
    <?php } else { ?>
    <form method="POST">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama">

        <label for="email">Email</label>
        <input type="email" id="email" name="email">

        <label for="paket">Paket Belajar</label>
        <select id="paket" name="paket">
            <option value="">-- Pilih Paket --</option>
            <option value="Paket Basic">Paket Basic</option>
            <option value="Paket Intermediate">Paket Intermediate</option>
            <option value="Paket Advanced">Paket Advanced</option>
        </select>
        <label for="nomor_rekening">Nomor Rekening</label>
        <input type="text" id="nomor_rekening" name="nomor_rekening">

        <input type="submit" value="Beli">
    </form>
    <?php } ?>
</div>
</body>
</html>
