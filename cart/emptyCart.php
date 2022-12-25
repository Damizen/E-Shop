<?php
  include "../main/connect.php";
  session_start();
  // Check user login or not
  if(!isset($_SESSION['login'])){
      header('Location: ../main/index.php');
  }

  $id = $_SESSION['id'];
  $sql = "DELETE FROM Cart WHERE id_user='$id';";

  mysqli_query($connection, $sql);
  mysqli_close($connection);
  header('Location: cart.php');
?>