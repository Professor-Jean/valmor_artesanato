<?php
  $permissao_acesso = 1;

    if(isset($_GET['id'])){

      $g_orcamento_id = $_GET['id'];

      $sql_sel_orcamentos_has_produtos = "SELECT clientes.nome AS cliente_nome, orcamentos.status, categorias.categoria, orcamentos.id AS orcamentos_id, orcamentos.data_entrega, produtos.*, materias_primas.nome AS materiaPrima_nome, orcamentos_has_produtos.setor,
      orcamentos_has_produtos.id AS orcamentos_has_produtos_id, orcamentos_has_produtos.quantidade,orcamentos_has_produtos.altura AS orcamento_altura, orcamentos_has_produtos.profundidade AS orcamento_profundidade, orcamentos_has_produtos.preco AS orcamento_preco, orcamentos_has_produtos.largura AS orcamento_largura, orcamentos_has_produtos.descricao AS orcamento_descricao, orcamentos_has_produtos.imagem AS orcamento_imagem, orcamentos_has_produtos.quantidade, orcamentos_has_produtos.n_pecas AS orcamento_n_pecas
      FROM orcamentos_has_produtos
      INNER JOIN produtos ON orcamentos_has_produtos.produtos_id=produtos.id
      INNER JOIN categorias ON produtos.categorias_id=categorias.id
      INNER JOIN materias_primas ON orcamentos_has_produtos.materias_primas_id=materias_primas.id
      INNER JOIN orcamentos ON orcamentos_has_produtos.orcamentos_id=orcamentos.id
      INNER JOIN clientes ON orcamentos.clientes_id=clientes.id WHERE orcamentos_id = '".$g_orcamento_id."'";
      $sql_sel_orcamentos_has_produtos_preparado = $conexaobd->prepare($sql_sel_orcamentos_has_produtos);
      $sql_sel_orcamentos_has_produtos_preparado->execute();
      $sql_sel_orcamentos_has_produtos_dados = $sql_sel_orcamentos_has_produtos_preparado->fetch();

      $setor = $sql_sel_orcamentos_has_produtos_dados['setor'];
      $categoria = $sql_sel_orcamentos_has_produtos_dados['categoria'];
      $quantidade = $sql_sel_orcamentos_has_produtos_dados['quantidade'];

      if($sql_sel_orcamentos_has_produtos_dados['orcamento_altura']==""){
        $preco = $sql_sel_orcamentos_has_produtos_dados['preco'];
        $altura = $sql_sel_orcamentos_has_produtos_dados['altura'];
        $profundidade = $sql_sel_orcamentos_has_produtos_dados['profundidade'];
        $largura = $sql_sel_orcamentos_has_produtos_dados['largura'];
        $descricao = $sql_sel_orcamentos_has_produtos_dados['descricao'];
        $imagem = $sql_sel_orcamentos_has_produtos_dados['imagem'];
        $n_pecas = $sql_sel_orcamentos_has_produtos_dados['n_pecas'];
      }else{
        $preco = $sql_sel_orcamentos_has_produtos_dados['orcamento_preco'];
        $altura = $sql_sel_orcamentos_has_produtos_dados['orcamento_altura'];
        $profundidade = $sql_sel_orcamentos_has_produtos_dados['orcamento_profundidade'];
        $largura = $sql_sel_orcamentos_has_produtos_dados['orcamento_largura'];
        $descricao = $sql_sel_orcamentos_has_produtos_dados['orcamento_descricao'];
        $imagem = $sql_sel_orcamentos_has_produtos_dados['orcamento_imagem'];
        $n_pecas = $sql_sel_orcamentos_has_produtos_dados['orcamento_n_pecas'];
      }
    }
?>
<style>
  .linhas{
    border-top: none !important;
  }

