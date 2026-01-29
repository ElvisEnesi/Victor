<?php 
  include 'partials/database.php';
  include 'header.php';
  // get id from url
  if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $edit_img_query = "SELECT * FROM menus WHERE id=$id";
    $edit_result = mysqli_query($connection, $edit_img_query);
    $edit = mysqli_fetch_assoc($edit_result);
  } 
  // get categories
  $category_query = "SELECT * FROM categories";
  $category_result = mysqli_query($connection, $category_query);
?>

    <?php 
        if (isset($_SESSION['edit_menu'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_menu"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_menu']);
        }
    ?>

    <h1>Edit Menu</h1>
    <section class="reserve">
        <form action="edit_menu_logic.php" method="post">
            <input type="hidden" name="id" value="<?php echo $edit['id'] ?>">
            <input type="text" name="title" value="<?php echo $edit['food'] ?>" placeholder="Food Name">
            <input type="number" name="price" value="<?php echo $edit['price'] ?>" placeholder="Price">
            <select name="category">
                <?php while ($category = mysqli_fetch_assoc($category_result)) : ?>
                <option value="<?php echo $category['id'] ?>"><?php echo $category['titles'] ?></option>
                <?php endwhile ?>
            </select>
            <button type="submit" name="submit">Submit</button>
        </form>
    </section>

<?php 
  include 'footer.php';