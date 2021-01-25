<?php
include_once("../classe/conexao.php");

$recebevalor = $_POST['valorSelect'];

$sql_code = "SELECT acumulativo FROM indicadordepartamental WHERE id_inddep = '$recebevalor'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        $arr[] = $linhatabela;
    
   



echo json_encode($arr);


?>
