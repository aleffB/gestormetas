<?php
//definindo valor de uma variável, para poder usa-la mais tarde
$acc = 0;
//variável que recebe o valor da sessão validador
$orgao = $_SESSION['id_orgao'];

/*if($orgao==2){
  header('Location: ?pagina=inicial');
  exit;
}*/

$valid = $_SESSION['validador'];
//caso aperte no botão com o name voltar, ele redirecionará para page inicio
if(isset($_POST['voltar'])){
 
 header('Location: index.php?pagina=inicio');
}
//verificar se não está na sessão, caso não esteja, é redirecionado para o inicio
if(!isset($_SESSION['nomeuser_adm']) && !isset($_SESSION['login_adm'])){
  header('Location: ?pagina=inicio');
  exit;
} 
//verifica se o usuário é ADM ou DEPENDENTE e executará o código abaixo definindo se for ADM acessa todos os orgãos, e se for DEPENDENTE acessa apenas ao seu orgão
if($valid==1){
 $sql_code4 = "SELECT * FROM orgaos";
        $sql_query = $mysqli->query($sql_code4) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        }else{
          $sql_code4 = "SELECT * FROM orgaos WHERE id_orgao = '$orgao'";
        $sql_query = $mysqli->query($sql_code4) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        }


        //  realiza consulta de tudo do indicador departamental
         $sql_code5 = "SELECT * FROM indicadordepartamental";
        $sql_query2 = $mysqli->query($sql_code5) or die($mysqli->error);
        $linhatabela2 = $sql_query2->fetch_assoc();
        //  realiza consulta do ano base do indicaedor departamental agrupando pelo mesmo
         $sql_code6 = "SELECT anob FROM indicadordepartamental GROUP BY 1";
        $sql_query6 = $mysqli->query($sql_code6) or die($mysqli->error);
        $linhatabela6 = $sql_query6->fetch_assoc();





