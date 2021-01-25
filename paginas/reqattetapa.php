<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];
$orgao = $_POST['recebeOrgao'];
$acao = $_POST['recebeAcao'];
$causa = $_POST['recebeCausa'];

$sql_code = "SELECT e.id_etapa,e.cod_acao,e.cod_causa,e.anob,e.cod_etapa,e.desc_etapa,e.date_iniciop,e.date_terminop,e.date_inicior,e.date_terminor,e.responsavel,e.status,e.sequencia FROM etapa AS e INNER JOIN indicadordepartamental AS i  ON e.id_inddep = i.id_inddep WHERE i.anob = '$valor' AND e.cod_org = '$orgao' AND e.cod_acao = '$acao' AND e.cod_causa = '$causa'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);


?>
