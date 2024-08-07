<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Sertakan file koneksi.php
include('koneksi.php'); // Pastikan ini sudah terhubung dengan database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $tahun_arsip = $_POST['tahun-arsip'];
    $skpd = $_POST['skpd'];
    $pokok_masalah = $_POST['pokok-masalah'];
    $kode_klasifikasi = $_POST['kode-klasifikasi'];
    $uraian_arsip = $_POST['uraian-arsip']; // Kode klasifikasi yang dipilih
    $no_urut_berkas = $_POST['no-urut-berkas'];
    $no_box = $_POST['no-box'];
    $no_rak = $_POST['no-rak'];
    $bentuk_penataan = $_POST['bentuk-penataan'];
    $nama_pemberkas = $_POST['nama-pemberkas'];
    $no_surat_arsip = $_POST['no-surat-arsip'];
    $indeks_judul_arsip = $_POST['indeks-judul-arsip'];
    $tingkat_pengembangan_arsip = $_POST['tingkat-perkembangan-arsip'];
    $nilai_guna_arsip = $_POST['nilai-guna-arsip'];
    $kondisi_arsip = $_POST['kondisi-arsip'];
    $status = $_POST['status'];
    $pemerian_berkas = $_POST['pemerian-berkas'];
    $jumlah_berkas = $_POST['jumlah-berkas'];
    $keterangan = $_POST['keterangan'];
    $retensi_aktif = (int)$_POST['retensi-aktif'];
    $retensi_inaktif = (int)$_POST['retensi-inaktif'];
    $tanggal_masuk = $_POST['tanggal-masuk']; // Kolom baru

    // Mengambil file lampiran
    if (isset($_FILES['lampirkan-file'])) {
        $lampirkan_file = $_FILES['lampirkan-file']['name'];
        $target_dir = "C:/xampp/htdocs/Projek-SiADI/uploads/";
        $target_file = $target_dir . basename($lampirkan_file);
    
        // Get the file extension
        $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        // Define allowed file types
        $allowed_types = array('pdf');
    
        // Check if the file is a PDF
        if (in_array($file_extension, $allowed_types)) {
            // Optionally, check the file size (e.g., limit to 5MB)
            if ($_FILES['lampirkan-file']['size'] <= 5000000) { // 5MB
                // Move the file to the target directory
                if (move_uploaded_file($_FILES['lampirkan-file']['tmp_name'], $target_file)) {
                    echo '<script>alert("File berhasil diunggah.")</script>';
                } else {
                    echo '<script>alert("Maaf, terdapat kesalahan saat mengunggah file Anda.")</script>';
                }
            } else {
                echo '<script>alert("File terlalu besar. Maksimal ukuran file adalah 5MB.")</script>';
            }
        } else {
            echo '<script>alert("Hanya file PDF yang diperbolehkan.")</script>';
        }
    } else {
        echo '<script>alert("Tidak ada file yang diunggah.")</script>';
    }

    // Menghitung status berdasarkan logika yang diberikan
    $current_date = new DateTime();
    $tanggal_masuk_date = new DateTime($tanggal_masuk);
    $interval = $current_date->diff($tanggal_masuk_date);
    $years_diff = $interval->y;

    if ($years_diff < $retensi_aktif) {
        $status = 'aktif';
    } elseif ($years_diff < ($retensi_aktif + $retensi_inaktif)) {
        $status = 'inaktif';
    }

    // Menyimpan data ke dalam database
    $sql = "INSERT INTO data_dinamis (tahun_arsip, skpd, pokok_masalah, kode_klasifikasi, uraian_arsip, no_urut_berkas, no_box, no_rak, bentuk_penataan, nama_pemberkas, no_surat_arsip, indeks_judul_arsip, tingkat_pengembangan_arsip, nilai_guna_arsip, kondisi_arsip, status, pemerian_berkas, jumlah_berkas, keterangan, retensi_aktif, retensi_inaktif, tanggal_masuk, lampirkan_file)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssssssssss", $tahun_arsip, $skpd, $pokok_masalah, $kode_klasifikasi, $uraian_arsip, $no_urut_berkas, $no_box, $no_rak, $bentuk_penataan, $nama_pemberkas, $no_surat_arsip, $indeks_judul_arsip, $tingkat_pengembangan_arsip, $nilai_guna_arsip, $kondisi_arsip, $status, $pemerian_berkas, $jumlah_berkas, $keterangan, $retensi_aktif, $retensi_inaktif, $tanggal_masuk, $lampirkan_file);

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = "Data berhasil ditambahkan";
        header("Location: tambahdata.php");
        exit();
    } else {
        $_SESSION['flash_message'] = "Error: " . $stmt->error;
        header("Location: tambahdata.php");
        exit();
    }
}

