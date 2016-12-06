<?php $permissao_acesso = 1;?>
<div class="conteudo"><!--Inicio conteúdo-->
  <h1>Cadastrar Data Prevista de Entrega</h1>
  <?php
    $g_orcamentos_id = $_GET['id'];
    $g_status = $_GET['status'];

    $sql_sel_pedidos = "SELECT orcamentos.status, orcamentos.id AS orcamentos_id, orcamentos.data_prevista, orcamentos_has_produtos.imagem AS orcamentos_has_produtos_imagem, produtos.imagem AS produtos_imagem FROM orcamentos
    INNER JOIN orcamentos_has_produtos ON orcamentos_has_produtos.orcamentos_id = orcamentos.id
    INNER JOIN produtos ON orcamentos_has_produtos.produtos_id = produtos.id
    WHERE orcamentos.id='".$g_orcamentos_id."'";
    $sql_sel_pedidos_preparado = $conexaobd->prepare($sql_sel_pedidos);
    $sql_sel_pedidos_preparado->execute();

    $sql_sel_pedidos_dados = $sql_sel_pedidos_preparado->fetch();

    if($sql_sel_pedidos_dados['orcamentos_has_produtos_imagem']!=""){
      $imagem = $sql_sel_pedidos_dados['orcamentos_has_produtos_imagem'];
    }else if($sql_sel_pedidos_dados['produtos_imagem']!=""){
      $imagem = $sql_sel_pedidos_dados['produtos_imagem'];
    }else{
      $imagem = "";
    }

  ?>
  <form name="frmaltpedidos" method="post" action="?pasta=pedidos/&arquivo=va_altstatus_pedidos&ext=php" >
    <input type="hidden" name="hidorcamentoid" value="<?php echo $sql_sel_pedidos_dados['orcamentos_id'];?>">
    <input type="hidden" name="hidstatusid" value="<?php echo $g_status;?>">
    <table>
      <tr>
        <td>*Data Prevista:</td>
        <td><input type="text" name="txtdataprevista" maxlength="10" class="datepicker" readonly></td>
      </tr>
      <tr>
        <td>*Imagem:</td>
        <td><input type="text" name="txtimagem" maxlength="255" value="<?php echo $imagem;?>"></td>
      </tr>
      <tr>
        <td colspan="2">Obrigatórios*</td>
      </tr>
    </table>
    <div class="botoes">
      <button class="botao_limpar" type="button" name="btnlimpar">Limpar</button>
      <button type="submit" class="botao_registrar" name="btnregistrar">Registrar</button>
    </div>
  </form>
</div><!--Fim conteúdo-->
