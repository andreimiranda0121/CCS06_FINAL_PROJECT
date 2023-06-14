<?php
require "../config.php";
use App\Order;
$orders = Order::listOrders();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/menu.css">
    <title>Mal De Wear</title>
</head>
<style>
    .product-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 100px;
    margin-right: 30px;
    width: 300px;
    padding: 20px;
    border: 1px solid #ccc;
    background-color: #f5f5f5;
    border-radius: 1em;
}
.product-image{
    border-radius: 1em;
}
.menu-btn {
        position: relative;
        display: inline-block;
        margin-left: 20px;
    }

    .menu-btn:hover .dropdown-menu {
        display: block;
        color: white;
        margin-left: 2px;
        border-radius: 1em;

    }

    .dropdown-menu {
        display: none;
        position: absolute;
        border-radius: 1em;
        min-width: 30px;
        background-color: rgba(163, 159, 159, 0.842);
        color: white;
        z-index: 1;
    }

    .links {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        font-size: 18px;
        font-weight: bold;
        border-bottom: 1px solid rgba(163, 159, 159, 0.842);
    }

    .links:hover {
        border-radius: 1em;
        color: white;
        text-decoration: none;
        background-color: rgba(163, 159, 159, 0.842);;

    }
    
    </style>
<body>
    <div class="dashboard">
        <div class="dashboard-title">
            <a href="home.php">Mal De Wear</a>
        </div>
        <nav class="nav-links">
            <div class="menu-btn">
                <a href="#"><i class="bx bx-cart"></i></a>
                <div class="dropdown-menu">
                    <a class="links" href="cart.php">My Cart</a>
                    <a class="links" href="orders.php">My Order</a>
                </div>
            </div>
            <div class="menu-btn">
                <a href="#"><i class="bx bx-user-circle"></i></a>
                <div class="dropdown-menu">
                    <a class="links" href="user_panel.php">My Profile</a>
                    <a class="links" href="logout.php">Logout</a>
                </div>
            </div>
            <a href="#"><i class="bx bx-heart"></i></a>
        </nav>
        <a href="#" class="menu-icon"><i class="bx bx-menu-alt-left"></i></a>
    </div>

    <div class="sidebar">
        <div class="sidebar-content">
            <h3><a href='men.php'>Men</a></h3>
            <ul>
                <li><a href='men.php'>New Arrivals</a></li>
                <li><a href='men.php'>Best Sellers</a></li>
                <li><a href='men.php'>Shop by Collection</a></li>
                <li><a href='men_top.php?category=<?php echo urlencode("Tops"); ?>'>Tops</a></li>
                <li><a href='men_bottoms.php?category=<?php echo urlencode("Bottoms"); ?>'>Bottoms</a></li>
                <li><a href='men_footwear.php?category=<?php echo urlencode("Footwear"); ?>'>Footwear</a></li>
                <li><a href='men_accessories.php?category=<?php echo urlencode("Accessories"); ?>'>Accessories</a></li>
            </ul>
            <h3><a href='women.php'>Women</a></h3>
            <ul>
                <li><a href='women.php'>New Arrivals</a></li>
                <li><a href='women.php'>Best Sellers</a></li>
                <li><a href='women.php'>Shop by Collection</a></li>
                <li><a href='women_top.php?category=<?php echo urlencode("Tops"); ?>'>Tops</a></li>
                <li><a href='women_bottoms.php?category=<?php echo urlencode("Bottoms"); ?>'>Bottoms</a></li>
                <li><a href='women_footwear.php?category=<?php echo urlencode("Footwear"); ?>'>Footwear</a></li>
                <li><a href='women_accessories.php?category=<?php echo urlencode("Accessories"); ?>'>Accessories</a></li>
            </ul>
        </div>
        <div class="sidebar-content2">
            <h3><a href='productpage.php'>All Items</a></h3>
        </div>
    </div>

    <div class="product-container-wrapper">
        <?php foreach ($orders as $order): ?>
            <div class="product-container">
                <div class="product-image">
                    <img class="product-image" src="../images/<?php echo $order->getGender()?>/<?php echo $order->getImage(); ?>" alt="Product Image" style="max-width: 100%; max-height: 200px;">
                </div>
                <div class="product-details">
                    <h2><?php echo $order->getProdName();?></h2>
                    <p class="description"><?php echo $order->getDescription(); ?></p>
                    <p class="order-id">Order ID: <?php echo $order->getOrderID(); ?></p>
                    <p class="quantity">Quantity: <?php echo $order->getOrderQuantity(); ?></p>
                    <p class="size">Size: <?php echo $order->getSize(); ?></p>
                    <p class="address">Shipping Address: <?php echo $order->getAddress(); ?></p>
                    <p class="date">Date: <?php echo $order->getDate(); ?></p>
                    <p class="status">Status: <?php echo $order->getStatus(); ?></p>
                    <p class="price">Total: Php <?php echo $order->getTotalAmount(); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <script src="../scripts/sidebar.js"></script>
</body>
</html>
