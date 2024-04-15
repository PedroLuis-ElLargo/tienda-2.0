<?php 
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
};

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);

  $update_name = $connect->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
  $update_name->execute([$name, $admin_id]);

  $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
  $select_old_pass = $connect->prepare("SELECT password FROM `admins` WHERE id = ?");
  $select_old_pass->execute([$admin_id]);
  $fetch_prev_pass = $select_old_pass->fetch(PDO::FETCH_ASSOC);
  $prev_pass = $fetch_prev_pass['password'];
  
  $prev_pass = $_POST['prev_pass'];
  $old_pass = sha1($_POST['old_pass']);
  $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
  $new_pass = sha1($_POST['new_pass']);
  $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
  $confirm_pass = sha1($_POST['confirm_pass']);
  $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

  if ($old_pass == $empty_pass) {
    $message[] = '¡Por favor ingrese la contraseña anterior!';
  }elseif ($old_pass != $prev_pass) {
    $message[] = '¡La contraseña anterior no coincide!';
  }elseif($new_pass != $confirm_pass){
    $message[] = '¡Confirmar contraseña, no coincide!';
  }else {
    if ($new_pass != $empty_pass) {
      $update_pass = $connect->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
      $update_pass->execute([$confirm_pass, $admin_id]);
      $message[] = '¡Contraseña actualizada exitosamente!';
    }else{
      $message[] = '¡Por favor ingrese la nueva contraseña!';
    }
  }
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Registro</title>
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

  <!-- Admin profile update section starts -->
  <section class=" form-container">
    <form action="" method="post">
      <h3>Actualizar Perfil</h3>

      <input type="hidden" name="prev_pass" value="<?= $fetch_profile['password'];  ?>">

      <input type="text" name="name" class="box" placeholder="Ingrese su nombre de usuario" maxlength="20"
        oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile['name'];  ?>">

      <input type="password" name="old_pass" placeholder="Ingrese su antigua contraseña" maxlength="20" class="box"
        oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="password" name="new_pass" placeholder="Introduzca su nueva contraseña" maxlength="20" class="box"
        oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="password" name="confirm_pass" placeholder="Confirmar su nueva contraseña" maxlength="20" class="box"
        oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="submit" value="Actualizar Ahora" class="btn" name="submit">
    </form>
  </section>
  <!-- Admin profile update section ends -->

  <!-- Custom js file link -->
  <script src="../js/admin_script.js"></script>
</body>

</html>