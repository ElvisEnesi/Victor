    <section class="footer">
        <div class="col">
            <a href="gallery.php">Gallery</a>
            <a href="about.php">About us</a>
            <a href="service.php">Servics</a>
            <a href="contact.php">Contact us</a>
        </div>
        <div class="col">
            <a href="policy.php">Policy</a>
            <a href="term.php">T&C</a>
            <a href="refund.php">Cancel & Refunds</a>
            <a href="mailto:victorolukoya22@gmail.com">Customer Care</a>
        </div>
        <div class="socials">
            <a onclick="alert('URL unavailable!!')" href=""><ion-icon name="logo-facebook"></ion-icon></a>
            <a onclick="alert('URL unavailable!!')" href=""><ion-icon name="logo-instagram"></ion-icon></a>
            <a onclick="alert('URL unavailable!!')" href=""><ion-icon name="logo-twitter"></ion-icon></a>
            <a onclick="alert('URL unavailable!!')" href=""><ion-icon name="logo-discord"></ion-icon></a>
        </div>
        <div class="col">
            <form action="" method="post">
                <h3>JOIN US!!</h3>
                <label for="email">Email*</label>
                <input type="email" name="email">
                <?php if (isset($_SESSION['user_id'])) : ?>
                <button type="submit" name="submit">Subscibe</button>
                <?php else : ?>
                <button type="submit" name="signin">Subscibe</button>
                <?php endif ?>
            </form>
        </div>
    </section>
    <script src="./main/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</php>