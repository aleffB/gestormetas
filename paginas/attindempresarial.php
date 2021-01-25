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
   $recmetafx1 = $_POST['metafx1'];
   $recmetafx2 = $_POST['metafx2'];
   $buscadorindempresarial = $_POST['buscaindempresarial'];
   $recebeceidempresarial = $_POST['idempre'];

        $sql_code10 = "SELECT meta_fx1, meta_fx2 FROM indicadores where id_indicador = 'recebeceidempresarial' ";
        $sql_query10 = $mysqli->query($sql_code10) or die($mysqli->error);
        $linhatabela10 = $sql_query10->fetch_assoc();
        $recfx1 = $linhatabela10['meta_fx1'];
        $recfx2 = $linhatabela10['meta_fx2'];     

      foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);

          if($recmetafx1 != $recfx1 && $recmetafx2 != $recfx2){

          $recebefx1 = $_POST['metafx1'];
          $valor = (double)str_replace(',', '.', $recebefx1);
         $recebefx2faixa = $_POST['metafx2'];
         $valor2 = (double)str_replace(',', '.', $recebefx2faixa);
         $recebefx2crescente = $valor * 0.95;
         $recebefx2decrescente = $valor * 1.05;
         $recebevalorselect = $_POST['mtrajetoria'];

    if($recebevalorselect == 1){
   $sql_code= "UPDATE indicadores SET
            ano_base = '$recanob',
            desc_indicador = '$recdescind',
            melhor_traj = '$recmtrajetoria',
            acumulativo = '$recacumulativ', 
            und_medida = '$recundmedida',
            obs = '$recobs',
            meta_fx1 = '$valor',
            meta_fx2 = '$recebefx2crescente'
            WHERE id_indicador = '$recebeceidempresarial' ";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);
         // $correct = "Usuario Alterado com sucesso";
           header('Location: index.php?pagina=attindempresarial');
        }else{
          if($recebevalorselect == 2){
            $sql_code= "UPDATE indicadores SET
            ano_base = '$recanob',
            desc_indicador = '$recdescind',
            melhor_traj = '$recmtrajetoria',
            acumulativo = '$recacumulativ', 
            und_medida = '$recundmedida',
            obs = '$recobs',
            meta_fx1 = '$valor',
            meta_fx2 = '$valor2'
            WHERE id_indicador = '$recebeceidempresarial' ";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);
         // $correct = "Usuario Alterado com sucesso";
           header('Location: index.php?pagina=attindempresarial');

          }else{
            if($recebevalorselect == 3){  
           $sql_code= "UPDATE indicadores SET
            ano_base = '$recanob',
            desc_indicador = '$recdescind',
            melhor_traj = '$recmtrajetoria',
            acumulativo = '$recacumulativ', 
            und_medida = '$recundmedida',
            obs = '$recobs',
            meta_fx1 = '$valor',
            meta_fx2 = '$recebefx2decrescente'
            WHERE id_indicador = '$recebeceidempresarial' ";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);
         // $correct = "Usuario Alterado com sucesso";
           header('Location: index.php?pagina=attindempresarial');



                }
          }
       
        }



}else{


 $recebevalorselect = $_POST['mtrajetoria'];

    if($recebevalorselect == 1){
  $sql_code= "UPDATE indicadores SET
            ano_base = '$recanob',
            desc_indicador = '$recdescind',
            melhor_traj = '$recmtrajetoria',
            acumulativo = '$recacumulativ', 
            und_medida = '$recundmedida',
            obs = '$recobs',
            meta_fx1 = '$valor',
            meta_fx2 = '$valor2'
            WHERE id_indicador = '$recebeceidempresarial' ";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);
         // $correct = "Usuario Alterado com sucesso";
           header('Location: index.php?pagina=attindempresarial');
        }else{
          if($recebevalorselect == 2){
           $sql_code= "UPDATE indicadores SET
            ano_base = '$recanob',
            desc_indicador = '$recdescind',
            melhor_traj = '$recmtrajetoria',
            acumulativo = '$recacumulativ', 
            und_medida = '$recundmedida',
            obs = '$recobs',
            meta_fx1 = '$valor',
            meta_fx2 = '$valor2'
            WHERE id_indicador = '$recebeceidempresarial' ";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);
         // $correct = "Usuario Alterado com sucesso";
           header('Location: index.php?pagina=attindempresarial');


          }else{
            if($recebevalorselect == 3){  
          $sql_code= "UPDATE indicadores SET
            ano_base = '$recanob',
            desc_indicador = '$recdescind',
            melhor_traj = '$recmtrajetoria',
            acumulativo = '$recacumulativ', 
            und_medida = '$recundmedida',
            obs = '$recobs',
            meta_fx1 = '$valor',
            meta_fx2 = '$valor2'
            WHERE id_indicador = '$recebeceidempresarial' ";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);
         // $correct = "Usuario Alterado com sucesso";
           header('Location: index.php?pagina=attindempresarial');



                }
          }
       
        }


}
          
  
break;

