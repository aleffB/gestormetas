<?php     
include_once("../classe/conexao.php");      

$diretoria = $_POST['valorSelect'];
$ativo = 1;



    foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);

			
			$sql_code= "INSERT INTO diretoria(
            desc_diretoria,ativo)

            VALUES(
            '$diretoria',
            '$ativo')";

       $confirma = $mysqli->query($sql_code) or die($mysqli->error);
                  
?>