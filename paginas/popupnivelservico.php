<?php 
header('Access-Control-Allow-Origin: *');

if(!isset($_SESSION['nomeuser_adm']) && !isset($_SESSION['login_adm'])){
  header('Location: ?pagina=inicio');
  exit;
	}

	//variável que recebe o valor da sessão validador
$valid = $_SESSION['validador'];

//verificação do nível de acesso, caso seja dependente, é redirecional para a page inicial
if($valid==2){
  header('Location: ?pagina=inicial');
  exit;
}

$sql_code4 = "SELECT * FROM orgaos";
        $sql_query = $mysqli->query($sql_code4) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        //retornado o código do orgão buscado e inserindo na variável $orgaobuscado
        $orgaobuscado = $linhatabela['cod_orgao'];

        $anobase = $_POST['anoBase'];
        $cliente = $_POST['descOrgao'];

        $_POST['anob'] = $anobase ;

?>


<!-- IMPORTA O JQUERY -->
  <script  src="https://code.jquery.com/jquery-3.1.1.min.js" 
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
   crossorigin="anonymous"></script>

<!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">





  <center>
<div id="cadorgao" style="width: 400px;">
<h1>Fornecedor</h1>
<p class=espaco></p>

<form action="" method="POST">
 
    <p class=espaco></p>

 <label for="anob"> Ano Base</label>
 <input type="text" required readonly="true" name="anob" class="form form-control" style="text-align: center;" value='<?php echo (isset($_POST['anob']) ? $_POST['anob'] : '') ?>'>
  <p class=espaco></p>

   <label for="areacliente"> Área Cliente</label>
  <input type="text" required readonly="true" name="areacliente" class="form form-control" style="text-align: center;" value='<?php echo (isset($_POST['areacliente']) ? $_POST['areacliente'] : '') ?>'>
  <p class=espaco></p>

	<label for="areafornecedora">Área Fornecedora </label>
 	<select name="areafornecedora" id="areafornecedora" required  class="form form-control" style="text-align: center;" >
    <option value="">Selecione</option>
    <!-- exibirá os valores da consulta, usando o while para exibir todos os dados do banco -->
     <?php 
     
   do{ 
  ?>
  <option value="<?php  echo $linhatabela['cod_orgao']; ?>"> <?php echo $linhatabela['desc_orgao'] .':'.$linhatabela['cod_orgao'];?></option>
  <?php } while($linhatabela = $sql_query->fetch_assoc());?>
        
 </select>
	<p class=espaco></p>

	<label for="peso"> peso</label>
	<input type="numeric" required name="peso" class="form form-control" style="text-align: center;" maxlength="3">
	<p class=espaco></p>

	<label for="meta"> Meta</label>
	<input type="text" required name="meta" class="form form-control" style="text-align: center;">
	<p class=espaco></p>

	<input type="button" name="btnarquivdados" class ="btn btn-success" value="Arquivar dados">
	<p class=espaco></p>
	<input type="button" name="btnfinalizar" class ="btn btn-primary" value="Finalizar Cadastro Fornecedor">

</form>    

</div>
</center>


<script type="text/javascript">

	


</script>