//caso aperte no botão com o nome confirmar, executará o código abaixo
if(isset($_POST['confirmar'])){
      //salvará os valores dos campos nas variáveis abaixo
      $codorg = $_POST['descorgao'];
      $iddep = $_POST['descinddep'];

        // executará uma consulta utilizando como restrição o $codorg
       $sql_code2="SELECT cod_orgao FROM orgaos WHERE cod_orgao = '$codorg'";
       $show = $mysqli->query($sql_code2) or die($mysqli->error);
       $linhas = $show->fetch_assoc();
          // e armazenará em específico o valor do código do orgão na variável abaixo
       $resgateagain = $linhas['cod_orgao'];

       // executará uma consulta utilizando como restrição o $iddep
       $sql_code3="SELECT id_inddep, melhor_traj FROM indicadordepartamental WHERE id_inddep = '$iddep'";
       $show3 = $mysqli->query($sql_code3) or die($mysqli->error);
       $linha = $show3->fetch_assoc();
       // salvando em específico os valores das consultas nas varíaveis abaixo
       $resgate = $linha['id_inddep'];
       $mtraj = $linha['melhor_traj'];
//foreach para pegar os valores
    foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);

            //Conversão de valores dos Campos abaixo
            if( $resgateagain == $codorg  && $resgate == $iddep ){
              $recebefx1 = $_POST['metames'];
        $valor = (double)str_replace(',', '.', $recebefx1);
        $recebefx2faixa = $_POST['tolmetames'];
        $valor2 = (double)str_replace(',', '.', $recebefx2faixa);
        $recebefx2crescente = $valor * 0.95;
        $recebefx2decrescente = $valor * 1.05;
         //------------------------------
            $recebefx1fev = $_POST['metames2'];
        $fev = (double)str_replace(',', '.', $recebefx1fev);
        $recebefx2faixafev = $_POST['tolmetames2'];
        $fev2 = (double)str_replace(',', '.', $recebefx2faixafev);
        $recebefx2crescentefev = $fev * 0.95;
        $recebefx2decrescentefev = $fev * 1.05;
        //------------------------------
            $recebefx1mar = $_POST['metames3'];
        $mar = (double)str_replace(',', '.', $recebefx1mar);
        $recebefx2faixamar = $_POST['tolmetames3'];
        $mar2 = (double)str_replace(',', '.', $recebefx2faixamar);
        $recebefx2crescentemar = $mar * 0.95;
        $recebefx2decrescentemar = $mar * 1.05;



        //------------------------------
            $recebefx1abr = $_POST['metames4'];
        $abr = (double)str_replace(',', '.', $recebefx1abr);
        $recebefx2faixaabr = $_POST['tolmetames4'];
        $abr2 = (double)str_replace(',', '.', $recebefx2faixaabr);
        $recebefx2crescenteabr = $abr * 0.95;
        $recebefx2decrescenteabr = $abr * 1.05;


        //------------------------------
            $recebefx1mai = $_POST['metames5'];
        $mai = (double)str_replace(',', '.', $recebefx1mai);
        $recebefx2faixamai = $_POST['tolmetames5'];
        $mai2 = (double)str_replace(',', '.', $recebefx2faixamai);
        $recebefx2crescentemai = $mai * 0.95;
        $recebefx2decrescentemai = $mai * 1.05;


        //------------------------------

            $recebefx1jun = $_POST['metames6'];
        $jun = (double)str_replace(',', '.', $recebefx1jun);
        $recebefx2faixajun = $_POST['tolmetames6'];
        $jun2 = (double)str_replace(',', '.', $recebefx2faixajun);
        $recebefx2crescentejun = $jun * 0.95;
        $recebefx2decrescentejun = $jun * 1.05;
        //------------------------------

            $recebefx1jul = $_POST['metames7'];
        $jul = (double)str_replace(',', '.', $recebefx1jul);
        $recebefx2faixajul = $_POST['tolmetames7'];
        $jul2 = (double)str_replace(',', '.', $recebefx2faixajul);
        $recebefx2crescentejul = $jul * 0.95;
        $recebefx2decrescentejul = $jul * 1.05;
        //------------------------------
            $recebefx1ago = $_POST['metames8'];
        $ago = (double)str_replace(',', '.', $recebefx1ago);
        $recebefx2faixaago = $_POST['tolmetames8'];
        $ago2 = (double)str_replace(',', '.', $recebefx2faixaago);
        $recebefx2crescenteago = $ago * 0.95;
        $recebefx2decrescenteago = $ago * 1.05; 

        //------------------------------

            $recebefx1set = $_POST['metames9'];
        $set = (double)str_replace(',', '.', $recebefx1set);
        $recebefx2faixaset = $_POST['tolmetames9'];
        $set2 = (double)str_replace(',', '.', $recebefx2faixaset);
        $recebefx2crescenteset = $set * 0.95;
        $recebefx2decrescenteset = $set * 1.05;
        //------------------------------
            $recebefx1out = $_POST['metames10'];
        $out = (double)str_replace(',', '.', $recebefx1out);
        $recebefx2faixaout = $_POST['tolmetames10'];
        $out2 = (double)str_replace(',', '.', $recebefx2faixaout);
        $recebefx2crescenteout = $out * 0.95;
        $recebefx2decrescenteout = $out * 1.05;

        //------------------------------

            $recebefx1nov = $_POST['metames11'];
        $nov = (double)str_replace(',', '.', $recebefx1nov);
        $recebefx2faixanov = $_POST['tolmetames11'];
        $nov2 = (double)str_replace(',', '.', $recebefx2faixanov);
        $recebefx2crescentenov = $nov * 0.95;
        $recebefx2decrescentenov = $nov * 1.05;
        //------------------------------

            $recebefx1dez = $_POST['metames12'];
        $dez = (double)str_replace(',', '.', $recebefx1dez);
        $recebefx2faixadez = $_POST['tolmetames12'];
        $dez2 = (double)str_replace(',', '.', $recebefx2faixadez);
        $recebefx2crescentedez = $dez * 0.95;
        $recebefx2decrescentedez = $dez * 1.05;
        //------------------------------
        // dependendo da melhor trajetória irá salvar no banco o valor crescente, decrescente ou na faixa
          if($mtraj==1){
              $sql_code= "INSERT INTO metamensal(
            anob,id_inddep, cod_org, metames, toleranciameta,metamesfev, toleranciametafev,metamesmar, toleranciametamar,metamesabr, toleranciametaabr,metamesmai, toleranciametamai,metamesjun, toleranciametajun,metamesjul, toleranciametajul,metamesago, toleranciametaago,metamesset, toleranciametaset,metamesout, toleranciametaout,metamesnov, toleranciametanov,metamesdez, toleranciametadez)

            VALUES(
            '$_SESSION[anob]',
            '$resgate',
            '$resgateagain',
            '$valor',
            '$recebefx2crescente',
            '$fev',
            '$recebefx2crescentefev',
            '$mar',
            '$recebefx2crescentemar',
            '$abr',
            '$recebefx2crescenteabr',
            '$mai',
            '$recebefx2crescentemai',
            '$jun',
            '$recebefx2crescentejun',
            '$jul',
            '$recebefx2crescentejul',
            '$ago',
            '$recebefx2crescenteago',
            '$set',
            '$recebefx2crescenteset',
            '$out',
            '$recebefx2crescenteout',
            '$nov',
            '$recebefx2crescentenov',
            '$dez',
            '$recebefx2crescentedez'
            )";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);

          $correct = "Resultados cadastrado com sucesso.";
          $acc++;}else{
            if($mtraj==2){

                $sql_code= "INSERT INTO metamensal(
            anob,id_inddep, cod_org, metames, toleranciameta,metamesfev, toleranciametafev,metamesmar, toleranciametamar,metamesabr, toleranciametaabr,metamesmai, toleranciametamai,metamesjun, toleranciametajun,metamesjul, toleranciametajul,metamesago, toleranciametaago,metamesset, toleranciametaset,metamesout, toleranciametaout,metamesnov, toleranciametanov,metamesdez, toleranciametadez)

            VALUES(
            '$_SESSION[anob]',
            '$resgate',
            '$resgateagain',
            '$valor',
            '$valor2',
            '$fev',
            '$fev2',
            '$mar',
            '$mar2',
            '$abr',
            '$abr2',
            '$mai',
            '$mai2',
            '$jun',
            '$jun2',
            '$jul',
            '$jul2',
            '$ago',
            '$ago2',
            '$set',
            '$set2',
            '$out',
            '$out2',
            '$nov',
            '$nov2',
            '$dez',
            '$dez2'
            )";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);

          $correct = "Resultados cadastrado com sucesso.";

             $acc++;}else{

                $sql_code= "INSERT INTO metamensal(
            anob,id_inddep, cod_org, metames, toleranciameta,metamesfev, toleranciametafev,metamesmar, toleranciametamar,metamesabr, toleranciametaabr,metamesmai, toleranciametamai,metamesjun, toleranciametajun,metamesjul, toleranciametajul,metamesago, toleranciametaago,metamesset, toleranciametaset,metamesout, toleranciametaout,metamesnov, toleranciametanov,metamesdez, toleranciametadez)

            VALUES(
            '$_SESSION[anob]',
            '$resgate',
            '$resgateagain',
            '$valor',
            '$recebefx2decrescente',
            '$fev',
            '$recebefx2decrescentefev',
            '$mar',
            '$recebefx2decrescentemar',
            '$abr',
            '$recebefx2decrescenteabr',
            '$mai',
            '$recebefx2decrescentemai',
            '$jun',
            '$recebefx2decrescentejun',
            '$jul',
            '$recebefx2decrescentejul',
            '$ago',
            '$recebefx2decrescenteago',
            '$set',
            '$recebefx2decrescenteset',
            '$out',
            '$recebefx2decrescenteout',
            '$nov',
            '$recebefx2decrescentenov',
            '$dez',
            '$recebefx2decrescentedez')";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);

          $correct = "Resultados cadastrado com sucesso.";
           $acc++;

            }
          }

        }else{
          $correct = "Houve algum erro no cadastro";
          $acc++;
        }



}