if (isset($_SESSION['flash_message'])) {
    echo '<script type="text/javascript">';
    echo 'alert("' . $_SESSION['flash_message'] . '");';
    echo '</script>';
    
    // Hapus pesan flash setelah ditampilkan
    unset($_SESSION['flash_message']);
}


$sql = "SELECT kode FROM kode_klasifikasi";
$result = $conn->query($sql);

$kode = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kode[] = $row['kode'];
    }
}

$conn->close();

$host = 'sql313.infinityfree.com'; // Database host
$db = 'if0_36970998_si_adi'; // Database name
$user = 'if0_36970998'; // Database username
$pass = 'SiADiDispussip'; // Database password

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get POST data
        $kodeKlasifikasi = trim($_POST['kodeKlasifikasi']);

        if (!empty($kodeKlasifikasi)) {
            // Insert new code into the database
            $stmt = $pdo->prepare("INSERT INTO kode_keasipan (kode) VALUES (:kode)");
            $stmt->bindParam(':kode', $kodeKlasifikasi);
            $stmt->execute();

            // Set flash message
            $_SESSION['flash_message'] = 'Data berhasil diinputkan';
        }

        // Redirect back to the main page
        header('Location: tambahdata.php');
        exit();
    }
} catch (PDOException $e) {
    // Handle exception
    echo 'Connection failed: ' . $e->getMessage();
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
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
  font-weight: 300;
  transition-duration: 0.3s;
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

<div class="modal-klasifikasi" style="  display: flex; justify-content: space-between;">
<!-- Modal Structure -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kode Klasifikasi</h5>
            </div>
            <div class="modal-body">
                <form action="tambah_kode_klasifikasi.php" method="post" id="formKodeKlasifikasi">
                    <div class="mb-3">
                        <label for="newKodeKlasifikasi" class="form-label">Kode Klasifikasi:</label>
                        <input type="text" class="form-control" id="newKodeKlasifikasi" name="kodeKlasifikasi" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk memilih kode -->
<!-- Modal untuk Memilih Kode Klasifikasi -->
<div class="modal fade" id="kodeModal" tabindex="-1" role="dialog" aria-labelledby="kodeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kodeModalLabel">Pilih Kode Klasifikasi</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari Kode Klasifikasi">
                </div>
                <table class="table table-striped" id="kodeTable">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($kode)): ?>
                            <?php foreach ($kode as $kodeItem): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($kodeItem); ?></td>
                                    <td>
                                        <a type="button" class="btn btn-primary select-code" data-code="<?php echo htmlspecialchars($kodeItem); ?>">Pilih</a>
                                        <form action="tambah_kode_klasifikasi.php" method="POST" style="display:inline;" onsubmit="return confirmDeletion();">
                                            <input type="hidden" name="kode" value="<?php echo htmlspecialchars($kodeItem); ?>">
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2">Tidak ada data.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>

<?php
        include 'tambah_kode_klasifikasi.php';
        ?>

