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
  <!-- Font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <!-- Custom css file link -->
  <link rel="stylesheet" href="/css/main.css">
</head>

<body>
  <?php include 'components/user_header.php'; ?>


  <!-- Custom js file link -->
  <script src="../js/main.js"></script>
</body>

</html>