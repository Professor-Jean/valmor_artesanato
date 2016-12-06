<?php $permissao_acesso = 1;?>

<h1> Aviso de Cadastro de Produtos</h1>
<section>

  <?php
  $p_nome = $_POST['txtnome'];
  $p_categoria = $_POST['selcategoria'];
  $p_imagem = $_POST['txtimagem'];
  $p_altura = str_replace(',', '.', $_POST['txtaltura']);
  $p_largura = str_replace(',', '.', $_POST['txtlargura']);
  $p_profundidade = str_replace(',', '.', $_POST['txtprofundidade']);
  $p_npecas = $_POST['txtnumeropecas'];
  $p_preco = str_replace(',', '.', $_POST['txtpreco']);
  $p_descricao = $_POST['txadescricao'];
  //permitir a inserção de preço com virgula.

    $operacao = "Cadastro";
    $icone_erro_confirmacao = "../visual/imagens/erro.png";
    //validando campos
    if(!checar_vazio($p_nome)){
      $caso = "validacao";
      $assunto = "nome";
    }else if(!checar_vazio($p_categoria)){
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
                              //selecionando todos os dados de tal produto
                              $sql_sel_produtos = "SELECT * FROM produtos WHERE nome='".$p_nome."'";

                              $sql_sel_produtos_preparado = $conexaobd->prepare($sql_sel_produtos);

                              $sql_sel_produtos_preparado->execute();
                              //inserindo produto caso não exista um igual
                              if($sql_sel_produtos_preparado->rowCount()==0){
                              $tabela ="produtos";
                              //enviando campos como array para inserção
                              $dados = array(
                                'nome' => $p_nome,
                                'categorias_id' => $p_categoria,
                                'imagem' => $p_imagem,
                                'altura' => $p_altura,
                                'largura' => $p_largura,
                                'profundidade' => $p_profundidade,
                                'n_pecas' => $p_npecas,
                                'preco' => $p_preco,
                                'descricao' => $p_descricao

                            );

                            $sql_ins_produtos_resultado = adicionar($tabela, $dados);
                                if($sql_ins_produtos_resultado){
                                  $caso = "sucesso";
                                  $assunto = "produto";
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
    <a href="?pasta=produtos/&arquivo=va_fmins_produtos&ext=php"><button class="botao_retornar" name="btnretornar" type="button" >Retornar</button></a>
  </div>
</section>