<div class="container-cari">
<h2 class="h2">Tambah Data Arsip</h2>
<form class="cari" method="POST" action="tambahdata.php" enctype="multipart/form-data">
    <div class="field" tabindex="1">
        <label for="tahun-arsip">
            <i class="fa-solid fa-calendar-days"></i>Tahun Arsip
        </label>
        <input id="tahun-arsip" name="tahun-arsip" style="color: #000" type="text" placeholder="Masukkan Tahun Arsip" required>
    </div>
    <div class="field" tabindex="2">
        <label for="skpd">
            <i class="fa-regular fa-building"></i>SKPD
        </label>
        <input id="skpd" name="skpd" style="color: #000" type="text" placeholder="Masukkan SKPD" required>
    </div>
    <div class="field" tabindex="3">
        <label for="pokok-masalah">
            <i class="fa-solid fa-circle-exclamation"></i>Pokok Masalah
        </label>
        <input id="pokok-masalah" name="pokok-masalah" style="color: #000" type="text" placeholder="Masukkan Pokok Masalah" required>
    </div>
    <div class="field" tabindex="4">
    <label for="kode-klasifikasi">
        <i class="fa-solid fa-list"></i>Kode Klasifikasi
    </label>
    <input type="text" id="kode-klasifikasi" name="kode-klasifikasi" readonly required>
    <input type="hidden" id="selectedKode" name="kode-klasifikasi" value="" required>
    <div class="btn-modal d-flex flex-row text-decoration-none">
        <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin: 1rem; background-color: #00FF00; color: #000; border-radius: 1rem; padding-block: 0.5rem">Tambahkan Kode Klasifikasi</a>
        <a class="btn btn-primary" data-toggle="modal" data-target="#kodeModal" style="margin: 1rem; background-color: #e1b132; color: #000; border-radius: 1rem; padding-block: 0.5rem">Pilih Kode Klasifikasi</a>
    </div>
</div>
<div class="field" tabindex="9">
    <label for="uraian-arsip">
        <i class="fa-solid fa-info-circle"></i>Uraian Arsip
    </label>
        <input id="uraian-arsip" name="uraian-arsip" style="color: #000" type="text" placeholder="Masukkan Uraian Arsip" required>
    </div>
<div class="field" tabindex="5">
    <label for="tanggal_masuk">
        <span><i class="bi bi-calendar-date"></i></span>Tanggal Input Berkas
    </label>
    <input id="tanggal-masuk" name="tanggal-masuk" style="color: #000" type="date" placeholder="Masukkan Tanggal Input Berkas" required>
