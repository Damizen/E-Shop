<?php
include "../main/connect.php";
session_start();
// Check user login or not
if ($_SESSION['admin'] == 0 OR !isset($_SESSION['admin'])) {
  header('Location: ../login/home.php');
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
<link rel="stylesheet" href="../css/cssforlogs.css">
  <title>Logi</title>
</head>

<body>
  <div class="content_log">
    <div class="log_box">
      <div class="log_header">
        LOGI
      </div>
      <div class="log_content">
        <div class="log_content_header">
          <div class="log_content_header_text">ID użytkownika</div>
          <div class="log_content_header_text">IP</div>
          <div class="log_content_header_text">Akcja</div>
          <div class="log_content_header_text">Czas</div>
        </div>
        <div class="log_content_list">
          <?php
          $sql = "SELECT * FROM logs";
          $result = mysqli_query($connection, $sql);

          while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $ip = $row['ip'];
            $action = $row['action'];
            $time = $row['time'];

            echo "<div class='log_content_item'>
                  <div class='log_content_text'>$user_id</div>
                  <div class='log_content_text'>$ip</div>
                  <div class='log_content_text'>$action</div>
                  <div class='log_content_text'>$time</div>
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