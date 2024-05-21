<?php
session_start();

include("../nav.php"); 

?>

<html>
<head>
  <link rel="stylesheet" href="../style.css">
</head>

<body>
<section class="banner">
      <div class="hero-section space-sections ">
        <div class="hero-content">
          <h1 class="heading-hero">Welcome to FarmTech: Your Gateway to Cutting-Edge Farm Vehicles</h1>
          <p class="para">At FarmTech, we're dedicated to revolutionizing your farming experience with our extensive selection of top-of-the-line farm vehicles. 
            <br><br> With FarmTech, you can expect unparalleled quality, reliability, and performance in every farm vehicle you purchase.</p>
        </div>
        <div class="hero-image">
          <img src="../images/hero-banner.jpg" alt="Hero Image">
          <div class="overlay">
            <p>Cultivation<br><br><br> Harvesting <br><br><br> Livestock.</p>
          </div>
        </div>
      </div>
    </section>
</section>
<section class="top-selling-categories space-sections">
      <h2 class="heading">Our Product Categories</h2>
      <div class="categories">
        <div class="category-type">
          <div class="image-container">
            <img src="../images/tractor.jpg" alt="Tractors">
          </div>
          <p class="sub-heading">Tractors</p>
        </div>
        <div class="category-type">
          <div class="image-container">
            <img src="../images/harvestor.jpg" alt="Harvesters">
          </div>
          <p class="sub-heading">Harvesters</p>
        </div>
        <div class="category-type">
          <div class="image-container">
            <img src="../images/planter-seeders.jpg" alt="Planters and Seeders">
          </div>
          <p class="sub-heading">Planters and Seeders</p>
        </div>
        <div class="category-type">
          <div class="image-container">
            <img src="../images/sprayer.jpg" alt="Sprayers">
          </div>
          <p class="sub-heading">Sprayers</p>
        </div>
      </div>
    </section>
     <!-- Include footer -->
  <?php include("../footer.php"); ?>
    </body>
</html>



