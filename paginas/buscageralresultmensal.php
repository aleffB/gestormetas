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


//verifica se o usuário é ADM ou DEPENDENTE
if($valid==1){
	//caso seja ADM, terá acesso a todos os orgãos na consulta
 $sql_code4 = "SELECT * FROM orgaos";
        $sql_query = $mysqli->query($sql_code4) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();

        $sql_code5 = "SELECT anob FROM indicadordepartamental GROUP BY 1";
        $sql_query2 = $mysqli->query($sql_code5) or die($mysqli->error);
        $linhatabela2 = $sql_query2->fetch_assoc();
        $anobuscado = $linhatabela2['anob'];

        }else{
        	//caso seja DEPENDENTE, terá acesso apenas ao seu orgão que foi definido na sessão de login
          $sql_code4 = "SELECT * FROM orgaos WHERE id_orgao = '$orgao'";
        $sql_query = $mysqli->query($sql_code4) or die($mysqli->error);
        $linhatabela = $sql_query->fetch_assoc();

        $sql_code5 = "SELECT anob FROM indicadordepartamental GROUP BY 1";
        $sql_query2 = $mysqli->query($sql_code5) or die($mysqli->error);
        $linhatabela2 = $sql_query2->fetch_assoc();
        $anobuscado = $linhatabela2['anob'];

        }


?>

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
<h1>Resultados Mensais</h1>

<p class=espaco></p>
<form action="" method="POST">
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

<label for="codorgao">Código Orgão </label>
 <select name="codorgao" id="codorgao" required  class="form form-control" style="text-align: center;" >
    <option value="">Selecione</option>
    <!-- exibirá os valores da consulta, usando o while para exibir todos os dados do banco -->
     <?php 
     
   do{ 
  ?>
  <option value="<?php  echo $linhatabela['cod_orgao']; ?>"> <?php echo $linhatabela['desc_orgao'] .':'.$linhatabela['cod_orgao'];?></option>
  <?php } while($linhatabela = $sql_query->fetch_assoc());?>
        
 </select>

 <p class=espaco></p>

<label for="mesrf">Mês Referencial</label>
    <select name="mesrf" id="mesrf" required class="form form-control" style="text-align: center;">
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
</form>
<input value="Imprimir" name="imp" type="submit" onClick="self.print();" class ="btn btn-primary" style="margin-top: 10px" >

  </center>
<!--<label  style="margin-top: 50px">Resultados mês de: <label id="rtmes"></label></label> -->
 <tr class= titulo>
 <div id="printable">
<table border=1 cellpadding=10 class="table" style="margin-top: 50px" id="resultado">
<!-- criação de uma tabela -->
 <tr class= titulo>
   <td>Indicador</td>
   <td>Sentido</td> 
   <td>Unidade</td> 
   <td>Peso</td> 
   <td>Meta do Ano</td> 
   <td>Ano-Faixa Inferior</td>
   <td>Ano-Faixa Superior</td>
   <td>Até o Mês-Faixa Inferior</td>
   <td>Até o Mês-Faixa Superior</td> 
   <td>Verificado</td>
   <td>% de Cumprimento</td>
   <td>Status</td>
   
     
 </tr>  

<tbody id='resultado_busca'>
   
 </tbody>
