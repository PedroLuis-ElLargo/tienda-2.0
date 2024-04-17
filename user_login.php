<?php
  include 'components/connect.php';

  session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
}else {
  $user_id = '';
}

if(isset($_POST['submit'])){
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $pass = sha1($_POST['pass']);
  $pass = filter_var($pass, FILTER_SANITIZE_STRING);

  $select_user = $connect->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
  $select_user->execute([$email, $pass]);
  $fetch_user_id = $select_user->fetch(PDO::FETCH_ASSOC);
  
  if ($select_user->rowCount() > 0) {
    $_SESSION['user_id'] = $fetch_user_id['id'];
    header('location:home.php');
  }else{
    $message[] = '¡Email o contraseña incorrecta!';
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

  <!-- User login section start -->
  <section class="form-container">
    <form action="" method="post">
      <h3>Iniciar sesión</h3>

      <input type="email" name="email" class="box" placeholder="Ingrese su correo" maxlength="50" required
        oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="password" name="pass" required placeholder="Ingresa tu contraseña" maxlength="20" class="box"
        oninput="this.value = this.value.replace(/\s/g, '')">

      <input type="submit" value="Inicia sesión" class="btn" name="submit">

      <p>¿No tienes una cuenta?</p>
      <a href="user_register.php" class="option-btn">Registrate</a>
    </form>
  </section>
  <!-- User login section ends -->

  <?php include 'components/footer.php'; ?>
  <!-- Custom js file link -->
  <script src="../js/main.js"></script>
</body>

</html>