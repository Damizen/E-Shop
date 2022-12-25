<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
    <?php
        session_start();
    ?>
<body>
    <nav id="CartNav">
        <div id="HelloDiv">
            <h3>Koszyk użytkownika:<?php echo " ".$_SESSION['username'];?></h3>
        </div>
        <div>
            <a href="emptyCart.php" id="emptyCart" style="float: right; margin-top: 40px; margin-right: 40px;"><h3>Oproznij koszyk</h3></a>
            <a href="../login/home.php" style="float: left;"><h4>Powrót do sklepu</h4></a>
        </div>
    </nav>

        <?php
            require_once '../main/connect.php';
            $userId = $_SESSION['id'];
            $sql = "SELECT Cart.id, Cart.id_user, Cart.id_product, Cart.count, Movies.title, Movies.thumbnail, Movies.price FROM Cart INNER JOIN Movies ON Cart.id_product = Movies.id WHERE id_user = '$userId'";

            $result = mysqli_query($connection, $sql);

            while($row = mysqli_fetch_assoc($result)){
                $priceFormated = number_format($row['price'], 2, ',', '.');
                $id=$row['id'];
                $image=$row['thumbnail'];
                $title=$row['title'];
                $price=$row['price'];
                $count=$row['count'];
echo <<< END
                <div class="cartProduct">
                        <div class="cartProductImage">
                            <img src="../$image" alt="" width="100%" height="125px">
                    </div>
                    <div class="cartProductTitle">
                        $title
                    </div>
                    <div class="cartProductPrice">
                        Cena: 
                        $priceFormated  zł
                    </div>
                    <div class="cartProducQuantity">

                        <br><br>
                        Ilość:
                        $count
                    </div>
                    <div class="cartProductDelete">
                        <a href="delete.php?id=$id">Usun produkt</a>
                    </div>
                </div>
END;
                $suma = $suma + ($row['price'] * $row['count']);
                $sumFormat = number_format($suma, 2, ',', '.');
                }
                $sumFormat = number_format($suma, 2, ',', '.');
                echo <<<END
                <div class="total">
                    <h2>Suma: $sumFormat zł</h2>
                </div>
                END;
            ?>
        
</body>
</html>
