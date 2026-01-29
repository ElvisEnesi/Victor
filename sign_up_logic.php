<?php 
  // sign up logic
  include 'partials/database.php';
  
  // if submit button was clicked
  if (isset($_POST['submit'])) {
    // Declre variables
    $firstname = filter_var($_POST['first'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['last'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['user'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $createpassword = filter_var($_POST['create'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirm'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avater'];
    // no empty inputs
    if (!$firstname || !$lastname || !$username || !$email || !$createpassword || !$confirmpassword) {
        $_SESSION['sign_up'] = 'Fill in all fields!!';
    } elseif (strlen($createpassword) < 4 || strlen($confirmpassword) < 4) {
        $_SESSION['sign_up'] = 'Passwords should be more than 4!!';
    } elseif (!$avatar['name']) {
        $_SESSION['sign_up'] = 'Add an image!!';
    } else {
        // Ensure passwords match
        if ($createpassword !== $confirmpassword) {
            $_SESSION['sign_up'] = 'Passwords do not match!!';
        } else {
            // if they match, hash them
            $hased_password = password_hash($createpassword, PASSWORD_DEFAULT); 
            // check if username or email is taken
            $user_check_query = "SELECT * FROM customer WHERE username ='$username' or emails = '$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['sign_up'] = 'Username or Email exists, try another!!';
            } else {
                // work on avatar
                // renaming it first using current time stamp
                $time = time();
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/Customers/' . $avatar_name;
                // make sue file is an image
                $allowed_files = ['png', 'jpeg', 'jpg'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);
                if (in_array($extention, $allowed_files)) {
                    // make sure file is not large
                    if ($avatar['size'] > 2000000) {
                        $_SESSION['sign_up'] = 'image too large, not More than 2mb';
                    } else {
                        // move file to folder
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    }
                } else {
                    $_SESSION['sign_up'] = 'file must be png, jpg or jpeg';
                }
            }
        }
    }
    // redirect if submit button wasn't clicked
    if (isset($_SESSION['sign_up'])) {
        // unlink avatar
        unlink($avatar_destination_path);
        header("location: signup.php");
        die();
    } else {
        // insert new user
        $insert_user_query = "INSERT INTO customer SET firstname='$firstname', 
        lastname='$lastname', username='$username', emails='$email', 
        pass_key='$hased_password', avatars='$avatar_name', is_add=0";
        $insert_user_result = mysqli_query($connection, $insert_user_query);
        if (!mysqli_errno($connection)) {
            // redirect to sign in with success message
            $_SESSION['sign_up_success'] = "Registration successfull, login!!";
            header("location: signin.php");
            die();
        }
    }
    
  } else {
    header('location: signup.php');
    die();
  }