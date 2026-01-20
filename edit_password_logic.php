<?php
  include 'partials/database.php';
  if (isset($_POST['submit'])) {
    // declare variables
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $current = filter_var($_POST['current'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $create = filter_var($_POST['create'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirm = filter_var($_POST['confirm'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // check errors
    if (!$confirm || !$create || !$current) {
        $_SESSION['edit_password'] = "Fill all fields";
    } elseif (strlen($create) < 4 || strlen($confirm) < 4) {
        $_SESSION['edit_password'] = "Password must be 4+ characters!!";
    }
    else {
        if ($create !== $confirm) {
            $_SESSION['edit_password'] = "Confirm and Create passwods doesn't match!!";
        } else {
            // hash password
            $hased_password = password_hash($create, PASSWORD_DEFAULT);
            // fetch users password
            $DB = "SELECT * FROM customers WHERE id=$id";
            $DB_query = mysqli_query($connection, $DB);
            // get just one user's password
            if (mysqli_num_rows($DB_query) == 1) {
                $DB_details = mysqli_fetch_assoc($DB_query);
                $DB_passwod = $DB_details['password'];
                // verify passwords
                if (password_verify($current, $DB_passwod)) {
                    // update password
                    $update_query = "UPDATE customers SET password='$hased_password' WHERE id=$id";
                    $update_result = mysqli_query($connection, $update_query);
                    if (!mysqli_errno($connection)) {
                        $_SESSION['edit_password_success'] = "Your password has been successfully updated!!";
                        header("location: dashboard.php");
                        die();
                    } else {
                        $_SESSION['edit_password_error'] = "Couldn't update password, ensure all fields are properly filled before submitting!!";
                        header("location: dashboard.php");
                        die();
                    }
                    
                } else {
                    $_SESSION['edit_password'] = "Incorrect current password";
                }
                
            } else {
                $_SESSION['edit_password'] = "Password not found";
            }
            
        }
    }
    
    // Redirect back to edit email if there's an error
    if (isset($_SESSION['edit_password'])) {
        header("location: edit_password.php");
        die();
    } 
  } else {
    header("location: edit_password.php");
    die();
  }
  