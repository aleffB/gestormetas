 <?php  
$acc = 0;

$orgao = $_SESSION['id_orgao'];

/*if($orgao==2){
  header('Location: ?pagina=inicial');
  exit;
}*/

$valid = $_SESSION['validador'];

if(isset($_POST['voltar'])){
 
 header('Location: index.php?pagina=inicio');
}

if(!isset($_SESSION['nomeuser_adm']) && !isset($_SESSION['login_adm'])){
  header('Location: ?pagina=inicio');
  exit;
} 

        if($valid==1){
 $sql_code4 = "SELECT * FROM orgaos";
        $sql_query = $mysqli->query($sql_code4) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        }else{
          $sql_code4 = "SELECT * FROM orgaos WHERE id_orgao = '$orgao'";
        $sql_query = $mysqli->query($sql_code4) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        }

         $sql_code5 = "SELECT anob FROM indicadordepartamental GROUP BY 1";
        $sql_query2 = $mysqli->query($sql_code5) or die($mysqli->error);
        $linhatabela2 = $sql_query2->fetch_assoc();


        if(isset($_POST['confirmar'])){
      
      $codorg = $_POST['descorgao'];
      $iddep = $_POST['descinddep'];


       $sql_code2="SELECT cod_orgao FROM orgaos WHERE cod_orgao = '$codorg'";
       $show = $mysqli->query($sql_code2) or die($mysqli->error);
       $linhas = $show->fetch_assoc();

       $resgateagain = $linhas['cod_orgao'];

       ////

       $sql_code3="SELECT id_inddep FROM indicadordepartamental WHERE id_inddep = '$iddep'";
       $show3 = $mysqli->query($sql_code3) or die($mysqli->error);
       $linha = $show3->fetch_assoc();

       $resgate = $linha['id_inddep'];

    foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);


            if( $resgateagain == $codorg  && $resgate == $iddep ){
              $prioridade = $_POST['priorid'];
              $addprioridade = (double)str_replace(',', '.', $prioridade);
              $recidcausa = $_POST['idcausa'];
              $sql_code= "UPDATE causa SET
            cod_causa = '$_SESSION[codcausa]',
            desc_causa = '$_SESSION[desccausa]',
            influencia = '$_SESSION[influe]',
            prioridade = '$addprioridade',
            atuar = '$_SESSION[actuar]'  
            WHERE id_causa = '$recidcausa'";

            

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);

          $correct = "Causa cadastrada com sucesso.";
          $acc++;
        }else{
          $correct = "Houve algum erro no cadastro";
          $acc++;
        }

}

if(isset($_POST['delete'])){
  foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
    $sql_code = "DELETE FROM causa WHERE id_causa = '$recidcausa'";
      $deletarT = $mysqli->query($sql_code) or die($mysqli->error);
      echo "Deletado com sucesso";
}
 ?>
<!-- IMPORTA O JQUERY -->
  <script  src="https://code.jquery.com/jquery-3.1.1.min.js" 
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
   crossorigin="anonymous"></script>

<center>
<div id="causa" style="width: 400px;">
<h1>Atualizar Causa</h1>
<!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<p class=espaco></p>
<form action="" method="POST">
<input type="submit" name="voltar" value="Voltar" class ="btn btn-primary">
</form>

