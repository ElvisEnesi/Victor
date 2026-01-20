<?php 
  include 'partials/database.php';
  include 'header.php';
  // get id from url
  if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    // fetch current user
    $current_user = $_SESSION['user_id'];
    $customer_query = "SELECT * FROM customers WHERE id='$current_user'";
    $customer_result = mysqli_query($connection, $customer_query);
    $customer = mysqli_fetch_assoc($customer_result);
    // select carts for only logged in user
    $cart_query = "SELECT * FROM cart WHERE id=$id";
    $cart_result = mysqli_query($connection, $cart_query);
    $cart = mysqli_fetch_assoc($cart_result); 
  } 
?>

    <?php 
        if (isset($_SESSION['payment'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["payment"]."</span>";
            echo "</section>";
            unset($_SESSION['payment']);
        }
    ?>


    <section class="pay_details">
        <span class="notice">
            Ensure payments are made to this account and payment receipt screenshot
            sent via form below!!
        </span>
        <span>9068627622 OPAY<br> Victor Olukoya</span>
    </section>
    <section class="reserve">
        <form action="cart_payment_logic.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="customer_id" value="<?php echo $customer['id'] ?>">
            <input type="hidden" name="menu_id" value="<?php echo $cart['menu_id'] ?>">
            <input type="hidden" name="cart_id" value="<?php echo $cart['id'] ?>">
            <input type="text" name="address" placeholder="Campus Address">
            <input type="text" name="phone" placeholder="Phone Number">
            <input type="file" name="receipt">
            <button type="submit" name="submit">Submit</button>
        </form>
    </section>

<?php 
  include 'footer.php';