case 'delete':
  foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
    $sql_code = "DELETE FROM indicadores WHERE id_indicador = '$recebeceidempresarial'";
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
<h1>Atulização de indicador empresarial</h1>

<p class=espaco></p>
<form action="" method="POST">
  <?php 
    
   if($acc>0){
        echo $correct;
    }

    ?>
     <label for="buscaindempresarial"> Buscar ano dos indicadores</label>
  <select name="buscaindempresarial" required id="buscaindempresarial" class="form form-control" style="text-align: center;">
   <option value="">Selecione</option>
   <?php 
   do{ 
  ?>
  <option value="<?php  echo $linhatabela2['ano_base']; ?>"> <?php echo $linhatabela2['ano_base']?></option>
  <?php } while($linhatabela2 = $sql_query2->fetch_assoc());  ?>
  </select>
  <p class=espaco></p>

   <label for="indicadorbuscados"> Indicadores</label>
  <select name="indicadorbuscados"  class="form form-control" id="indicadorbuscados">
  <option value="">Selecione</option>
 
  </select>
  <p class=espaco></p>


  <label for="anob"> Ano base</label>
  <input name="anob"  value="" class="form form-control" style="text-align: center;" id="anob">
  <p class=espaco></p>

	<label for="descind"> Descrição do indicador empresarial</label>
	<input name="descind"  value="" class="form form-control" style="text-align: center;" id="descind">
	<p class=espaco></p>

  <label for="mtrajetoria"> Melhor trajetória</label>
  <select name="mtrajetoria"  class="form form-control" id="mtrajetoria" onmouseover = "dis();">
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


<label for="metafx1"> Meta FX1</label>
  <input name="metafx1"  value="" type="numeric" id="fx1" class="form form-control" style="text-align: center;" >
  <p class=espaco></p>
     
  <p class=espaco></p>
  <label for="metafx2"> Meta FX2</label>
  <input name="metafx2"  value="" type="numeric" id="fx2" readonly="true" class="form form-control" style="text-align: center;">
  <p class=espaco></p>
   <input name="idempre" required value="" type="numeric" id="idempre" hidden="true" >

    <input value="Atualizar" name="att" type="submit" class ="btn btn-success">
    <p class=espaco></p>
    <input value="Deletar" name="delete" type="submit" class ="btn btn-danger">

</form>
</div> </center>

<p class=espaco></p>

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

