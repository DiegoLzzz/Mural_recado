<?php

session_start();

include "../conexao/conexao.php";

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];

    if (empty($email) || empty($senha)) {

        $mensagem = "Preencha todos os campos.";

    } else {

        $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";

        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Erro no prepare: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        if ($usuario && password_verify($senha, $usuario["senha"])) {

            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["usuario_nome"] = $usuario["nome"];

            header("Location: ../dashboard.php");
            exit;

        } else {
            $mensagem = "Email ou senha inválidos.";
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
    <title>Login</title>
</head>

<body>

    <form action="login.php" method="post">

        <h1>Login</h1>

        <?php if (!empty($mensagem)): ?>
            <p><?= htmlspecialchars($mensagem) ?></p>
        <?php endif; ?>

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

        <input type="submit" value="Entrar">

        <p>
            Ainda não possui uma conta?
            <a href="cadastro.php">Cadastre-se</a>
        </p>

    </form>

</body>

</html>