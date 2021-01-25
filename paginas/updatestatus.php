<?php
include_once("../classe/conexao.php");

$id = $_POST['idSelect'];
$id2 = $_POST['id2Select'];
$identificador = $_POST['identSelect'];
$acaoinicioR = $_POST['acaoInicioSelect'];
$etapainicioR = $_POST['etapaInicioSelect'];
$statusA = $_POST['statusA'];
$statusE = $_POST['statusE'];
$acaoterminoR = $_POST['acaoTerminoSelect'];
$etapaterminoR = $_POST['etapaTerminoSelect'];
$dataatual = $_POST['dataAtual'];
$acaoinicioP = $_POST['recIAcaoP'];
$acaoterminoP = $_POST['recTAcaoP'];
$etapainicioP = $_POST['recIEtapaP'];
$etapaterminoP = $_POST['recTEtapaP'];

$breakacaoip = explode("-", $acaoinicioP);
$diaacaoip = $breakacaoip[2];
$mesacaoip = $breakacaoip[1];
$anoacaoip = $breakacaoip[0];

$breakacaotp = explode("-", $acaoterminoP);
$diaacaotp = $breakacaotp[2];
$mesacaotp = $breakacaotp[1];
$anoacaotp = $breakacaotp[0];

$breaketapaip = explode("-", $etapainicioP);
$diaetapaip = $breaketapaip[2];
$mesetapaip = $breaketapaip[1];
$anoetapaip = $breaketapaip[0];

$breaketapatp = explode("-", $etapaterminoP);
$diaetapatp = $breaketapatp[2];
$mesetapatp = $breaketapatp[1];
$anoetapatp = $breaketapatp[0];


$breakdata = explode("-", $dataatual);
$diaatual = $breakdata[2];
$mesatual = $breakdata[1];
$anoatual = $breakdata[0];

$breakacaoi = explode("-", $acaoinicioR); 
$diaacaoi = $breakacaoi[2];
$mesacaoi = $breakacaoi[1];
$anoacaoi = $breakacaoi[0];

$breakacaot = explode("-", $acaoterminoR);
$diaacaot = $breakacaot[2];
$mesacaot = $breakacaot[1];
$anoacaot = $breakacaot[0];

$breaketapai = explode("-", $etapainicioR);
$diaetapai = $breaketapai[2];
$mesetapai = $breaketapai[1];
$anoetapai = $breaketapai[0];

$breaketapat = explode("-", $etapaterminoR);
$diaetapat = $breaketapat[2];
$mesetapat= $breaketapat[1];
$anoetapat = $breaketapat[0];



//SEM DATA INICIAL REAL
if($acaoinicioR == null && $acaoterminoR ==null && $etapainicioR == null && $etapaterminoR ==null && $statusA!=5){
	//ATUALIZA STATUS AÇÃO
	if($identificador == "faltainicioacaoetapa" && $diaacaoip >= $diaatual && $mesacaoip >= $mesatual && $anoacaoip >= $anoatual){
	$sql_code= "UPDATE planoacao SET
	            status = 4

	            WHERE id_planoacao = '$id'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);


	     }else{
	     	$sql_code= "UPDATE planoacao SET
	            status = 3

	            WHERE id_planoacao = '$id'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	     }
	     	//TESTANDO
	     if($identificador == "faltainicioacaoetapa"  && $statusE!=5  && $diaetapaip >= $diaatual && $mesetapaip >= $mesatual && $anoetapaip >= $anoatual){
	     	if($statusE!=5){
	    	$sql_code= "UPDATE etapa SET
	            status = 4

	            WHERE id_etapa = '$id2'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	            }
	        }else{
	        	if($statusE!=5){
	        	$sql_code= "UPDATE etapa SET
	            status = 3

	            WHERE id_etapa = '$id2'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	            }
	        }



	    }

	    //-------------FIM----------------------





	     if($acaoinicioR != null && $acaoterminoR ==null && $etapainicioR == null && $etapaterminoR ==null && $statusA!=5){

	     	if($identificador == "faltainicioacaoetapa" && $diaacaotp >= $diaatual && $mesacaotp >= $mesatual && $anoacaotp >= $anoatual  ){
			$sql_code= "UPDATE planoacao SET
	            status = 2

	            WHERE id_planoacao = '$id'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	     }else{
	     	$sql_code= "UPDATE planoacao SET
	            status = 3

	            WHERE id_planoacao = '$id'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	     }
	    	//ATUALIZA STATUS ETAPA
	    	if($identificador == "faltainicioacaoetapa" && $statusE!=5 && $diaetapaip >= $diaatual && $mesetapaip >= $mesatual && $anoetapaip >= $anoatual){
	    		if($statusE!=5){
	    	$sql_code= "UPDATE etapa SET
	            status = 4

	            WHERE id_etapa = '$id2'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	        }
	        }else{
	        	if($statusE!=5){
	        	$sql_code= "UPDATE etapa SET
	            status = 3

	            WHERE id_etapa = '$id2'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	            }
	        }
	        //TESTANDO
	 
	   
	     }
	     //--------------------FIM----------------------


