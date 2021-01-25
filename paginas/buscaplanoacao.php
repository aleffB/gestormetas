<?php
//definindo valor de uma variável, para poder usa-la mais tade
$acc = 0;
//omitir mensagens de erro e alertas, pois algumas variáveis não possuem valor definido e exibirá mensagens de erro
error_reporting(0);
      ini_set(“display_errors”, 0 );

// caso aperte no botão com o name voltar, ele redirecionará para page inicio
if(isset($_POST['voltar'])){
 
 header('Location: index.php?pagina=inicio');
}





 //verificar se não está na sessão, caso não esteja, é redirecionado para o inicio
if(!isset($_SESSION['nomeuser_adm']) && !isset($_SESSION['login_adm'])){
	header('Location: ?pagina=inicio');
	exit;
} 
//variáveis que receberão os valores das sessions
$orgao = $_SESSION['id_orgao'];
$valid = $_SESSION['validador'];
//caso aperte no botão com o nome confirmar, executará o código abaixo
if(isset($_POST['confirmar'])){
 // a variável receberá o valor do campo codorgao
 $orgaorec = $_POST['codorgao'];

}



//verifica se o usuário é ADM ou DEPENDENTE
if($valid==1){
	//caso seja ADM, terá acesso a todos os orgãos na consulta
 $sql_code4 = "SELECT * FROM orgaos";
        $sql_query = $mysqli->query($sql_code4) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        //retornado o código do orgão buscado e inserindo na variável $orgaobuscado
        $orgaobuscado = $linhatabela['cod_orgao'];

        }else{
        	//caso seja DEPENDENTE, terá acesso apenas ao seu orgão que foi definido na sessão de login
          $sql_code4 = "SELECT * FROM orgaos WHERE id_orgao = '$orgao'";
        $sql_query = $mysqli->query($sql_code4) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();
        //retornando em específico seu prório orgão e salvando na variável abaixo
        $orgaobuscado = $linhatabela['cod_orgao'];
        }
 
  $sql_code5 = "SELECT anob FROM indicadordepartamental GROUP BY 1";
          $sql_query2 = $mysqli->query($sql_code5) or die($mysqli->error);
          $linhatabela2 = $sql_query2->fetch_assoc();

 $data =date('Y-m-d');
 
?>
<script type="text/javascript">


  function selectTag() {

    var tags = document.getElementsByTagName("tr");
    for (var i = 1; i < tags.length; i++) {
        if((tags[i].getElementsByTagName("input")[tags[i].getElementsByTagName("input").length-1].checked)){

              
            $.post('paginas/updatecancelamento.php', {valorId: tags[i].getElementsByTagName("input")[tags[i].getElementsByTagName("input").length-1].value, valorChecked: tags[i].getElementsByTagName("input")[tags[i].getElementsByTagName("input").length-1].checked, valorName: tags[i].getElementsByTagName("input")[tags[i].getElementsByTagName("input").length-1].name},  function(data){


                    });
        }
    }    
 
};


function selectDados(){
  var tags = document.getElementsByTagName("tr");
 for( var i = 1; i<tags.length; i++){
     tags[i].addEventListener("keyup", function (e) {      
    var dados = e.target.name;
    var valor = e.target.value;
    console.log(dados);
    console.log(valor);


         $.post('paginas/updateplanoacao.php', {dadosSelect: dados, valorSelect: valor}, function(data) {

                      
         });

    });

   }

};

