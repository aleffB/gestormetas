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

        $sql_code8 = "SELECT * FROM orgaos";
        $sql_query8 = $mysqli->query($sql_code8) or die($mysqli->error);
        $linhatabela8 = $sql_query8->fetch_assoc();
        }else{
          $sql_code4 = "SELECT * FROM orgaos WHERE id_orgao = '$orgao'";
        $sql_query = $mysqli->query($sql_code4) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();

         $sql_code8 = "SELECT * FROM orgaos WHERE id_orgao = '$orgao'";
        $sql_query8 = $mysqli->query($sql_code8) or die($mysqli->error);
        $linhatabela8 = $sql_query8->fetch_assoc();
       }

         $sql_code5 = "SELECT anob FROM indicadordepartamental GROUP BY 1";
        $sql_query2 = $mysqli->query($sql_code5) or die($mysqli->error);
        $linhatabela2 = $sql_query2->fetch_assoc();

         $sql_code7 = "SELECT anob FROM indicadordepartamental GROUP BY 1";
        $sql_query7 = $mysqli->query($sql_code7) or die($mysqli->error);
        $linhatabela7 = $sql_query7->fetch_assoc();





        if(isset($_POST['confirmar'])){
      
    
       

    foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);

          
              $recorgao = $_POST['reccodorgao'];
              $recanob = $_POST['recanobase'];
              $recinddep = $_POST['recinddep'];
              $recdescacao = $_POST['descacao'];
              $recdtip = $_POST['dtip'];
              $recdttp = $_POST['dttp'];
              $recdtir= $_POST['dtir'];
              $recdttr = $_POST['dttr'];
              $recrespon = $_POST['response'];
              $recseque = $_POST['valor'];
              $reciplanoacao = $_POST['idplanoacao'];
              $recstatus = $_POST['status'];


              $sql_code= "UPDATE planoacao SET

              cod_org = '$recorgao',
              id_inddep = '$recinddep',
              anob = '$recanob',
              desc_acao = '$recdescacao',
              date_iniciop = '$recdtip',
              date_terminop = '$recdttp',
              date_inicior = '$recdtir',
              date_terminor = '$recdttr',
              responsavel = '$recrespon',
              status = '$recstatus',
              sequencia = '$recseque'
              WHERE id_planoacao = '$reciplanoacao'";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);

          $correct = "Plano cadastrado com sucesso.";
          $acc++;
       

}


        if(isset($_POST['delete'])){
      
    
       

    foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);

    $sql_code = "DELETE FROM planoacao WHERE id_planoacao = '$reciplanoacao'";
      $deletarT = $mysqli->query($sql_code) or die($mysqli->error);
      echo "Deletado com sucesso";
  
        

}


 ?>

<!-- IMPORTA O JQUERY -->
  <script  src="https://code.jquery.com/jquery-3.1.1.min.js" 
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
   crossorigin="anonymous"></script>


<center>
<div id="planoacao" style="width: 400px;">
<h1>Atualizar Plano de Ação</h1>
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

--------------------------------------------------------------------------------
 <label for="reccodorgao">Código orgão:</label>
    <select name="reccodorgao" class="form form-control" style="text-align: center;" id="reccodorgao">
     
    </select>
    <p class=espaco></p>

     <label for="recanobase">Ano base:</label>
    <select name="recanobase" class="form form-control" style="text-align: center;" id="recanobase">
      
    </select>
    <p class=espaco></p>

     <label for="recinddep">Indicador departamental:</label>
    <select name="recinddep" class="form form-control" style="text-align: center;" id="recinddep" >
     
    </select>
    <p class=espaco></p>

    <label for="codacao">Código da Ação</label>
  <input name="codacao" required value="" type="numeric" class="form form-control" style="text-align: center;" id="codacao">
  <p class=espaco></p>

  <label for="descacao">Descrição da Ação</label>
  <input name="descacao" required value="" type="text" class="form form-control" style="text-align: center;" id="descacao">
  <p class=espaco></p>

  <label for="dtip">Data ínicio Previsto:</label>
    <input name="dtip" value="" required type="date" class="form form-control" style="text-align: center;" id="dtip">
    <p class=espaco></p>

    <label for="dttp">Data Término Previsto:</label>
    <input name="dttp" value="" required type="date" class="form form-control" style="text-align: center;" id="dttp">
    <p class=espaco></p>


  <label for="dtir">Data ínicio Real:</label>
    <input name="dtir" value="" required type="date" class="form form-control" style="text-align: center;" id="dtir">
    <p class=espaco></p>

    <label for="dttr">Data Término Real:</label>
    <input name="dttr" value="" required type="date" class="form form-control" style="text-align: center;" id="dttr">
    <p class=espaco></p>


     <label for="response">Responsável</label>
  <input name="response" required value="" type="text" class="form form-control" style="text-align: center;" id="response">
  <p class=espaco></p>

    <label for="valor">Número da Sequência</label>
  <input name="valor" required value="" type="text" class="form form-control" style="text-align: center;" id="valor">
  <p class=espaco></p>

   <input name="idplanoacao" required value="" type="numeric" hidden="true" id="idplanoacao">

  <label for="status">Status:</label>
    <select name="status" class="form form-control" style="text-align: center;" id="status">
          <option value="">Selecione</option>
          <option value="1">Concluída</option>
          <option value="2">Em andamento</option>
          <option value="3">Em atraso</option>
          <option value="4">Não Iniciada</option>
    </select>
    <p class=espaco></p>

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

