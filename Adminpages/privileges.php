<?php
include "../main/connect.php";
session_start();
// Check user login or not
if ($_SESSION['admin'] == 0 OR !isset($_SESSION['admin'])) {
  header('Location: ../main/home.php');
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <link rel="stylesheet" href="../css/cssforlogs.css">
  <title>Uprawnienia</title>
</head>

<body>

  <div class="content_log">
    <div class="log_box">
      <div class="log_header">
        Panel zarządzenia
      </div>
      <div class="log_content">
        <div class="log_content_header">
          <div class="log_content_header_text">ID użytkownika</div>
          <div class="log_content_header_text">Email</div>
          <div class="log_content_header_text">Użytkownik</div>
          <div class="log_content_header_text">Admin</div>
          <div class="log_content_header_text">Nadaj uprawnienie</div>
        </div>
        <div class="log_content_list">
          <?php
          $sql = "SELECT * FROM Uzytkownicy;";
          $result = mysqli_query($connection, $sql);

          while ($row = mysqli_fetch_array($result)) {
            $user_id = $row['id'];
            $email = $row['email'];
            $user = $row['user'];
            $admin = $row['admin'];

            echo "<div class='log_content_item'>
                  <div class='log_content_text'>$user_id</div>
                  <div class='log_content_text'>$email</div>
                  <div class='log_content_text'>$user</div>
                  <div class='log_content_text'>";
            if ($admin == 1) {echo "Tak";} else {echo "Nie";}
            echo "</div>
                  <div class='log_content_text'><a href='userUpdate.php?id=$user_id&update=admin'>Zmień uprawnienie</a></div>
                  </div>
                  <hr class='log_hr'>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<?php
mysqli_close($connection);
?>