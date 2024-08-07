<?php
session_start();

// Meng-include file koneksi
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Menyiapkan dan menjalankan query
    $stmt = $conn->prepare("SELECT * FROM akun WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek apakah user ditemukan
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: home.php"); // ganti dengan halaman yang Anda inginkan setelah login
    } else {
      echo '<script>alert("Username atau password salah")</script>';
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Si-ADI (Sistem Informasi Arsip Dinamis)</title>
    <script src="https://use.fontawesome.com/b070c8f1df.js"></script>
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/nexa-bold" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32px" href="../assets/logo-web.png">
    <link rel="apple-touch-icon" sizes="180px" href="../assets/logo-web.png">
    <link rel="stylesheet" href="../css/style-nav.css"/>
    <link rel="stylesheet" href="../css/style-login.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>
<body>
  
    <div class="container-form">
        <div class="screen">
            <div class="screen__content">
            <div style="padding-top: 5rem;" class="jumbotron d-flex align-items-center justify-content-center">
                <img src="../assets/logo-login.png" height="130px" />
                </div>
                <form class="login" id="loginform" method="POST" action="login.php">
                    <div class="login__title">Login</div>
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input" name="username" placeholder="Username" required>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" name="password" placeholder="Password" required>
                    </div>
                    <button class="button login__submit" type="submit" id="loginbutton" style="display: flex; align-items: center; justify-content: center;">
                        <span style="display: flex; align-items: center;"><i class="fa-solid fa-right-to-bracket"></i> Login</span>
                    </button>
                </form>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>        
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>        
        </div>
    </div>
</body>
</html>