<?php
  // include database
  include 'partials/database.php';
  // add category logic
  if (isset($_POST['submit'])) {
    // declare variables
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // ensure all fields are filled
    if (!$title || !$description) {
        $_SESSION['add_category'] = "Fill all inputs";
    } 
    if (isset($_SESSION['add_category'])) {
        header("location: add_category.php");
        die();
    } else {
        $insert_category_query = "INSERT INTO category SET title='$title', description='$description'";
        $insert_category_result = mysqli_query($connection, $insert_category_query);
        if (!mysqli_errno($connection)) {
            $_SESSION['add_category_success'] = "Category successfully added!!";
            header("location: manage_category.php");
            die();
        } 
    }
    
    
  } else {
    header("location: add_category.php");
    die();
  }
  