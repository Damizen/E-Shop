<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register in Movie Shop</title>
    <link rel="stylesheet" href="../css/logiCss.css">
</head>
<body>
<div class="container">
      <form action="addAccount.php" method="post">
         <h1>Zarejestruj się</h1>
         <div class="form-group">
            <label for="">Wprowadź adres email</label>
            <input type="text" class="form-control" name="email" require>
            <label for=""> Wprowadź swoje imię</label>
            <input type="text" class="form-control" name="username" require><br>
         </div>
         <div>
            <label for="">Wprowadź hasło: </label>
            <input type="password" name="password" class="form-control">
         </div>
         <input type="submit" class="btn" value="Zarejestruj">
      </form>
   </div>
</body>
</html>