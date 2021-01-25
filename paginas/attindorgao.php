<?php

	$acc = 0;

   if(!isset($_SESSION['nomeuser_adm']) && !isset($_SESSION['login_adm'])){
  header('Location: ?pagina=inicio');
  exit;
	}

$valid = $_SESSION['validador'];


if($valid==2){
  header('Location: ?pagina=inicial');
  exit;
}


if(isset($_POST['voltar'])){
 
 header('Location: index.php?pagina=inicio');
}




$sql_code5 = "SELECT cod_orgao,desc_orgao FROM orgaos";
        $sql_query2 = $mysqli->query($sql_code5) or die($mysqli->error);
        $linhatabela2 = $sql_query2->fetch_assoc();   

        $sql_code6 = "SELECT cod_orgao FROM indicadororgao";
        $sql_query6 = $mysqli->query($sql_code6) or die($mysqli->error);
        $linhatabela6 = $sql_query6->fetch_assoc();  

         $sql_code7 = "SELECT anob FROM indicadordepartamental GROUP BY 1";
        $sql_query7 = $mysqli->query($sql_code7) or die($mysqli->error);
        $linhatabela7 = $sql_query7->fetch_assoc();
    

      



    function get_post_action($name){
      $params = func_get_args();

      foreach ($params as $name) {
        if(isset($_POST[$name])){
          return $name;
        }
      }
    }

    switch (get_post_action('att','delete')) {

      case 'att':
   $recanob = $_POST['anobase'];
   $recinddep = $_POST['indicadordep'];
   $reccodorgao = $_POST['codorgao'];
   $recmetafx1 = $_POST['metafx1'];
   $recmetafx2 = $_POST['metafx2'];
   $recpeso = $_POST['peso'];
   $recidindorgao = $_POST['idindorgao'];
  
  

        $sql_code10 = "SELECT meta_fx1, meta_fx2 FROM indicadororgao where id_indorg = 'recidindorgao' ";
        $sql_query10 = $mysqli->query($sql_code10) or die($mysqli->error);
        $linhatabela10 = $sql_query10->fetch_assoc();
        $recfx1 = $linhatabela10['meta_fx1'];
        $recfx2 = $linhatabela10['meta_fx2'];     

      foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);

          if($recmetafx1 != $recfx1 && $recmetafx2 != $recfx2){

          $recebefx1 = $_POST['metafx1'];
          $valor = (double)str_replace(',', '.', $recebefx1);
         $recebefx2faixa = $_POST['metafx2'];
         $valor2 = (double)str_replace(',', '.', $recebefx2faixa);
         $recebefx2crescente = $valor * 0.95;
         $recebefx2decrescente = $valor * 1.05;
         $recebevalorselect = $_POST['mtj'];

    if($recebevalorselect == 1){
   $sql_code= "UPDATE indicadororgao SET
            id_inddep = '$recinddep',
            cod_orgao = '$reccodorgao',
            anob = '$recanob',
            meta_fx1 = '$valor',
            meta_fx2 = '$recebefx2crescente',
            peso = '$recpeso'
            WHERE id_indorg = '$recidindorgao' ";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);
         // $correct = "Usuario Alterado com sucesso";
           header('Location: index.php?pagina=attindorgao');
        }else{
          if($recebevalorselect == 2){
            $sql_code= "UPDATE indicadororgao SET
            id_inddep = '$recinddep',
            cod_orgao = '$reccodorgao',
            anob = '$recanob',
            meta_fx1 = '$valor',
            meta_fx2 = '$valor2',
            peso = '$recpeso'
            WHERE id_indorg = '$recidindorgao' ";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);
         // $correct = "Usuario Alterado com sucesso";
           header('Location: index.php?pagina=attindorgao');

          }else{
            if($recebevalorselect == 3){  
           $sql_code= "UPDATE indicadororgao SET
            id_inddep = '$recinddep',
            cod_orgao = '$reccodorgao',
            anob = '$recanob',
            meta_fx1 = '$valor',
            meta_fx2 = '$recebefx2decrescente',
            peso = '$recpeso'
            WHERE id_indorg = '$recidindorgao' ";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);
         // $correct = "Usuario Alterado com sucesso";
           header('Location: index.php?pagina=attindorgao');



                }
          }
       
        }



}else{


 $recebevalorselect = $_POST['mtj'];

    if($recebevalorselect == 1){
  $sql_code= "UPDATE indicadororgao SET
            id_inddep = '$recinddep',
            cod_orgao = '$reccodorgao',
            anob = '$recanob',
            meta_fx1 = '$valor',
            meta_fx2 = '$valor2',
            peso = '$recpeso'
            WHERE id_indorg = '$recidindorgao' ";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);
         // $correct = "Usuario Alterado com sucesso";
           header('Location: index.php?pagina=attindorgao');
        }else{
          if($recebevalorselect == 2){
           $sql_code= "UPDATE indicadororgao SET
            id_inddep = '$recinddep',
            cod_orgao = '$reccodorgao',
            anob = '$recanob',
            meta_fx1 = '$valor',
            meta_fx2 = '$valor2',
            peso = '$recpeso'
            WHERE id_indorg = '$recidindorgao' ";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);
         // $correct = "Usuario Alterado com sucesso";
           header('Location: index.php?pagina=attindorgao');


          }else{
            if($recebevalorselect == 3){  
          $sql_code= "UPDATE indicadororgao SET
            id_inddep = '$recinddep',
            cod_orgao = '$reccodorgao',
            anob = '$recanob',
            meta_fx1 = '$valor',
            meta_fx2 = '$valor2',
            peso = '$recpeso'
            WHERE id_indorg = '$recidindorgao' ";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);
         // $correct = "Usuario Alterado com sucesso";
           header('Location: index.php?pagina=attindorgao');



                }
          }
       
        }


}
          
  
break;

