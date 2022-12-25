<?php
include '../main/connect.php';

if ($_SESSION['admin'] == 0 or !isset($_SESSION['admin'])) {
    header('Location: ../home.php');
  }

$stmt = $connection->prepare("SELECT image, thumbnail FROM Movies WHERE id = ?");
$stmt -> bind_param('i', $prod);
$prod = (int)$_GET['id'];
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_array($result);
$image = $row['image'];
$thumb = $row['thumbnail'];


unlink("..".$image);
unlink("..".$thumb);

$stmt = $connection->prepare("DELETE FROM `Movies` WHERE id = ?");
$stmt->bind_param("i", $id);
$id = $_GET['id'];
$stmt->execute();


$action = "Deleted movie id: ".$_GET['id'];
$user_id = $_SESSION['id'];

  $ip = $_SERVER['REMOTE_ADDR'];

  $log_query = "INSERT INTO logs (user_id, ip, action, time) VALUES ('".$user_id."', '".$ip."', '".$action."', '".date("Y-m-d H:i:s")."')";
  $result = mysqli_query($connection, $log_query);

mysqli_close($connection);

header('Location: edit&delpanel.php');
?>