</div>
    <div class="field" tabindex="5">
        <label for="no-urut-berkas">
            <span><i class="bi bi-file-binary"></i></span>No Urut Berkas
        </label>
        <input id="no-urut-berkas" name="no-urut-berkas" style="color: #000" type="text" placeholder="Masukkan No Urut Berkas" required>
    </div>
    <div class="field" tabindex="6">
        <label for="no-box">
            <i class="fa-solid fa-boxes-stacked"></i>No BOX
        </label>
        <input id="no-box" name="no-box" style="color: #000" type="text" placeholder="Masukkan No BOX" required>
    </div>
    <div class="field" tabindex="7">
        <label for="no-rak">
            <span><i class="bi bi-bookshelf"></i></span>No RAK
        </label>
        <input id="no-rak" name="no-rak" style="color: #000" type="text" placeholder="Masukkan No RAK" required>
    </div>
    <div class="field" tabindex="8">
        <label for="bentuk-penataan">
            <span><i class="bi bi-ui-radios-grid"></i></span>Bentuk Penataan
        </label>
        <input id="bentuk-penataan" name="bentuk-penataan" style="color: #000" type="text" placeholder="Masukkan Bentuk Penataan" required>
    </div>
    <div class="field" tabindex="9">
        <label for="nama-pemberkas">
            <span><i class="bi bi-person"></i></span>Nama Pemberkas
        </label>
        <input id="nama-pemberkas" name="nama-pemberkas" style="color: #000" type="text" placeholder="Masukkan Nama Pemberkas" required>
    </div>
    <div class="field" tabindex="10">
        <label for="no-surat-arsip">
            <span><i class="bi bi-123"></i></span>No Surat Arsip
        </label>
        <input id="no-surat-arsip" name="no-surat-arsip" style="color: #000" type="text" placeholder="Masukkan No Surat Arsip" required>
    </div>
    <div class="field" tabindex="11">
        <label for="indeks-judul-arsip">
            <i class="fa-solid fa-heading"></i>Indeks/Judul Arsip
        </label>
        <textarea id="indeks-judul-arsip" name="indeks-judul-arsip" style="padding-bottom: 2rem; color: #000;" placeholder="Masukkan Indeks/Judul Arsip" required></textarea>
    </div>
    <div class="field" tabindex="12">
        <label for="tingkat-perkembangan-arsip">
            <i class="fa-solid fa-layer-group"></i>Tingkat Perkembangan Arsip
        </label>
        <select id="tingkat-perkembangan-arsip" name="tingkat-perkembangan-arsip" required>
            <option value="" disabled selected>Pilih Tingkat Perkembangan Arsip</option>
            <option value="Asli">Asli</option>
            <option value="Copy">Copy</option>
            <option value="Tembusan">Tembusan</option>
        </select>
    </div>
    <div class="field" tabindex="13">
        <label for="nilai-guna-arsip">
            <i class="fa-solid fa-ranking-star"></i>Nilai Guna Arsip
        </label>
        <select id="nilai-guna-arsip" name="nilai-guna-arsip" required>
            <option value="" disabled selected>Pilih Nilai Guna Arsip</option>
            <option value="Administrasi">Administrasi</option>
            <option value="Keuangan">Keuangan</option>
            <option value="Hukum">Hukum</option>
            <option value="Ilmiah & Teknologi">Ilmiah & Teknologi</option>
            <option value="Kebuktian/evidental">Kebuktian/evidental</option>
            <option value="Informasi">Informasi</option>
        </select>
    </div>
    <div class="field" tabindex="14">
        <label for="kondisi-arsip">
            <i class="fa fa-file-archive-o"></i>Kondisi Arsip
        </label>
        <input id="kondisi-arsip" name="kondisi-arsip" style="color: #000" type="text" placeholder="Masukkan Kondisi Arsip" required>
    </div>
    <div class="field" tabindex="14">
        <label for="retensi-aktif">
            <i class="fa-regular fa-clock"></i>Retensi Aktif
        </label>
        <input id="retensi-aktif" name="retensi-aktif" style="color: #000" type="text" placeholder="Masukkan Retensi Aktif (angka saja. Contoh: 3)" required>
    </div>
    <div class="field" tabindex="14">
        <label for="retensi-inaktif">
        <i class="fa-solid fa-clock"></i>Retensi Inaktif
        </label>
        <input id="retensi-inaktif" name="retensi-inaktif" style="color: #000" type="text" placeholder="Masukkan Retensi Inaktif (angka saja. Contoh: 3)" required>
    </div>
    <div class="field" tabindex="15">
        <label for="status">
            <i class="fa-solid fa-chart-line"></i>Status
        </label>
        <select id="status" name="status" required>
            <option value="" disabled selected>Pilih Status Berkas</option>
            <option value="Statis">Statis</option>
            <option value="Musnah">Musnah</option>
        </select>
    </div>
    <div class="field" tabindex="16">
        <label for="pemerian-berkas">
            <i class="fa-solid fa-file-signature"></i>Asal Berkas
        </label>
        <textarea id="pemerian-berkas" name="pemerian-berkas" style="padding-bottom: 2rem; color: #000;" placeholder="Masukkan Asal Berkas" required></textarea>
    </div>
    <div class="field" tabindex="17">
        <label for="jumlah-berkas">
            <i class="fa-solid fa-arrow-up-1-9"></i>Jumlah Berkas
        </label>
        <input id="jumlah-berkas" name="jumlah-berkas" style="color: #000" type="text" placeholder="Masukkan Jumlah Berkas" required>
    </div>
    <div class="field" tabindex="18">
        <label for="keterangan">
            <i class="fa-solid fa-t"></i>Keterangan
        </label>
        <input id="keterangan" name="keterangan" style="color: #000" type="text" placeholder="Masukkan Keterangan" required>
    </div>
    <div class="field" tabindex="19">
    <label for="lampirkan-file">
        <i class="fa-solid fa-file-upload"></i>Lampirkan File
    </label>
    <input id="lampirkan-file" name="lampirkan-file" style="color: #000" type="file" required title="Inputkan file berformat PDF atau JPG saja">
    <span id="file-format-info" style="font-size: 14px; color: #fff; margin-left: 10px; ">*Inputkan file berformat PDF/JPG saja</span>
