<?php
require_once "../main/connect.php";
session_start();
// Check user login or not
if ($_SESSION['admin'] == 0 or !isset($_SESSION['admin'])) {
  header('Location: ../login.php');
}

if (isset($_POST['add'])) {
  $stmt = $connection->prepare("INSERT INTO `Movies` (id, image, thumbnail, title, description, rating, price) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssii", $img, $thumb, $title, $desc, $rating, $price);
  $filename = date('Y-m-d_H-i-s') . "_" . $_FILES['file']['name'];
  $title = $_POST['title'];
  $desc = $_POST['description'];
  $img = "/ImagesMovieShop/$filename";
  $thumb = "/thumbnails/$filename";
  $price = (int)$_POST['price'];
  $rating = (int)$_POST['rating'];
  $stmt->execute();

  $path = "../ImagesMovieShop/$filename";
  move_uploaded_file($_FILES['file']['tmp_name'], $path);

  $blob = file_get_contents($path);
  $src = imagecreatefromstring($blob);
  list($width, $height) = getimagesize($path);
  $tmp = imagecreatetruecolor(150, 90);
  $file = '../thumbnails/'.$filename;
  imagecopyresampled($tmp, $src, 0, 0, 0, 0, 150, 90, $width, $height);
  imagebmp($tmp, $file, 100);

  $action = "Movie ".$title." added";

  $user_id = $_SESSION['id'];

  $ip = $_SERVER['REMOTE_ADDR'];

  $log_txt = "[INFO: ".date("Y-m-d H:i:s")."] | ".$action." | ".$user_id." | ". $_POST['username']." | ".$ip."\n";
  include 'txtlog.php';

  // $log_query = "INSERT INTO logs (user_id, ip, action, time) VALUES ('".$user_id."', '".$ip."', '".$action."', '".date("Y-m-d H:i:s")."')";
  // $result = mysqli_query($connection, $log_query);

  header('Location: adminPanel.php');
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <script src="https://cdn.tiny.cloud/1/zzf88qim2caec2212s6kd3mcyy8n6ejm2ay3g6hewu0trvse/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dodaj Produkt</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <nav>
    <h3 style="text-align: center;">Jesteś zalogowany jako: <?php echo $_SESSION['username']; ?><h3>
    <a href="adminPanel.php" style="float: left;"><h4>Powrót do panelu</h4></a>
  </nav>
  <div class="content" style="padding: 150px">
    <div class='special_offer'>
      <form action='add.php' method='post' enctype="multipart/form-data">
        <div class='offer_name'>
          <p>Tytuł: <input type='text' name='title' id='name' required></p>
        </div>
        <div class='offer_image'>
          <p>Zdjęcie:
            <input type='file' name='file' accept="image/*" required onchange="handleFileSelect(event);"></br>
          </p>
          <img id='img' src="" style="margin-top: 10px;" width="300px" height="250px"></img>
        </div>
        <div class='offer_review'>
          <p>Ocena: <input type='number' name='rating' id='rating' min='0' max='10' required> / 10</p>
        </div>
        <div class='offer_description'>
          <textarea name='description' id='desc'></textarea>
        </div>
        <div class='offer_price'>
          <p>Cena: <input type='number' name='price' id='price' min='0' max='100000' required> zł</p>
        </div>
        <div class='offer_save'>
          <button type='submit' name='add' id='add' value='1'>Zapisz</button>
        </div>
      </form>
    </div>
    <script>
      tinymce.init({
        selector: 'textarea#desc',
        menubar: false,
        statusbar: false,
        resize: false,
        language: 'pl',
        toolbar: 'undo redo | bold italic underline strikethrough | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'admin',
        width: '700px',
        newline_behavior: 'invert',
      });
    </script>
    <script>
      function handleFileSelect(evt) {
        let files = evt.target.files;
        let f = files[0];
        let reader = new FileReader();

        reader.onload = (function(theFile) {
        return function(e) {
          document.querySelector('#img').src = e.target.result;
        };
      })(f);

      reader.readAsDataURL(f);
    }
    </script>

</body>

</html>
<?php
mysqli_close($con);
?>