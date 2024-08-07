<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

include('koneksi.php');

$count_query = "SELECT COUNT(*) AS total FROM data_dinamis";
$count_result = $conn->query($count_query);

if ($count_result->num_rows > 0) {
    $count_row = $count_result->fetch_assoc();
    $total_data = $count_row["total"];
} else {
    $total_data = 0;
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['no_surat_arsip'])) {
  $no_surat_arsip = $_GET['no_surat_arsip'];

  // Delete data based on no_surat_arsip
  $query = "DELETE FROM data_dinamis WHERE no_surat_arsip = ?";

  if ($stmt = $conn->prepare($query)) {
      $stmt->bind_param("s", $no_surat_arsip);

      if ($stmt->execute() && $stmt->affected_rows > 0) {
          $_SESSION['message'] = "Data arsip dengan nomor surat arsip $no_surat_arsip berhasil dihapus.";
          $_SESSION['alert_type'] = "success";
      } else {
          $_SESSION['message'] = "Nomor surat arsip tidak ditemukan atau gagal menghapus data arsip.";
          $_SESSION['alert_type'] = "error";
      }

      $stmt->close();
  } else {
      $_SESSION['message'] = "Terjadi kesalahan dalam menyiapkan query.";
      $_SESSION['alert_type'] = "error";
  }

  // Redirect to the same page to refresh the data
  header("Location: " . $_SERVER['PHP_SELF']);
  exit();
}

// Display notification message if exists
if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
  $alertType = $_SESSION['alert_type'];

  echo "<script>
      alert('$message');
  </script>";

  // Remove notification message after display
  unset($_SESSION['message']);
  unset($_SESSION['alert_type']);
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />
    <link href="https://fonts.cdnfonts.com/css/nexa-bold" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="32px" href="../assets/logo-web.png">
    <link rel="apple-touch-icon" sizes="180px" href="../assets/logo-web.png">
    <link rel="stylesheet" href="../css/style-table.css"/>
    <link rel="stylesheet" href="../css/style-form.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style-nav.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        th, td {
        vertical-align: middle; /* Vertical alignment */
        }
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
    <img class="ps-4" src="../assets/logo-lamtim.png" alt="Logo-Lamtim" height="100px">
    <ul class="navbar-nav">
            <li class="nav-item"><a href="home.php" class="nav-link"><span><i class="bi bi-house-door"></i></span> Beranda</a></li>
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

    <div class="table">
        <h2 class="h2">Data Arsip Dinamis</h2>
        <div class='table-container'>
    <p style="font-weight: 600; font-size: large">Data yang masuk: <?php echo $total_data ?></p>
    <table class="table table-bordered border border-dark ">
        <thead>
            <tr style="text-align: center; background-color: #3b6eb2; color: #fff">
                <th>No</th>
                <th>Tahun Arsip</th>
                <th>SKPD</th>
                <th>Pokok Masalah</th>
                <th>Kode Klasifikasi</th>
                <th>Uraian Arsip</th>
                <th>Tanggal Masuk</th> <!-- Kolom baru -->
                <th>No Urut Berkas</th>
                <th>No Box</th>
                <th>No Rak</th>
                <th>Bentuk Penataan</th>
                <th>Nama Pemberkas</th>
                <th>No Surat Arsip</th>
                <th>Indeks Judul Arsip</th>
                <th>Tingkat Pengembangan Arsip</th>
                <th>Nilai Guna Arsip</th>
                <th>Kondisi Arsip</th>
                <th>Status</th>
                <th>Asal Berkas</th>
                <th>Jumlah Berkas</th>
                <th>Keterangan</th>
                <th>Retensi Aktif</th>
                <th>Retensi Inaktif</th>
                <th>Lampirkan File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php

// Set current page and limit
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;
$no = $start + 1;
// Mengambil total jumlah data
$sql = "SELECT COUNT(*) FROM data_dinamis";
$result = $conn->query($sql);
$total_records = $result->fetch_row()[0];

// Menghitung total halaman
$total_pages = ceil($total_records / $limit);

// Fetch records with limit
$sql = "SELECT tahun_arsip, skpd, pokok_masalah, kode_klasifikasi, uraian_arsip, tanggal_masuk, no_urut_berkas, no_box, no_rak, bentuk_penataan, nama_pemberkas, no_surat_arsip, indeks_judul_arsip, tingkat_pengembangan_arsip, nilai_guna_arsip, kondisi_arsip, status, pemerian_berkas, jumlah_berkas, keterangan, retensi_aktif, retensi_inaktif, lampirkan_file 
        FROM data_dinamis ORDER BY tanggal_masuk DESC
        LIMIT $start, $limit";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    // Menghitung status berdasarkan logika yang diberikan
    $current_date = new DateTime();
    $tanggal_masuk_date = new DateTime($row["tanggal_masuk"]);
    $interval = $current_date->diff($tanggal_masuk_date);
    $years_diff = $interval->y;

    if ($years_diff < $row["retensi_aktif"]) {
        $status = 'Aktif';
    } elseif ($years_diff < ($row["retensi_aktif"] + $row["retensi_inaktif"])) {
        $status = 'Inaktif';
    } else {
        $status = $row["status"];
    }

    echo "<tr>
    <td>" . $no++ . "</td>
    <td>" . $row["tahun_arsip"] . "</td>
    <td>" . $row["skpd"] . "</td>
    <td>" . $row["pokok_masalah"] . "</td>
    <td>" . $row["kode_klasifikasi"] . "</td>
    <td>" . $row["uraian_arsip"] . "</td>
    <td>" . $row["tanggal_masuk"] . "</td>
    <td>" . $row["no_urut_berkas"] . "</td>
    <td>" . $row["no_box"] . "</td>
    <td>" . $row["no_rak"] . "</td>
    <td>" . $row["bentuk_penataan"] . "</td>
    <td>" . $row["nama_pemberkas"] . "</td>
    <td>" . $row["no_surat_arsip"] . "</td>
    <td>" . $row["indeks_judul_arsip"] . "</td>
    <td>" . $row["tingkat_pengembangan_arsip"] . "</td>
    <td>" . $row["nilai_guna_arsip"] . "</td>
    <td>" . $row["kondisi_arsip"] . "</td>
    <td>" . $status . "</td>
    <td>" . $row["pemerian_berkas"] . "</td>
    <td>" . $row["jumlah_berkas"] . "</td>
    <td>" . $row["keterangan"] . "</td>
    <td>" . htmlspecialchars($row["retensi_aktif"]) . " Tahun</td>
    <td>" . htmlspecialchars($row["retensi_inaktif"]) . " Tahun</td>
    <td><a href='/Projek-SiADI/uploads/" . $row["lampirkan_file"] . "'>Lihat File</a></td>
    <td>
        <a href='edit.php?no_surat_arsip=" . $row["no_surat_arsip"] . "' 
          style='text-decoration: none; color: blue;'>
        <button type='button' style='background-color: blue; color: #fff;'>Edit</button>
        </a>
        <a href='tabel.php?no_surat_arsip=" . $row["no_surat_arsip"] . "' 
          onclick='return confirm(\"Anda yakin ingin menghapus data ini?\")'
          style='text-decoration: none; color: red;'>
        <button type='button' style='background-color: red; color:#fff;'>Hapus</button>
        </a>
    </td>
    </tr>";
    }
} else {
    echo "<tr><td colspan='22'>Tidak ada data yang ditemukan</td></tr>";
}
$conn->close();
?>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        <p>Halaman: <?php echo $page; ?> dari <?php echo $total_pages; ?></p>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" class="<?php if($page == $i) echo 'active'; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
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
  </body>
</html>