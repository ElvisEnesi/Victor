<?php
  //
  include 'partials/database.php';
  // 
  if (isset($_POST['submit'])) {
    // declare variables
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $availability = filter_var($_POST['availability'], FILTER_SANITIZE_NUMBER_INT);
    // the logic
    if (!$title || !$price || !$category_id) {
      $_SESSION['add_menu'] = "Fill all fields!!";
    } else {
        if (!is_numeric($price)) {
          $_SESSION['add_menu'] = "Price must be a number!!";
        }
    }



    if (isset($_SESSION['add_menu'])) {
      header("location: add_menu.php");
      die();
    } else {
      $menu_insert_query = "INSERT INTO menus SET food='$title', price='$price', availability=1, category_id=$category_id";
      $menu_insert_result = mysqli_query($connection, $menu_insert_query);
      if (!mysqli_errno($connection)) {
        $_SESSION['add_menu_success'] = "Menu added successfully!!";
        header("location: manage_menu.php");
        die();
      }
    }
    


  } else {
    //
    header("location: add_menu.php");
    die();
  }
  