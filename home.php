<?php
  include 'components/connect.php';

  session_start();

  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
  }else {
    $user_id = '';
  }

  include 'components/wishlist_cart.php';
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
  <section class="home-products">
    <h1 class="heading">últimos productos</h1>
    <div class="swiper products-slider">
      <div class="swiper-wrapper">
        <?php
          $select_products = $connect->prepare("SELECT * FROM `products` LIMIT 6");
          $select_products->execute();
          if($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch (PDO::FETCH_ASSOC)){
        ?>
        <form action="" method="post" class="slide swiper-slide">
          <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
          <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
          <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
          <input type="hidden" name="image" value="<?= $fetch_products['image_01']; ?>">

          <button type="submit" name="add_to_wishlist" class="fas fa-heart"></button>
          <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
          <img src="uploaded_img/<?= $fetch_products['image_01']; ?>" class="image" alt="image_products">
          <div class="name"><?= $fetch_products['name']; ?></div>
          <div class="flex">
            <div class="price">RD$<span><?= $fetch_products['price']; ?></span>/-</div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1"
              onkeypress="if(this.value.length == 2) return false;">
          </div>
          <input type="submit" value="añadir al carrito" name="add_to_cart" class="btn">
        </form>
        <?php
            }
          }else {
            echo '< class= "empty">¡Aún no se han añadido productos!</p>';
          }
        ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </section>
  <!-- Home products section ends -->


  <?php include 'components/footer.php'; ?>
  <!-- Link Swiper js -->
  <script src=" https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
  <!-- Custom js file link -->
  <script src="js/main.js"></script>
</body>

</html>