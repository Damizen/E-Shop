<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieShop</title>
    <link rel="stylesheet" href="../css/style.css" type="text/css">
</head>
<body>
    <nav>
      <div id="logo">
        <h1>Movie Shop</h1>
      </div>
      <a href="../login/register.php"><button id="registerButton" role="button">Zarejestruj się</button></a>
      <a href="../login/login.php"><button class="loginButton" role="button">Zaloguj się</button></a>
    </nav>

    <?php 
      $host = "localhost";
      $db_user = "root";
      $db_password = "";
      $db_name = "MovieStore";

      $connection = mysqli_connect($host, $db_user, $db_password, $db_name);

      $sql = "SELECT image, title, description, rating, price  FROM Movies";

      $result = mysqli_query($connection, $sql);

      while($row = mysqli_fetch_assoc($result)){
        $rating = $row['rating'];
        $image = $row['image'];
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        echo <<<END
         <form action="addToCartScript.php" method="post">
         <div class="product">
           <div class="productImage">
             <img src="..$image" alt="" width="324px" height="250px">
           </div>
           <div class="description">
             <h1>$title</h1>
             <p>Opis filmu:</p>
             $description
           </div>
           <div class="rating">
            <h3>Ocena:</h3><br>
        END;
        echo str_repeat("<img src='../ImagesMovieShop/star.png' width='15px'>", floor($rating/2));
        if ($rating%2 === 1 ) echo "<img src='../ImagesMovieShop/star-half.png' width='15px'>";
        echo str_repeat("<img src='../ImagesMovieShop/empty-star.png' width='15px'>", 5-ceil($rating/2));
        echo <<<END
             <div class="productCounting">
               <input type="number" onKeyDown="return false" id="quantity"name="quantity" min="1" max="100">
             </div>
           </div>
           <div class="price">
             <h3>Cena:</h3><br>
             <h2>$price zł</h2>
           </div>
         </div>
         </form>
         END;
      }
      mysqli_close($connection);
    ?>
</body>
</html>