<?php
  include 'partials/database.php'; //
  // logic
  if (isset($_POST['submit'])) {
    // varables
    $id = filter_var($_POST['cart_del'], FILTER_SANITIZE_NUMBER_INT);
    // delete
    $delete = "DELETE FROM carts WHERE id=$id LIMIT 1";
    $query = mysqli_query($connection, $delete);
    if (!mysqli_errno($connection)) {
      if (isset($_SESSION['user_is_admin'])) {
        $_SESSION['cart_cate'] = "Cart deleted successfully!!";
        header("location: manage_cart.php");
        die();
      } else {
        $_SESSION['cart_success'] = "Cart deleted successfully!!";
        header("location: cart.php");
        die();
      }  
    }
  }