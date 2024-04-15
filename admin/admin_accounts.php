<?php 
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
};

if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];
  $delete_admins = $connect->prepare("DELETE FROM `admins` WHERE id = ?");
  $delete_admins->execute([$delete_id]);
  header('location:admin_accounts.php');
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

  <!-- Admin accounts section starts -->
  <section class="accounts">
    <h1 class="heading">Cuentas de administrador</h1>
    <div class="box-container">
      <div class="box">
        <p>Agregar nuevo administrador</p>
        <a href="register_admin.php" class="option-btn">registrar administrador</a>
      </div>

      <?php
      $select_accounts = $connect->prepare("SELECT * FROM `admins`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
        while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
      ?>
      <div class="box">
        <p> ID administrador: <span><?= $fetch_accounts['id']; ?></span> </p>
        <p> Nombre administrador: <span><?= $fetch_accounts['name']; ?></span> </p>
        <div class="flex-btn">
          <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>"
            onclick="return confirm('¿Quieres eliminar esta cuenta?')" class="delete-btn">Eliminar</a>
          <?php
            if($fetch_accounts['id'] == $admin_id){
              echo '<a href="update_profile.php" class="option-btn">Actualizar</a>';
            }
          ?>
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
  <!-- Admin accounts section ends -->

  <!-- Custom js file link -->
  <script src="../js/admin_script.js"></script>
</body>

</html>