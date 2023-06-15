<?php
require "../config.php";

use App\Cart;
use App\User;

session_start();
$user_id = $_SESSION['user']['id'];
$cart_id = $_GET['id'];
$item = Cart::getById($cart_id);

if (isset($_GET['id'])) {
    $cart_id = $_GET['id'];
    $item = Cart::getById($cart_id);
}
$user = User::getById($user_id);

// Assuming you have retrieved the address from the database into the $address variable
$address = $user->getShipping(); // Replace $row['address'] with your actual variable or value
// Define an array of special characters to split the address
$specialChars = array(',', '.', ';', ':', '-');

// Split the address using the special characters
$addressParts = preg_split('/[' . preg_quote(implode($specialChars), '/') . ']/', $address, -1, PREG_SPLIT_NO_EMPTY);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../styles/payment.css">
    <title>Make a Payment</title>
    <style>
    
        body {
            background-color: white;
            border-color: black;
        }

        .container {
            padding: 20px;
            border-radius: 2em;
        }

        .return-btn {
            margin-bottom: 10px;
            color: black;
            text-decoration: none;
        }
        .return-btn:hover{
           color: black;
        }

        .imageContainer {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .image {
            width: 100%;
            max-width: 300px;
            max-height: 400px;
            border-radius: 1em;
        }

        .purchaseNowContainer {
            max-width: 700px;
            margin: 0 auto;
        }

        .returnContainer {
            display: flex;
            justify-content: flex-start;
        }

        .row {
            border-radius: 2em;
        }

        .form-label {
            font-weight: bold;
        }
        
        .form-control1 {
            height: 25px;
            width: 80px;
            border: none;
            border-radius: 0;
            font-weight: 800;
            padding: 0 0 5px 0;
            background-color: transparent;
            box-shadow: none;
            outline: none;
            border-bottom: 2px solid #ccc;
            margin: 0;
            font-size: 14px;
        }
        .btn.btn-primary {
            width: 100%;
            height: 55px;
            border-radius: 0;
            padding: 13px 0;
            background-color: black;
            border: none;
            font-weight: 600;
        }

        .btn.btn-primary:hover .fas {
            transform: translateX(10px);
            transition: transform 0.5s ease
        }

        .btn.btn-primary input{
            color: white;
            border-radius: 0;
            padding: 0px 0;
            background-color: black;
            border: none;
            font-weight: 600;
        }

        .btn.btn-primary:hover .fas {
            transform: translateX(10px);
            transition: transform 0.5s ease
        }

        .productName{
            font-weight: bolder;
        }
    
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="returnContainer">
                    <a href="cart.php" class="return-btn">
                        <span class="fas fa-arrow-left pe-2"></span>Return
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="imageContainer">
                    <img class="image" src="../images/<?php echo $item['gender']; ?>/<?php echo $item['image_path']; ?>" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="purchaseNowContainer">
                    <form action="save_orders.php?id=<?php echo $cart_id?>" method="POST" onsubmit="return validateForm()">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <h4 class="productName" ><?php echo $item['product_name']; ?></h4>
                            </div>
                            <div class="col-6">
                                <p class="text-muted">Gender:</p>
                                <p class="fs-14 fw-bold"><?php echo $item['gender']; ?></p>
                            </div>
                            <div class="col-6">
                                <p class="text-muted">Qty:</p>
                                <p class="fs-14 fw-bold"><?php echo $item['cart_quantity']; ?></p>
                            </div>
                            <div class="col-6">
                                <p class="text-muted">Size:</p>
                                <p class="fs-14 fw-bold"><?php echo $item['size']; ?></p>
                            </div>
                            <div class="col-6">
                                <p class="text-muted">Price:</p>
                                <p class="fs-14 fw-bold">Php <?php echo $item['price']; ?></p>
                            </div>
                            <div class="col-6">
                                <p class="text-muted">Shipping:</p>
                                <p class="fs-14 fw-bold">Free</p>
                            </div>
                            <div class="col-6">
                                <p class="text-muted fw-bold">Total:</p>
                                <p class="h4">Php <?php echo $item['cart_quantity'] * $item['price']; ?></p>
                            </div>
                            <div class="col-12">
                                <div class="mb-4">
                                    <p class="fw-bold">Payment detail</p>
                                </div>
                                <div class="mb-3">
                                    <label for="card-number" class="form-label">Card number:</label>
                                    <input type="text" class="form-control" id="card-number" name="card_number" placeholder="xxxx xxxx xxxx xxxx" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="expires" class="form-label">Expires:</label>
                                        <input type="text" class="form-control" id="expires" name="expires" placeholder="MM/YYYY" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cardholder-name" class="form-label">Cardholder name:</label>
                                        <input type="text" class="form-control" id="cardholder-name" name="cardholder_name" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="cvc" class="form-label">CVC:</label>
                                    <input type="text" class="form-control" id="cvc" name="cvc" placeholder="XXX" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-4">
                                    <p class="fw-bold">Shipping Address</p>
                                </div>
                                <div class="mb-3">
                                    <label for="shipping-address" class="form-label">Address:</label>
                                    <input type="text" class="form-control" id="shipping-address" value="<?php echo $addressParts[0]; ?>" name="shipping_address" placeholder="Enter shipping address" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                    <label for="shipping-city" class="form-label">City:</label>
                                            <input type="text" class="form-control" id="shipping-city" value="<?php echo $addressParts[1]; ?>" name="shipping_city" placeholder="Enter city" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="shipping-state" class="form-label">State:</label>
                                            <input type="text" class="form-control" id="shipping-state" value="<?php echo $addressParts[2]; ?>" name="shipping_state" placeholder="Enter state" required>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label for="shipping-zip" class="form-label">ZIP:</label>
                                            <input type="text" class="form-control1" id="shipping-zip" value="<?php echo $addressParts[3]; ?>" name="shipping_zip" placeholder="ZIP code" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 px-0">
                            <div class="col-12  mb-4 p-0">
                                <div class="btn btn-primary">
                                    <input type="submit" value="Purchase" class="btn-black-bg">
                                    <span class="fas fa-arrow-right ps-2"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    function validateForm() {
        var cardNumberInput = document.getElementById('card-number');
        var expiresInput = document.getElementById('expires');
        var cardholderNameInput = document.getElementById('cardholder-name');
        var cvcInput = document.getElementById('cvc');
        var shippingAddressInput = document.getElementById('shipping-address');
        var shippingCityInput = document.getElementById('shipping-city');
        var shippingStateInput = document.getElementById('shipping-state');
        var shippingZipInput = document.getElementById('shipping-zip');

        if (cardNumberInput.value === "" || expiresInput.value === "" || cardholderNameInput.value === "" || cvcInput.value === "" || shippingAddressInput.value === "" || shippingCityInput.value === "" || shippingStateInput.value === "" || shippingZipInput.value === "") {
            alert("Please fill in all fields.");
            return false; // Prevent form submission
        }

        return true; // Proceed with form submission
    }
</script>
</body>

</html>
