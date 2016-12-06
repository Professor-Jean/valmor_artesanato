<style>
  .bucket_image{
    width: 25px !important;
    height: 25px !important;
    border: none !important;
  }
</style>

<?php

  function exclusaoSegura($value, $action, $value2=NULL, $value3=NULL){
    //Criando um nome de formulário único.
    $formName = md5($value.time());
    //Criptografando o valor para ser mais difícil acesso ao usuário.
    $criptoValue = md5($value);

    $input_name = "id";

    //Iniciando o link seguro com a criação do formulário.
    $safeLink = "<form name='".$formName."' action='".$action."' method='POST'>";
    //Incrementando o campo hidden que conterá o valor do registro a ser excluído.
    $safeLink .= "<input type='hidden' name='".$input_name."' value='".$criptoValue."'>";

    if($value2!=""){
      $criptoValue2 = md5($value2);
      $safeLink .= "<input type='hidden' name='enderecos_id' value='".$criptoValue2."'>";
    }

    if($value3!=""){
      $criptoValue3 = md5($value3);
      $safeLink .= "<input type='hidden' name='usuarios_id' value='".$criptoValue3."'>";
    }

    //Incrementando o elemento que acionará o formulário com a imagem de deletar, verifique o src da imagem.
    $safeLink .= "<input class='bucket_image' type='image' src='../visual/imagens/excluir.png' title='Excluir Registro'/>";
    //Fechando o formulário.
    $safeLink .= "</form>";

    //Retornando o formulário.
    return $safeLink;

  }

?>
