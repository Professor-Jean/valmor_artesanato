<?php
  $nome_servidor = $_SERVER['SERVER_NAME'];
  $nome_projeto = "va_ahmt";
  define("BASE_URL", "http://".$nome_servidor.DIRECTORY_SEPARATOR.$nome_projeto.DIRECTORY_SEPARATOR);
  include "autenticacao/va_sessao_autenticacao.php";
?>
