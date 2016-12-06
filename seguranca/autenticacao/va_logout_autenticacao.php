<?php
	session_start(); //Iniciar sessão
	session_unset(); //Destroi variaveis da sessão
	session_destroy(); //Destroi sessão
	header ('Location: ../../index.php'); //Redireciona para a index
?>
