<?php
//destroi a sessão fazendo com que volte para a página início
  session_destroy();
  unset($_SESSION);
  header('Location: index.php?pagina=inicio');
  exit;
?>