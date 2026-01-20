<?php
  include 'partials/database.php';
  if (isset($_POST['submit'])) {
    // declare variables
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (!$email) {
        $_SESSION['edit_email'] = "Fill the input!!";
    }
    // Redirect back to edit email if there's an error
    if (isset($_SESSION['edit_email'])) {
        header("location: edit_email.php");
        die();
    } else {
        $update_email_query = "UPDATE customers SET email='$email' WHERE id=$id";
        $update_result = mysqli_query($connection, $update_email_query);
        if (!mysqli_errno($connection)) {
            $_SESSION['edit_email_success'] = "Username updated successfully!!";
            header("location: dashboard.php");
            die();
        } else {
            $_SESSION['edit_email_error'] = "Couldn't update email, ensure all fields are properly filled before submitting!!";
            header("location: dashboard.php");
            die();
        }
    }
    
  } else {
    header("location: edit_email.php");
    die();
  }
  