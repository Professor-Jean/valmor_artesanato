<?php $permissao_acesso = 1;?>
      <div class="conteudo"><!--Inicio conteúdo-->
        <h1>Cadastrar Data de Entrega</h1>
        <?php
          $g_orcamentos_id = $_GET['id'];
          $g_status = $_GET['status'];

          $sql_sel_pedidos = "SELECT * FROM orcamentos WHERE id='".$g_orcamentos_id."'";
          $sql_sel_pedidos_preparado = $conexaobd->prepare($sql_sel_pedidos);
          $sql_sel_pedidos_preparado->execute();

          $sql_sel_pedidos_dados = $sql_sel_pedidos_preparado->fetch();

        ?>
        <form name="frmaltpedidos" method="post" action="?pasta=pedidos/&arquivo=va_altstatus_pedidos&ext=php" >
          <input type="hidden" name="hidorcamentoid" value="<?php echo $sql_sel_pedidos_dados['id'];?>">
          <input type="hidden" name="hidstatusid" value="<?php echo $g_status;?>">
          <table>
            <tr>
              <td>Data de Entrega:</td>
              <td><input type="text" name="txtdataentrega" maxlength="10" class="datepicker" readonly></td>
            </tr>
          </table>
          <div class="botoes">
            <button class="botao_limpar" type="button" name="btnlimpar">Limpar</button>
            <button class="botao_registrar" type="submit" name="btnregistrar">Registrar</button>
          </div>
        </form>
      </div><!--Fim conteúdo-->
