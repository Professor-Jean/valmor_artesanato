<?php
 $permissao_acesso="1";

 $sql_sel_orcamentos_has_produtos= "SELECT materias_primas.nome AS materia_prima_nome, clientes.nome AS nome_pessoa, produtos.*, produtos.nome AS nome_produto, orcamentos.data_entrega, orcamentos.clientes_id, orcamentos_has_produtos.altura AS orcamento_altura, orcamentos_has_produtos.profundidade AS orcamento_profundidade, orcamentos_has_produtos.preco AS orcamento_preco, orcamentos_has_produtos.largura AS orcamento_largura, orcamentos_has_produtos.descricao AS orcamento_descricao, orcamentos_has_produtos.imagem AS orcamento_imagem, orcamentos_has_produtos.quantidade, orcamentos.status FROM orcamentos_has_produtos
 INNER JOIN orcamentos ON orcamentos_has_produtos.orcamentos_id=orcamentos.id
 INNER JOIN clientes ON orcamentos.clientes_id=clientes.id
 INNER JOIN produtos ON orcamentos_has_produtos.produtos_id=produtos.id
 INNER JOIN materias_primas ON orcamentos_has_produtos.materias_primas_id=materias_primas.id
 WHERE status='4' OR status='3' ORDER BY data_entrega  ASC";
 $sql_sel_orcamentos_has_produtos_preparado = $conexaobd->prepare($sql_sel_orcamentos_has_produtos);
 $sql_sel_orcamentos_has_produtos_preparado->execute();
