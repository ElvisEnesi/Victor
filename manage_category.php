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
        if (isset($_SESSION['add_category_success'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["add_category_success"]."</span>";
            echo "</section>";
            unset($_SESSION['add_category_success']); 
        }
    ?>

    <?php 
        if (isset($_SESSION['edit_category_success'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_category_success"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_category_success']);
        }
    ?>

    <?php 
        if (isset($_SESSION['edit_category_error'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_category_error"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_category_error']);
        }
    ?>

    <?php 
        if (isset($_SESSION['delete_cate'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["delete_cate"]."</span>";
            echo "</section>";
            unset($_SESSION['delete_cate']);
        }
    ?>

    <ion-icon id="btn" class="open_btn" onclick="openSideBar()" name="chevron-forward-outline"></ion-icon>
    <ion-icon id="btn" class="close_btn" onclick="closeSideBar()" name="chevron-back-outline"></ion-icon>
    <section class="dashboard">
        <aside id="aside">
            <a href="dashboard.php">Dashboard Overview</a>
            <a href="cart.php">My cart</a>
            <a href="orders.php">Order History</a>
            <?php if (isset($_SESSION['user_is_admin'])) : ?>
            <a href="manage_cart.php">Manage Carts</a>
            <a href="Manage_orders.php">Manage Orders</a>
            <a href="add_menu.php">Add to Menu</a>
            <a href="manage_menu.php">Manage Menu</a>
            <a href="add_category.php">Add Category</a>
            <a href="manage_category.php" class="active">Manage Category</a>
            <a href="users.php">Users</a>
            <?php endif ?>
            <a href="logout.php">Log Out</a>
        </aside>
        <main>
            <?php if (mysqli_num_rows($category_result)) : ?>
            <h2>Manage Categories</h2>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php while ($gotten_categories = mysqli_fetch_assoc($category_result)) : ?>
                <tr>
                    <td><?php echo $gotten_categories['title']; ?></td>
                    <td><a href="edit_category.php?id=<?php echo $gotten_categories['id']; ?>">Edit</a></td>
                    <td><a href="delete_category.php?id=<?php echo $gotten_categories['id']; ?>" class="error">Delete</a></td>
                </tr>
                <?php endwhile ?>
            </table>
            <?php else : ?>
                <span class="no_data">No data to display, try adding!!</span>
            <?php endif ?>
        </main>
    </section>

<?php  
  include 'footer.php';