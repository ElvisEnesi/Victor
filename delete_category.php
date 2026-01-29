<?php
  include 'partials/database.php'; //
  // get id from url
  if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    // get categories
    $category_query = "SELECT * FROM categories WHERE id=$id";
    $category_result = mysqli_query($connection, $category_query);
    $category = mysqli_fetch_assoc($category_result);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custech Restaurant</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <section class="must_know">
        <h1>Are you sure you want to delete this category??</h1>
        <ol>
        <form action="delete_category_logic.php" method="post">
            <input type="hidden" name="category_del" value="<?= $category['id'] ?>">
            <button type="submit" name="submit">Yes</button>
        </form>
        <button onclick="window.location.href='manage_category.php'">No</button>
        </ol>
    </section>
