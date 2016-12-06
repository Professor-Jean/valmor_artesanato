<?php
  $permissao_acesso = 1;
?>

<h1> Aviso de Alteração de Produtos</h1>
<?php
  $msg = "";
  $operacao = "Alteração";

  //Recebendo var
  $p_produtoid = $_POST['hidprodutoid'];
  $p_nome = $_POST['txtnome'];
  $p_categoriaid = $_POST['selcategoria'];
  $p_imagem = $_POST['txtimagem'];
  $p_altura = str_replace(',', '.', $_POST['txtaltura']);
  $p_largura = str_replace(',', '.', $_POST['txtlargura']);
  $p_profundidade = str_replace(',', '.', $_POST['txtprofundidade']);
  $p_npecas = $_POST['txtnumeropecas'];
  $p_preco = str_replace(',', '.', $_POST['txtpreco']);
  $p_descricao = $_POST['txadescricao'];
  $redirecionar_link = "?pasta=produtos/&arquivo=va_fmalt_produtos&ext=php&id=".$p_produtoid;
  $icone_erro_confirmacao = "../visual/imagens/erro.png";
  //validando campos
  if(!checar_vazio($p_nome)){
    $caso = "validacao";
    $assunto = "nome";
  }else if(!checar_vazio($p_categoriaid)){
        $caso = "validacao";
        $assunto = "categoria";
      }else if(!checar_vazio($p_altura)){
            $caso = "validacao";
            $assunto = "altura";
          }else if(!checar_vazio($p_largura)){
                $caso = "validacao";
                $assunto = "largura";
              }else if(!checar_vazio($p_profundidade)){
                    $caso = "validacao";
                    $assunto = "profundidade";
                  }else if(!checar_vazio($p_npecas)){
                        $caso = "validacao";
                        $assunto = "número de peças";
                      }else if(!checar_vazio($p_preco)){
                            $caso = "validacao";
                            $assunto = "preço";
                        }else{
                            //selecionando valores de serto produto
                            $sql_sel_produtos = "SELECT * FROM produtos WHERE nome='".$p_nome."' AND categorias_id='".$p_categoriaid."' AND id<>'".$p_produtoid."'";
                            $sql_sel_produtos_preparado = $conexaobd->prepare($sql_sel_produtos);
                            $sql_sel_produtos_preparado->execute();
                            //alterando valores
                            if($sql_sel_produtos_preparado->rowCount()==0){

                              $tabela = "produtos";

                              $dados = array(
                                'nome' => $p_nome,
                                'categorias_id' => $p_categoriaid,
                                'imagem' => $p_imagem,
                                'altura' => $p_altura,
                                'largura' => $p_largura,
                                'profundidade' => $p_profundidade,
                                'n_pecas' => $p_npecas,
                                'preco' => $p_preco,
                                'descricao' => $p_descricao

                            );

                              $condicao = "id='".$p_produtoid."'";

                              $sql_alt_produtos_resultado = alterar($tabela, $dados, $condicao);

                              if($sql_alt_produtos_resultado){
                                $caso = "sucesso";
                                $assunto = "produto";
                                $redirecionar_link = "?pasta=produtos/&arquivo=va_fmins_produtos&ext=php";
                                $icone_erro_confirmacao = "../visual/imagens/sucesso.png";

                              }else{
                                $caso = "bancodedados";
                                $assunto = "produto";
                              }
                            }else{
                              $caso = "existencia";
                              $assunto = "produto";
                            }
                         }
?>
<div class="aviso">
  <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
  <a href="<?php echo $redirecionar_link; ?>"><button class="botao_retornar" name="btnretornar" type="button" >Retornar</button></a>
</div>
