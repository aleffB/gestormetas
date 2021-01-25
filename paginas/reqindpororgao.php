<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];

$sql_code = "SELECT ic.id_indorg,ic.cod_orgao,ic.anob, ic.meta_fx1, ic.meta_fx2, ic.peso, ic.id_inddep, id.desc_inddep, id.melhor_traj FROM indicadororgao AS ic INNER JOIN indicadordepartamental AS id ON ic.id_inddep = id.id_inddep WHERE cod_orgao = '$valor'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);


?>
