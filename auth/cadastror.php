<?php

include "../conexao/conexao.php";

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];

    if (empty($nome) || empty($email) || empty($senha)) {

        $mensagem = "Preencha todos os campos.";

    } else {

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $email, $senha_hash);

        if ($stmt->execute()) {

            header("Location: ../index.php");
            exit;

        } else {

            if ($conn->errno == 1062) {
                $mensagem = "Esse email já está cadastrado.";
            } else {
                $mensagem = "Erro ao cadastrar usuário.";
            }
        }

        $stmt->close();
    }
}

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/pg.css" rel="stylesheet">
    <title>Cadastro</title>
</head>

<body>

    <form action="cadastro.php" method="post">

        <h1>Cadastro</h1>

        <?php if (!empty($mensagem)): ?>
            <p><?= htmlspecialchars($mensagem) ?></p>
        <?php endif; ?>

        <div class="row">
            <input
                type="text"
                name="nome"
                placeholder="Nome"
                required
            >
        </div>

        <div class="row">
            <input
                type="email"
                name="email"
                placeholder="Email"
                required
            >
        </div>

        <div class="row">
            <input
                type="password"
                name="senha"
                placeholder="Senha"
                required
            >
        </div>

        <input type="submit" value="Cadastrar">

        <p>
            Já possui uma conta?
            <a href="../index.php">Entrar</a>
        </p>

    </form>

</body>

</html>