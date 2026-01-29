<?php
  include 'partials/database.php';
  // 
  if (isset($_POST['submit'])) {
    // variables
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // check errors
    if (!$title || !$description) {
        $_SESSION['edit_category'] = "Fill all fields!!"; 
    }

    if (isset($_SESSION['edit_category'])) {
        // redirect back to edit category page
        header("location: edit_category.php");
        die();
    } else {
        //  update category
        $update = "UPDATE categories SET titles='$title', descriptions='$description' WHERE id=$id";
        $query = mysqli_query($connection, $update);
        if (!mysqli_errno($connection)) {
            // redirect to manage category with success message
            $_SESSION['edit_category_success'] = "category successfully updated!!";
            header("location: manage_category.php");
            die();
        } else {
            // redirect to manage category with error message
            $_SESSION['edit_category_error'] = "Couldn't update category, try again!!";
            header("location: manage_category.php");
            die();
        }
        
    }
    
  }