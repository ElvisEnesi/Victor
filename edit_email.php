<?php 
  include 'partials/database.php';
  include 'header.php';
  // stop unauthorised users
  if (!isset($_SESSION['user_id'])) {
    // redirect to login page
    $_SESSION['sign_in'] = "Sign in to access your dashboard!!";
    header("location: signin.php");
    die();
  }
  // get id from url
  if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $edit_img_query = "SELECT * FROM customer WHERE id=$id";
    $edit_result = mysqli_query($connection, $edit_img_query);
    $edit = mysqli_fetch_assoc($edit_result);
  } 
?>

    <?php 
        if (isset($_SESSION['edit_email'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_email"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_email']);
        }
    ?>

    <section class="login">
        <h1>Edit Email</h1>
        <form action="edit_email_logic.php" method="POST">
            <div class="signup_column">
                <input type="hidden" name="id" value="<?php echo $edit['id'] ?>">
                <input type="email" name="email" value="<?php echo $edit['email'] ?>" placeholder="Email">
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </section>

<?php 
  include 'footer.php';