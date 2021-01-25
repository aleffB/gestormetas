<?php 
error_reporting(0);
      ini_set(“display_errors”, 0 );

if(isset($_POST['voltar'])){
 
 header('Location: index.php?pagina=inicio');
}
 
//condicional verificando se o nome de usuário e login está na sessão 
if(!isset($_SESSION['nomeuser_adm']) && !isset($_SESSION['login_adm'])){
  //caso não esteja ele redirecionado para page inicio
  header('Location: ?pagina=inicio');
  exit;
} 

if(isset($_POST['buscar'])){

$orgao =  $_POST['descorgao'];
$inddepart = $_POST['descinddep'];
$anob =$_POST['anob'];

// SELECT PARA PREENCHIMENTO DO CABEÇALHO
$consulta = "SELECT desc_orgao FROM orgaos WHERE cod_orgao = '$orgao'";
        $sql_consulta = $mysqli->query($consulta) or die($mysqli->error);
        $resultadoconsulta = $sql_consulta->fetch_assoc();

$consulta2 = "SELECT desc_inddep,melhor_traj FROM indicadordepartamental WHERE id_inddep = '$inddepart'";
        $sql_consulta2 = $mysqli->query($consulta2) or die($mysqli->error);
        $resultadoconsulta2 = $sql_consulta2->fetch_assoc();

$consulta3 = "SELECT desc_meta, responsavel FROM meta WHERE id_inddep = '$inddepart'";
        $sql_consulta3 = $mysqli->query($consulta3) or die($mysqli->error);
        $resultadoconsulta3 = $sql_consulta3->fetch_assoc();        


        
//----------------------------------------------------

$sql_code = "SELECT * FROM resultmensal WHERE cod_orgao = '$orgao' AND id_inddep ='$inddepart' AND anob = '$anob'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        
$resultmes = array();

do{
$resultmes[] = (double)($linhatabela['result_mes']);
}while ($linhatabela = $sql_query->fetch_assoc());

$sql_code5 = "SELECT * FROM resultmensal WHERE cod_orgao = '$orgao' AND id_inddep ='$inddepart' AND anob = '$anob'";
        $sql_query5 = $mysqli->query($sql_code5) or die($mysqli->error);
        $linhatabela5 = $sql_query5->fetch_assoc();



$sql_code2 = "SELECT * from metamensal INNER JOIN indicadororgao ON metamensal.cod_org = indicadororgao.cod_orgao AND metamensal.id_inddep = indicadororgao.id_inddep INNER JOIN indicadordepartamental ON indicadordepartamental.id_inddep = indicadororgao.id_inddep WHERE cod_org ='$orgao' AND metamensal.id_inddep ='$inddepart' AND metamensal.anob = '$anob'";
        $sql_query2 = $mysqli->query($sql_code2) or die($mysqli->error);
        $linhatabela2 = $sql_query2->fetch_assoc();
       $mtj = $linhatabela2['melhor_traj'];
      
$meta = array();
$tolerancia = array();
$resultcor = array();
$metacor = '#00FF00';
$toleranciacor = '#FF0000';

$a = $linhatabela2['metames'];
$b = $linhatabela2['toleranciameta'];
$meta[] = (double)($linhatabela2['metames']);
$meta[] = (double)($linhatabela2['metamesfev']);
$meta[] = (double)($linhatabela2['metamesmar']);
$meta[] = (double)($linhatabela2['metamesabr']);
$meta[] = (double)($linhatabela2['metamesmai']);
$meta[] = (double)($linhatabela2['metamesjun']);
$meta[] = (double)($linhatabela2['metamesjul']);
$meta[] = (double)($linhatabela2['metamesago']);
$meta[] = (double)($linhatabela2['metamesset']);
$meta[] = (double)($linhatabela2['metamesout']);
$meta[] = (double)($linhatabela2['metamesnov']);
$meta[] = (double)($linhatabela2['metamesdez']);

$tolerancia[] = (double)($linhatabela2['toleranciameta']);
$tolerancia[] = (double)($linhatabela2['toleranciametafev']);
$tolerancia[] = (double)($linhatabela2['toleranciametamar']);
$tolerancia[] = (double)($linhatabela2['toleranciametaabr']);
$tolerancia[] = (double)($linhatabela2['toleranciametamai']);
$tolerancia[] = (double)($linhatabela2['toleranciametajun']);
$tolerancia[] = (double)($linhatabela2['toleranciametajul']);
$tolerancia[] = (double)($linhatabela2['toleranciametaago']);
$tolerancia[] = (double)($linhatabela2['toleranciametaset']);
$tolerancia[] = (double)($linhatabela2['toleranciametaout']);
$tolerancia[] = (double)($linhatabela2['toleranciametanov']);
$tolerancia[] = (double)($linhatabela2['toleranciametadez']);

foreach ($resultmes as $index => $rsm){
  if($mtj == 1){
    if($rsm > $meta[$index]){
     $resultcor[] = '#0000FF';
    } else if ($rsm < $meta[$index] and $rsm > $tolerancia[$index]){
      $resultcor[] = '#00FF00';
    } else {
     $resultcor[] = '#FF0000';
    }
  } else if($mtj == 2){
    if($rsm > $meta[$index]){
      $resultcor[] = '#FF0000';
    } else if ($rsm < $meta[$index] and $rsm > $tolerancia[$index]){
      $resultcor[] = '#00FF00';
    } else {
      $resultcor[] = '#FF0000';
    }
  } else {
    if($rsm > $meta[$index]){
      $resultcor[] = '#FF0000';
    } else if ($rsm < $meta[$index] and $rsm > $tolerancia[$index]){
       $resultcor[] = '#00FF00';
    } else {
      $resultcor[] = '#0000FF';
    }
  }
}

} else {
$resultmes = array();
$meta = array();
$tolerancia = array();
$resultcor = array();
$metacor = '#00FF00';
$toleranciacor = '#FF0000';
}
$orgao = $_SESSION['id_orgao'];
$valid = $_SESSION['validador'];

