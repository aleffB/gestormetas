<?php
//////////////////////////////////////////////////////////////////////////


///// VERSÃO TESTE//////////


/////////////////////////////////////////////////////////


if(isset($_POST['voltar'])){
 
 header('Location: index.php?pagina=inicio');
}

if(!isset($_SESSION['nomeuser_adm']) && !isset($_SESSION['login_adm'])){
  header('Location: ?pagina=inicio');
  exit;
} 


//Transferir o arquivo
if (isset($_POST['submit'])) {
 
    if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
        echo "<h1>" . "File ". $_FILES['filename']['name'] ." transferido com sucesso ." . "</h1>";
        echo "<h2>Exibindo o conteúdo:</h2>";
        readfile($_FILES['filename']['tmp_name']);
    }

    //Importar o arquivo transferido para o banco de dados
    $handle = fopen($_FILES['filename']['tmp_name'], "r");
 
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $import="INSERT into indicadordepartamental(id_indempre,anob,desc_inddep,melhor_traj,acumulativo,und_med,formula)values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]')";
 
       $mysqli->query($import) or die($mysqli->error);
    }
 
    fclose($handle);
 
    print "Importação feita.";
 
//Visualizar formulário de transferência
} else {
	print "<center><div id='etapa' style='width: 400px;''>";
	print "<!-- Latest compiled and minified CSS -->
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>

  <!-- Optional theme -->
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' integrity='sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp' crossorigin='anonymous'>";
  print "";
 
    print "<h1> Inserir dados do tipo CSV, Indicador Departamental</h1><br />\n";

    print "para transferir, selecione o arquivo e clique no botão Upload ";
 
    print "<form enctype='multipart/form-data' action='#' method='post' style='margin-top: 100px'>";
 
    print "Nome do arquivo para importar:<br />\n";
 
    print "<input size='50' type='file' name='filename'><br />\n";
 
    print "<input type='submit' name='submit' value='Upload' class ='btn btn-success'></form>";

    print " <!-- Latest compiled and minified JavaScript -->
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>";

 
}
 
?>

<form action="" method="POST">
<input type="submit" name="voltar" value="Voltar" class ="btn btn-primary" style="margin-top: 100px">
</form>