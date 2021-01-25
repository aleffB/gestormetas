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

       $sql_code3="SELECT id_inddep, melhor_traj FROM indicadordepartamental WHERE id_inddep = '$iddep'";
       $show3 = $mysqli->query($sql_code3) or die($mysqli->error);
       $linha = $show3->fetch_assoc();

       $resgate = $linha['id_inddep'];
       $mtraj = $linha['melhor_traj'];

    foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);


            if( $resgateagain == $codorg  && $resgate == $iddep ){
              $recebefx1 = $_POST['metames'];
        $valor = (double)str_replace(',', '.', $recebefx1);
        $recebefx2faixa = $_POST['tolmetames'];
        $valor2 = (double)str_replace(',', '.', $recebefx2faixa);
        $recebefx2crescente = $valor * 0.95;
        $recebefx2decrescente = $valor * 1.05;
         //------------------------------
            $recebefx1fev = $_POST['metames2'];
        $fev = (double)str_replace(',', '.', $recebefx1fev);
        $recebefx2faixafev = $_POST['tolmetames2'];
        $fev2 = (double)str_replace(',', '.', $recebefx2faixafev);
        $recebefx2crescentefev = $fev * 0.95;
        $recebefx2decrescentefev = $fev * 1.05;
        //------------------------------
            $recebefx1mar = $_POST['metames3'];
        $mar = (double)str_replace(',', '.', $recebefx1mar);
        $recebefx2faixamar = $_POST['tolmetames3'];
        $mar2 = (double)str_replace(',', '.', $recebefx2faixamar);
        $recebefx2crescentemar = $mar * 0.95;
        $recebefx2decrescentemar = $mar * 1.05;



        //------------------------------
            $recebefx1abr = $_POST['metames4'];
        $abr = (double)str_replace(',', '.', $recebefx1abr);
        $recebefx2faixaabr = $_POST['tolmetames4'];
        $abr2 = (double)str_replace(',', '.', $recebefx2faixaabr);
        $recebefx2crescenteabr = $abr * 0.95;
        $recebefx2decrescenteabr = $abr * 1.05;


        //------------------------------
            $recebefx1mai = $_POST['metames5'];
        $mai = (double)str_replace(',', '.', $recebefx1mai);
        $recebefx2faixamai = $_POST['tolmetames5'];
        $mai2 = (double)str_replace(',', '.', $recebefx2faixamai);
        $recebefx2crescentemai = $mai * 0.95;
        $recebefx2decrescentemai = $mai * 1.05;


        //------------------------------

            $recebefx1jun = $_POST['metames6'];
        $jun = (double)str_replace(',', '.', $recebefx1jun);
        $recebefx2faixajun = $_POST['tolmetames6'];
        $jun2 = (double)str_replace(',', '.', $recebefx2faixajun);
        $recebefx2crescentejun = $jun * 0.95;
        $recebefx2decrescentejun = $jun * 1.05;
        //------------------------------

            $recebefx1jul = $_POST['metames7'];
        $jul = (double)str_replace(',', '.', $recebefx1jul);
        $recebefx2faixajul = $_POST['tolmetames7'];
        $jul2 = (double)str_replace(',', '.', $recebefx2faixajul);
        $recebefx2crescentejul = $jul * 0.95;
        $recebefx2decrescentejul = $jul * 1.05;
        //------------------------------
            $recebefx1ago = $_POST['metames8'];
        $ago = (double)str_replace(',', '.', $recebefx1ago);
        $recebefx2faixaago = $_POST['tolmetames8'];
        $ago2 = (double)str_replace(',', '.', $recebefx2faixaago);
        $recebefx2crescenteago = $ago * 0.95;
        $recebefx2decrescenteago = $ago * 1.05; 

        //------------------------------

            $recebefx1set = $_POST['metames9'];
        $set = (double)str_replace(',', '.', $recebefx1set);
        $recebefx2faixaset = $_POST['tolmetames9'];
        $set2 = (double)str_replace(',', '.', $recebefx2faixaset);
        $recebefx2crescenteset = $set * 0.95;
        $recebefx2decrescenteset = $set * 1.05;
        //------------------------------
            $recebefx1out = $_POST['metames10'];
        $out = (double)str_replace(',', '.', $recebefx1out);
        $recebefx2faixaout = $_POST['tolmetames10'];
        $out2 = (double)str_replace(',', '.', $recebefx2faixaout);
        $recebefx2crescenteout = $out * 0.95;
        $recebefx2decrescenteout = $out * 1.05;

        //------------------------------

            $recebefx1nov = $_POST['metames11'];
        $nov = (double)str_replace(',', '.', $recebefx1nov);
        $recebefx2faixanov = $_POST['tolmetames11'];
        $nov2 = (double)str_replace(',', '.', $recebefx2faixanov);
        $recebefx2crescentenov = $nov * 0.95;
        $recebefx2decrescentenov = $nov * 1.05;
        //------------------------------

            $recebefx1dez = $_POST['metames12'];
        $dez = (double)str_replace(',', '.', $recebefx1dez);
        $recebefx2faixadez = $_POST['tolmetames12'];
        $dez2 = (double)str_replace(',', '.', $recebefx2faixadez);
        $recebefx2crescentedez = $dez * 0.95;
        $recebefx2decrescentedez = $dez * 1.05;
        //------------------------------

        $recidmetamensal = $_POST['idmetamensal'];
          if($mtraj==1){
              $sql_code= "UPDATE metamensal SET 
             metames = '$valor',
            toleranciameta = '$recebefx2crescente',
            metamesfev = '$fev',
            toleranciametafev ='$recebefx2crescentefev',
            metamesmar ='$mar',
            toleranciametamar ='$recebefx2crescentemar',
            metamesabr ='$abr',
            toleranciametaabr ='$recebefx2crescenteabr',
            metamesmai ='$mai',
            toleranciametamai ='$recebefx2crescentemai',
            metamesjun ='$jun',
            toleranciametajun ='$recebefx2crescentejun',
            metamesjul ='$jul',
            toleranciametajul ='$recebefx2crescentejul',
            metamesago ='$ago',
            toleranciametaago ='$recebefx2crescenteago',
            metamesset ='$set',
            toleranciametaset ='$recebefx2crescenteset',
            metamesout ='$out',
           toleranciametaout = '$recebefx2crescenteout',
            metamesnov ='$nov',
            toleranciametanov ='$recebefx2crescentenov',
            metamesdez ='$dez',
            toleranciametadez ='$recebefx2crescentedez'
            WHERE id_metamensal = '$recidmetamensal' ";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);

          $correct = "Resultados cadastrado com sucesso.";
          $acc++;}else{
            if($mtraj==2){

                $sql_code= "UPDATE metamensal SET
            
            metames ='$valor',
            toleranciameta ='$valor2',
            metamesfev ='$fev',
            toleranciametafev ='$fev2',
            metamesmar ='$mar',
            toleranciametamar ='$mar2',
            metamesabr ='$abr',
            toleranciametaabr ='$abr2',
            metamesmai ='$mai',
            toleranciametamai ='$mai2',
            metamesjun ='$jun',
            toleranciametajun ='$jun2',
            metamesjul ='$jul',
            toleranciametajul ='$jul2',
            metamesago ='$ago',
            toleranciametaago ='$ago2',
            metamesset ='$set',
            toleranciametaset ='$set2',
            metamesout ='$out',
            toleranciametaout ='$out2',
            metamesnov ='$nov',
            toleranciametanov ='$nov2',
            metamesdez ='$dez',
            toleranciametadez ='$dez2'
            WHERE id_metamensal = '$recidmetamensal' ";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);

          $correct = "Resultados cadastrado com sucesso.";

             $acc++;}else{

                $sql_code= "UPDATE metamensal SET
  
            metames ='$valor',
            toleranciameta ='$recebefx2decrescente',
            metamesfev ='$fev',
            toleranciametafev ='$recebefx2decrescentefev',
            metamesmar ='$mar',
            toleranciametamar ='$recebefx2decrescentemar',
            metamesabr ='$abr',
            toleranciametaabr ='$recebefx2decrescenteabr',
            metamesmai ='$mai',
            toleranciametamai ='$recebefx2decrescentemai',
            metamesjun ='$jun',
            toleranciametajun ='$recebefx2decrescentejun',
            metamesjul ='$jul',
            toleranciametajul ='$recebefx2decrescentejul',
            metamesago ='$ago',
            toleranciametaago ='$recebefx2decrescenteago',
            metamesset ='$set',
            toleranciametaset ='$recebefx2decrescenteset',
            metamesout ='$out',
            toleranciametaout ='$recebefx2decrescenteout',
            metamesnov ='$nov',
            toleranciametanov ='$recebefx2decrescentenov',
            metamesdez ='$dez',
            toleranciametadez ='$recebefx2decrescentedez'
             WHERE id_metamensal = '$recidmetamensal'";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);

          $correct = "Resultados cadastrado com sucesso.";
           $acc++;

            }
          }

        }else{
          $correct = "Houve algum erro no cadastro";
          $acc++;
        }



}

