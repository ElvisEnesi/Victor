<?php
  include 'partials/database.php';
  // 
  if (isset($_POST['submit'])) {
    # code... variables
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // check errors
    if (!$category || !$price || !$title) {
        $_SESSION['edit_menu'] = "Fill all fields!!"; 
    } elseif (!is_numeric($price)) {
        $_SESSION['edit_menu'] = "Price must be a number";
    }

    if (isset($_SESSION['edit_menu'])) {
        # code... redirect back to edit menu page
        header("location: edit_menu.php");
        die();
    } else {
        # code...  update menu
        $update = "UPDATE menus SET category_id=$category, price=$price, food='$title' WHERE id=$id";
        $query = mysqli_query($connection, $update);
        if (!mysqli_errno($connection)) {
            # code... redirect to manage menu with success message
            $_SESSION['edit_menu_success'] = "Menu successfully updated!!";
            header("location: manage_menu.php");
            die();
        } else {
            # code... redirect to manage menu with error message
            $_SESSION['edit_menu_error'] = "Couldn't update menu, try again!!";
            header("location: manage_menu.php");
            die();
        }
        
    }
    
  }