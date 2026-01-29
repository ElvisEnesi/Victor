<?php 
  include 'header.php';
  include 'partials/database.php';
  // stop unauthorised users
  if (!isset($_SESSION['user_id'])) {
    // redirect to login page
    $_SESSION['sign_in'] = "Sign in to access your dashboard!!";
    header("location: signin.php");
    die();
  }
  // fetch all menu
  $menu_query = "SELECT * FROM menus ORDER BY category_id ASC";
  $menu_result = mysqli_query($connection, $menu_query);
?>

    <?php 
        if (isset($_SESSION['add_menu_success'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["add_menu_success"]."</span>";
            echo "</section>";
            unset($_SESSION['add_menu_success']);
        }
    ?>

    <?php 
        if (isset($_SESSION['edit_menu_success'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_menu_success"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_menu_success']);
        }
    ?>

    <?php 
        if (isset($_SESSION['edit_menu_error'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_menu_error"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_menu_error']);
        }
    ?>

    <?php 
        if (isset($_SESSION['menu_cate'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["menu_cate"]."</span>";
            echo "</section>";
            unset($_SESSION['menu_cate']);
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
            <a href="manage_menu.php" class="active">Manage Menu</a>
            <a href="add_category.php">Add Category</a>
            <a href="manage_category.php">Manage Category</a>
            <a href="users.php">Users</a>
            <?php endif ?>
            <a href="logout.php">Log Out</a>
        </aside>
        <main>
            <?php if (mysqli_num_rows($menu_result) > 0) : ?>
            <h2>Manage Menu</h2>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Availability</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                <?php while ($gotten_menu = mysqli_fetch_assoc($menu_result)) : ?>
                <?php 
                  $category_id = $gotten_menu['category_id'];
                  $category_query = "SELECT * FROM categories WHERE id=$category_id";
                  $category_result = mysqli_query($connection, $category_query);
                  $category = mysqli_fetch_assoc($category_result);
                ?>
                <tr>
                    <td><?php echo $gotten_menu['food']; ?></td>
                    <td><?php echo $category['titles'] ?></td>
                    <td>&#8358;<?php echo $gotten_menu['price']; ?></td>
                    <td><?php echo $gotten_menu['availability'] ? 'yes' : 'no' ?></td>
                    <td><a href="edit_menu.php?id=<?php echo $gotten_menu['id'] ?>">Edit</a></td>
                    <td><a href="delete_menu.php?id=<?php echo $gotten_menu['id'] ?>" class="error">Delete</a></td>
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