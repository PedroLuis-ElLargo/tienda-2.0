<?php
  include 'components/connect.php';

  session_start();

  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
  }else {
    $user_id = '';
  }

  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $select_user = $connect->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_user->execute([$email]);
    $fetch_user_id = $select_user->fetch(PDO::FETCH_ASSOC);
  
  if ($select_user->rowCount() > 0) {
    $message[] = '¡Este usuario ya existe!';
  }else{
    if ($pass != $cpass) {
      $message[] = '¡Confirmar contraseña, no coinciden!';
    }else{
      $insert_user = $connect->prepare("INSERT INTO `users` (name, email, password) VALUES(?,?,?)");
      $insert_user->execute([$name, $email, $cpass]);
      $message[] = '¡Nuevo usuario registrado!';
    }
  }
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
  <!-- Font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <!-- Custom css file link -->
  <link rel="stylesheet" href="/css/main.css">
</head>

<body>
  <?php include 'components/user_header.php'; ?>

  <!-- Register users section starts -->
  <section class=" form-container">
    <form action="" method="post">
      <h3>Nuevo Registro</h3>

      <input type="text" name="name" class="box" placeholder="Ingrese su nombre" maxlength="20" required
        oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="email" name="email" class="box" placeholder="Ingrese su correo" maxlength="50" required
        oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="password" name="pass" required placeholder="Ingresa tu contraseña" maxlength="20" class="box"
        oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="password" name="cpass" required placeholder="Confirmar contraseña" maxlength="20" class="box"
        oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="submit" value="Regístrate Ahora" class="btn" name="submit">
      <p>¡Ya tengo una cuenta!</p>
      <a href="user_login.php" class="option-btn">Iniciar sección</a>
    </form>
  </section>
  <!-- Register users section ends -->

  <?php include 'components/footer.php'; ?>
  <!-- Custom js file link -->
  <script src="../js/main.js"></script>
</body>

</html>