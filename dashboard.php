<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["usuario_id"])) {
    header("Location: index.php");
    exit;
}

$nome = $_SESSION["usuario_nome"] ?? "Usuário";

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/pg.css" rel="stylesheet">
    <title>Mural de Recados</title>
</head>

<body class="dashboard-body">

    <div class="mural-shell">

        <nav class="topbar">
            <div class="topbar-left">
                <span class="topbar-label">Mural de recados</span>
            </div>

            <div class="topbar-center">
                <span>Olá, <?= htmlspecialchars($nome) ?>! <span class="welcome-text">Bem-vindo</span></span>
            </div>

            <div class="topbar-right">
                <a href="auth/logout.php" class="sair-btn">Sair</a>
                <button class="menu-btn" type="button" aria-label="Mais opções">⋯</button>
            </div>
        </nav>

        <main class="mural-content">

            <section class="composer-panel">
                <?php include "recados/cadastrar.php"; ?>
            </section>

            <div class="divider"></div>

            <section class="feed-panel">
                <?php include "recados/listar.php"; ?>
            </section>

        </main>

    </div>

</body>

</html>