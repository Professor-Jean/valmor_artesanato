<?php

  if($permissao_acesso==0&&$_SESSION['permissao']!=0){
    header('Location: va_principal_sistema.php?msg=<h1>Você não tem permissão para ver essa página.</h1>');
  }

?>
