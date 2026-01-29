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
  // fetch users except current user
  $current_admin_user = $_SESSION['user_id'];
  $get_user_query = "SELECT * FROM customer WHERE NOT id=$current_admin_user";
  $get_user_result = mysqli_query($connection, $get_user_query);
?>

    <?php 
        if (isset($_SESSION['user_cate'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["user_cate"]."</span>";
            echo "</section>";
            unset($_SESSION['user_cate']);
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
            <a href="manage_category.php">Manage Category</a>
            <a href="users.php" class="active">Users</a>
            <?php endif ?>
            <a href="logout.php">Log Out</a>
        </aside>
        <main>
            <?php if (mysqli_num_rows($get_user_result)) : ?>
            <h2>Users</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Edit</th>
                </tr>
                <?php while ($gotten_user = mysqli_fetch_assoc($get_user_result)) : ?>
                <tr>
                    <td><?php echo $gotten_user['id'] ?></td>
                    <td><?php echo "{$gotten_user['firstname']} {$gotten_user['lastname']}"; ?></td>
                    <td><?php echo $gotten_user['username']; ?></td>
                    <td><?php echo $gotten_user['emails']; ?></td>
                    <td><?php echo $gotten_user['is_add'] ? 'yes' : 'no' ; ?></td>
                    <td><a href="delete_customer.php?id=<?php echo $gotten_user['id']; ?>" class="error">Delete</a></td>
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