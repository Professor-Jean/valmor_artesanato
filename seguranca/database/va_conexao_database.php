<?php

  include "va_configuracao_database.php";
  //Arquivo para conexão de banco de dados.
  try { //tente
    $conexaobd = new PDO("mysql:host=localhost; dbname=va_bd; charset=utf8", "root", "root"); //PDO(PHP DIRECT OBJECT) = host, usuario, senha
  } catch (PDOException $e) { //Caso não aconteça, pegue a excessão e a armazene na variavel $e de exception
    die ('Erro ao se conectar com o banco de dados: '.$e->getMessage()); //die = faz o programa parar de funcionar e da a mensagem.
  }
?>