?>
<h1>Consulta de Serviços Realizados</h1>
  <div class="form_pesquisa2">
    <form name="frmselstatus" method="POST" action="?pasta=consultas/&arquivo=va_visservicosrealizados_consultas&ext=php">
      <select name="selstatus" onchange="this.form.submit()" id="selstatus">
        <option value="">Escolha...</option>
        <option value="3">Em estoque</option>
        <option value="4">Entregue</option>
      </select>
      <script type="text/javascript">
        document.getElementById('selstatus').value = "<?php echo $_POST['selstatus'];?>";
      </script>
    </form>
    <form name="frmhismanutencoes" method="POST" action="?pasta=consultas/&arquivo=va_visservicosrealizados_consultas&ext=php">
      <input type="text" name="txtfiltro" placeholder="Pesquisar"/><button type="submit" name="btnpesquisar"><img src="../visual/imagens/pesquisar.png"></button>
    </form>
  </div>
  <div class="registros">

      <table width="80%">
        <thead>
          <?php
            if(isset($_POST['txtfiltro'])){
              $p_filtro = $_POST['txtfiltro'];

              $sql_sel_orcamentos_has_produtos= "SELECT materias_primas.nome AS materia_prima_nome, clientes.nome AS nome_pessoa, produtos.*, produtos.nome AS nome_produto, orcamentos.data_entrega, orcamentos.clientes_id, orcamentos_has_produtos.altura AS orcamento_altura, orcamentos_has_produtos.profundidade AS orcamento_profundidade, orcamentos_has_produtos.preco AS orcamento_preco, orcamentos_has_produtos.largura AS orcamento_largura, orcamentos_has_produtos.descricao AS orcamento_descricao, orcamentos_has_produtos.imagem AS orcamento_imagem, orcamentos_has_produtos.quantidade, orcamentos.status FROM orcamentos_has_produtos
              INNER JOIN orcamentos ON orcamentos_has_produtos.orcamentos_id=orcamentos.id
              INNER JOIN clientes ON orcamentos.clientes_id=clientes.id
              INNER JOIN produtos ON orcamentos_has_produtos.produtos_id=produtos.id
              INNER JOIN materias_primas ON orcamentos_has_produtos.materias_primas_id=materias_primas.id
              WHERE (status='4' OR status='3')
              AND (clientes.nome LIKE '%$p_filtro%'
              OR produtos.nome LIKE '%$p_filtro%')
              ORDER BY data_entrega  ASC";
              $sql_sel_orcamentos_has_produtos_preparado = $conexaobd->prepare($sql_sel_orcamentos_has_produtos);
              $sql_sel_orcamentos_has_produtos_preparado->execute();

            }

            if(isset($_POST['selstatus'])&&($_POST['selstatus']<>"")){
              $p_filtro = $_POST['selstatus'];

              $sql_sel_orcamentos_has_produtos= "SELECT materias_primas.nome AS materia_prima_nome, clientes.nome AS nome_pessoa, produtos.*, produtos.nome AS nome_produto, orcamentos.data_entrega, orcamentos.clientes_id, orcamentos_has_produtos.altura AS orcamento_altura, orcamentos_has_produtos.profundidade AS orcamento_profundidade, orcamentos_has_produtos.preco AS orcamento_preco, orcamentos_has_produtos.largura AS orcamento_largura, orcamentos_has_produtos.descricao AS orcamento_descricao, orcamentos_has_produtos.imagem AS orcamento_imagem, orcamentos_has_produtos.quantidade, orcamentos.status FROM orcamentos_has_produtos
              INNER JOIN orcamentos ON orcamentos_has_produtos.orcamentos_id=orcamentos.id
              INNER JOIN clientes ON orcamentos.clientes_id=clientes.id
              INNER JOIN produtos ON orcamentos_has_produtos.produtos_id=produtos.id
              INNER JOIN materias_primas ON orcamentos_has_produtos.materias_primas_id=materias_primas.id
              WHERE status='$p_filtro'
              AND orcamentos.status LIKE '%$p_filtro%'
              ORDER BY data_entrega  ASC";
              $sql_sel_orcamentos_has_produtos_preparado = $conexaobd->prepare($sql_sel_orcamentos_has_produtos);
              $sql_sel_orcamentos_has_produtos_preparado->execute();
            }

            if($sql_sel_orcamentos_has_produtos_preparado->rowCount()>0){
              while($sql_sel_orcamentos_has_produtos_dados = $sql_sel_orcamentos_has_produtos_preparado->fetch()){

                if($sql_sel_orcamentos_has_produtos_dados['orcamento_altura']==""){
                  $preco = $sql_sel_orcamentos_has_produtos_dados['preco'];
                  $altura = $sql_sel_orcamentos_has_produtos_dados['altura'];
                  $profundidade = $sql_sel_orcamentos_has_produtos_dados['profundidade'];
                  $largura = $sql_sel_orcamentos_has_produtos_dados['largura'];
                  $descricao = $sql_sel_orcamentos_has_produtos_dados['descricao'];
                  $imagem = $sql_sel_orcamentos_has_produtos_dados['imagem'];
                }else{
                  $preco = $sql_sel_orcamentos_has_produtos_dados['orcamento_preco'];
                  $altura = $sql_sel_orcamentos_has_produtos_dados['orcamento_altura'];
                  $profundidade = $sql_sel_orcamentos_has_produtos_dados['orcamento_profundidade'];
                  $largura = $sql_sel_orcamentos_has_produtos_dados['orcamento_largura'];
                  $descricao = $sql_sel_orcamentos_has_produtos_dados['orcamento_descricao'];
                  $imagem = $sql_sel_orcamentos_has_produtos_dados['orcamento_imagem'];
                }


          ?>
          <tr>
            <th width="25%"><?php echo $sql_sel_orcamentos_has_produtos_dados['nome_pessoa']?></th>
            <th width="15%">Produto</th>
            <th width="10%">Altura</th>
            <th width="10%">Largura</th>
            <th width="10%">Profundidade</th>
            <th width="10%">Matéria-prima</th>
            <th width="20%">Descrição</th>
            <th width="5%">Qtd.</th>
            <th width="10%">Data de entrega</th>
          </tr>
        </thead>
        <tbody class="imagem_csr">
          <tr>
            <td><img src="<?php echo $imagem; ?>" /></td>
            <td><?php echo $sql_sel_orcamentos_has_produtos_dados['nome_produto']; ?></td>
            <td><?php echo number_format($altura, '2', ',', '.'); ?>cm</td>
            <td><?php echo number_format($largura, '2', ',', '.'); ?>cm</td>
            <td><?php echo number_format($profundidade, '2', ',', '.'); ?>cm</td>
            <td><?php echo $sql_sel_orcamentos_has_produtos_dados['materia_prima_nome']; ?></td>
            <td>
              <?php
                if($descricao==""){
                  echo "-";
                }else{
                  echo $descricao;
                }
               ?>
            </td>
            <td><?php echo $sql_sel_orcamentos_has_produtos_dados['quantidade']; ?></td>
            <td>
              <?php
                if($sql_sel_orcamentos_has_produtos_dados['data_entrega']==''){
                  echo "-";
                }else{
                  echo implode("/", array_reverse(explode("-", $sql_sel_orcamentos_has_produtos_dados['data_entrega'])));
                }
              ?>
            </td>
          </tr>
          <?php
              }
            }else{
          ?>
            <tr>
              <?php
                if(isset($_POST['selstatus'])||isset($_POST['txtfiltro'])){
                  echo '<td align="center" colspan="6">Não há registro de serviços realizados para essa pesquisa</td>';
                }else{
                 echo '<td align="center" colspan="6">Não há registro de serviços realizados</td>';
                }
              ?>
            </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
</div>
