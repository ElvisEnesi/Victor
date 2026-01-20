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
        if (isset($_SESSION['sign_up'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["sign_up"]."</span>";
            echo "</section>";
            unset($_SESSION['sign_up']);
        }
    ?>

    <section class="login">
        <h1>Sign up</h1>
        <form action="sign_up_logic.php" method="post" enctype="multipart/form-data">
            <div class="signup_column">
                <input type="text" name="first" placeholder="First Name">
            </div>
            <div class="signup_column">
                <input type="text" name="last" placeholder="Last Name">
            </div>
            <div class="signup_column">
                <input type="text" name="user" placeholder="Username">
            </div>
            <div class="signup_column">
                <input type="email" name="email" placeholder="Email">
            </div>
            <div class="signup_column">
                <input type="password" name="create" placeholder="Create password">
            </div>
            <div class="signup_column">
                <input type="password" name="confirm" placeholder="Confirm password">
            </div>
            <input type="file" name="avater">
            <button type="submit" name="submit">Submit</button>
        </form>
        <div class="note">
            Already have an account? <a href="<?= ROOT_URL; ?>signin.php">Sign in</a>
        </div>
    </section>

