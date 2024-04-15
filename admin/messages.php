<?php 
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
};

if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];
  $delete_message = $connect->prepare("DELETE FROM `messages` WHERE id = ?");
  $delete_message->execute([$delete_id]);
  header('location:messages.php');
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
  <link rel="shortcut icon" href="../icons/V-T.svg" type="image/x-icon">
  <!-- Font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <!-- Custom css file link -->
  <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
  <?php 
    include '../components/admin_header.php';
  ?>

  <!-- Messages section starts -->
  <section class="messages">
    <h1 class="heading">mensajes</h1>
    <div class="box-container">
      <?php
      $select_message = $connect->prepare("SELECT * FROM `messages`");
      $select_message->execute();
      if($select_message->rowCount() > 0){
        while($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)){   
      ?>
      <div class="box">
        <p> ID Usuario: <span><?= $fetch_message['user_id']; ?></span></p>
        <p> Nombre: <span><?= $fetch_message['name']; ?></span></p>
        <p> Email: <span><?= $fetch_message['email']; ?></span></p>
        <p> Télefono: <span><?= $fetch_message['number']; ?></span></p>
        <p> Mensaje: <span><?= $fetch_message['message']; ?></span></p>
        <a href="messages.php?delete=<?= $fetch_message['id']; ?>" onclick="return confirm('¿Eliminar este mensaje?');"
          class="delete-btn">Eliminarete</a>
      </div>
    </div>
    <?php
        }
      }else{
        echo '<p class="empty">¡No hay Mensajes disponibles!</p>';
      }
      ?>
    </div>
  </section>
  <!-- Messages section ends -->

  <!-- Custom js file link -->
  <script src="../js/admin_script.js"></script>
</body>

</html>