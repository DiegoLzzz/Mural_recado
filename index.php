<?php
include "auth/logout.php";
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/pg.css" rel="stylesheet">
    <title>Document</title>
  </head>
  <body>
    <form action="auth/login.php" method="post">
      <h1>Login</h1>
      <div class="row">
        <input type="email" name="email" placeholder="Email" />
      </div>
      <div class="row">
        <input type="password" name="senha" class="senha" placeholder="Senha" />
        <img
          src="https://icon-library.com/images/icon-eyes/icon-eyes-12.jpg"
          class="btn"
        />
      </div>
      <input type="submit" value="Enviar" />
    </form>

   
    <script src="js/pg.js"></script>
  </body>
</html>