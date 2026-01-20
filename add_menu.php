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
  // select all categories
  $category_query = "SELECT * FROM category ORDER BY title ASC";
  $category_result = mysqli_query($connection, $category_query);
?>

    <?php 
        if (isset($_SESSION['add_menu'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["add_menu"]."</span>";
            echo "</section>";
            unset($_SESSION['add_menu']);
        }
    ?>


    <h1>Add Menu</h1>
    <section class="reserve">
        <form action="add_menu_logic.php" method="post">
            <input type="text" name="title" placeholder="Food Name">
            <input type="number" name="price" placeholder="Price">
            <input type="hidden" name="availability" placeholder="available?">
            <select name="category">
            <?php while ($gotten_categories = mysqli_fetch_assoc($category_result)) : ?>
                <option value="<?php echo $gotten_categories['id'] ?>"><?php echo $gotten_categories['title'] ?></option>
            <?php endwhile ?>
            </select>
            <button type="submit" name="submit">Submit</button>
        </form>
    </section>

<?php
  include 'footer.php';