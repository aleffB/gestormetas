<?php

	$acc = 0;

   if(!isset($_SESSION['nomeuser_adm']) && !isset($_SESSION['login_adm'])){
  header('Location: ?pagina=inicio');
  exit;
	}

$valid = $_SESSION['validador'];


if($valid==2){
  header('Location: ?pagina=inicial');
  exit;
}


if(isset($_POST['voltar'])){
 
 header('Location: index.php?pagina=inicio');
}




$sql_code5 = "SELECT ano_base FROM indicadores GROUP BY 1";
        $sql_query2 = $mysqli->query($sql_code5) or die($mysqli->error);
        $linhatabela2 = $sql_query2->fetch_assoc();       




    function get_post_action($name){
      $params = func_get_args();

      foreach ($params as $name) {
        if(isset($_POST[$name])){
          return $name;
        }
      }
    }

    switch (get_post_action('att','delete')) {

      case 'att':
   $recanob = $_POST['anob'];
   $recdescind = $_POST['descind'];
   $recmtrajetoria = $_POST['mtrajetoria'];
   $recacumulativ = $_POST['acumulativ'];
   $recundmedida = $_POST['undmedida'];
   $recobs = $_POST['obs'];
   $buscadorindempresarial = $_POST['buscainddepartamental'];
   $recebeceiddepartamental = $_POST['iddepartamental'];
   $recformula = $_POST['formula'];



      foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);


   
   $sql_code= "UPDATE indicadordepartamental SET
            anob = '$recanob',
            desc_inddep = '$recdescind',
            melhor_traj = '$recmtrajetoria',
            acumulativo = '$recacumulativ', 
            und_med = '$recundmedida',
            formula = '$recformula',
            obs = '$recobs'
            WHERE id_inddep = '$recebeceiddepartamental' ";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);
         // $correct = "Usuario Alterado com sucesso";
           header('Location: index.php?pagina=attinddepartamental');
        
  
break;

case 'delete':
  foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
    $sql_code = "DELETE FROM indicadordepartamental WHERE id_inddep = '$recebeceiddepartamental'";
      $deletarT = $mysqli->query($sql_code) or die($mysqli->error);
      echo "Deletado com sucesso";
  
break;

  
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
<div id="cadorgao" style="width: 400px;">
<h1>Atulização de indicador Departamental</h1>

<p class=espaco></p>
<form action="" method="POST">
  <?php 
    
   if($acc>0){
        echo $correct;
    }

    ?>
     <label for="buscainddepartamental"> Buscar ano dos indicadores Empresariais</label>
  <select name="buscainddepartamental" required id="buscainddepartamental" class="form form-control" style="text-align: center;">
   <option value="">Selecione</option>
   <?php 
   do{ 
  ?>
  <option value="<?php  echo $linhatabela2['ano_base']; ?>"> <?php echo $linhatabela2['ano_base']?></option>
  <?php } while($linhatabela2 = $sql_query2->fetch_assoc());  ?>
  </select>
  <p class=espaco></p>

   <label for="indicadorbuscados"> Indicadores Empresariais</label>
  <select name="indicadorbuscados"  class="form form-control" id="indicadorbuscados">
  <option value="">Selecione</option>
 
  </select>
  <p class=espaco></p>

  <label for="indicadoresdep"> Indicadores Departamentais</label>
  <select name="indicadoresdep"  class="form form-control" id="indicadoresdep">
  <option value="">Selecione</option>
 
  </select>
  <p class=espaco></p>


  <label for="anob"> Ano base do indicador departamental</label>
  <input name="anob"  value="" class="form form-control" style="text-align: center;" id="anob">
  <p class=espaco></p>

	<label for="descind"> Descrição do indicador departamental</label>
	<input name="descind"  value="" class="form form-control" style="text-align: center;" id="descind">
	<p class=espaco></p>

  <label for="mtrajetoria"> Melhor trajetória</label>
  <select name="mtrajetoria"  class="form form-control" id="mtrajetoria" >
  <option value="">Selecione</option>
 
  </select>
  <p class=espaco></p>

  <label for="acumulativ"> Acumulativo</label>
  <select name="acumulativ"  class="form form-control" id="acumulativ">
  <option value="">Selecione</option>
 
  </select>
  <p class=espaco></p>

  <label for="undmedida"> Unidade de medida</label>
  <select name="undmedida"  class="form form-control" id="undmedida">
  <option value="">Selecione</option>
 
  </select>
  <p class=espaco></p>

  <label for="obs"> Observação</label>
  <input name="obs"  value="" class="form form-control" style="text-align: center;" id="obs">
  <p class=espaco></p>

  <label for="formula"> Fórmula</label>
  <input name="formula"  value="" class="form form-control" style="text-align: center;" id="formula">
  <p class=espaco></p>

   <input name="iddepartamental" required value="" type="numeric" id="iddepartamental" hidden="true" >

    <input value="Atualizar" name="att" type="submit" class ="btn btn-success">
    <p class=espaco></p>
    <input value="Deletar" name="delete" type="submit" class ="btn btn-danger">

</form>
</div> </center>

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

 
$('#buscainddepartamental').on('change', function(){
   var valor = $(this).val();


  $.post('paginas/reqindicadorempresarial.php', {valorSelect: valor}, function(data) {
    $('#indicadorbuscados').html('');


   $('#indicadorbuscados').append('<option value="">'  + 'Selecione </option>');
    $.each($.parseJSON(data), function(){
     $('#indicadorbuscados').append('<option value="' + this.id_indicador + '">' + this.desc_indicador + '</option>');

   });
  });
});



