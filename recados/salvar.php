<?php

session_start();

require_once __DIR__ . "/../conexao/conexao.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../index.php");
    exit;
}

$mensagem = trim($_POST["mensagem"] ?? "");

if (empty($mensagem)) {
    header("Location: ../dashboard.php");
    exit;
}

$usuario_id = $_SESSION["usuario_id"];

$sql = "INSERT INTO recados (usuario_id, mensagem) VALUES (?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar o recado: " . $conn->error);
}

$stmt->bind_param("is", $usuario_id, $mensagem);

if (!$stmt->execute()) {
    die("Erro ao salvar recado: " . $stmt->error);
}

$stmt->close();

header("Location: ../dashboard.php");
exit;

