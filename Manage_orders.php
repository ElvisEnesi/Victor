<?php 
  include 'partials/database.php';
  include 'header.php';
  $order_query = "SELECT * FROM orderss ORDER BY date ASC";
  $order_result = mysqli_query($connection, $order_query); 
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
            <a href="Manage_orders.php" class="active">Manage Orders</a>
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
            <h2>Manage Orders</h2>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Cart id</th>
                    <th>Customer ID</th>
                    <th>Menu ID</th>
                    <th>Receipt</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
                <?php while ($order = mysqli_fetch_assoc($order_result)) : ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= $order['cart_id'] ?? 'deleted' ?></td>
                    <td><?= $order['customer_id'] ?? 'deleted' ?></td>
                    <td><?= $order['menu_id'] ?? 'deleted' ?></td>
                    <td><a href="./images/Uploads/<?php echo htmlspecialchars($order['receipt']) ?>" download="">Download</a></td>
                    <td><?= $order['status'] ?></td>
                    <td><?= $order['date'] ?></td>
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