</div>
  </table>  

  

  <script type="text/javascript">
    $('#mesrf').on('change', function(){
   var valor = $(this).val();
   var orgao = document.getElementById("codorgao").value;
   var ano = document.getElementById("anobase").value;


  $.post('paginas/buscageralrmetas.php', {valorSelect: valor, orgaoSelect: orgao, anoSelect: ano}, function(data) {

      var html = '';
      
    $.each($.parseJSON(data), function(){
    
  
    html += '<tr>';
    //INDICADOR
      html += '<td>' + this.desc_inddep + '</td>';
      //SENTIDO
      var mtj = this.melhor_traj;
      if(mtj == 1){
         html += '<td>' + "Crescente" + '</td>';
      } else{
        if(mtj == 2){
          html += '<td>' + "Na faixa" + '</td>';
        } else{
          html += '<td>' + "Decrescente" + '</td>';
        }
      }
      //UNIDADE
      var und = this.und_med;
      if(und == 1){
        html += '<td>' + "R$" + '</td>';
      }else{
        if(und == 2){
          html += '<td>' + "Unidade" + '</td>';
        }else{
          if(und == 3){
            html += '<td>' + "%" + '</td>';
          }else{
            html += '<td>' + "Meses" + '</td>';
          }
        }
      }
      //PESO
      html += '<td>' + this.peso + '</td>';
      //META ANO
      html += '<td>' + this.metaano + '</td>';
      //ANO FAIXA INFERIOR
      if(mtj == 1){
        html += '<td>' + this.meta_fx2 + '</td>';
      }else{
        if(mtj == 3){
          html += '<td>' + this.meta_fx1 + '</td>';
        }else{
          html += '<td>' + this.meta_fx2 + '</td>';
        }
      }
      //---------------------------------------
      //ANO FAIXA SUPERIOR
      if(mtj==1){
      html += '<td>' + this.meta_fx1 + '</td>';
    }else{
      if(mtj==3){
        html += '<td>' + this.meta_fx2 + '</td>';
      }else{
        html += '<td>' + this.meta_fx1 + '</td>';
      }
    }
   //------------------------------------   
   //MES FAIXA INFERIOR
      var mes = this.mes_ref;
     if(mtj ==1){ 
      if(mes = "Janeiro"){
        html += '<td>' + this.toleranciameta + '</td>';
      }else{
        if(mes = "Fevereiro"){
          html += '<td>' + this.toleranciametafev + '</td>';//here
        }else{
          if(mes = "Marco"){
            html += '<td>' + this.toleranciametamar + '</td>';//here
          }else{
            if(mes = "Abril"){
              html += '<td>' + this.toleranciametaabr + '</td>';//here
            }else{
              if(mes = "Maio"){
                html += '<td>' + this.toleranciametamai + '</td>';//here
              }else{
                if(mes = "Junho"){
                  html += '<td>' + this.toleranciametajun + '</td>';//here
                }else{
                  if(mes = "Julho"){
                    html += '<td>' + this.toleranciametajul + '</td>';//here
                  }else{
                    if(mes = "Agosto"){
                      html += '<td>' + this.toleranciametaago + '</td>';//here
                    }else{
                      if(mes = "Setembro"){
                        html += '<td>' + this.toleranciametaset + '</td>';//here
                      }else{
                        if(mes = "Outubro"){
                          html += '<td>' + this.toleranciametaout + '</td>';//here
                        }else{
                          if(mes = "Novembro"){
                            html += '<td>' + this.toleranciametanov + '</td>';//here
                          }else{
                            html += '<td>' + this.toleranciametadez + '</td>';//here       
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }

    }else{
      if(mtj == 3){
     if(mes = "Janeiro"){
       html += '<td>' + this.metames + '</td>';   
      }else{
        if(mes = "Fevereiro"){
           html += '<td>' + this.metamesfev + '</td>';
        }else{
          if(mes = "Marco"){
             html += '<td>' + this.metamesmar + '</td>';
          }else{
            if(mes = "Abril"){
               html += '<td>' + this.metamesabr + '</td>';
            }else{
              if(mes = "Maio"){
                 html += '<td>' + this.metamesmai + '</td>';
              }else{
                if(mes = "Junho"){
                   html += '<td>' + this.metamesjun + '</td>';
                }else{
                  if(mes = "Julho"){
                     html += '<td>' + this.metamesjul + '</td>';
                  }else{
                    if(mes = "Agosto"){
                       html += '<td>' + this.metamesago + '</td>';
                    }else{
                      if(mes = "Setembro"){
                         html += '<td>' + this.metamesset + '</td>';
                      }else{
                        if(mes = "Outubro"){
                           html += '<td>' + this.metamesout + '</td>';
                        }else{
                          if(mes = "Novembro"){
                             html += '<td>' + this.metamesnov + '</td>';
                          }else{
                            html += '<td>' + this.metamesdez + '</td>';
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }   
    }else{
      if(mes = "Janeiro"){
        html += '<td>' + this.toleranciameta + '</td>';
      }else{
        if(mes = "Fevereiro"){
          html += '<td>' + this.toleranciametafev + '</td>';//here
        }else{
          if(mes = "Marco"){
            html += '<td>' + this.toleranciametamar + '</td>';//here
          }else{
            if(mes = "Abril"){
              html += '<td>' + this.toleranciametaabr + '</td>';//here
            }else{
              if(mes = "Maio"){
                html += '<td>' + this.toleranciametamai + '</td>';//here
              }else{
                if(mes = "Junho"){
                  html += '<td>' + this.toleranciametajun + '</td>';//here
                }else{
                  if(mes = "Julho"){
                    html += '<td>' + this.toleranciametajul + '</td>';//here
                  }else{
                    if(mes = "Agosto"){
                      html += '<td>' + this.toleranciametaago + '</td>';//here
                    }else{
                      if(mes = "Setembro"){
                        html += '<td>' + this.toleranciametaset + '</td>';//here
                      }else{
                        if(mes = "Outubro"){
                          html += '<td>' + this.toleranciametaout + '</td>';//here
                        }else{
                          if(mes = "Novembro"){
                            html += '<td>' + this.toleranciametanov + '</td>';//here
                          }else{
                            html += '<td>' + this.toleranciametadez + '</td>';//here       
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
      

    
      ////////-------------------------------------
      //MES FAIXA SUPERIOR
      if(mtj ==1){ 
     if(mes = "Janeiro"){
       html += '<td>' + this.metames + '</td>';   
      }else{
        if(mes = "Fevereiro"){
           html += '<td>' + this.metamesfev + '</td>';
        }else{
          if(mes = "Marco"){
             html += '<td>' + this.metamesmar + '</td>';
          }else{
            if(mes = "Abril"){
               html += '<td>' + this.metamesabr + '</td>';
            }else{
              if(mes = "Maio"){
                 html += '<td>' + this.metamesmai + '</td>';
              }else{
                if(mes = "Junho"){
                   html += '<td>' + this.metamesjun + '</td>';
                }else{
                  if(mes = "Julho"){
                     html += '<td>' + this.metamesjul + '</td>';
                  }else{
                    if(mes = "Agosto"){
                       html += '<td>' + this.metamesago + '</td>';
                    }else{
                      if(mes = "Setembro"){
                         html += '<td>' + this.metamesset + '</td>';
                      }else{
                        if(mes = "Outubro"){
                           html += '<td>' + this.metamesout + '</td>';
                        }else{
                          if(mes = "Novembro"){
                             html += '<td>' + this.metamesnov + '</td>';
                          }else{
                            html += '<td>' + this.metamesdez + '</td>';
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }else{
      if(mtj == 3){
        if(mes = "Janeiro"){
        html += '<td>' + this.toleranciameta + '</td>';
      }else{
        if(mes = "Fevereiro"){
          html += '<td>' + this.toleranciametafev + '</td>';//here
        }else{
          if(mes = "Marco"){
            html += '<td>' + this.toleranciametamar + '</td>';//here
          }else{
            if(mes = "Abril"){
              html += '<td>' + this.toleranciametaabr + '</td>';//here
            }else{
              if(mes = "Maio"){
                html += '<td>' + this.toleranciametamai + '</td>';//here
              }else{
                if(mes = "Junho"){
                  html += '<td>' + this.toleranciametajun + '</td>';//here
                }else{
                  if(mes = "Julho"){
                    html += '<td>' + this.toleranciametajul + '</td>';//here
                  }else{
                    if(mes = "Agosto"){
                      html += '<td>' + this.toleranciametaago + '</td>';//here
                    }else{
                      if(mes = "Setembro"){
                        html += '<td>' + this.toleranciametaset + '</td>';//here
                      }else{
                        if(mes = "Outubro"){
                          html += '<td>' + this.toleranciametaout + '</td>';//here
                        }else{
                          if(mes = "Novembro"){
                            html += '<td>' + this.toleranciametanov + '</td>';//here
                          }else{
                            html += '<td>' + this.toleranciametadez + '</td>';//here       
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
      }else{
        if(mes = "Janeiro"){
       html += '<td>' + this.metames + '</td>';   
      }else{
        if(mes = "Fevereiro"){
           html += '<td>' + this.metamesfev + '</td>';
        }else{
          if(mes = "Marco"){
             html += '<td>' + this.metamesmar + '</td>';
          }else{
            if(mes = "Abril"){
               html += '<td>' + this.metamesabr + '</td>';
            }else{
              if(mes = "Maio"){
                 html += '<td>' + this.metamesmai + '</td>';
              }else{
                if(mes = "Junho"){
                   html += '<td>' + this.metamesjun + '</td>';
                }else{
                  if(mes = "Julho"){
                     html += '<td>' + this.metamesjul + '</td>';
                  }else{
                    if(mes = "Agosto"){
                       html += '<td>' + this.metamesago + '</td>';
                    }else{
                      if(mes = "Setembro"){
                         html += '<td>' + this.metamesset + '</td>';
                      }else{
                        if(mes = "Outubro"){
                           html += '<td>' + this.metamesout + '</td>';
                        }else{
                          if(mes = "Novembro"){
                             html += '<td>' + this.metamesnov + '</td>';
                          }else{
                            html += '<td>' + this.metamesdez + '</td>';
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
      }
    }
      ///////------------------------------------------
     //VERIFICADO
     html += '<td>' + this.result_acum + '</td>';
     //CUMPRIMENTO
     var vfd = this.result_acum;
     var metajan = this.metames; 
     var metafev = this.metamesfev;
     var metamar = this.metamesmar;
     var metaabr = this.metamesabr;
     var metamai = this.metamesmai;
     var metajun = this.metamesjun;
     var metajul = this.metamesjul;
     var metaago = this.metamesago;
     var metaset = this.metamesset;
     var metaout = this.metamesout;
     var metanov = this.metamesnov;
     var metadez = this.metamesdez;
     var toljan = this.toleranciameta;
     var tolfev = this.toleranciametafev;
     var tolmar = this.toleranciametamar;
     var tolabr = this.toleranciametaabr;
     var tolmai = this.toleranciametamai;
     var toljun = this.toleranciametajun;
     var toljul = this.toleranciametajul;
     var tolago = this.toleranciametaago;
     var tolset = this.toleranciametaset;
     var tolout = this.toleranciametaout;
     var tolnov = this.toleranciametanov;
     var toldez = this.toleranciametadez;

     var verificainddep = this.desc_inddep; 
    if(verificainddep != "Nível de serviço" || verificainddep != "Conformidade em segurança e saúde do trabalho"){
     if(mtj == 2){
      if(vfd>=toljan ||vfd>=tolfev ||vfd>=tolmar ||vfd>=tolabr || vfd>=tolmai||vfd>=toljun ||vfd>=toljul ||vfd>=tolago ||vfd>=tolset || vfd>=tolout|| vfd>=tolnov|| vfd>=toldez && vfd<=metajan ||vfd<=metafev || vfd<=metamar||vfd<=metaabr ||vfd<=metamai ||vfd<=metajun || vfd<=metajul|| vfd<=metaago||vfd<=metaset ||vfd<=metaout ||vfd<=metanov || vfd<=metadez){
        html += '<td>' + "100%"+ '</td>';
      }else{
        html += '<td>' + "0%"+ '</td>';
      }    
    }else if(mtj == 1){ 
        if(vfd>=metajan ||vfd>=metafev || vfd>=metamar||vfd>=metaabr ||vfd>=metamai ||vfd>=metajun || vfd>=metajul|| vfd>=metaago||vfd>=metaset ||vfd>=metaout ||vfd>=metanov || vfd>=metadez){
          html += '<td>' + "100%"+ '</td>';
        }else{
          if(vfd<toljan ||vfd<tolfev ||vfd<tolmar ||vfd<tolabr || vfd<tolmai||vfd<toljun ||vfd<toljul ||vfd<tolago ||vfd<tolset || vfd<tolout|| vfd<tolnov|| vfd<toldez){
            html += '<td>' + "0%"+ '</td>';
          }else{
            //ANALISAR A CONDIÇÃO
            if(vfd<metajan && vfd >= toljan){var calc = vfd/metajan*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd<metafev && vfd >= tolfev){var calc = vfd/metafev*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd<metamar && vfd >= tolmar){var calc = vfd/metamar*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd<metaabr && vfd >= tolabr){var calc = vfd/metaabr*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd<metamai && vfd >= tolmai){var calc = vfd/metamai*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd<metajun && vfd >= toljun){var calc = vfd/metajun*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd<metajul && vfd >= toljul){var calc = vfd/metajul*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd<metaago && vfd >= tolago){var calc = vfd/metaago*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd<metaset && vfd >= tolset){var calc = vfd/metaset*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd<metaout && vfd >= tolout){var calc = vfd/metaout*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd<metanov && vfd >= tolnov){var calc = vfd/metanov*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd<metadez && vfd >= toldez){var calc = vfd/metadez*100; html += '<td>' + calc+"%" + '</td>';}
          }
        }      
    }else{
      if(vfd<=metajan ||vfd<=metafev || vfd<=metamar||vfd<=metaabr ||vfd<=metamai ||vfd<=metajun || vfd<=metajul|| vfd<=metaago||vfd<=metaset ||vfd<=metaout ||vfd<=metanov || vfd<=metadez){
        html += '<td>' + "100%"+ '</td>';
      }else{
        if(vfd>toljan ||vfd>tolfev ||vfd>tolmar ||vfd>tolabr || vfd>tolmai||vfd>toljun ||vfd>toljul ||vfd>tolago ||vfd>tolset || vfd>tolout|| vfd>tolnov|| vfd>toldez){
          html += '<td>' + "0%"+ '</td>';
        }else{
          //ANALISAR A CONDIÇÃO
            if(vfd>metajan && vfd <= toljan){var calc = vfd/toljan*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd>metafev && vfd <= tolfev){var calc = vfd/tolfev*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd>metamar && vfd <= tolmar){var calc = vfd/tolmar*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd>metaabr && vfd <= tolabr){var calc = vfd/tolabr*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd>metamai && vfd <= tolmai){var calc = vfd/tolmai*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd>metajun && vfd <= toljun){var calc = vfd/toljun*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd>metajul && vfd <= toljul){var calc = vfd/toljul*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd>metaago && vfd <= tolago){var calc = vfd/tolago*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd>metaset && vfd <= tolset){var calc = vfd/tolset*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd>metaout && vfd <= tolout){var calc = vfd/tolout*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd>metanov && vfd <= tolnov){var calc = vfd/tolnov*100; html += '<td>' + calc+"%" + '</td>';}
            if(vfd>metadez && vfd <= toldez){var calc = vfd/toldez*100; html += '<td>' + calc+"%" + '</td>';}
        }
      }
    }
     //STATUS
     if(mtj == 2){
      if(vfd>=toljan ||vfd>=tolfev ||vfd>=tolmar ||vfd>=tolabr || vfd>=tolmai||vfd>=toljun ||vfd>=toljul ||vfd>=tolago ||vfd>=tolset || vfd>=tolout|| vfd>=tolnov|| vfd>=toldez && vfd<=metajan ||vfd<=metafev || vfd<=metamar||vfd<=metaabr ||vfd<=metamai ||vfd<=metajun || vfd<=metajul|| vfd<=metaago||vfd<=metaset ||vfd<=metaout ||vfd<=metanov || vfd<=metadez){
        html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#0000FF" >' + "" + '</td>';
      }else{
        html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#FF0000" >' + "" + '</td>';
      }    
    }else if(mtj == 1){ 
        if(vfd>=metajan ||vfd>=metafev || vfd>=metamar||vfd>=metaabr ||vfd>=metamai ||vfd>=metajun || vfd>=metajul|| vfd>=metaago||vfd>=metaset ||vfd>=metaout ||vfd>=metanov || vfd>=metadez){
          html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#0000FF" >' + "" + '</td>';
        }else{
          if(vfd<toljan ||vfd<tolfev ||vfd<tolmar ||vfd<tolabr || vfd<tolmai||vfd<toljun ||vfd<toljul ||vfd<tolago ||vfd<tolset || vfd<tolout|| vfd<tolnov|| vfd<toldez){
            html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#FF0000">' + "" + '</td>';
          }else{
            //ANALISAR A CONDIÇÃO
            if(vfd<metajan && vfd >= toljan){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd<metafev && vfd >= tolfev){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd<metamar && vfd >= tolmar){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd<metaabr && vfd >= tolabr){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd<metamai && vfd >= tolmai){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd<metajun && vfd >= toljun){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd<metajul && vfd >= toljul){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd<metaago && vfd >= tolago){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd<metaset && vfd >= tolset){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd<metaout && vfd >= tolout){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd<metanov && vfd >= tolnov){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd<metadez && vfd >= toldez){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
          }
        }      
    }else{
      if(vfd<=metajan ||vfd<=metafev || vfd<=metamar||vfd<=metaabr ||vfd<=metamai ||vfd<=metajun || vfd<=metajul|| vfd<=metaago||vfd<=metaset ||vfd<=metaout ||vfd<=metanov || vfd<=metadez){
        html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#0000FF">' +"" + '</td>';
      }else{
        if(vfd>toljan ||vfd>tolfev ||vfd>tolmar ||vfd>tolabr || vfd>tolmai||vfd>toljun ||vfd>toljul ||vfd>tolago ||vfd>tolset || vfd>tolout|| vfd>tolnov|| vfd>toldez){
          html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#FF0000">' + "" + '</td>';
        }else{
          //ANALISAR A CONDIÇÃO
            if(vfd>metajan && vfd <= toljan){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd>metafev && vfd <= tolfev){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd>metamar && vfd <= tolmar){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd>metaabr && vfd <= tolabr){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd>metamai && vfd <= tolmai){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd>metajun && vfd <= toljun){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd>metajul && vfd <= toljul){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd>metaago && vfd <= tolago){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd>metaset && vfd <= tolset){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd>metaout && vfd <= tolout){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd>metanov && vfd <= tolnov){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
            if(vfd>metadez && vfd <= toldez){html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00">' + "" + '</td>';}
        }
      }
    } 
  }else{
    if(verificainddep == "Nível de serviço"){
      if(vfd<toljan ||vfd<tolfev ||vfd<tolmar ||vfd<tolabr || vfd<tolmai||vfd<toljun ||vfd<toljul ||vfd<tolago ||vfd<tolset || vfd<tolout|| vfd<tolnov|| vfd<toldez){
        html += '<td>' + "0%"+ '</td>';

      }else if(vfd>=metajan ||vfd>=metafev || vfd>=metamar||vfd>=metaabr ||vfd>=metamai ||vfd>=metajun || vfd>=metajul|| vfd>=metaago||vfd>=metaset ||vfd>=metaout ||vfd>=metanov || vfd>=metadez){
        html += '<td>' + "100%"+ '</td>';
      }else{
        if(vfd<metajan ||vfd<metafev || vfd<metamar||vfd<metaabr ||vfd<metamai ||vfd<metajun || vfd<metajul|| vfd<metaago||vfd<metaset ||vfd<metaout ||vfd<metanov || vfd<metadez && vfd >=85){
          html += '<td>' + "75%"+ '</td>';
        }else{
          html += '<td>' + "50%"+ '</td>';
        }
      }


    }else{
      if(verificainddep == "Conformidade em segurança e saúde do trabalho"){

        if(vfd>=90 && vfd <=100){
          html += '<td>' + "100%"+ '</td>';
        }else if(vfd>=80 && vfd <=89.99){
          html += '<td>' + "90%"+ '</td>';
        }else if(vfd>=70 && vfd <=79.99){
          html += '<td>' + "80%"+ '</td>';
        }else if(vfd>=60 && vfd <=69.99){
          html += '<td>' + "70%"+ '</td>';
        }else if(vfd>=50 && vfd <=59.99){
          html += '<td>' + "60%"+ '</td>';
        }else if(vfd>=40 && vfd <=49.99){
          html += '<td>' + "50%"+ '</td>';
        }else if(vfd>=30 && vfd <=39.99){
          html += '<td>' + "40%"+ '</td>';
        }else if(vfd>=0 && vfd <=29.99){
          html += '<td>' + "0%"+ '</td>';
        }

      }
    }

    // STATUS DAS EXEÇÕES

   if(verificainddep == "Nível de serviço"){
      if(vfd<toljan ||vfd<tolfev ||vfd<tolmar ||vfd<tolabr || vfd<tolmai||vfd<toljun ||vfd<toljul ||vfd<tolago ||vfd<tolset || vfd<tolout|| vfd<tolnov|| vfd<toldez){
        html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#FF0000" >' + "" + '</td>';

      }else if(vfd>=metajan ||vfd>=metafev || vfd>=metamar||vfd>=metaabr ||vfd>=metamai ||vfd>=metajun || vfd>=metajul|| vfd>=metaago||vfd>=metaset ||vfd>=metaout ||vfd>=metanov || vfd>=metadez){
        html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#0000FF" >' + "" + '</td>';
      }else{
        if(vfd<metajan ||vfd<metafev || vfd<metamar||vfd<metaabr ||vfd<metamai ||vfd<metajun || vfd<metajul|| vfd<metaago||vfd<metaset ||vfd<metaout ||vfd<metanov || vfd<metadez && vfd >=85){
          html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00" >' + "" + '</td>';
        }else{
          html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00" >' + "" + '</td>';
        }
      }


    }else{
      if(verificainddep == "Conformidade em segurança e saúde do trabalho"){
        if(vfd>=90 && vfd <=100){
         html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#0000FF" >' + "" + '</td>';
        }else if(vfd>=80 && vfd <=89.99){
          html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00" >' + "" + '</td>';
        }else if(vfd>=70 && vfd <=79.99){
         html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00" >' + "" + '</td>';
        }else if(vfd>=60 && vfd <=69.99){
          html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00" >' + "" + '</td>';
        }else if(vfd>=50 && vfd <=59.99){
         html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00" >' + "" + '</td>';
        }else if(vfd>=40 && vfd <=49.99){
          html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00" >' + "" + '</td>';
        }else if(vfd>=30 && vfd <=39.99){
         html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#7FFF00" >' + "" + '</td>';
        }else if(vfd>=0 && vfd <=29.99){
          html += '<td style="-webkit-print-color-adjust: exact;" bgcolor = "#FF0000" >' + "" + '</td>';
        }

      }
    }

  }
  

     html += '</tr>';

   });
  $('#resultado_busca').html(html);
  });
});


  </script>

  <style type="text/css">
  

  body {
  font-family: 'PT Sans', sans-serif;
  font-size: 13px;
  font-weight: 400;
  color: #4f5d6e;
  position: relative;
  background: rgb(26, 49, 95);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(26, 49, 95, 1)), color-stop(10%, rgba(26, 49, 95, 1)), color-stop(24%, rgba(29, 108, 141, 1)), color-stop(37%, rgba(41, 136, 151, 1)), color-stop(77%, rgba(39, 45, 100, 1)), color-stop(90%, rgba(26, 49, 95, 1)), color-stop(100%, rgba(26, 49, 95, 1)));
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#1a315f', endColorstr='#1a315f', GradientType=0);
}



.body-wrap {
  min-height: 700px;
}

.body-wrap {
  position: relative;
  z-index: 0;
}

.body-wrap:before,
.body-wrap:after {
  content: '';
  position: absolute;font-family: 'PT Sans', sans-serif;
  font-size: 13px;
  font-weight: 400;
  color: #4f5d6e;
  position: relative;
  background: rgb(26, 49, 95);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(26, 49, 95, 1)), color-stop(10%, rgba(26, 49, 95, 1)), color-stop(24%, rgba(29, 108, 141, 1)), color-stop(37%, rgba(41, 136, 151, 1)), color-stop(77%, rgba(39, 45, 100, 1)), color-stop(90%, rgba(26, 49, 95, 1)), color-stop(100%, rgba(26, 49, 95, 1)));
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#1a315f', endColorstr='#1a315f', GradientType=0);
}

.body-wrap {
  min-height: 150px;
}

.body-wrap {
  position: relative;
  z-index: 0;
}

.body-wrap:before,
.body-wrap:after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  z-index: -1;
  height: 260px;
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(26, 49, 95, 1)), color-stop(100%, rgba(26, 49, 95, 0)));
  background: linear-gradient(to bottom, rgba(26, 49, 95, 1) 0%, rgba(26, 49, 95, 0) 100%);
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#1a315f', endColorstr='#001a315f', GradientType=0);
}

.body-wrap:after {
  top: auto;
  bottom: 0;
  background: linear-gradient(to bottom, rgba(26, 49, 95, 0) 0%, rgba(26, 49, 95, 1) 100%);
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#001a315f', endColorstr='#1a315f', GradientType=0);
}

nav {
  margin-top: 60px;
  box-shadow: 5px 4px 5px #000;
}
  top: 0;
  left: 0;
  right: 0;
  z-index: -1;
  height: 260px;
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(26, 49, 95, 1)), color-stop(100%, rgba(26, 49, 95, 0)));
  background: linear-gradient(to bottom, rgba(26, 49, 95, 1) 0%, rgba(26, 49, 95, 0) 100%);
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#1a315f', endColorstr='#001a315f', GradientType=0);
}

.body-wrap:after {
  top: auto;
  bottom: 0;
  background: linear-gradient(to bottom, rgba(26, 49, 95, 0) 0%, rgba(26, 49, 95, 1) 100%);
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#001a315f', endColorstr='#1a315f', GradientType=0);
}

nav {
  margin-top: 60px;
  box-shadow: 5px 4px 5px #000;
}

body{
  color: #FFFAFA;
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