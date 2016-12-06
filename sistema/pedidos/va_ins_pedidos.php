<?php
  $permissao_acesso = 1;
?>
<h1>Aviso de Cadastro de Orçamento</h1>
<?php

  $p_cliente_id = $_POST['selcliente'];
  $p_data = implode("-", array_reverse(explode("/", $_POST['txtdata'])));
  $p_produto_id = $_POST['selproduto'];
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

  $msg = "";
  $texto = "";
  $operacao = "Cadastro";
  $icone_erro_confirmacao = "../visual/imagens/erro.png";

  $quantidade_produto = count($p_produto_id);

  $assunto = "";
  $progresso = "1";
  $processo = "0";
  $erro = "0";

  for ($i=0; $i < $quantidade_produto; $i++) {

  if(!checar_vazio($p_cliente_id)){
      $caso = "validacao";
      $assunto = "cliente";
      $erro = "1";
    }else if(!checar_vazio($p_data)){
        $caso = "validacao";
        $assunto = "data de orçamento";
        $erro = "1";
      }else if(!checar_vazio($p_produto_id[$i])){
          $caso = "validacao";
          $assunto = "produto";
          $erro = "1";
        }else if(!checar_vazio($p_materiaprima_id[$i])){
            $caso = "validacao";
            $assunto = "matéria-prima";
            $erro = "1";
          }else if(!checar_vazio($p_npecas[$i])){
              $caso = "validacao";
              $assunto = "número de peças";
              $erro = "1";
            }else if(!checar_vazio($p_setor[$i])){
                $caso = "validacao";
                $assunto = "setor";
                $erro = "1";
              }else if(!checar_vazio($p_altura[$i])){
                  $caso = "validacao";
                  $assunto = "altura";
                  $erro = "1";
                }else if(!checar_vazio($p_largura[$i])){
                    $caso = "validacao";
                    $assunto = "largura";
                    $erro = "1";
                  }else if(!checar_vazio($p_profundidade[$i])){
                      $caso = "validacao";
                      $assunto = "profundidade";
                      $erro = "1";
                    }else if(!checar_vazio($p_preco[$i])){
                        $caso = "validacao";
                        $assunto = "preço";
                        $erro = "1";
                      }else if(!checar_vazio($p_quantidade[$i])){
                          $caso = "validacao";
                          $assunto = "quantidade";
                          $erro = "1";
                      }else if($erro=="0"){

                              if($progresso=="1"){

                                $sql_sel_produtos[$i] = "SELECT * FROM produtos WHERE id='".$p_produto_id[$i]."' AND n_pecas='".$p_npecas[$i]."' AND preco='".$p_preco[$i]."' AND largura='".$p_largura[$i]."' AND altura='".$p_altura[$i]."' AND profundidade='".$p_profundidade[$i]."' AND imagem='".$p_imagem[$i]."' ";
                                $sql_sel_produtos_preparado[$i] = $conexaobd->prepare($sql_sel_produtos[$i]);
                                $sql_sel_produtos_preparado[$i]->execute();

                                $tabela = "orcamentos";

                                $dados = array(
                                  'clientes_id' => $p_cliente_id,
                                  'status' => '0',
                                  'data_orcamento' => $p_data
                                );

                                $sql_ins_orcamentos_resultado[$i] = adicionar($tabela, $dados);

                                $orcamentos_id = $conexaobd->lastInsertId();

                                $tabela = "orcamentos_has_produtos";

                                if($sql_sel_produtos_preparado[$i]->rowCount()==0){

                                  $dados = array(
                                    'orcamentos_id' => $orcamentos_id,
                                    'produtos_id' => $p_produto_id[$i],
                                    'materias_primas_id' => $p_materiaprima_id[$i],
                                    'setor' => $p_setor[$i],
                                    'n_pecas' => $p_npecas[$i],
                                    'preco' => $p_preco[$i],
                                    'largura' => $p_largura[$i],
                                    'altura' => $p_altura[$i],
                                    'profundidade' => $p_profundidade[$i],
                                    'imagem' => $p_imagem[$i],
                                    'quantidade' => $p_quantidade[$i],
                                    'descricao' => $p_descricao[$i]
                                  );

                                }else{

                                  $dados = array(
                                    'orcamentos_id' => $orcamentos_id,
                                    'produtos_id' => $p_produto_id[$i],
                                    'materias_primas_id' => $p_materiaprima_id[$i],
                                    'setor' => $p_setor[$i],
                                    'quantidade' => $p_quantidade[$i],
                                    'descricao' => $p_descricao[$i]
                                  );

                                }


                                $sql_ins_orcamentos_has_produtos_resultado[$i] = adicionar($tabela, $dados);

                                if($sql_ins_orcamentos_has_produtos_resultado[$i]&&$sql_ins_orcamentos_resultado){
                                  $progresso = "1";
                                  $processo = "1";
                                  $caso = "sucesso";
                                  $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
                                  $assunto = "orçamento";
                                }else{
                                    if($processo=="1"){
                                      $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
                                      $msg = "Sucesso no(s) cadastro(s) de número ";
                                      for ($i2=0; $i2 < $i; $i2++) {
                                        $numero_registro = $i2 + 1;
                                        $msg .= $numero_registro.", ";
                                      }
                                      $erro_registro = $i + 1;
                                      $msg .= "porém, o cadastro de número ".$erro_registro." não foi cadastrado por erro no banco de dados.";

                                    }else{
                                      $caso = "bancodedados";
                                      $assunto = "orçamento";
                                      $progresso = "2";
                                    }
                                  }

                              }
                            }

            if($erro=="1"&&$processo=="1"){
                  $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
                  $msg = "Sucesso no(s) cadastro(s) de número ";
                  for ($i2=0; $i2 < $i; $i2++) {
                    $numero_registro = $i2 + 1;
                    $msg .= $numero_registro.", ";
                  }
                  $erro_registro = $i + 1;
                  $msg .= "porém, o cadastro de número ".$erro_registro." não foi cadastrado por erro de validação no campo ".$assunto.".";
              }
    }

?>
<div class="aviso">
  <p>
    <img src="<?php echo $icone_erro_confirmacao; ?>"/>
    <?php
        if($msg!=""){
          echo $msg;
        }else{
          echo reposicaoMensagem($caso, $assunto, $operacao);
        }
    ?>
  </p>
  <a href="?pasta=pedidos/&arquivo=va_fmins_pedidos&ext=php&"><button class="botao_retornar" name="btnretornar" type="button">Retornar</button></a>
</div>
