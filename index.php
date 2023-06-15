<?php

require "config.php";
use App\User;
session_start();
$user_id = $_SESSION['user']['id'];
$user= User::getById($user_id);
// Check if the user is not logged in
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: pages/home.php");
    
}else if($user->getRole()=='admin'){
    header("Location: pages/admin_panel.php");
}else{
    header('Location: pages/productpage.php');
}
?>