<?php
 $permissao_acesso="1";

 $sql_sel_orcamentos_has_produtos= "SELECT clientes.nome AS nome_pessoa, produtos.preco,produtos.nome AS nome_produto, orcamentos.data_entrega, orcamentos.clientes_id, orcamentos_has_produtos.altura AS orcamento_altura, orcamentos_has_produtos.preco AS orcamento_preco, orcamentos_has_produtos.quantidade, orcamentos.status, produtos.altura, produtos.id AS id FROM orcamentos_has_produtos
 INNER JOIN orcamentos ON orcamentos_has_produtos.orcamentos_id=orcamentos.id
 INNER JOIN clientes ON orcamentos.clientes_id=clientes.id
 INNER JOIN produtos ON orcamentos_has_produtos.produtos_id=produtos.id
 WHERE orcamentos.status>'1'
 ORDER BY data_entrega  ASC";
 $sql_sel_orcamentos_has_produtos_preparado = $conexaobd->prepare($sql_sel_orcamentos_has_produtos);
 $sql_sel_orcamentos_has_produtos_preparado->execute();
?>
<h1>Consulta de Pedidos</h1>
  <div class="form_pesquisa2">
    <form name="frmselstatus" method="POST" action="?pasta=consultas/&arquivo=va_vispedido_consultas&ext=php">
      <select name="selstatus" onchange="this.form.submit()" id="selstatus">
        <option value="">Escolha...</option>
        <option value="2">Em produção</option>
        <option value="3">Em estoque</option>
        <option value="4">Entregue</option>
        <option value="5">Cancelado</option>
      </select>
      <script type="text/javascript">
        document.getElementById('selstatus').value = "<?php echo $_POST['selstatus'];?>";
      </script>
    </form>
    <form name="frmhismanutencoes" method="POST" action="?pasta=consultas/&arquivo=va_vispedido_consultas&ext=php">
      <input type="text" name="txtfiltro" placeholder="Pesquisar"/><button type="submit" name="btnpesquisar"><img src="../visual/imagens/pesquisar.png"></button>
    </form>
  </div>
  <div class="registros">
  <table width="80%">
    <thead>
      <tr>
        <th width="20%">Nome do cliente</th>
        <th width="15%">Entrega</th>
        <th width="15%">Valor Total</th>
        <th width="20%">Produto</th>
        <th width="15%">Status</th>
        <th width="15%">Reutilizar</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if(isset($_POST['txtfiltro'])){
          $p_filtro = $_POST['txtfiltro'];

          $sql_sel_orcamentos_has_produtos= "SELECT clientes.nome AS nome_pessoa, produtos.preco,produtos.nome AS nome_produto, orcamentos.data_entrega, orcamentos.clientes_id, orcamentos_has_produtos.altura AS orcamento_altura, orcamentos_has_produtos.preco AS orcamento_preco, orcamentos_has_produtos.quantidade, orcamentos.status FROM orcamentos_has_produtos
          INNER JOIN orcamentos ON orcamentos_has_produtos.orcamentos_id=orcamentos.id
          INNER JOIN clientes ON orcamentos.clientes_id=clientes.id
          INNER JOIN produtos ON orcamentos_has_produtos.produtos_id=produtos.id
          WHERE (orcamentos.status>'1')
          AND (clientes.nome LIKE '%$p_filtro%'
          OR produtos.nome LIKE '%$p_filtro%')
          ORDER BY data_entrega  ASC";
          $sql_sel_orcamentos_has_produtos_preparado = $conexaobd->prepare($sql_sel_orcamentos_has_produtos);
          $sql_sel_orcamentos_has_produtos_preparado->execute();

        }

        if(isset($_POST['selstatus'])){
          $p_filtro = $_POST['selstatus'];

          $sql_sel_orcamentos_has_produtos= "SELECT clientes.nome AS nome_pessoa, produtos.preco,produtos.nome AS nome_produto, orcamentos.data_entrega, orcamentos.clientes_id, orcamentos_has_produtos.altura AS orcamento_altura, orcamentos_has_produtos.preco AS orcamento_preco, orcamentos_has_produtos.quantidade, orcamentos.status FROM orcamentos_has_produtos
          INNER JOIN orcamentos ON orcamentos_has_produtos.orcamentos_id=orcamentos.id
          INNER JOIN clientes ON orcamentos.clientes_id=clientes.id
          INNER JOIN produtos ON orcamentos_has_produtos.produtos_id=produtos.id
          WHERE orcamentos.status>'1'
          AND orcamentos.status LIKE '%$p_filtro%'
          ORDER BY data_entrega  ASC";
          $sql_sel_orcamentos_has_produtos_preparado = $conexaobd->prepare($sql_sel_orcamentos_has_produtos);
          $sql_sel_orcamentos_has_produtos_preparado->execute();
        }

        if($sql_sel_orcamentos_has_produtos_preparado->rowCount()>0){
          while($sql_sel_orcamentos_has_produtos_dados = $sql_sel_orcamentos_has_produtos_preparado->fetch()){

            if($sql_sel_orcamentos_has_produtos_dados['orcamento_preco']==""){
              $preco = $sql_sel_orcamentos_has_produtos_dados['preco'] * $sql_sel_orcamentos_has_produtos_dados['quantidade'];
            }else{
              $preco = $sql_sel_orcamentos_has_produtos_dados['orcamento_preco'] * $sql_sel_orcamentos_has_produtos_dados['quantidade'];
            }
      ?>
      <tr>
        <td><?php echo $sql_sel_orcamentos_has_produtos_dados['nome_pessoa']; ?></td>
        <td>
          <?php
            if($sql_sel_orcamentos_has_produtos_dados['data_entrega']==0){
              echo "-";
            }else{
              echo implode("/", array_reverse(explode("-", $sql_sel_orcamentos_has_produtos_dados['data_entrega'])));
          }
          ?>
        </td>
        <td>R$<?php echo number_format($preco,'2',',','.'); ?></td>
        <td><?php echo $sql_sel_orcamentos_has_produtos_dados['quantidade']."x ".$sql_sel_orcamentos_has_produtos_dados['nome_produto']; ?></td>
        <td>
          <?php
            if($sql_sel_orcamentos_has_produtos_dados['status']=='2'){
              $status = "Em produção";
            }else if($sql_sel_orcamentos_has_produtos_dados['status']=='3'){
              $status = "Em estoque";
            }else if($sql_sel_orcamentos_has_produtos_dados['status']=='4'){
              $status = "Entregue";
            }else if($sql_sel_orcamentos_has_produtos_dados['status']=='5'){
              $status = "Cancelado";
            }
            echo $status;

			if($sql_sel_orcamentos_has_produtos_dados['orcamento_altura']){
				$altura = "0";
			}else{
				$altura = "1";
			}
			
          ?>
        </td>
        <td align="center"><a href="?pasta=pedidos/&arquivo=va_fmins_pedidos&ext=php&clientes_id=<?php echo $sql_sel_orcamentos_has_produtos_dados['clientes_id'];?>&id=<?php echo $sql_sel_orcamentos_has_produtos_dados['id'];?>&altura=<?php echo $altura;?>" title="Reutilizar registro" ><img src="../visual/imagens/reciclar.png" class="icone_tabela"></td></tr>
      <?php
          }
        }else{
      ?>
      <tr>
        <?php
          if(isset($_POST['selstatus'])||isset($_POST['txtfiltro'])){
            echo '<td align="center" colspan="6">Não há registro de pedidos para essa pesquisa.</td>';
          }else{
           echo '<td align="center" colspan="6">Não há registro de pedidos para essa página.</td>';
          }
        ?>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
