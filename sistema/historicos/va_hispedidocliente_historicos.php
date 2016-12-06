<?php
  $permissao_acesso = 1;
?>
<script>
  $(document).ready(function(){
    $(".toggle").hide();

    $("ul").click(function(){
      $(".toggle", this).toggle();
    });
  });
</script>
<h1>Histórico de Pedido do(a) Cliente</h1>
<?php
  //caso tenha valor definido faça
  if(isset($_POST['txtconsulta'])){
    //simplifica var
    $filtro = $_POST['txtconsulta'];
  }else{
    $filtro = "";
  }

  $sql_sel_orcamentos_has_produtos = "SELECT clientes.nome AS cliente_nome, orcamentos.status, orcamentos.data_entrega, produtos.*, materias_primas.nome AS materiaPrima_nome, orcamentos_has_produtos.altura AS orcamento_altura, orcamentos_has_produtos.profundidade AS orcamento_profundidade, orcamentos_has_produtos.preco AS orcamento_preco, orcamentos_has_produtos.largura AS orcamento_largura, orcamentos_has_produtos.descricao AS orcamento_descricao, orcamentos_has_produtos.imagem AS orcamento_imagem, orcamentos_has_produtos.quantidade
  FROM orcamentos_has_produtos
  INNER JOIN produtos ON orcamentos_has_produtos.produtos_id=produtos.id
  INNER JOIN materias_primas ON orcamentos_has_produtos.materias_primas_id=materias_primas.id
  INNER JOIN orcamentos ON orcamentos_has_produtos.orcamentos_id=orcamentos.id
  INNER JOIN clientes ON orcamentos.clientes_id=clientes.id WHERE orcamentos.status='4'AND clientes.nome LIKE '%$filtro%'";
  $sql_sel_orcamentos_has_produtos_preparado = $conexaobd->prepare($sql_sel_orcamentos_has_produtos);
  $sql_sel_orcamentos_has_produtos_preparado->execute();
