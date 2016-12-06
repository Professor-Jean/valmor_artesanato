<?php $permissao_acesso = 0;?>

<h1> Aviso de Alteração de Categorias</h1>
<section>
<?php
  $msg = "";
  $operacao = "Alteração";

  //Recebendo var
  $p_categoriaid = $_POST['hidcategoriaid'];
  $p_categoria = $_POST['txtcategoria'];
  $redirecionar_link = "?pasta=categorias/&arquivo=va_fmalt_categorias&ext=php&id=".$p_categoriaid;
  $icone_erro_confirmacao = "../visual/imagens/erro.png";
  //Validando campo
  if(!checar_vazio($p_categoria)){
    $caso = "validacao";
    $assunto = "categoria";
  }else{
    //selecionando a categoria a ser alterada
    $sql_sel_categorias = "SELECT * FROM categorias WHERE categoria='".$p_categoria."' AND id<>'".$p_categoriaid."' ";
    $sql_sel_categorias_preparado = $conexaobd->prepare($sql_sel_categorias);//Prepara o statement
    $sql_sel_categorias_preparado->execute();//Executando a variavel
    //alterando categoria
    if($sql_sel_categorias_preparado->rowCount()==0){//rowCount = Contagem de linhas

      $tabela = "categorias";

      $dados = array(
        'categoria' => $p_categoria
      );

      $condicao = "id='".$p_categoriaid."'";

      $sql_alt_categorias_resultado = alterar($tabela, $dados, $condicao);

      if($sql_alt_categorias_resultado){
        $caso = "sucesso";
        $assunto = "categoria";
        $redirecionar_link = "?pasta=categorias/&arquivo=va_fmins_categorias&ext=php";
        $icone_erro_confirmacao = "../visual/imagens/sucesso.png";

      }else{
        $caso = "bancodedados";
        $assunto = "categoria";
      }
    }else{
      $caso = "existencia";
      $assunto = "categoria";
    }//Fecha o else da contagem de linhas
 } //Fecha else da validação
?>
<div class="aviso">
  <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
  <a href="<?php echo $redirecionar_link; ?>"><button class="botao_retornar" name="btnretornar" type="button" >Retornar</button></a>
</div>
</section>
