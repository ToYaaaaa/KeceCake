<?php 

require_once dirname(__FILE__) . '/midtrans-php-master/Midtrans.php'; 

//SAMPLE REQUEST START HERE

// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'Mid-server-cgwV-Uct-05KfRi4drXGUDK5';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

$params = array(
    'transaction_details' => array(
        'order_id' => rand(),
        'gross_amount' => $_POST['total'],
    ),
    'item_detail' => json_decode($_POST["items"], true),
    'customer_details' => array(
        'first_name' => $_POST["name"],
        'email' => $_POST["email"],
        'phone' => $_POST["telephone"],
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params);
echo $snapToken;
?>