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
        if (isset($_SESSION['edit_user'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_user"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_user']);
        }
    ?>

    <section class="login">
        <h1>Edit Your Names</h1>
        <form action="edit_user_logic.php" method="post">
            <div class="signup_column">
                <input type="hidden" name="id" value="<?php echo $edit['id'] ?>">
                <input type="text" name="first" value="<?php echo $edit['first_name'] ?>" placeholder="First Name">
            </div>
            <div class="signup_column">
                <input type="text" name="last" value="<?php echo $edit['last_name'] ?>" placeholder="Last Name">
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </section>

<?php 
  include 'footer.php';