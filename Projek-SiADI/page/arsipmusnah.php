<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

include('koneksi.php');

// Hitung total data dengan status 'Musnah'
$count_query = "SELECT COUNT(*) AS total FROM data_dinamis WHERE status = 'Musnah'"; 
$count_result = $conn->query($count_query);

if ($count_result->num_rows > 0) {
    $count_row = $count_result->fetch_assoc();
    $total_musnah = $count_row["total"];
} else {
    $total_musnah = 0;
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
.uiverse {
  position: relative;
  background: var(--third-color);
  color: #000;
  padding: 15px;
  margin: 10px;
  border-radius: 10px;
  width: 150px;
  height: 50px;
  font-size: 17px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transition: all 0.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.tooltip {
  position: absolute;
  top: 0;
  font-size: 14px;
  background: #ffffff;
  color: #ffffff;
  padding: 5px 8px;
  border-radius: 5px;
  box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
  opacity: 0;
  pointer-events: none;
  transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 0.55);
}

.tooltip::before {
  position: absolute;
  content: "";
  height: 8px;
  width: 8px;
  background: #ffffff;
  bottom: -3px;
  left: 50%;
  transform: translate(-50%) rotate(45deg);
  transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.uiverse:hover .tooltip {
  top: -45px;
  opacity: 1;
  visibility: visible;
  pointer-events: auto;
}

svg:hover span,
svg:hover .tooltip {
  text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.1);
}

.uiverse:hover,
.uiverse:hover .tooltip,
.uiverse:hover .tooltip::before {
  background: linear-gradient(320deg, rgb(3, 77, 146), rgb(0, 60, 255));
  color: #ffffff;
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
        <h2 class="h2">Data Arsip Musnah</h2>
        <div class='table-container'>
        <p style="font-weight: 600; font-size: large">Data yang masuk: <?php echo $total_musnah ?></p>
        <table class="table table-bordered border border-dark">
        <thead>
            <tr style="text-align: center; background-color: #3b6eb2; color: #fff">
                <th>No</th>
                <th>Uraian Arsip</th>
                <th>Tahun Arsip</th>
                <th>Tingkat Pengembangan Arsip</th>
                <th>Jumlah Berkas</th>
                <th>Keterangan</th>
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
$sql = "SELECT COUNT(*) FROM data_dinamis WHERE status = 'Musnah'";
$result = $conn->query($sql);
$total_records = $result->fetch_row()[0];

// Menghitung total halaman
$total_pages = ceil($total_records / $limit);

// Fetch records with limit
$sql = "SELECT *
        FROM data_dinamis WHERE status = 'Musnah' ORDER BY tanggal_masuk DESC
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
        $status = 'aktif';
    } elseif ($years_diff < ($row["retensi_aktif"] + $row["retensi_inaktif"])) {
        $status = 'inaktif';
    } else {
        $status = $row["status"];
    }

        echo "<tr>
                <td>" . $no++ . "</td>
                <td>" . $row["uraian_arsip"] . "</td>
                <td>" . $row["tahun_arsip"] . "</td>
                <td>" . $row["tingkat_pengembangan_arsip"] . "</td>
                <td>" . $row["jumlah_berkas"] . "</td>
                <td>" . $row["keterangan"] . "</td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='22'>Tidak ada data yang ditemukan</td></tr>";
}
$conn->close();
?>

        </tbody>
    </table>
    <div class="uiverse" onclick="printTable()">
    <span class="tooltip">Cetak Sekarang !!!</span>
    <span>
    <span><i class="fa-solid fa-print"></i> Cetak</span>
    </span>
</div>

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
  <script>
function printTable() {
  const table = document.querySelector("table");
  const headers = Array.from(table.querySelectorAll("th"));
  const rows = Array.from(table.querySelectorAll("tr")).slice(1); // Get all rows excluding the header

  const colGroups = [
    headers.slice(0, 10), // First 11 columns
    headers.slice(11), // Remaining columns
  ];

  const rowGroups = rows.map((row) => {
    const cells = Array.from(row.querySelectorAll("td"));
    return [
      cells.slice(0, 10), // First 11 columns
      cells.slice(11), // Remaining columns
    ];
  });

  const printWindow = window.open("", "", "height=1000,width=1000");
  printWindow.document.write("<html><head><title>Data Arsip Musnah</title>");

  // Add CSS styles for printing
  printWindow.document.write("<style>");
  printWindow.document.write(
    "table { width: 100%; border-collapse: collapse; }"
  );
  printWindow.document.write("table, th, td { border: 1px solid black; }");
  printWindow.document.write("th, td { padding: 8px; text-align: center; }");
  printWindow.document.write("th { background-color: #fff; color: #000; font-weight: bold; }");
  printWindow.document.write(
    "tr:nth-child(even) { background-color: #f2f2f2; }"
  );
  printWindow.document.write("tr:hover { background-color: #ddd; }");
  printWindow.document.write("h2 { text-align: center; }"); // Style for centering the header
  printWindow.document.write("</style>");

  printWindow.document.write("</head><body>");

  // Add header h2 here
  printWindow.document.write("<h2 class='h2'>Data Arsip Musnah</h2>");

  colGroups.forEach((colGroup, index) => {
    printWindow.document.write("<table>");
    printWindow.document.write("<thead><tr>");
    colGroup.forEach((col) => printWindow.document.write(col.outerHTML));
    printWindow.document.write("</tr></thead>");
    printWindow.document.write("<tbody>");
    rowGroups.forEach((rowGroup) => {
      printWindow.document.write("<tr>");
      rowGroup[index].forEach((cell) =>
        printWindow.document.write(cell.outerHTML)
      );
      printWindow.document.write("</tr>");
    });
    printWindow.document.write("</tbody></table>");
    if (index === 0) {
      printWindow.document.write("<hr>"); // Separator between the two tables
    }
  });

  printWindow.document.write("</body></html>");
  printWindow.document.close();
  printWindow.focus();
  printWindow.print();
}


</script>
</html>