?>
<script type="text/javascript">
  function holdMetaMensal(){
     var valor = $('#anobase').val();
   var recebeorgao = document.getElementById("descorgao").value;

  $.post('paginas/reqindorgao.php', {valorSelect: valor, recebeOrgao: recebeorgao}, function(data) {
    $('#descinddep').html('');


   
    $.each($.parseJSON(data), function(){
     var ks = <?php echo isset($_POST['descinddep']) ? $_POST['descinddep'] : 'this.id_inddep'; ?>;
     if (ks == this.id_inddep) {
     $('#descinddep').append('<option selected value="' + this.id_inddep + '">' + this.desc_inddep + '</option>');
        }else{
          $('#descinddep').append('<option value="' + this.id_inddep + '">' + this.desc_inddep + '</option>');
        }

   });
  });
  }

</script>
<!-- IMPORTA O JQUERY -->
  <script  src="https://code.jquery.com/jquery-3.1.1.min.js" 
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
   crossorigin="anonymous"></script>

<!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<p class=espaco></p>

<div class="body-wrap">
  <div class="container">
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?pagina=inicial">Home</a>
        </div>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cadastros <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?pagina=caddiretoria">Diretoria</a></li>
                <li><a href="?pagina=cadorgao">Orgão</a></li>
                 <li class="divider"></li>
                <li><a href="?pagina=indicadoresemp">Indicador Empresarial</a></li>
                <li><a href="?pagina=indicadoresdep">Indicador Departamental</a></li>
                <li><a href="?pagina=indicadororgao">Indicador por Orgão</a></li>
                 <li class="divider"></li>
                 <li><a href="?pagina=meta">Meta</a></li>
                <li><a href="?pagina=metasmensais">Metas Mensais</a></li>
              <!--  <li><a href="?pagina=efeito">Efeito</a></li> -->
                <li><a href="?pagina=causa">Causa</a></li>
                <li><a href="?pagina=planoacao">Plano de Ação</a></li>
                <li><a href="?pagina=etapa">Etapa</a></li>
                <li><a href="?pagina=resultadosmensais">Resultados Mensais</a></li>
                
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="?pagina=sair">Logout</a></li>
          </ul>

          <!-- Collect the nav links, forms, and other content for toggling -->
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Atualizações <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?pagina=attuserdep">Usuário Dependente</a></li>
                <li><a href="?pagina=attuser">Seu Usuário</a></li>
                <li class="divider"></li>
                <li><a href="?pagina=attdiretoria">Diretoria</a></li>
                <li><a href="?pagina=attorgao">Orgão</a></li>
                <li class="divider"></li>
                <li><a href="?pagina=attindempresarial">Indicador Empresarial</a></li>
                <li><a href="?pagina=attinddepartamental">Indicador Departamental</a></li>
               <!-- <li><a href="?pagina=attindorgao">Indicador por Orgão</a></li>
               <li class="divider"></li>
                <li><a href="?pagina=attplanoacao">Plano de Ação</a></li>
                <li><a href="?pagina=attmetasmensais">Metas Mensais</a></li>
                <li><a href="?pagina=attefeito">Efeito</a></li>
                <li><a href="?pagina=attetapa">Etapa</a></li>
                <li><a href="?pagina=attcausa">Causa</a></li>
                <li><a href="?pagina=attmeta">Meta</a></li> -->
              
               

               
               
              </ul>
            </li>
          </ul>

          <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Buscas <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?pagina=buscageralindicadororgao">Indicadores</a></li>
                <li><a href="?pagina=buscageralmetas">Metas</a></li>
                <li><a href="?pagina=buscageralresultmensal">Resultados Mensais</a></li>
                <li><a href="?pagina=priorizacaoimpacto">Priorização de Impacto</a></li>
                <li><a href="?pagina=buscaplanoacao">Plano de Ação</a></li>
    
              </ul>
            </li>
          </ul>

          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Funções <b class="caret"></b></a>
              <ul class="dropdown-menu">
               <!-- <li><a href="?pagina=importexecel">Importar tabela do excel</a></li> -->
                <li><a href="?pagina=importarexcelinddep">Importar Indicadores Departamentais</a></li>
                <li class="divider"></li>
                <li><a href="?pagina=cadadm">Cadastro de Usuários</a></li>
                <li><a href="?pagina=teste">Gerar Gráficos</a></li>
                <li><a href="?pagina=cadsenha">Cadastro de senhas ADM</a></li>
                <li><a href="?pagina=recuser">Recuperar/Modificar senha</a></li>
                <li><a href="?pagina=gerarpdf">Gerar Relatórios</a></li>
              </ul>
            </li>
          </ul>

          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultas <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?pagina=exibirorgao">Exibir Orgãos</a></li>
                <li><a href="?pagina=exibirdiretoria">Exibir Diretoria</a></li>
                <li class="divider"></li>
                <li><a href="?pagina=exibirindempresarial">Exibir Indicador Empresarial</a></li>
                <li><a href="?pagina=exibirindddep">Exibir Indicador Departamental</a></li>
                <li><a href="?pagina=exibirindorgao">Exibir Indicador por Orgão</a></li>
              </ul>
            </li>
          </ul>


        </div>


        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </div>
