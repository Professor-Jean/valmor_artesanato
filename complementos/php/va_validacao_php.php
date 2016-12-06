<?php

/*******************************************************************************

Autor: Arthur Paiva Camilo.
Descrição: Página para validação utilizando expressões regulares.
Data de Criação: 03/05/2016
Data de Alteração: 03/05/2016

*******************************************************************************/
//Checar datas.
function checar_data($tdata){

  if(substr_count($tdata, "/")<>2){
    return false;
  }else{

    $data = explode("/", $tdata);

    if(is_numeric($data[1]) && is_numeric($data[0]) && is_numeric($data[2])){
      if(checkdate($data[1], $data[0], $data[2])){
        return true;
        }else{
          return false;
        }
      }else{
      return false;
    }
  }
}

//Checar número
function checar_numero($tnumero){

  if(is_numeric($tnumero)){

      return true;
  }else {
    return false;
  }
}


//Vazio
function checar_vazio($tcampo){
  if(trim($tcampo)==""){
    return false;
  }else{
    return true;
  }
}

function checar_vazio_espaco($tcampo){
  if(trim($tcampo)&&($tcampo!="")){
    return true;
  }else{
    return false;
  }
}

?>
