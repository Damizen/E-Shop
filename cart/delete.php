<?php
include "../main/connect.php";

session_start();
// Check user login or not
if (!isset($_SESSION['login'])) {
  header('Location: ../main/index.php');
}

$id = $_GET['id'];

$sql = "DELETE FROM Cart WHERE id = '$id'";
mysqli_query($connection, $sql);
header('Location: cart.php');

?>
<?php
mysqli_close($connection);
?>