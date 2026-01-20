<?php
  include 'partials/database.php'; //
  // logic
  if (isset($_POST['submit'])) {
    // varables
    $id = filter_var($_POST['customer_del'], FILTER_SANITIZE_NUMBER_INT);
    // select user image
    $select= "SELECT * FROM customers WHERE id=$id";
    $result = mysqli_query($connection, $select);
    $user = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $image = $user['avatar'];
        $image_path = "images/Customers/" . $image;
    }
    // delete
    $delete = "DELETE FROM customers WHERE id=$id LIMIT 1";
    $query = mysqli_query($connection, $delete);
    if (!mysqli_errno($connection)) {
        // unlink image from folder
        if ($image_path) {
            unlink($image_path);
        }
        $_SESSION['sign_up'] = "Account deleted, sign up!!";
        header("location: signup.php");
        die();
    }
  }