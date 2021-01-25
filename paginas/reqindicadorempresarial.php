<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];

$sql_code = "SELECT id_indicador,desc_indicador FROM indicadores WHERE ano_base = '$valor'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);


?>
