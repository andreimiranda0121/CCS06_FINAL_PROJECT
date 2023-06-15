<?php
require '../config.php';
use App\Product;

try {
    $product_id = $_POST['id'];
    $prod_name = $_POST['prod_name'];
    $price = $_POST['price'];
    $product_description = $_POST['description'];
    $product_quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $gender = $_POST['gender'];
    $image = $_POST['image'];
    $uploadDir = "../images/".$gender.'/';
    // Generate a unique filename for the uploaded image
    $imageFileName = $image;
    $targetFilePath = $uploadDir . $imageFileName;
    
    $product = Product::getById($product_id);
    $oldGender = $product->getGender();
    $oldFilePath = "../images/".$oldGender.'/'.$image;

    $result = Product::edit($product_id, $prod_name, $price, $product_description, $product_quantity, $gender, $category, $image);

    if ($result) {
        // Check if gender has changed
        if ($gender !== $oldGender) {
            // Move the file to the new gender folder
            if (rename($oldFilePath, $targetFilePath)) {
                // Delete the file from the old folder if it exists
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            } else {
                echo "<h1>There was an error in transferring the image.</h1>";
            }
        }

        move_uploaded_file($image, $targetFilePath);
        echo "
            <script>
                alert('Edit product was successful. Click Ok to go back');
                window.location.href = 'admin_panel.php';
            </script>";
    } else {
        echo "<h1>There was an error in saving the product.</h1>";
    }
} catch(PDOException $e) {
    error_log($e->getMessage());
}
?>
