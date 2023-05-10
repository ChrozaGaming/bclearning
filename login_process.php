<!DOCTYPE html>
<html>
<head>
    <title>Login Siswa</title>
    <style>
        body {
            background-color: #ae2c2c;
        }
        h2 {
            text-align: center;
            font-family: Arial, sans-serif;
            color: #534b4f;
            font-size: 36px;
            margin-top: 50px;
        }
        form {
            margin: 0 auto;
            width: 50%;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #d6d6d6;
        }
        label {
            display: block;
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #534b4f;
            margin-bottom: 10px;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            font-family: Arial, sans-serif;
            border-radius: 5px;
            border: none;
            margin-bottom: 20px;
            box-sizing: border-box;
            background-color: rgba(145, 144, 144, 0.28);
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            background-color: #fff;
            box-shadow: 0 0 5px #5da7c5;
        }

        input[type="submit"] {
            background-color: #534b4f;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            font-family: Arial, sans-serif;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2c2a2b;
        }
    </style>
</head>
<body>
<h2>Login Siswa</h2>
<form action="login_process.php" method="post">
    <label>Email:</label>
    <input type="email" name="email" required><br><br>
    <label>Password:</label>
    <input type="password" name="password" required><br><br>
    <input type="submit" name="submit" value="Login">
</form>
</body>
</html>
