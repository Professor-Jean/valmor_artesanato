<?php
  $permissao_acesso = 0;
?>
<h1>Aviso de Exclusão de Registro de Máquina</h1>
<?php

  $p_id = $_POST['id'];

  $texto = "";
  $operacao = "exclusão";
  $icone_erro_confirmacao = "../visual/imagens/erro.png";


  if(!checar_vazio($p_id)){
      $caso = "vazio";
      $assunto = "Máquina";
    }else{

      $sql_sel_movimentacoes = "SELECT status, maquinas_id FROM movimentacoes WHERE MD5(maquinas_id)='".$p_id."'";
      $sql_sel_movimentacoes_preparado = $conexaobd->prepare($sql_sel_movimentacoes);
      $sql_sel_movimentacoes_preparado->execute();

      if($sql_sel_movimentacoes_preparado->rowCount()==0){

        $tabela = "maquinas";

        $condicao = "MD5(id)='".$p_id."'";

        $sql_del_maquinas_resultado = deletar($tabela, $condicao);

          if($sql_del_maquinas_resultado){

            $caso = "sucesso";
            $assunto = "máquina";
            $operacao = "Exclusão";
            $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
          }else{
            $caso = "bancodedados";
            $assunto = "máquina";
            $operacao = "exclusão";
          }
      }else{
        $caso = "integridade";
        $assunto = "máquina";
        $operacao = "exclusão";
      }
  }
?>
<div class="aviso">
  <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
  <a href="?pasta=maquinas/&arquivo=va_fmins_maquinas&ext=php"><button class="botao_retornar" name="btnretornar" type="button">Retornar</button></a>
</div>
