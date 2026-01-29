<?php
  include 'partials/database.php'; //
  // get id from url
  if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    // get categories
    $customer_query = "SELECT * FROM customer WHERE id=$id";
    $customer_result = mysqli_query($connection, $customer_query);
    $customer = mysqli_fetch_assoc($customer_result);
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
        <h1>Are you sure you want to delete your account??</h1>
        <ol>
        <form action="delete_user_logic.php" method="post">
            <input type="hidden" name="customer_del" value="<?= $customer['id'] ?>">
            <button type="submit" name="submit">Yes</button>
        </form>
        <button onclick="window.location.href='users.php'">No</button>
        </ol>
    </section>
