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

         $sql_code5 = "SELECT * FROM indicadordepartamental";
        $sql_query2 = $mysqli->query($sql_code5) or die($mysqli->error);
        $linhatabela2 = $sql_query2->fetch_assoc();

         $sql_code6 = "SELECT anob FROM indicadordepartamental GROUP BY 1";
        $sql_query6 = $mysqli->query($sql_code6) or die($mysqli->error);
        $linhatabela6 = $sql_query6->fetch_assoc();





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
              $resultmes = $_POST['resultmes'];
              $tranformedrm = (double)str_replace(',', '.', $resultmes);
              $resultacum = $_POST['resultacum'];
              $tranformedra = (double)str_replace(',', '.', $resultacum);

              $sql_code= "INSERT INTO resultmensal(
            cod_org,id_inddep,anob,mes_ref, result_mes, result_acum)

            VALUES(
            '$resgateagain',
            '$resgate',
            '$_SESSION[anob]',   
            '$_SESSION[mesrf]',
            '$tranformedrm',
            '$tranformedra')";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);

          $correct = "Resultados cadastrado com sucesso.";
          $acc++;
        }else{
          $correct = "Houve algum erro no cadastro";
          $acc++;
        }

}

?>
<!-- IMPORTA O JQUERY -->
  <script  src="https://code.jquery.com/jquery-3.1.1.min.js" 
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
   crossorigin="anonymous"></script>

<center>
<div id="resultadosmensais" style="width: 400px;">
<h1>Atualizar Resultados Mensais</h1>
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

  <p class=espaco></p>

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
 <option value="<?php  echo $linhatabela6['anob']; ?>"> <?php echo $linhatabela6['anob'];?></option>

  <?php } while($linhatabela6 = $sql_query6->fetch_assoc());  ?>
  </select>
  <p class=espaco></p>

 <label for="descinddep"> Indicador Departamental</label>
  <select name="descinddep"  id="descinddep" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
 
  </select>
  <p class=espaco></p>

 

  <label for="mesrf">Mês Referencial</label>
    <select name="mesrf" required class="form form-control" style="text-align: center;">
          <option value="">Selecione</option>
          <option value="Janeiro">Janeiro</option>
          <option value="Fevereiro">Fevereiro</option>
          <option value="Marco">Março</option>
          <option value="Abril">Abril</option>
          <option value="Maio">Maio</option>
          <option value="Junho">Junho</option>
          <option value="Julho">Julho</option>
          <option value="Agosto">Agosto</option>
          <option value="Setembro">Setembro</option>
          <option value="Outubro">Outubro</option>
          <option value="Novembro">Novembro</option>
          <option value="Dezembro">Dezembro</option>
    </select>
    <p class=espaco></p>
  Não insira virgula no campo abaixo, apenas ponto. Ex:1000.50
  <p class=espaco></p>
  <label for="resultmes">Resultado do Mês</label>
  <input name="resultmes" required value="" type="numeric" class="form form-control" style="text-align: center;" id="resultmes">
  <p class=espaco></p>

  <label for="resultacum">Resultado Acumulado</label>
  <input name="resultacum" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="resultacum">
  <p class=espaco></p>

<input name="recebeacumulativo" required   value="" type="numeric"  id="recebeacumulativo" hidden="true"> 



    <input value="Cadastrar" name="confirmar" type="submit" class ="btn btn-success">
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

$('#descinddep').on('mouseout',function(){
var valor = $(this).val();

$.post('paginas/reqacumulativo.php', {valorSelect: valor}, function(data) {
   $('#recebeacumulativo').html('');

    $.each($.parseJSON(data), function(){
      document.getElementById("recebeacumulativo").value = this.acumulativo;
    





    });
  });

});

$('#resultmes').on('mouseout', function(){
var valor = document.getElementById("descinddep").value;
var recebeorgao = document.getElementById("descorgao").value;
var rmes = document.getElementById("resultmes").value;

$.post('paginas/reqsomaresultado.php', {valorSelect: valor, recebeOrgao: recebeorgao}, function(data){
    $('#resultacum').html('');

      $.each($.parseJSON(data), function(){
       var acum  = document.getElementById("recebeacumulativo").value;
        var a = this.somaresultmes;
        if(a == null){
          a = 0.0;     
        }
        if(acum == 1){
         var resultfinal = parseFloat(rmes) + parseFloat(a);
         document.getElementById("resultacum").value = resultfinal;
       }


       if(acum == 2){

        $("#resultacum").removeAttr('readonly');
       }

        if(acum == 3){

        $("#resultacum").removeAttr('readonly');
       }
      
    });


  });


});
//////////-----------------------------------

$('#resultmes').on('keypress', function(){
var valor = document.getElementById("descinddep").value;
var recebeorgao = document.getElementById("descorgao").value;
var rmes = document.getElementById("resultmes").value;

$.post('paginas/reqsomaresultado.php', {valorSelect: valor, recebeOrgao: recebeorgao}, function(data){
    $('#resultacum').html('');

      $.each($.parseJSON(data), function(){
       var acum  = document.getElementById("recebeacumulativo").value;
        var a = this.somaresultmes;
        if(a == null){
          a = 0.0;     
        }
        if(acum == 1){
         var resultfinal = parseFloat(rmes) + parseFloat(a);
         document.getElementById("resultacum").value = resultfinal;
       }


       if(acum == 2){

        $("#resultacum").removeAttr('readonly');
       }

        if(acum == 3){

        $("#resultacum").removeAttr('readonly');
       }
      
    });


  });


});


/*$('#resultmes').on('mouseout', function(){
var valor = document.getElementById("descinddep").value;
var recebeorgao = document.getElementById("descorgao").value;
var rmes = document.getElementById("resultmes").value;

$.post('paginas/reqmediaresultado.php', {valorSelect: valor, recebeOrgao: recebeorgao}, function(data){
    $('#resultacum').html('');

      $.each($.parseJSON(data), function(){
       var acum  = document.getElementById("recebeacumulativo").value;
        var a = this.mediaresultmes;
        if(a == null){
          a = 0.0;

          var resultfinal = (parseFloat(rmes) + parseFloat(a))/1;
         document.getElementById("resultacum").value = resultfinal;

        }else{
        if(acum == 3){
         var resultfinal = (parseFloat(rmes) + parseFloat(a))/;
         document.getElementById("resultacum").value = resultfinal;
       }
     }
      
    });


  });


});*/


</script>


