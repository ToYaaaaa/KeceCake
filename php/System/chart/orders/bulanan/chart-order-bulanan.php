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
            DATE_FORMAT(Transaction_time, '%Y-%m') AS bulan,
            SUM(Total_price) AS total_penjualan
        FROM orders
        WHERE Order_status = 'settlement'
        GROUP BY DATE_FORMAT(Transaction_time, '%Y-%m')
        ORDER BY bulan ASC;
";

    $bulanan = $db->prepare($query);
    $bulanan->execute();
    $databulanan = $bulanan->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($databulanan);
} catch (Exception $e) {
    // kalau error, kirim response JSON valid juga
    echo json_encode(["error" => $e->getMessage()]);
}