case 'delete':
  foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
    $sql_code = "DELETE FROM indicadororgao WHERE id_indorg = '$recidindorgao'";
      $deletarT = $mysqli->query($sql_code) or die($mysqli->error);
      echo "Deletado com sucesso";
  
break;

  
break;

default:
        # code...
        break;


   }


?>        
<!-- IMPORTA O JQUERY -->
  <script  src="https://code.jquery.com/jquery-3.1.1.min.js" 
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
   crossorigin="anonymous"></script>
<center>
<div id="cadorgao" style="width: 400px;">
<h1>Atulização de indicador por orgão</h1>
<!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<p class=espaco></p>
<form action="" method="POST">
<input type="submit" name="voltar" value="Voltar" class ="btn btn-primary">
</form>
<p class=espaco></p>
<form action="" method="POST">
  <?php 
    
   if($acc>0){
        echo $correct;
    }

    ?>
     <label for="buscaindempresarial"> Buscar código dos orgãos</label>
  <select name="buscaindempresarial" required id="buscaindempresarial" class="form form-control" style="text-align: center;">
   <option value="">Selecione</option>
   <?php 
   do{ 
  ?>
  <option value="<?php  echo $linhatabela2['cod_orgao']; ?>"> <?php echo $linhatabela2['desc_orgao'] .':'.$linhatabela2['cod_orgao'];?></option>
  <?php } while($linhatabela2 = $sql_query2->fetch_assoc());  ?>
  </select>
  <p class=espaco></p>

    <label for="codorgao"> Código orgão </label>
  <select name="codorgao"  class="form form-control" id="codorgao">
  <option value="">Selecione</option>
 
  </select>
  <p class=espaco></p>

   <label for="anobase"> Ano base</label>
  <select name="anobase"  class="form form-control" id="anobase">
  <option value="">Selecione</option>
 
  </select>
  <p class=espaco></p>

   <label for="indicadordep"> Indicador departamental</label>
  <select name="indicadordep"  class="form form-control" id="indicadordep">
  <option value="">Selecione</option>
 
  </select>
  <p class=espaco></p>

   

  <label for="metafx1"> Meta FX1</label>
  <input name="metafx1"  value="" type="numeric" id="fx1" class="form form-control" style="text-align: center;" >
  <p class=espaco></p>
     
  <p class=espaco></p>
  <label for="metafx2"> Meta FX2</label>
  <input name="metafx2"  value="" type="numeric" id="fx2" readonly="true" class="form form-control" style="text-align: center;">
  <p class=espaco></p>

  <label for="peso"> Peso</label>
  <input name="peso"  value="" class="form form-control" style="text-align: center;" id="peso">
  <p class=espaco></p>

   <input name="idindorgao" required value="" type="numeric" id="idindorgao" hidden="true" >

   <input name="mtj" required value="" type="numeric" id="mtj" hidden="true" >

    <input value="Atualizar" name="att" type="submit" class ="btn btn-success">
    <p class=espaco></p>
    <input value="Deletar" name="delete" type="submit" class ="btn btn-danger">

               <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</form>
