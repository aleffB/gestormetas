<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];
$ac = $_POST['recebeAc'];

$sql_code6 = "SELECT area_fornecedor FROM fornecedor WHERE anob = '$valor' AND area_cliente = '$ac'";
        $sql_query6 = $mysqli->query($sql_code6) or die($mysqli->error);
        $linhatabela6 = $sql_query6->fetch_assoc();
        //retornado o código do orgão buscado e inserindo na variável $orgaobuscado
        do{
		        $arebuscada = $linhatabela6['area_fornecedor'];


		$sql_code4 = "SELECT cod_orgao,desc_orgao FROM orgaos WHERE cod_orgao = '$arebuscada'";
		        $sql_query = $mysqli->query($sql_code4) or die($mysqli->error);
		        $linhatabela = $sql_query->fetch_assoc();
		        do{
		        $arr[] = $linhatabela;
		    }while($linhatabela = $sql_query->fetch_assoc());
   }while($linhatabela6 = $sql_query6->fetch_assoc());


echo json_encode($arr);


?>
