<?php
  // fetching database
  include 'partials/database.php';
  // signin_logic
  if (isset($_POST['submit'])) {
    // declare variables from signin file
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // ensure fields are filled
    if (!$email || !$password) {
        $_SESSION['sign_in'] = "Fill all inputs!!!";
    } else {
        // proceed if all inputs are filled
        $user_select_query = "SELECT * FROM customer WHERE emails='$email'";
        $user_select_result = mysqli_query($connection, $user_select_query);
        // check if user was found
        if (mysqli_num_rows($user_select_result) == 1 ) {
            // convert into assoc array
            $user_record = mysqli_fetch_assoc($user_select_result);
            $db_password = $user_record['pass_key'];
            // compare passwords
            if (password_verify($password, $db_password)) {
                // set access control for login
                $_SESSION['user_id'] = $user_record['id'];
                // check if it's admin or user
                if ($user_record['is_add'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                } 
                // log user in
                header("location: dashboard.php");
                die();
            } else {
                $_SESSION['sign_in'] = "Incorrect password!";
            }
            
        } else {
            $_SESSION['sign_in'] = "No user found!!";
        }
        
    }


    // redirect if there's any problem
    if (isset($_SESSION['sign_in'])) {
        header("location: signin.php");
        die();
    } 
    
  } else {
    // redirect if submit button wasn't clicked
    header("location: signin.php");
    die();
  }
  