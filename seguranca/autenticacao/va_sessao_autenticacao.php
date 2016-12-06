<?php

  if(!isset($_SESSION['idSessao'])){
    header("Location: ".BASE_URL."seguranca/autenticacao/va_logout_autenticacao.php");
    exit;
  }else if($_SESSION['idSessao']!=session_id()){
    header("Location: ".BASE_URL."seguranca/autenticacao/va_logout_autenticacao.php");
    exit;
  }
?>