if($valid==1){
 $sql_code3 = "SELECT cod_orgao, desc_orgao FROM orgaos";
        $sql_query3 = $mysqli->query($sql_code3) or die($mysqli->error);
        $linhatabela3 = $sql_query3->fetch_assoc();
}else{
    $sql_code3 = "SELECT cod_orgao, desc_orgao FROM orgaos WHERE id_orgao = '$orgao'";
        $sql_query3 = $mysqli->query($sql_code3) or die($mysqli->error);
        $linhatabela3 = $sql_query3->fetch_assoc();
  }
         $sql_code4 = "SELECT anob FROM indicadordepartamental GROUP BY 1";
        $sql_query4 = $mysqli->query($sql_code4) or die($mysqli->error);
        $linhatabela4 = $sql_query4->fetch_assoc();
?>

<html>
<head>
<!-- IMPORTA O JQUERY -->
  <script  src="https://code.jquery.com/jquery-3.1.1.min.js" 
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
   crossorigin="anonymous"></script>

   

<form action="" method="POST">

<label for="anob"> Ano Base</label>
  <select name="anob" required id="anobase" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
  <?php 
   do{ 
  ?>
 <option value="<?php  echo $linhatabela4['anob']; ?>"> <?php echo $linhatabela4['anob'];?></option>

  <?php } while($linhatabela4 = $sql_query4->fetch_assoc());  ?>
  </select>
<p class=espaco></p>


  <label for="descinddep"> Indicador Departamental</label>
  <select name="descinddep"  id="descinddep" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
 
  </select>
  <p class=espaco></p>

     <label for="descorgao"> Código do Orgão</label>
  <select name="descorgao" required id="descorgao" class="form form-control" style="text-align: center;">
   <option value="">Selecione</option>
   <?php 
   do{ 
  ?>
  <option value="<?php  echo $linhatabela3['cod_orgao']; ?>"> <?php echo $linhatabela3['desc_orgao'] .':'.$linhatabela3['cod_orgao'];?></option>
  <?php } while($linhatabela3 = $sql_query3->fetch_assoc());  ?>
  </select>
  <p class=espaco></p>

  <input value="Gerar" name="buscar" type="submit" class ="btn btn-success" id="buscar">
  <p class=espaco></p>
