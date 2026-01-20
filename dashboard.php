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
  // select users details //
  $current_user = $_SESSION['user_id'];
  $user_details = "SELECT * FROM customers WHERE id='$current_user'";
  $user_details_result = mysqli_query($connection, $user_details);
  $user_display = mysqli_fetch_assoc($user_details_result);
?>

    <?php 
        if (isset($_SESSION['edit_img_success'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_img_success"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_img_success']);
        }
    ?>

    <?php 
        if (isset($_SESSION['edit_img_error'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_img_error"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_img_error']);
        }
    ?>

    <?php 
        if (isset($_SESSION['edit_user_success'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_user_success"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_user_success']);
        }
    ?>

    <?php 
        if (isset($_SESSION['edit_user_error'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_user_error"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_user_error']);
        }
    ?>


    <?php 
        if (isset($_SESSION['edit_user_name_success'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_user_name_success"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_user_name_success']);
        }
    ?>

    <?php 
        if (isset($_SESSION['edit_user_name_error'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_user_name_error"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_user_name_error']);
        }
    ?>

    <?php 
        if (isset($_SESSION['edit_email_success'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_email_success"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_email_success']);
        }
    ?>

    <?php 
        if (isset($_SESSION['edit_email_error'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_email_error"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_email_error']);
        }
    ?>

    <?php 
        if (isset($_SESSION['edit_password_success'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_password_success"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_password_success']);
        }
    ?>

    <?php 
        if (isset($_SESSION['edit_password_error'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_password_error"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_password_error']);
        }
    ?>

    <ion-icon id="btn" class="open_btn" onclick="openSideBar()" name="chevron-forward-outline"></ion-icon>
    <ion-icon id="btn" class="close_btn" onclick="closeSideBar()" name="chevron-back-outline"></ion-icon>
    <section class="dashboard">
        <aside id="aside">
            <a href="dashboard.php" class="active">Dashboard Overview</a>
            <a href="cart.php">My cart</a>
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
            <div class="profile_img">
                <img src="./images/Customers/<?php echo $user_display['avatar']; ?>" alt="Can't show image, try updating it!!">
                <div class="icon">
                    <a href="edit_img.php?id=<?php echo $user_display['id']; ?>">
                        <ion-icon name="create-outline"></ion-icon>
                    </a>
                </div>
            </div>
            <div class="info">
                <p>Name: <?php echo "{$user_display['first_name']} {$user_display['last_name']}"; ?></p>
                <a href="edit_user.php?id=<?php echo $user_display['id']; ?>"><ion-icon name="create-outline"></ion-icon></a>
            </div>
            <div class="info">
                <p>Username: <?php echo $user_display['user_name']; ?></p>
                <a href="edit_user_name.php?id=<?php echo $user_display['id']; ?>"><ion-icon name="create-outline"></ion-icon></a>
            </div>
            <div class="info">
                <p>Email: <?php echo $user_display['email']; ?></p>
                <a href="edit_email.php?id=<?php echo $user_display['id']; ?>"><ion-icon name="create-outline"></ion-icon></a>
            </div>
            <div class="butts">
                <a href="edit_password.php?id=<?php echo $user_display['id']; ?>">Change password</a>
                <a href="delete_user.php?id=<?php echo $user_display['id']; ?>">Delete account</a>
            </div>
        </main>
    </section>

<?php 
  include 'footer.php';