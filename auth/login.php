<?php

session_start();
include "../conexao/conexao.php";

$usuario = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT id, nome. email, senha FROM  usuarios WHERE  email = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows === 1){

    $user = $resultado->fetch_assoc();

    if(password_verify($senha, $user["senha"])){

        $_SESSION["usuario_id"] = $user["id"];
        $_SESSION["usuario_nome"] = $user["nome"];
        $_SESSION["usuario_email"] = $user["email"];

        header("Location: ../dashboard.php");
        exit;

    }else{

        echo "Senha incorreta.";

    }

}else{

    echo "Usuario não encontrado";

}

$stmt->close();
$conn->close();

?>