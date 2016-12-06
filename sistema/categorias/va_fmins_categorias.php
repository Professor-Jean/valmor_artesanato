<?php $permissao_acesso = 0;?>

      <div class="conteudo"><!--Inicio conteúdo-->
        <h1>Registro de Categoria de Produto</h1>
        <!--Formulário de inserção-->
        <form name="frminscategorias" method="post" action="?pasta=categorias/&arquivo=va_ins_categorias&ext=php" onsubmit=" return validarFormInsCategorias()" >
          <table>
            <tr>
              <td>Categoria:</td>
              <td><input type="text" name="txtcategoria" maxlength="20"></td>
            </tr>
          </table>
          <div class="botoes">
            <button class="botao_limpar"  type="reset" name="btnlimpar">Limpar</button>
            <button class="botao_registrar" type="submit" name="btnregistrar">Registrar</button>
          </div>
        </form>
        <h1>Categoria de Produtos Registrados</h1>
        <?php

          $sql_sel_categorias = "SELECT id, categoria FROM categorias";
          $sql_sel_categorias_preparado = $conexaobd->prepare($sql_sel_categorias);
          $sql_sel_categorias_preparado->execute();

        ?>
        <div class="registros">
          <table>
            <thead>
              <tr>
                <th width="50%">Categoria</th>
                <th width="20%">Alterar</th>
                <th width="20%">Excluir</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if($sql_sel_categorias_preparado->rowCount()>0){
                  while($sql_sel_categorias_dados = $sql_sel_categorias_preparado->fetch()){
              ?>
              <!--Mostrando categorias registradas-->
              <tr>
                <td><?php echo $sql_sel_categorias_dados['categoria'];?></td>
                <td align="center"><a href="?pasta=categorias/&arquivo=va_fmalt_categorias&ext=php&id=<?php echo $sql_sel_categorias_dados['id'];?>" title="Editar registro"><img src="../visual/imagens/editar.png" width="25px" height="25px"/></td>
                <td align="center" onclick="return confirmar_exclusao('categoria', '<?php echo addslashes($sql_sel_categorias_dados['categoria']);?>')"> <?php echo exclusaoSegura($sql_sel_categorias_dados['id'], '?pasta=categorias/&arquivo=va_del_categorias&ext=php'); ?></td>
              </tr>
              <?php
                  }
                }else{
              ?>
              <tr>
                <td align="center" colspan="3">Não há registros de categorias.</td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
      </div><!--Fim conteúdo-->
