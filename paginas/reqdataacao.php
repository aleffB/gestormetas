<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];
$orgao = $_POST['orgaoSelect'];

$sql_code = "SELECT date_iniciop, date_terminop FROM planoacao WHERE cod_org = '$orgao' AND id_planoacao = '$valor'";

$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);


?>