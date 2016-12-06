<?php
  $permissao_acesso = 1;
?>

<h1>Aviso de cadastro de matéria-prima</h1>

<?php
  $p_nome = $_POST['txtnome'];
  $p_descricao = $_POST['txadescricao'];

  $texto = "";
  $operacao = "cadastro";
  $caso = "validacao";
  $icone_erro_confirmacao = "../visual/imagens/erro.png";

  if(!checar_vazio($p_nome)){
    $assunto = "nome";
  }else{
    $sql_sel_materias_primas = "SELECT nome FROM materias_primas WHERE nome='".$p_nome."'";
    $sql_sel_materias_primas_preparado = $conexaobd->prepare($sql_sel_materias_primas);
    $sql_sel_materias_primas_preparado->execute();


    if($sql_sel_materias_primas_preparado->rowCount()==0){

      $tabela = "materias_primas";

      $dados = array(
        'nome'       => $p_nome,
        'descricao'  => $p_descricao
      );

      $sql_ins_materias_primas_resultado = adicionar($tabela, $dados);

      if($sql_ins_materias_primas_resultado){
        $caso = "sucesso";
        $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
        $assunto = "matéria-prima";
        $operacao = "Cadastro";
      }else{
        $assunto = "matéria-prima";
        $caso = "bancodedados";
      }
    }else{
        $assunto = "matéria-prima";
        $caso = "existencia";
    }
  }
?>
<div class="aviso">
  <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
  <a href="?pasta=materias_primas/&arquivo=va_fmins_materias_primas&ext=php"><button class="botao_retornar" name="btnretornar" type="button" >Retornar</button></a>
</div>
