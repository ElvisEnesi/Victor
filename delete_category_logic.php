<?php
  include 'partials/database.php'; //
  // logic
  if (isset($_POST['submit'])) {
    // varables
    $id = filter_var($_POST['category_del'], FILTER_SANITIZE_NUMBER_INT);
    // update
    $update = "UPDATE menus SET category_id=4 WHERE category_id=$id";
    $result = mysqli_query($connection, $update);
    if (!mysqli_errno($connection)) {
        // delete 
        $delete = "DELETE FROM categories WHERE id=$id LIMIT 1";
        $query = mysqli_query($connection, $delete);
        $_SESSION['delete_cate'] = "Category deleted successfully!!";
        header("location: manage_category.php");
        die();
    }
  }