<?php 
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:admin_login.php');
};

if (isset($_POST['add_product'])) {
  $name = $_POST['name'];
  $name = filter_var($name,FILTER_SANITIZE_STRING);
  $price = $_POST['price'];
  $price = filter_var($price,FILTER_SANITIZE_STRING);
  $details = $_POST['details'];
  $details = filter_var($details,FILTER_SANITIZE_STRING);

  $image_01 = $_FILES['image_01']['name'];
  $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
  $image_size_01 = $_FILES['image_01']['size'];
  $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
  $image_folder_01 = '../uploaded_img/'.$image_01;

  $image_02 = $_FILES['image_02']['name'];
  $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
  $image_size_02 = $_FILES['image_02']['size'];
  $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
  $image_folder_02 = '../uploaded_img/'.$image_02;
  
  $image_03 = $_FILES['image_03']['name'];
  $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
  $image_size_03 = $_FILES['image_03']['size'];
  $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
  $image_folder_03 = '../uploaded_img/'.$image_03;

  $select_products = $connect->prepare("SELECT * FROM `products` WHERE name = ?");
  $select_products->execute([$name]);

  if ($select_products->rowCount() > 0) {
    $message[] = '¡El nombre del producto ya existe!';
  }else{
    if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
      $message[] = '¡El tamaño de la imagen es demasiado grande!';
  }else{
        move_uploaded_file($image_tmp_name_01, $image_folder_01);
        move_uploaded_file($image_tmp_name_02, $image_folder_02);
        move_uploaded_file($image_tmp_name_03, $image_folder_03);

        $insert_products = $connect->prepare("INSERT INTO `products`(name, details, price,  image_01, image_02, image_03)VALUE(?,?,?,?,?,?)");
        $insert_products->execute([$name, $details,$price, $image_01, $image_02,$image_03]);

      $message[] = '¡Un nuevo producto a sido agregado!';
      }
  }
};

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  $delete_product_image = $connect->prepare("SELECT * FROM `products` WHERE id = ?");
  $delete_product_image->execute([$delete_id]);
  $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
  unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
  unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
  unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
  $delete_product = $connect->prepare("DELETE FROM `products` WHERE id = ?");
  $delete_product->execute([$delete_id]);
  $delete_cart = $connect->prepare("DELETE FROM `cart` WHERE pid = ?");
  $delete_cart->execute([$delete_id]);
  $delete_wishlist = $connect->prepare("DELETE FROM `wishlist` WHERE pid = ?");
  $delete_wishlist->execute([$delete_id]);
  header('location:products.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Productos</title>
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

  <!-- Add products section starts -->
  <section class="add-products">
    <h1 class="heading">Agregar productos</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
        <div class="inputBox">
          <span>Nombre del Producto (requerido)</span>
          <input type="text" name="name" class="box" maxlelegth="100" placeholder="Ingrese el nombre del producto"
            required>
        </div>

        <div class="inputBox">
          <span>Precio del Producto (requrido)</span>
          <input type="number" name="price" min="0" class="box" max="9999999999"
            placeholder="Ingrese el precio del producto" onkeypress="if(this.value.length == 10) return false;"
            required>
        </div>

        <div class="inputBox">
          <span>1ra Imagen del Producto (requerido)</span>
          <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>

        <div class="inputBox">
          <span>2da Imagen del Producto (requerido)</span>
          <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>

        <div class="inputBox">
          <span>3ra Imagen del Producto (requerido)</span>
          <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>

        <div class="inputBox">
          <span>Detalles de producto (requerido)</span>
          <textarea name="details" class="box" maxlegngth="500" cols="30" rows="10"
            placeholder="Ingrese los detalles del producto" required></textarea>
        </div>

        <input type="submit" value="Agregar Producto" class="btn" name="add_product">
      </div>
    </form>
  </section>
  <!-- Add products section ends -->

  <!-- Show products section starts -->
  <section class="show-products">
    <h1 class="heading">Productos Agregados</h1>
    <div class="box-container">
      <?php 
        $show_products = $connect->prepare("SELECT * FROM `products`");
        $show_products->execute();
        if ($show_products->rowCount() > 0) {
          while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <div class="box">
        <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
        <div class="name"><?= $fetch_products['name']; ?></div>
        <div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
        <div class="details"><span><?= $fetch_products['details']; ?></span></div>

        <div class="flex-btn">
          <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Actualizar</a>
          <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn"
            onclick="return confirm('¿Estas seguro de eliminar este producto?');">Eliminar</a>
        </div>
      </div>
      <?php 
          }
        }else{
          echo '<p class="empty">¡Aún no se han añadido productos!</p>';
        }
      ?>
    </div>
  </section>
  <!-- Show products section ends -->

  <!-- Custom js file link -->
  <script src="../js/admin_script.js"></script>
</body>

</html>