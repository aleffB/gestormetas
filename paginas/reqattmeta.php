<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];
$orgao = $_POST['recebeOrgao'];

$sql_code = "SELECT m.id_meta, m.desc_meta,m.responsavel FROM meta AS m INNER JOIN indicadordepartamental AS i  ON m.id_inddep = i.id_inddep WHERE i.anob = '$valor' AND m.cod_org = '$orgao'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);


?>
