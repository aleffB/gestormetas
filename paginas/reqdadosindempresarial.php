<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];

$sql_code = "SELECT id_indicador,ano_base,desc_indicador,melhor_traj,acumulativo,und_medida,obs,meta_fx1, meta_fx2 FROM indicadores WHERE id_indicador = '$valor'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);


?>
