<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];
$orgao = $_POST['recebeOrgao'];

$sql_code = "SELECT e.e_efeito,e.id_efeito FROM efeito AS e INNER JOIN indicadordepartamental AS i  ON e.id_inddep = i.id_inddep WHERE e.cod_org = '$orgao' AND i.anob = '$valor'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);
