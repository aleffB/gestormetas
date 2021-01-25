<?php     
include_once("../classe/conexao.php");      

$id = $_POST['valorId'];
$check = $_POST['valorChecked'];
$etapa =  $_POST['valorDesc'];

$sql_code = "SELECT id_etapa FROM etapa WHERE desc_etapa = '$etapa'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        $etaparec = $linhatabela['id_etapa'];

        while ($etaparec == null) {
         $sql_code = "SELECT id_etapa FROM etapa WHERE desc_etapa = '$etapa'";
       
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        $etaparec = $linhatabela['id_etapa'];

        }
        

        
if($check == "true"){

foreach ($id as $value) {

  $sql_code= "INSERT INTO etapa_causa(
            id_etapa,id_causa)

            VALUES(
            '$etaparec',
            '$value')";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);

  }
}
     

?>