<form action="" method="POST">
 <?php 
    
   if($acc>0){
        echo $correct;
    }

    ?>

    <label for="descorgao"> Descrição do Orgão</label>
  <select name="descorgao" required id="descorgao" class="form form-control" style="text-align: center;">
   <?php 
   do{ 
  ?>
  <option value="<?php  echo $linhatabela['cod_orgao']; ?>"> <?php echo $linhatabela['desc_orgao'] .':'.$linhatabela['cod_orgao'];?></option>
  <?php } while($linhatabela = $sql_query->fetch_assoc());  ?>
  </select>
  <p class=espaco></p>

 <label for="anob"> Ano Base</label>
  <select name="anob" required id="anobase" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
  <?php 
   do{ 
  ?>
 <option value="<?php  echo $linhatabela2['anob']; ?>"> <?php echo $linhatabela2['anob'];?></option>

  <?php } while($linhatabela2 = $sql_query2->fetch_assoc());  ?>
  </select>
  <p class=espaco></p>

  <label for="descinddep"> Indicador Departamental</label>
  <select name="descinddep"  id="descinddep" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
 
  </select>
  <p class=espaco></p>

   

  <label for="codcausa">Código da Causa</label>
  <input name="codcausa" required value="" type="numeric"  class="form form-control" style="text-align: center;" id="codcausa">
  <p class=espaco></p>

  <label for="desccausa">Descrição da Causa</label>
  <input name="desccausa" required value="" type="text" class="form form-control" style="text-align: center;" id="desccausa">
  <p class=espaco></p>

 <label for="influe">Influência</label>
  <select name="influe"  value="" type="text" class="form form-control" style="text-align: center;" id="influe">
    <option value="">Selecione</option>
    <option value="Fornecedores">Fornecedores</option>
    <option  value="Fornecimento Próprio">Fornecimento Próprio</option>
    <option  value="Deterioração">Deterioração</option>
    <option  value="Manutenção">Manutenção</option>
    <option  value="Instrumento">Instrumento</option>
    <option  value="Cond. Locais">Cond. Locais</option>
    <option  value="Inspeção">Inspeção</option>
    <option  value="Oficina">Oficina</option>
    <option  value="Clima">Clima</option>
    <option  value="Físico">Físico</option>
    <option  value="Mental">Mental</option>
    <option  value="Informação">Informação</option>
    <option  value="Instrução">Instrução</option>
    <option  value="Procedimento">Procedimento</option>
   



  </select> 
  <p class=espaco></p>

  <label for="priorid">Prioridade</label>
  <select name="priorid"  value="" type="numeric" class="form form-control" style="text-align: center;" id="priorid">
  <option value="">Selecione</option>
    <option value="1">Causa com pequeno impacto no problema e com pequena possibilidade de estar ocorrendo</option>
    <option value="3">Causa com impacto no problema e que possivelmente esta ocorrendo</option>
    <option value="5">Causa de grande impacto no problema e com grande possibilidade de estar ocorrendo</option>

  </select>
  <p class=espaco></p>

  <label for="actuar">Atuar</label>
    <select name="actuar"  class="form form-control" style="text-align: center;" id="actuar">
          <option value="">Selecione</option>
          <option value="1">Sim</option>
          <option value="2">Não</option>
    </select>
    <p class=espaco></p>

    <input type="numeric" name="idcausa" id="idcausa" required hidden="true">

 

    <input value="Atualizar" name="confirmar" type="submit" class ="btn btn-success">
    <p class=espaco></p>
    <input value="Deletar" name="delete" type="submit" class ="btn btn-danger">


                   <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   
</form>
</div></center>
<script type="text/javascript">
$('#anobase').on('change', function(){
   var valor = $(this).val();
   var recebeorgao = document.getElementById("descorgao").value;

  $.post('paginas/reqindorgao.php', {valorSelect: valor, recebeOrgao: recebeorgao}, function(data) {
    $('#descinddep').html('');


   
    $.each($.parseJSON(data), function(){
     $('#descinddep').append('<option value="' + this.id_inddep + '">' + this.desc_inddep + '</option>');

   });
  });
});

