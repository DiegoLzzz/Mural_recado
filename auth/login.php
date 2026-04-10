<?php

session_start();
include "../conexao/conexao.php";

$usuario = $_POST['email'];
$senha = $_POST['senha'];

if($usuario == "admin@gmail.com" and $senha == "123"){

    $_SESSION['usuario'] = $usuario;
    header("Location:../dashboard.php");

}else{

    echo "login invalido";

}

?>