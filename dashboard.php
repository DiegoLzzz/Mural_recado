```php
<?php

session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: index.php");
    exit;
}

$nome = $_SESSION["usuario_nome"];

?>

<!doctype html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="css/pg.css" rel="stylesheet">

    <title>Mural de Recados</title>

</head>

<body>

    <h1>
        Olá, <?= htmlspecialchars($nome) ?>!
    </h1>

    <p>
        Bem-vindo ao seu mural de recados.
    </p>

    <a href="auth/logout.php">
        Sair
    </a>

    <hr>

    <h2>Novo recado</h2>

    <?php include "recados/cadastrar.php"; ?>

    <hr>

    <h2>Recados</h2>

    <?php include "recados/listar.php"; ?>

</body>

</html>