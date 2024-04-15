<?php
  include 'components/connect.php';

  session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
}else {
  $user_id = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="../icons/V-T.svg" type="image/x-icon">
  <!-- Link Swipers CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
  <!-- Font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <!-- Custom css file link -->
  <link rel="stylesheet" href="css/main.css">
</head>

<body>
  <?php include 'components/user_header.php'; ?>

  <div class="home-bg">
    <!-- Home section starts -->
    <section class="swiper home-slider">
      <div class="swiper-wrapper">
        <div class="swiper-slide slide">
          <div class="image">
            <img src="images/home-img-1.png" alt="Image Slider">
          </div>
          <div class="content">
            <span>Hasta 50% de rebaja</span>
            <h3>último teléfono inteligentes</h3>
            <a href="shop.php" class="btn">Compra ahora</a>
          </div>
        </div>

        <div class="swiper-slide slide">
          <div class="image">
            <img src="images/home-img-2.png" alt="Image Slider">
          </div>
          <div class="content">
            <span>Hasta 50% de rebaja</span>
            <h3>últimos relojes</h3>
            <a href="shop.php" class="btn">Compra ahora</a>
          </div>
        </div>

        <div class="swiper-slide slide">
          <div class="image">
            <img src="images/home-img-3.png" alt="Image Slider">
          </div>
          <div class="content">
            <span>Hasta 50% de rebaja</span>
            <h3>últimos auriculares</h3>
            <a href="shop.php" class="btn">Compra ahora</a>
          </div>
        </div>
      </div>

      <div class="swiper-pagination"></div>
    </section>
    <!-- Home section ends -->
  </div>

  <!-- Home category section starts -->
  <section class="home-category">
    <h1 class="heading">Compra por categoría</h1>

    <div class="swiper category-slider">
      <div class="swiper-wrapper">
        <a href="category.php?category=laptop" class="swiper-slide slide">
          <img src="images/icon-1.png" alt="Category Images">
          <h3>Laptops</h3>
        </a>

        <a href="category.php?category=tv" class="swiper-slide slide">
          <img src="images/icon-2.png" alt="Category Images">
          <h3>Televisores</h3>
        </a>

        <a href="category.php?category=camera" class="swiper-slide slide">
          <img src="images/icon-3.png" alt="Category Images">
          <h3>Camaras</h3>
        </a>

        <a href="category.php?category=mouse" class=" swiper-slide slide">
          <img src="images/icon-4.png" alt="Category Images">
          <h3>Mouses</h3>
        </a>

        <a href="category.php?category=fridge" class=" swiper-slide slide">
          <img src="images/icon-5.png" alt="Category Images">
          <h3>Neveras</h3>
        </a>

        <a href="category.php?category=washing" class=" swiper-slide slide">
          <img src="images/icon-6.png" alt="Category Images">
          <h3>Lavadoras</h3>
        </a>

        <a href="category.php?category=smartphone" class=" swiper-slide slide">
          <img src="images/icon-7.png" alt="Category Images">
          <h3>Teléfonos</h3>
        </a>

        <a href="category.php?category=watch" class=" swiper-slide slide">
          <img src="images/icon-8.png" alt="Category Images">
          <h3>Reloj</h3>
        </a>
      </div>

      <div class="swiper-pagination"></div>
    </div>
  </section>
  <!-- Home category section ends -->

  <!-- Home products section starts -->
  <section class="home-products"></section>
  <!-- Home products section ends -->


  <?php include 'components/footer.php'; ?>
  <!-- Link Swiper js -->
  <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
  <!-- Custom js file link -->
  <script src="js/main.js"></script>
</body>

</html>