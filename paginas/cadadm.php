<?php
 //definindo valor de uma variável, para poder usa-la mais tade
	$erro = 0;
	$acc = 0;
  $avisogeral=0;
  //defindo a senha de usuário que será utilizada para ser um usuário ADM
 // $senhav = "admin10";
  //verificar se não está na sessão, caso não esteja, é redirecionado para o inicio
  if(!isset($_SESSION['nomeuser_adm']) && !isset($_SESSION['login_adm'])){
  header('Location: ?pagina=inicio');
  exit;
} 
//select que servirá para inserir no html select, pegando os dados do banco e vinculando os dados
$sql_code4 = "SELECT id_orgao, desc_orgao FROM orgaos WHERE ativo = 1";
        $sql_query = $mysqli->query($sql_code4) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();

//caso aperte no botão com o name voltar, ele redirecionará para page inicio
if(isset($_POST['voltar'])){
 
 header('Location: index.php?pagina=inicio');
}

//variável que recebe o valor da sessão validador
$valid = $_SESSION['validador'];

//verificação do nível de acesso, caso seja dependente, é redirecional para a page inicial
if($valid==2){
  header('Location: ?pagina=inicial');
  exit;
}

//caso aperte no botão com o name confirmar, executará o código abaixo
	if(isset($_POST['confirmar'])){
 
     
          
      //foreach para pegar os valores
		foreach ($_POST as $chave=>$valor) 
        $_SESSION[$chave] = $mysqli->real_escape_string($valor);
    
         //as varíaveis receberão os repectivos dados que estão nos campos
         $senha = $_POST["senha"];
         $rsenha = $_POST["rsenha"];
         $recsenha = $_POST["recsenha"];
         $rrecsenha = $_POST["rrecsenha"];
         //restrições
         //FICAR DE OLHO NO RG PRA SABER A QTD DE CARACTERES
         $telefone = $_POST["telefone"];
         $nomeuser = $_POST["nomeuser"];
         $login = $_POST["login"];
         $confsenha = $_POST["senhav"];
         
         
         $sql_code4 = "SELECT senha FROM senha_adm WHERE senha = '$confsenha'";
        $sql_query = $mysqli->query($sql_code4) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        $senhav = $linhatabela['senha'];

         //variavel data, usando uma função para definir a forma da data, padrão americano pegando a data atual do sistema automáticamente
         $data = date("Y-m-d");
        
         
          //VALIDAÇÃO DO FORMULÁRIO ABAIXO

         /*DADOS NÃO UTILIZADOS---if(strstr($nome, '0')== TRUE||strstr($nome, '1')== TRUE||strstr($nome, '2')== TRUE||strstr($nome, '3')== TRUE||strstr($nome, '4')== TRUE||strstr($nome, '5')== TRUE||strstr($nome, '6')== TRUE||strstr($nome, '7')== TRUE||strstr($nome, '8')== TRUE||strstr($nome, '9')== TRUE){
                    echo "Você está utilizando caracteres invalidos no nome";
         }else{
          if(strlen($rg)<7 || strlen($rg)>8){
            echo("Você digitou uma quantidade inferior de caracteres requerido no rg");
          }else{*/
            if(strlen($nomeuser)<4 || strlen($nomeuser)>14){
              echo("Você digitou uma quantidade inferior de caracteres requerido no nome de usuario");
            }else{
              if(strlen($login)<4 || strlen($login)>14){
                echo("Você digitou uma quantidade inferior de caracteres requerido no login");
              }else{
                if(strlen($recsenha)<6 || strlen($recsenha)>10){
                   echo("Você digitou uma quantidade inferior de caracteres no recuperador");
                 }else{
                  if(strlen($senha)<5 || strlen($senha)>16){
                    echo("Você digitou uma quantidade inferior de caracteres requerido na senha");
                  }else{
                    // verificará se as senhas são iguais de ADM
                        if($confsenha == $senhav){
                          //se for, será guardado o valor 1 na variavel $validador
                          $validator = 1;
                          // verificará se a senha de usuário estão iguais, caso estejam, será executaro o sql e adicionará no banco como ADM
                             if($senha == $rsenha && $recsenha == $rrecsenha){
                       $sql_code= "INSERT INTO administrador(
            matricula,nome_adm,telefone_adm, nomeuser_adm, login_adm, email_adm, recuperador_adm, senha_adm, datafinal_adm, dataatual_adm, validador,id_orgao)

            VALUES(
            '$_SESSION[mat]',
            '$_SESSION[nome]',
            '$_SESSION[telefone]',
            '$_SESSION[nomeuser]',
            '$_SESSION[login]',
            '$_SESSION[emailadm]',
            '$_SESSION[recsenha]',
            '$_SESSION[senha]',
            '$_SESSION[datafinal]',
            '$data',
            '$validator',
            '$_SESSION[descorgao]')";
        //variável confirma recerá se o sql deu certo ou não
          $confirma = $mysqli->query($sql_code) or die($mysqli->error);
        // esta viariável exibir apenas um texo para o usuário
          $correct = "Administrador cadastrado com sucesso.";
        //e caso ocorra tudo certo incrementará a variável acc que resultará na exibição mais tarde       
          $acc++;



    }else{
       //caso ocorra algo errado, armazenará a seguinte string
    $trouble = "voce digitou senhas diferentes e/ou recuperadores diferentes. ";
    //e incrimetará a variável $erro
    $erro++;
   }
                        }else{
                          //verificará se a senha de ADM está vazia
                          if(empty($confsenha) || $confsenha != $senhav){
                            //caso esteja será guardado o valor 2 na variável $validator
                            $validator = 2;
                            //conferir se a senha de usuario são iguais, caso ocorra tudo certo adicionará no banco como DEPENDETE
                            if($senha == $rsenha && $recsenha == $rrecsenha){
                       $sql_code= "INSERT INTO administrador(
            matricula,nome_adm,telefone_adm, nomeuser_adm, login_adm, email_adm, recuperador_adm, senha_adm, datafinal_adm, dataatual_adm, validador,id_orgao)

            VALUES(
            '$_SESSION[mat]',
            '$_SESSION[nome]',
            '$_SESSION[telefone]',
            '$_SESSION[nomeuser]',
            '$_SESSION[login]',
            '$_SESSION[emailadm]',
            '$_SESSION[recsenha]',
            '$_SESSION[senha]',
            '$_SESSION[datafinal]',
            '$data',
            '$validator',
            '$_SESSION[descorgao]')";
            //variável confirma recerá se o sql deu certo ou não
          $confirma = $mysqli->query($sql_code) or die($mysqli->error);
            // esta viariável exibir apenas um texo para o usuário
          $correct = "Dependente cadastrado com sucesso.";
          //e caso ocorra tudo certo incrementará a variável acc que resultará na exibição mais tarde
          $acc++;



    }else{
     //caso ocorra algo errado, armazenará a seguinte string  
    $trouble = "voce digitou senhas diferentes e/ou recuperadores diferentes. ";
    //e incrimetará a variável $erro
    $erro++;
   }
                          }
                        }
                    }
                  }
                 }
             }
           // }
          //}
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
<div id="cadastroadm" style="width: 400px;">
<h1>Cadastro de Usuários</h1>

