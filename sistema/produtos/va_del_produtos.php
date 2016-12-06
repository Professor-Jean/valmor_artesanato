<?php
  $permissao_acesso = 1;
?>

<h1> Aviso de Exclusão de Produto</h1>

<section>
      <?php

        $operacao = "Exclusão";
        $icone_erro_confirmacao = "../visual/imagens/erro.png";

       // Id da produto
        $p_id = $_POST['id'];
        // Verificando se o valor desse produto é nulo
        if($p_id==""){
          $caso = "vazio";
          $assunto = "produto";
        }else{
          //selecionando produtos de orçamento para validar integridade
          $sql_sel_orcamentos_has_produtos = "SELECT * FROM orcamentos_has_produtos WHERE MD5(produtos_id)='".$p_id."' ";
          $sql_sel_orcamentos_has_produtos_preparado = $conexaobd->prepare($sql_sel_orcamentos_has_produtos);
          $sql_sel_orcamentos_has_produtos_preparado->execute();
    //deletando produto
    if($sql_sel_orcamentos_has_produtos_preparado->rowCount()==0){

      $tabela = "produtos";

      $condicao = "MD5(id)='".$p_id."'";

      $sql_del_produtos_resultado = deletar($tabela, $condicao);
      //mensagem caso a exclusão ocorra com sucesso
      if($sql_del_produtos_resultado){
        $caso = "sucesso";
        $assunto = "produto";
        $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
      }else{
        $caso = "bancodedados";
        $assunto = "produto";
      }
    }else{
      //mensagem caso tenha algum dado associado a esse produto
      $caso = "integridade";
      $assunto = "produto";
    }
 }
?>
<div class="aviso">
  <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
  <a href="?pasta=produtos/&arquivo=va_fmins_produtos&ext=php"><button class="botao_retornar" name="btnretornar" type="button" >Retornar</button></a>
</div>
</section>
