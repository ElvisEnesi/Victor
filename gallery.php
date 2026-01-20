<?php 
  include 'header.php';
?>


    <h1>Gallery</h1>
    <section class="slideshow">
        <div class="myslides fade">
            <img src="./images/Gallery/Slideshow/beans.jpeg">
            <div class="caption">Porridge beans & plantains</div>
        </div>
        <div class="myslides fade">
            <img src="./images/Gallery/Slideshow/ice.jpeg">
            <div class="caption">Ice cream</div>
        </div>
        <div class="myslides fade">
            <img src="./images/Gallery/Slideshow/pondi.jpeg">
            <div class="caption">Pounded yam & egusi</div>
        </div>
        <div class="myslides fade">
            <img src="./images/Gallery/Slideshow/jollof.jpeg">
            <div class="caption">Jollof rice with chicken & salad</div>
        </div>
        <div class="myslides fade">
            <img src="./images/Gallery/Slideshow/spag.jpeg">
            <div class="caption">Spaghetti</div>
        </div>
        <div class="myslides fade">
            <img src="./images/Gallery/Slideshow/potato.jpeg">
            <div class="caption">Potato with plantain & egg</div>
        </div>
        <a onclick="pluSlides(-1)" class="prev">&#10094;</a>
        <a onclick="pluSlides(1)" class="next">&#10095;</a>
    </section>
    <section class="row">
        <div class="img_col">
            <img src="./images/Menu/Dessert/ice.jpeg">
            <img src="./images/Menu/Dessert/smoothie.jpeg">
            <img src="./images/Menu/Light/frichik.jpeg">
            <img src="./images/Menu/Swallow/pondi.jpeg">
        </div>
                <div class="img_col">
            <img src="./images/Menu/Meat/chic.jpeg">
            <img src="./images/Menu/Snacks/meatpie.jpeg">
            <img src="./images/Menu/Swallow/eba.jpeg">
            <img src="./images/Menu/Light/jollof.jpeg">
        </div>
        <div class="img_col">
            <img src="./images/Menu/Light/potato.jpeg">
            <img src="./images/Menu/Snacks/shawrama.jpeg">
            <img src="./images/Menu/Swallow/oha.jpeg">
            <img src="./images/Menu/Light/yam&egg.jpeg">
        </div>
        <div class="img_col">
            <img src="./images/Menu/Snacks/pizza.jpeg">
            <img src="./images/Menu/Meat/goat.jpeg">
            <img src="./images/Menu/Light/spag.jpeg">
            <img src="./images/Menu/Swallow/okro.jpeg">
        </div>
    </section>

<?php 
  include 'footer.php';