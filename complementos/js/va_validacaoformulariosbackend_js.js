/*
•Autores: Arthur Paiva Camilo, Henrique Werner Junkes, Matheus Leitzke e Thiago Nicolodi
•Data de criação: 10/10/2016
•Última data de modificação: 21/11/2016
*/

//FORMULÁRIOS DE INSERÇÃO

//Validar clientes

//Validação Materias-Primas
function validarFormInsMateriasPrimas(){
  if(document.frminsmateriasprimas.txtnome.value==""){
      alert("Preencha corretamente o campo Nome");
      document.frminsmateriasprimas.txtnome.focus();
    }else{
        return true;
    }
  return false;
}

//Validação de Categorias
function validarFormInsCategorias(){
  if(document.frminscategorias.txtcategoria.value==""){
					alert("Preencha o campo categoria");
					document.frminscategorias.txtcategoria.focus();
				}else{
				    return true;
				}
	return false;
}

//Validação de Saída para Manutenção
function validarFormInsSaidaManutencao(){
  if(document.frminssaidamanutencoes.txtdatasaida.value==""){
      	alert("Preencha o campo data de saída");
      	document.frminssaidamanutencoes.txtdatasaida.focus();
      }else if(document.frminssaidamanutencoes.txtdataprevistaretorno.value==""){
          alert("Preencha o campo data prevista de retorno");
        	document.frminssaidamanutencoes.txtdataprevistaretorno.focus();
        }else if(document.frminssaidamanutencoes.txtvalor.value==""){
            alert("Preencha o campo valor");
            document.frminssaidamanutencoes.txtvalor.focus();
  				}else{
  				    return true;
  				}
	return false;
}


//Validação de Produtos
function validarFormInsProdutos(){
  if(document.frminsprodutos.txtnome.value==""){
					alert("Preencha o campo nome");
					document.frminsprodutos.txtnome.focus();
        }else if(document.frminsprodutos.selcategoria.value==""){
      					alert("Preencha o campo categoria");
      					document.frminsprodutos.selcategoria.focus();
              }else if(document.frminsprodutos.txtaltura.value==""){
            					alert("Preencha o campo altura");
            					document.frminsprodutos.txtaltura.focus();
                    }else if(document.frminsprodutos.txtlargura.value==""){
                  					alert("Preencha o campo largura");
                  					document.frminsprodutos.txtlargura.focus();
                          }else if(document.frminsprodutos.txtprofundidade.value==""){
                        					alert("Preencha o campo profundidade");
                        					document.frminsprodutos.txtprofundidade.focus();
                                }else if(document.frminsprodutos.txtnumeropecas.value==""){
                              					alert("Preencha o campo número de peças");
                              					document.frminsprodutos.txtnumeropecas.focus();
                                      }else if(document.frminsprodutos.txtpreco.value==""){
                                              alert("Preencha o campo preço");
                                              document.frminsprodutos.txtpreco.focus();
                                            }else{
                                    				    return true;
                                    				}
  return false;
}

//Validação de clientes

function validarFormInsClientes(){
  if(document.frminsclientes.txtnome.value==""){
					alert("Preencha o campo nome");
					document.frminsclientes.txtnome.focus();
        }else if(document.frminsclientes.txtemail.value==""){
      					alert("Preencha o campo e-mail");
      					document.frminsclientes.txtemail.focus();
              }else if(document.frminsclientes.txttelefone.value==""){
            					alert("Preencha o campo telefone");
            					document.frminsclientes.txttelefone.focus();
                    }else{
                        return true;
                    }
  return false;
}


//FORMULÁRIOS DE ALTERAÇÃO

//Validação Materias-Primas
function validarFormAltMateriasPrimas(){
  if(document.frmaltmateriasprimas.txtnome.value==""){
      alert("Preencha corretamente o campo Nome");
      document.frmaltmateriasprimas.txtnome.focus();
    }else{
        return true;
    }
  return false;
}
function validarFormAltCategorias(){
  if(document.frmaltcategorias.txtcategoria.value==""){
					alert("Preencha o campo categoria");
					document.frmaltcategorias.txtcategoria.focus();
				}else{
				    return true;
				}
	return false;
}

function validarFormAltProdutos(){
  if(document.frmaltprodutos.txtnome.value==""){
					alert("Preencha o campo nome");
					document.frmaltprodutos.txtnome.focus();
        }else if(document.frmaltprodutos.selcategoria.value==""){
                alert("Preencha o campo categoria");
                document.frmaltprodutos.selcategoria.focus();
              }else if(document.frmaltprodutos.txtaltura.value==""){
            					alert("Preencha o campo altura");
            					document.frmaltprodutos.txtaltura.focus();
                    }else if(document.frmaltprodutos.txtlargura.value==""){
                  					alert("Preencha o campo largura");
                  					document.frmaltprodutos.txtlargura.focus();
                          }else if(document.frmaltprodutos.txtprofundidade.value==""){
                        					alert("Preencha o campo profundidade");
                        					document.frmaltprodutos.txtprofundidade.focus();
                                }else if(document.frmaltprodutos.txtnumeropecas.value==""){
                              					alert("Preencha o campo número de peças");
                              					document.frmaltprodutos.txtnumeropecas.focus();
                                      }else if(document.frmaltprodutos.txtpreco.value==""){
                                              alert("Preencha o campo preço");
                                              document.frmaltprodutos.txtpreco.focus();
                                      }else{
                              				    return true;
                              				}
  return false;
}

