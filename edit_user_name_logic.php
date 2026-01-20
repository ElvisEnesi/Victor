<?php
  include 'partials/database.php';
  if (isset($_POST['submit'])) {
    // declare variables
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $user = filter_var($_POST['user'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$user) {
        $_SESSION['edit_user_name'] = "Fill the input!!";
    }
    // Redirect back to edit username if there's an error
    if (isset($_SESSION['edit_user_name'])) {
        header("location: edit_user_name.php");
        die();
    } else {
        $update_user_name_query = "UPDATE customers SET user_name='$user' WHERE id=$id";
        $update_result = mysqli_query($connection, $update_user_name_query);
        if (!mysqli_errno($connection)) {
            $_SESSION['edit_user_name_success'] = "Username updated successfully!!";
            header("location: dashboard.php");
            die();
        } else {
            $_SESSION['edit_user_name_error'] = "Couldn't update user names, ensure all fields are properly filled before submitting!!";
            header("location: dashboard.php");
            die();
        }
    }
    
  } else {
    header("location: edit_user_name.php");
    die();
  }
  