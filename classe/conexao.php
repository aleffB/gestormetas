<?php
//definindo os dados do banco
$host = "localhost";
$usuario = "root";
$senha = "";
$bd = "eletro";
//criando conexão com o banco
$mysqli = new mysqli($host, $usuario, $senha, $bd);
//em caso de erro exibir o erro que está dando
if($mysqli->connect_errno)
    echo"Falha na conexão: (".$mysqli->connect_errno.") ".$mysqli->connect_error;
?>