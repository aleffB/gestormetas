<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];

$sql_code = "SELECT o.cod_orgao,o.desc_orgao,o.data_ref,o.sigla,o.diretoria,o.gerente,o.ativo,d.desc_diretoria FROM orgaos AS o INNER JOIN diretoria AS d ON o.diretoria = d.id_diretoria WHERE cod_orgao = '$valor'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);


?>
