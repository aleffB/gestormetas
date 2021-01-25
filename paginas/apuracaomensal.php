<?php 
$acc = 0;
//$nomeador = date("H:i:s:u");

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

//  realiza consulta de tudo do nível de serviço agrupando pelo ano
         $sql_code5 = "SELECT anob FROM nivel_servico GROUP BY 1";
        $sql_query2 = $mysqli->query($sql_code5) or die($mysqli->error);
        $linhatabela2 = $sql_query2->fetch_assoc();

        



       /* if(isset($_POST['btnfinalizar'])){


 foreach ($_POST as $chave=>$valor) 
    $_SESSION[$chave] = $mysqli->real_escape_string($valor);
  
  $anopego = $_POST['anob'];
  $acpego = $_POST['areacliente'];
  $nspego = $_POST['nivelservico'];
  $afpego = $_POST['areafornecedora'];
  $pesopego = $_POST['peso'];
  $metapego = $_POST['meta'];
   
        
        
 $sql_code= "INSERT INTO apuracao_mensal(
            id_ns, anob, area, cmp, avaliacao)

            VALUES(
            '$nspego',
            '$anopego',
            '$acpego',
            '$afpego',
            '$pesopego',
            '$metapego')";

          $confirma = $mysqli->query($sql_code) or die($mysqli->error);

          $correct = "Cumprimento registrado com sucesso.";
          $acc++;



}*/    

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
<h1>Apuração Mensal</h1>
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


  <label for="areacliente">Área Cliente </label>
  <select name="areacliente" id="areacliente" required  class="form form-control" style="text-align: center;" >
    
  
 </select>
  <p class=espaco></p>

  <table border=1 cellpadding=10 class="table" style="margin-top: 50px">
<!-- criação de uma tabela -->
 <tr class= titulo>
   <td>Verificação de Cumprimento</td>
</tr>  

<tbody id='resultado_busca'>
   
 </tbody>

</table>


  <input type="button" name="btnfinalizar" id="btnfinalizar" class ="btn btn-primary" value="Registrar">

</form>    

</div>
</center>


<script type="text/javascript">
$('#anobase').on('change', holdAreaCliente);
holdAreaCliente();


$('#areacliente').bind('mouseover mouseout change', function(){
    var valor = $('#anobase').val();
   var recebeac= document.getElementById("areacliente").value;
   


  $.post('paginas/reqapuracaomensal.php', {valorSelect: valor, recebeAc: recebeac}, function(data) {
      var html = '';

      console.log(data);
    $.each($.parseJSON(data), function(){
      var c = 10;
      
     
     html += '<tr>';
      html += '<td>' + this.desc_orgao +':'+ this.cod_orgao+ '</td><td> <input type="radio"  value="1">Cumpriu' + '&nbsp;&nbsp;&nbsp;' +'<input type="radio"    value="2">N/Cumpriu' + '</td>';
      html += '</tr>';

   });
    $('#resultado_busca').html(html);
  });
});

$('#btnfinalizar').on('click', function(){
      var tags = document.getElementsByTagName("tr");
      var id = [];
    for (var i = 1; i < tags.length; i++) {
        if(tags[i].getElementsByTagName("input")[tags[i].getElementsByTagName("input").length-2].checked){
            id.push(tags[i].getElementsByTagName("input")[tags[i].getElementsByTagName("input").length-2].value);  

               }else if(tags[i].getElementsByTagName("input")[tags[i].getElementsByTagName("input").length-1].checked){
                id.push(tags[i].getElementsByTagName("input")[tags[i].getElementsByTagName("input").length-1].value);
               }        
   

                      
    } 
      
     console.log(id);

          /*$.post('paginas/cadetapacausa.php', {valorId: id , valorChecked: check, valorDesc: descetapa },  function(data){
                        
                      console.log(data);
                      
                    });*/
              }); 

</script>