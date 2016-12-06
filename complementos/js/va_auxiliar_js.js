function catchContent(){
  var dados="";

  $('.imprimir').each(function(){
    dados += $(this).html();
  });

  if(dados!=""){
    $('#dadospdf').val(dados);
    return true;
  }

  alert("Problema ao gerar o PDF, recarregue a página e tente novamente.");
  return false;
  
}