if(isset($_POST['delete'])){

  foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
    $sql_code = "DELETE FROM metasmensais WHERE id_metamensal = '$recidmetamensal'";
      $deletarT = $mysqli->query($sql_code) or die($mysqli->error);
      echo "Deletado com sucesso";

  }

?>
<!-- IMPORTA O JQUERY -->
  <script  src="https://code.jquery.com/jquery-3.1.1.min.js" 
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
   crossorigin="anonymous"></script>
<center>
<div id="metasmensais" style="width: 400px;">
<h1>Atualizar Metas Mensais</h1>
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

  <input type="number" name="idmetamensal" id="idmetamensal" hidden="true">
 
  </select>
  <p class=espaco></p>
  Escrever nos campos números juntos, colocar vírgula apenas para casa decimais
  Ex: 1000
  <br>
  Ex:1000,15
  </center>
  
  <div>
  <br>
  <table border=1 cellpadding=10 class="table">
 <tr class= titulo>
   <td>Meses:</td>
   <td>Jan</td> 
   <td>Fev</td> 
   <td>Mar</td> 
   <td>Abr</td> 
   <td>Mai</td> 
   <td>Jun</td> 
   <td>Jul</td>
   <td>Ago</td> 
   <td>Set</td> 
   <td>Out</td> 
   <td>Nov</td> 
   <td>Dez</td> 
 </tr> 

 <tr class= titulo>
   <td>Meta:</td>
   <td><input name="metames" id="metames" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 300px"></td> 
   <td><input name="metames2" id="metames2" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
   <td><input name="metames3" id="metames3" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
   <td><input name="metames4" id="metames4" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
   <td><input name="metames5" id="metames5" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
   <td><input name="metames6" id="metames6" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
   <td> <input name="metames7" id="metames7" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
    <td><input name="metames8" id="metames8" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
   <td><input name="metames9" id="metames9" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
   <td><input name="metames10" id="metames10" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
    <td><input name="metames11" id="metames11" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 
   <td><input name="metames12" id="metames12" required value="" type="numeric" class="form form-control" style="text-align: center;" style="width: 100px"></td> 

   <tr class= titulo>
   <td>Tolerancia:</td>
   <td><input name="tolmetames" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm" style="width: 100px"></td> 
   <td><input name="tolmetames2" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm2" style="width: 100px"></td> 
   <td><input name="tolmetames3" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm3" style="width: 100px"></td> 
   <td><input name="tolmetames4" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm4" style="width: 100px"></td> 
   <td><input name="tolmetames5" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm5" style="width: 100px"></td> 
   <td><input name="tolmetames6" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm6" style="width: 100px"></td> 
   <td><input name="tolmetames7" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm7" style="width: 100px"></td>
   <td><input name="tolmetames8" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm8" style="width: 100px"></td> 
   <td><input name="tolmetames9" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm9" style="width: 100px"></td> 
   <td><input name="tolmetames10" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm10" style="width: 100px"></td> 
   <td><input name="tolmetames11" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm11" style="width: 100px"></td> 
   <td><input name="tolmetames12" required value="" type="numeric" class="form form-control" style="text-align: center;" readonly="true" id="tlmm12" style="width: 100px"></td> 
 </tr> 


   
 </tr>   

 </tr>
