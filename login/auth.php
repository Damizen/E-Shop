<?php
    session_start();
    include('../main/connect.php');

    if($_SESSION['login'] == true){
        header('Location: home.php');
    }
    if (!isset($_POST['username'], $_POST['password'])) {
        exit('Wpisz login i hasło');
    }
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $password = sha1($password);
    $mysql_query = "SELECT id, admin FROM Uzytkownicy WHERE user='$username' AND password='".$password."'";
    $result = mysqli_query($connection, $mysql_query);
    $row = mysqli_fetch_array($result);
    if ($row) {
        $_SESSION['id'] = $id = $row['id'];
        $_SESSION['username'] = $username;
        $_SESSION['admin'] = $row['admin'];
        $_SESSION['login'] = TRUE;
        session_regenerate_id();
        session_start();
      }
        // Server logs
      if (!isset($_SESSION['login'])) {
        $action = "Login failed";
      } else {
        $action = "Login success";
      }
      if (!isset($_SESSION['id'])) {
        $user_id = "0";
      } else {
        $user_id = $_SESSION['id'];
      }
      $ip = $_SERVER['REMOTE_ADDR'];
      $log_txt = "[INFO: ".date("Y-m-d H:i:s")."] | ".$action." | ".$user_id." | ". $_POST['username']." | ". $_POST['password']." | ".$ip."\n";
      include './Adminpages/txtlog.php';

      // $log_query = "INSERT INTO logs (user_id, ip, action, time) VALUES ('".$user_id."', '".$ip."', '".$action."', '".date("Y-m-d H:i:s")."')";
      // mysqli_query($connection, $log_query);
      header('Location: home.php');
    exit('<div style="display: flex; align-items: center; flex-direction: column;"><h1 id="popinfoFail">Niepoprawny login lub hasło</h1><br><input type="button" value="Spróbuj jeszcze raz" class="logbutton" onclick="javascript:location.href=`login.php`"></div>');
?>