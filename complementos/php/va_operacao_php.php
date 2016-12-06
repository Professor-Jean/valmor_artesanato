<?php

  /*******************************************************

  Autor: Arthur Paiva Camilo, Henrique Werner Junkes, Matheus Leitzke e Thiago Nicolodi
  Data de Criação: 10/10/2016
  Data de Modificação: 18/11/2016
  Descrição: Página dinâmica para as funções de inserir,
             deletar e alterar no backend do administrador
             do software.

  *******************************************************/

  function adicionar($adc_tabela, $adc_dados){

    //Numerando os campos para ter eles como texto
    $adc_campos = array_keys($adc_dados);
    //Contando o número de campos.
    $adc_n_campos = count($adc_dados);
    //Sintaxe inicial do insert
    $adc_sintaxe = "INSERT INTO ".$adc_tabela." (";

    for($adc_aux=0; $adc_aux<$adc_n_campos; $adc_aux++){ // For para verificar e escrever todos os campos
      $adc_sintaxe .= $adc_campos[$adc_aux].", ";
    }
    //Tudo a partir de zero menos as ultimas duas coisas
    $adc_sintaxe = substr($adc_sintaxe, 0, -2);

    $adc_sintaxe .= ") VALUES (";

    for($adc_aux=0; $adc_aux<$adc_n_campos; $adc_aux++){
      if($adc_dados[$adc_campos[$adc_aux]]!=""){
        $adc_sintaxe .= "'".addslashes($adc_dados[$adc_campos[$adc_aux]])."', "; //addslashes para não ter o erro de aspas simples ou caracteres que danfiquem o código.
      }else{
        $adc_sintaxe .= "NULL, "; //Transformar tudo o que é vazio para null.
      }
    }

    $adc_sintaxe = substr($adc_sintaxe, 0, -2);

    $adc_sintaxe .= ")";
    $adc_sintaxe;
    global $conexaobd;
    $adc_preparado = $conexaobd->prepare($adc_sintaxe);
    $adc_resultado = $adc_preparado->execute();
    return $adc_resultado;

  }

  function alterar($alt_tabela, $alt_dados, $alt_condicao){

    $alt_campos = array_keys($alt_dados);
    $alt_n_dados = count($alt_campos);

    $alt_sintaxe = "UPDATE ".$alt_tabela." SET ";

    for($alt_aux=0; $alt_aux<$alt_n_dados; $alt_aux++){
      if($alt_dados[$alt_campos[$alt_aux]]!=""){
        $alt_sintaxe .= $alt_campos[$alt_aux]."=\"".addslashes($alt_dados[$alt_campos[$alt_aux]])."\", "; //addslashes para não ter o erro de aspas simples ou caracteres que danfiquem o código.
      }else{
        $alt_sintaxe .= $alt_campos[$alt_aux]."= NULL, "; //Transformar tudo o que é vazio para null.
      }
    }

    $alt_sintaxe = substr($alt_sintaxe, 0, -2);

    $alt_sintaxe .= " WHERE ".$alt_condicao;

    global $conexaobd;

    $alt_preparado = $conexaobd->prepare($alt_sintaxe);
    $alt_resultado = $alt_preparado->execute();

    return $alt_resultado;

  }

  function deletar($del_tabela, $del_condicao){

    $del_sintaxe = "DELETE FROM ".$del_tabela." WHERE ".$del_condicao;

    global $conexaobd;

    $del_preparado = $conexaobd->prepare($del_sintaxe);
    $del_resultado = $del_preparado->execute();

    return $del_resultado;

  }

?>