// Manutenções
function validarFormAltSaidaManutencao(){
  if(document.frmaltsaidamanutencoes.txtdatasaida.value==""){
      	alert("Preencha o campo data de saída");
      	document.frmaltsaidamanutencoes.txtdatasaida.focus();
      }else if(document.frmaltsaidamanutencoes.txtdataprevistaretorno.value==""){
          alert("Preencha o campo data prevista de retorno");
        	document.frmaltsaidamanutencoes.txtdataprevistaretorno.focus();
        }else if(document.frmaltsaidamanutencoes.txtvalor.value==""){
            alert("Preencha o campo valor");
            document.frmaltsaidamanutencoes.txtvalor.focus();
  				}else{
  				    return true;
  				}
	return false;
}

function validarFormInsRetornoManutencao(){
    if(document.frminsretornomanutencao.txtdataretorno.value==""){
        alert("Preencha o campo data de retorno");
      	document.frminsretornomanutencao.txtdataprevistaretorno.focus();
      }else if(document.frminsretornomanutencao.txtvalor.value==""){
          alert("Preencha o campo valor");
          document.frminsretornomanutencao.txtvalor.focus();
				}else{
				    return true;
				}
	return false;
}

// Funcionários
function validarFormAltFuncionarios(){
  if(document.frminsfuncionarios.txtnome.value==""){
					alert("Preencha o campo nome");
					document.frminsfuncionarios.txtnome.focus();
        }else if(document.frminsfuncionarios.txtcargo.value==""){
                alert("Preencha o campo cargo");
                document.frminsfuncionarios.txtcargo.focus();
              }else if(document.frminsfuncionarios.txttelefone.value==""){
            					alert("Preencha o campo Telefone");
            					document.frminsfuncionarios.txttelefone.focus();
                    }else if(((document.frminsfuncionarios.txtusuario.value!="")||(document.frminsfuncionarios.pwdsenha.value!=""))&&(document.frminsfuncionarios.selpermissao.value=="")){
                        alert("Preencha o campo Permissão");
                        document.frminsfuncionarios.selpermissao.focus();
                      }else if(((document.frminsfuncionarios.selpermissao.value!="")||(document.frminsfuncionarios.pwdsenha.value!=""))&&(document.frminsfuncionarios.txtusuario.value=="")){
                          alert("Preencha o campo Usuário");
                          document.frminsfuncionarios.txtusuario.focus();
                        }else if(((document.frminsfuncionarios.txtusuario.value!="")||(document.frminsfuncionarios.selpermissao.value!=""))&&(document.frminsfuncionarios.pwdsenha.value=="")){
                            alert("Preencha o campo Senha");
                            document.frminsfuncionarios.pwdsenha.focus();
                          }else{
                  				    return true;
                  				}
  return false;
}

function validarFormAltFuncionarios(){
  if(document.frminsfuncionarios.txtnome.value==""){
					alert("Preencha o campo nome");
					document.frminsfuncionarios.txtnome.focus();
        }else if(document.frminsfuncionarios.txtcargo.value==""){
                alert("Preencha o campo cargo");
                document.frminsfuncionarios.txtcargo.focus();
              }else if(document.frminsfuncionarios.txttelefone.value==""){
            					alert("Preencha o campo Telefone");
            					document.frminsfuncionarios.txttelefone.focus();
                    }else if(((document.frminsfuncionarios.txtusuario.value!="")||(document.frminsfuncionarios.pwdsenha.value!=""))&&(document.frminsfuncionarios.selpermissao.value=="")){
                        alert("Preencha o campo Permissão");
                        document.frminsfuncionarios.selpermissao.focus();
                      }else if(((document.frminsfuncionarios.selpermissao.value!="")||(document.frminsfuncionarios.pwdsenha.value!=""))&&(document.frminsfuncionarios.txtusuario.value=="")){
                          alert("Preencha o campo Usuário");
                          document.frminsfuncionarios.txtusuario.focus();
                        }else if(((document.frminsfuncionarios.txtusuario.value!="")||(document.frminsfuncionarios.selpermissao.value!=""))&&(document.frminsfuncionarios.pwdsenha.value=="")){
                            alert("Preencha o campo Senha");
                            document.frminsfuncionarios.pwdsenha.focus();
                          }else{
                  				    return true;
                  				}
  return false;
}

//Validação Clientes

function validarFormAltClientes(){
  if(document.frmaltclientes.txtnome.value==""){
					alert("Preencha o campo nome");
					document.frmaltclientes.txtnome.focus();
        }else if(document.frmaltclientes.txtemail.value==""){
      					alert("Preencha o campo e-mail");
      					document.frmaltclientes.txtemail.focus();
              }else if(document.frmaltclientes.txttelefone.value==""){
            					alert("Preencha o campo telefone");
            					document.frmaltclientes.txttelefone.focus();
                    }else{
                        return true;
                    }
  return false;
}

//validacao Máquinas
 function validarFormInsMaquinas(){
   if(document.frminsmaquinas.txtmarca.value==""){
 					alert("Preencha o campo marca");
 					document.frminsmaquinas.txtmarca.focus();
        }else if(document.frminsmaquinas.txtmodelo.value==""){
     					alert("Preencha o campo modelo");
     					document.frminsmaquinas.txtmodelo.focus();
           }else{
               return true;
           }
    return false;
 }
 function validarFormAltMaquinas(){
   if(document.frmaltmaquinas.txtmarca.value==""){
 					alert("Preencha o campo marca");
 					document.frmaltmaquinas.txtmarca.focus();
        }else if(document.frmaltmaquinas.txtmodelo.value==""){
     					alert("Preencha o campo modelo");
     					document.frmaltmaquinas.txtmodelo.focus();
           }else{
               return true;
           }
    return false;
 }
