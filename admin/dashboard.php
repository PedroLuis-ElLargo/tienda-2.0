<?php 
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicon -->
  <link rel="shortcut icon" href="../icons/V-T.svg" type="image/x-icon">
  <title>Panel</title>
  <!-- Font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <!-- Custom css file link -->
  <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>

  <?php 
    include '../components/admin_header.php';
  ?>

  <!-- Admin dashboard section starts -->
  <section class="dashboard">

    <h1 class="heading">Panel</h1>

    <div class="box-container">
      <div class="box">
        <h3>Bienvenido</h3>
        <p><?= $fetch_profile['name'];?></p>
        <a href="update_profile.php" class="btn">Actualizar Perfil</a>
      </div>

      <div class="box">
        <?php
            $total_pendings = 0;
            $select_pendings = $connect->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_pendings->execute(['pendiente']);
            if($select_pendings->rowCount() > 0){
              while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                  $total_pendings += $fetch_pendings['total_price'];
              }
            }
        ?>
        <h3><span>$</span><?= $total_pendings;?><span>/-</span></h3>
        <p>Total de Pedidos</p>
        <a href="placed_orders.php" class="btn">Ver pedidos</a>
      </div>

      <div class="box">
        <?php
            $total_completes = 0;
            $select_completes = $connect->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_completes->execute(['completo']);
            if($select_completes->rowCount() > 0){
              while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                  $total_completes += $fetch_completes['total_price'];
              }
            }
        ?>
        <h3><span>$</span><?= $total_completes;?><span>/-</span></h3>
        <p>Pedidos Completados</p>
        <a href="placed_orders.php" class="btn">Ver pedidos</a>
      </div>

      <div class="box">
        <?php 
        $select_orders = $connect->prepare("SELECT * FROM `orders`");
        $select_orders->execute();
        $number_of_orders = $select_orders->rowCount();
        ?>
        <h3><?= $number_of_orders; ?></h3>
        <p>Pedidos Realizados</p>
        <a href="placed_orders.php" class="btn">Ver pedidos</a>
      </div>

      <div class="box">
        <?php 
        $select_products = $connect->prepare("SELECT * FROM `products`");
        $select_products->execute();
        $number_of_products = $select_products->rowCount();
      ?>
        <h3><?= $number_of_products; ?></h3>
        <p>Productos Agregados</p>
        <a href="products.php" class="btn">Ver Productos</a>
      </div>

      <div class="box">
        <?php 
        $select_users = $connect->prepare("SELECT * FROM `users`");
        $select_users->execute();
        $number_of_users = $select_users->rowCount();
      ?>
        <h3><?= $number_of_users; ?></h3>
        <p>Usuarios normales</p>
        <a href="users_accounts.php" class="btn">Ver Usuarios</a>
      </div>

      <div class="box">
        <?php 
        $select_admins = $connect->prepare("SELECT * FROM `admins`");
        $select_admins->execute();
        $number_of_admins = $select_admins->rowCount();
      ?>
        <h3><?= $number_of_admins; ?></h3>
        <p>Usuarios Administradores</p>
        <a href="admin_accounts.php" class="btn">Ver Administradores</a>
      </div>

      <div class="box">
        <?php 
        $select_messages = $connect->prepare("SELECT * FROM `messages`");
        $select_messages->execute();
        $number_of_messages = $select_messages->rowCount();
      ?>
        <h3><?= $number_of_messages; ?></h3>
        <p>Nuevos Mensajes</p>
        <a href="messagess.php" class="btn">Ver Mensajes</a>
      </div>
    </div>
  </section>
  <!-- Admin dashboard section ends -->

  <!-- Custom js file link -->
  <script src="../js/admin_script.js"></script>
</body>

</html>