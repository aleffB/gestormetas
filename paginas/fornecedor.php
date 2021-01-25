<?php 
$acc = 0;


if(!isset($_SESSION['nomeuser_adm']) && !isset($_SESSION['login_adm'])){
  header('Location: ?pagina=inicio');
  exit;
	}

	//variável que recebe o valor da sessão validador
$valid = $_SESSION['validador'];
$ac = $_SESSION['acs'] = 0;

//verificação do nível de acesso, caso seja dependente, é redirecional para a page inicial
if($valid==2){
  header('Location: ?pagina=inicial');
  exit;
}

//  realiza consulta de tudo do nível de serviço agrupando pelo ano
         $sql_code5 = "SELECT anob FROM nivel_servico GROUP BY 1";
        $sql_query2 = $mysqli->query($sql_code5) or die($mysqli->error);
        $linhatabela2 = $sql_query2->fetch_assoc();

 
 $sql_code3 = "SELECT * FROM orgaos";
        $sql_query3 = $mysqli->query($sql_code3) or die($mysqli->error);
        $linhatabela3 = $sql_query3->fetch_assoc(); 



        if(isset($_POST['btnfinalizar'])){


 foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
  
  $anopego = $_POST['anob'];
  $acpego = $_POST['areacliente'];
  $nspego = $_POST['nivelservico'];
  $afpego = $_POST['areafornecedora'];
  $pesopego = $_POST['peso'];
  $metapego = $_POST['meta'];

  //--- sessões de armazenamento de dados

  $ac = $acpego;
  
  //---- fim
   
        
        
 $sql_code= "INSERT INTO fornecedor(
            id_ns, anob, area_cliente, area_fornecedor, peso, meta)

            VALUES(
            '$nspego',
            '$anopego',
            '$acpego',
            '$afpego',
            '$pesopego',
            '$metapego')";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);

          $correct = "Fornecedor cadastrado com sucesso.";
          $acc++;



}    

?>
<script type="text/javascript">


 function holdAreaCliente(){
        var valor = $('#anobase').val();

  $.post('paginas/reqfornecedor.php', {valorSelect: valor}, function(data) {
    $('#areacliente').html('');
      

    
    $.each($.parseJSON(data), function(){

     var ks = <?php echo isset($_POST['areacliente']) ? $_POST['areacliente'] : 'this.cod_orgao'; ?>;
     if (ks == this.cod_orgao) {
     $('#areacliente').append('<option selected value="' + this.cod_orgao + '">' + this.desc_orgao+':'+this.cod_orgao + '</option>');
        }else{
          $('#areacliente').append('<option value="' + this.cod_orgao + '">' + this.desc_orgao+':'+this.cod_orgao +'</option>');
        }

   });
  });
   }; 

 function holdNivelServico(){
        var valor = $('#anobase').val();
        var areac = $('#areacliente').val();

         
  $.post('paginas/reqnivelservico.php', {valorSelect: valor, areacSelect: areac}, function(data) {
    $('#nivelservico').html('');
      

    
    $.each($.parseJSON(data), function(){

     var ks = <?php echo isset($_POST['nivelservico']) ? $_POST['nivelservico'] : 'this.id_ns'; ?>;
     if (ks == this.id_ns) {
     $('#nivelservico').append('<option selected value="' + this.id_ns + '">' + this.desc_ns +'</option>');
        }else{
          $('#nivelservico').append('<option value="' + this.id_ns + '">' + this.desc_ns +'</option>');
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





  <center>
<div id="cadorgao" style="width: 400px;">
<h1>Fornecedor</h1>
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

   <label for="areacliente"> Área Cliente</label>
  <select name="areacliente" required id="areacliente" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
   
  </select>
  <p class=espaco></p>

   <label for="nivelservico"> Nível Serviço</label>
  <select name="nivelservico" required id="nivelservico" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
   
  </select>
  <p class=espaco></p>

	<label for="areafornecedora">Área Fornecedora </label>
 	<select name="areafornecedora" id="areafornecedora" required  class="form form-control" style="text-align: center;" >
    <option value="">Selecione</option>
    <!-- exibirá os valores da consulta, usando o while para exibir todos os dados do banco -->
     <?php 
   do{ 
  ?>
  <option value="<?php  echo $linhatabela3['cod_orgao']; ?>"> <?php echo $linhatabela3['desc_orgao'] .':'.$linhatabela3['cod_orgao'];?></option>
  <?php } while($linhatabela3 = $sql_query3->fetch_assoc());?>
        
 </select>
	<p class=espaco></p>


	<label for="peso"> peso</label>
	<input type="numeric" required name="peso" class="form form-control" style="text-align: center;" maxlength="3">
	<p class=espaco></p>

	<label for="meta"> Meta</label>
	<input type="text" required name="meta" class="form form-control" style="text-align: center;">
	<p class=espaco></p>

	<!--<input type="button" name="btnarquivdados" class ="btn btn-success" value="Arquivar dados"> -->
	<p class=espaco></p>
	<input type="submit" name="btnfinalizar" id="btnfinalizar" class ="btn btn-primary" value="Finalizar Cadastro Fornecedor">

</form>    

</div>
</center>


<script type="text/javascript">
$('#anobase').on('change', holdAreaCliente);
holdAreaCliente();

$('#areacliente').bind('mouseover change', holdNivelServico);
holdNivelServico();

$('#nivelservico').on('mouseover', holdNivelServico);
holdNivelServico();



</script>