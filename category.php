<?php 
  include 'partials/database.php';
  include 'header.php';
  // select all categories
  if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    // fetching categories link
    $category_query = "SELECT * FROM categories ORDER BY titles ASC";
    $category_result = mysqli_query($connection, $category_query);
    // fetching menu under each category
    $food_query = "SELECT * FROM menus WHERE category_id=$id ORDER BY category_id DESC";
    $food_result = mysqli_query($connection, $food_query);

  } else {
    header("location: menu.php");
    die();
  }
  
?>

    <section class="title">
        <?php 
          $category_id = $id;
          $category_header = "SELECT * FROM categories WHERE id=$id";
          $category_header_result = mysqli_query($connection, $category_header);
          $category = mysqli_fetch_assoc($category_header_result);
        ?>
        <h1><?= $category['titles'] ?></h1>
    </section>
    <section class="category">
        <?php while ($gotten_categories = mysqli_fetch_assoc($category_result)) : ?>
        <a href="category.php?id=<?php echo $gotten_categories['id'] ?>"><?php echo $gotten_categories['titles'] ?></a>
        <?php endwhile ?>
    </section>
    <?php if (mysqli_num_rows($food_result) > 0) : ?>
    <section class="menu">
        <?php 
          // fetching current user
          $current_user = $_SESSION['user_id'] ?? null;
          // fetch customer id
          $customer_query = "SELECT * FROM customer WHERE id='$current_user'";
          $customer_result = mysqli_query($connection, $customer_query);
          $customer = mysqli_fetch_assoc($customer_result);
        ?>
        <?php  while ($food = mysqli_fetch_assoc($food_result)) : ?>
        <?php 
            $price = $food['price'];
            $discount = $food['discount_percent'];
            $is_black_friday = $food['is_black_friday'];

            $date = date('Y-m-d');
            if ($discount_date = ($date === '2026-11-29')) {
                $is_black_friday = true;
                if ($is_black_friday = true) {
                    $final_price = $price - ($price * $discount / 100);
                } else {
                    $final_price = $price;
                }
            } else {
                $is_black_friday = false;
            }
        ?>
        <div class="menu_card">
            <h3><?php echo $food['food'] ?></h3>
            <h3>&#8358;
            <?php
                if ($is_black_friday && $discount > 0) {
                    echo "<del>" . number_format($price) . "</del> ";
                    echo "<strong>" . number_format($final_price) . "</strong>";
                } else {
                    echo number_format($price);
                }
            ?>
        </h3>
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
    <?php else : ?>
    <section class="title">
        <h2>No menu under this category!!</h>
    </section>
    <?php endif ?>

<?php  
  include 'footer.php';