</div>

<center>
<div id="metasmensais" style="width: 400px;">
<h1>Cadastro de Metas Mensais</h1>

<form action="" method="POST">
 <?php 
    
   if($acc>0){
        echo $correct;
    }

    ?>

  <p class=espaco></p>

  <label for="anob"> Ano Base</label>
  <select name="anob" required id="anobase" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
  <?php 
   do{ 
  ?>
  <option <?php echo (isset($_POST['anob']) && $linhatabela6['anob'] == $_POST['anob']) ? "selected" : ''; ?>  value="<?php  echo $linhatabela6['anob']; ?>"> <?php echo $linhatabela6['anob'];?></option>

  <?php } while($linhatabela6 = $sql_query6->fetch_assoc());  ?>

  </select>
  <p class=espaco></p>

  <label for="descorgao"> Descrição do Orgão</label>
  <select name="descorgao" required id="descorgao" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
   <?php 
   do{ 
  ?>
  <option <?php echo (isset($_POST['descorgao']) && $linhatabela['cod_orgao'] == $_POST['descorgao']) ? "selected" : ''; ?> value="<?php  echo $linhatabela['cod_orgao']; ?>"> <?php echo $linhatabela['desc_orgao'] .':'.$linhatabela['cod_orgao'];?></option>
  <?php } while($linhatabela = $sql_query->fetch_assoc());  ?>
  </select>
  <p class=espaco></p>

  

 <label for="descinddep"> Indicador Departamental</label>
  <select name="descinddep"  id="descinddep" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
 
  </select>
  <p class=espaco></p>
  Escrever nos campos números juntos, colocar vírgula apenas para casa decimais
  Ex: 1000
  <br>
  Ex:1000,15
  </center>
  
  <div>
  <br>
  <table border=1 cellpadding=10 class="table">
 <tr class= titulo>
   <td>Meses:</td>
   <td>Jan</td> 
   <td>Fev</td> 
   <td>Mar</td> 
   <td>Abr</td> 
   <td>Mai</td> 
   <td>Jun</td> 
   <td>Jul</td>
   <td>Ago</td> 
   <td>Set</td> 
   <td>Out</td> 
   <td>Nov</td> 
   <td>Dez</td> 
 </tr> 

 <tr class= titulo>
   <td>Meta:</td>
   <td><input name="metames" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 300px"></td> 
   <td><input name="metames2" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
   <td><input name="metames3" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
   <td><input name="metames4" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
   <td><input name="metames5" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
   <td><input name="metames6" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
   <td> <input name="metames7" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
    <td><input name="metames8" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
   <td><input name="metames9" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
   <td><input name="metames10" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
    <td><input name="metames11" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
   <td><input name="metames12" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 

   <tr class= titulo>
   <td>Tolerancia:</td>
   <td><input name="tolmetames" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm" style="width: 100px"></td> 
   <td><input name="tolmetames2" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm2" style="width: 100px"></td> 
   <td><input name="tolmetames3" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm3" style="width: 100px"></td> 
   <td><input name="tolmetames4" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm4" style="width: 100px"></td> 
   <td><input name="tolmetames5" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm5" style="width: 100px"></td> 
   <td><input name="tolmetames6" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm6" style="width: 100px"></td> 
   <td><input name="tolmetames7" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm7" style="width: 100px"></td>
   <td><input name="tolmetames8" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm8" style="width: 100px"></td> 
   <td><input name="tolmetames9" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm9" style="width: 100px"></td> 
   <td><input name="tolmetames10" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm10" style="width: 100px"></td> 
   <td><input name="tolmetames11" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm11" style="width: 100px"></td> 
   <td><input name="tolmetames12" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm12" style="width: 100px"></td> 
 </tr> 


   
 </tr>   

 </tr>
