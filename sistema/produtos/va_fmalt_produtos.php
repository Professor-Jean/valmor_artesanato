<?php
  $permissao_acesso = 1;
?>
<div class="conteudo"><!--Inicio conteúdo-->
  <h1>Alteração de Produto</h1>
  <?php

    $g_id = $_GET['id'];
    $sql_sel_produtos = "SELECT * FROM produtos WHERE id='".$g_id."' ";

    $sql_sel_produtos_preparado = $conexaobd->prepare($sql_sel_produtos);
    $sql_sel_produtos_preparado->execute();

    $sql_sel_produtos_dados = $sql_sel_produtos_preparado->fetch();

  ?>
  <!--Formulário de alteração-->
  <form name="frmaltprodutos" method="post" action="?pasta=produtos/&arquivo=va_alt_produtos&ext=php" onsubmit=" return validarFormAltProdutos()" >
    <input type="hidden" name="hidprodutoid" value="<?php echo $sql_sel_produtos_dados['id'];?>">
    <table>
      <tr>
        <td>*Nome:</td>
        <td><input type="text" name="txtnome" maxlength="45" value="<?php echo $sql_sel_produtos_dados['nome'];?>"></td>
      </tr>
      <tr>
	      <td>*Categoria:</td>
        <td>
						<select name="selcategoria">
              <option value="">escolha...</option>
              <?php

                $sql_sel_categorias = "SELECT * FROM categorias ORDER BY categoria ASC";

                $sql_sel_categorias_preparado = $conexaobd->prepare($sql_sel_categorias);

                $sql_sel_categorias_preparado->execute();

                while($sql_sel_categorias_dados = $sql_sel_categorias_preparado->fetch()){
                    $codigo_categorias = $sql_sel_categorias_dados['id'];
                    $nome_categorias = $sql_sel_categorias_dados['categoria'];
                    $selecionar = "";

                    if($sql_sel_categorias_dados['id'] == $codigo_categorias){
                      $selecionar = "selected";
                    }
              ?>
            <option value="<?php echo $codigo_categorias; ?>" <?php echo $selecionar;?>> <?php echo $nome_categorias; ?> </option>
            <?php
              }
            ?>
						</select>
					</td>
			</tr>
      <tr>
        <td>Imagem:</td>
        <td><input type="text" name="txtimagem" maxlength="255 value="<?php echo $sql_sel_produtos_dados['imagem'];?>></td>
      </tr>
      <tr>
        <td>*Altura:</td>
        <td><input type="text" name="txtaltura" maxlength="7" value="<?php echo number_format($sql_sel_produtos_dados['altura'], '2', ',', '');?>"></td>
      </tr>
      <tr>
        <td>*Largura:</td>
        <td><input type="text" name="txtlargura" maxlength="7" value="<?php echo number_format($sql_sel_produtos_dados['largura'], '2', ',', '');?>"></td>
      </tr>
      <tr>
        <td>*Profundidade:</td>
        <td><input type="text" name="txtprofundidade" maxlength="7" value="<?php echo number_format($sql_sel_produtos_dados['profundidade'], '2', ',', '');?>"></td>
      </tr>
      <tr>
        <td>*Número de peças:</td>
        <td><input type="text" name="txtnumeropecas" maxlength="7" value="<?php echo $sql_sel_produtos_dados['n_pecas'];?>"></td>
      </tr>
      <tr>
        <td>*Preço:</td>
        <td><input type="text" name="txtpreco" maxlength="7" value="<?php echo number_format($sql_sel_produtos_dados['preco'], '2', ',', '');?>"></td>
      </tr>
      <tr>
        <td>Descrição:</td>
        <td><input type="texa" name="txadescricao" value="<?php echo $sql_sel_produtos_dados['descricao'];?>"></td>
      </tr>
      <tr>
        <td colspan="2">Obrigatórios*</td>
      </tr>
    </table>
    <div class="botoes">
      <button class="botao_limpar" type="reset" name="btnlimpar">Limpar</button>
      <button class="botao_registrar" type="submit" name="btnregistrar">Enviar</button>
    </div>
  </form>
</div><!--Fim conteúdo-->
