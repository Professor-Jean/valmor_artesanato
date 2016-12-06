<?php
 $permissao_acesso = 1;
?>
<h1>Consulta de Produto</h1>
<?php
  //pegando todos os produtos cadastrados
  $sql_sel_produtos = "SELECT produtos.*, categorias.categoria, categorias.id AS categorias_id
  FROM produtos INNER JOIN categorias ON produtos.categorias_id=categorias.id";
  $sql_sel_produtos_preparado = $conexaobd->prepare($sql_sel_produtos);
  $sql_sel_produtos_preparado->execute();
?>
<!--Formulário de pesquisa -->
<div class="form_pesquisa2">
  <form class="pesquisa" name="frmfilvisproduto" method="post" action="?pasta=consultas/&arquivo=va_visproduto_consultas&ext=php">
    <input type="text" name="txtconsulta" placeholder="Pesquisar"/><button type="submit" name="btnpesquisar"><img src="../visual/imagens/pesquisar.png"></button>
  </form>
</div>
<!--Fim formulário de pesquisa -->
<div class="registros">
  <table width="80%">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Preço</th>
        <th>Imagem</th>
        <th>Altura</th>
        <th>Largura</th>
        <th>Profundidade</th>
        <th>N° de Peças</th>
        <th>Descrição</th>
        <th>Categoria</th>
        <th>Orçar</th>
      </tr>
    </thead>
    <tbody>
      <?php
        //caso tenha valor definido faça
        if(isset($_POST['txtconsulta'])){
          //simplifica var
          $filtro = $_POST['txtconsulta'];

          //nova pesquisa baseada no Filtro
          $sql_sel_produtos = "SELECT produtos.*, categorias.*
          FROM produtos INNER JOIN categorias ON produtos.categorias_id=categorias.id
          WHERE produtos.nome LIKE '%$filtro%'";
          $sql_sel_produtos_preparado = $conexaobd->prepare($sql_sel_produtos);
          $sql_sel_produtos_preparado->execute();
        }

        if($sql_sel_produtos_preparado->rowCount()>0){
          while($sql_sel_produtos_dados = $sql_sel_produtos_preparado->fetch()){
      ?>
      <!--Mostrando dados na tabela -->
      <tr>
        <td><?php echo $sql_sel_produtos_dados['nome'];?></td>
        <td>R$<?php echo number_format($sql_sel_produtos_dados['preco'],"2",",",".");?></td>
        <td><a target="_blank"  href="<?php echo $sql_sel_produtos_dados['imagem']?>">link</a></td>
        <td><?php echo number_format($sql_sel_produtos_dados['altura'], '2', ',', '.');?>cm</td>
        <td><?php echo number_format($sql_sel_produtos_dados['largura'], '2', ',', '.');?>cm</td>
        <td><?php echo number_format($sql_sel_produtos_dados['profundidade'], '2', ',', '.');?>cm</td>
        <td><?php echo $sql_sel_produtos_dados['n_pecas'];?></td>
        <td><?php
              //caso falor não existir mostre -
              if($sql_sel_produtos_dados['descricao']==""){
                echo "-";
              //se não mostre o valor
              }else{
                echo $sql_sel_produtos_dados['descricao'];
              }
            ?></td>
        </td>
        <td><?php echo $sql_sel_produtos_dados['categoria'];?></td>
        <td align="center"><a href="?pasta=pedidos/&arquivo=va_fmins_pedidos&ext=php&id=<?php echo $sql_sel_produtos_dados['id'];?>"><img src="../visual/imagens/orcar.png" width="25px" height="25px"/></a></td>
      </tr>
      <?php
          }
        }else{
      ?>
      <tr>
        <?php
        if(!isset($txtconsulta)){
          echo '<td align="center" colspan="10">Não há registro para essa pesquisa</td>';
        }else{
         echo '<td align="center" colspan="10">Não há registros de produtos</td>';
        }
        ?>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
