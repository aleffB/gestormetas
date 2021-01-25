<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];
$orgao = $_POST['recebeOrgao'];

$sql_code = "SELECT c.id_causa,c.cod_causa,c.desc_causa,c.influencia,c.prioridade,c.atuar FROM causa AS c INNER JOIN indicadordepartamental AS i  ON c.id_inddep = i.id_inddep WHERE i.anob = '$valor' AND c.cod_org = '$orgao'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);


?>
