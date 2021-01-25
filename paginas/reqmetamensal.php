<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];
$orgao = $_POST['recebeOrgao'];

$sql_code = "SELECT mm.id_metamensal,mm.metames, mm.toleranciameta, mm.metamesfev, mm.toleranciametafev, mm.metamesmar, mm.toleranciametamar, mm.metamesabr, mm.toleranciametaabr, mm.metamesmai, mm.toleranciametamai, mm.metamesjun, mm.toleranciametajun,mm.metamesjul, mm.toleranciametajul, mm.metamesago, mm.toleranciametaago, mm.metamesset, mm.toleranciametaset, mm.metamesout, mm.toleranciametaout, mm.metamesnov, mm.toleranciametanov, mm.metamesdez, mm.toleranciametadez FROM metamensal AS mm INNER JOIN indicadordepartamental AS inddep  ON mm.id_inddep = inddep.id_inddep WHERE inddep.anob = '$valor' AND mm.cod_orgao = '$orgao'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);


?>
