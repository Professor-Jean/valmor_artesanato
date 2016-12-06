<?php
 $permissao_acesso = 1;
?>
<h1>Controle de Pedidos</h1>
<?php
  $sql_sel_pedidos = "SELECT clientes.nome AS cliente_nome, produtos.nome AS produto_nome, clientes.telefone, orcamentos_has_produtos.produtos_id, orcamentos_has_produtos.quantidade, orcamentos.id, orcamentos.status, orcamentos.data_prevista FROM orcamentos_has_produtos
  INNER JOIN produtos ON orcamentos_has_produtos.produtos_id = produtos.id
  INNER JOIN orcamentos ON orcamentos_has_produtos.orcamentos_id = orcamentos.id
  INNER JOIN clientes ON orcamentos.clientes_id = clientes.id
  WHERE orcamentos.status='2' OR orcamentos.status='3'";
  $sql_sel_pedidos_preparado = $conexaobd->prepare($sql_sel_pedidos);
  $sql_sel_pedidos_preparado->execute();
?>
<div class="form_pesquisa2">
  <form name="frmfilctrlpedidos" method="post" action="?pasta=pedidos/&arquivo=va_ctrlpedido_pedidos&ext=php">
    <input type="text" name="txtcontrole" placeholder="Pesquisar"/><button type="submit" name="btnpesquisar"><img src="../visual/imagens/pesquisar.png"></button>
  </form>
</div>
<div class="registros">
  <table width="80%">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Data Prevista</th>
        <th>Pedido</th>
        <th>Status</th>
        <th>Telefone</th>
        <th>Concluído</th>
        <th>Entregue</th>
        <th>Cancelar</th>
      </tr>
    </thead>
    <tbody>
      <?php
        //caso tenha valor definido faça
        if(isset($_POST['txtcontrole'])||isset($_GET['data'])){
          //simplifica var
          if(isset($_POST['txtcontrole'])){
            $filtro = $_POST['txtcontrole'];
          }else{
            $filtro = $_GET['data'];
          }

          //nova pesquisa baseada no Filtro
          $sql_sel_pedidos = "SELECT clientes.nome AS cliente_nome, produtos.nome AS produto_nome, clientes.telefone, orcamentos_has_produtos.produtos_id, orcamentos_has_produtos.quantidade, orcamentos.id, orcamentos.status, orcamentos.data_prevista FROM orcamentos_has_produtos
          INNER JOIN produtos ON orcamentos_has_produtos.produtos_id = produtos.id
          INNER JOIN orcamentos ON orcamentos_has_produtos.orcamentos_id = orcamentos.id
          INNER JOIN clientes ON orcamentos.clientes_id = clientes.id
          WHERE (orcamentos.status='2' OR orcamentos.status='3') AND (clientes.nome LIKE '%$filtro%' OR produtos.nome LIKE '%$filtro%' OR orcamentos.data_prevista LIKE '%$filtro%') ";
          $sql_sel_pedidos_preparado = $conexaobd->prepare($sql_sel_pedidos);
          $sql_sel_pedidos_preparado->execute();
        }

        if($sql_sel_pedidos_preparado->rowCount()>0){
          while($sql_sel_pedidos_dados = $sql_sel_pedidos_preparado->fetch()){
            if($sql_sel_pedidos_dados['status']==2){
              $status = "em produção";
            }else if($sql_sel_pedidos_dados['status']==3){
              $status = "em estoque";
            }

            $data_prevista = explode("-", $sql_sel_pedidos_dados['data_prevista']);
      ?>
      <tr>
        <td><?php echo $sql_sel_pedidos_dados['cliente_nome'];?></td>
        <td><?php echo $data_prevista[2]."/".$data_prevista[1]."/".$data_prevista[0];?></td>
        <td><?php echo $sql_sel_pedidos_dados['quantidade'];?>x <?php echo $sql_sel_pedidos_dados['produto_nome'];?></td>
        <td><?php echo $status;?></td>
        <td><?php echo $sql_sel_pedidos_dados['telefone'];?></td>
        <?php
          if($sql_sel_pedidos_dados['status']==3){
        ?>
        <td align="center"><img src="../visual/imagens/concluido_finalizado.png" width="25px" height="25px"/></td>
        <td align="center" onclick="return confirmar_alteracao('entregue', 'produto', '<?php echo addslashes($sql_sel_pedidos_dados['produto_nome']);?>')"><a href="?pasta=pedidos/&arquivo=va_fmaltctrlpedidos_pedidos&ext=php&id=<?php echo $sql_sel_pedidos_dados['id'];?>&status=4"><img src="../visual/imagens/entregue.png" width="25px" height="25px"/></a></td>
        <?php
          }else{
        ?>
        <td align="center" onclick="return confirmar_alteracao('concluído', 'produto', '<?php echo addslashes($sql_sel_pedidos_dados['produto_nome']);?>')" ><a href="?pasta=pedidos/&arquivo=va_altstatus_pedidos&ext=php&id=<?php echo $sql_sel_pedidos_dados['id'];?>&status=3"><img src="../visual/imagens/concluido.png" width="25px" height="25px"/></a></td>
        <td align="center" ><img src="../visual/imagens/entregue_desabilitado.png" width="25px" height="25px"/></td>
        <?php
          }
        ?>
        <td align="center" onclick="return confirmar_alteracao('cancelado', 'produto', '<?php echo addslashes($sql_sel_pedidos_dados['produto_nome']);?>')"><a href="?pasta=pedidos/&arquivo=va_altstatus_pedidos&ext=php&id=<?php echo $sql_sel_pedidos_dados['id'];?>&status=5"><img src="../visual/imagens/cancelar.png" width="25px" height="25px"/></a></td>
      </tr>
      <?php
          }
        }else{
      ?>
      <tr>
        <td align="center" colspan="10">Não há registro de pedidos.</td>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