</table>
</div>


  <input name="mj"  value="" type="numeric" id="mj" hidden="true" >
  <center>
    <input value="Atulizar" name="confirmar" type="submit" class ="btn btn-success">
     <p class=espaco></p>
    <input value="Deletar" name="delete" type="submit" class ="btn btn-danger">
    </center>

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
 var valor = document.getElementById("descinddep").value;
    $.post('paginas/fxindorg.php', {valorSelect: valor}, function(data) {
              
        

         $.each($.parseJSON(data), function(){  
           
     var des =  document.getElementById("mj").value = this.melhor_traj;
     if(des== 2){

       $("#tlmm").removeAttr('readonly');
       $("#tlmm2").removeAttr('readonly');
       $("#tlmm3").removeAttr('readonly');
       $("#tlmm4").removeAttr('readonly');
       $("#tlmm5").removeAttr('readonly');
       $("#tlmm6").removeAttr('readonly');
       $("#tlmm7").removeAttr('readonly');
       $("#tlmm8").removeAttr('readonly');
       $("#tlmm9").removeAttr('readonly');
       $("#tlmm10").removeAttr('readonly');
       $("#tlmm11").removeAttr('readonly');
       $("#tlmm12").removeAttr('readonly');

     }

     if(des== 1){
      $("#tlmm").attr('readonly','readonly');
      $("#tlmm2").attr('readonly','readonly');
       $("#tlmm3").attr('readonly','readonly');
       $("#tlmm4").attr('readonly','readonly');
       $("#tlmm5").attr('readonly','readonly');
       $("#tlmm6").attr('readonly','readonly');
       $("#tlmm7").attr('readonly','readonly');
       $("#tlmm8").attr('readonly','readonly');
       $("#tlmm9").attr('readonly','readonly');
       $("#tlmm10").attr('readonly','readonly');
       $("#tlmm11").attr('readonly','readonly');
       $("#tlmm12").attr('readonly','readonly');
     }

     if(des== 3){
      $("#tlmm").attr('readonly','readonly');
       $("#tlmm2").attr('readonly','readonly');
       $("#tlmm3").attr('readonly','readonly');
       $("#tlmm4").attr('readonly','readonly');
       $("#tlmm5").attr('readonly','readonly');
       $("#tlmm6").attr('readonly','readonly');
       $("#tlmm7").attr('readonly','readonly');
       $("#tlmm8").attr('readonly','readonly');
       $("#tlmm9").attr('readonly','readonly');
       $("#tlmm10").attr('readonly','readonly');
       $("#tlmm11").attr('readonly','readonly');
       $("#tlmm12").attr('readonly','readonly');
     }


     });
   });
 });

