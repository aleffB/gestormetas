<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];
$orgao = $_POST['recebeOrgao'];
$inddep = $_POST['recebeInddep'];

$sql_code = "SELECT id_causa, desc_causa FROM causa WHERE anob = '$valor' AND atuar = 1 AND cod_org = '$orgao' AND id_inddep = '$inddep'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);


?>

