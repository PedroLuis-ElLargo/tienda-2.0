<?php

  if (isset($_POST['add_to_wishlist'])) {
    if($user_id == ''){
      header("location:user_login.php");
    }else{
      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);

      $check_wishlist_numbers = $connect->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$name,$user_id]);

      $check_cart_numbers = $connect->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name,$user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
        $message[] = '¡Ya se ha agregado a la lista de deseos!';
      }elseif($check_cart_numbers->rowCount() > 0){
        $message[] = '¡Ya se ha agregado al carrito de compras!';
      }else{
        $insert_wishlist = $connect->prepare("INSERT INTO `wishlist` (user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
        $insert_wishlist->execute([$user_id, $pid, $name, $price, $image]);
        $message[] = '¡Agregado a la lista de deseos!';
      }
    }
  }

    if (isset($_POST['add_to_cart'])) {
    if($user_id == ''){
      header("location:user_login.php");
    }else{
      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $qty = $_POST['qty'];
      $qty = filter_var($qty, FILTER_SANITIZE_STRING);

      $check_wishlist_numbers = $connect->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$name,$user_id]);

      $check_cart_numbers = $connect->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name,$user_id]);

      if($check_cart_numbers->rowCount() > 0){
        $message[] = '¡Ya se ha agregado al carrito de compras!';
      }else{
        $check_wishlist_numbers = $connect->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
        $check_wishlist_numbers->execute([$name,$user_id]);

        if($check_wishlist_numbers->rowCount() > 0) {
          $delete_wishlist = $connect->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
          $delete_wishlist->execute([$name, $user_id]);
        }

        $insert_cart = $connect->prepare("INSERT INTO `cart` (user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
        $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
        $message[] = '¡Agregado al carrito de compras!';
      }
    }
  }
?>