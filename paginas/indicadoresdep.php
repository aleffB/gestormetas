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
        //consulta no banco pegando o ano base jpa cadastrados nos indicadores empresarias
        $sql_code5 = "SELECT ano_base FROM indicadores GROUP BY 1";
        $sql_query3 = $mysqli->query($sql_code5) or die($mysqli->error);
        $linhatabela3 = $sql_query3->fetch_assoc();
        /*do{
          echo $linhatabela3['id_indicador'];
        }while($linhatabela3 = $sql_query3->fetch_assoc());*/
        
      
  
       //consulta no banco pegando a descrição, o id e o ano base ja cadastrados nos indicadores empresarias
        $sql_code3 = "SELECT desc_indicador, id_indicador, ano_base FROM indicadores";
        $sql_query = $mysqli->query($sql_code3) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        /*do{
         echo $linhatabela['id_indicador'];
        }while($linhatabela = $sql_query->fetch_assoc());*/
        



   
// caso clique em confirmar
   if(isset($_POST['confirmar'])){
    //foreach para pegar os valores
   foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
          //a varíavel abaixo receberá o valor do campo
       $resgate = $_POST["descindemp"];
        //iniciará uma consulta onde o valor do id do indicado empresarial será verificado
       $sql_code2="SELECT id_indicador FROM indicadores WHERE id_indicador = '$resgate'";
       $show = $mysqli->query($sql_code2) or die($mysqli->error);
       $linhas = $show->fetch_assoc();
       // salva em específico o id do indicador buscado
       $resgateagain = $linhas['id_indicador'];
 /////////////////////////////////////////////////////////////////////////////
      
        // acorrendo então a inserção dos dados
       $sql_code= "INSERT INTO indicadordepartamental(
            id_indempre,anob,desc_inddep,melhor_traj,acumulativo,und_med,formula,obs)

            VALUES(
            '$resgateagain',
            '$_SESSION[anob]',
            '$_SESSION[descinddep]',
            '$_SESSION[mtraj]',
            '$_SESSION[acum]',
            '$_SESSION[undm]',
            '$_SESSION[form]',
            '$_SESSION[obs]')";

        

        $confirma = $mysqli->query($sql_code) or die($mysqli->error);
        $correct = "Indicadores departamentais cadastrado com sucesso.";
          $acc++;
        }



       

    


?>

<script type="text/javascript">
//uma função ajax onde caso ocorra uma mudança no campo anobase, ele armazenará pegará o valor do campo e guardará na variável valor, mandando pelo post, para uma requisição, onde pegará a variável e vará uma consulta na outra pagina inserida no método $.post, onde retonará os dados e será transformado em JSON no método  $.each , sendo assim inserido nos campos desejados

function updateIndEmp() {
   var valor = $('#anobase').val();
   
   
  $.post('paginas/reqinddep.php', {valorSelect: valor}, function(data) {
    $('#descindemp').html('');
    
   
      
    $.each($.parseJSON(data), function(){
     var ks = <?php echo isset($_POST['descindemp']) ? $_POST['descindemp'] : 'this.id_indicador'; ?>;
     if (ks == this.id_indicador) {
      $('#descindemp').append('<option selected value="' + this.id_indicador + '">' + this.desc_indicador + '</option>');
    } else {
      $('#descindemp').append('<option value="' + this.id_indicador + '">' + this.desc_indicador + '</option>');
    }
   });
  });
};
</script>

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
<div id="indicadoresdep" style="width: 400px;">
<h1>Cadastro de Indicadores Departamentais</h1>

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
 <option <?php echo (isset($_POST['anob']) && $linhatabela3['ano_base'] == $_POST['anob']) ? "selected" : ''; ?> value="<?php  echo $linhatabela3['ano_base']; ?>"> <?php echo $linhatabela3['ano_base'];?></option>

  <?php } while($linhatabela3 = $sql_query3->fetch_assoc());?>
  </select>
  <p class=espaco></p>


  

  


  <label for="descinddep"> Descrição Indicador Departamental</label>
   <input name="descinddep"  value="" type="text" class="form form-control" style="text-align: center;">
   <p class=espaco></p>
   

  <label for="mtraj">Melhor Trajetória</label>
    <select name="mtraj" required class="form form-control" style="text-align: center;">
          <option value="">Selecione</option>
          <option value="1">Crescente</option>
          <option value="2">Na faixa</option>
          <option value="3">Decrescente</option>
    </select>
    <p class=espaco></p>

    <label for="acum">Acumulativo</label>
    <select name="acum" required class="form form-control" style="text-align: center;">
          <option value="">Selecione</option>
          <option value="1">Sim, acumulado no resultado</option>
          <option value="2">Sim, acumulado na fórmula</option>
          <option value="3">Nao, o resultado é a média até o mês</option>
    </select>
    <p class=espaco></p>
    
    <label for="undm">Unidade de Medida</label>
    <select name="undm" required class="form form-control" style="text-align: center;">
          <option value="">Selecione</option>
          <option value="1">R$</option>
          <option value="2">Unidade</option>
          <option value="3">%</option>
          <option value="4">Meses</option>
    </select>
    <p class=espaco></p>

    <label for="form">Fórmula</label>
   <input name="form" required value="" type="text" class="form form-control" style="text-align: center;">
   <p class=espaco></p>

   <label for="obs"> Observação</label>
   <input name="obs" value="" type="text" class="form form-control" style="text-align: center;">
   <p class=espaco></p>

    
    <label for="descindemp"> Indicador Empresarial</label>
  <select name="descindemp" id="descindemp" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
 
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
  $('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});
</script>



<script type="text/javascript">
$('#anobase').on('change', updateIndEmp);

updateIndEmp();
</script>