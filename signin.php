<?php 
  include 'partials/database.php';
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
    <?php 
        if (isset($_SESSION['sign_up_success'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["sign_up_success"]."</span>";
            echo "</section>";
            unset($_SESSION['sign_up_success']);
        }
    ?>
    <?php 
        if (isset($_SESSION['sign_in'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["sign_in"]."</span>";
            echo "</section>";
            unset($_SESSION['sign_in']);
        }
    ?>
    <section class="login">
        <h1>Sign in</h1>
        <form action="signin_logic.php" method="post">
            <div class="login_column">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" name="email" placeholder="Email">
            </div>
            <div class="login_column">
                <ion-icon name="key-outline"></ion-icon>
                <input type="password" name="password" placeholder="Password">
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
        <div class="note">
            Don't have an account? <a href="signup.php">Sign up</a>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


