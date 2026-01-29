<?php 
  include 'partials/database.php';
  include 'header.php';
  // get id from url
  if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    // get categories
    $category_query = "SELECT * FROM categories WHERE id=$id";
    $category_result = mysqli_query($connection, $category_query);
    $category = mysqli_fetch_assoc($category_result);
  } 
?>

    <?php 
        if (isset($_SESSION['edit_menu'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_menu"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_menu']);
        }
    ?>

    <h1>Edit Category</h1>
    <section class="reserve">
        <form action="edit_category_logic.php" method="post">
            <input type="hidden" name="id" value="<?php echo $category['id'] ?>">
            <input type="text" name="title" value="<?php echo $category['titles'] ?>" placeholder="Name">
            <textarea name="description" value="<?php echo $category['descriptions'] ?>" placeholder="Description"><?php echo $category['descriptions'] ?></textarea>
            <button type="submit" name="submit">Submit</button>
        </form>
    </section>

<?php 
  include 'footer.php';