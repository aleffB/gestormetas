 <?php  
 //definindo valor de uma variável, para poder usa-la mais tade
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
         //  realiza consulta de tudo do indicador departamental agrupando pelo ano
         $sql_code5 = "SELECT anob FROM indicadordepartamental GROUP BY 1";
        $sql_query2 = $mysqli->query($sql_code5) or die($mysqli->error);
        $linhatabela2 = $sql_query2->fetch_assoc();

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
       $sql_code3="SELECT id_inddep FROM indicadordepartamental WHERE id_inddep = '$iddep'";
       $show3 = $mysqli->query($sql_code3) or die($mysqli->error);
       $linha = $show3->fetch_assoc();
       // salvando em específico o valor da consulta na varíavel abaixo
       $resgate = $linha['id_inddep'];
       //foreach para pegar os valores
    foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);

                //verificar se o id e o orgão são iguais, e iniciar a conversão
            if( $resgateagain == $codorg  && $resgate == $iddep ){
              $prioridade = $_POST['priorid'];
              $addprioridade = (double)str_replace(',', '.', $prioridade);
              //depois insere os valores no banco
              $sql_code= "INSERT INTO causa(
            cod_org, id_inddep, anob, desc_causa, influencia, prioridade, atuar)

            VALUES(
            '$resgateagain',
            '$resgate',
            '$_SESSION[anob]',
            '$_SESSION[desccausa]',
            '$_SESSION[influe]',
            '$addprioridade',
            '$_SESSION[actuar]')";

            

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);

          $correct = "Causa cadastrada com sucesso.";
          $acc++;
        }else{
          $correct = "Houve algum erro no cadastro";
          $acc++;
        }

}

 ?>
 <script type="text/javascript">
  function holdCausa() {
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
<div id="causa" style="width: 400px;">
<h1>Cadastro de Causa</h1>

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
 <option <?php echo (isset($_POST['anob']) && $linhatabela2['anob'] == $_POST['anob']) ? "selected" : ''; ?> value="<?php  echo $linhatabela2['anob']; ?>"> <?php echo $linhatabela2['anob'];?></option>

  <?php } while($linhatabela2 = $sql_query2->fetch_assoc());?>
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

   

  <label for="desccausa">Descrição da Causa</label>
  <input name="desccausa" required value="" type="text" class="form form-control" style="text-align: center;">
  <p class=espaco></p>

 <label for="influe">Influência</label>
  <select name="influe" required value="" type="numeric" class="form form-control" style="text-align: center;">
    <option value="">Selecione</option>
    <option value="1">Matéria-Prima</option>
    <option  value="2">Máquina</option>
    <option  value="3">Medida</option>
    <option  value="4">Meio Ambiente</option>
    <option  value="5">Mão de Obra</option>
    <option  value="6">Método</option>

  </select> 
  <p class=espaco></p>

  <label for="priorid">Prioridade</label>
  <select name="priorid" required value="" type="numeric" class="form form-control" style="text-align: center;" >
  <option value="">Selecione</option>
    <option value="1">1:Causa com pequeno impacto no problema e com pequena possibilidade de estar ocorrendo</option>
    <option value="3">3:Causa com impacto no problema e que possivelmente está ocorrendo</option>
    <option value="5">5:Causa de grande impacto no problema e com grande possibilidade de estar ocorrendo</option>

  </select>
  <p class=espaco></p>

  <label for="actuar">Atuar</label>
    <select name="actuar" required  class="form form-control" style="text-align: center;" >
          <option value="">Selecione</option>
          <option value="1">Sim</option>
          <option value="2">Não</option>
    </select>
    <p class=espaco></p>

 

    <input value="Cadastrar" name="confirmar" type="submit" class ="btn btn-success">
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
//ajax para exibição de valores
$('#anobase').on('change', holdCausa);
holdCausa();

$('#descorgao').on('change', holdCausa);
holdCausa();
</script>

<script type="text/javascript">
  $('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});
</script>
