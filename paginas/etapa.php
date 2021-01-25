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
        $org = $linhatabela['cod_orgao'];
        }else{
          $sql_code4 = "SELECT * FROM orgaos WHERE id_orgao = '$orgao'";
        $sql_query = $mysqli->query($sql_code4) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        $org = $linhatabela['cod_orgao'];
        }
           //  realiza consulta de tudo do indicador departamental agrupando pelo ano
         $sql_code5 = "SELECT anob FROM indicadordepartamental GROUP BY 1";
        $sql_query2 = $mysqli->query($sql_code5) or die($mysqli->error);
        $linhatabela2 = $sql_query2->fetch_assoc();
        // realiza consulta com a restrição pelo código de orgãos
        $sql_code6 = "SELECT id_planoacao,desc_acao FROM planoacao WHERE cod_org = '$org'";
        $sql_query3 = $mysqli->query($sql_code6) or die($mysqli->error);
        $linhatabela3 = $sql_query3->fetch_assoc();
        // realiza consulta com a restrições de atuação e código de orgão
         $sql_code7 = "SELECT id_causa,desc_causa FROM causa WHERE atuar = 1 AND cod_org = '$org' ";
        $sql_query4 = $mysqli->query($sql_code7) or die($mysqli->error);
        $linhatabela4 = $sql_query4->fetch_assoc();

 //caso aperte no botão com o nome confirmar, executará o código abaixo
        if(isset($_POST['confirmar'])){
      //armazenará os valores dos campos nas respectivas variáveis  
      $codorg = $_POST['descorgao'];
      $iddep = $_POST['descinddep'];
      
      $codacao = $_POST['codacao'];
      $datainicial = $_POST['dtip']; 
      $dataterminal = $_POST['dttp'];




        // consulta o banco com a restrição de código de orgão
       $sql_code2="SELECT cod_orgao FROM orgaos WHERE cod_orgao = '$codorg'";
       $show = $mysqli->query($sql_code2) or die($mysqli->error);
       $linhas = $show->fetch_assoc();
        // salvando em uma varíavel em espécifico o resultado da consulta
       $resgateagain = $linhas['cod_orgao'];

       // consulta o banco com a restrição de id indicador departamental
       $sql_code3="SELECT id_inddep FROM indicadordepartamental WHERE id_inddep = '$iddep'";
       $show3 = $mysqli->query($sql_code3) or die($mysqli->error);
       $linha = $show3->fetch_assoc();
       // salvando em uma varíavel em específico o resultado da consulta
       $resgate = $linha['id_inddep'];  

        // consulta o banco com a restrição do id da causa
       /*$sql_code8="SELECT id_causa FROM causa WHERE id_causa = '$codcausa'";
       $show4 = $mysqli->query($sql_code8) or die($mysqli->error);
       $linhas2 = $show4->fetch_assoc();
      // salvando o resultado da consulta na variável abaixo
       $resgateagain4 = $linhas2['id_causa'];*/
      // consulta o banco com a restrição do id da ação
       $sql_code9="SELECT id_planoacao,date_iniciop,date_terminop FROM planoacao WHERE id_planoacao = '$codacao'";
       $show5 = $mysqli->query($sql_code9) or die($mysqli->error);
       $linhas3 = $show5->fetch_assoc();
       //salvando os dados da consulta nas variáveis abaixo
       $resgateagain5 = $linhas3['id_planoacao'];
       $regatedatainicial = $linhas3['date_iniciop'];
       $regatedatatermino = $linhas3['date_terminop'];
       //foreach para pegar os valores
    foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);

              // verificar validações para iniciar o código abaixo, inserindo os dados na tabela etapa
            if( $resgateagain == $codorg  && $resgate == $iddep  && $resgateagain5 == $codacao && $datainicial >= $regatedatainicial && $dataterminal <= $regatedatatermino){
              //VALIDAÇÃO AQUI 
              $sql_code= "INSERT INTO etapa(
            cod_org, id_inddep, id_cod_acao, anob, desc_etapa, date_iniciop, date_terminop,responsavel,status,sequencia)

            VALUES(
            '$resgateagain',
            '$resgate',
            '$resgateagain5',
            '$_SESSION[anob]',
            '$_SESSION[descetapa]',
            '$_SESSION[dtip]',
            '$_SESSION[dttp]',
            '$_SESSION[response]',
            '4', 
            '$_SESSION[valor]')";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);

          $correct = "Etapa cadastrada com sucesso.";
          $acc++;
        }else{
          $correct = "Houve algum erro no cadastro";
          $acc++;
        }




}

  
  
 ?>

 <script type="text/javascript">
   function holdEtapa(){
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

   function holdAcao(){
    var valor = $('#anobase').val();
   // se ligar aqui
   var recebeorgao = document.getElementById("descorgao").value;

  $.post('paginas/reqcodacao.php', {valorSelect: valor, recebeOrgao: recebeorgao}, function(data) {
    $('#codacao').html('');


   
    $.each($.parseJSON(data), function(){
     var ks = <?php echo isset($_POST['codacao']) ? $_POST['codacao'] : 'this.id_planoacao'; ?>;
     if (ks == this.id_planoacao) {
     $('#codacao').append('<option selected value="' + this.id_planoacao + '">' + this.desc_acao + '</option>');
        }else{
          $('#codacao').append('<option value="' + this.id_planoacao + '">' + this.desc_acao + '</option>');
        }


   });
  });
   }
    
  //function here




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
<div id="etapa" style="width: 400px;">
<h1>Cadastro de Etapa</h1>

<form action="" method="POST">
 <?php 
    
   if($acc>0){
        echo $correct;
    }

    ?>

    <label for="anob"> Ano Base</label>
  <select name="anob" required id="anobase" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
  <?php 
   do{ 
  ?>
 <option <?php echo (isset($_POST['anob']) && $linhatabela2['anob'] == $_POST['anob']) ? "selected" : ''; ?>  value="<?php  echo $linhatabela2['anob']; ?>"> <?php echo $linhatabela2['anob'];?></option>

  <?php } while($linhatabela2 = $sql_query2->fetch_assoc());  ?>
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

  <label for="codacao"> Ação</label>
  <select name="codacao" id="codacao" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
 
  </select>
  <label>Data inicial:<label id="datainicial"></label></label> &nbsp;&nbsp;&nbsp; <label>Data terminal:<label id="dataterminal"></label></label>
  <p class=espaco></p>
  
  <label for="descetapa">Descrição da Etapa</label>
  <input name="descetapa" required id="descetapa" value="" type="text" class="form form-control" style="text-align: center;">
  <p class=espaco></p>

  <label for="dtip">Data ínicio Previsto:</label>
    <input name="dtip" value="" required type="date" class="form form-control" style="text-align: center;"> 
    <p class=espaco></p>

    <label for="dttp">Data Término Previsto:</label>
    <input name="dttp" value="" required type="date" class="form form-control" style="text-align: center;">
    <p class=espaco></p>


     <label for="response">Responsável</label>
  <input name="response" required value="" type="text" class="form form-control" style="text-align: center;">
  <p class=espaco></p>

  <label for="valor">Número da Sequência</label>
  <input name="valor" required value="" type="text" id="valor" class="form form-control" style="text-align: center;">
  <p class=espaco></p>
   <label>A sequencia anterior desta causa:<label id="seqanterior"></label></label>
 <p class=espaco></p>

 <p class=espaco></p>
  
<table border=1 cellpadding=10 class="table" style="margin-top: 50px">
<!-- criação de uma tabela -->
 <tr class= titulo>
   <td>descrição causa</td>
</tr>  

<tbody id='resultado_busca'>
   
 </tbody>


<!-- <tbody id='resultado_busca2'>
   
 </tbody> -->



  </table> 
 <!-- <input value="Cadastrar Etapa" name="cadastrar" type="submit" class ="btn btn-success"> -->
  

   <!-- <label for="codcausa">Causa</label>
  <select name="codcausa" required id="codcausa" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
 
  </select> -->
  <p class=espaco></p>
 
    <input value="Cadastrar" name="confirmar" id="confirmar" type="submit" class ="btn btn-success">
    
</form>


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
//ajax para exibição e inserção de valor automático no campo "número da sequencia" 
$('#anobase').on('change', holdEtapa);
holdEtapa();

$('#descorgao').on('change', holdEtapa);
holdEtapa();

$('#descorgao').on('change', holdAcao);
   holdAcao();

$('#descorgao').on('change', function(){
    var valor = $('#anobase').val();
   var recebeorgao = document.getElementById("descorgao").value;
   var recebeinddep = document.getElementById("descinddep").value;


  $.post('paginas/reqcodcausa.php', {valorSelect: valor, recebeOrgao: recebeorgao, recebeInddep: recebeinddep}, function(data) {
    $('#codcausa').html('');
      var html = '';

      
    $.each($.parseJSON(data), function(){
     html += '<tr>';
      html += '<td>' + this.desc_causa + '</td><td><input type="checkbox" value="' + this.id_causa + '"  >' + "" + '</td>';
      html += '</tr>';
     //$('#codcausa').append('<option value="' + this.id_causa + '">' + this.desc_causa + '</option>');

   });
    $('#resultado_busca').html(html);
  });
});

$('#descinddep').on('change', function(){
   var valor = $('#anobase').val();
   var recebeorgao = document.getElementById("descorgao").value;
   var recebeinddep = document.getElementById("descinddep").value;


  $.post('paginas/reqcodcausa.php', {valorSelect: valor, recebeOrgao: recebeorgao, recebeInddep: recebeinddep}, function(data) {
    $('#codcausa').html('');
      var html = '';

      
    $.each($.parseJSON(data), function(){
     html += '<tr>';
      html += '<td>' + this.desc_causa + '</td><td><input type="checkbox" value="' + this.id_causa + '"  >' + "" + '</td>';
      html += '</tr>';
    // $('#codcausa').append('<option value="' + this.id_causa + '">' + this.desc_causa + '</option>');

   });
    $('#resultado_busca').html(html);
  });
});

$('#descetapa').on('focus', function(){
     var valor = $('#anobase').val();
   var recebeorgao = document.getElementById("descorgao").value;
   var recebeinddep = document.getElementById("descinddep").value;


  $.post('paginas/reqcodcausa.php', {valorSelect: valor, recebeOrgao: recebeorgao, recebeInddep: recebeinddep}, function(data) {
    $('#codcausa').html('');
      var html = '';

      
    $.each($.parseJSON(data), function(){
     html += '<tr>';
      html += '<td>' + this.desc_causa + '</td><td><input type="checkbox" value="' + this.id_causa + '"  >' + "" + '</td>';
      html += '</tr>';
    // $('#codcausa').append('<option value="' + this.id_causa + '">' + this.desc_causa + '</option>');

   });
    $('#resultado_busca').html(html);
  });
});


$('#valor').on('click', function(){
  var valor = document.getElementById("codacao").value;

  $.post('paginas/reqnumerosequencia.php', {valorSelect: valor}, function(data) {
    $('#valor').html('');


   
    $.each($.parseJSON(data), function(){
      console.log(data);
     document.getElementById("valor").value = this.sequencia + ".";

   });
  });
});

$('#codacao').on('mouseout', function(){
  var valor = document.getElementById("codacao").value;
  var orgao = document.getElementById("descorgao").value;

  $.post('paginas/reqdataacao.php', {valorSelect: valor, orgaoSelect: orgao}, function(data) {
    $('#datainicial').html('');
    $('#dataterminal').html('');
   


   
    $.each($.parseJSON(data), function(){
     
      $('#datainicial').append('<label>' + this.date_iniciop + '</label>');
      $('#dataterminal').append('<label>' + this.date_terminop + '</label>');
     



   });
  });
});

$('#descetapa').on('focus', function(){
  var valor = document.getElementById("codacao").value;
  var orgao = document.getElementById("descorgao").value;

  $.post('paginas/reqdataacao.php', {valorSelect: valor, orgaoSelect: orgao}, function(data) {
    $('#datainicial').html('');
    $('#dataterminal').html('');


   
    $.each($.parseJSON(data), function(){
     
      $('#datainicial').append('<label>' + this.date_iniciop + '</label>');
      $('#dataterminal').append('<label>' + this.date_terminop + '</label>');


   });
  });
});

$('#descorgao').on('mouseout', function(){
  var valor = document.getElementById("codacao").value;
  var orgao = document.getElementById("descorgao").value;

  $.post('paginas/reqdataacao.php', {valorSelect: valor, orgaoSelect: orgao}, function(data) {
    $('#datainicial').html('');
    $('#dataterminal').html('');
  


   
    $.each($.parseJSON(data), function(){
      
      $('#datainicial').append('<label>' + this.date_iniciop + '</label>');
      $('#dataterminal').append('<label>' + this.date_terminop + '</label>');



   });
  });
});

$('#codacao').on('mouseout', function(){
  var valor = document.getElementById("codacao").value;
  var orgao = document.getElementById("descorgao").value;

  $.post('paginas/reqetapasequencia.php', {valorSelect: valor, orgaoSelect: orgao}, function(data) {
    $('#seqanterior').html('');

    $.each($.parseJSON(data), function(){
      var rec = data;
      if(rec == null){
     $('#seqanterior').append('<label>' + "Está vazio" + '</label>');
    }else{
      $('#seqanterior').append('<label>' + this.sequencia + '</label>');
    }
    

   });
  });
});


$('#confirmar').on('click', function(){
      var tags = document.getElementsByTagName("tr");
      var id = [];
    for (var i = 1; i < tags.length; i++) {
        if((tags[i].getElementsByTagName("input")[tags[i].getElementsByTagName("input").length-1].checked)){
            id.push(tags[i].getElementsByTagName("input")[tags[i].getElementsByTagName("input").length-1].value);  
            var check = tags[i].getElementsByTagName("input")[tags[i].getElementsByTagName("input").length-1].checked;
            var descetapa = document.getElementById("descetapa").value;
               }     
   

                      
    } 

      //console.log(id);

          $.post('paginas/cadetapacausa.php', {valorId: id , valorChecked: check, valorDesc: descetapa },  function(data){
                        
                      console.log(data);
                      
                    });
              }); 


</script>