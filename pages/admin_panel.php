<?php
require '../config.php';
use App\Product;

session_start();
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$result = Product::list();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/adminpanel.css">
    <title>Product Management</title>
    <style>
    
.search-container {
    position: absolute;
    top: 20px; /* Adjust the top position as per your preference */
    right: 20px; /* Adjust the right position as per your preference */
    text-align: right;
    margin-bottom: 20px;
    z-index: 999; /* Ensure the search bar appears above other elements */
}

    </style>
</head>
<body>
    <div class="dashboard">
        <div class="dashboard-title">
            <a><b>Mal De Wear</b></a>
        </div>
        <nav class="nav-links">
            <a href="logout.php" class="logout-button"><b>Logout</b></a>
        </nav>
    </div>

    <div class="titlepage">
        <h1>Product Management</h1>
    </div>
    
    <a href="logout.php" class="logout-button"><b>Logout</b></a>

    <div class="container">
        <div class="button-container">
            <a href="add_product.php" class="button add">Add Product</a>
     
        <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search products...">
        <button type="button" id="searchButton" class="button search">Search</button>
    
    </div>

        <div class="product-container">
            <?php foreach($result as $res): ?>
            <div class="product-card">

                <img src='../images/<?php echo $res->getGender();   ?>/<?php echo $res->getImage();?>' alt="Product 1" class="product-image">
                <div class="product-name">
                        <?=$res->getProdName(); ?>
                    </div>
                <div class="product-details">
                    
                    <div class="product-price">
                        <label><b>Price:</b> Php</label>
                        <?=$res->getPrice();?>
                    </div>
                    <div>
                        <label><b>Description:</b><br></label>
                        <?php echo $res->getDescription();?>
                    </div>
                    <div>
                        <label><b>Quantity: </b></label>
                        <?php echo $res->getQuantity();?>
                    </div>

                    <div class="product-gender">
                        <label><b>Gender: </b></label>
                        <?php echo $res->getGender();?>
                    </div>

                    <div>
                        <label><b>Category: </b></label>
                        <?php echo $res->getCategory();?>
                    </div>
                    
                    <div class="product-actions">
                        <a href="edit_product.php?id=<?php echo $res->getProdID();?>" class="button edit">Edit</a>
                        <button class="button delete" onclick="openForm(<?php echo $res->getProdID();?>)">Delete</button>
                        <div class="form-popup" id="myForm-<?php echo $res->getProdID();?>">
                            <form action="delete_product.php" method="POST" class="form-container">
                                <h3>Are you sure you want to delete this product?</h3>
                                <input type="submit" class="btn" value="Confirm">
                                <input type="hidden" name="id" value="<?php echo $res->getProdID();?>">
                                <button type="button" class="btn cancel" onclick="closeForm(<?php echo $res->getProdID();?>)">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach?>
        </div>
    </div>
    
    <img src="https://cdn.pixabay.com/photo/2021/11/04/19/39/jellyfish-6769173_960_720.png" alt="" class="bg">
    <img src="https://cdn.pixabay.com/photo/2012/04/13/13/57/scallop-32506_960_720.png" alt="" class="bg2">
    
    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>
    <script>
    document.getElementById("searchButton").addEventListener("click", function() {
    var input = document.getElementById("searchInput").value.toLowerCase();
    var products = document.getElementsByClassName("product-card");

    for (var i = 0; i < products.length; i++) {
        var productName = products[i].querySelector(".product-name").textContent.toLowerCase();
        var productDescription = products[i].querySelector(".product-details").textContent.toLowerCase();
        var productGender = products[i].querySelector(".product-gender").textContent.toLowerCase();

        var isMatch =
            productName.includes(input) ||
            productDescription.includes(input) ||
            (productGender === input && input !== "male" && input !== "female");

        products[i].style.display = isMatch ? "block" : "none";
    }
});

document.getElementById("searchInput").addEventListener("input", function() {
    var input = this.value.trim().toLowerCase();
    var products = document.getElementsByClassName("product-card");

    for (var i = 0; i < products.length; i++) {
        var productName = products[i].querySelector(".product-name").textContent.toLowerCase();
        var productDescription = products[i].querySelector(".product-details").textContent.toLowerCase();
        var productGender = products[i].querySelector(".product-gender").textContent.toLowerCase();

        var isMatch =
            productName.includes(input) ||
            productDescription.includes(input) ||
            (productGender === input && input !== "male" && input !== "female");

        products[i].style.display = isMatch ? "block" : "none";
    }
});




</script>


<script>
    function openForm(productId) {
        document.getElementById("myForm-" + productId).style.display = "block";
    }

    function closeForm(productId) {
        document.getElementById("myForm-" + productId).style.display = "none";
    }
</script>

</body>
</html>