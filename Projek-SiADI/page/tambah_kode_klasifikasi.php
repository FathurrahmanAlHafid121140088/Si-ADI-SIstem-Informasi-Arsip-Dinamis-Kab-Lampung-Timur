<?php
$host = 'localhost'; // Database host
$db = 'si_adi'; // Database name
$user = 'root'; // Database username
$pass = ''; // Database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert new code into the database
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kodeKlasifikasi'])) {
        $kodeKlasifikasi = trim($_POST['kodeKlasifikasi']);
        if (!empty($kodeKlasifikasi)) {
            $stmt = $pdo->prepare("INSERT INTO kode_klasifikasi (kode) VALUES (:kode)");
            $stmt->bindParam(':kode', $kodeKlasifikasi);
            if ($stmt->execute()) {
                echo '<script>alert("Kode klasifikasi berhasil ditambahkan."); window.location.href = "tambahdata.php";</script>';
                exit;
            } else {
                echo '<script>alert("Gagal menambahkan kode klasifikasi."); window.location.href = "tambahdata.php";</script>';
                exit;
            }
        }
    }

    // Delete code from the database
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kode'])) {
        $kode = trim($_POST['kode']);
        if (!empty($kode)) {
            $stmt = $pdo->prepare("DELETE FROM kode_klasifikasi WHERE kode = :kode");
            $stmt->bindParam(':kode', $kode);
            if ($stmt->execute()) {
                echo '<script>alert("Kode klasifikasi berhasil dihapus."); window.location.href = "tambahdata.php";</script>';
                exit;
            } else {
                echo '<script>alert("Gagal menghapus kode klasifikasi."); window.location.href = "tambahdata.php";</script>';
                exit;
            }
        }
    }

    // Fetch data from the `kode_klasifikasi` table
    $stmt = $pdo->prepare("SELECT kode FROM kode_klasifikasi");
    $stmt->execute();
    $kode = $stmt->fetchAll(PDO::FETCH_COLUMN); // Fetch only the `kode` column

} catch (PDOException $e) {
    // Handle error
    echo '<script>alert("Database error: ' . $e->getMessage() . '"); window.location.href = "tambahdata.php";</script>';
    $kode = []; // Ensure $kode is defined in case of an error
}
?>

