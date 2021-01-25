<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];
$areac = $_POST['areacSelect'];

$sql_code4 = "SELECT id_ns, desc_ns FROM nivel_servico WHERE anob = '$valor' AND area_cliente = '$areac'";
        $sql_query = $mysqli->query($sql_code4) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);


?>
