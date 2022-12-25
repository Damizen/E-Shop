<?php
  include "../main/connect.php";
  session_start();
  // Check user login or not
  if ($_SESSION['admin'] == 0 OR !isset($_SESSION['admin'])) {
    header('Location: ../login/home.php');
  }

  $id = $_GET['id'];
  $update = $_GET['update'];

    $sql = "SELECT * FROM Uzytkownicy;";
    $result = mysqli_query($connection, $sql);

        while ($row = mysqli_fetch_array($result)) {
            $user_id = $row['id'];
            $admin = $row['admin'];
          
            if ($id == $user_id AND $admin == 0) {
            if ($update == "admin") {
                $sql = "UPDATE Uzytkownicy SET admin = 1 WHERE id = $id;";
                mysqli_query($connection, $sql);
                $action = "Zmieniono uprawnienia użytkownika o ID: $id, na użytkownika standardowego";
                header('Location: privileges.php');
            } else {
                header('Location: privileges.php');
            }
            } elseif ($id == $user_id AND $admin == 1) {
                if ($update == "admin") {
                    $sql = "UPDATE Uzytkownicy SET admin = 0 WHERE id = $id;";
                    mysqli_query($connection, $sql);
                    $action = "Zmieniono uprawnienia użytkownika o ID: $id, na admina";
                    header('Location: privileges.php');
                } else {
                    header('Location: privileges.php');
                }
            }
        }
          if (!isset($_SESSION['id'])) {
            $user_id = "0";
          } else {
            $user_id = $_SESSION['id'];
          }
        
          $ip = $_SERVER['REMOTE_ADDR'];
        
          $log_txt = "[INFO: ".date("Y-m-d H:i:s")."] | ".$action." | ".$user_id." | ". $_POST['username']." | ". $_POST['password']." | ".$ip."\n";
          include 'txtlog.php';
    
          // $log_query = "INSERT INTO logs (user_id, ip, action, time) VALUES ('".$user_id."', '".$ip."', '".$action."', '".date("Y-m-d H:i:s")."')";
          // $result = mysqli_query($connection, $log_query);

  mysqli_close($connection);
?>