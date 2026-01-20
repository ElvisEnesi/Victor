<?php
  include 'partials/database.php'; //
  // logic
  if (isset($_POST['submit'])) {
    // varables
    $id = filter_var($_POST['cart_del'], FILTER_SANITIZE_NUMBER_INT);
    // delete
    $delete = "DELETE FROM cart WHERE id=$id LIMIT 1";
    $query = mysqli_query($connection, $delete);
    if (!mysqli_errno($connection)) {
        $_SESSION['cart_cate'] = "Cart deleted successfully!!";
        header("location: manage_cart.php");
        die();
    }
  }