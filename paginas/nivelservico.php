<?php 
$acc = 0;

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

 //  realiza consulta de tudo do indicador departamental agrupando pelo ano
         $sql_code5 = "SELECT anob FROM indicadordepartamental GROUP BY 1";
        $sql_query2 = $mysqli->query($sql_code5) or die($mysqli->error);
        $linhatabela2 = $sql_query2->fetch_assoc();

$sql_code4 = "SELECT * FROM orgaos";
        $sql_query = $mysqli->query($sql_code4) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();


if(isset($_POST['confirmar'])){


 foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
	
	$anopego = $_POST['anob'];
	$acpego = $_POST['descorgao'];
	$descnspego = $_POST['descns'];
	$formpego =	$_POST['formula'];
	$sentidopego = $_POST['sentido'];
	$freqpego = $_POST['freq'];
	$obspego =	$_POST['obs'];	
				
				
 $sql_code= "INSERT INTO nivel_servico(
            anob, area_cliente, desc_ns, formula, sentido, frequencia, obs)

            VALUES(
            '$anopego',
            '$acpego',
            '$descnspego',
            '$formpego',
            '$sentidopego',
            '$freqpego',
            '$obspego')";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);

          $correct = "Nível de serviço cadastrado com sucesso.";
          $acc++;



}
?>
<script type="text/javascript">
window.onload = function(){

var anob = document.getElementById('anobase').value = null;
 	var descorgao = document.getElementById('descorgao').value = null;
 	var descns = document.getElementById('descns').value = null;
 	var formula = document.getElementById('formula').value = null;
 	var sentido = document.getElementById('sentido').value = null;
 	var freq = document.getElementById('freq').value = null;

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





  <center>
<div id="cadorgao" style="width: 400px;">
<h1>Nível de Serviço</h1>
<p class=espaco></p>

<form action="" method="POST">
  <?php 
    //verifica se ocorreu a incrementação 
   if($acc>0){
    //caso ocorra exibi o texto acima do formulário
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

   <label for="descorgao"> Área Cliente</label>
  <select name="descorgao" required id="descorgao" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
   <?php 
   do{ 
  ?>
  <option <?php echo (isset($_POST['descorgao']) && $linhatabela['cod_orgao'] == $_POST['descorgao']) ? "selected" : ''; ?> value="<?php  echo $linhatabela['cod_orgao']; ?>"> <?php echo $linhatabela['desc_orgao'] .':'.$linhatabela['cod_orgao'];?></option>
  <?php } while($linhatabela = $sql_query->fetch_assoc());  ?>
  </select>
  <p class=espaco></p>

	<label for="descns"> Descrição Nível de Serviço</label>
	<input type="text" required name="descns" id="descns" class="form form-control" style="text-align: center;">
	<p class=espaco></p>

	<label for="formula"> Fórmula</label>
	<input type="text" required name="formula" id="formula" class="form form-control" style="text-align: center;">
	<p class=espaco></p>

	<label for="sentido">Sentido</label>
    <select name="sentido" id="sentido" required class="form form-control" style="text-align: center;">
          <option value="">Selecione</option>
          <option value="1">Crescente</option>
          <option value="2">Na faixa</option>
          <option value="3">Decrescente</option>
    </select>
    <p class=espaco></p>	

	<label for="freq"> Frequência</label>
	<input type="text" required name="freq" id="freq" class="form form-control" style="text-align: center;">
	<p class=espaco></p>

	<label for="obs"> Considerações da Área</label>
	<input type="text" name="obs" id="obs" class="form form-control" style="text-align: center;">
	<p class=espaco></p>

	<input type="button" name="btnforcenedor" id="btnforcenedor" class ="btn btn-primary" value="Adicionar Fornecedor(es)" disabled="true">
	<p class=espaco></p>
	<input type="submit" name="confirmar" value="Cadastrar" class ="btn btn-success">

</form>    

</div>
</center>


<script type="text/javascript">

 $('#anobase').on('change', function(){ 	
 	var anob = document.getElementById('anobase').value;
 	var descorgao = document.getElementById('descorgao').value;
 	var descns = document.getElementById('descns').value;
 	var formula = document.getElementById('formula').value;
 	var sentido = document.getElementById('sentido').value;
 	var freq = document.getElementById("freq").value;
 	if(anob == 0){
 	$("#btnforcenedor").attr('disabled','disabled');	
 	}else if(anob != 0){
 		if(descorgao !=0 && descns!= 0 && formula != 0 && sentido !=0 && freq != 0){
		$("#btnforcenedor").removeAttr('disabled');
		}
	}
	
 });	

 $('#descorgao').on('change', function(){ 	
 	var anob = document.getElementById('anobase').value;
 	var descorgao = document.getElementById('descorgao').value;
 	var descns = document.getElementById('descns').value;
 	var formula = document.getElementById('formula').value;
 	var sentido = document.getElementById('sentido').value;
 	var freq = document.getElementById("freq").value;
 	if(descorgao == 0){
 	$("#btnforcenedor").attr('disabled','disabled');	
 	}else if(descorgao != 0){
 		if(anob !=0 && descns!= 0 && formula != 0 && sentido !=0 && freq != 0){
		$("#btnforcenedor").removeAttr('disabled');
		}
	}
	
 });

 $('#descns').on('mouseout', function(){ 	
 	var anob = document.getElementById('anobase').value;
 	var descorgao = document.getElementById('descorgao').value;
 	var descns = document.getElementById('descns').value;
 	var formula = document.getElementById('formula').value;
 	var sentido = document.getElementById('sentido').value;
 	var freq = document.getElementById("freq").value;
 	if(descns == 0){
 	$("#btnforcenedor").attr('disabled','disabled');	
 	}else if(descns != 0){
 		if(anob !=0 && descorgao!= 0 && formula != 0 && sentido !=0 && freq != 0){
		$("#btnforcenedor").removeAttr('disabled');
		}
	}
	
 });

 $('#formula').on('mouseout', function(){ 	
 	var anob = document.getElementById('anobase').value;
 	var descorgao = document.getElementById('descorgao').value;
 	var descns = document.getElementById('descns').value;
 	var formula = document.getElementById('formula').value;
 	var sentido = document.getElementById('sentido').value;
 	var freq = document.getElementById("freq").value;
 	if(formula == 0){
 	$("#btnforcenedor").attr('disabled','disabled');	
 	}else if(formula != 0){
 		if(anob !=0 && descorgao!= 0 && descns != 0 && sentido !=0 && freq != 0){
		$("#btnforcenedor").removeAttr('disabled');
		}
	}
	
 });

 $('#sentido').on('change', function(){ 	
 	var anob = document.getElementById('anobase').value;
 	var descorgao = document.getElementById('descorgao').value;
 	var descns = document.getElementById('descns').value;
 	var formula = document.getElementById('formula').value;
 	var sentido = document.getElementById('sentido').value;
 	var freq = document.getElementById("freq").value;
 	if(sentido == 0){
 	$("#btnforcenedor").attr('disabled','disabled');	
 	}else if(sentido != 0){
 		if(anob !=0 && descorgao!= 0 && descns != 0 && formula !=0 && freq != 0){
		$("#btnforcenedor").removeAttr('disabled');
		}
	}
	
 });

 $('#freq').on('mouseout', function(){ 	
 	var anob = document.getElementById('anobase').value;
 	var descorgao = document.getElementById('descorgao').value;
 	var descns = document.getElementById('descns').value;
 	var formula = document.getElementById('formula').value;
 	var sentido = document.getElementById('sentido').value;
 	var freq = document.getElementById("freq").value;
 	if(freq == 0){
 	$("#btnforcenedor").attr('disabled','disabled');	
 	}else if(freq != 0){
 		if(anob !=0 && descorgao!= 0 && descns != 0 && formula !=0 && sentido != 0){
		$("#btnforcenedor").removeAttr('disabled');
		}
	}
	
 });


$('#btnforcenedor').on('click', function(){

   window.open('http://localhost/sistemateste/index.php?pagina=popupnivelservico', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');

   var anob = document.getElementById("anobase").value;
   var descorgao = document.getElementById("descorgao").value;
                      
 	
 $.post('paginas/popupnivelservico.php', {anoBase: anob , descOrgao: descorgao},  function(data){
                   console.log(data);     
                     
                      
   });
  }); 

	
</script>