?>
<div class="consulta_toggle">
  <div class="form_pesquisa">
    <!--Formulário de pesquisa -->
    <form name="frmfilhispedidocliente" method="post" action="?pasta=historicos/&arquivo=va_hispedidocliente_historicos&ext=php">
      <input type="text" name="txtconsulta" placeholder="Pesquisar"/><button type="submit" name="btnpesquisar"><img src="../visual/imagens/pesquisar.png"></button>
    </form>
    <!--Fim formulário de pesquisa -->
  </div>
  <table width="60%">
    <thead>
      <tr>
        <th width="30%">Nome</th>
        <th width="30%">Data de Entrega</th>
      </tr>
    </thead>
    <tbody>
      <?php
        //Verificando a existencia de dados
        if($sql_sel_orcamentos_has_produtos_preparado->rowCount()>0){
          while($sql_sel_orcamentos_has_produtos_dados = $sql_sel_orcamentos_has_produtos_preparado->fetch()){
            //se dados do orçamento for vazio, adicionar os valores de produtos
            if($sql_sel_orcamentos_has_produtos_dados['orcamento_altura']==""){
              $preco = $sql_sel_orcamentos_has_produtos_dados['preco'];
              $altura = $sql_sel_orcamentos_has_produtos_dados['altura'];
              $profundidade = $sql_sel_orcamentos_has_produtos_dados['profundidade'];
              $largura = $sql_sel_orcamentos_has_produtos_dados['largura'];
              $descricao = $sql_sel_orcamentos_has_produtos_dados['descricao'];
              $imagem = $sql_sel_orcamentos_has_produtos_dados['imagem'];
            //se dados de orçamento forem cheios, usar os mesmos
            }else{
              $preco = $sql_sel_orcamentos_has_produtos_dados['orcamento_preco'];
              $altura = $sql_sel_orcamentos_has_produtos_dados['orcamento_altura'];
              $profundidade = $sql_sel_orcamentos_has_produtos_dados['orcamento_profundidade'];
              $largura = $sql_sel_orcamentos_has_produtos_dados['orcamento_largura'];
              $descricao = $sql_sel_orcamentos_has_produtos_dados['orcamento_descricao'];
              $imagem = $sql_sel_orcamentos_has_produtos_dados['orcamento_imagem'];
            }
      ?>
      <!--Mostrando dados na tabela -->
      <tr class="titulos">
        <td><?php echo $sql_sel_orcamentos_has_produtos_dados['cliente_nome'];?></td>
        <td><?php echo implode("/", array_reverse(explode("-", $sql_sel_orcamentos_has_produtos_dados['data_entrega'])))?></td>
      </tr>
      <tr><td align="center" colspan="2">
        <ul><button class="botao_mais">+</button>
          <li class="toggle">
            <ul class="tabela_toggle" ><button class="botao_mais">-</button>
                <table>
                  <tr class="dados_consulta">
                    <!--Mostrando valor de preço -->
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_orcamentos_has_produtos_dados['preco']==""){
                            echo "Preço: -";
                          }else{
                            echo "Preço: R$".number_format($preco,"2",",",".");
                          }
                        ?>
                    </td>
                    <!--Mostrando valor de descrição -->
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_orcamentos_has_produtos_dados['descricao']==""){
                            echo "Descrição: -";
                          }else{
                            echo "Descrição: ".$descricao;
                          }
                        ?>
                    </td>
                  </tr>
                  <!--Mostrando nome do produto -->
                  <tr class="dados_consulta">
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_orcamentos_has_produtos_dados['nome']==""){
                            echo "Produto: -";
                          }else{
                            echo "Produto: ".$sql_sel_orcamentos_has_produtos_dados['nome'];
                          }
                        ?>
                    </td>
                    <!--Mostrando a materia prima do produto  -->
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_orcamentos_has_produtos_dados['materiaPrima_nome']==""){
                            echo "Matéria-prima: -";
                          }else{
                            echo "Matéria-prima: ".$sql_sel_orcamentos_has_produtos_dados['materiaPrima_nome'];
                          }
                        ?>
                    </td>
                  </tr>
                  <tr>
                    <!--Mostrando a imagem do produto -->
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_orcamentos_has_produtos_dados['imagem']==""){
                            echo "Imagem: - ";
                          }else{
                            echo "imagem: <img height='100px' width='100px' src=".$imagem.">";
                          }
                        ?>
                    </td>
                  </tr>
                  <tr class="dados_consulta">
                    <!-- Dimensões do produto -->
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_orcamentos_has_produtos_dados['altura']==""){
                            echo "Altura: -";
                          }else{
                            echo "Altura: ".number_format($altura, '2', ',', '.')."cm";
                          }
                        ?>
                    </td>
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_orcamentos_has_produtos_dados['profundidade']==""){
                            echo "Profundidade: -";
                          }else{
                            echo "Profundidade: ".number_format($profundidade, '2', ',', '.')."cm";
                          }
                        ?>
                    </td>
                  </tr>
                  <tr class="dados_consulta">
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_orcamentos_has_produtos_dados['largura']==""){
                            echo "Largura: -";
                          }else{
                            echo "Largura: ".number_format($largura, '2', ',', '.')."cm";
                          }
                        ?>
                    </td>
                    <!--Quantidade do mesmo produto -->
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_orcamentos_has_produtos_dados['quantidade']==""){
                            echo "Quantidade: -";
                          }else{
                            echo "Quantidade: ".$sql_sel_orcamentos_has_produtos_dados['quantidade'];
                          }
                        ?>
                    </td>
                  </tr>
                </table>
              </ul>
            </li>
          </ul>
        </td>
      </tr>
      <?php
          }
        }else{
      ?>
      <tr>
        <?php
          if(!isset($txtconsulta)){
            echo '<td align="center" colspan="10">Não há registro de pedido do(a) cliente para essa pesquisa</td>';
          }else{
           echo '<td align="center" colspan="10">Não há registros de pedido do(a) cliente</td>';
          }
          ?>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
