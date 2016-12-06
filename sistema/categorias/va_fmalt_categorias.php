<?php $permissao_acesso =0;?>
      <div class="conteudo"><!--Inicio conteúdo-->
        <!--Formulário de alteração-->
        <h1>Alteração de Categoria de Produto</h1>
        <?php
          $g_id = $_GET['id'];
          $sql_sel_categorias = "SELECT * FROM categorias WHERE id='".$g_id."' ";

          $sql_sel_categorias_preparado = $conexaobd->prepare($sql_sel_categorias);
          $sql_sel_categorias_preparado->execute();

          $sql_sel_categorias_dados = $sql_sel_categorias_preparado->fetch();

        ?>
        <form name="frmaltcategorias" method="post" action="?pasta=categorias/&arquivo=va_alt_categorias&ext=php" onsubmit=" return validarFormAltCategorias()" >
          <input type="hidden" name="hidcategoriaid" value="<?php echo $sql_sel_categorias_dados['id'];?>">
          <table>
            <tr>
              <td>Categoria:</td>
              <td><input type="text" name="txtcategoria" maxlength="20" value="<?php echo $sql_sel_categorias_dados['categoria'];?>"></td>
            </tr>
          </table>
          <div class="botoes">
            <button class="botao_limpar" type="reset" name="btnlimpar">Limpar</button>
            <button class="botao_registrar" type="submit" name="btnregistrar">Enviar</button>
          </div>
        </form>
      </div><!--Fim conteúdo-->
