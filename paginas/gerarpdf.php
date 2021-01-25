<?php
include_once("pdf/mpdf.php");





/*if(isset($_POST['confirmar'])){
$t = 1;
$n = "aleff Bruno Gama da Silva";
$saida =
		
		"<html>
			<body>
				<h1> MEU PDF </h1>
				<ul>
					<li>PHP</li>
					<li>HTML</li>
					<li>PDF</li>
					<li> $t </li>
					<li> $n </li>
					
				</ul>
			</body>
		</html>
		";

$arquivo = "testepdf.pdf";

$mpdf = new mPDF();
$mpdf->WriteHTML($saida);

//	F- salva o arquivo
// I- abre o navegador
// D- chama o prompt 
$mpdf->Output($arquivo, 'I');
echo "PDF gerado com sucesso!";
}*/
?>
<style type="text/css">
 
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
}

</style>
<div id="printable">
<h1>Gerar PDF</h1>
</div>

<div id="notprint">
<input value="Cadastrar Diretoria" name="confirmar" type="submit" onClick="self.print();">
<input value="Imprimir" name="imp" type="submit" onClick="self.print();" class ="btn btn-primary" >
</div>



