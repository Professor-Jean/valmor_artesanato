<?php
function reposicaoMensagem($caso, $assunto, $operacao){
  $texto = "Nenhuma mensagem encontrada para essa ação...";

  switch($caso){
    case "validacao" : {
      $texto = "O campo ".$assunto." foi preenchido incorretamente ";
    }
    break;
    case "bancodedados" : {
      $texto = "Erro na(o) ".$operacao." do(a) ".$assunto;
    }
    break;
    case "sucesso" : {
      $texto = $operacao." de ".$assunto." efetuado(a) com sucesso";
    }
    break;
    case "existencia" : {
      $texto = "Este(a) ".$assunto." já existe";
    }
    break;
    case "integridade" : {
      $texto = "Há outro registro associado com este registro de ".$assunto;
    }
    break;
    case "vazio" : {
      $texto = "Não a registro de ".$assunto;
    }
    break;
    case "status" : {
      $texto = "Este orçamento já foi ".$assunto;
    }
    break;
    case "data" : {
      $texto = "A data ".$assunto." foi preenchida para antes da data de saída";
    }
    break;
  }
  return $texto;
}
?>
