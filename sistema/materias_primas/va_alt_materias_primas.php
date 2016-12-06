<?php  $permissao_acesso = 1; ?>
<h1>Aviso de alteração de matéria-prima</h1>
<section>
<?php
  $msg = "";
  $operacao = "alteração";

  $p_materiaprimaid = $_POST['hidmateriaprimaid'];
  $p_nome = $_POST['txtnome'];
  $p_descricao = $_POST['txadescricao'];

  $redirecionar_link = "?pasta=materias_primas/&arquivo=va_fmalt_materias_primas&ext=php&id=".$p_materiaprimaid;
  $icone_erro_confirmacao = "../visual/imagens/erro.png";

  if(!checar_vazio($p_nome)){
    $assunto = "nome";
    $caso = "validacao";
  }else{
    $sql_sel_materias_primas = "SELECT * FROM materias_primas WHERE nome='".$p_nome."' AND id<>'".$p_materiaprimaid."'";
    $sql_sel_materias_primas_preparado = $conexaobd->prepare($sql_sel_materias_primas);
    $sql_sel_materias_primas_preparado->execute();

    if($sql_sel_materias_primas_preparado->rowCount()==0){

      $tabela = "materias_primas";

      $dados = array(
          'nome'      => $p_nome,
          'descricao' => $p_descricao
        );

      $condicao = "id='".$p_materiaprimaid."'";

      $sql_alt_materias_primas_resultado = alterar($tabela, $dados, $condicao);

      if($sql_alt_materias_primas_resultado){
        $caso = "sucesso";
        $assunto = "matéria-prima";
        $redirecionar_link = "?pasta=materias_primas/&arquivo=va_fmins_materias_primas&ext=php";
        $icone_erro_confirmacao = "../visual/imagens/sucesso.png";

      }else{
        $caso = "bancodedados";
        $assunto = "matéria-prima";
      }
    }else{
      $caso = "existencia";
      $assunto = "matéria-prima";
    }
  }

?>
<div class="aviso">
  <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
  <a href="<?php echo $redirecionar_link; ?>"><button class="botao_retornar" name="btnretornar" type="button" >Retornar</button></a>
</div>
</section>
