<?php
  // ISTANCIANDO CONEXAO COM O BANCO em todas as páginas
	include_once("classe/conexao.php");
  //INICIANDO SESSAO
  @session_start();
  //VERIFICANDO SE POSSUI OS SEGUINTES PARAMENTROS NA SESSAO

?>  





<!DOCTYPE html>
<html> 
<head>
	<title>Sistema Eletro</title>
</head>
<body>
      <div id="body">
      <?php
      //condição para receber o nome da page, método conhecido como paginação
          if (isset($_GET['pagina'])) {
                 $do = ($_GET['pagina']);
          }else{
            //se não encontrar, ela volta pra pagina inicio
            $do= "inicio";
          }
            //condição indentificando que a page existe e vai buscar ela na pasta páginas
          if(file_exists("paginas/".$do.".php")){
            include("paginas/".$do.".php");
          }else{
            //se não prita que não encontrou
            print 'Página não encontrada';
          }
      ?>
        
      </div>

</body>
</html>


       