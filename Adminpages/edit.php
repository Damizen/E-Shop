<?php
require_once "../main/connect.php";
session_start();
// Check user login or not
if ($_SESSION['admin'] == 0 or !isset($_SESSION['admin'])) {
  header('Location: ../login/login.php');
}
if (isset($_POST['edit'])) {

    $stmt = $connection->prepare("SELECT image, thumbnail FROM Movies WHERE id = ?");
    $stmt -> bind_param('i', $prod);
    $prod = (int)$_POST['edit'];
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_array($result);
    $img = $row['image'];
    $thumb = $row['thumbnail'];
  
    if(isset($_POST['update'])) {
      unlink("..".$img);
      unlink("..".$thumb);
  
      $filename = date('Y-m-d-H-i-s')."_".$_FILES['file']['name'];
      $path = "../ImagesMovieShop/$filename";
      move_uploaded_file($_FILES['file']['tmp_name'], $path);
      
      $blob = file_get_contents($path);
      $src = imagecreatefromstring($blob);
      list($width, $height) = getimagesize($path);
      $tmp = imagecreatetruecolor(150, 90);
      $file = '../thumbnails/'.$filename;
      imagecopyresampled($tmp, $src, 0, 0, 0, 0, 150, 90, $width, $height);
      imagebmp($tmp, $file, 100);
      
      $img = "/ImagesMovieShop/$filename";
      $thumb = "/thumbnails/$filename";
    }
  
    $stmt = $connection->prepare("UPDATE Movies SET title = ?, description = ?, image = ?, thumbnail = ?, price = ?, rating = ? WHERE id = ?");
    $stmt->bind_param("ssssiii", $title, $desc, $img, $thumb, $price, $rating, $prod);
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $price = (int)$_POST['price'];
    $rating = (int)$_POST['rating'];
    $prod = (int)$_POST['edit'];
    $stmt->execute();
  
    header('Location: edit&delpanel.php');
  }
  
  $stmt = $connection->prepare("SELECT * FROM Movies WHERE id = ?");
  $stmt -> bind_param('i', $prod);
  $prod = (int)$_GET['id'];
  $stmt->execute();
  $result = $stmt->get_result();
  $row = mysqli_fetch_array($result);
  mysqli_close($connection);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja Produktu</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            height: '220px',
            width: 'calc(30vw + 20px)',
            forced_root_block : '',
            menubar: false,
            statusbar: false,
            resize: false,
            language: 'pl',
            toolbar: 'undo redo | bold italic underline strikethrough | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'admin',
            newline_behavior: 'invert',
    });
  </script>
</head>
<body>
    <nav>
        <h3 style="text-align:center;">Jesteś zalogowany jako: <?php echo $_SESSION['username']; ?><h3>
    </nav>
    <div id="containerEdit">
        <form action="edit.php" method="post" enctype="multipart/form-data">
            <h3>Tytuł:</h3>
            <input class="c-login__input" type="text" name="title" value="<?php echo $row['title'];?>"></input>
            <h3>Opis</h3>
            <input class="c-login__input" id="mytextarea" type="textarea" name="desc" value="<?php echo $row['description'];?>"><br>
            <h3>Zdjęcie:</h3>
            <input type="checkbox" name="update" value="1" id="img_update" style="display: none;">
            <input class="c-login__input" type="file" name="file" id="file" accept="image/*" onchange="handleFileSelect(event); document.querySelector('#img_update').checked = 1;"><br>
            <img id='img' src="<?php echo $row['image'];?>" style="margin-top: 10px;" width="300px" height="150px"></img>
            <h3>Cena:</h3>
            <input class="c-login__input" type="number" name="price" value="<?php echo $row['price'];?>"><br>
            <h3>Ocena:</h3>
            <input class="c-login__input" type="number" min='0' max="10" name="rating" value="<?php echo $row['rating'];?>"><br>
            <button class="c-login__btn" name="edit" value="<?php echo $prod ?>">Edit</button>
        </form>
    </div>
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