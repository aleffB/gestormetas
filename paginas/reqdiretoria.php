<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];

$sql_code = "SELECT  desc_diretoria,ativo FROM diretoria WHERE desc_diretoria = '$valor'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);


?>
