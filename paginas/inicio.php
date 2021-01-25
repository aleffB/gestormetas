 <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <center>
  <h1>Managment System</h1>
<div  id="login" style="width: 400px;">   

            <h3 style="margin-top: 100px">Login</h3>  
       <form action="" method="POST" enctype="multipart/form-data">

                  <p><input type="text" name="usuario" id="usuario" placeholder ="Úsuario" maxlength="14" class="form form-control" style="text-align: center;" ></p>

                  <p><input type="password" name="senha" id="senha"  placeholder ="*******" maxlength="16" class="form form-control" style="text-align: center;"></p>

                  <p><input type = "submit" value="Entrar" class ="btn btn-success"/></p>

                  <input type="hidden" name="entrar" value="login">	
                  <p><a href="?pagina=recuser">Recuperar senha ou alterar senha</a>


        </form>
      </div></center>

      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
       <?php
       // SE HOUVER SESSÃO COM O NOME DE USUARIO E O LOGIN, ELE VOLTA PARA PAGINA REQUERIDA
       if(isset($_SESSION['nomeuser_adm']) && isset($_SESSION['login_adm'])){
                header('Location: ?pagina=inicial');
                exit;
              }
 
           // VERIFICANDO SE CLICOU EM ENTRAR
          if(isset($_POST['entrar']) && $_POST['entrar'] == "login"){
               //PEGANDO OS VALORES DOS CAMPOS
              $usuario = $_POST['usuario'];
              $senha = $_POST['senha'];
               //VERIFICANDO SE OS CAMPOS ESTÃO VAZIOS
              if(empty($usuario) || empty($senha)){
                echo "<center>Preencha todos os campos</center>";
              }else{
                //VERIFICANDO SE EXISTE A CONTA
                $sql_code = "SELECT login_adm,senha_adm,nomeuser_adm,validador,datafinal_adm,id_orgao FROM administrador WHERE login_adm ='$usuario' AND senha_adm= '$senha'";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        $linha = $sql_query->fetch_assoc();
         $data = date("Y-m-d");
        $dataultima = $linha['datafinal_adm'];
        //SE FOR MAIOR QUE 0 SALVA O NOME DO USER E O LOGIN, VALIDADOR E O ORGÃO NA SESSAO PARA NAVEGAR E ABRE A PAGINA SOLCITADA
        if($linha >0){
          if(strtotime($data)<strtotime($dataultima)){
          $_SESSION['nomeuser_adm'] = $linha['nomeuser_adm'];
          $_SESSION['login_adm'] = $linha['login_adm'];
          $_SESSION['validador'] = $linha['validador'];
          $_SESSION['id_orgao'] = $linha['id_orgao'];
          header('location: ?pagina=inicial');
          exit;
        }else{
          // VERIFICA SE A DATA ESTÁ EM DIA 
          if(strtotime($data)>=strtotime($dataultima)){
            echo "<center>Lamentamos, mas sua conta expirou, por favor, fale com o administrador.</center>";
          }
        }
          // SE NAO DIZ QUE NAO EXISTE O USUARIO
        }else{
          if($linha<=0){
          echo "<center>Usuário e/ou senha inválido(s).</center>";
        }
        }
              }

          }

     ?>