$('#descinddep').on('click', function(){
 var valor = document.getElementById("descinddep").value;
    $.post('paginas/fxindorg.php', {valorSelect: valor}, function(data) {
              
        

         $.each($.parseJSON(data), function(){  
           
     var des =  document.getElementById("mj").value = this.melhor_traj;
     if(des== 2){

       $("#tlmm").removeAttr('readonly');
       $("#tlmm2").removeAttr('readonly');
       $("#tlmm3").removeAttr('readonly');
       $("#tlmm4").removeAttr('readonly');
       $("#tlmm5").removeAttr('readonly');
       $("#tlmm6").removeAttr('readonly');
       $("#tlmm7").removeAttr('readonly');
       $("#tlmm8").removeAttr('readonly');
       $("#tlmm9").removeAttr('readonly');
       $("#tlmm10").removeAttr('readonly');
       $("#tlmm11").removeAttr('readonly');
       $("#tlmm12").removeAttr('readonly');
     }

     if(des== 1){
      $("#tlmm").attr('readonly','readonly');
      $("#tlmm2").attr('readonly','readonly');
       $("#tlmm3").attr('readonly','readonly');
       $("#tlmm4").attr('readonly','readonly');
       $("#tlmm5").attr('readonly','readonly');
       $("#tlmm6").attr('readonly','readonly');
       $("#tlmm7").attr('readonly','readonly');
       $("#tlmm8").attr('readonly','readonly');
       $("#tlmm9").attr('readonly','readonly');
       $("#tlmm10").attr('readonly','readonly');
       $("#tlmm11").attr('readonly','readonly');
       $("#tlmm12").attr('readonly','readonly');
     }

     if(des== 3){
      $("#tlmm").attr('readonly','readonly');
      $("#tlmm2").attr('readonly','readonly');
       $("#tlmm3").attr('readonly','readonly');
       $("#tlmm4").attr('readonly','readonly');
       $("#tlmm5").attr('readonly','readonly');
       $("#tlmm6").attr('readonly','readonly');
       $("#tlmm7").attr('readonly','readonly');
       $("#tlmm8").attr('readonly','readonly');
       $("#tlmm9").attr('readonly','readonly');
       $("#tlmm10").attr('readonly','readonly');
       $("#tlmm11").attr('readonly','readonly');
       $("#tlmm12").attr('readonly','readonly');
     }


     });
   });
 });



