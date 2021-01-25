<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];
$orgao = $_POST['orgaoSelect'];

$sql_code = "SELECT sequencia FROM etapa WHERE cod_org = '$orgao' AND id_cod_acao = '$valor' ORDER BY sequencia DESC LIMIT 1 ";

$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        $arr[] = $linhatabela;
   



echo json_encode($arr);


?>