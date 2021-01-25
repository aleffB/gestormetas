<?php
include_once("../classe/conexao.php");

$valor = $_POST['valorSelect'];
$orgao = $_POST['valorOrgao'];
$dep   = $_POST['valorDepartamento'];


$sql_code = "SELECT p.id_planoacao, p.desc_acao, p.date_iniciop as datainicioplano, p.date_terminop as dataterminoplano, p.date_inicior as datarealinicioplano, p.date_terminor as datarealterminoplano,p.responsavel as responsavelplano,p.status as statusplano,p.sequencia as sequenciaplano, p.obs as obsacao, p.date_iniciop as dataprevistainicioplano, p.date_terminop as dataprevistaterminoplano, e.id_etapa,e.desc_etapa,e.date_iniciop as datainicioetapa, e.date_terminop as dataterminoetapa,e.date_inicior as datarealinicioetapa,e.date_terminor as datarealterminoetapa,e.responsavel as responsaveletapa,e.status as statusetapa, e.sequencia sequenciaetapa, e.obs as obsetapa, e.date_iniciop as dataprevistainicioetapa, e.date_terminop as dataprevistaterminoetapa FROM planoacao as p INNER JOIN etapa as e ON p.id_planoacao = e.id_cod_acao WHERE p.id_inddep = '$dep' AND p.cod_org = '$orgao' AND p.anob = '$valor'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $arr[] = $linhatabela;
    }while($linhatabela = $sql_query->fetch_assoc());
   



echo json_encode($arr);


?>
