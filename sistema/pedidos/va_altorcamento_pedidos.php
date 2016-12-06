<?php
  $permissao_acesso = 1;
?>
<h1>Aviso de Cadastro de Orçamento</h1>
<?php

  $p_orcamento_id = $_POST['hidorcamentoid'];
  $p_orcamento_has_produto_id = $_POST['hidorcamentohasprodutoid'];
  $p_cliente = $_POST['txtcliente'];
  $p_data = implode("-", array_reverse(explode("/", $_POST['txtdata'])));
  $p_produto = $_POST['txtproduto'];
  $p_materiaprima_id = $_POST['selmateriaprima'];
  $p_imagem = $_POST['txtimagem'];
  $p_npecas = $_POST['txtnpecas'];
  $p_setor = $_POST['selsetor'];
  $p_altura = str_replace(',', '.', $_POST['txtaltura']);
  $p_largura = str_replace(',', '.', $_POST['txtlargura']);
  $p_profundidade = str_replace(',', '.', $_POST['txtprofundidade']);
  $p_preco = str_replace(',', '.', $_POST['txtpreco']); 
  $p_quantidade = $_POST['txtquantidade'];
  $p_descricao = $_POST['txadescricao'];

  $redirecionar_link = "?pasta=pedidos/&arquivo=va_fmaltorcamento_pedidos&ext=php&id=".$p_orcamento_id;

  $texto = "";
  $operacao = "Alteração";
  $icone_erro_confirmacao = "../visual/imagens/erro.png";

  if(!checar_vazio($p_cliente)){
      $caso = "validacao";
      $assunto = "cliente";
    }else if(!checar_vazio($p_data)){
        $caso = "validacao";
        $assunto = "data de orçamento";
      }else if(!checar_vazio($p_produto)){
          $caso = "validacao";
          $assunto = "produto";
        }else if(!checar_vazio($p_materiaprima_id)){
            $caso = "validacao";
            $assunto = "matéria-prima";
          }else if(!checar_vazio($p_npecas)){
              $caso = "validacao";
              $assunto = "número de peças";
            }else if(!checar_vazio($p_setor)){
                $caso = "validacao";
                $assunto = "setor";
              }else if(!checar_vazio($p_altura)||!checar_numero($p_altura)){
                  $caso = "validacao";
                  $assunto = "altura";
                }else if(!checar_vazio($p_largura)||!checar_numero($p_largura)){
                    $caso = "validacao";
                    $assunto = "largura";
                  }else if(!checar_vazio($p_profundidade)||!checar_numero($p_profundidade)){
                      $caso = "validacao";
                      $assunto = "profundidade";
                    }else if(!checar_vazio($p_preco)||!checar_numero($p_preco)){
                        $caso = "validacao";
                        $assunto = "preço";
                      }else if(!checar_vazio($p_quantidade)||!checar_numero($p_quantidade)){
                          $caso = "validacao";
                          $assunto = "quantidade";
                      }else{

                        $sql_sel_produtos = "SELECT * FROM produtos WHERE nome='".$p_produto."' AND n_pecas='".$p_npecas."' AND preco='".$p_preco."' AND largura='".$p_largura."' AND altura='".$p_altura."' AND profundidade='".$p_profundidade."' AND imagem='".$p_imagem."' ";
                        $sql_sel_produtos_preparado = $conexaobd->prepare($sql_sel_produtos);
                        $sql_sel_produtos_preparado->execute();

                        $tabela = "orcamentos_has_produtos";
                        $condicao = "id='".$p_orcamento_has_produto_id."'";

                        if($sql_sel_produtos_preparado->rowCount()==0){

                          $dados = array(
                            'materias_primas_id' => $p_materiaprima_id,
                            'setor' => $p_setor,
                            'n_pecas' => $p_npecas,
                            'preco' => $p_preco,
                            'largura' => $p_largura,
                            'altura' => $p_altura,
                            'profundidade' => $p_profundidade,
                            'imagem' => $p_imagem,
                            'quantidade' => $p_quantidade,
                            'descricao' => $p_descricao
                          );

                        }else{

                          $dados = array(
                            'materias_primas_id' => $p_materiaprima_id,
                            'setor' => $p_setor,
                            'quantidade' => $p_quantidade,
                            'descricao' => $p_descricao
                          );

                        }

                        $sql_alt_orcamentos_has_produtos_resultado = alterar($tabela, $dados, $condicao);

                        if($sql_alt_orcamentos_has_produtos_resultado){
                          $caso = "sucesso";
                          $assunto = "orçamento";
                          $redirecionar_link = "?pasta=pedidos/&arquivo=va_ctrlorcamento_pedidos&ext=php";
                          $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
                        }else {
                          $caso = "bancodedados";
                          $assunto = "orçamento";
                          $operacao = "alteração";
                        }
                      }
?>
<div class="aviso">
  <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
  <a href="<?php echo $redirecionar_link; ?>"><button class="botao_retornar" name="btnretornar" type="button" >Retornar</button></a>
</div>