</div>

    <div class="field" tabindex="20" style="display: flex; align-items: center; justify-content: center; gap: 1rem">
    <button style="background-color: 	#00FF00; color: #000" type="submit"><i class="fa-solid fa-upload"></i>Tambahkan Data</button>
    <button style="background-color: red; color: #fff;" class="btn-reset" type="reset"><i class="fa-solid fa-undo"></i>Reset</button></div>
    </div>
</form>
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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        populateDropdownFromLocalStorage();
    });

    function addNewKodeKlasifikasi() {
        var newKode = document.getElementById("newKodeKlasifikasi").value.trim();

        if (newKode === "") {
            alert("Kode Klasifikasi tidak boleh kosong.");
            return;
        }

        // Simpan ke Local Storage
        var existingCodes = JSON.parse(localStorage.getItem("kodeKlasifikasi") || "[]");
        existingCodes.push(newKode);
        localStorage.setItem("kodeKlasifikasi", JSON.stringify(existingCodes));

        // Tambahkan ke dropdown dan urutkan
        var kodeKlasifikasiSelect = document.getElementById("kode-klasifikasi");
        var newOption = document.createElement("option");
        newOption.value = newKode;
        newOption.text = newKode;

        // Tambahkan opsi ke dropdown
        kodeKlasifikasiSelect.appendChild(newOption);

        // Ambil semua opsi dalam dropdown dan urutkan
        var options = Array.from(kodeKlasifikasiSelect.getElementsByTagName('option'));
        options.sort((a, b) => a.text.localeCompare(b.text));

        // Bersihkan dropdown dan tambahkan opsi yang sudah diurutkan
        kodeKlasifikasiSelect.innerHTML = "";
        options.forEach(option => kodeKlasifikasiSelect.appendChild(option));

        // Tampilkan alert bahwa kode baru telah berhasil ditambahkan
        alert(`Kode Klasifikasi baru "${newKode}" telah berhasil ditambahkan.`);

        // Reset input dan tutup modal
        document.getElementById("newKodeKlasifikasi").value = "";
        var modalElement = document.getElementById('exampleModal');
        var modal = bootstrap.Modal.getInstance(modalElement);
        modal.hide();
    }

    function populateDropdownFromLocalStorage() {
        var kodeKlasifikasiSelect = document.getElementById("kode-klasifikasi");
        var existingCodes = JSON.parse(localStorage.getItem("kodeKlasifikasi") || "[]");

        existingCodes.forEach(function(code) {
            var newOption = document.createElement("option");
            newOption.value = code;
            newOption.text = code;
            kodeKlasifikasiSelect.appendChild(newOption);
        });

        // Urutkan opsi yang sudah ada di dropdown
        var options = Array.from(kodeKlasifikasiSelect.getElementsByTagName('option'));
        options.sort((a, b) => a.text.localeCompare(b.text));

        // Bersihkan dropdown dan tambahkan opsi yang sudah diurutkan
        kodeKlasifikasiSelect.innerHTML = "";
        options.forEach(option => kodeKlasifikasiSelect.appendChild(option));
    }
    document.addEventListener('DOMContentLoaded', function() {
        // Tambahkan event listener pada tombol 'Pilih' di dalam modal
        document.querySelectorAll('.select-code').forEach(button => {
            button.addEventListener('click', function() {
                const kode = this.getAttribute('data-code');
                document.getElementById('selectedKode').value = kode;
                document.getElementById('kode-klasifikasi').value = kode;
                $('#kodeModal').modal('hide'); // Menutup modal setelah memilih kode
            });
        });
    });
    document.getElementById('searchInput').addEventListener('keyup', function() {
    var searchValue = this.value.toLowerCase();
    var rows = document.querySelectorAll('#kodeTable tbody tr');

    rows.forEach(function(row) {
        var kodeCell = row.querySelector('td').textContent.toLowerCase();
        if (kodeCell.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

    function confirmDeletion() {
        return confirm("Apakah Anda yakin ingin menghapus kode klasifikasi ini?");
    }
</script>


</html>