<?php
header('Content-Type: application/json');
require_once __DIR__ . "/../../../system.php";

try {
    $db = $auth->connectDb();
    //date untuk ambil tanggal, bulan tahun saja
    //group by itu kelompokin si tangglnya
    //order by urutin dari yang paling awal (asc)
    $query = "
        SELECT 
            DATE(Transaction_time) AS tanggal,
            SUM(Total_price) AS total_penjualan
        FROM orders
        WHERE Order_status = 'settlement'
        GROUP BY DATE(Transaction_time)
        ORDER BY tanggal ASC;
    ";



    $harian = $db->prepare($query);
    $harian->execute();
    $dataharian = $harian->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($dataharian);
} catch (Exception $e) {
    // kalau error, kirim response JSON valid juga
    echo json_encode(["error" => $e->getMessage()]);
}