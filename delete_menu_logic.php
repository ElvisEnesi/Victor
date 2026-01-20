<?php
  include 'partials/database.php'; //
  // logic
  if (isset($_POST['submit'])) {
    // varables
    $id = filter_var($_POST['menu_del'], FILTER_SANITIZE_NUMBER_INT);
    // delete
    $delete = "DELETE FROM menu WHERE id=$id LIMIT 1";
    $query = mysqli_query($connection, $delete);
    if (!mysqli_errno($connection)) {
        $_SESSION['menu_cate'] = "Menu deleted successfully!!";
        header("location: manage_menu.php");
        die();
    }
  }