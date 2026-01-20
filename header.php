<?php 
  include 'partials/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custech Restaurant</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <section class="header" id="header">
        <div class="logo" onclick="window.location.href='index.php'">CUSTRIES</div>
        <div class="nav">
            <a href="about.php">About us</a>
            <a href="menu.php">Menu</a>
            <a href="service.php">Services</a>
            <a href="contact.php">Contact us</a>
            <?php  if (isset($_SESSION['user_id'])) : ?> 
            <a href="dashboard.php">Dashboard</a>
            <a href="cart.php"><ion-icon name="bag-handle-outline"></ion-icon></a>
            <?php else : ?>  
            <a href="signin.php">Login</a>
            <?php endif ?>
        </div>
        <button class="show" onclick="openNavBar()"><ion-icon name="menu-outline"></ion-icon></button>
        <button class="hide" onclick="closeNavBar()"><ion-icon name="close-outline"></ion-icon></button>
    </section>