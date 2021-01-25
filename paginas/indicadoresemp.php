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
  switch (get_post_action('confirmar','validar')) {
    //caso clique em confirmar
    case 'confirmar':
    //foreach para pegar os valores
      foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
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
        // e esta variável receberá o valor da melhor trajetória
        $recebevalorselect = $_POST['mtraj'];
            // fazer os ifs onde definirá qual valor será cadastro, decrescente, crescente ou na faixa
        if($recebevalorselect == 1){
        $sql_code= "INSERT INTO indicadores(
            ano_base,desc_indicador,melhor_traj,acumulativo,und_medida,obs,meta_fx1,meta_fx2)

            VALUES(
            '$_SESSION[anob]',
            '$_SESSION[descindic]',
            '$_SESSION[mtraj]',
            '$_SESSION[acum]',
            '$_SESSION[undm]',
            '$_SESSION[obs]',
            '$valor',
            '$recebefx2crescente')";

        $confirma = $mysqli->query($sql_code) or die($mysqli->error);
        $correct = "Indicadores empresariais cadastrado com sucesso.";
          $acc++;
        }else{
          if($recebevalorselect == 2){
            $sql_code= "INSERT INTO indicadores(
            ano_base,desc_indicador,melhor_traj,acumulativo,und_medida,obs,meta_fx1,meta_fx2)

            VALUES(
            '$_SESSION[anob]',
            '$_SESSION[descindic]',
            '$_SESSION[mtraj]',
            '$_SESSION[acum]',
            '$_SESSION[undm]',
            '$_SESSION[obs]',
            '$valor',
            '$valor2')";

        $confirma = $mysqli->query($sql_code) or die($mysqli->error);
        $correct = "Indicadores empresariais cadastrado com sucesso.";
          $acc++;
          }else{
            if($recebevalorselect == 3){
              $sql_code= "INSERT INTO indicadores(
            ano_base,desc_indicador,melhor_traj,acumulativo,und_medida,obs,meta_fx1,meta_fx2)

            VALUES(
            '$_SESSION[anob]',
            '$_SESSION[descindic]',
            '$_SESSION[mtraj]',
            '$_SESSION[acum]',
            '$_SESSION[undm]',
            '$_SESSION[obs]',
            '$valor',
            '$recebefx2decrescente')";

        $confirma = $mysqli->query($sql_code) or die($mysqli->error);
        $correct = "Indicadores empresariais cadastrado com sucesso.";
          $acc++;
            }
          }
        }
      break;

    

    
    default:
      # code...
      break;
  }
     
     ?>

<!-- IMPORTA O JQUERY -->
  <script  src="https://code.jquery.com/jquery-3.1.1.min.js" 
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
   crossorigin="anonymous"></script>


<!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<p class=espaco></p>
<script type="text/javascript">
// uma função onde dependendo da melhor trajetória, liberará os campos a ser utilizados
     function dis(){
     if(document.getElementById("mtraj").value == 1){
          document.getElementById("fx2").readOnly = true;
          
        }

      if(document.getElementById("mtraj").value == 2){
          document.getElementById("fx2").readOnly = false;
         
        }

        if(document.getElementById("mtraj").value == 3){
          document.getElementById("fx2").readOnly = true;
          
        }
  }
       
  function res(){
    // função para calcular os valores
    var recebeselect = document.getElementById("mtraj").value;
    var recebefx1 = document.getElementById("fx1").value;
    var calcres = recebefx1 * 0.95;
    var caldec = recebefx1 * 1.05;
    if(recebeselect == 1){
      var transform = calcres.toFixed(2);
      document.getElementById("fx2").value = transform;
    }else{
      if(recebeselect == 3){
        var transform = caldec.toFixed(2);
        document.getElementById("fx2").value = transform;
      }
    }
  }

</script>
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
<div id="indicadoresemp" style="width: 400px;">
<h1>Cadastro de Indicadores Empresariais</h1>
<p class=espaco></p>
<form action="" method="POST">
 <?php 
    
   if($acc>0){
        echo $correct;
    }

    ?>

  <p class=espaco></p>
  <label for="anob"> Ano Base</label>
  <input name="anob" required value='<?php echo (isset($_POST['anob']) ? $_POST['anob'] : '') ?>' type="numeric" placeholder="Ex:1996" pattern="[0-9]{4}" class="form form-control" style="text-align: center;">
  <p class=espaco></p>

  <label for="descindic"> Descrição de Indicador da Empresarial</label>
  <input name="descindic" value="" type="text" class="form form-control" style="text-align: center;">
  <p class=espaco></p>

  <label for="mtraj">Melhor Trajetória</label> 
    <select name="mtraj" required onchange="dis();" id="mtraj" class="form form-control"> 
          <option value="">Selecione</option>
          <option value="1">Crescente</option>
          <option value="2">Na faixa</option>
          <option value="3">Decrescente</option>
    </select>
    <p class=espaco></p>

    <label for="acum">Acumulativo</label>
    <select name="acum" required class="form form-control">
          <option value="">Selecione</option>
          <option value="1">Sim, acumulado no resultado</option>
          <option value="2">Sim, acumulado na fórmula</option>
          <option value="3">Nao, o resultado é a média até o mês</option>
    </select>
    <p class=espaco></p>
    
    <label for="undm">Unidade de Medida</label>
    <select name="undm" required class="form form-control">
          <option value="">Selecione</option>
          <option value="1">R$</option>
          <option value="2">Unidade</option>
          <option value="3">%</option>
          <option value="4">Meses</option>
    </select>
    <p class=espaco></p>

  <label for="obs"> Observação</label>
  <input name="obs"  value="" type="text" class="form form-control" style="text-align: center;">
  <p class=espaco></p>

  <label for="metafx1"> Meta FX1</label>
  <input name="metafx1" required value="" type="numeric" id="fx1" class="form form-control" style="text-align: center;" >
  <p class=espaco></p>
     
  <p class=espaco></p>
  <label for="metafx2"> Meta FX2</label>
  <input name="metafx2"  value="" type="numeric" id="fx2" readonly="true" class="form form-control" style="text-align: center;">
  <p class=espaco></p>

  
    <input value="Cadastrar" name="confirmar" type="submit" class ="btn btn-success">
</form>
</div></center>

<p class=espaco></p>
<center>
<div id="indicadoresemp" style="width: 400px;">
<p class=espaco></p>
 <input value="Verificar" name="validar" type="submit" onclick="res();"  hidden="true"> 
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
   




