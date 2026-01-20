<?php 
  include 'header.php';
  // stop unauthorised users
  if (!isset($_SESSION['user_id'])) {
    // redirect to login page
    $_SESSION['sign_in'] = "Sign in to access your dashboard!!";
    header("location: signin.php");
    die();
  }
?>
    <?php 
        if (isset($_SESSION['add_category'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["add_category"]."</span>";
            echo "</section>";
            unset($_SESSION['add_category']);
        }
    ?>
    <h1>Add Category</h1>
    <section class="reserve">
        <form action="add_category_logic.php" method="post">
            <input type="text" name="title" placeholder="Name">
            <textarea name="description" placeholder="Description"></textarea>
            <button type="submit" name="submit">Submit</button>
        </form>
    </section>

<?php 
  include 'footer.php';