$('#indicadorbuscados').on('change', function(){
   var valor = document.getElementById("indicadorbuscados").value;
   var ano = document.getElementById("buscainddepartamental").value;


  $.post('paginas/reqindicadordepartamental.php', {valorSelect: valor, anoSelect: ano}, function(data) {
    //apartir daqui
    $('#indicadoresdep').html('');
    

   $('#indicadoresdep').append('<option value="">'  + 'Selecione </option>');
    $.each($.parseJSON(data), function(){

     $('#indicadoresdep').append('<option value="' + this.id_inddep + '">' + this.desc_inddep + '</option>');
   });
  });
});

$('#indicadoresdep').on('change', function(){
   var valor = document.getElementById("indicadorbuscados").value;
   var ano = document.getElementById("buscainddepartamental").value;
   var inddep = $(this).val();



  $.post('paginas/reqgeralinddepatt.php', {valorSelect: valor, anoSelect: ano, inddepSelect: inddep}, function(data) {
    //apartir daqui
    $('#anob').html('');
    $('#descind').html('');
    $('#mtrajetoria').html('');
    $('#acumulativ').html('');
    $('#undmedida').html('');
    $('#obs').html('');
    $('#formula').html('');
    $('#iddepartamental').html('');
    

   
    $.each($.parseJSON(data), function(){

     document.getElementById("anob").value = this.anob;
      document.getElementById("descind").value = this.desc_inddep;
      var mjt = this.melhor_traj;
      if (mjt == 1) {
     $('#mtrajetoria').append('<option value="' + this.melhor_traj + '">'  + 'Crescente</option>');
     $('#mtrajetoria').append('<option value="2">'  + 'Na faixa</option>');
     $('#mtrajetoria').append('<option value="3">'  + 'Decrescente</option>');
        }else{
          if(mjt == 2){
            $('#mtrajetoria').append('<option value="' + this.melhor_traj + '">'  + 'Na faixa</option>');                      
            $('#mtrajetoria').append('<option value="1">'  + 'Crescente</option>');
           $('#mtrajetoria').append('<option value="3">'  + 'Decrescente</option>');
          }else{
             $('#mtrajetoria').append('<option value="' + this.melhor_traj + '">'  + 'Decrescente</option>');                                   
            $('#mtrajetoria').append('<option value="1">'  + 'Crescente</option>');
           $('#mtrajetoria').append('<option value="2">'  + 'Na faixa</option>');
          }
        }

          var acumuled = this.acumulativo;
         if (acumuled == 1) {
     $('#acumulativ').append('<option value="' + this.acumulativo + '">'  + 'Sim, acumulado no resultado</option>');
     $('#acumulativ').append('<option value="2">'  + 'Sim, acumulado na fórmula</option>');
     $('#acumulativ').append('<option value="3">'  + 'Não, o resultado é a média até o mês</option>');
        }else{
          if(acumuled == 2){
            $('#acumulativ').append('<option value="' + this.acumulativo + '">'  + 'Sim, acumulado na fórmula</option>');                      
            $('#acumulativ').append('<option value="1">'  + 'Sim, acumulado no resultado</option>');
           $('#acumulativ').append('<option value="3">'  + 'Não, o resultado é a média até o mês</option>');
          }else{
             $('#acumulativ').append('<option value="' + this.acumulativo + '">'  + 'Não, o resultado é a média até o mês</option>');                                   
            $('#acumulativ').append('<option value="1">'  + 'Sim, acumulado no resultado</option>');
           $('#acumulativ').append('<option value="2">'  + 'Sim, acumulado na fórmula</option>');
          }
        }


           var medida = this.und_med;
         if (medida == 1) {
     $('#undmedida').append('<option value="' + this.und_med + '">'  + 'R$</option>');
     $('#undmedida').append('<option value="2">'  + 'Unidade</option>');
     $('#undmedida').append('<option value="3">'  + '%</option>');
     $('#undmedida').append('<option value="4">'  + 'Mêses</option>');
        }else{
          if(medida == 2){
            $('#undmedida').append('<option value="' + this.und_med + '">'  + 'Unidade</option>');
            $('#undmedida').append('<option value="1">'  + 'R$</option>');
            $('#undmedida').append('<option value="3">'  + '%</option>');
            $('#undmedida').append('<option value="4">'  + 'Mêses</option>');
          }else{
            if(medida == 3){
             $('#undmedida').append('<option value="' + this.und_med + '">'  + '%</option>');           
             $('#undmedida').append('<option value="1">'  + 'R$</option>');
             $('#undmedida').append('<option value="2">'  + 'Unidade</option>');
             $('#undmedida').append('<option value="4">'  + 'Mêses</option>');
         }else{

             $('#undmedida').append('<option value="' + this.und_med + '">'  + 'Mêses</option>');           
             $('#undmedida').append('<option value="1">'  + 'R$</option>');
             $('#undmedida').append('<option value="2">'  + 'Unidade</option>');
             $('#undmedida').append('<option value="3">'  + '%</option>');

                }
          }
        }
      document.getElementById("obs").value = this.obs ;
      document.getElementById("formula").value = this.formula ;
      document.getElementById("iddepartamental").value = this.id_inddep;
   });
  });
});


</script>
