<?php
//pega os valores que foram salvos na sessão quando logados e guarda nas variavéis
$nomeuser= $_SESSION['nomeuser_adm'];
$loginadm= $_SESSION['login_adm'];
//um vetor para tranformar valores quando necessário
$nivel[1] = "Administrador";
$nivel[2] = "Dependente";

//condicional verificando se o nome de usuário e login está na sessão 
if(!isset($_SESSION['nomeuser_adm']) && !isset($_SESSION['login_adm'])){
	//caso não esteja ele redirecionado para page inicio
	header('Location: ?pagina=inicio');
	exit;
} 
//resgata o dado que está na sessão e guarda na variável valid
$valid = $_SESSION['validador'];
//variavel que será utilizada se for adm
$result = "Você possui todas as funcionalidades.";
if($valid==2){
	// a variavel será utilizada quando for dependete
 $result ="Algumas funcionalidades estão desabilitadas pois você é dependente.";
}
    //ACRESTAR FUNÇÕES
 if(isset($_POST['validar'])){



  }
?>
<!-- IMPORTA O JQUERY -->
  <script  src="https://code.jquery.com/jquery-3.1.1.min.js" 
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
   crossorigin="anonymous"></script>

<div id="inicial">
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
                <li class="divider"></li>
                <li><a href="?pagina=nivelservico">Nível de Serviço</a></li>
                <li><a href="?pagina=fornecedor">Fornecedor</a></li>
                
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
                <li><a href="?pagina=cadsenha">Cadastro de senhas ADM</a></li>
                <li><a href="?pagina=cadadm">Cadastro de Usuários</a></li>
                <li class="divider"></li>
                 <li><a href="?pagina=teste">Gerar Gráficos</a></li>
                <li><a href="?pagina=recuser">Recuperar/Modificar senha</a></li>
                <li><a href="?pagina=gerarpdf">Gerar Relatórios</a></li>
                <li><a href="?pagina=apuracaomensal">Apuração Mensal</a></li>
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
	<div id="inicial" style="width: 400px;" style="color">
	 <!-- EXIBE O NOME DO USUARIO QUE ESTÁ NA SESSÃO O LOGIN DELE, E ATRAVÉS DA VERIFICAÇÃO DIZ SE É ADM OU DEPENDENTE-->
	 <p>Bem Vindo <?php echo $nomeuser;?> <b> @<?php echo $loginadm;?></b>, Seu nível de acesso é: <?php echo $nivel[$valid];
	 // E APÓS A VERIFICAÇÃO DE ACESSO, EXIBE A RESULTADO, SE ELE TEM TODOS OS ACESSOS OU NÃO
	 ?> <br> <br> <?php echo $result;?> <br>  </p>

   <!--<form action="" method="POST">
  <input type="submit" name="validar" value="Validações" class ="btn btn-success"> 
  </form>
	 </div></center>
	 <p class=espaco></p> -->




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
  min-height: 500px;
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
</div>

<script type="text/javascript">
	$('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});
</script>

