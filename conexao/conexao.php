<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "mural";
//criando o objeto da conexão
$conn = new mysqli($host,$user,$pass,$db);

if(!$conn){
    die("Erro de Conexão: " . mysqli_connect_error());
}


?>