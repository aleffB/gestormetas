<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];
$recebeorgao = $_POST['recebeOrgao'];
$sql_code = "SELECT p.id_planoacao,p.cod_org, p.id_inddep , p.anob, p.cod_acao,p.desc_acao,p.date_iniciop,p.date_terminop,p.date_inicior, p.date_terminor, p.responsavel, p.status, p.sequencia, i.desc_inddep FROM planoacao AS p INNER JOIN indicadordepartamental AS i ON p.id_inddep = i.id_inddep WHERE i.anob = '$valor' AND p.cod_org = '$recebeorgao'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);


?>
