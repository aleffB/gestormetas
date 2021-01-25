<?php
//PARA EVITAR MENSAGENS POIS OS VALORES ESTÃO NULOS
 $acc = 0;
//variáveis que receberão os valores das sessions
 $valid = $_SESSION['validador'];

//verifica se o usuário é ADM ou DEPENDENTE
if($valid==2){
  //caso seja depentende retornará a page inicial
  header('Location: ?pagina=inicial');
  exit;
}

//verificar se não está na sessão, caso não esteja, é redirecionado para o inicio
 if(!isset($_SESSION['nomeuser_adm']) && !isset($_SESSION['login_adm'])){
  header('Location: ?pagina=inicio');
  exit;
  }

// caso aperte no botão com o name voltar, ele redirecionará para page inicio
  if(isset($_POST['voltar'])){
 
 header('Location: index.php?pagina=inicio');
}
        
        // iniciará fazendo uma consulta no baanco pegando os dados da tabela orgão e da tabela indicadordepartamental, onde o resultado da tabelaindicadordepartamental será agrupado em ano, para não repetir dados
        $sql_code4 = "SELECT cod_orgao, desc_orgao FROM orgaos";
        $sql_query = $mysqli->query($sql_code4) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();

         $sql_code5 = "SELECT anob FROM indicadordepartamental GROUP BY 1";
        $sql_query2 = $mysqli->query($sql_code5) or die($mysqli->error);
        $linhatabela2 = $sql_query2->fetch_assoc();

        

//função que servirá para fazer um switch, utilizando botões no mesmo formulário
       function get_post_action($name){
    $params = func_get_args();

    foreach ($params as $name) {
      if(isset($_POST[$name])){
        return $name;
      }
    }
  }
// iniciando switch com a função, utilizando o botão confirmar e validar
  switch (get_post_action('validar','confirmar')) {
    //caso clique em validar, executará o código abaixo
    case 'validar':
    //foreach para pegar os valores
      foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
  // a variável abaixo receberá o id do indicador departamental
     $res = $_POST["descinddep"];
      // e fará uma consulta usando a restrição na consulta comparando os ids
       $sql_cod="SELECT melhor_traj FROM indicadordepartamental WHERE id_inddep = '$res'";
       $sho = $mysqli->query($sql_cod) or die($mysqli->error);
       $ln = $sho->fetch_assoc();
        // salvando em específico na variável abaixo, a melhor trajetória
       $resg = $ln['melhor_traj'];
       // e a variável $rresg, receberá o mesmo valor
       $rresg = $resg;
      

  break;

//////////////////////////////////////////////////////////////////////////
    //caso clique em confirmar
    case 'confirmar':
    //foreach para pegar os valores
      foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);

  

      // a variável abaixo receberá o id do indicador departamental
       $res = $_POST["descinddep"];
      // e fará uma consulta usando a restrição na consulta comparando os ids
       $sql_cod="SELECT melhor_traj FROM indicadordepartamental WHERE id_inddep = '$res'";
       $sho = $mysqli->query($sql_cod) or die($mysqli->error);
       $ln = $sho->fetch_assoc();
      // salvando em específico na variável abaixo, a melhor trajetória
       $resg = $ln['melhor_traj'];
     // e a variável $rresg, receberá o mesmo valor  
       $rresg = $resg;

////////////////////////////////////////////////////////////

       //a várival abaixo armazenará o valor do campo
        $resgateorg = $_POST["descorgao"];
        // e executará uma consulta com o valor da varíavel acima como restrição
       $sql_code3="SELECT cod_orgao, ativo FROM orgaos WHERE cod_orgao = '$resgateorg'";
       $show2 = $mysqli->query($sql_code3) or die($mysqli->error);
       $lin = $show2->fetch_assoc();
        //salvando os valores abaixo em específico
       $resgateagain2 = $lin['cod_orgao'];
       $resgateagain9 = $lin['ativo'];
       //armazenará o valor do campo na variável
       $resgate = $_POST["descinddep"];
        //utilizando a varível acima na restrição da consulta
       $sql_code2="SELECT id_inddep FROM indicadordepartamental WHERE id_inddep = '$resgate'";
       $show = $mysqli->query($sql_code2) or die($mysqli->error);
       $linhas = $show->fetch_assoc();
       // salvando o id do indicador departamental na variável
       $resgateagain = $linhas['id_inddep'];

              //fazendo uma verificação onde os ids se correspondem e se está ativo, e só irá adiante se todas as condições forem atendidas
       if($resgateorg == $resgateagain2 && $resgate == $resgateagain && $resgateagain9==1){
        //a variável $recebefx1 receberá o valor de metafx1
        $recebefx1 = $_POST['metafx1'];
    // a varíavel $valor irá receber uma tranformação do valor, utilizando a função replace, onde caso o usuário digitar "," irá transformar para "." onde o banco aceita, definindo em sequencia, o que irá ser transformado, para o que irá ser tranformado, e qual valor será transformado, exemplo:(',', '.', $recebefx1);
        $valor = (double)str_replace(',', '.', $recebefx1);
      //repete a mesma coisa do caso acima
        $recebefx2faixa = $_POST['metafx2'];
        $valor2 = (double)str_replace(',', '.', $recebefx2faixa);
        //agora pegar os valores transformado e multiplicará dependendo do caso, se for crescente ou decrescente
        $recebefx2crescente = $valor * 0.95;
        $recebefx2decrescente = $valor * 1.05;

     // fazer os ifs onde definirá qual valor será cadastro, decrescente, crescente ou na faixa   
       if($rresg == 1){

          //BUSCA DE DADOS PARA INSERÇÃO
        $sql_code= "INSERT INTO indicadororgao(
            id_inddep,cod_orgao,anob,meta_fx1,meta_fx2,peso)

            VALUES(
            '$resgateagain',
            '$_SESSION[descorgao]',
            '$_SESSION[anob]',
            '$valor',
            '$recebefx2crescente',
            '$_SESSION[peso]')";
              

        $confirma = $mysqli->query($sql_code) or die($mysqli->error);
        $correct = "Indicadores por orgão cadastrado com sucesso.";
          $acc++;
        }else{
            if ($rresg == 2) {
              $sql_code= "INSERT INTO indicadororgao(
            id_inddep,cod_orgao,anob,meta_fx1,meta_fx2,peso)

            VALUES(
            '$resgateagain',
            '$_SESSION[descorgao]',
            '$_SESSION[anob]',
            '$valor',
            '$valor2',
            '$_SESSION[peso]')";


        $confirma = $mysqli->query($sql_code) or die($mysqli->error);
        $correct = "Indicadores por orgão cadastrado com sucesso.";
          $acc++;
            }else{
              if ($rresg == 3) {
                $sql_code= "INSERT INTO indicadororgao(
            id_inddep,cod_orgao,anob,meta_fx1,meta_fx2,peso)

            VALUES(
            '$resgateagain',
            '$_SESSION[descorgao]',
            '$_SESSION[anob]',
            '$valor',
            '$recebefx2decrescente',
            '$_SESSION[peso]')";


        $confirma = $mysqli->query($sql_code) or die($mysqli->error);
        $correct = "Indicadores por orgão cadastrado com sucesso.";
          $acc++;
              }else{
          $correct = "Não existe esse id.";
          $acc++;
        }
            }
           }
        }else{
          $correct = "Não pode cadatrar, está fazendo algo errado.";
          $acc++;
        }

    
    

  break;
  
  

  default:
      # code...
      break;
}
    
