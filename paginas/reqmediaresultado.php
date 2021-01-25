<?php
include_once("../classe/conexao.php");

$recebevalor = $_POST['valorSelect'];
$recebeorgao = $_POST['recebeOrgao'];

$sql_code = "SELECT rmensal.cod_org, AVG(rmensal.result_mes) AS mediaresultmes FROM indicadordepartamental AS inddep INNER JOIN indicadororgao AS indorg ON inddep.id_inddep = indorg.id_inddep INNER JOIN resultmensal AS rmensal ON rmensal.id_inddep = inddep.id_inddep WHERE inddep.id_inddep = '$recebevalor' AND indorg.cod_orgao = '$recebeorgao' GROUP BY 1 ";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        $arr[] = $linhatabela;
    
   



echo json_encode($arr);


?>