<form action="" method="POST" name="form1">
    <?php 
    //validar se o erro foi incrementado
    if($erro>0){
      //caso seja maior que zero exibe o erro
        echo $trouble; 
        //se não verifica se o acc foi incrementado
    }elseif($acc>0){
      //caso seja maior que zero exibe o correct 
        echo $correct;
    }
    ?>
     <p class=espaco></p>
    Preencha o campo abaixo, apenas se for se cadastrar como ADM
    <p class=espaco></p>
    <p class=espaco></p>
    <label for="senhav"> Validação de ADM:</label>
    <input name="senhav" value="" type="password" placeholder="Conter entre 6 e 10 caracteres." maxlength="10" class="form form-control" style="text-align: center;">
    <p class=espaco></p>

    <p class=espaco></p>
    <label for="mat"> Matricula: </label>
    <input name="mat" required value=""  class="form form-control" style="text-align: center;" >
    <p class=espaco></p>

  <label for="nome"> Nome: </label>
    <input name="nome" required value=""  class="form form-control" style="text-align: center;" >
    <p class=espaco></p>

    <label for="descorgao">Orgão</label>
  <select name="descorgao" required id="descorgao" class="form form-control">
   <option value="">Selecione</option>
   <?php 
   do{ 
  ?>
  <option value="<?php  echo $linhatabela['id_orgao']; ?>"> <?php echo $linhatabela['desc_orgao']?></option>
  <?php } while($linhatabela = $sql_query->fetch_assoc());  ?>
  </select>
  <p class=espaco></p>


      <!----  SEM REQUIRED validar com JS -->
    <label for="nomeuser"> Nome de Usuário:</label>
    <input name="nomeuser" required value="" maxlength="14" class="form form-control" style="text-align: center;">
    <p class=espaco></p>

      <!----  SEM REQUIRED validar com JS -->
    <label for="login"> Login:</label>
    <input name="login" required value="" maxlength="14" class="form form-control" style="text-align: center;">
    <p class=espaco></p>

    <label for="emailadm"> E-mail:</label>
    <input name="emailadm" required value="" type="email" placeholder="Ex:nome@email.com" class="form form-control" style="text-align: center;">
    <p class=espaco></p>

      <!----  SEM REQUIRED validar com JS -->
    <label for="telefone">Telefone:</label>
    <input name="telefone" value="" required placeholder="só números."  class="form form-control" style="text-align: center;">
    <p class=espaco></p>
        
    
    <label for="senha"> Senha:</label>
    <input name="senha" required value="" type="password" placeholder="Conter entre 5 e 16 caracteres." maxlength="16" class="form form-control" style="text-align: center;">
    <p class=espaco></p>

    <label for="rsenha"> Repita a Senha:</label>
    <input name="rsenha" required value="" type="password"  maxlength="16" class="form form-control" style="text-align: center;">
    <p class=espaco></p>

    <label for="recsenha"> Recuperador de senha:</label>
    <input name="recsenha" required value="" type="password" placeholder="Conter entre 6 e 10 caracteres." maxlength="10" class="form form-control" style="text-align: center;">
    <p class=espaco></p>
       
    <label for="rrecsenha"> Repita o Recuperador de senha:</label>
    <input name="rrecsenha" required value="" type="password" maxlength="10" class="form form-control" style="text-align: center;">
    <p class=espaco></p>


    <label for="datafinal"> Expirar Conta:</label>
    <input name="datafinal" required value="" type="date" class="form form-control" style="text-align: center;">
    <p class=espaco></p>

    
    <input value="Cadastrar" name="confirmar" type="submit" class ="btn btn-success" >


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