$('#anobase').on('mouseout', function(){
   var valor = document.getElementById("anobase").value;
   var recebeorgao = document.getElementById("descorgao").value;

  $.post('paginas/attreqcausa.php', {valorSelect: valor, recebeOrgao: recebeorgao}, function(data) {
    $('#codcausa').html('');
    $('#desccausa').html('');
    $('#influe').html('');
    $('#priorid').html('');
    $('#actuar').html('');
    $('#idcausa').html('');



   
    $.each($.parseJSON(data), function(){
      document.getElementById("codcausa").value = this.cod_causa;
      document.getElementById("desccausa").value = this.desc_causa;
      document.getElementById("idcausa").value = this.id_causa;

      ////MODIFICAR AQUI
    var influ = this.influencia;
      if (influ == 1) {
     $('#influe').append('<option value="' + this.influencia + '">'  + 'Fornecedores</option>');
     $('#influe').append('<option value="2">'  + 'Fornecimento Próprio</option>');
     $('#influe').append('<option value="3">'  + 'Deterioração</option>');
     $('#influe').append('<option value="4">'  + 'Manutenção</option>');
     $('#influe').append('<option value="5">'  + 'Instrumento</option>');
     $('#influe').append('<option value="6">'  + 'Cond. Locais</option>');
     $('#influe').append('<option value="7">'  + 'Inspeção</option>');
     $('#influe').append('<option value="8">'  + 'Oficina</option>');
     $('#influe').append('<option value="9">'  + 'Clima</option>');
     $('#influe').append('<option value="10">'  + 'Físico</option>');
     $('#influe').append('<option value="11">'  + 'Mental</option>');
     $('#influe').append('<option value="12">'  + 'Informação</option>');
     $('#influe').append('<option value="13">'  + 'Instrução</option>');
     $('#influe').append('<option value="14">'  + 'Procedimento</option>');
        }
        if (influ == 2) {
    $('#influe').append('<option value="' + this.influencia + '">'  +'Fornecimento Próprio</option>');
     $('#influe').append('<option value="1">'  + 'Fornecedores</option>');
     $('#influe').append('<option value="3">'  + 'Deterioração</option>');
     $('#influe').append('<option value="4">'  + 'Manutenção</option>');
     $('#influe').append('<option value="5">'  + 'Instrumento</option>');
     $('#influe').append('<option value="6">'  + 'Cond. Locais</option>');
     $('#influe').append('<option value="7">'  + 'Inspeção</option>');
     $('#influe').append('<option value="8">'  + 'Oficina</option>');
     $('#influe').append('<option value="9">'  + 'Clima</option>');
     $('#influe').append('<option value="10">'  + 'Físico</option>');
     $('#influe').append('<option value="11">'  + 'Mental</option>');
     $('#influe').append('<option value="12">'  + 'Informação</option>');
     $('#influe').append('<option value="13">'  + 'Instrução</option>');
     $('#influe').append('<option value="14">'  + 'Procedimento</option>');
        }
          if (influ == 3) {
     $('#influe').append('<option value="' + this.influencia + '">'  +'Deterioração</option>');
     $('#influe').append('<option value="1">'  + 'Fornecedores</option>');
     $('#influe').append('<option value="2">'  + 'Fornecimento Próprio</option>');
     $('#influe').append('<option value="4">'  + 'Manutenção</option>');
     $('#influe').append('<option value="5">'  + 'Instrumento</option>');
     $('#influe').append('<option value="6">'  + 'Cond. Locais</option>');
     $('#influe').append('<option value="7">'  + 'Inspeção</option>');
     $('#influe').append('<option value="8">'  + 'Oficina</option>');
     $('#influe').append('<option value="9">'  + 'Clima</option>');
     $('#influe').append('<option value="10">'  + 'Físico</option>');
     $('#influe').append('<option value="11">'  + 'Mental</option>');
     $('#influe').append('<option value="12">'  + 'Informação</option>');
     $('#influe').append('<option value="13">'  + 'Instrução</option>');
     $('#influe').append('<option value="14">'  + 'Procedimento</option>');
        }
          if (influ == 4) {
     $('#influe').append('<option value="' + this.influencia + '">'  +'Manutenção</option>');
     $('#influe').append('<option value="1">'  + 'Fornecedores</option>');
     $('#influe').append('<option value="2">'  + 'Fornecimento Próprio</option>');
     $('#influe').append('<option value="3">'  + 'Deterioração</option>');
     $('#influe').append('<option value="5">'  + 'Instrumento</option>');
     $('#influe').append('<option value="6">'  + 'Cond. Locais</option>');
     $('#influe').append('<option value="7">'  + 'Inspeção</option>');
     $('#influe').append('<option value="8">'  + 'Oficina</option>');
     $('#influe').append('<option value="9">'  + 'Clima</option>');
     $('#influe').append('<option value="10">'  + 'Físico</option>');
     $('#influe').append('<option value="11">'  + 'Mental</option>');
     $('#influe').append('<option value="12">'  + 'Informação</option>');
     $('#influe').append('<option value="13">'  + 'Instrução</option>');
     $('#influe').append('<option value="14">'  + 'Procedimento</option>');
        }
          if (influ == 5) {
     $('#influe').append('<option value="' + this.influencia + '">'  +'Instrumento</option>');
     $('#influe').append('<option value="1">'  + 'Fornecedores</option>');
     $('#influe').append('<option value="2">'  + 'Fornecimento Próprio</option>');
     $('#influe').append('<option value="3">'  + 'Deterioração</option>');
     $('#influe').append('<option value="4">'  + 'Manutenção</option>');
     $('#influe').append('<option value="6">'  + 'Cond. Locais</option>');
     $('#influe').append('<option value="7">'  + 'Inspeção</option>');
     $('#influe').append('<option value="8">'  + 'Oficina</option>');
     $('#influe').append('<option value="9">'  + 'Clima</option>');
     $('#influe').append('<option value="10">'  + 'Físico</option>');
     $('#influe').append('<option value="11">'  + 'Mental</option>');
     $('#influe').append('<option value="12">'  + 'Informação</option>');
     $('#influe').append('<option value="13">'  + 'Instrução</option>');
     $('#influe').append('<option value="14">'  + 'Procedimento</option>');
        }
          if (influ == 6) {
    $('#influe').append('<option value="' + this.influencia + '">'  +'Cond. Locais</option>');
     $('#influe').append('<option value="1">'  + 'Fornecedores</option>');
     $('#influe').append('<option value="2">'  + 'Fornecimento Próprio</option>');
     $('#influe').append('<option value="3">'  + 'Deterioração</option>');
     $('#influe').append('<option value="4">'  + 'Manutenção</option>');
     $('#influe').append('<option value="5">'  + 'Instrumento</option>');
     $('#influe').append('<option value="7">'  + 'Inspeção</option>');
     $('#influe').append('<option value="8">'  + 'Oficina</option>');
     $('#influe').append('<option value="9">'  + 'Clima</option>');
     $('#influe').append('<option value="10">'  + 'Físico</option>');
     $('#influe').append('<option value="11">'  + 'Mental</option>');
     $('#influe').append('<option value="12">'  + 'Informação</option>');
     $('#influe').append('<option value="13">'  + 'Instrução</option>');
     $('#influe').append('<option value="14">'  + 'Procedimento</option>');
        }
          if (influ == 7) {
     $('#influe').append('<option value="' + this.influencia + '">'  +'Inspeção</option>');
     $('#influe').append('<option value="1">'  + 'Fornecedores</option>');
     $('#influe').append('<option value="2">'  + 'Fornecimento Próprio</option>');
     $('#influe').append('<option value="3">'  + 'Deterioração</option>');
     $('#influe').append('<option value="4">'  + 'Manutenção</option>');
     $('#influe').append('<option value="5">'  + 'Instrumento</option>');
     $('#influe').append('<option value="6">'  + 'Cond. Locais</option>');
     $('#influe').append('<option value="8">'  + 'Oficina</option>');
     $('#influe').append('<option value="9">'  + 'Clima</option>');
     $('#influe').append('<option value="10">'  + 'Físico</option>');
     $('#influe').append('<option value="11">'  + 'Mental</option>');
     $('#influe').append('<option value="12">'  + 'Informação</option>');
     $('#influe').append('<option value="13">'  + 'Instrução</option>');
     $('#influe').append('<option value="14">'  + 'Procedimento</option>');
        }
          if (influ == 8) {
    $('#influe').append('<option value="' + this.influencia + '">' +'Oficina</option>');
     $('#influe').append('<option value="1">'  + 'Fornecedores</option>');
     $('#influe').append('<option value="2">'  + 'Fornecimento Próprio</option>');
     $('#influe').append('<option value="3">'  + 'Deterioração</option>');
     $('#influe').append('<option value="4">'  + 'Manutenção</option>');
     $('#influe').append('<option value="5">'  + 'Instrumento</option>');
     $('#influe').append('<option value="6">'  + 'Cond. Locais</option>');
     $('#influe').append('<option value="7">'  + 'Inspeção</option>');
     $('#influe').append('<option value="9">'  + 'Clima</option>');
     $('#influe').append('<option value="10">'  + 'Físico</option>');
     $('#influe').append('<option value="11">'  + 'Mental</option>');
     $('#influe').append('<option value="12">'  + 'Informação</option>');
     $('#influe').append('<option value="13">'  + 'Instrução</option>');
     $('#influe').append('<option value="14">'  + 'Procedimento</option>');
        }
          if (influ == 9) {
     $('#influe').append('<option value="' + this.influencia + '">' +'Clima</option>');
     $('#influe').append('<option value="1">'  + 'Fornecedores</option>');
     $('#influe').append('<option value="2">'  + 'Fornecimento Próprio</option>');
     $('#influe').append('<option value="3">'  + 'Deterioração</option>');
     $('#influe').append('<option value="4">'  + 'Manutenção</option>');
     $('#influe').append('<option value="5">'  + 'Instrumento</option>');
     $('#influe').append('<option value="6">'  + 'Cond. Locais</option>');
     $('#influe').append('<option value="7">'  + 'Inspeção</option>');
     $('#influe').append('<option value="8">'  + 'Oficina</option>');
     $('#influe').append('<option value="10">'  + 'Físico</option>');
     $('#influe').append('<option value="11">'  + 'Mental</option>');
     $('#influe').append('<option value="12">'  + 'Informação</option>');
     $('#influe').append('<option value="13">'  + 'Instrução</option>');
     $('#influe').append('<option value="14">'  + 'Procedimento</option>');
        }
          if (influ == 10) {
     $('#influe').append('<option value="' + this.influencia + '">' +'Físico</option>');
     $('#influe').append('<option value="1">'  + 'Fornecedores</option>');
     $('#influe').append('<option value="2">'  + 'Fornecimento Próprio</option>');
     $('#influe').append('<option value="3">'  + 'Deterioração</option>');
     $('#influe').append('<option value="4">'  + 'Manutenção</option>');
     $('#influe').append('<option value="5">'  + 'Instrumento</option>');
     $('#influe').append('<option value="6">'  + 'Cond. Locais</option>');
     $('#influe').append('<option value="7">'  + 'Inspeção</option>');
     $('#influe').append('<option value="8">'  + 'Oficina</option>');
     $('#influe').append('<option value="9">'  + 'Clima</option>');
     $('#influe').append('<option value="11">'  + 'Mental</option>');
     $('#influe').append('<option value="12">'  + 'Informação</option>');
     $('#influe').append('<option value="13">'  + 'Instrução</option>');
     $('#influe').append('<option value="14">'  + 'Procedimento</option>');
        }
          if (influ == 11) {
     $('#influe').append('<option value="' + this.influencia + '">'  +'Mental</option>');
     $('#influe').append('<option value="1">'  + 'Fornecedores</option>');
     $('#influe').append('<option value="2">'  + 'Fornecimento Próprio</option>');
     $('#influe').append('<option value="3">'  + 'Deterioração</option>');
     $('#influe').append('<option value="4">'  + 'Manutenção</option>');
     $('#influe').append('<option value="5">'  + 'Instrumento</option>');
     $('#influe').append('<option value="6">'  + 'Cond. Locais</option>');
     $('#influe').append('<option value="7">'  + 'Inspeção</option>');
     $('#influe').append('<option value="8">'  + 'Oficina</option>');
     $('#influe').append('<option value="9">'  + 'Clima</option>');
     $('#influe').append('<option value="10">'  + 'Físico</option>');
     $('#influe').append('<option value="12">'  + 'Informação</option>');
     $('#influe').append('<option value="13">'  + 'Instrução</option>');
     $('#influe').append('<option value="14">'  + 'Procedimento</option>');
        }
          if (influ == 12) {
     $('#influe').append('<option value="' + this.influencia + '">'  +'Informação</option>');
     $('#influe').append('<option value="1">'  + 'Fornecedores</option>');
     $('#influe').append('<option value="2">'  + 'Fornecimento Próprio</option>');
     $('#influe').append('<option value="3">'  + 'Deterioração</option>');
     $('#influe').append('<option value="4">'  + 'Manutenção</option>');
     $('#influe').append('<option value="5">'  + 'Instrumento</option>');
     $('#influe').append('<option value="6">'  + 'Cond. Locais</option>');
     $('#influe').append('<option value="7">'  + 'Inspeção</option>');
     $('#influe').append('<option value="8">'  + 'Oficina</option>');
     $('#influe').append('<option value="9">'  + 'Clima</option>');
     $('#influe').append('<option value="10">'  + 'Físico</option>');
     $('#influe').append('<option value="11">'  + 'Mental</option>');
     $('#influe').append('<option value="13">'  + 'Instrução</option>');
     $('#influe').append('<option value="14">'  + 'Procedimento</option>');
        }
        if (influ == 13) {
     $('#influe').append('<option value="' + this.influencia + '">' +'Instrução</option>');
     $('#influe').append('<option value="1">'  + 'Fornecedores</option>');
     $('#influe').append('<option value="2">'  + 'Fornecimento Próprio</option>');
     $('#influe').append('<option value="3">'  + 'Deterioração</option>');
     $('#influe').append('<option value="4">'  + 'Manutenção</option>');
     $('#influe').append('<option value="5">'  + 'Instrumento</option>');
     $('#influe').append('<option value="6">'  + 'Cond. Locais</option>');
     $('#influe').append('<option value="7">'  + 'Inspeção</option>');
     $('#influe').append('<option value="8">'  + 'Oficina</option>');
     $('#influe').append('<option value="9">'  + 'Clima</option>');
     $('#influe').append('<option value="10">'  + 'Físico</option>');
     $('#influe').append('<option value="11">'  + 'Mental</option>');
     $('#influe').append('<option value="12">'  + 'Informação</option>');
     $('#influe').append('<option value="14">'  + 'Procedimento</option>');
        }
          if (influ == 14) {
     $('#influe').append('<option value="' + this.influencia + '">'   +'Procedimento</option>');
     $('#influe').append('<option value="1">'  + 'Fornecedores</option>');
     $('#influe').append('<option value="2">'  + 'Fornecimento Próprio</option>');
     $('#influe').append('<option value="3">'  + 'Deterioração</option>');
     $('#influe').append('<option value="4">'  + 'Manutenção</option>');
     $('#influe').append('<option value="5">'  + 'Instrumento</option>');
     $('#influe').append('<option value="6">'  + 'Cond. Locais</option>');
     $('#influe').append('<option value="7">'  + 'Inspeção</option>');
     $('#influe').append('<option value="8">'  + 'Oficina</option>');
     $('#influe').append('<option value="9">'  + 'Clima</option>');
     $('#influe').append('<option value="10">'  + 'Físico</option>');
     $('#influe').append('<option value="11">'  + 'Mental</option>');
     $('#influe').append('<option value="12">'  + 'Informação</option>');
     $('#influe').append('<option value="13">'  + 'Instrução</option>');
        }


          var prio = this.prioridade;
         if (prio == 1) {
     $('#priorid').append('<option value="' + this.prioridade + '">'  + 'Causa com pequeno impacto no problema e com pequena possibilidade de estar ocorrendo</option>');
     $('#priorid').append('<option value="2">'  + 'Causa com impacto no problema e que possivelmente está ocorrendo</option>');
     $('#priorid').append('<option value="3">'  + 'Causa de grande impacto no problema e com grande possibilidade de estar ocorrendo</option>');
        }else{
          if(prio == 2){
            $('#priorid').append('<option value="' + this.prioridade + '">'  + 'Causa com impacto no problema e que possivelmente está ocorrendo</option>');                      
            $('#priorid').append('<option value="1">'  + 'Causa com pequeno impacto no problema e com pequena possibilidade de estar ocorrendo</option>');
           $('#priorid').append('<option value="3">'  + 'Causa de grande impacto no problema e com grande possibilidade de estar ocorrendo</option>');
          }else{
             $('#priorid').append('<option value="' + this.prioridade + '">'  + 'Causa de grande impacto no problema e com grande possibilidade de estar ocorrendo</option>');                                   
            $('#priorid').append('<option value="1">'  + 'Causa com pequeno impacto no problema e com pequena possibilidade de estar ocorrendo</option>');
           $('#priorid').append('<option value="2">'  + 'Causa com impacto no problema e que possivelmente está ocorrendo</option>');
          }
        }


           var act = this.atuar;
         if (act == 1) {
     $('#actuar').append('<option value="' + this.atuar + '">'  + 'Sim</option>');
     $('#actuar').append('<option value="2">'  + 'Não</option>');
        }else{
          if(act == 2){
            $('#actuar').append('<option value="' + this.atuar + '">'  + 'Não</option>');
            $('#actuar').append('<option value="1">'  + 'Sim</option>');
            
          }
        }

   });
  });
});

</script>