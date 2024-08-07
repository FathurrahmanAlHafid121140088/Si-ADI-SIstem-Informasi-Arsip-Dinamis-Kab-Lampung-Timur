<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Si-ADI (Sistem Informasi Arsip Dinamis)</title>
    <script src="https://use.fontawesome.com/b070c8f1df.js"></script>
    <script
      src="https://kit.fontawesome.com/c8e4d183c2.js"
      crossorigin="anonymous"
    ></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />
    <link href="https://fonts.cdnfonts.com/css/nexa-bold" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="32px" href="../assets/logo-web.png">
    <link rel="apple-touch-icon" sizes="180px" href="../assets/logo-web.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style-nav.css">
    <link rel="stylesheet" href="../css/style-home.css">
    <style>
      .navbar {
        background-color: #3b6eb2;
        color: #fff;
        padding: 1rem;
    }

    .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
    }

    .navbar-brand {
        font-size: 1.5rem;
        text-decoration: none;
        color: #fff;
    }

    .navbar-nav {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: row;
        padding-bottom: 1rem;
        padding-top: 1rem;
    }

    .nav-item {
        margin-left: 1.5rem;
    }

    .nav-link {
        text-decoration: none;
        color: #fff;
        font-size: 1rem;
    }

    .nav-link:hover {
        color: #ddd;
}
.Btn {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  width: 45px;
  height: 45px;
  border: none;
  border-radius: 50%;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition-duration: .3s;
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
  background-color: rgb(255, 65, 65);
}

/* plus sign */
.sign {
  width: 100%;
  transition-duration: .3s;
  display: flex;
  align-items: center;
  justify-content: center;
}

.sign svg {
  width: 17px;
}

.sign svg path {
  fill: white;
}
/* text */
.text-logout {
  position: absolute;
  right: 0%;
  width: 0%;
  opacity: 0;
  color: white;
  font-size: 1.2em;
  font-weight: 400;
  transition-duration: .3s;
}
/* hover effect on button width */
.Btn:hover {
  width: 125px;
  border-radius: 40px;
  transition-duration: .3s;
}

.Btn:hover .sign {
  width: 30%;
  transition-duration: .3s;
  padding-left: 20px;
}
/* hover effect button's text */
.Btn:hover .text-logout {
  opacity: 1;
  width: 70%;
  transition-duration: .3s;
  padding-right: 10px;
}
/* button click effect*/
.Btn:active {
  transform: translate(2px ,2px);
}
.footer-nama {
    color: inherit; 
    text-decoration: none;
    }

.footer-nama:hover {
    color: #fff !important; 
    text-decoration: none !important;
    }
    </style>
</head>
<body>

<nav class="navbar d-flex justify-content-start sticky-top">
<ul class="navbar-nav">
            <li class="nav-item"><a href="index.php" class="nav-link"><span><i class="bi bi-house-door"></i></span> Beranda</a></li>
                <li class="nav-item"><a href="tabel.php" class="nav-link"><span><i class="bi bi-envelope-paper"></i></span> Data Arsip</a></li>
                <li class="nav-item"><a href="tambahdata.php" class="nav-link"><span><i class="bi bi-plus-circle"></i></span> Tambah Arsip</a></li>
                <li class="nav-item"><a href="cari.php" class="nav-link"><span class="bi bi-search"></span> Cari Arsip</a></li>
                <li class="nav-item"><a href="arsipstatis.php" class="nav-link nav-active"><i class="fa-regular fa-folder-closed"></i> Arsip Statis</a></li>
                <li class="nav-item"><a href="arsipmusnah.php" class="nav-link nav-active"><span><i class="fa-solid fa-recycle"></i></span> Arsip Musnah</a></li>
            </ul>
            <ul class="navbar-nav ms-auto p-2">
            <li class="nav-item "><a class="nav-link"><i class="fa fa-user"></i>
            <?php echo $_SESSION['username']; ?></a></li>
            <li class="nav-item "><a href="logout.php">
                <div class="Btn">
                <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
                <div class="text-logout">Logout</div>
                </div>
                </a>
            </li>
            </ul>
    </nav>


<div class="container">
  <div class="jumbotron">
    <img src="../assets/logo-arsip.png" height="150px" />
    <img src="../assets/logo-login.png" height="150px" />
    <img src="../assets/logo-lamtim.png" height="130px" />
  </div>
  <div class="deskripsi">
    <h1>Selamat Datang di Si-ADI <br> 
    (Sistem Informasi Arsip Dinamis) <br>
    Dinas Perpustakaan dan Kearsipan Lampung Timur</h1>
  </div>

  <div class="container-card">
    <article>
      <figure><img class="bupati" src="../assets/IMG_5958.png" alt="Foto bupati"></figure>
      <h2 class="nama-bupati">M. Dawam Rahardjo</h2>
      <p class="jabatan">Bupati Lampung Timur</p>
    </article>

    <article>
      <figure><img class="bupati" src="../assets/IMG_5959.png" alt="Foto Wakil bupati"></figure>
      <h2 class="nama-bupati">Azwar Hadi</h2>
      <p class="jabatan">Wakil Bupati Lampung Timur</p>
    </article>
  </div>
</div>

  <footer>
    <!--paragraph-->
    <p>Terima Kasih Telah Mengunjungi Website Kami</p>
    <!--social-->
    <div class="social-icons">
      <a style="text-decoration: none;" href="https://dispussip.lampungtimurkab.go.id/"><i class="fa-solid fa-earth-asia"></i></a>
      <a style="text-decoration: none;" href= "https://www.instagram.com/dispussip.lamtim/"><i class="fa-brands fa-instagram"></i></a>
      <a style="text-decoration: none;" href="https://www.tiktok.com/@dispussiplamtim?_t=8iAaAGJK8Bd&_r=1"><i class="fa-brands fa-tiktok"></i></a>
      <a style="text-decoration: none;" href="https://www.youtube.com/@dispussiplampungtimur"><i class="fa-brands fa-youtube"></i></a>
      <a style="text-decoration: none;" href="https://www.facebook.com/dispussiplamtimmembaca/"><i class="fa-brands fa-facebook"></i></a>
    </div>
    <!--copyright-->
    <p class="copyright" style="font-weight: 700">
        &copy; PKL Informatika ITERA 2024 by 
        <a class="footer-nama" href="https://www.linkedin.com/in/fathurrahman-al-hafid-a21a7a246/">Fathur</a> & 
        <a class="footer-nama" href="http://www.linkedin.com/in/riksan-cahyowadi">Riksan</a>
    </p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
