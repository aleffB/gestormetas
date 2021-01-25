<?php 
include_once("../classe/conexao.php"); 

$dados = $_POST['dadosSelect'];
$valor = $_POST['valorSelect'];

$quebrando = explode(" ", $dados);
$id = $quebrando[0];
$tipo = $quebrando[1];



 foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);

    
     if($tipo=="acaodtir"){
    	$sql_code= "UPDATE planoacao SET
            date_inicior = '$valor'

            WHERE id_planoacao = '$id'";

            $confirma = $mysqli->query($sql_code) or die($mysqli->error);

    }else if($tipo=="acaodttr"){
    	$sql_code= "UPDATE planoacao SET
            date_terminor = '$valor'

            WHERE id_planoacao = '$id'";

            $confirma = $mysqli->query($sql_code) or die($mysqli->error);

    }else if($tipo=="acaoresp"){

    	 $sql_code= "UPDATE planoacao SET
            responsavel = '$valor'

            WHERE id_planoacao = '$id'";

            $confirma = $mysqli->query($sql_code) or die($mysqli->error);

    }else if($tipo=="acaoobs"){
    	$sql_code= "UPDATE planoacao SET
            obs = '$valor'

            WHERE id_planoacao = '$id'";

            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
            	///INICIA ETAPA
    }else if($tipo=="etaparesp"){
    	$sql_code= "UPDATE etapa SET
            responsavel = '$valor'

            WHERE id_etapa = '$id'";

            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
    }else if($tipo=="etapadttr"){
    	$sql_code= "UPDATE etapa SET
            date_terminor = '$valor'

            WHERE id_etapa = '$id'";

            $confirma = $mysqli->query($sql_code) or die($mysqli->error);

    }else if($tipo=="etapadtir"){

    	 $sql_code= "UPDATE etapa SET
            date_inicior = '$valor'

            WHERE id_etapa = '$id'";

            $confirma = $mysqli->query($sql_code) or die($mysqli->error);

    }else if($tipo=="etapaobs"){
    	$sql_code= "UPDATE etapa SET
            obs = '$valor'

            WHERE id_etapa = '$id'";

            $confirma = $mysqli->query($sql_code) or die($mysqli->error);

    }



echo json_encode($dados);


   

   

?>
