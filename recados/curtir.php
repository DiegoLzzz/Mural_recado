<?php

session_start();

require_once __DIR__ . "/../conexao/conexao.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../index.php");
    exit;
}

$id = $_POST["id"] ?? "";

if (!is_numeric($id)) {
    header("Location: ../dashboard.php");
    exit;
}

$sql = "UPDATE recados SET curtidas = curtidas + 1 WHERE id = ?";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar curtida: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();

header("Location: ../dashboard.php");
exit;