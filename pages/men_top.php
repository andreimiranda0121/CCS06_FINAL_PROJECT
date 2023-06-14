<?php
require "../config.php";
use App\Product;
session_start();
$category = $_GET['category'];
$product = Product::listCategoryMen($category);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css">
    <link rel="stylesheet" href="../styles/product.css">
    <link rel="stylesheet" href="../styles/dropdown.css">
    <link rel="stylesheet" href="../styles/menu.css">
    <title>Mal De Wear</title>
</head>
<style>
    .add-to-cart-btn[disabled] {
    opacity: 0.5;
    cursor: not-allowed;
    background-color: gray; 
    color: white; 
}

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
                    <li><a href='men_accessories.php?category=<?php echo urlencode("Accesory"); ?>'>Accessories</a></li>
                </ul>
                <h3><a href='women.php'>Women</a></h3>
                <ul>
                    <li><a href='women.php'>New Arrivals</a></li>
                    <li><a href='women.php'>Best Sellers</a></li>
                    <li><a href='women.php'>Shop by Collection</a></li>
                    <li><a href='women_top.php?category=<?php echo urlencode("Tops"); ?>'>Tops</a></li>
                    <li><a href='women_bottoms.php?category=<?php echo urlencode("Bottoms"); ?>'>Bottoms</a></li>
                    <li><a href='women_footwear.php?category=<?php echo urlencode("Footwear"); ?>'>Footwear</a></li>
                    <li><a href='women_accessories.php?category=<?php echo urlencode("Accesory"); ?>'>Accessories</a></li>
                </ul>
            </div>
            <div class="sidebar-content2">
                <h3><a href='productpage.php'>All Items</a></h3>
            </div>
        </div>
    </div>
    <section class="products-container container">
    <?php
    $counter = 0;
    foreach ($product as $prod):    
        ?>
        <a href="#" class="shop-item" data-product-id="<?php echo $prod->getProdID();?>">
            <img src="../images/<?php echo $prod->getGender(); ?>/<?php echo $prod->getImage(); ?>" alt="Clothing item" class="lazy shop-item__img clothingImg">
            <div class="quickview">
                <button class="quickview__icon overview-btn" id="<?php echo $prod->getProdName(); ?>">Overview</button>
                <span class="quickview__info"><?php echo $prod->getDescription(); ?><br><span class="quickview__info--price clothingPrice">₱<?php echo $prod->getPrice(); ?></span></span>
            </div>
            <input type="hidden" class="stockQuantity" value="<?php echo $prod->getQuantity();?>">
        </a>

        <?php
        $counter++;
        if ($counter % 4 === 0) {
            echo '</section><section class="products-container container">';
        }
    endforeach;
    ?>
</section>

<form method="post" action="save_to_cart.php" onsubmit="return validateForm()">
    <input type="hidden" name="product_id" class="popup-productID">
    <div class="overlay">
        <div class="popup-item">
            <div class="clothing-item-flex">
                <div class="clothing-item-flex__img-wrapper">
                    <img src="" alt="Clothing item" class="clothing-item-flex__img zoom-normal popup-clothingImg">
                </div>
                <div class="product-info">
                    <h2 class="heading-secondary popup-clothingName"></h2>
                    <span class="product-info__price popup-clothingPrice"></span>
                    <p class="product-info__text popup-clothingDescription"></p>
                    <div class="detail-group">
                        <p class="detail-group__span">Size:</p>
                        <select class="detail-group__size" name="size" required>
                            <option value="">Select Size</option>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                    </div>
                    <div class="detail-group">
                        <p class="detail-group__span">Quantity:</p>
                        <input name="quantity" class="detail-group__quantity" value="1" type="number" required>
                    </div>
                    <button type="submit" class="btn btn--form btn--form--shop add-to-cart-btn">Add to cart</button>
                    <a href="" class="btn-view">Go Back</a>
                </div>
            </div>
        </div>
    </div>
</form>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $('.quickview .overview-btn').click(function() {
    var productId = $(this).closest('.shop-item').attr('data-product-id');

    // Update the value of the hidden input field
    $('.popup-productID').val(productId);

    $('.overlay').css({'opacity': '1', 'visibility': 'visible'});

    var imgsrc = $(this).closest('.shop-item').find('.clothingImg').prop('src');
    var price = $(this).closest('.shop-item').find('.clothingPrice').text();
    var productName = $(this).closest('.shop-item').find('.quickview__icon').attr('id');
    var description = $(this).closest('.shop-item').find('.quickview__info').clone().children().remove().end().text();
    
    $('.popup-clothingDescription').text(description);
    $('.popup-clothingImg').prop('src', imgsrc);
    $('.popup-clothingName').text(productName);
    $('.popup-clothingPrice').text(price);

    var quantityInput = $('.detail-group__quantity');
    var addToCartButton = $('.btn--form--shop');
    var sizeSelect = $('.detail-group__size');

    // Get the stock quantity for the product
    var stockQuantity = parseInt($(this).closest('.shop-item').find('.stockQuantity').val());

    // Update the max attribute of the quantity input field
    quantityInput.attr('max', stockQuantity);
    var addToCartButton = $('.add-to-cart-btn');
    // Disable the "Add to Cart" button if the stock quantity is 0
    if (stockQuantity === 0) {
        addToCartButton.prop('disabled', true);
    } else {
        addToCartButton.prop('disabled', false);
    }

    // Disable the quantity input if the stock quantity is 0
    if (stockQuantity === 0) {
        quantityInput.prop('disabled', true);
        quantityInput.attr('min', 0);
        quantityInput.val(0);
        sizeSelect.prop('disabled', true); // Disable the size selection
        sizeSelect.val('');
    } else {
        quantityInput.prop('disabled', false);
        quantityInput.attr('min', 1);

    }
    
    
});

$('.btn--form--shop').click(function(e) {
        e.preventDefault();

        var selectedSize = $('.detail-group__size option:selected').val();

        // Perform any necessary validation or processing with the selectedSize and quantity values

        // Append the size value to the form data before submitting
        $('form').append('<input type="hidden" name="size" value="' + selectedSize + '">');

        // Submit the form
        $('form').submit();
    });
</script>

<script>
    const menuIcon = document.querySelector('.menu-icon');
    const sidebar = document.querySelector('.sidebar');
    const container = document.querySelector('.container');
    const dashboard = document.querySelector('.dashboard');

    menuIcon.addEventListener('click', (event) => {
        event.preventDefault();
        sidebar.classList.toggle('sidebar-active');
        container.classList.toggle('container-active');
    });

    container.addEventListener('click', (event) => {
        if (event.target === container || event.target === dashboard) {
            sidebar.classList.remove('sidebar-active');
            container.classList.remove('container-active');
        }
    });
</script>    
          
<script>
   function validateForm() {
    var sizeSelect = document.querySelector('.detail-group__size');
    var quantityInput = document.querySelector('.detail-group__quantity');
    var stockQuantity = parseInt(quantityInput.getAttribute('max'));

    if (sizeSelect.value === "") {
        alert("Please select a size.");
        return false; // Prevent form submission
    }

    if (parseInt(quantityInput.value) > stockQuantity) {
        alert("Stock quantity is insufficient.");
        return false; // Prevent form submission
    }

    if (quantityInput.value === "" || parseInt(quantityInput.value) <= 0) {
        alert("Please enter a valid quantity.");
        return false; // Prevent form submission
    }
    
    return true; // Proceed with form submission
}

</script>


</body>

</html>