<script type="text/javascript">

 function dis(){
     if(document.getElementById("mtrajetoria").value == 1){
          document.getElementById("fx2").readOnly = true;
          
        }

      if(document.getElementById("mtrajetoria").value == 2){
          document.getElementById("fx2").readOnly = false;
         
        }

        if(document.getElementById("mtrajetoria").value == 3){
          document.getElementById("fx2").readOnly = true;
          
        }
  }
       
  function res(){
    var recebeselect = document.getElementById("mtrajetoria").value;
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


//------------------------------------------------------ 
$('#buscaindempresarial').on('change', function(){
   var valor = $(this).val();


  $.post('paginas/reqindicadorempresarial.php', {valorSelect: valor}, function(data) {
    $('#indicadorbuscados').html('');


   
    $.each($.parseJSON(data), function(){
     $('#indicadorbuscados').append('<option value="' + this.id_indicador + '">' + this.desc_indicador + '</option>');

   });
  });
});


//-----------------

$('#indicadorbuscados').on('mouseover', function(){
   var valor = document.getElementById("indicadorbuscados").value

  $.post('paginas/reqdadosindempresarial.php', {valorSelect: valor}, function(data) {
    $('#anob').html('');
    $('#descind').html('');
    $('#mtrajetoria').html('');
    $('#acumulativ').html('');
    $('#undmedida').html('');
    $('#obs').html('');
    $('#fx1').html('');
    $('#fx2').html('');


   
    $.each($.parseJSON(data), function(){
     document.getElementById("anob").value = this.ano_base;
      document.getElementById("descind").value = this.desc_indicador;
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


           var medida = this.und_medida;
         if (medida == 1) {
     $('#undmedida').append('<option value="' + this.und_medida + '">'  + 'R$</option>');
     $('#undmedida').append('<option value="2">'  + 'Unidade</option>');
     $('#undmedida').append('<option value="3">'  + '%</option>');
     $('#undmedida').append('<option value="4">'  + 'Mêses</option>');
        }else{
          if(medida == 2){
            $('#undmedida').append('<option value="' + this.und_medida + '">'  + 'Unidade</option>');
            $('#undmedida').append('<option value="1">'  + 'R$</option>');
            $('#undmedida').append('<option value="3">'  + '%</option>');
            $('#undmedida').append('<option value="4">'  + 'Mêses</option>');
          }else{
            if(medida == 3){
             $('#undmedida').append('<option value="' + this.und_medida + '">'  + '%</option>');           
             $('#undmedida').append('<option value="1">'  + 'R$</option>');
             $('#undmedida').append('<option value="2">'  + 'Unidade</option>');
             $('#undmedida').append('<option value="4">'  + 'Mêses</option>');
         }else{

             $('#undmedida').append('<option value="' + this.und_medida + '">'  + 'Mêses</option>');           
             $('#undmedida').append('<option value="1">'  + 'R$</option>');
             $('#undmedida').append('<option value="2">'  + 'Unidade</option>');
             $('#undmedida').append('<option value="3">'  + '%</option>');

                }
          }
        }

         document.getElementById("obs").value = this.obs;
         document.getElementById("fx1").value = this.meta_fx1;
         document.getElementById("fx2").value = this.meta_fx2;
         document.getElementById("idempre").value = this.id_indicador;


   });
  });
});

//-------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


$('#indicadorbuscados').on('change', function(){
   var valor = document.getElementById("indicadorbuscados").value

  $.post('paginas/reqdadosindempresarial.php', {valorSelect: valor}, function(data) {
    $('#anob').html('');
    $('#descind').html('');
    $('#mtrajetoria').html('');
    $('#acumulativ').html('');
    $('#undmedida').html('');
    $('#obs').html('');
    $('#fx1').html('');
    $('#fx2').html('');


   
    $.each($.parseJSON(data), function(){
     document.getElementById("anob").value = this.ano_base;
      document.getElementById("descind").value = this.desc_indicador;
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


           var medida = this.und_medida;
         if (medida == 1) {
     $('#undmedida').append('<option value="' + this.und_medida + '">'  + 'R$</option>');
     $('#undmedida').append('<option value="2">'  + 'Unidade</option>');
     $('#undmedida').append('<option value="3">'  + '%</option>');
     $('#undmedida').append('<option value="4">'  + 'Mêses</option>');
        }else{
          if(medida == 2){
            $('#undmedida').append('<option value="' + this.und_medida + '">'  + 'Unidade</option>');
            $('#undmedida').append('<option value="1">'  + 'R$</option>');
            $('#undmedida').append('<option value="3">'  + '%</option>');
            $('#undmedida').append('<option value="4">'  + 'Mêses</option>');
          }else{
            if(medida == 3){
             $('#undmedida').append('<option value="' + this.und_medida + '">'  + '%</option>');           
             $('#undmedida').append('<option value="1">'  + 'R$</option>');
             $('#undmedida').append('<option value="2">'  + 'Unidade</option>');
             $('#undmedida').append('<option value="4">'  + 'Mêses</option>');
         }else{

             $('#undmedida').append('<option value="' + this.und_medida + '">'  + 'Mêses</option>');           
             $('#undmedida').append('<option value="1">'  + 'R$</option>');
             $('#undmedida').append('<option value="2">'  + 'Unidade</option>');
             $('#undmedida').append('<option value="3">'  + '%</option>');

                }
          }
        }

         document.getElementById("obs").value = this.obs;
         document.getElementById("fx1").value = this.meta_fx1;
         document.getElementById("fx2").value = this.meta_fx2;
         document.getElementById("idempre").value = this.id_indicador;


   });
  });
});


</script>
