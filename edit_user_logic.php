<?php
  include 'partials/database.php';
  if (isset($_POST['submit'])) {
    // declare variables
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $first = filter_var($_POST['first'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $last = filter_var($_POST['last'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$first || !$last) {
        $_SESSION['edit_user'] = "Fill the input!!";
    }
    // Redirect back to edit username if there's an error
    if (isset($_SESSION['edit_user'])) {
        header("location: edit_user.php");
        die();
    } else {
        $update_user_query = "UPDATE customer SET firstname='$first', lastname='$last' WHERE id=$id";
        $update_result = mysqli_query($connection, $update_user_query);
        if (!mysqli_errno($connection)) {
            $_SESSION['edit_user_success'] = "First & last names updated successfully!!";
            header("location: dashboard.php");
            die();
        } else {
            $_SESSION['edit_user_error'] = "Couldn't update first & last names, ensure all fields are properly filled before submitting!!";
            header("location: dashboard.php");
            die();
        }
    }
    
  } else {
    header("location: edit_user.php");
    die();
  }
  