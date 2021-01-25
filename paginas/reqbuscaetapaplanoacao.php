<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];
$orgao = $_POST['valorOrgao'];
$dep   = $_POST['valorDepartamento'];
 

$sql_code = "SELECT e.id_etapa,e.desc_etapa,e.date_iniciop as datainicioetapa, e.date_terminop as dataterminoetapa,e.date_inicior as datarealinicioetapa,e.date_terminor as datarealterminoetapa,e.responsavel as responsaveletapa,e.status as statusetapa, e.sequencia sequenciaetapa FROM etapa as e INNER JOIN planoacao as p ON p.id_planoacao = e.id_cod_acao WHERE p.id_inddep = '$dep' AND p.cod_org = '$orgao' AND p.anob = '$valor'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);


?>