$('#anobase').on('mouseout', function(){
   var valor = document.getElementById("anobase").value;
   var recebeorgao = document.getElementById("descorgao").value;

    $.post('paginas/reqmetamensal.php', {valorSelect: valor, recebeOrgao: recebeorgao}, function(data) {
      $('#metames').html('');
      $('#metames2').html('');
      $('#metames3').html('');
      $('#metames4').html('');
      $('#metames5').html('');
      $('#metames6').html('');
      $('#metames7').html('');
      $('#metames8').html('');
      $('#metames9').html('');
      $('#metames10').html('');
      $('#metames11').html('');
      $('#metames12').html('');
      $('#tlmm').html('');
      $('#tlmm2').html('');
      $('#tlmm3').html('');
      $('#tlmm4').html('');
      $('#tlmm5').html('');
      $('#tlmm6').html('');
      $('#tlmm7').html('');
      $('#tlmm8').html('');
      $('#tlmm9').html('');
      $('#tlmm10').html('');
      $('#tlmm11').html('');
      $('#tlmm12').html('');
      $('#idmetamensal').html('');
        

        
        

         $.each($.parseJSON(data), function(){  
          document.getElementById("idmetamensal").value = this.id_metamensal;
          document.getElementById("metames").value = this.metames;
          document.getElementById("metames2").value = this.metamesfev;
          document.getElementById("metames3").value = this.metamesmar; 
          document.getElementById("metames4").value = this.metamesabr;
          document.getElementById("metames5").value = this.metamesmai;
          document.getElementById("metames6").value = this.metamesjun;
          document.getElementById("metames7").value = this.metamesjul;
          document.getElementById("metames8").value = this.metamesago;
          document.getElementById("metames9").value = this.metamesset;
          document.getElementById("metames10").value = this.metamesout;
          document.getElementById("metames11").value = this.metamesnov;
          document.getElementById("metames12").value = this.metamesdez;
          document.getElementById("tlmm").value = this.toleranciameta;
          document.getElementById("tlmm2").value = this.toleranciametafev;
          document.getElementById("tlmm3").value = this.toleranciametamar;
          document.getElementById("tlmm4").value = this.toleranciametaabr;
          document.getElementById("tlmm5").value = this.toleranciametamai;
          document.getElementById("tlmm6").value = this.toleranciametajun;
          document.getElementById("tlmm7").value = this.toleranciametajul;
          document.getElementById("tlmm8").value = this.toleranciametaago;
          document.getElementById("tlmm9").value = this.toleranciametaset;
          document.getElementById("tlmm10").value = this.toleranciametaout;
          document.getElementById("tlmm11").value = this.toleranciametanov;
          document.getElementById("tlmm12").value = this.toleranciametadez;


           


     });
   });
 });

$('#anobase').on('click', function(){
   var valor = document.getElementById("anobase").value;
   var recebeorgao = document.getElementById("descorgao").value;

    $.post('paginas/reqmetamensal.php', {valorSelect: valor, recebeOrgao: recebeorgao}, function(data) {
      $('#metames').html('');
      $('#metames2').html('');
      $('#metames3').html('');
      $('#metames4').html('');
      $('#metames5').html('');
      $('#metames6').html('');
      $('#metames7').html('');
      $('#metames8').html('');
      $('#metames9').html('');
      $('#metames10').html('');
      $('#metames11').html('');
      $('#metames12').html('');
      $('#tlmm').html('');
      $('#tlmm2').html('');
      $('#tlmm3').html('');
      $('#tlmm4').html('');
      $('#tlmm5').html('');
      $('#tlmm6').html('');
      $('#tlmm7').html('');
      $('#tlmm8').html('');
      $('#tlmm9').html('');
      $('#tlmm10').html('');
      $('#tlmm11').html('');
      $('#tlmm12').html('');
       $('#idmetamensal').html('');
        

        
        

         $.each($.parseJSON(data), function(){  
          document.getElementById("idmetamensal").value = this.id_metamensal;
          document.getElementById("metames").value = this.metames;
          document.getElementById("metames2").value = this.metamesfev;
          document.getElementById("metames3").value = this.metamesmar; 
          document.getElementById("metames4").value = this.metamesabr;
          document.getElementById("metames5").value = this.metamesmai;
          document.getElementById("metames6").value = this.metamesjun;
          document.getElementById("metames7").value = this.metamesjul;
          document.getElementById("metames8").value = this.metamesago;
          document.getElementById("metames9").value = this.metamesset;
          document.getElementById("metames10").value = this.metamesout;
          document.getElementById("metames11").value = this.metamesnov;
          document.getElementById("metames12").value = this.metamesdez;
          document.getElementById("tlmm").value = this.toleranciameta;
          document.getElementById("tlmm2").value = this.toleranciametafev;
          document.getElementById("tlmm3").value = this.toleranciametamar;
          document.getElementById("tlmm4").value = this.toleranciametaabr;
          document.getElementById("tlmm5").value = this.toleranciametamai;
          document.getElementById("tlmm6").value = this.toleranciametajun;
          document.getElementById("tlmm7").value = this.toleranciametajul;
          document.getElementById("tlmm8").value = this.toleranciametaago;
          document.getElementById("tlmm9").value = this.toleranciametaset;
          document.getElementById("tlmm10").value = this.toleranciametaout;
          document.getElementById("tlmm11").value = this.toleranciametanov;
          document.getElementById("tlmm12").value = this.toleranciametadez;


           


     });
   });
 });



</script>


