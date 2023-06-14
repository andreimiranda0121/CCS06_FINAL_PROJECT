<?php

require "../config.php";

use App\User;

    $password = $_POST['password'];
    $role = "user";
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $result = User::register($username, $password, $role, $fullname, $address, $email, $contact);
    if ($result) {
        echo "
            <script>
                alert('Register success. Please log in the page.');
                window.location.href = 'login.php';
            </script>";
    } else {
        echo "
            <script>
                alert('Register failed. There's an error in the code.');
                window.history.back();
            </script>";
    }
    


?>