function selectData(){
  var tags = document.getElementsByTagName("tr");
 for( var i = 1; i<tags.length; i++){
     tags[i].addEventListener("change", function (e) {      
    var dados = e.target.name;
    var valor = e.target.value;
    


         $.post('paginas/updateplanoacao.php', {dadosSelect: dados, valorSelect: valor}, function(data) {

                      
         });
    });

   }

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


<div class="body-wrap">
  <div class="container">
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?pagina=inicial">Home</a>
        </div>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cadastros <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?pagina=caddiretoria">Diretoria</a></li>
                <li><a href="?pagina=cadorgao">Orgão</a></li>
                 <li class="divider"></li>
                <li><a href="?pagina=indicadoresemp">Indicador Empresarial</a></li>
                <li><a href="?pagina=indicadoresdep">Indicador Departamental</a></li>
                <li><a href="?pagina=indicadororgao">Indicador por Orgão</a></li>
                 <li class="divider"></li>
                 <li><a href="?pagina=meta">Meta</a></li>
                <li><a href="?pagina=metasmensais">Metas Mensais</a></li>
              <!--  <li><a href="?pagina=efeito">Efeito</a></li> -->
                <li><a href="?pagina=causa">Causa</a></li>
                <li><a href="?pagina=planoacao">Plano de Ação</a></li>
                <li><a href="?pagina=etapa">Etapa</a></li>
                <li><a href="?pagina=resultadosmensais">Resultados Mensais</a></li>
                
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="?pagina=sair">Logout</a></li>
          </ul>

          <!-- Collect the nav links, forms, and other content for toggling -->
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Atualizações <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?pagina=attuserdep">Usuário Dependente</a></li>
                <li><a href="?pagina=attuser">Seu Usuário</a></li>
                <li class="divider"></li>
                <li><a href="?pagina=attdiretoria">Diretoria</a></li>
                <li><a href="?pagina=attorgao">Orgão</a></li>
                <li class="divider"></li>
                <li><a href="?pagina=attindempresarial">Indicador Empresarial</a></li>
                <li><a href="?pagina=attinddepartamental">Indicador Departamental</a></li>
               <!-- <li><a href="?pagina=attindorgao">Indicador por Orgão</a></li>
               <li class="divider"></li>
                <li><a href="?pagina=attplanoacao">Plano de Ação</a></li>
                <li><a href="?pagina=attmetasmensais">Metas Mensais</a></li>
                <li><a href="?pagina=attefeito">Efeito</a></li>
                <li><a href="?pagina=attetapa">Etapa</a></li>
                <li><a href="?pagina=attcausa">Causa</a></li>
                <li><a href="?pagina=attmeta">Meta</a></li> -->
              
               

               
               
              </ul>
            </li>
          </ul>

          <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Buscas <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?pagina=buscageralindicadororgao">Indicadores</a></li>
                <li><a href="?pagina=buscageralmetas">Metas</a></li>
                <li><a href="?pagina=buscageralresultmensal">Resultados Mensais</a></li>
                <li><a href="?pagina=priorizacaoimpacto">Priorização de Impacto</a></li>
                <li><a href="?pagina=buscaplanoacao">Plano de Ação</a></li>
    
              </ul>
            </li>
          </ul>

          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Funções <b class="caret"></b></a>
              <ul class="dropdown-menu">
               <!-- <li><a href="?pagina=importexecel">Importar tabela do excel</a></li> -->
                <li><a href="?pagina=importarexcelinddep">Importar Indicadores Departamentais</a></li>
                <li class="divider"></li>
                <li><a href="?pagina=cadadm">Cadastro de Usuários</a></li>
                <li><a href="?pagina=teste">Gerar Gráficos</a></li>
                <li><a href="?pagina=cadsenha">Cadastro de senhas ADM</a></li>
                <li><a href="?pagina=recuser">Recuperar/Modificar senha</a></li>
                <li><a href="?pagina=gerarpdf">Gerar Relatórios</a></li>
              </ul>
            </li>
          </ul>

          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultas <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?pagina=exibirorgao">Exibir Orgãos</a></li>
                <li><a href="?pagina=exibirdiretoria">Exibir Diretoria</a></li>
                <li class="divider"></li>
                <li><a href="?pagina=exibirindempresarial">Exibir Indicador Empresarial</a></li>
                <li><a href="?pagina=exibirindddep">Exibir Indicador Departamental</a></li>
                <li><a href="?pagina=exibirindorgao">Exibir Indicador por Orgão</a></li>
              </ul>
            </li>
          </ul>


        </div>


        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </div>
</div>
<center>
<div id="buscaindorgao" style="width: 400px;">
<h1>Plano de Ação</h1>

<p class=espaco></p>
<form action="" method="POST">
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
<label for="descorgao">Código Orgão </label>
 <select name="descorgao" id="descorgao" required  class="form form-control" style="text-align: center;" >
    <option value="">Selecione</option>
    <!-- exibirá os valores da consulta, usando o while para exibir todos os dados do banco -->
     <?php 
     
   do{ 
  ?>
  <option value="<?php  echo $linhatabela['cod_orgao']; ?>"> <?php echo $linhatabela['desc_orgao'] .':'.$linhatabela['cod_orgao'];?></option>
  <?php } while($linhatabela = $sql_query->fetch_assoc());?>
        
 </select>


  <label for="descinddep"> Indicador Departamental</label>
  <select name="descinddep"  id="descinddep" class="form form-control" style="text-align: center;">
  <option value="">Selecione</option>
 
  </select>

</form>
<p class=espaco></p>

 <input type="button" name="att" value="Atualizar" id="att" class ="btn btn-danger"> 
  <p class=espaco></p>
 <input value="Imprimir" name="imp" type="submit" onClick="self.print();" class ="btn btn-primary" >
  </center>
 
<form action="" method="POST">
<div id="printable">  
<table border=1 cellpadding=10 class="table" style="margin-top: 50px">
<!-- criação de uma tabela -->
 <tr class= titulo>
   <td hidden="true">ID</td>
   <td>N°</td>
   <td>AÇÃO(O QUE)/ETAPA(COMO)</td>
   <td>Início(previsto)</td> 
   <td>Fim(previsto)</td> 
   <td>Início(real)</td> 
   <td>Fim(real)</td> 
   <td>Responsável</td>
   <td>Status</td> 
   <td>Observação</td>
   <td>Inativa</td>

    <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
     
 </tr>  

<tbody id='resultado_busca'>
   
 </tbody>

 <tbody id='resultado_busca2'>
   
 </tbody>



  </table> 
</div>
</form>
 
 <style type="text/css">
nav {
  margin-top: 60px;
  box-shadow: 5px 4px 5px #000;
}
 
  @media print {
  body * {
    visibility: hidden;
  }
  #printable, #printable * {
    visibility: visible;
     
  }
  #printable {
    position: fixed;
    left: 0;
    top: 0;



  }

