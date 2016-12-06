<?php $permissao_acesso = 1;?>

<h1> Aviso de Exclusão de Matéria-Prima</h1>

<section>
<?php

    $operacao = "exclusão";
    $icone_erro_confirmacao = "../visual/imagens/erro.png";


    $p_id = $_POST['id'];

    if(!checar_vazio($p_id)){
      $caso = "vazio";
      $assunto = "matéria-prima";
    }else{
      $sql_sel_materias_primas = "SELECT * FROM orcamentos_has_produtos WHERE materias_primas_id='".$p_id."' ";
      $sql_sel_materias_primas_preparado = $conexaobd->prepare($sql_sel_materias_primas);
      $sql_sel_materias_primas_preparado->execute();

    if($sql_sel_materias_primas_preparado->rowCount()>0){
      $caso = "integridade";
      $assunto = "matéria-prima";
    }else{

      $tabela = "materias_primas";

      $condicao = "MD5(id)='".$p_id."'";

      $sql_del_materias_primas_resultado = deletar($tabela, $condicao);

      if($sql_del_materias_primas_resultado){
        $caso = "sucesso";
        $assunto = "matéria-prima";
        $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
      }else{
        $caso = "bancodedados";
        $assunto = "matéria-prima";
      }
    }
 }
?>
<div class="aviso">
  <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
  <a href="?pasta=materias_primas/&arquivo=va_fmins_materias_primas&ext=php"><button class="botao_retornar" name="btnretornar" type="button" >Retornar</button></a>
</div>
</section>
