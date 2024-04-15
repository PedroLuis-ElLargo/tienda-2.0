<?php 
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
};

if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];
  $delete_user = $connect->prepare("DELETE FROM `users` WHERE id = ?");
  $delete_user->execute([$delete_id]);
  $delete_orders = $connect->prepare("DELETE FROM `orders` WHERE user_id = ?");
  $delete_orders->execute([$delete_id]);
  $delete_messages = $connect->prepare("DELETE FROM `messages` WHERE user_id = ?");
  $delete_messages->execute([$delete_id]);
  $delete_cart = $connect->prepare("DELETE FROM `cart` WHERE user_id = ?");
  $delete_cart->execute([$delete_id]);
  $delete_wishlist = $connect->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
  $delete_wishlist->execute([$delete_id]);
  header('location:users_accounts.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>cuentas de administrador</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="../icons/user.svg" type="image/x-icon">
  <!-- Font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <!-- Custom css file link -->
  <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
  <?php 
    include '../components/admin_header.php';
  ?>

  <!-- User accounts section starts -->
  <section class="accounts">
    <h1 class="heading">cuentas de usuarios</h1>
    <div class="box-container">
      <?php
      $select_accounts = $connect->prepare("SELECT * FROM `users`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
        while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
      ?>
      <div class="box">
        <p> ID administrador: <span><?= $fetch_accounts['id']; ?></span> </p>
        <p> Nombre administrador: <span><?= $fetch_accounts['name']; ?></span> </p>
        <p> email: <span><?= $fetch_accounts['email']; ?></span> </p>
        <div class="flex-btn">
          <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>"
            onclick="return confirm('¿Quieres eliminar esta cuenta? ¡La información relacionada con el usuario también se eliminará!')"
            class="delete-btn">Eliminar</a>
        </div>
      </div>
      <?php
        }
      }else{
        echo '<p class="empty">¡No hay cuentas disponibles!</p>';
      }
      ?>
    </div>
  </section>
  <!-- User accounts section ends -->

  <!-- Custom js file link -->
  <script src="../js/admin_script.js"></script>
</body>

</html>