<?php

require "../config.php";
use App\User;


$user_id = $_POST['id'];
$fullname = $_POST['fullname'];
$address = $_POST['address'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$username = $_POST['username'];
$password = $_POST['password'];

$result = User::update($user_id, $username, $password, $fullname, $address, $email, $contact);

if ($result) {
    // Update successful
    echo "<script>alert('User updated successfully!'); window.location.href='user_panel.php';</script>";
} else {
    // Handle the error
    echo "<script>alert('Failed to update the user.');</script>";
}


?>