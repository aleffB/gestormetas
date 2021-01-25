<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];
$ano = $_POST['anoSelect'];
$id = $_POST['inddepSelect'];

$sql_code = "SELECT id_inddep,anob,desc_inddep,melhor_traj,acumulativo,und_med,formula,obs FROM indicadordepartamental WHERE id_indempre = '$valor' AND anob = '$ano' AND id_inddep ='$id'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);


?>