<?php
include '../main/connect.php';
session_start();
// Server logs
    $action = "Logout";
  if (!isset($_SESSION['id'])) {
    $user_id = "0";
  } else {
    $user_id = $_SESSION['id'];
  }

  $ip = $_SERVER['REMOTE_ADDR'];

  $log_txt = "[INFO: ".date("Y-m-d H:i:s")."] | ".$action." | ".$user_id." | ". $_SESSION['username']." | ".$ip."\n";
  include '../Adminpages/txtlog.php';

  $log_query = "INSERT INTO logs (user_id, ip, action, time) VALUES ('".$user_id."', '".$ip."', '".$action."', '".date("Y-m-d H:i:s")."')";
  $result = mysqli_query($connection, $log_query);

session_destroy();
header("Location: ../main/index.php");
?>