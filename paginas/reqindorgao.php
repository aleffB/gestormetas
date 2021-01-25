<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];
$orgao = $_POST['recebeOrgao'];

$sql_code = "SELECT inddep.id_inddep, inddep.desc_inddep FROM indicadordepartamental AS inddep INNER JOIN indicadororgao AS indorg  ON inddep.id_inddep = indorg.id_inddep WHERE inddep.anob = '$valor' AND indorg.cod_orgao = '$orgao'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);


?>