</table>
</div>


  <input name="mj"  value="" type="numeric" id="mj" hidden="true" >
  <center>
    <input value="Cadastrar" name="confirmar" type="submit" class ="btn btn-success">
    </center>
</form>
</div></center>


<style type="text/css">
  

  body {
  font-family: 'PT Sans', sans-serif;
  font-size: 13px;
  font-weight: 400;
  color: #4f5d6e;
  position: relative;
  background: rgb(26, 49, 95);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(26, 49, 95, 1)), color-stop(10%, rgba(26, 49, 95, 1)), color-stop(24%, rgba(29, 108, 141, 1)), color-stop(37%, rgba(41, 136, 151, 1)), color-stop(77%, rgba(39, 45, 100, 1)), color-stop(90%, rgba(26, 49, 95, 1)), color-stop(100%, rgba(26, 49, 95, 1)));
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#1a315f', endColorstr='#1a315f', GradientType=0);
}

.body-wrap {
  min-height: 700px;
}

.body-wrap {
  position: relative;
  z-index: 0;
}

.body-wrap:before,
.body-wrap:after {
  content: '';
  position: absolute;font-family: 'PT Sans', sans-serif;
  font-size: 13px;
  font-weight: 400;
  color: #4f5d6e;
  position: relative;
  background: rgb(26, 49, 95);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(26, 49, 95, 1)), color-stop(10%, rgba(26, 49, 95, 1)), color-stop(24%, rgba(29, 108, 141, 1)), color-stop(37%, rgba(41, 136, 151, 1)), color-stop(77%, rgba(39, 45, 100, 1)), color-stop(90%, rgba(26, 49, 95, 1)), color-stop(100%, rgba(26, 49, 95, 1)));
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#1a315f', endColorstr='#1a315f', GradientType=0);
}

