<?php

require "../config.php";

use App\Cart;
session_start();

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    // Redirect the user to the login page or display an error message
    header("Location: login.php"); // Redirect to the login page
    exit; // Stop executing the rest of the code
} else {
    if (isset($_POST['quantity_plus'])) {
    $cart_id = $_POST['cart_id'];
    $cart = Cart::updateQuantity($cart_id, $_POST['quantity_plus']);
} elseif (isset($_POST['quantity_minus'])) {
    $cart_id = $_POST['cart_id'];
    $cart = Cart::updateQuantity($cart_id, $_POST['quantity_minus']);
}
    $cart = Cart::list();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/cart.css">
    <link rel="stylesheet" href="../styles/form.css">
    <title>My Cart</title>
    <style>
        .btn--outOfStock {
            background-color: #ccc;
            pointer-events: none;
            cursor: not-allowed;
        }

    </style>
</head>
<body>
    <div>
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
                    <li><a href='men_accessories.php?category=<?php echo urlencode("Accessory"); ?>'>Accessories</a></li>
                </ul>
                <h3><a href='women.php'>Women</a></h3>
                <ul>
                    <li><a href='women.php'>New Arrivals</a></li>
                    <li><a href='women.php'>Best Sellers</a></li>
                    <li><a href='women.php'>Shop by Collection</a></li>
                    <li><a href='women_top.php?category=<?php echo urlencode("Tops"); ?>'>Tops</a></li>
                    <li><a href='women_bottoms.php?category=<?php echo urlencode("Bottoms"); ?>'>Bottoms</a></li>
                    <li><a href='women_footwear.php?category=<?php echo urlencode("Footwear"); ?>'>Footwear</a></li>
                    <li><a href='women_accessories.php?category=<?php echo urlencode("Accessory"); ?>'>Accessories</a></li>
                </ul>
            </div>
            <div class="sidebar-content2">
                <h3><a href='productpage.php'>All Items</a></h3>
            </div>
        </div>
    </div>

     <div class="product-container-wrapper">
    <?php foreach ($cart as $item) : ?>
        <div class="product-container">
            <div class="prodName">
                <h2><?php echo $item->getProdName(); ?></h2>
            </div>
                <img class="prod-image" src="../images/<?php echo $item->getGender();?>/<?php echo $item->getImage(); ?>">
            <div class="price">
                <p>Price: Php <?php echo $item->getPrice()*$item->getQuantity(); ?></p>
            </div>
            <div class="price">
                <p>Size: <?php echo $item->getSize();?> </p>
            </div>
                <form method="post">
                    <div>
                        <label>Quantity: </label>
                        <button type="submit" name="quantity_minus" value="<?php echo $item->getQuantity() - 1; ?>" <?php echo ($item->getQuantity() == 1) ? 'disabled' : ''; ?>>-</button>
                        <span><?php echo $item->getQuantity();?></span>
                        <button type="submit" name="quantity_plus" value="<?php echo $item->getQuantity() + 1; ?>" <?php echo ($item->getQuantity() == $item->getProdQuantity()) ? 'disabled' : ''; ?>> + </button>
                        <input type="hidden" name="cart_id" value="<?php echo $item->getCartID();?>">
                    </div>
                </form>
                <!-- Buy Now button -->
                <br>
                <?php if ($item->getProdQuantity() > 0) : ?>
                    <a class="btn btn--buy btn--buyBtn" href="buy_now.php?id=<?php echo $item->getCartID();?>">Buy Now</a>
                <?php else: ?>
                    <a class="btn btn--buy btn--buyBtn btn--outOfStock" href="#" disabled>Out of Stock</a>
                <?php endif; ?>
                    <button class="btn btn--remove" data-cart-id="<?php echo $item->getCartID(); ?>">Remove</button>

            <div id="myModal-<?php echo $item->getCartID(); ?>" class="modal">
                <div class="modal-content">
                    <h2>Do you want to remove the item?</h2>
                    <a class="btn btn--remove" href="delete_cart.php?id=<?php echo $item->getCartID(); ?>">Remove</a>
                    <a class="btn btn--cancel" data-modal-id="<?php echo $item->getCartID(); ?>" id="close-modal">Cancel</a>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                $(".btn--remove").click(function() {
                    var cartID = $(this).data("cart-id");
                    $("#blur-container").addClass("blur");
                    $("#myModal-" + cartID).fadeIn();
                });

                $("a[data-modal-id]").click(function() {
                    var cartID = $(this).data("modal-id");
                    $("#myModal-" + cartID).fadeOut(function() {
                        $("#blur-container").removeClass("blur");
                    });
                });
            });
        </script>
    <?php endforeach ?>
</div>
    <script src="../scripts/sidebar.js"></script>
</body>
</html>
