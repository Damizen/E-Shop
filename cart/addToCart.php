<?php
    session_start();

    if(!$_SESSION['login'] == true){
        header('Location: ../main/index.php');
    }

    require_once "../main/connect.php";

    $userId = $_SESSION['id'];
    $productId = $_GET['id'];
    $count = $_GET['quantity'];

    $sql_query = "SELECT * FROM Cart WHERE id_user = '$userId' AND id_product = '$productId'";
    $result = mysqli_query($connection, $sql_query);
    $row = mysqli_fetch_assoc($result);

    if($row){
        $sql_update = "UPDATE Cart SET count = count + '$count' WHERE id_user = '$userId' AND id_product = '$productId'";
        mysqli_query($connection, $sql_update);
        $action = "Update cart";
        header('Location: cart.php');
    }else{  
        $sql_insert = "INSERT INTO Cart (id_user, id_product, count) VALUES ('$userId', '$productId', '$count');";
        $action = "Add to cart";
        if(mysqli_query($connection, $sql_insert)){
            header('Location: cart.php');
        } else {
            echo "Error: " . $sql_insert . "<br>" . mysqli_error($connection);
        }
    }

    if (!isset($_SESSION['id'])) {
        $user_id = "0";
       } else {
         $user_id = $_SESSION['id'];
       }
       
    $ip = $_SERVER['REMOTE_ADDR'];

    $log_query = "INSERT INTO logs (user_id, ip, action, time) VALUES ('".$user_id."', '".$ip."', '".$action."', '".date("Y-m-d H:i:s")."')";
    $result = mysqli_query($connection, $log_query);

    mysqli_close($connection);

?>