<?php
    session_start();
    if ($_SESSION['admin'] == 0 or !isset($_SESSION['admin'])) {
        header('Location: ../login/login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav id="panelNav">
        <h3>Jesteś zalogowany jako: <?php echo $_SESSION['username']; ?><h3>
        <a href="../login/home.php" style="float: left;"><h4>Powrót do sklepu</h4></a>
    </nav>
<div id="container">
    <a href="add.php"><div class='adminOption'>
        Dodaj
    </div></a>
    <a href="edit&delpanel.php"><div class='adminOption'>
        Edytuj/Usuń
    </div></a>
    <a href="privileges.php"><div class='adminOption'>
        Uprawnienia
    </div></a>
    <a href="logs.php"><div class='adminOption'>
        Logi
    </div></a>
</div>
</body>
</html>