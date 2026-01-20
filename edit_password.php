<?php 
  include 'partials/database.php';
  include 'header.php';
  // get id from url
  if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $edit_img_query = "SELECT * FROM customers WHERE id=$id";
    $edit_result = mysqli_query($connection, $edit_img_query);
    $edit = mysqli_fetch_assoc($edit_result);
  } 
?>

    <?php 
        if (isset($_SESSION['edit_password'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_password"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_password']);
        }
    ?>

    <section class="login">
        <h1>Edit Password</h1>
        <form action="edit_password_logic.php" method="post">
            <div class="signup_column">
                <input type="hidden" name="id" value="<?php echo $edit['id'] ?>">
                <input type="password" name="current" placeholder="Current password">
            </div>
            <div class="signup_column">
                <input type="password" name="create" placeholder="Create password">
            </div>
            <div class="signup_column">
                <input type="password" name="confirm" placeholder="Confirm password">
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </section>

<?php 
  include 'footer.php';