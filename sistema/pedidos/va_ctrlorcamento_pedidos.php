<?php
 $permissao_acesso = 1;
?>
<h1>Controle de Orçamento</h1>
<?php
  $sql_sel_pedidos = "SELECT clientes.nome AS cliente_nome, produtos.nome AS produto_nome, orcamentos_has_produtos.produtos_id, orcamentos_has_produtos.quantidade, orcamentos_has_produtos.preco AS orcamentos_has_produtos_preco, produtos.preco AS produtos_preco, orcamentos.id, orcamentos.data_orcamento FROM orcamentos_has_produtos
  INNER JOIN produtos ON orcamentos_has_produtos.produtos_id = produtos.id
  INNER JOIN orcamentos ON orcamentos_has_produtos.orcamentos_id = orcamentos.id
  INNER JOIN clientes ON orcamentos.clientes_id = clientes.id
  WHERE orcamentos.status='0' ORDER BY clientes.nome ASC";
  $sql_sel_pedidos_preparado = $conexaobd->prepare($sql_sel_pedidos);
  $sql_sel_pedidos_preparado->execute();
?>
<div class="form_pesquisa2">
  <form name="frmfilctrlpedidos" method="post" action="?pasta=pedidos/&arquivo=va_ctrlorcamento_pedidos&ext=php">
    <input type="text" name="txtcontrole" placeholder="Pesquisar"/><button type="submit" name="btnpesquisar"><img src="../visual/imagens/pesquisar.png"></button>
  </form>
</div>
<div class="registros">
  <table width="80%">
    <thead>
      <tr>
        <th>Cliente</th>
        <th>Data do Orçamento</th>
        <th>Valor Total</th>
        <th>Produto</th>
        <th>Confirmar</th>
        <th>Cancelar</th>
        <th>Alterar</th>
      </tr>
    </thead>
    <tbody>
      <?php
        //caso tenha valor definido faça
        if(isset($_POST['txtcontrole'])){
          //simplifica var
          $filtro = $_POST['txtcontrole'];

          //nova pesquisa baseada no Filtro
          $sql_sel_pedidos = "SELECT clientes.nome AS cliente_nome, produtos.nome AS produto_nome, orcamentos_has_produtos.produtos_id, orcamentos_has_produtos.quantidade, orcamentos_has_produtos.preco AS orcamentos_has_produtos_preco, produtos.preco AS produtos_preco, orcamentos.id, orcamentos.data_orcamento FROM orcamentos_has_produtos
          INNER JOIN produtos ON orcamentos_has_produtos.produtos_id = produtos.id
          INNER JOIN orcamentos ON orcamentos_has_produtos.orcamentos_id = orcamentos.id
          INNER JOIN clientes ON orcamentos.clientes_id = clientes.id
          WHERE orcamentos.status='0' AND (clientes.nome LIKE '%$filtro%' OR produtos.nome LIKE '%$filtro%') ";
          $sql_sel_pedidos_preparado = $conexaobd->prepare($sql_sel_pedidos);
          $sql_sel_pedidos_preparado->execute();
        }

        if($sql_sel_pedidos_preparado->rowCount()>0){
          while($sql_sel_pedidos_dados = $sql_sel_pedidos_preparado->fetch()){

            $data_orcamento = explode("-", $sql_sel_pedidos_dados['data_orcamento']);

      ?>
      <tr>
        <td><?php echo $sql_sel_pedidos_dados['cliente_nome'];?></td>
        <td><?php echo $data_orcamento[2]."/".$data_orcamento[1]."/".$data_orcamento[0];?></td>
        <?php
          if($sql_sel_pedidos_dados['orcamentos_has_produtos_preco']==""){
            $preco = $sql_sel_pedidos_dados['produtos_preco'] * $sql_sel_pedidos_dados['quantidade'];
          }else{
            $preco = $sql_sel_pedidos_dados['orcamentos_has_produtos_preco'] * $sql_sel_pedidos_dados['quantidade'];
          }
        ?>
        <td>R$<?php echo number_format($preco,'2',',','.');?></td>
        <td><?php echo $sql_sel_pedidos_dados['quantidade'];?>x <?php echo $sql_sel_pedidos_dados['produto_nome'];?></td>
        <td align="center" onclick="return confirmar_alteracao('confirmar', 'produto', '<?php echo addslashes($sql_sel_pedidos_dados['produto_nome']);?>')"><a href="?pasta=pedidos/&arquivo=va_fmaltctrlorcamentos_pedidos&ext=php&id=<?php echo $sql_sel_pedidos_dados['id'];?>&status=2"><img src="../visual/imagens/concluido.png" width="25px" height="25px"/></a></td>
        <td align="center" onclick="return confirmar_alteracao('cancelar', 'produto', '<?php echo addslashes($sql_sel_pedidos_dados['produto_nome']);?>')"><a href="?pasta=pedidos/&arquivo=va_altstatus_pedidos&ext=php&id=<?php echo $sql_sel_pedidos_dados['id'];?>&status=1"><img src="../visual/imagens/cancelar.png" width="25px" height="25px"/></a></td>
        <td align="center"><a href="?pasta=pedidos/&arquivo=va_fmaltorcamento_pedidos&ext=php&id=<?php echo $sql_sel_pedidos_dados['id'];?>&status=5"><img src="../visual/imagens/editar.png" width="25px" height="25px"/></a></td>
      </tr>
      <?php
          }
        }else{
      ?>
      <tr>
        <td align="center" colspan="10">Não há registro de orçamentos.</td>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
