<?php
  include 'partials/database.php';
  if (isset($_POST['signin'])) {
    // redirect to login page
    $_SESSION['sign_in'] = "Sign in to access our items!!";
    header("location: signin.php");
    die();
  }
  if (isset($_POST['submit'])) {
    // declare variables
    $customer_id = filter_var($_POST['customer_id'], FILTER_SANITIZE_NUMBER_INT);
    $food_id = filter_var($_POST['food_id'], FILTER_SANITIZE_NUMBER_INT);
    // insert into cart
    $insert = "INSERT INTO cart SET menu_id=$food_id, customer_id=$customer_id";
    $query = mysqli_query($connection, $insert);
    if (!mysqli_errno($connection)) {
      $_SESSION['cart_success'] = "Item successfully added!!";
      header("location: cart.php");
      die();
    }
  }