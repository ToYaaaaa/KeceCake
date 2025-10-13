<?php
header('Content-Type: application/json');
require_once __DIR__ . "/../../system.php";

try {
    $db = $auth->connectDb();

    // ambil bulan & tahun dari query string ?bulan=10&tahun=2025
    $bulan = isset($_GET['bulan']) ? (int)$_GET['bulan'] : date('m');
    $tahun = isset($_GET['tahun']) ? (int)$_GET['tahun'] : date('Y');

    //date untuk ambil tanggal, bulan tahun saja
    //group by itu kelompokin si tangglnya
    //order by urutin dari yang paling banyak dijualnya (desc)
    $query = "SELECT oi.Product_name, SUM(oi.Quantity) AS total_terjual FROM order_items oi JOIN orders o ON oi.Order_id = o.Order_id 
    WHERE o.Order_status = 'settlement'
        AND MONTH(o.Transaction_time) = :bulan
        AND YEAR(o.Transaction_time) = :tahun
        GROUP BY oi.Product_name
        ORDER BY total_terjual DESC;
    ";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':bulan', $bulan, PDO::PARAM_INT);
    $stmt->bindParam(':tahun', $tahun, PDO::PARAM_INT);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
