<?php
header('Content-Type: application/json');
require_once __DIR__ . "/system.php";

try {
    $db = $auth->connectDb();

    // Ambil bulan & tanggal sekarang
    $bulan = date('m');
    $tahun = date('Y');
    $hari = date('Y-m-d');

    // Pendapatan bulanan
    $queryBulanan = "
        SELECT SUM(Total_price) AS total_bulanan
        FROM orders
        WHERE Order_status = 'settlement'
          AND MONTH(Transaction_time) = :bulan
          AND YEAR(Transaction_time) = :tahun
    ";
    $stmtBulanan = $db->prepare($queryBulanan);
    $stmtBulanan->bindParam(':bulan', $bulan);
    $stmtBulanan->bindParam(':tahun', $tahun);
    $stmtBulanan->execute();
    // ambil 1 kolom aja gak ambil semua
    $totalBulanan = $stmtBulanan->fetchColumn() ?: 0;

    // Pendapatan harian
    $queryHarian = "
        SELECT SUM(Total_price) AS total_harian
        FROM orders
        WHERE Order_status = 'settlement'
          AND DATE(Transaction_time) = :hari
    ";
    $stmtHarian = $db->prepare($queryHarian);
    $stmtHarian->bindParam(':hari', $hari);
    $stmtHarian->execute();
    // ambil 1 kolom aja gak ambil semua
    $totalHarian = $stmtHarian->fetchColumn() ?: 0;

     function ubahrupiah($angka) {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }

    echo json_encode([
        "bulanan" => ubahrupiah($totalBulanan),
        "harian" => ubahrupiah($totalHarian)
    ]);

} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
