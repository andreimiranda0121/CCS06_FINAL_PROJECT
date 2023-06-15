<?php

require "../config.php";

use App\Cart;

// Remove Student record, and automatically redirect to index
session_start();

try {
	$cart_id = $_GET['id'];
	$result = Cart::delByID($cart_id);

	if ($result) {
		echo "
            <script>
                alert('Product was successfuly deleted');
                window.location.href = 'cart.php';
            </script>";
	}

} catch (PDOException $e) {
	error_log($e->getMessage());
	echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
}

?>