.body-wrap {
  min-height: 150px;
}

.body-wrap {
  position: relative;
  z-index: 0;
}

.body-wrap:before,
.body-wrap:after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  z-index: -1;
  height: 260px;
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(26, 49, 95, 1)), color-stop(100%, rgba(26, 49, 95, 0)));
  background: linear-gradient(to bottom, rgba(26, 49, 95, 1) 0%, rgba(26, 49, 95, 0) 100%);
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#1a315f', endColorstr='#001a315f', GradientType=0);
}

.body-wrap:after {
  top: auto;
  bottom: 0;
  background: linear-gradient(to bottom, rgba(26, 49, 95, 0) 0%, rgba(26, 49, 95, 1) 100%);
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#001a315f', endColorstr='#1a315f', GradientType=0);
}

nav {
  margin-top: 60px;
  box-shadow: 5px 4px 5px #000;
}
  top: 0;
  left: 0;
  right: 0;
  z-index: -1;
  height: 260px;
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(26, 49, 95, 1)), color-stop(100%, rgba(26, 49, 95, 0)));
  background: linear-gradient(to bottom, rgba(26, 49, 95, 1) 0%, rgba(26, 49, 95, 0) 100%);
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#1a315f', endColorstr='#001a315f', GradientType=0);
}

.body-wrap:after {
  top: auto;
  bottom: 0;
  background: linear-gradient(to bottom, rgba(26, 49, 95, 0) 0%, rgba(26, 49, 95, 1) 100%);
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#001a315f', endColorstr='#1a315f', GradientType=0);
}