if($acaoinicioR == null && $acaoterminoR ==null && $etapainicioR != null && $etapaterminoR ==null && $statusA!=5){
	//ATUALIZA STATUS AÇÃO
	if($identificador == "faltainicioacaoetapa" && $diaacaoip >= $diaatual && $mesacaoip >= $mesatual && $anoacaoip >= $anoatual){
	$sql_code= "UPDATE planoacao SET
	            status = 4

	            WHERE id_planoacao = '$id'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);


	     }else{
	     	$sql_code= "UPDATE planoacao SET
	            status = 3

	            WHERE id_planoacao = '$id'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	     }
	     	//TESTANDO
	     if($identificador == "faltainicioacaoetapa"  && $statusE!=5  && $diaetapatp >= $diaatual && $mesetapatp >= $mesatual && $anoetapatp >= $anoatual){
	     	if($statusE!=5){
	    	$sql_code= "UPDATE etapa SET
	            status = 2

	            WHERE id_etapa = '$id2'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	            }
	        }else{
	        	if($statusE!=5){
	        	$sql_code= "UPDATE etapa SET
	            status = 3

	            WHERE id_etapa = '$id2'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	            }
	        }



	    }

	    //----------------FIM--------------------

	    if($acaoinicioR != null && $acaoterminoR !=null && $etapainicioR == null && $etapaterminoR ==null && $statusA!=5){
	//ATUALIZA STATUS AÇÃO
	if($identificador == "faltainicioacaoetapa"){
	$sql_code= "UPDATE planoacao SET
	            status = 1

	            WHERE id_planoacao = '$id'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);


	     }
	     	//TESTANDO
	     if($identificador == "faltainicioacaoetapa"  && $statusE!=5  && $diaetapaip >= $diaatual && $mesetapaip >= $mesatual && $anoetapaip >= $anoatual){
	     	if($statusE!=5){
	    	$sql_code= "UPDATE etapa SET
	            status = 4

	            WHERE id_etapa = '$id2'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	            }
	        }else{
	        	if($statusE!=5){
	        	$sql_code= "UPDATE etapa SET
	            status = 3

	            WHERE id_etapa = '$id2'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	            }
	        }



	    }

	    //-----------------FIM-------------------------

	    if($acaoinicioR == null && $acaoterminoR ==null && $etapainicioR != null && $etapaterminoR !=null && $statusA!=5){
	//ATUALIZA STATUS AÇÃO
	if($identificador == "faltainicioacaoetapa" && $diaacaoip >= $diaatual && $mesacaoip >= $mesatual && $anoacaoip >= $anoatual){
	$sql_code= "UPDATE planoacao SET
	            status = 4

	            WHERE id_planoacao = '$id'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);


	     }else{
	     	$sql_code= "UPDATE planoacao SET
	            status = 3

	            WHERE id_planoacao = '$id'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	     }
	     	//TESTANDO
	     if($identificador == "faltainicioacaoetapa" && $statusE!=5){
	    	$sql_code= "UPDATE etapa SET
	            status = 1

	            WHERE id_etapa = '$id2'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	        }

           }
           //--------------------FIM---------------------

           if($acaoinicioR != null && $acaoterminoR !=null && $etapainicioR != null && $etapaterminoR ==null && $statusA!=5){
	//ATUALIZA STATUS AÇÃO
	if($identificador == "faltainicioacaoetapa"){
	$sql_code= "UPDATE planoacao SET
	            status = 1

	            WHERE id_planoacao = '$id'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);


	     }
	     	//TESTANDO
	     if($identificador == "faltainicioacaoetapa"  && $statusE!=5  && $diaetapatp >= $diaatual && $mesetapatp >= $mesatual && $anoetapatp >= $anoatual){
	     	if($statusE!=5){
	    	$sql_code= "UPDATE etapa SET
	            status = 2

	            WHERE id_etapa = '$id2'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	            }
	        }else{
	        	if($statusE!=5){
	        	$sql_code= "UPDATE etapa SET
	            status = 3

	            WHERE id_etapa = '$id2'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	            }
	        }



	    }

	    //----------------FIM------------------

	    if($acaoinicioR != null && $acaoterminoR ==null && $etapainicioR != null && $etapaterminoR !=null && $statusA!=5){
	//ATUALIZA STATUS AÇÃO
	if($identificador == "faltainicioacaoetapa" && $diaacaotp >= $diaatual && $mesacaotp >= $mesatual && $anoacaotp >= $anoatual){
	$sql_code= "UPDATE planoacao SET
	            status = 2

	            WHERE id_planoacao = '$id'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);


	     }else{
	     	$sql_code= "UPDATE planoacao SET
	            status = 3

	            WHERE id_planoacao = '$id'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	     }
	     	//TESTANDO
	     if($identificador == "faltainicioacaoetapa"  && $statusE!=5){
	    	$sql_code= "UPDATE etapa SET
	            status = 1

	            WHERE id_etapa = '$id2'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	        }



	    }

	     //-----------------------------------FIM---------------------------------


	   if($acaoinicioR != null && $acaoterminoR !=null && $etapainicioR != null && $etapaterminoR !=null && $statusA!=5){
	//ATUALIZA STATUS AÇÃO
	if($identificador == "faltainicioacaoetapa" ){
	$sql_code= "UPDATE planoacao SET
	            status = 1

	            WHERE id_planoacao = '$id'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);


	     }
	     	//TESTANDO
	     if($identificador == "faltainicioacaoetapa"  && $statusE!=5){
	    	$sql_code= "UPDATE etapa SET
	            status = 1

	            WHERE id_etapa = '$id2'";

	            $confirma = $mysqli->query($sql_code) or die($mysqli->error);
	        }



	    }


?>
