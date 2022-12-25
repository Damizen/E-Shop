<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AddAccount</title>
  <link rel="stylesheet" href="styleForRegistration.css">
</head>
<body>
  
</body>
</html>
<?php 
       session_start();
       include '../main/connect.php';
   
       if(isset($_SESSION['login'])){
         header('Location: home.php');
       }
   
       if ($_POST['username'] == "" || $_POST['password'] == "" || $_POST['email'] == "") {
         exit('<div style="display: flex; align-items: center; flex-direction: column;"><h1 id="popinfoWarning">Wpisz imię, login i hasło!</h1><input type="button" value="Wróć do rejestracji" class="logbutton" onclick="history.back()"></div>');
       }
       $emailAddress = $_POST['email'];
       $username = $_POST['username'];
       $password = $_POST['password'];
       $password = sha1($password);
       $sql = "INSERT INTO Uzytkownicy(`email`, `user`, `password`) VALUES ('$emailAddress', '$username','$password');";  
       $mysql_query = "SELECT email, user FROM Uzytkownicy;";
       $result = mysqli_query($connection, $mysql_query);
   
   
       while($row = mysqli_fetch_array($result)) {
         $uemail = $row['email'];
         $uname = $row['user'];
         if ($uname == $_POST['username'] and $uemail == $_POST['email']) {
           exit('<div style="display: flex; align-items: center; flex-direction: column;"><h1 id="popinfoFail">Podana nazwa użytkownika jest już w bazie!</h1><input type="button" value="Wróć do rejestracji" class="logbutton" onclick="history.back()"></div>');
         }
       }
   
       mysqli_query($connection, $sql);
   
       
       
       // Server logs
       $action = "Account created";
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
        
        session_destroy();
        mysqli_close($connection);
        exit('<div style="display: flex; align-items: center; flex-direction: column;"><h1 id="popinfo">Zarejestrowano pomyślnie</h1><br><input type="button" value="Przejdź do strony głównej" class="logbutton" onclick="javascript:location.href=`index.php`"></div>');
        
        ?>