<?php
    session_start();
    // Check user login or not
    if ($_SESSION['admin'] == 0 or !isset($_SESSION['admin'])) {
      header('Location: ../home.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit&Remove</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav>
        <h3 style="text-align:center;">Jesteś zalogowany jako: <?php echo $_SESSION['username']; ?><h3>
        <a href="adminPanel.php" style="float: left;"><h4>Powrót do panelu</h4></a>
    </nav>
    <div id="container2">
        <table>
            <tr>
                <th>Id</th>
                <th>Nazwa</th>
                <th>Cena</th>
                <th></th>   
            </tr>
            <?php
            include '../main/connect.php';
            $stmt = $connection->prepare("SELECT id, title, price FROM Movies");
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = mysqli_fetch_array($result)){
                $id = $row['id'];
                $title = $row['title'];
                $price = number_format($row['price'], 2, ',', ' ');
                echo "
                <tr>
                    <td>$id</td>
                    <td>$title</td>
                    <td>$price</td>
                    <td><a href='edit.php?id=$id' style='color: green; background-color=white;'>Edytuj</a></td>
                    <td><a href='delete.php?id=$id' style='color: #ff3333;'>Usun</a></td>
                </tr>";
            }
            mysqli_close($connection);
            ?>
        </table>
    </div>
</body>
</html>