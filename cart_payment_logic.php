<?php
  include 'partials/database.php';
  // declare variables
  if (isset($_POST['submit'])) {
    // declare variables
    $id = filter_var($_POST['customer_id'], FILTER_SANITIZE_NUMBER_INT);
    $menu_id = filter_var($_POST['menu_id'], FILTER_SANITIZE_NUMBER_INT);
    $cart_id = filter_var($_POST['cart_id'], FILTER_SANITIZE_NUMBER_INT);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $receipt = $_FILES['receipt'];
    // check errors
    if (!$address || !$phone || !$receipt['name']) {
        $_SESSION['payment'] = "Fill all inputs!!";
    } else {
        // work on receipt
        $time = time(); // rename receipt with current timestamp
        $receipt_name = $time . $receipt['name'];
        $receipt_tmp_name = $receipt['tmp_name'];
        $receipt_path = "images/Uploads/" . $receipt_name;
        // make sure file is an image
        $allowed_files = ['jpg', 'png', 'jpeg'];
        $extension = explode('.', $receipt_name);
        $extension = end($extension);
        if (in_array($extension, $allowed_files)) {
            move_uploaded_file($receipt_tmp_name, $receipt_path);
        } else {
            $_SESSION['payment'] = "File must be jpg, png or jpeg!!";
        }
    }


    if (isset($_SESSION['payment'])) {
        // unlink receipt
        unlink($receipt_path);
        header("location: cart_payment.php");
        die();
    } else {
        // insert into order table
        $insert = "INSERT INTO orderss SET customer_id=$id, cart_id=$cart_id, menu_id=$menu_id, 
        phone='$phone', address='$address', receipt='$receipt_name'";
        $query = mysqli_query($connection, $insert);
        if (!mysqli_errno($connection)) {
            $_SESSION['payment_success'] = "Order successfully created!!";
            $update_cart = "UPDATE carts SET status='checked_out' WHERE id=$cart_id";
            $result = mysqli_query($connection, $update_cart);
            header("location: orders.php");
            die();
        } else {
            $_SESSION['payment_error'] = "Couldn't create order, try again with correct inputs!!";
            header("location: cart.php");
            die();
        }   
    }
  }