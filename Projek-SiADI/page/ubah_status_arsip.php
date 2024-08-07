<?php
$host = 'localhost';
$db = 'si_adi';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ambil data dari tabel
    $stmt = $pdo->prepare("SELECT `no_surat_arsip`, `tanggal_masuk`, `retensi_aktif`, `retensi_pasif`, `status` FROM `data_dinamis`");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $row) {
        $statusBaru = tentukanStatus($row['tanggal_masuk'], $row['retensi_aktif'], $row['retensi_pasif'], $row['status']);

        // Update status di tabel
        $updateStmt = $pdo->prepare("UPDATE `data_dinamis` SET `status` = :status WHERE `no_surat_arsip` = :no_surat_arsip");
        $updateStmt->bindParam(':status', $statusBaru);
        $updateStmt->bindParam(':no_surat_arsip', $row['no_surat_arsip']);
        $updateStmt->execute();
    }

    echo "Status berhasil diperbarui.";

} catch (PDOException $e) {
    echo 'Database error: ' . $e->getMessage();
}

function tentukanStatus($tanggal_masuk, $retensi_aktif, $retensi_pasif, $status) {
    $tanggalMasuk = new DateTime($tanggal_masuk);
    $tanggalSekarang = new DateTime();

    $interval = $tanggalMasuk->diff($tanggalSekarang);
    $lamaSimpan = $interval->y * 365 + $interval->m * 30 + $interval->d;

    if ($lamaSimpan < $retensi_aktif) {
        return 'aktif';
    } elseif ($lamaSimpan < ($retensi_aktif + $retensi_pasif)) {
        return 'inaktif';
    } else {
        return $status;
    }
}
?>