</div> </center>

<p class=espaco></p>


<script type="text/javascript">


$('#buscaindempresarial').on('change', function(){
   var valor = $(this).val();


  $.post('paginas/reqindpororgao.php', {valorSelect: valor}, function(data) {
    $('#anobase').html('');
    $('#indicadordep').html('');
    $('#codorgao').html('');
    $('#fx1').html('');
    $('#fx2').html('');
    $('#peso').html('');
    $('#idindorgao').html('');
    $('#mtj').html('');



   
    $.each($.parseJSON(data), function(){
     $('#anobase').append('<option value="' + this.anob + '">' + this.anob + '</option>');
      $('#anobase').append('<?php do{ ?><option value="<?php echo $linhatabela7['anob']; ?>">' +'<?php echo $linhatabela7['anob']; ?></option> <?php }while($linhatabela7 = $sql_query7->fetch_assoc()); ?>');
     $('#indicadordep').append('<option value="' + this.id_inddep + '">' + this.desc_inddep + '</option>');
     $('#codorgao').append('<option value="' + this.cod_orgao + '">' + this.cod_orgao + '</option>');
      $('#codorgao').append('<?php do{ ?><option value="<?php echo $linhatabela6['cod_orgao']; ?>">' +'<?php echo $linhatabela6['cod_orgao']; ?></option> <?php }while($linhatabela6 = $sql_query6->fetch_assoc()); ?>');
      document.getElementById("fx1").value = this.meta_fx1;
      document.getElementById("fx2").value = this.meta_fx2;
      document.getElementById("peso").value = this.peso;
      document.getElementById("idindorgao").value = this.id_indorg;
      document.getElementById("mtj").value = this.melhor_traj;


   });
  });
});


/*$('#anobase').on('click', function(){
   var valor = $(this).val();
   var recebeorgao = document.getElementById("codorgao").value;


  $.post('paginas/reqindorgao.php', {valorSelect: valor, recebeOrgao: recebeorgao}, function(data) {
    $('#indicadordep').html('');

  
   
    $.each($.parseJSON(data), function(){
     $('#indicadordep').append('<option value="' + this.id_inddep + '">' + this.desc_inddep + '</option>');


   });
  });
});*/

$('#buscaindempresarial').on('mouseout', function(){
   var mtj = document.getElementById("mtj").value;

   if(mtj == 1){

      document.getElementById("fx2").readOnly = true;

   }

   if(mtj == 2){

      document.getElementById("fx2").readOnly = false;

   }

   if(mtj == 3){

      document.getElementById("fx2").readOnly = true;

   }


 
});

/*$('#anobase').on('change', function(){

 var valor = $(this).val();
   var recebeorgao = document.getElementById("codorgao").value;


  $.post('paginas/reqmtjindorg.php', {valorSelect: valor, recebeOrgao: recebeorgao}, function(data) {
    $('#mtj').html('');

  
    
    $.each($.parseJSON(data), function(){
      console.log(data);
    // document.getElementById("mtj").value = this.melhor_traj;


   });
  }); 
});*/






</script>
