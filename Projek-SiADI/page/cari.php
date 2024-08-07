<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

include('koneksi.php');
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

    <div class="container-cari">
        <h2 class="h2">Cari Data Arsip</h2>
        <form method="GET" action="cari.php" class="search_box">
            <div class="search">
                <div style="width: 30%" class="select_area">
                <i class="fa-solid fa-layer-group"></i>
                    <div class="text">Cari Data</div>
                </div>
                <div class="text_and-icon">
                    <input type="text" name="search" class="search_text" id="search_text" placeholder="Masukkan kata kunci ...">
                </div>
                <button type="submit" class="search_button"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </div>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $searchKeyword = $_GET['search']; // Mengambil kata kunci pencarian dari form

    // Memecah kata kunci menjadi array
    $keywords = explode(' ', $searchKeyword);

    // Membuat bagian query untuk setiap kata kunci
    $conditions = [];
    foreach ($keywords as $keyword) {
        $conditions[] = "(
            tahun_arsip LIKE ? OR
            skpd LIKE ? OR
            pokok_masalah LIKE ? OR
            kode_klasifikasi LIKE ? OR
            uraian_arsip LIKE ? OR
            tanggal_masuk LIKE ? OR
            no_urut_berkas LIKE ? OR
            no_box LIKE ? OR
            no_rak LIKE ? OR
            bentuk_penataan LIKE ? OR
            nama_pemberkas LIKE ? OR
            no_surat_arsip LIKE ? OR
            indeks_judul_arsip LIKE ? OR
            tingkat_pengembangan_arsip LIKE ? OR
            nilai_guna_arsip LIKE ? OR
            kondisi_arsip LIKE ? OR
            status LIKE ? OR
            pemerian_berkas LIKE ? OR
            jumlah_berkas LIKE ? OR
            keterangan LIKE ?
        )";
    }

    // Menggabungkan semua kondisi dengan AND
    $conditionsQuery = implode(' AND ', $conditions);
    $query = "SELECT * FROM data_dinamis WHERE $conditionsQuery ORDER BY tanggal_masuk DESC";

    // Pagination setup
    $limit = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    // Modify query to include LIMIT and OFFSET for pagination
    $query .= " LIMIT ?, ?"; // Using LIMIT and OFFSET directly in query

    // Menyiapkan query
    if ($stmt = $conn->prepare($query)) {
        // Membuat parameter wildcard untuk setiap kata kunci
        $params = [];
        foreach ($keywords as $keyword) {
            $wildcardKeyword = '%' . $keyword . '%';
            $params = array_merge($params, array_fill(0, 20, $wildcardKeyword));
        }

        // Menambahkan LIMIT dan OFFSET ke parameter
        $params[] = $start;
        $params[] = $limit;

        // Menyiapkan tipe parameter
        $types = str_repeat('s', count($params) - 2) . 'ii'; // Semua parameter wildcard adalah string, OFFSET dan LIMIT adalah integer

        // Mengikat parameter wildcard
        $stmt->bind_param($types, ...$params);

        // Menjalankan query
        $stmt->execute();
        $result = $stmt->get_result();

        // Menghitung jumlah hasil untuk pagination
        $sql_count = "SELECT COUNT(*) FROM data_dinamis WHERE $conditionsQuery";
        if ($stmt_count = $conn->prepare($sql_count)) {
            // Membuat parameter wildcard untuk setiap kata kunci
            $params_count = [];
            foreach ($keywords as $keyword) {
                $wildcardKeyword = '%' . $keyword . '%';
                $params_count = array_merge($params_count, array_fill(0, 20, $wildcardKeyword));
            }
            $types_count = str_repeat('s', count($params_count)); // Semua parameter adalah string

            // Mengikat parameter wildcard
            $stmt_count->bind_param($types_count, ...$params_count);

            // Menjalankan query
            $stmt_count->execute();
            $stmt_count->bind_result($total_records);
            $stmt_count->fetch();
            $total_pages = ceil($total_records / $limit);

            // Menampilkan hasil pencarian
            if ($result->num_rows > 0) {
                echo "<style>
                    .table-container {
                        width: 90%;
                        overflow-x: auto;
                        margin: 0 auto;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    th, td {
                        padding: 10px;
                        text-align: left;
                        border: 1px solid #000;
                        text-align: center;
                    }
                    th {
                        background-color: var(--primary-color);
                        color: #fff;
                    }
                    tr:nth-child(even) {
                        background-color: #e5e6e7;
                    }
                    tr:nth-child(odd) {
                        background-color: #f2efef;
                    }
                    td:hover {
                        background-color: var(--primary-color);
                        color: #fff;
                    }
                    a {
                        color: #1a73e8;
                        text-decoration: none;
                    }
                    a:hover {
                        text-decoration: underline;
                    }
                    p{
                        font-weight: 600;
                        font-size: large;
                    }
                    .pagination {
                        display: flex;
                        justify-content: center;
                        margin-top: 20px;
                    }
                    .pagination a {
                        margin: 0 5px;
                        padding: 8px 16px;
                        text-decoration: none;
                        border: 1px solid #ccc;
                        color: #333;
                        transition: background-color 0.3s;
                    }
                    .pagination a:hover {
                        background-color: #ddd;
                    }
                    .pagination a.active {
                        background-color: #007bff;
                        color: white;
                        border: 1px solid #007bff;
                    }
                </style>";

                echo "<div class='table-container'>
                    <p>Data yang ditemukan: $total_records</p>
                    <table border='1'>
                        <thead>
                            <tr>
                                <th>Tahun Arsip</th>
                                <th>SKPD</th>
                                <th>Pokok Masalah</th>
                                <th>Kode Klasifikasi</th>
                                <th>Uraian Arsip</th> <!-- Kolom baru -->
                                <th>Tanggal Masuk</th>
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
                                <th>Pemerian Berkas</th>
                                <th>Jumlah Berkas</th>
                                <th>Keterangan</th>
                                <th>Retensi Aktif</th>
                                <th>Retensi Inaktif</th>
                                <th>Lampirkan File</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>";

                while ($row = $result->fetch_assoc()) {
                    // Logika untuk menentukan status
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
                        <td>" . htmlspecialchars($row["tahun_arsip"]) . "</td>
                        <td>" . htmlspecialchars($row["skpd"]) . "</td>
                        <td>" . htmlspecialchars($row["pokok_masalah"]) . "</td>
                        <td>" . htmlspecialchars($row["kode_klasifikasi"]) . "</td>
                        <td>" . htmlspecialchars($row["uraian_arsip"]) . "</td> <!-- Kolom baru -->
                        <td>" . htmlspecialchars($row["tanggal_masuk"]) . "</td>
                        <td>" . htmlspecialchars($row["no_urut_berkas"]) . "</td>
                        <td>" . htmlspecialchars($row["no_box"]) . "</td>
                        <td>" . htmlspecialchars($row["no_rak"]) . "</td>
                        <td>" . htmlspecialchars($row["bentuk_penataan"]) . "</td>
                        <td>" . htmlspecialchars($row["nama_pemberkas"]) . "</td>
                        <td>" . htmlspecialchars($row["no_surat_arsip"]) . "</td>
                        <td>" . htmlspecialchars($row["indeks_judul_arsip"]) . "</td>
                        <td>" . htmlspecialchars($row["tingkat_pengembangan_arsip"]) . "</td>
                        <td>" . htmlspecialchars($row["nilai_guna_arsip"]) . "</td>
                        <td>" . htmlspecialchars($row["kondisi_arsip"]) . "</td>
                        <td>" . htmlspecialchars($status) . "</td> <!-- Update kolom status berdasarkan logika -->
                        <td>" . htmlspecialchars($row["pemerian_berkas"]) . "</td>
                        <td>" . htmlspecialchars($row["jumlah_berkas"]) . "</td>
                        <td>" . htmlspecialchars($row["keterangan"]) . "</td>
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

                echo "  </tbody>
                    </table>
                    <div class='pagination'>";
                    
                // Display pagination links
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='?search=" . urlencode($searchKeyword) . "&page=$i' class='" . ($page == $i ? 'active' : '') . "'>$i</a>";
                }

                echo "  </div>
                </div>";

            } else {
                echo "<script>alert('Tidak ada hasil yang ditemukan');</script>";
            }

            // Menutup statement
            $stmt->close();
            $stmt_count->close();
        } else {
            echo "<script>alert('Terjadi kesalahan dalam menyiapkan query hitung.');</script>";
        }
    } else {
        echo "<script>alert('Terjadi kesalahan dalam menyiapkan query pencarian.');</script>";
    }
}
?>


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