</style>
      <h1>Alteração de Registro de Orçamento</h1>
      <form name="frmaltorcamentos" method="POST" action="?pasta=pedidos/&arquivo=va_altorcamento_pedidos&ext=php" onsubmit="return validaDetalhe()">
        <table width="50%">
          <input type="hidden" name="hidorcamentoid" value="<?php echo $sql_sel_orcamentos_has_produtos_dados['orcamentos__id']?>"/>
          <input type="hidden" name="hidorcamentohasprodutoid" value="<?php echo $sql_sel_orcamentos_has_produtos_dados['orcamentos_has_produtos_id']?>"/>
          <tr>
            <td>*Cliente:</td>
            <td>
              <input type="text" name="txtcliente" value="<?php echo $sql_sel_orcamentos_has_produtos_dados['cliente_nome'];?>" readonly/>
            </td>
            <td>*Data do Orçamento:</td>
            <td><input type="text" name="txtdata" maxlength="30" value="<?php echo date("d/m/20y");?>" readonly></td>
          </tr>
        </table>
        <table width="50%" class="linhas">
            <tr>
              <td>*Produto:</td>
              <td colspan="3">
                <input type="text" name="txtproduto" value="<?php echo $sql_sel_orcamentos_has_produtos_dados['nome']." / ".$categoria?>" readonly/>
              </td>
            </tr>
            <tr>
              <td>*Matéria-prima:</td>
              <td>
                <select name="selmateriaprima">
                  <option value="">Selecione uma matéria-prima</option>
                    <?php

                    $sql_sel_materias_primas = "SELECT * FROM materias_primas";

                    $sql_sel_materias_primas_preparado = $conexaobd->prepare($sql_sel_materias_primas); //preparando a variavel

                    $sql_sel_materias_primas_preparado->execute();//executando a variavel preparada

                    while($sql_sel_materias_primas_dados = $sql_sel_materias_primas_preparado->fetch()){
                      $codigo_materias_primas = $sql_sel_materias_primas_dados['id'];
                      $nome_materias_primas = $sql_sel_materias_primas_dados['nome'];

                      if($sql_sel_orcamentos_has_produtos_dados['materiaPrima_nome']!=""&&$sql_sel_orcamentos_has_produtos_dados['materiaPrima_nome']==$nome_materias_primas){
                        echo "<option value='".$codigo_materias_primas."' selected>".$nome_materias_primas."</option>";
                      }else {
                        echo "<option value='".$codigo_materias_primas."'>".$nome_materias_primas."</option>";
                      }
                    }
                    ?>
                  </select>
              </td>
              <td>*Número de peças:</td>
              <td><input type="text" name="txtnpecas" maxlength="255" value="<?php echo $n_pecas;?>"></td>
            </tr>
            <tr>
              <td>Imagem:</td>
              <td><input type="text" name="txtimagem" maxlength="255" value="<?php echo $imagem;?>"></td>
              <td>*Setor:</td>
              <td>
                <select name="selsetor">
                  <option value="">Selecione um setor</option>
                  <?php
                    if($sql_sel_orcamentos_has_produtos_dados['setor']=="0"){
                      echo "<option value='0' selected>Marcenaria</option>";
                    }else{
                      echo "<option value='0'>Marcenaria</option>";
                    }

                    if($sql_sel_orcamentos_has_produtos_dados['setor']=="1"){
                      echo "<option value='1' selected>Laser</option>";
                    }else{
                      echo "<option value='1'>Laser</option>";
                    }

                    if($sql_sel_orcamentos_has_produtos_dados['setor']=="2"){
                      echo "<option value='2' selected>Laser e Marcenaria</option>";
                    }else{
                      echo "<option value='2'>Laser e Marcenaria</option>";
                    }

                  ?>
                </select>
              </td>
            </tr>
            <?php
              if($altura!=""){
            ?>
            <tr>
              <td>*Largura:</td>
              <td><input type="text" name="txtlargura" maxlength="30" value="<?php echo number_format($largura, '2', ',', '');?>"></td>
              <td>*Altura:</td>
              <td><input type="text" name="txtaltura" maxlength="15" value="<?php echo number_format($altura, '2', ',', '');?>"></td>
            </tr>
            <tr>
              <td>*Profundidade:</td>
              <td><input type="text" name="txtprofundidade" maxlength="30" value="<?php echo number_format($profundidade, '2', ',', '');?>"></td>
              <td>*Preço Unit.:</td>
              <td><input type="text" name="txtpreco" maxlength="5" value="<?php echo number_format($preco, '2', ',', '');?>"></td>
            </tr>
            <tr>
              <td>*Quantidade:</td>
              <td><input type="text" name="txtquantidade" maxlength="20" value="<?php echo $quantidade;?>"></td>
              <td>Descrição:</td>
              <td><textarea name="txadescricao"><?php echo $descricao;?></textarea></td>
            </tr>
            <?php
              }else{
            ?>
            <tr>
              <td>*Largura:</td>
              <td><input type="text" name="txtlargura" maxlength="30" value="<?php echo $largura;?>"></td>
              <td>*Altura:</td>
              <td><input type="text" name="txtaltura" maxlength="15" value="<?php echo $altura;?>"></td>
            </tr>
            <tr>
              <td>*Profundidade:</td>
              <td><input type="text" name="txtprofundidade" maxlength="30" value="<?php echo $profundidade;?>"></td>
              <td>*Preço Unit.:</td>
              <td><input type="text" name="txtpreco" maxlength="5" value="<?php echo $preco;?>"></td>
            </tr>
            <tr>
              <td>*Quantidade:</td>
              <td><input type="text" name="txtquantidade" maxlength="20" value="<?php echo $quantidade;?>"></td>
              <td>Descrição:</td>
              <td><textarea name="txadescricao"><?php echo $descricao;?></textarea></td>
            </tr>
            <?php
              }
            ?>
            <tr>
              <td colspan="4">Obrigatórios*</td>
            </tr>
          </table>
          <div class="botoes">
            <button class="botao_limpar" type="reset" name="btnlimpar">Limpar</button>
            <button class="botao_registrar" type="submit" name="btnregistrar">Registrar</button>
          </div>
        </form>
