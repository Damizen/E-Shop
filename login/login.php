<!DOCTYPE html>
<html lang="pl">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Movie Shop Login</title>
   <link rel="stylesheet" href="../css/logiCss.css">
</head>
<body>
   <div class="container">
      <form action="auth.php" method="post">
         <h1>Logowanie</h1>
         <div class="form-group">
            <label for=""> Nazwa użytkownika </label>
            <input type="text" class="form-control" name="username" require>
         </div>
         <div>
            <label for="">Hasło</label>
            <input type="password" name="password" class="form-control">
         </div>
         <input type="submit" class="btn" value="Zaloguj się">
      </form>
   </div>
</body>
</html>