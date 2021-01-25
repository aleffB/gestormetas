<?php     
include_once("../classe/conexao.php");      

$id = $_POST['valorId'];
$check = $_POST['valorChecked'];
$name = $_POST['valorName'];


			if($check == "true"){
				$check = 5;
			} else {
				$check = 1;
			}

    foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);

			
			if($name=="cancelaracao"){	
            $sql_code3 = "SELECT status FROM planoacao WHERE id_planoacao = '$id'";
            $sql_query3 = $mysqli->query($sql_code3) or die($mysqli->error);
            $linhatabela2 = $sql_query3->fetch_assoc();
            $valorstatus = $linhatabela2['status'];
              if($valorstatus != 5){
              $sql_code= "UPDATE planoacao SET
            status = '$check'

            WHERE id_planoacao = '$id'";

            $confirma = $mysqli->query($sql_code) or die($mysqli->error);

              //----------------- ATUALIZAÇÃO DAS ETAPAS RELACIONADAS A AÇÃO
            $sql_code2 = "SELECT etapa.sequencia, id_etapa FROM etapa INNER JOIN planoacao ON etapa.id_cod_acao = planoacao.id_planoacao WHERE planoacao.id_planoacao = '$id'";
             $sql_query = $mysqli->query($sql_code2) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $idetapa = $linhatabela['id_etapa'];

        $sql_code3= "UPDATE etapa SET
            status = '$check'

            WHERE id_etapa = '$idetapa'";

             $confirma3 = $mysqli->query($sql_code3) or die($mysqli->error);

    }while($linhatabela = $sql_query->fetch_assoc());

    //ALTERAÇÃO DE VALOR CASO JÁ ESTEJA CANCELADO
  }else if($valorstatus == 5){

    $sql_code= "UPDATE planoacao SET
            status = 4

            WHERE id_planoacao = '$id'";

            $confirma = $mysqli->query($sql_code) or die($mysqli->error);

              //----------------- ATUALIZAÇÃO DAS ETAPAS RELACIONADAS A AÇÃO
            $sql_code2 = "SELECT etapa.sequencia, id_etapa FROM etapa INNER JOIN planoacao ON etapa.id_cod_acao = planoacao.id_planoacao WHERE planoacao.id_planoacao = '$id'";
             $sql_query = $mysqli->query($sql_code2) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        do{
        $idetapa = $linhatabela['id_etapa'];

        $sql_code3= "UPDATE etapa SET
            status = 4

            WHERE id_etapa = '$idetapa'";

             $confirma3 = $mysqli->query($sql_code3) or die($mysqli->error);

    }while($linhatabela = $sql_query->fetch_assoc());
  }
          
        //EXECUTA O ELSE CASO APENAS A ETAPA SEJA CLICKADA
      }else if($name=="cancelaretapa"){
        $sql_code3 = "SELECT status FROM etapa WHERE id_etapa = '$id'";
            $sql_query3 = $mysqli->query($sql_code3) or die($mysqli->error);
            $linhatabela2 = $sql_query3->fetch_assoc();
            $valorstatus = $linhatabela2['status'];
        if($valorstatus != 5){
      	$sql_code= "UPDATE etapa SET
            status = '$check'

            WHERE id_etapa = '$id'";

             $confirma = $mysqli->query($sql_code) or die($mysqli->error);

            }else if($valorstatus == 5){
              $sql_code= "UPDATE etapa SET
            status = 4

            WHERE id_etapa = '$id'";

             $confirma = $mysqli->query($sql_code) or die($mysqli->error);
             }

      }


     


?>