nav {
  margin-top: 60px;
  box-shadow: 5px 4px 5px #000;
}

body{
  color: #FFFAFA;
}
</style>


                  <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   
<script type="text/javascript">
  $('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});
</script>

<script type="text/javascript">

//Utilizando ajax para exibir dados nos campos
$('#anobase').on('change', holdMetaMensal);
holdMetaMensal();

$('#descorgao').on('change', holdMetaMensal);
holdMetaMensal();


//Utilizando ajax para liberar os campos abaixo
$('#anobase').on('mouseout', function(){
 var valor = document.getElementById("descinddep").value;
    $.post('paginas/fxindorg.php', {valorSelect: valor}, function(data) {
              
        

         $.each($.parseJSON(data), function(){  
           
     var des =  document.getElementById("mj").value = this.melhor_traj;
     if(des== 2){

       $("#tlmm").removeAttr('readonly');
       $("#tlmm2").removeAttr('readonly');
       $("#tlmm3").removeAttr('readonly');
       $("#tlmm4").removeAttr('readonly');
       $("#tlmm5").removeAttr('readonly');
       $("#tlmm6").removeAttr('readonly');
       $("#tlmm7").removeAttr('readonly');
       $("#tlmm8").removeAttr('readonly');
       $("#tlmm9").removeAttr('readonly');
       $("#tlmm10").removeAttr('readonly');
       $("#tlmm11").removeAttr('readonly');
       $("#tlmm12").removeAttr('readonly');

     }

     if(des== 1){
      $("#tlmm").attr('readonly','readonly');
      $("#tlmm2").attr('readonly','readonly');
       $("#tlmm3").attr('readonly','readonly');
       $("#tlmm4").attr('readonly','readonly');
       $("#tlmm5").attr('readonly','readonly');
       $("#tlmm6").attr('readonly','readonly');
       $("#tlmm7").attr('readonly','readonly');
       $("#tlmm8").attr('readonly','readonly');
       $("#tlmm9").attr('readonly','readonly');
       $("#tlmm10").attr('readonly','readonly');
       $("#tlmm11").attr('readonly','readonly');
       $("#tlmm12").attr('readonly','readonly');
     }

     if(des== 3){
      $("#tlmm").attr('readonly','readonly');
       $("#tlmm2").attr('readonly','readonly');
       $("#tlmm3").attr('readonly','readonly');
       $("#tlmm4").attr('readonly','readonly');
       $("#tlmm5").attr('readonly','readonly');
       $("#tlmm6").attr('readonly','readonly');
       $("#tlmm7").attr('readonly','readonly');
       $("#tlmm8").attr('readonly','readonly');
       $("#tlmm9").attr('readonly','readonly');
       $("#tlmm10").attr('readonly','readonly');
       $("#tlmm11").attr('readonly','readonly');
       $("#tlmm12").attr('readonly','readonly');
     }


     });
   });
 });

$('#descinddep').on('click', function(){
 var valor = document.getElementById("descinddep").value;
    $.post('paginas/fxindorg.php', {valorSelect: valor}, function(data) {
              
        

         $.each($.parseJSON(data), function(){  
           
     var des =  document.getElementById("mj").value = this.melhor_traj;
     if(des== 2){

       $("#tlmm").removeAttr('readonly');
       $("#tlmm2").removeAttr('readonly');
       $("#tlmm3").removeAttr('readonly');
       $("#tlmm4").removeAttr('readonly');
       $("#tlmm5").removeAttr('readonly');
       $("#tlmm6").removeAttr('readonly');
       $("#tlmm7").removeAttr('readonly');
       $("#tlmm8").removeAttr('readonly');
       $("#tlmm9").removeAttr('readonly');
       $("#tlmm10").removeAttr('readonly');
       $("#tlmm11").removeAttr('readonly');
       $("#tlmm12").removeAttr('readonly');
     }

     if(des== 1){
      $("#tlmm").attr('readonly','readonly');
      $("#tlmm2").attr('readonly','readonly');
       $("#tlmm3").attr('readonly','readonly');
       $("#tlmm4").attr('readonly','readonly');
       $("#tlmm5").attr('readonly','readonly');
       $("#tlmm6").attr('readonly','readonly');
       $("#tlmm7").attr('readonly','readonly');
       $("#tlmm8").attr('readonly','readonly');
       $("#tlmm9").attr('readonly','readonly');
       $("#tlmm10").attr('readonly','readonly');
       $("#tlmm11").attr('readonly','readonly');
       $("#tlmm12").attr('readonly','readonly');
     }

     if(des== 3){
      $("#tlmm").attr('readonly','readonly');
      $("#tlmm2").attr('readonly','readonly');
       $("#tlmm3").attr('readonly','readonly');
       $("#tlmm4").attr('readonly','readonly');
       $("#tlmm5").attr('readonly','readonly');
       $("#tlmm6").attr('readonly','readonly');
       $("#tlmm7").attr('readonly','readonly');
       $("#tlmm8").attr('readonly','readonly');
       $("#tlmm9").attr('readonly','readonly');
       $("#tlmm10").attr('readonly','readonly');
       $("#tlmm11").attr('readonly','readonly');
       $("#tlmm12").attr('readonly','readonly');
     }


     });
   });
 });

$('#descinddep').on('mouseout', function(){
 var valor = document.getElementById("descinddep").value;
    $.post('paginas/fxindorg.php', {valorSelect: valor}, function(data) {
              
        

         $.each($.parseJSON(data), function(){  
           
     var des =  document.getElementById("mj").value = this.melhor_traj;
     if(des== 2){

       $("#tlmm").removeAttr('readonly');
       $("#tlmm2").removeAttr('readonly');
       $("#tlmm3").removeAttr('readonly');
       $("#tlmm4").removeAttr('readonly');
       $("#tlmm5").removeAttr('readonly');
       $("#tlmm6").removeAttr('readonly');
       $("#tlmm7").removeAttr('readonly');
       $("#tlmm8").removeAttr('readonly');
       $("#tlmm9").removeAttr('readonly');
       $("#tlmm10").removeAttr('readonly');
       $("#tlmm11").removeAttr('readonly');
       $("#tlmm12").removeAttr('readonly');
     }

     if(des== 1){
      $("#tlmm").attr('readonly','readonly');
      $("#tlmm2").attr('readonly','readonly');
       $("#tlmm3").attr('readonly','readonly');
       $("#tlmm4").attr('readonly','readonly');
       $("#tlmm5").attr('readonly','readonly');
       $("#tlmm6").attr('readonly','readonly');
       $("#tlmm7").attr('readonly','readonly');
       $("#tlmm8").attr('readonly','readonly');
       $("#tlmm9").attr('readonly','readonly');
       $("#tlmm10").attr('readonly','readonly');
       $("#tlmm11").attr('readonly','readonly');
       $("#tlmm12").attr('readonly','readonly');
     }

     if(des== 3){
      $("#tlmm").attr('readonly','readonly');
      $("#tlmm2").attr('readonly','readonly');
       $("#tlmm3").attr('readonly','readonly');
       $("#tlmm4").attr('readonly','readonly');
       $("#tlmm5").attr('readonly','readonly');
       $("#tlmm6").attr('readonly','readonly');
       $("#tlmm7").attr('readonly','readonly');
       $("#tlmm8").attr('readonly','readonly');
       $("#tlmm9").attr('readonly','readonly');
       $("#tlmm10").attr('readonly','readonly');
       $("#tlmm11").attr('readonly','readonly');
       $("#tlmm12").attr('readonly','readonly');
     }


     });
   });
 });






</script>


