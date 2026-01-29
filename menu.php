<?php 
  include 'partials/database.php';
  include 'header.php';
  // select all categories
  $category_query = "SELECT * FROM categories ORDER BY titles ASC";
  $category_result = mysqli_query($connection, $category_query);
?>


    <marquee>
        Check out our black Friday discounts on Fridays!!  
        Check out our black Friday discounts on Fridays!!  
        Check out our black Friday discounts on Fridays!!
    </marquee>
    <section class="search">
        <form action="search.php" method="get">
            <input type="search" name="search" placeholder="Search!!">
            <button type="submit" name="submit">Go</button>
        </form>
    </section>
    <h1>Our Menu</h1>
    <section class="category">
        <?php while ($gotten_categories = mysqli_fetch_assoc($category_result)) : ?>
        <a href="category.php?id=<?php echo $gotten_categories['id'] ?>"><?php echo $gotten_categories['titles'] ?></a>
        <?php endwhile ?>
    </section>
    <section class="menu">
        <?php 
          // fetching current user
          $current_user = $_SESSION['user_id'];
          // fetch customer id
          $customer_query = "SELECT * FROM customer WHERE id='$current_user'";
          $customer_result = mysqli_query($connection, $customer_query);
          $customer = mysqli_fetch_assoc($customer_result);
          // fetch menu details
          $food_query = "SELECT * FROM menus ORDER BY category_id DESC";
          $food_result = mysqli_query($connection, $food_query);
          while ($food = mysqli_fetch_assoc($food_result)) :
        ?>
        <div class="menu_card">
            <h3><?php echo $food['food'] ?></h3>
            <h3>&#8358;<?php echo $food['price'] ?></h3>
            <form action="secure_cart.php" method="post">
                <input type="hidden" name="customer_id" value="<?php echo $customer['id'] ?>">
                <input type="hidden" name="food_id" value="<?php echo $food['id'] ?>">
                <?php if (isset($_SESSION['user_id'])) : ?>
                <button type="submit" name="submit"><ion-icon name="bag-handle-outline"></ion-icon></button>
                <?php else : ?>
                <button type="submit" name="signin"><ion-icon name="bag-handle-outline"></ion-icon></button>
                <?php endif ?>
            </form>
        </div>
        <?php endwhile ?>
    </section>

    
<?php 
  include 'footer.php';