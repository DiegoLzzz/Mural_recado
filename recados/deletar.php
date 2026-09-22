```php
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

$usuario_id = $_SESSION["usuario_id"];

$sql = "
    DELETE FROM recados
    WHERE id = ? AND usuario_id = ?
";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar exclusão: " . $conn->error);
}

$stmt->bind_param("ii", $id, $usuario_id);

$stmt->execute();

$stmt->close();

header("Location: ../dashboard.php");
exit;