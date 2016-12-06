<?php $permissao_acesso = 0;?>

<h1> Aviso de Cadastro de Categoria</h1>
<section>

  <?php
    $p_categoria = $_POST['txtcategoria'];
    $operacao = "Cadastro";
    $icone_erro_confirmacao = "../visual/imagens/erro.png";
    //validando campo
    if(!checar_vazio($p_categoria)){
      $caso = "validacao";
      $assunto = "categoria";
    }else{
          //selecionando valores da categoria a ser inserida
          $sql_sel_categorias = "SELECT * FROM categorias WHERE categoria='".$p_categoria."'";

          $sql_sel_categorias_preparado = $conexaobd->prepare($sql_sel_categorias);

          $sql_sel_categorias_preparado->execute();
          //inserindo categoria
          if($sql_sel_categorias_preparado->rowCount()==0){
          $tabela ="categorias";

          $dados = array(
            'categoria' => $p_categoria
        );

        $sql_ins_categorias_resultado = adicionar($tabela, $dados);

            if($sql_ins_categorias_resultado){
              $caso = "sucesso";
              $assunto = "categoria";
              $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
            }else{
              $caso = "bancodedados";
              $assunto = "categoria";
            }
          }else{
            $caso = "existencia";
            $assunto = "categoria";
          }
        }
  ?>
  <div class="aviso">
    <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
    <a href="?pasta=categorias/&arquivo=va_fmins_categorias&ext=php"><button class="botao_retornar" name="btnretornar" type="button" >Retornar</button></a>
  </div>
</section>
