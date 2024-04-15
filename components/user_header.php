<?php 
    if (isset($message)) {
      foreach($message as $message){
        echo ' 
        <div class="message">
          <span>'.$message.'</span>
          <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
      }
    }
  ?>

<header class="header">
  <section class="flex">
    <a href="dashboard.php" class="logo">S<span>hopie</span></a>

    <nav class="navbar">
      <a href="home.php">Inicio</a>
      <a href="about.php">Acerca de</a>
      <a href="orders.php">Pedidos</a>
      <a href="shop.php">Tienda</a>
      <a href="contact.php">Contactos</a>
    </nav>

    <div class="icons">
      <?php
        $count_wishlist_items = $connect->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
        $count_wishlist_items->execute([$user_id]);
        $total_wishlist_counts = $count_wishlist_items->rowCount();

        $count_cart_items = $connect->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $count_cart_items->execute([$user_id]);
        $total_cart_counts = $count_cart_items->rowCount();
      ?>

      <div id="menu-btn" class="fas fa-bars"></div>
      <a href="search_page.php"><i class="fas fa-search"></i></a>
      <a href="search_page.php"><i class="fas fa-heart"></i><span>(
          <?= $total_wishlist_counts; ?>)</span></a>
      <a href="search_page.php"><i class="fas fa-shopping-cart"></i><span>(
          <?= $total_cart_counts; ?>)</span></a>
      <div id="user-btn" class="fas fa-user"></div>
    </div>

    <div class="profile">
      <?php 
        $select_profile = $connect->prepare("SELECT * FROM `users` WHERE id = ?");
        $select_profile->execute([$user_id]);
        if ($select_profile->rowCount() > 0) {
          $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      <p><?= $fetch_profile['name'];?></p>
      <a href="update_profile.php" class="btn">Actualizar Perfil</a>

      <div class="flex-btn">
        <a href="admin_login.php" class="option-btn">Iniciar sesión</a>
        <a href="register_admin.php" class="option-btn">Registrarse</a>
      </div>
      <a href="../components/admin_logout.php" onclick="return confirm('¿Cerrar sesión en este sitio web?');"
        class="delete-btn">Cerrar sesión</a>
      <?php
        }else {
      ?>
      <p>¡Por favor inicie sesión o regístrese primero!</p>
      <div class="flex-btn">
        <a href="admin_login.php" class="option-btn">Iniciar sesión</a>
        <a href="register_admin.php" class="option-btn">Registrarse</a>
      </div>
      <?php
        }
      ?>
    </div>
  </section>
</header>