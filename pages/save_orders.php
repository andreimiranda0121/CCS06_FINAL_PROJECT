<?php

require "../config.php";

use App\Cart;
use App\Order;

$cart_id = $_GET['id'];
$cart = Cart::getById($cart_id);

$user_id = $cart['user_id'];
$product_id = $cart['product_id'];
$order_quantity = $cart['cart_quantity'];
$quantity = $cart['product_quantity'] - $cart['cart_quantity'];
$shipping_address = $_POST['shipping_address'] . ',' . $_POST['shipping_city'] . ',' . $_POST['shipping_state'] . ',' . $_POST['shipping_zip'];
$total_amount = $cart['price'] * $cart['cart_quantity'];
$order_status = "Delivered";
$order_date = date('Y-m-d H:i:s');
$payment_information = $_POST['card_number'] . ',' . $_POST['cardholder_name'] . ',' . $_POST['expires'] . ',' . $_POST['cvc'];
$size = $cart['size'];



$result = Order::add($product_id, $user_id, $shipping_address, $total_amount, $order_status, $order_date, $payment_information, $order_quantity, $size);

if ($result) {
    $update = Order::updateAndDel($cart_id, $quantity, $product_id);
    if ($update) {
        header("Location: orders.php");
        exit;
    }
} else {
    $errorInfo = $conn->errorInfo();
    echo "SQL Error Code: " . $errorInfo[1] . "<br>";
    echo "SQL Error Message: " . $errorInfo[2];
}

?>