?>


<script type="text/javascript">
  
function holdIndOrgao(){
   var valor = $('#anobase').val();
      
  $.post('paginas/reqcadindorg.php', {valorSelect: valor}, function(data) {
    $('#descinddep').html('');
      
      console.log(valor);

   
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
<div id="indicadororgao" style="width: 400px;">
<h1>Cadastro de Indicadores por Orgão</h1>

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




  <label for="metafx1"> Meta FX1</label>
  <input name="metafx1" required value="" type="numeric" id="fx1" class="form form-control" style="text-align: center;">
  <p class=espaco></p>

  <label for="metafx2"> Meta FX2</label>
  <input name="metafx2" required value="" type="numeric" id="fx2" readonly="true" class="form form-control" style="text-align: center;" >
  <p class=espaco></p>

  <label for="peso"> Peso</label>
  <input name="peso" required value="" type="numeric" id="ps" class="form form-control" style="text-align: center;">
  <p class=espaco></p> 
   
 <input name="mj"  value="" type="numeric" id="mj" hidden="true">
 <p class=espaco></p>

    <input value="Cadastrar" name="confirmar" type="submit" class ="btn btn-success" id="confirmar">
    <p class=espaco></p> 
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
//uma função ajax onde caso ocorra uma mudança no campo anobase, ele armazenará pegará o valor do campo e guardará na variável valor, mandando pelo post, para uma requisição, onde pegará a variável e vará uma consulta na outra pagina inserida no método $.post, onde retonará os dados e será transformado em JSON no método  $.each , sendo assim inserido nos campos desejados
  $('#anobase').on('change', holdIndOrgao);

    holdIndOrgao();

// aqui o ajax liberará os campos, quando retirar o mouse de cima do campo ano base
$('#anobase').on('mouseout', function(){
 var valor = document.getElementById("descinddep").value;
    $.post('paginas/fxindorg.php', {valorSelect: valor}, function(data) {
              
        

         $.each($.parseJSON(data), function(){  
           
     var des =  document.getElementById("mj").value = this.melhor_traj;
     if(des== 2){

       $("#fx2").removeAttr('readonly');
     }

     if(des== 1){
      $("#fx2").attr('readonly','readonly');
     }

     if(des== 3){
      $("#fx2").attr('readonly','readonly');
     }


     });
   });
 });
// liberará os campos quando clicar no campo descinddep
$('#descinddep').on('click', function(){
 var valor = document.getElementById("descinddep").value;
    $.post('paginas/fxindorg.php', {valorSelect: valor}, function(data) {
              
        

         $.each($.parseJSON(data), function(){  
           
     var des =  document.getElementById("mj").value = this.melhor_traj;
     if(des== 2){

       $("#fx2").removeAttr('readonly');
     }

     if(des== 1){
      $("#fx2").attr('readonly','readonly');
     }

     if(des== 3){
      $("#fx2").attr('readonly','readonly');
     }


     });
   });
 });
//liberará os campos quando retirar o mouse de cima do campo descinddep
$('#descinddep').on('mouseout', function(){
 var valor = document.getElementById("descinddep").value;
    $.post('paginas/fxindorg.php', {valorSelect: valor}, function(data) {
              
        

         $.each($.parseJSON(data), function(){  
           
     var des =  document.getElementById("mj").value = this.melhor_traj;
     if(des== 2){

       $("#fx2").removeAttr('readonly');
     }

     if(des== 1){
      $("#fx2").attr('readonly','readonly');
     }

     if(des== 3){
      $("#fx2").attr('readonly','readonly');
     }


     });
   });
 });






</script>



