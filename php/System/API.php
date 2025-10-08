<?php
require __DIR__ . "/system.php";

//kasih tau kalo ini typenya json
header("Content-Type: application/json");

if (isset($_GET['cat']) && $_GET['cat'] !== "all") {
    $stmt = $auth->connectDb()->prepare("SELECT * FROM product WHERE Product_category = :cat");
    $stmt->bindParam(":cat", $_GET['cat']);
    $stmt->execute();
    //encode buat konversi ke json dari array
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} else {
    $stmt = $auth->getproduct();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

?>