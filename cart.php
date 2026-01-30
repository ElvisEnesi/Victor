<?php 
  include 'partials/database.php';
  include 'header.php';
  // fetch current user
  $current_user = $_SESSION['user_id'];
  // select carts for only logged in user
  $cart_query = "SELECT * FROM carts WHERE customer_id='$current_user' AND status='active' ORDER BY date DESC";
  $cart_result = mysqli_query($connection, $cart_query);
  // stop unauthorised user
  if (!isset($_SESSION['user_id'])) {
    // redirect to login page
    $_SESSION['sign_in'] = "Sign in to access our items!!";
    header("location: signin.php");
    die();
  }
?>

    <?php 
        if (isset($_SESSION['cart_success'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["cart_success"]."</span>";
            echo "</section>";
            unset($_SESSION['cart_success']);
        }
    ?>

    <?php 
        if (isset($_SESSION['payment_error'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["payment_error"]."</span>";
            echo "</section>";
            unset($_SESSION['payment_error']);
        }
    ?>

    <ion-icon id="btn" class="open_btn" onclick="openSideBar()" name="chevron-forward-outline"></ion-icon>
    <ion-icon id="btn" class="close_btn" onclick="closeSideBar()" name="chevron-back-outline"></ion-icon>
    <section class="dashboard">
        <aside id="aside">
            <a href="dashboard.php">Dashboard Overview</a>
            <a href="cart.php" class="active">My cart</a>
            <a href="orders.php">Order History</a>
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
            <?php if (mysqli_num_rows($cart_result) > 0) : ?>
            <h2>My cart</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Buy</th>
                    <th>Delete</th>
                </tr>
                <?php while ($cart = mysqli_fetch_assoc($cart_result)) : ?>
                <?php 
                  $menu_id = $cart['menu_id'];
                  $menu_query = "SELECT * FROM menus WHERE id=$menu_id";
                  $menu_result = mysqli_query($connection, $menu_query);
                  $menu = mysqli_fetch_assoc($menu_result);
                ?>
                <tr>
                    <td><?php echo $menu['food'] ?></td>
                    <td>&#8358;<?php echo $menu['price'] ?></td>
                    <td><a href="cart_payment.php?id=<?php echo $cart['id'] ?>">Proceed to payment</a></td>
                    <td><a href="delete_cart.php?id=<?php echo $cart['id'] ?>" class="error">Remove from cart</a></td>
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