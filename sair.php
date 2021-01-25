<?php
//destroi a sessão fazendo com que redirecione para página index
  @session_start();
  session_destroy();
  unset($_SESSION);
  header('Location: index.php');
  exit;
?>