$('#descinddep').on('mouseout', function(){
   var valor = document.getElementById("anobase").value;
   var recebeorgao = document.getElementById("descorgao").value;

  $.post('paginas/reqattplanoacao.php', {valorSelect: valor, recebeOrgao: recebeorgao}, function(data) {
    $('#reccodorgao').html('');
    $('#recanobase').html('');
    $('#recinddep').html('');
    $('#descacao').html('');
    $('#dtip').html('');
    $('#dttp').html('');
    $('#dtir').html('');
    $('#dttr').html('');
    $('#dttr').html('');
    $('#response').html('');
    $('#valor').html('');
    $('#status').html('');
    
    $.each($.parseJSON(data), function(){
      
       $('#reccodorgao').append('<option value="' + this.cod_org + '">' + this.cod_org + '</option>');
       $('#reccodorgao').append('<?php do{ ?><option value="<?php echo $linhatabela8['cod_orgao']; ?>">' +'<?php echo $linhatabela8['desc_orgao'].':'.$linhatabela8['cod_orgao']; ?></option> <?php }while($linhatabela8 = $sql_query8->fetch_assoc()); ?>');
     
      document.getElementById("idplanoacao").value = this.id_planoacao ;
     $('#recinddep').append('<option value="' + this.id_inddep + '">' + this.desc_inddep + '</option>');
     document.getElementById("descacao").value = this.desc_acao ;
     document.getElementById("codacao").value = this.cod_acao ;
     $('#recanobase').append('<option value="' + this.anob + '">' + this.anob + '</option>');
     $('#recanobase').append('<?php do{ ?><option value="<?php echo $linhatabela7['anob']; ?>">' +'<?php echo $linhatabela7['anob']; ?></option> <?php }while($linhatabela7 = $sql_query7->fetch_assoc()); ?>');
      document.getElementById("dtip").value = this.date_iniciop;
      document.getElementById("dttp").value = this.date_terminop;
      document.getElementById("dtir").value = this.date_inicior;
      document.getElementById("dttr").value = this.date_terminor;
      document.getElementById("response").value = this.responsavel;
      document.getElementById("valor").value = this.sequencia;

             var recstatus = this.status;
         if (recstatus == 1) {
     $('#status').append('<option value="' + this.status + '">'  + 'Concluída</option>');
     $('#status').append('<option value="2">'  + 'Em andamento</option>');
     $('#status').append('<option value="3">'  + 'Em atraso</option>');
     $('#status').append('<option value="4">'  + 'Não iniciada</option>');
        }else{
          if(recstatus == 2){
            $('#status').append('<option value="' + this.status + '">'  + 'Em andamento</option>');
            $('#status').append('<option value="1">'  + 'Concluída</option>');
            $('#status').append('<option value="3">'  + 'Em atraso</option>');
            $('#status').append('<option value="4">'  + 'Não iniciada</option>');
          }else{
            if(recstatus == 3){
             $('#status').append('<option value="' + this.status + '">'  + 'Em atraso</option>');           
             $('#status').append('<option value="1">'  + 'Concluída</option>');
             $('#status').append('<option value="2">'  + 'Em andamento</option>');
             $('#status').append('<option value="4">'  + 'Não iniciada</option>');
         }else{

             $('#status').append('<option value="' + this.status + '">'  + 'Não iniciada</option>');           
             $('#status').append('<option value="1">'  + 'Concluída</option>');
             $('#status').append('<option value="2">'  + 'Em andamento</option>');
             $('#status').append('<option value="3">'  + 'Em atraso</option>');

                }
          }
        }


     


   });
  });
});

$('#recanobase').on('change', function(){
   var valor = $(this).val();
   var recebeorgao = document.getElementById("reccodorgao").value;

  $.post('paginas/reqindorgao.php', {valorSelect: valor, recebeOrgao: recebeorgao}, function(data) {
    $('#recinddep').html('');


   
    $.each($.parseJSON(data), function(){
     $('#recinddep').append('<option value="' + this.id_inddep + '">' + this.desc_inddep + '</option>');

   });
  });
});
</script>