</style>

               <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type="text/javascript">
  $('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});
</script>
 
<script type="text/javascript">

$('#descorgao').on('change', function(){
   var valor = document.getElementById("anobase").value;
   var recebeorgao = document.getElementById("descorgao").value;

  $.post('paginas/reqindorgao.php', {valorSelect: valor, recebeOrgao: recebeorgao}, function(data) {
    $('#descinddep').html('');


    $('#descinddep').append('<option value="">'  + 'Selecione</option>');
    $.each($.parseJSON(data), function(){
     $('#descinddep').append('<option value="' + this.id_inddep + '">' + this.desc_inddep + '</option>');

   });
  });
});

 
$('#descorgao').on('mouseout', function(){
var valor = document.getElementById("anobase").value;
  var orgao = document.getElementById("descorgao").value;
  var dep = document.getElementById("descinddep").value;
  

  $.post('paginas/reqbuscaplanoacao.php', {valorSelect: valor, valorOrgao: orgao, valorDepartamento: dep}, function(data) {

    var ultimonivel = 0;
    var html = '';

    $.each($.parseJSON(data), function(){
            // PARAMETROS PARA FUNÇÃO INTERNA
    var diracao = this.datarealinicioplano;
    var dtracao = this.datarealterminoplano;
    var diretapa = this.datarealinicioetapa; 
    var dtretapa = this.datarealterminoetapa;
    var idacao = this.id_planoacao;
    var idetapa = this.id_etapa;
    var statusa = this.statusplano;
    var statuse = this.statusetapa;
    var dipacao = this.dataprevistainicioplano;
    var dtpacap = this.dataprevistaterminoplano;
    var dipetapa = this.dataprevistainicioetapa;
    var dtpetapa = this.dataprevistaterminoetapa;
    
    function updateStatus(){
        var recacaoinicio = diracao;
        var recebeacaotermino = dtracao;
        var recebeetapainicio = diretapa;
        var recebeetapatermino = dtretapa;
        var recebeidacao = idacao;
        var recebeidetapa = idetapa;
        var dataatual = "<?php echo $data; ?>";
        var recstatusa = statusa;
        var recstatuse = statuse;
        var recacaoinicioprevisto=dipacao;
        var recebeacaoterminoprevisto=dtpacap;
        var recebeetapainicioprevisto=dipetapa;
        var recebeetapaterminoprevisto=dtpetapa;



          //ANALISAR DATA           
              var identificador = "faltainicioacaoetapa";
            $.post('paginas/updatestatus.php', {idSelect: recebeidacao, identSelect: identificador, id2Select: recebeidetapa, acaoInicioSelect: recacaoinicio,acaoTerminoSelect: recebeacaotermino ,etapaInicioSelect: recebeetapainicio, etapaTerminoSelect: recebeetapatermino , statusA: recstatusa , statusE: recstatuse, dataAtual: dataatual, recIAcaoP: recacaoinicioprevisto , recTAcaoP: recebeacaoterminoprevisto , recIEtapaP: recebeetapainicioprevisto , recTEtapaP: recebeetapaterminoprevisto }, function(data) {
                   
            });
            

            

          

         }
         updateStatus();
         // INICIA A MONTAGEM DA TABELA
      if(this.sequenciaplano > ultimonivel){  
        html += '<tr>';
      //ID
      html += '<td hidden="true" id="acao">' + this.id_planoacao + '</td>';
      //NÚMERO
      html += '<td>' + this.sequenciaplano + '</td>';
      //DESC_ACAO
      html += '<td>' + this.desc_acao + '</td>';
      //INICIO PREVISTO
      html += '<td>' + this.datainicioplano + '</td>';
      //FIM PREVISTO
      html += '<td>' + this.dataterminoplano + '</td>';
      //INICIO REAL
      html += '<td><input type="date" name="' + this.id_planoacao + " acaodtir " + '" value="' + this.datarealinicioplano + '"onclick="selectData();"></td>';
      //FIM REAL
      html += '<td><input type="date" name="' + this.id_planoacao + " acaodttr " + '" value="' + this.datarealterminoplano + '"onclick="selectData();"></td>';
      //RESPONSAVEL
      html += '<td><input type="text" name="' + this.id_planoacao + " acaoresp " + '" value="' + this.responsavelplano + '"onclick="selectDados();"></td>';
      //STATUS
      var statusplano = this.statusplano;
      if(statusplano == 1 ){
      html += '<td>' + "Concluido" + '</td>';
    }else if(statusplano == 2) {
      html += '<td>' + "Em andamento" + '</td>';
    }else if(statusplano == 3){
      html += '<td>' + "Em atraso" + '</td>';
    }else if(statusplano == 4){
      html += '<td>' + "Não iniciado" + '</td>';
    }else{
      html += '<td>' + "Cancelado" + '</td>';
    }

        //OBS
      html += '<td><input type="text" name="' + this.id_planoacao + " acaoobs " + '" value="' + this.obsacao +'"onclick="selectDados();"></td>';
      //INATIVA
      html += '<td><input type="checkbox" name="cancelaracao" value="' + this.id_planoacao + '" onclick="selectTag();">' + "" + '</td>';

      ultimonivel = this.sequenciaplano;

    html += '</tr>';
  }
//-----------------------------------------------------------------

    html += '<tr>';
        //ID
      html += '<td hidden="true" id="etapa">' + this.id_etapa + '</td>';
      //NÚMERO
      html += '<td>' + this.sequenciaetapa + '</td>';
      //DESC_ETAPA
      html += '<td>' + this.desc_etapa + '</td>';
      //INICIO PREVISTO
      html += '<td>' + this.datainicioetapa + '</td>';
      //FIM PREVISTO
      html += '<td>' + this.dataterminoetapa + '</td>';

      /*name="' + this.id_etapa+"etapadtir" +'" value="' + this.datarealinicioetapa + '
name="' + this.id_etapa+"etapadttr" +'" value="' + this.datarealterminoetapa + '*/
      //INICIO REAL
      html += '<td><input type="date" name="' + this.id_etapa + " etapadtir " + '" value="' + this.datarealinicioetapa + '"onclick="selectData();"></td>';
      //FIM REAL
      html += '<td><input type="date" name="' + this.id_etapa + " etapadttr " + '" value="' + this.datarealterminoetapa + '"onclick="selectData();"></td>';
      //RESPONSAVEL
      html += '<td><input type="text" name="' + this.id_etapa + " etaparesp " + '" + value="' + this.responsaveletapa + '"onclick="selectDados();"></td>';
      //STATUS
      var statusetapa = this.statusetapa;
      if(statusetapa == 1){
      html += '<td>' + "Concluido" + '</td>';
      }else if(statusetapa == 2){
        html += '<td>' + "Em andamento" + '</td>';
      }else if(statusetapa == 3){
        html += '<td>' + "Em atraso" + '</td>';
      }else if(statusetapa == 4){
        html += '<td>' + "Não iniciado" + '</td>';
      }else{
        html += '<td>' + "Cancelado" + '</td>';
      }
      //OBS
      html += '<td><input type="text" name="' + this.id_etapa + " etapaobs " + '" value="' + this.obsetapa +'"onclick="selectDados();"></td>';
      //INATIVA
      html += '<td><input type="checkbox" value="' + this.id_etapa + '" name="cancelaretapa" onclick="selectTag();" >' + "" + '</td>';
    html += '</tr>';


   });
    $('#resultado_busca').html(html);
  });
  
});

//--------------DIVIDE

$('#descinddep').on('change', function(){
  var valor = document.getElementById("anobase").value;
  var orgao = document.getElementById("descorgao").value;
  var dep = document.getElementById("descinddep").value;
  

  $.post('paginas/reqbuscaplanoacao.php', {valorSelect: valor, valorOrgao: orgao, valorDepartamento: dep}, function(data) {

    var ultimonivel = 0;
    var html = '';

    $.each($.parseJSON(data), function(){
            // PARAMETROS PARA FUNÇÃO INTERNA
    var diracao = this.datarealinicioplano;
    var dtracao = this.datarealterminoplano;
    var diretapa = this.datarealinicioetapa; 
    var dtretapa = this.datarealterminoetapa;
    var idacao = this.id_planoacao;
    var idetapa = this.id_etapa;
    var statusa = this.statusplano;
    var statuse = this.statusetapa;
    var dipacao = this.dataprevistainicioplano;
    var dtpacap = this.dataprevistaterminoplano;
    var dipetapa = this.dataprevistainicioetapa;
    var dtpetapa = this.dataprevistaterminoetapa;
    
    function updateStatus(){
        var recacaoinicio = diracao;
        var recebeacaotermino = dtracao;
        var recebeetapainicio = diretapa;
        var recebeetapatermino = dtretapa;
        var recebeidacao = idacao;
        var recebeidetapa = idetapa;
        var dataatual = "<?php echo $data; ?>";
        var recstatusa = statusa;
        var recstatuse = statuse;
        var recacaoinicioprevisto=dipacao
        var recebeacaoterminoprevisto=dtpacap
        var recebeetapainicioprevisto=dipetapa
        var recebeetapaterminoprevisto=dtpetapa



          //ANALISAR DATA           
              var identificador = "faltainicioacaoetapa";
            $.post('paginas/updatestatus.php', {idSelect: recebeidacao, identSelect: identificador, id2Select: recebeidetapa, acaoInicioSelect: recacaoinicio,acaoTerminoSelect: recebeacaotermino ,etapaInicioSelect: recebeetapainicio, etapaTerminoSelect: recebeetapatermino , statusA: recstatusa , statusE: recstatuse, dataAtual: dataatual, recIAcaoP: recacaoinicioprevisto , recTAcaoP: recebeacaoterminoprevisto , recIEtapaP: recebeetapainicioprevisto , recTEtapaP: recebeetapaterminoprevisto }, function(data) {
                   
            });
            

            

          

         }
         updateStatus();
         // INICIA A MONTAGEM DA TABELA
      if(this.sequenciaplano > ultimonivel){  
        html += '<tr>';
      //ID
      html += '<td hidden="true" id="acao">' + this.id_planoacao + '</td>';
      //NÚMERO
      html += '<td>' + this.sequenciaplano + '</td>';
      //DESC_ACAO
      html += '<td>' + this.desc_acao + '</td>';
      //INICIO PREVISTO
      html += '<td>' + this.datainicioplano + '</td>';
      //FIM PREVISTO
      html += '<td>' + this.dataterminoplano + '</td>';
      //INICIO REAL
      html += '<td><input type="date" name="' + this.id_planoacao + " acaodtir " + '" value="' + this.datarealinicioplano + '"onclick="selectData();"></td>';
      //FIM REAL
      html += '<td><input type="date" name="' + this.id_planoacao + " acaodttr " + '" value="' + this.datarealterminoplano + '"onclick="selectData();"></td>';
      //RESPONSAVEL
      html += '<td><input type="text" name="' + this.id_planoacao + " acaoresp " + '" value="' + this.responsavelplano + '"onclick="selectDados();"></td>';
      //STATUS
      var statusplano = this.statusplano;
      if(statusplano == 1 ){
      html += '<td>' + "Concluido" + '</td>';
    }else if(statusplano == 2) {
      html += '<td>' + "Em andamento" + '</td>';
    }else if(statusplano == 3){
      html += '<td>' + "Em atraso" + '</td>';
    }else if(statusplano == 4){
      html += '<td>' + "Não iniciado" + '</td>';
    }else{
      html += '<td>' + "Cancelado" + '</td>';
    }

        //OBS
      html += '<td><input type="text" name="' + this.id_planoacao + " acaoobs " + '" value="' + this.obsacao +'"onclick="selectDados();"></td>';
      //INATIVA
      html += '<td><input type="checkbox" name="cancelaracao" value="' + this.id_planoacao + '" onclick="selectTag();">' + "" + '</td>';

      ultimonivel = this.sequenciaplano;

    html += '</tr>';
  }
//-----------------------------------------------------------------

    html += '<tr>';
        //ID
      html += '<td hidden="true" id="etapa">' + this.id_etapa + '</td>';
      //NÚMERO
      html += '<td>' + this.sequenciaetapa + '</td>';
      //DESC_ETAPA
      html += '<td>' + this.desc_etapa + '</td>';
      //INICIO PREVISTO
      html += '<td>' + this.datainicioetapa + '</td>';
      //FIM PREVISTO
      html += '<td>' + this.dataterminoetapa + '</td>';

      /*name="' + this.id_etapa+"etapadtir" +'" value="' + this.datarealinicioetapa + '
name="' + this.id_etapa+"etapadttr" +'" value="' + this.datarealterminoetapa + '*/
      //INICIO REAL
      html += '<td><input type="date" name="' + this.id_etapa + " etapadtir " + '" value="' + this.datarealinicioetapa + '"onclick="selectData();"></td>';
      //FIM REAL
      html += '<td><input type="date" name="' + this.id_etapa + " etapadttr " + '" value="' + this.datarealterminoetapa + '"onclick="selectData();"></td>';
      //RESPONSAVEL
      html += '<td><input type="text" name="' + this.id_etapa + " etaparesp " + '" + value="' + this.responsaveletapa + '"onclick="selectDados();"></td>';
      //STATUS
      var statusetapa = this.statusetapa;
      if(statusetapa == 1){
      html += '<td>' + "Concluido" + '</td>';
      }else if(statusetapa == 2){
        html += '<td>' + "Em andamento" + '</td>';
      }else if(statusetapa == 3){
        html += '<td>' + "Em atraso" + '</td>';
      }else if(statusetapa == 4){
        html += '<td>' + "Não iniciado" + '</td>';
      }else{
        html += '<td>' + "Cancelado" + '</td>';
      }
      //OBS
      html += '<td><input type="text" name="' + this.id_etapa + " etapaobs " + '" value="' + this.obsetapa +'"onclick="selectDados();"></td>';
      //INATIVA
      html += '<td><input type="checkbox" value="' + this.id_etapa + '" name="cancelaretapa" onclick="selectTag();" >' + "" + '</td>';
    html += '</tr>';


   });
    $('#resultado_busca').html(html);
  });
  
});


//-----------------------------QUANDO CLICKAR NO BOTÃO ATUALIZAR---------------------------
$('#att').on('click', function(){
  var valor = document.getElementById("anobase").value;
  var orgao = document.getElementById("descorgao").value;
  var dep = document.getElementById("descinddep").value;
  

  $.post('paginas/reqbuscaplanoacao.php', {valorSelect: valor, valorOrgao: orgao, valorDepartamento: dep}, function(data) {

    var ultimonivel = 0;
    var html = '';

    $.each($.parseJSON(data), function(){
            // PARAMETROS PARA FUNÇÃO INTERNA
    var diracao = this.datarealinicioplano;
    var dtracao = this.datarealterminoplano;
    var diretapa = this.datarealinicioetapa; 
    var dtretapa = this.datarealterminoetapa;
    var idacao = this.id_planoacao;
    var idetapa = this.id_etapa;
    var statusa = this.statusplano;
    var statuse = this.statusetapa;
    var dipacao = this.dataprevistainicioplano;
    var dtpacap = this.dataprevistaterminoplano;
    var dipetapa = this.dataprevistainicioetapa;
    var dtpetapa = this.dataprevistaterminoetapa;
    
    function updateStatus(){
        var recacaoinicio = diracao;
        var recebeacaotermino = dtracao;
        var recebeetapainicio = diretapa;
        var recebeetapatermino = dtretapa;
        var recebeidacao = idacao;
        var recebeidetapa = idetapa;
        var dataatual = "<?php echo $data; ?>";
        var recstatusa = statusa;
        var recstatuse = statuse;
        var recacaoinicioprevisto=dipacao
        var recebeacaoterminoprevisto=dtpacap
        var recebeetapainicioprevisto=dipetapa
        var recebeetapaterminoprevisto=dtpetapa

          console.log(statuse);


          //ANALISAR DATA           
              var identificador = "faltainicioacaoetapa";
            $.post('paginas/updatestatus.php', {idSelect: recebeidacao, identSelect: identificador, id2Select: recebeidetapa, acaoInicioSelect: recacaoinicio,acaoTerminoSelect: recebeacaotermino ,etapaInicioSelect: recebeetapainicio, etapaTerminoSelect: recebeetapatermino , statusA: recstatusa , statusE: recstatuse, dataAtual: dataatual, recIAcaoP: recacaoinicioprevisto , recTAcaoP: recebeacaoterminoprevisto , recIEtapaP: recebeetapainicioprevisto , recTEtapaP: recebeetapaterminoprevisto }, function(data) {
                   console.log(data);
            });
            

            

          

         }
         updateStatus();
         // INICIA A MONTAGEM DA TABELA
      if(this.sequenciaplano > ultimonivel){  
        html += '<tr>';
      //ID
      html += '<td hidden="true" id="acao">' + this.id_planoacao + '</td>';
      //NÚMERO
      html += '<td>' + this.sequenciaplano + '</td>';
      //DESC_ACAO
      html += '<td>' + this.desc_acao + '</td>';
      //INICIO PREVISTO
      html += '<td>' + this.datainicioplano + '</td>';
      //FIM PREVISTO
      html += '<td>' + this.dataterminoplano + '</td>';
      //INICIO REAL
      html += '<td><input type="date" name="' + this.id_planoacao + " acaodtir " + '" value="' + this.datarealinicioplano + '"onclick="selectData();"></td>';
      //FIM REAL
      html += '<td><input type="date" name="' + this.id_planoacao + " acaodttr " + '" value="' + this.datarealterminoplano + '"onclick="selectData();"></td>';
      //RESPONSAVEL
      html += '<td><input type="text" name="' + this.id_planoacao + " acaoresp " + '" value="' + this.responsavelplano + '"onclick="selectDados();"></td>';
      //STATUS
      var statusplano = this.statusplano;
      if(statusplano == 1 ){
      html += '<td>' + "Concluido" + '</td>';
    }else if(statusplano == 2) {
      html += '<td>' + "Em andamento" + '</td>';
    }else if(statusplano == 3){
      html += '<td>' + "Em atraso" + '</td>';
    }else if(statusplano == 4){
      html += '<td>' + "Não iniciado" + '</td>';
    }else{
      html += '<td>' + "Cancelado" + '</td>';
    }

        //OBS
      html += '<td><input type="text" name="' + this.id_planoacao + " acaoobs " + '" value="' + this.obsacao +'"onclick="selectDados();"></td>';
      //INATIVA
      html += '<td><input type="checkbox" name="cancelaracao" value="' + this.id_planoacao + '" onclick="selectTag();">' + "" + '</td>';

      ultimonivel = this.sequenciaplano;

    html += '</tr>';
  }
//-----------------------------------------------------------------

    html += '<tr>';
        //ID
      html += '<td hidden="true" id="etapa">' + this.id_etapa + '</td>';
      //NÚMERO
      html += '<td>' + this.sequenciaetapa + '</td>';
      //DESC_ETAPA
      html += '<td>' + this.desc_etapa + '</td>';
      //INICIO PREVISTO
      html += '<td>' + this.datainicioetapa + '</td>';
      //FIM PREVISTO
      html += '<td>' + this.dataterminoetapa + '</td>';

      /*name="' + this.id_etapa+"etapadtir" +'" value="' + this.datarealinicioetapa + '
name="' + this.id_etapa+"etapadttr" +'" value="' + this.datarealterminoetapa + '*/
      //INICIO REAL
      html += '<td><input type="date" name="' + this.id_etapa + " etapadtir " + '" value="' + this.datarealinicioetapa + '"onclick="selectData();"></td>';
      //FIM REAL
      html += '<td><input type="date" name="' + this.id_etapa + " etapadttr " + '" value="' + this.datarealterminoetapa + '"onclick="selectData();"></td>';
      //RESPONSAVEL
      html += '<td><input type="text" name="' + this.id_etapa + " etaparesp " + '" + value="' + this.responsaveletapa + '"onclick="selectDados();"></td>';
      //STATUS
      var statusetapa = this.statusetapa;
      if(statusetapa == 1){
      html += '<td>' + "Concluido" + '</td>';
      }else if(statusetapa == 2){
        html += '<td>' + "Em andamento" + '</td>';
      }else if(statusetapa == 3){
        html += '<td>' + "Em atraso" + '</td>';
      }else if(statusetapa == 4){
        html += '<td>' + "Não iniciado" + '</td>';
      }else{
        html += '<td>' + "Cancelado" + '</td>';
      }
      //OBS
      html += '<td><input type="text" name="' + this.id_etapa + " etapaobs " + '" value="' + this.obsetapa +'"onclick="selectDados();"></td>';
      //INATIVA
      html += '<td><input type="checkbox" value="' + this.id_etapa + '" name="cancelaretapa" onclick="selectTag();" >' + "" + '</td>';
    html += '</tr>';


   });
    $('#resultado_busca').html(html);
  });
  
});
</script>
  