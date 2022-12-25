<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav>
        <div id="logo">
            <h1>Movie Shop</h1>
        </div>
        <a href="logout.php"><button class="btnlogout">Wyloguj się</button></a>
        <?php
            session_start();

            if($_SESSION['admin'] == 1){
                echo "<a href='../Adminpages/adminPanel.php'><button class='loginButton'>Admin Panel</button></a>";
            }?>
        <a href="../cart/cart.php"><img class="cartImage" src="../Images/cart.png" alt=""></a>
        <?php
            echo "<div id='welcomeUser'><h3>Witaj, ".$_SESSION['username']."</h3></div>";
        ?>
    </nav>

    <?php 
      $host = "localhost";
      $db_user = "root";
      $db_password = "";
      $db_name = "MovieStore";

      $connection = mysqli_connect($host, $db_user, $db_password, $db_name);

      $sql = "SELECT id, image, title, description, rating, price  FROM Movies";

      $result = mysqli_query($connection, $sql);

      while($row = mysqli_fetch_assoc($result)){
        $rating = $row['rating'];
        $image = $row['image'];
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $priceFormatted = number_format($price, 2, ',', '.');
        $id = $row['id'];
        echo <<<END
         <div class="product">
           <div class="productImage">
             <img src="../$image" alt="" width="324px" height="250px">
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
            <form action="../cart/addToCart.php" id="$id" method="get">
            <input type="text" name="id" value="$id" hidden>
             <div class="productCounting">
               <input type="number" id="quantity" name="quantity" min="1" max="100" value="1" required>
             </div>
           </div>
                <div class="price">
                    <h3>Cena:</h3><br>
                    <h3>$priceFormatted zł</h3>
                    <input type="submit" class="addButton" id="$id" value="Dodaj do koszyka">
                </div>
            </form>
         </div>
        END;

        }
        mysqli_close($connection);
    ?>
</body>
</html>