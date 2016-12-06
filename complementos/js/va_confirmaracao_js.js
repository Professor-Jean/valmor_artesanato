function confirmar_exclusao(tipo,nome){
  return confirm("Você realmente deseja excluir \'"+tipo+": "+nome+"\'");
}
function confirmar_alteracao(status,tipo,nome){
  return confirm("Você realmente deseja alterar para \'"+status+"\' o \'"+tipo+": "+nome+"\'");
}
