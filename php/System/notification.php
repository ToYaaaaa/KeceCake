<?php
header('Content-Type: application/json');
require __DIR__ . "/system.php";
// ambil data dari app.js
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

// ambil data dari midtrans
$order_id = $data['order_id'] ?? null;
$order_status = $data['transaction_status'] ?? null;
$payment_type = $data['payment_type'] ?? null;
$totalprice = $data['gross_amount'] ?? null;
$transaction_time = $data['transaction_time'] ?? null;

$customer_name  = $data['customer_details']['first_name'] ?? "Unknown";
$customer_email = $data['customer_details']['email'] ?? "noemail@domain.com";
$customer_phone = $data['customer_details']['phone'] ?? "-";

// item detail
$items = $data['item_detail'] ?? [];

// masukin ke DB kalau udah sukses bayar
if ($order_status == 'settlement' || $order_status == 'capture') {
    try {
        // insert ke orders
        $auth->insertOrders(
            $order_id,
            $totalprice,
            $order_status,
            $transaction_time,
            $payment_type,
            $customer_name,
            $customer_email,
            $customer_phone
        );

        // insert ke order_items
        foreach ($items as $item) {
            $auth->insertOrdersItem(
                $order_id,
                $item['product_id'],
                $item['category'],
                $item['image'],
                $item['name'],
                $item['price'],
                $item['quantity']
            );
        }

        echo json_encode(["status" => "success", "msg" => "Order saved"]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["status" => "error", "msg" => $e->getMessage()]);
    }
}