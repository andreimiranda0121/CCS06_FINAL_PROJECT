<?php

require '../config.php';
use App\User;
session_start();

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    // Redirect the user to the login page or display an error message
    header("Location: login.php"); // Redirect to the login page
    exit; // Stop executing the rest of the code
} else {
    $user_id = $_SESSION['user']['id'];
    $user = User::getById($user_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css">
    <link rel="stylesheet" href="../styles/user.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/menu.css">
    <title>User Information</title>
</head>
<style>
    .btn:disabled,
        .btn[disabled] {
            background-color: black;
            pointer-events: none;
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
    .container1  {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60vh;
            
      
        }
        html, body {
        height: 100%;
        overflow: hidden;
    }

    body {
        margin: 0;
        padding: 0;
        overflow: auto; 
    }
    .btn{
        background-color: black;
    }
    .btn:hover{
        background-color: white;
        color: black;
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
    <br><br><br><br><br><br><br><br><br><br>
    <div class="container1">
        <div class="container">
            <form action="save_user.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <input type="hidden" name="id" value="<?php echo $user->getID(); ?>">
            <div>
                <label>Fullname: </label>
                <input type="text" class="box" value="<?php echo $user->getFullname(); ?>" name="fullname" required readonly >
            </div>
            <div>
                <label>Username: </label>
                <input type="text" class="box" value="<?php echo $user->getUsername(); ?>" name="username" required readonly >
            </div>
            <div>
                <label>Email: </label>
                <input type="email" value="<?php echo $user->getEmail(); ?>" name="email" class="box" required readonly>
            </div>
            <div>
                <label>Shipping Address: </label>
                <input type="text" value="<?php echo $user->getShipping(); ?>" name="address" class="box" required readonly >
            </div>
            <div>
                <label>Phone Number</label>
                <input class="box" type="text" name="contact" value="<?php echo $user->getContact()?>" required readonly >
            </div>
            <div class="field">
                <label>Password</label>
                <input class="box" type="password" id="passwordField" name="password" value="<?php echo $user->getPassword()?>" required placeholder="Enter your password" readonly >
            </div>
            <div class="field">
                <label>Confirm Password</label>
                <input class="box" type="password" id="confirmField" value="<?php echo $user->getPassword()?>" required placeholder="Enter your confirm password" readonly >
            </div>
            <div>
                    <input type="checkbox" id="editCheckbox" onchange="toggleEditing(this)">
                    <label for="editCheckbox">Enable Editing</label><br>
                </div>
                <input type="submit" value="Save" id="saveButton" class="btn" disabled>
            </form>
        </div>
    </div>
<script src="../scripts/login_sidebar.js"></script>
<script>
     const editCheckbox = document.getElementById('editCheckbox');
        const inputFields = document.querySelectorAll('.box');
        const saveButton = document.getElementById('saveButton');

        editCheckbox.addEventListener('change', function() {
            const isEditingEnabled = this.checked;

            inputFields.forEach(function(input) {
                input.readOnly = !isEditingEnabled;
            });

            saveButton.disabled = !isEditingEnabled;
        });

    function validateForm() {
        const passwordField = document.getElementById('passwordField');
        const confirmField = document.getElementById('confirmField');
        
        if (passwordField.value !== confirmField.value) {
            alert('Passwords do not match. Please make sure the passwords match.');
            return false;
        }
        
        return true;
    }
</script>

</body>
</html>