</form>
 <input value="Imprimir" name="imp" id="print" type="submit">
<p class=espaco></p>
<form action="" method="POST">
<input type="submit" name="voltar" value="Voltar" class ="btn btn-primary">
</form>
<input type="text" id="aux" value="" hidden="true">
<div id="printable">
<table border=1 cellpadding=10 class="table" style="margin-top: 50px" id="tabela1" >
<!-- criação de uma tabela -->
 <tr class= titulo>
  <tr>
  <td style="width: 800px; text-align: center; height: 50px; font-weight:bold;" >GESTÃO ESTRATÉGICA</td>
  <td style="width: 200px;"> <img width="200px" height="50px" src="imagem/logo.jpg"></td>
</tr>
  </table>  

<table border=1 cellpadding=10 class="table" style="height: 40px;" id="tabela2">
  <td style="width: 1024px;">EMPRESA: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label style="font-weight:bold" >ELETROBRAS DISTRIBUIÇÃO ALAGOAS</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ANO: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-weight:bold" ><?php echo $anob; ?></label>  </td>
</table>

  <table border=1 cellpadding=10 class="table" style="height: 40px;" id="tabela3">
    <td style="width: 512px;height: 10px;">ÁREA: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-weight:bold"><?php if(isset($_POST['buscar'])){echo $resultadoconsulta['desc_orgao'];} ?></label></td>
    <td style="width: 488px;height: 10px;">RESPONSÁVEL: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-weight:bold"><?php if(isset($_POST['buscar'])){echo $resultadoconsulta3['responsavel'];} ?></label></td>
    <tr>
    <td style="width: 512px; text-align: center; height: 10px; ">META</td>
    <td style="width: 488px; text-align: center;height: 10px;">INDICADOR</td> 
    </tr>
  </table>

<table border=1 cellpadding=10 class="table" id="tabela4">
  <td style="width: 512px; text-align: center; height: 50px;"><label ><?php if(isset($_POST['buscar'])){echo $resultadoconsulta3['desc_meta'];} ?></label></td>
  <td style="width: 380px; text-align: center; font-weight:bold"><label style="font-weight:bold"><?php if(isset($_POST['buscar'])){echo $resultadoconsulta2['desc_inddep'];} ?></label></td>
  <td style="width: 84px; text-align: center; "><label style="font-weight:bold"><?php if(isset($_POST['buscar'])){if($resultadoconsulta2['melhor_traj'] == 1){echo "CIMA";}elseif ($resultadoconsulta2['melhor_traj'] == 2){echo "FAIXA";}else{echo "BAIXO";} {
    # code...
  }} ?></label></td>
</table>

<table cellpadding=10 class="table" id="tabela5">
  <td> 
<title>Highcharts Tutorial</title>
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <script src="http://code.highcharts.com/highcharts.js"></script>  
</head>
<body>
<div id="container" style="width: 800px; height: 600px; margin: 0 auto"></div>
<script language="JavaScript">
$(document).ready(function() {  
   var chart = {
      type: 'column'
   };
   var title = {
      text: 'Avaliação da Gestão Estratégica'   
   };
   var subtitle = {
      text: ''  
   };
   var xAxis = {
      categories: ['JAN','FEV','MAR','ABR','MAI','JUN','JUL','AGO','SET','OUT','NOV','DEZ'],
      //crosshair: true CRIAR COLUNAS AONDE MOUSE ESTÁ
   };
   var yAxis = {
      min: 0,
      title: {
         text: 'Nota'         
      }      
   };
   var tooltip = {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
         '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
   };
   var plotOptions = {
      column: {
          colorByPoint: true,
         pointPadding: 0.2,
         borderWidth: 0
      }
   };  
   var credits = {
      enabled: false
   };

   var legend = {
        enabled: false
   };

   
   var series= [{
        name: 'Valor',
            colors: <?php  echo json_encode($resultcor);?>,
            data: <?php echo json_encode($resultmes) ?>
        }, {
            color:  '<?php echo $metacor;?>',
            type: 'line',
            name: 'meta',
            data: <?php echo json_encode($meta) ?>
        }, {
            color:  '<?php echo $toleranciacor;?>',
            type: 'line',
            name: 'tolerancia',
            data: <?php echo json_encode($tolerancia) ?>
        }];     
      
   var json = {};   
   json.chart = chart; 
   json.title = title;   
   json.subtitle = subtitle; 
   json.tooltip = tooltip;
   json.xAxis = xAxis;
   json.yAxis = yAxis;  
   json.series = series;
   json.legend = legend;
   json.plotOptions = plotOptions;  
   json.credits = credits;
   $('#container').highcharts(json);
  
});

