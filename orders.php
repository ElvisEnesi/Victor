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
  // fetch current user
  $current_user = $_SESSION['user_id'];
  // select carts for only logged in user
  $order_query = "SELECT * FROM orders WHERE customer_id='$current_user' ORDER BY date DESC";
  $order_result = mysqli_query($connection, $order_query);
?>

    <?php 
        if (isset($_SESSION['payment_success'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["payment_success"]."</span>";
            echo "</section>";
            unset($_SESSION['payment_success']);
        }
    ?>

    <ion-icon id="btn" class="open_btn" onclick="openSideBar()" name="chevron-forward-outline"></ion-icon>
    <ion-icon id="btn" class="close_btn" onclick="closeSideBar()" name="chevron-back-outline"></ion-icon>
    <section class="dashboard">
        <aside id="aside">
            <a href="dashboard.php">Dashboard Overview</a>
            <a href="cart.php">My cart</a>
            <a href="orders.php" class="active">Order History</a>
            <?php if (isset($_SESSION['user_is_admin'])) : ?>
            <a href="manage_cart.php">Manage Carts</a>
            <a href="Manage_orders.php">Manage Orders</a>
            <a href="add_menu.php">Add to Menu</a>
            <a href="manage_menu.php">Manage Menu</a>
            <a href="add_category.php">Add Category</a>
            <a href="manage_category.php">Manage Category</a>
            <a href="users.php">Users</a>
            <?php endif ?>
            <a href="logout.php">Log Out</a>
        </aside>

        <main>
          <?php if (mysqli_num_rows($order_result) > 0) : ?>
            <h2>Orders</h2>
            <table>
                <tr>
                    <th>Status</th>
                    <th>Receipt</th>
                    <th>Date</th>
                </tr>
                <?php while ($order = mysqli_fetch_assoc($order_result)) : ?>
                <tr>
                    <td><?php echo $order['status'] ?></td>
                    <td><a href="./images/Uploads/<?php echo htmlspecialchars($order['payment']) ?>" download="">Download</a></td>
                    <td><?php echo $order['date'] ?></td>
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