<?php
  include 'partials/database.php'; //
  // get id from url
  if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    // get categories
    $cart_query = "SELECT * FROM carts WHERE id=$id";
    $cart_result = mysqli_query($connection, $cart_query);
    $cart = mysqli_fetch_assoc($cart_result);
  }
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
    <section class="must_know">
        <h1>Are you sure you want to delete this cart??</h1>
        <ol>
        <form action="delete_cart_logic.php" method="post">
            <input type="hidden" name="cart_del" value="<?= $cart['id'] ?>">
            <button type="submit" name="submit">Yes</button>
        </form>
        <?php if (isset($_SESSION['user_is_admin'])) : ?>
        <button onclick="window.location.href='manage_cart.php'">No</button>
        <?php else : ?>
        <button onclick="window.location.href='cart.php'">No</button>
        <?php endif ?>
        </ol>
    </section>
