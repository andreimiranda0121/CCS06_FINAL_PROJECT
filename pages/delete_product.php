<?php

require "../config.php";

use App\Product;

// Remove Student record, and automatically redirect to index

try {
	$product_id = $_POST['id'];
	$result = Product::delProd($product_id);

	if ($result) {
		echo "
            <script>
                alert('Product was successfuly deleted');
                window.location.href = 'admin_panel.php';
            </script>";
	}else{
		echo "<h1>There was an error $product_id</h1>";
	}

} catch (PDOException $e) {
	error_log($e->getMessage());
	echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
}

?>

