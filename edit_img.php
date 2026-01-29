<?php 
  include 'partials/database.php';
  include 'header.php';
  // get id from url
  if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $edit_img_query = "SELECT * FROM customer WHERE id=$id";
    $edit_result = mysqli_query($connection, $edit_img_query);
    $edit = mysqli_fetch_assoc($edit_result);
  } 
?>

    <?php 
        if (isset($_SESSION['edit_img'])) {
            echo "<section class='pay_details'>";
            echo "<span class='notice'>".$_SESSION["edit_img"]."</span>";
            echo "</section>";
            unset($_SESSION['edit_img']);
        }
    ?>

    <section class="login">
        <h1>Edit Profile Image</h1>
        <form action="edit_img_logic.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $edit['id'] ?>">
            <input type="hidden" name="previous_avatar" value="<?php echo $edit['avatar'] ?>">
            <input type="file" name="avatar">
            <button type="submit" name="submit">Submit</button>
        </form>
    </section>

<?php 
  include 'footer.php';