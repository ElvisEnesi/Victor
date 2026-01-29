<?php
  include 'partials/database.php';
  // 
  if (isset($_POST['submit'])) {
    // variables
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_avatar = filter_var($_POST['previous_avatar'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $new_avatar = $_FILES['avatar'];
    // check errors
    if ($new_avatar['name']) {
      // work on image
      $time = time(); // make image unique with time stamp
      $avatar_name = $time . $new_avatar['name'];
      $avatar_tmp_name = $new_avatar['tmp_name'];
      $new_avatar_path = 'images/Customers/' . $avatar_name;
      // make sure file is an image
      $allowed_files = ['jpg', 'png', 'jpeg'];
      $extention = explode('.', $avatar_name);
      $extention = end($extention);
      if (in_array($extention, $allowed_files)) {
        // Make sure is < 2mb
        if ($new_avatar['size'] < 2000000) {
          // Upload file
          move_uploaded_file($avatar_tmp_name, $new_avatar_path);
        } else {
          $_SESSION['edit_img'] = "File too big, must be less than 2mb!!";
        }
        
      } else {
        $_SESSION['edit_img'] = "File must be jpg, png or jpeg";
      }
    } else {
      $_SESSION['edit_img'] = "Insert an image!!";
    }

    // redirect to dashboard if there's an error
    if ($_SESSION['edit_img']) {
      header("location: edit_img.php");
      die();
    } else {
      //
      // update image
      $query = "UPDATE customer SET avatars='$avatar_name' WHERE id=$id";
      $result = mysqli_query($connection, $query);
      if (!mysqli_errno($connection)) {
        $previous_avatar_path = 'images/Customers/' . $previous_avatar;
        if ($previous_avatar_path) {
          unlink($previous_avatar_path);
        }
        $_SESSION['edit_img_success'] = "Image successfully updated!!";
        header("location: dashboard.php");
        die();
      } else {
        $_SESSION['edit_img_error'] = "Couldn't update image, try again!!";
        header("location: dashboard.php");
        die();
      }
    }
    
  } 