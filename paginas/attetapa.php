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
        if($valid==1){
        $sql_code6 = "SELECT desc_acao,desc_acao FROM planoacao";
        $sql_query3 = $mysqli->query($sql_code6) or die($mysqli->error);
        $linhatabela3 = $sql_query3->fetch_assoc();

         $sql_code11 = "SELECT desc_acao,desc_acao FROM planoacao";
        $sql_query11 = $mysqli->query($sql_code11) or die($mysqli->error);
        $linhatabela11 = $sql_query11->fetch_assoc();
      }else{
        $codorgao = $linhatabela['cod_orgao'];
        $sql_code6 = "SELECT desc_acao FROM planoacao WHERE cod_org = '$codorgao'";
        $sql_query3 = $mysqli->query($sql_code6) or die($mysqli->error);
        $linhatabela3 = $sql_query3->fetch_assoc();

         $sql_code11 = "SELECT desc_acao FROM planoacao WHERE cod_org = '$codorgao'";
        $sql_query11 = $mysqli->query($sql_code11) or die($mysqli->error);
        $linhatabela11 = $sql_query11->fetch_assoc();

      }

          if($valid==1){
         $sql_code7 = "SELECT desc_causa FROM causa";
        $sql_query4 = $mysqli->query($sql_code7) or die($mysqli->error);
        $linhatabela4 = $sql_query4->fetch_assoc();

        $sql_code13 = "SELECT desc_causa FROM causa";
        $sql_query13 = $mysqli->query($sql_code13) or die($mysqli->error);
        $linhatabela13 = $sql_query13->fetch_assoc();
        }else{
            $codorgao = $linhatabela['cod_orgao'];
          $sql_code7 = "SELECT desc_causa FROM causa WHERE cod_org = '$codorgao'";
        $sql_query4 = $mysqli->query($sql_code7) or die($mysqli->error);
        $linhatabela4 = $sql_query4->fetch_assoc();

        $sql_code13 = "SELECT desc_causa FROM causa WHERE cod_org = '$codorgao'";
        $sql_query13 = $mysqli->query($sql_code13) or die($mysqli->error);
        $linhatabela13 = $sql_query13->fetch_assoc();

        }



        if(isset($_POST['confirmar'])){
      
      $codorg = $_POST['descorgao'];
      $iddep = $_POST['descinddep'];
      $codcausa = $_POST['codcausa'];
      $codacao = $_POST['codacao'];
      $recidetapa = $_POST['idetapa'];



       $sql_code2="SELECT cod_orgao FROM orgaos WHERE cod_orgao = '$codorg'";
       $show = $mysqli->query($sql_code2) or die($mysqli->error);
       $linhas = $show->fetch_assoc();

       $resgateagain = $linhas['cod_orgao'];

       ////

       $sql_code3="SELECT id_inddep FROM indicadordepartamental WHERE id_inddep = '$iddep'";
       $show3 = $mysqli->query($sql_code3) or die($mysqli->error);
       $linha = $show3->fetch_assoc();

       $resgate = $linha['id_inddep'];

          ////
       $sql_code8="SELECT cod_causa FROM causa WHERE cod_causa = '$codcausa'";
       $show4 = $mysqli->query($sql_code8) or die($mysqli->error);
       $linhas2 = $show4->fetch_assoc();
  
       $resgateagain4 = $linhas2['cod_causa'];
                   ////
       $sql_code9="SELECT cod_acao FROM planoacao WHERE cod_acao = '$codacao'";
       $show5 = $mysqli->query($sql_code9) or die($mysqli->error);
       $linhas3 = $show5->fetch_assoc();

       $resgateagain5 = $linhas3['cod_acao'];

    foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);


            if( $resgateagain == $codorg  && $resgate == $iddep && $resgateagain4 == $codcausa && $resgateagain5 == $codacao){
              $sql_code= "UPDATE etapa SET 
             cod_acao = '$resgateagain5',
            cod_causa = '$resgateagain4',
            cod_etapa = '$_SESSION[codetapa]',
            desc_etapa = '$_SESSION[descetapa]',
            date_iniciop = '$_SESSION[dtip]',
            date_terminop = '$_SESSION[dttp]',
            date_inicior = '$_SESSION[dtir]',
            date_terminor = '$_SESSION[dttr]',
            responsavel = '$_SESSION[response]',
            status = '$_SESSION[status]',
            sequencia = '$_SESSION[valor]'
            WHERE id_etapa = '$recidetapa';
            ";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);

          $correct = "Etapa cadastrada com sucesso.";
          $acc++;
        }else{
          $correct = "Houve algum erro no cadastro";
          $acc++;
        }

}

if(isset($_POST['delete'])){

  foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
    $sql_code = "DELETE FROM etapa WHERE id_etapa = '$recidetapa'";
      $deletarT = $mysqli->query($sql_code) or die($mysqli->error);
      echo "Deletado com sucesso";

}

 ?>

<!-- IMPORTA O JQUERY -->
  <script  src="https://code.jquery.com/jquery-3.1.1.min.js" 
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
   crossorigin="anonymous"></script>

<center>
<div id="etapa" style="width: 400px;">
<h1>Atualizar Etapa</h1>
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

  <label for="codacao"> Código Ação</label>
  <select name="codacao" required id="codacao" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
  <?php 
   do{ 
  ?>
 <option value="<?php  echo $linhatabela3['cod_acao']; ?>"> <?php echo $linhatabela3['cod_acao'].':'.$linhatabela3['desc_acao'];?></option>

  <?php } while($linhatabela3 = $sql_query3->fetch_assoc());  ?>
 
  </select>
  <p class=espaco></p>

  <label for="codcausa"> Código Causa</label>
  <select name="codcausa" required id="codcausa" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
  <?php 
   do{ 
  ?>
 <option value="<?php  echo $linhatabela4['cod_causa']; ?>"> <?php echo $linhatabela4['cod_causa'].':'.$linhatabela4['desc_causa'];?></option>

  <?php } while($linhatabela4 = $sql_query4->fetch_assoc());  ?>
 
  </select>
  <p class=espaco></p>