$('#anobase').on('change', function(){
   var valor = $(this).val();


  $.post('paginas/reqcadindorg.php', {valorSelect: valor}, function(data) {
    $('#descinddep').html('');


   
    $.each($.parseJSON(data), function(){
     $('#descinddep').append('<option value="' + this.id_inddep + '">' + this.desc_inddep + '</option>');

   });
  });
});

window.onload = function (){

document.getElementById('tabela1').hidden = true;//ocaulta a div
document.getElementById('tabela2').hidden = true; //ocaulta a div
document.getElementById('tabela3').hidden = true; //ocaulta a div
document.getElementById('tabela4').hidden = true; //ocaulta a div
document.getElementById('aux').value = 1; //inserindo identificador

 }
</script>
</body>
</td>
</table>
<style type="text/css"> 
 table 
 { 
  padding-left: 5px; /* CASO ACHE RUIM O POSIOCIONAMENTO DA TABELA, APAGAR ESTA LINHA DE CÓDIGO*/
 margin-left: calc(50% - 420px);
 margin-right: calc(50% - 400px); 
 } 
 </style> 
<table border=1 cellpadding=10 style="font-size: small" class="table" id="resultado">
<!-- criação de uma tabela -->


<?php
 if(isset($_POST['buscar'])){
?>


  <tr>
  <td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">Realizado</td> 
  <?php
 do{
 ?>
    <td style="width: 35px; text-align: center"><?php echo $linhatabela5['result_mes']; ?></td> 
  <?php } while($linhatabela5 = $sql_query5->fetch_assoc());?>
  </tr>


<?php
 do{
 ?>
 <tr>
  <?php echo ($mtj==3) ? '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">Meta Minima</td>' : '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">Meta Máxima</td>' ?> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['metames'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['metamesfev'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['metamesmar'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['metamesabr'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['metamesmai'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['metamesjun'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['metamesjul'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['metamesago'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['metamesset'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['metamesout'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['metamesnov'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['metamesdez'];?></td> 
  
 </tr>

 <tr>
  <?php echo ($mtj==3) ? '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#FF0000">Meta Máxima </td>' : '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#FF0000">Meta Minima</td>' ?>
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['toleranciameta'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['toleranciametafev'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['toleranciametamar'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['toleranciametaabr'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['toleranciametamai'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['toleranciametajun'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['toleranciametajul'];?></td>
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['toleranciametaago'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['toleranciametaset'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['toleranciametaout'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['toleranciametanov'];?></td> 
  <td style="width: 35px; text-align: center"><?php echo $linhatabela2['toleranciametadez'];?></td> 
  
 </tr>
 <?php } while($linhatabela2 = $sql_query2->fetch_assoc());} ?>

  </table>  
  </div></td>



</html>

<style type="text/css">
  
  @media print {
  body * {
    visibility: hidden;
     

  }
  #printable, #printable * {
    visibility: visible;
    size: landscape;

   

  }
  #printable {
    position: fixed;
    left: 0;
    top: 0;
    

  }
</style>

<script type="text/javascript">
  $("#print").on('click', function(){
    if(document.getElementById('aux').value == 1){
    alert('Cabeçalho inserido para impressão.');
document.getElementById('tabela1').hidden = false;
document.getElementById('tabela2').hidden = false; 
document.getElementById('tabela3').hidden = false; 
document.getElementById('tabela4').hidden = false;
document.getElementById('aux').value = 2;
self.print();
}else if(document.getElementById('aux').value == 2){
self.print(); 
}


  });

</script>