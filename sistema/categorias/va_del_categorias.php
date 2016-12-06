<?php $permissao_acesso = 0;?>

<h1> Aviso de Exclusão de Categoria</h1>

<section>
      <?php

        $operacao = "Exclusão";
        $icone_erro_confirmacao = "../visual/imagens/erro.png";


        $p_id = $_POST['id']; // Id da categoria

        if($p_id==""){ // Verificando se o valor dessa categoria é nulo
          $caso = "vazio";
          $assunto = "categoria";
        }else{
          //selecionando o produto que tem a categoria a ser excluida vinculada para checar integridade
          $sql_sel_produtos = "SELECT * FROM produtos WHERE MD5(categorias_id)='".$p_id."' ";
          $sql_sel_produtos_preparado = $conexaobd->prepare($sql_sel_produtos);
          $sql_sel_produtos_preparado->execute();
    //excluindo categoria
    if($sql_sel_produtos_preparado->rowCount()==0){

      $tabela = "categorias";

      $condicao = "MD5(id)='".$p_id."'";

      $sql_del_categorias_resultado = deletar($tabela, $condicao);

      if($sql_del_categorias_resultado){
        $caso = "sucesso";
        $assunto = "categoria";
        $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
      }else{
        $caso = "bancodedados";
        $assunto = "categoria";
      }
    }else{
      $caso = "integridade";
      $assunto = "categoria";
    }
 }
?>
<div class="aviso">
  <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
  <a href="?pasta=categorias/&arquivo=va_fmins_categorias&ext=php"><button class="botao_retornar" name="btnretornar" type="button" >Retornar</button></a>
</div>
</section>