------------------------------------------------------------
   <p class=espaco></p>

 

  <label for="codetapa">Código da Etapa</label>
  <input name="codetapa" required value="" type="numeric"  pattern="[0-9]{4}" class="form form-control" style="text-align: center;" id="codetapa">
  <p class=espaco></p>

  <label for="descetapa">Descrição da Etapa</label>
  <input name="descetapa" id="descetapa" required value="" type="text" class="form form-control" style="text-align: center;">
  <p class=espaco></p>

  <label for="dtip">Data ínicio Previsto:</label>
    <input name="dtip" id="dtip" value="" required type="date" class="form form-control" style="text-align: center;"> 
    <p class=espaco></p>

    <label for="dttp">Data Término Previsto:</label>
    <input name="dttp" id="dttp" value="" required type="date" class="form form-control" style="text-align: center;">
    <p class=espaco></p>

    <label for="dtir">Data Ínicio Real:</label>
    <input name="dtir" id="dtir" value=""  type="date" class="form form-control" style="text-align: center;">
    <p class=espaco></p>

    <label for="dttr">Data Término Real:</label>
    <input name="dttr" id="dttr" value=""  type="date" class="form form-control" style="text-align: center;">
    <p class=espaco></p>

     <label for="response">Responsável</label>
  <input name="response" id="response" required value="" type="text" class="form form-control" style="text-align: center;">
  <p class=espaco></p>

  <label for="valor">Número da Sequência</label>
  <input name="valor" id="valor" required value="" type="text" class="form form-control" style="text-align: center;">
  <p class=espaco></p>

  <label for="status">Status:</label>
    <select name="status" id="status" class="form form-control" style="text-align: center;">
          <option value="">Selecione</option>
          <option value="1">Concluída</option>
          <option value="2">Em andamento</option>
          <option value="3">Em atraso</option>
    </select>
    <p class=espaco></p>

    <input type="numeric" name="idetapa" hidden="true" id="idetapa" required>

    <input value="Atualizar" name="confirmar" type="submit" class ="btn btn-success">
    <p class=espaco></p>
    <input value="Deletar" name="delete" type="submit" class ="btn btn-danger">

                  <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   
</form>
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

$('#anobase').on('change', function(){
   var valor = $(this).val();

  $.post('paginas/reqcodacao.php', {valorSelect: valor}, function(data) {
    $('#codacao').html('');


   
    $.each($.parseJSON(data), function(){
     $('#codacao').append('<option value="' + this.cod_acao + '">' + this.desc_acao + '</option>');

   });
  });
});

$('#anobase').on('change', function(){
   var valor = $(this).val();

  $.post('paginas/reqcodcausa.php', {valorSelect: valor}, function(data) {
    $('#codcausa').html('');


   
    $.each($.parseJSON(data), function(){
     $('#codcausa').append('<option value="' + this.cod_causa + '">' + this.desc_causa + '</option>');

   });
  });
});

/*$('#valor').on('focus', function(){
  var valor = document.getElementById("codacao").value;

  $.post('paginas/reqnumerosequencia.php', {valorSelect: valor}, function(data) {
    $('#codcausa').html('');


   
    $.each($.parseJSON(data), function(){
     document.getElementById("valor").value = this.sequencia + ".";

   });
  });
});*/


$('#codcausa').on('mouseout', function(){
  var valor = document.getElementById("anobase").value;
  var recebeorgao = document.getElementById("descorgao").value;
  var recebeacao = document.getElementById("codacao").value;
  var recebecausa = document.getElementById("codcausa").value;

  $.post('paginas/reqattetapa.php', {valorSelect: valor, recebeOrgao: recebeorgao, recebeAcao: recebeacao, recebeCausa: recebecausa }, function(data) {
    $('#codetapa').html('');
    $('#descetapa').html('');
    $('#dtip').html('');
    $('#dttp').html('');
    $('#dtir').html('');
    $('#dttr').html('');
    $('#response').html('');
    $('#valor').html('');
    $('#status').html('');
    $('#idetapa').html('');



   
    $.each($.parseJSON(data), function(){

      document.getElementById("codetapa").value = this.cod_etapa;
      document.getElementById("descetapa").value = this.desc_etapa;
      document.getElementById("dtip").value = this.date_iniciop;
      document.getElementById("dttp").value = this.date_terminop;
      document.getElementById("dtir").value = this.date_inicior;
      document.getElementById("dttr").value = this.date_terminor;
      document.getElementById("response").value = this.responsavel;
      document.getElementById("valor").value = this.sequencia;
       var stat = this.status;
      if (stat == 1) {
     $('#status').append('<option value="' + this.status + '">'  + 'Concluída</option>');
     $('#status').append('<option value="2">'  + 'Em andamento</option>');
     $('#status').append('<option value="3">'  + 'Em atraso</option>');
        }else{
          if(stat == 2){
            $('#status').append('<option value="' + this.status + '">'  + 'Em andamento</option>');                      
            $('#status').append('<option value="1">'  + 'Concluída</option>');
           $('#status').append('<option value="3">'  + 'Em atraso</option>');
          }else{
             $('#status').append('<option value="' + this.status + '">'  + 'Em atraso</option>');                                   
            $('#status').append('<option value="1">'  + 'Concluída</option>');
           $('#status').append('<option value="2">'  + 'Em andamento</option>');
          }
        }
      document.getElementById("idetapa").value = this.id_etapa;

   });
  });
});



</script>