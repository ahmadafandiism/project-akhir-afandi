<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-bottom: 20px;
            color: #007bff;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            text-decoration: none;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-login {
            background-color: #007bff;
        }
        .btn-login:hover {
            background-color: #0056b3;
        }
        .btn-register {
            background-color: #28a745;
        }
        .btn-register:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div>
                <h1>Selamat Datang</h1>
                <nav class="-mx-3 flex flex-1 justify-center">
                    <?php
                    // Cek apakah user sudah login
                    $isLoggedIn = false; // Ganti dengan logika login yang sesuai

                    // Jika user sudah login, tampilkan tombol dashboard
                    if ($isLoggedIn) {
                        echo '<a href="/dashboard" class="btn btn-login">Dashboard</a>';
                    } else {
                        // Jika belum login, tampilkan tombol login dan register
                        echo '<a href="/login" class="btn btn-login">Log in</a>';
                        echo '<a href="/register" class="btn btn-register">Register</a>';
                    }
                    ?>
                </nav>
            </div>
        </header>
    </div>
</body>
</html>
