<?php
  $permissao_acesso = 1;

    $n_pecas = $preco = $nome = $categorias_id = $largura = $altura = $profundidade = $imagem = $descricao = $quantidade = "";


    if(isset($_GET['altura'])&&isset($_GET['id'])){


      $g_produto_id = $_GET['id'];
      $g_altura = $_GET['altura'];

      if($g_altura=="0"){
        $pesquisa = "SELECT produtos.*, orcamentos_has_produtos.setor, orcamentos_has_produtos.quantidade, materias_primas.nome AS materia_prima_nome FROM
                    orcamentos_has_produtos INNER JOIN materias_primas ON orcamentos_has_produtos.materias_primas_id = materias_primas.id
                    INNER JOIN produtos ON orcamentos_has_produtos.produtos_id=produtos.id WHERE produtos.id='".$g_produto_id."'";
      }else{
        $pesquisa = "SELECT orcamentos_has_produtos.*, materias_primas.nome AS materia_prima_nome FROM orcamentos_has_produtos
                    INNER JOIN materias_primas ON orcamentos_has_produtos.materias_primas_id = materias_primas.id WHERE produtos_id='".$g_produto_id."'";
      }

      $sql_sel_produtosLink = $pesquisa;
      $sql_sel_produtosLink_preparado = $conexaobd->prepare($sql_sel_produtosLink);
      $sql_sel_produtosLink_preparado->execute();
      $sql_sel_produtosLink_dados = $sql_sel_produtosLink_preparado->fetch();

      $n_pecas = $sql_sel_produtosLink_dados['n_pecas'];
      $preco = $sql_sel_produtosLink_dados['preco'];
      $nome_materia = $sql_sel_produtosLink_dados['materia_prima_nome'];
      $largura = $sql_sel_produtosLink_dados['largura'];
      $altura = $sql_sel_produtosLink_dados['altura'];
      $profundidade = $sql_sel_produtosLink_dados['profundidade'];
      $imagem = $sql_sel_produtosLink_dados['imagem'];
      $descricao = $sql_sel_produtosLink_dados['descricao'];
      $quantidade = $sql_sel_produtosLink_dados['quantidade'];
      $setor = $sql_sel_produtosLink_dados['setor'];

    }else{

      $n_pecas = $preco = $nome = $categorias_id = $largura = $altura = $profundidade = $imagem = $descricao = $quantidade = "";

    }

    if(isset($_GET['id'])){

      $g_produto_id = $_GET['id'];

      $sql_sel_produtosLink = "SELECT * FROM produtos WHERE id = '".$g_produto_id."'";
      $sql_sel_produtosLink_preparado = $conexaobd->prepare($sql_sel_produtosLink);
      $sql_sel_produtosLink_preparado->execute();
      $sql_sel_produtosLink_dados = $sql_sel_produtosLink_preparado->fetch();

      $n_pecas = $sql_sel_produtosLink_dados['n_pecas'];
      $preco = $sql_sel_produtosLink_dados['preco'];
      $nome = $sql_sel_produtosLink_dados['nome'];
      $categorias_id = $sql_sel_produtosLink_dados['categorias_id'];
      $largura = $sql_sel_produtosLink_dados['largura'];
      $altura = $sql_sel_produtosLink_dados['altura'];
      $profundidade = $sql_sel_produtosLink_dados['profundidade'];
      $imagem = $sql_sel_produtosLink_dados['imagem'];
      $descricao = $sql_sel_produtosLink_dados['descricao'];

    }else{

      $n_pecas = $preco = $nome = $categorias_id = $largura = $altura = $profundidade = $imagem = $descricao = "";

    }

    if(isset($_GET['clientes_id'])){
      $g_cliente_id = $_GET['clientes_id'];
    }else{
      $g_cliente_id = "";
    }

?>
<style>
  .linhas{
    border-top: none !important;
  }

  .adicionarDiv{
    text-decoration: none;
  }

  .adicionar{
    border-top: none !important;
    text-align: center;
    min-width: 80%;
  }

  .removerDiv{
    text-decoration: none;
    text-align: center;
  }

</style>
<h1>Registro de Orçamentos</h1>
<form name="frminspedidos" method="POST" action="?pasta=pedidos/&arquivo=va_ins_pedidos&ext=php" onsubmit="return validaDetalhe()">
  <table width="50%">
    <tr>
      <td>*Cliente:</td>
      <td>
        <select name="selcliente">
          <option value="">Selecione um Cliente</option>
            <?php

            $sql_sel_clientes = "SELECT id, nome FROM clientes";

            $sql_sel_clientes_preparado = $conexaobd->prepare($sql_sel_clientes); //preparando a variavel

            $sql_sel_clientes_preparado->execute();//executando a variavel preparada

            while($sql_sel_clientes_dados = $sql_sel_clientes_preparado->fetch()){
              $codigo_clientes = $sql_sel_clientes_dados['id'];
              $nome_clientes = $sql_sel_clientes_dados['nome'];
              if($g_cliente_id!=""&&$g_cliente_id==$codigo_clientes){
                echo "<option value='".$codigo_clientes."' selected>".$nome_clientes."</option>";
              }else{
                echo "<option value='".$codigo_clientes."'>".$nome_clientes."</option>";
              }
            }
            ?>
        </select>
      </td>
      <td>*Data do Orçamento:</td>
      <td><input type="text" name="txtdata" maxlength="30" value="<?php echo date("d/m/20y");?>" class="datepicker"></td>
    </tr>
  </table>
  <!-- Área de Adicionar Produto -->
  <table class="adicionar" width="50%">
    <tr>
      <td colspan="4"><a href="#" class="adicionarDiv" title="Adicionar produto">+ Adicionar mais um produto</a></td>
    </tr>
  </table>
  <table width="50%" class="linhas">
      <tr>
        <td>*Produto:</td>
        <td colspan="3">
          <select name="selproduto[]">
            <option value="">Selecione um Produto</option>
            <?php

            $sql_sel_produtos = "SELECT produtos.id, produtos.nome, categorias.categoria FROM produtos
            INNER JOIN categorias ON produtos.categorias_id = categorias.id
            ORDER BY categorias.categoria";

            $sql_sel_produtos_preparado = $conexaobd->prepare($sql_sel_produtos); //preparando a variavel

            $sql_sel_produtos_preparado->execute();//executando a variavel preparada

            while($sql_sel_produtos_dados = $sql_sel_produtos_preparado->fetch()){
              $codigo_produtos = $sql_sel_produtos_dados['id'];
              $nome_produtos = $sql_sel_produtos_dados['nome'];
              $categoria_produtos = $sql_sel_produtos_dados['categoria'];
              if($nome!=""&&$nome==$nome_produtos){ // Caso o nome recebido não seja vazio e seja igual ao nome que esta sendo executado, crie um option selecionado.
                echo "<option value='".$codigo_produtos."' selected>".$nome_produtos." / ".$categoria_produtos."</option>";
              }else{
                echo "<option value='".$codigo_produtos."'>".$nome_produtos." / ".$categoria_produtos."</option>";
              }
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>*Matéria-prima:</td>
        <td>
          <select name="selmateriaprima[]">
            <option value="">Selecione uma matéria-prima</option>
              <?php

              $sql_sel_materias_primas = "SELECT * FROM materias_primas";

              $sql_sel_materias_primas_preparado = $conexaobd->prepare($sql_sel_materias_primas); //preparando a variavel

              $sql_sel_materias_primas_preparado->execute();//executando a variavel preparada

              while($sql_sel_materias_primas_dados = $sql_sel_materias_primas_preparado->fetch()){
                $codigo_materias_primas = $sql_sel_materias_primas_dados['id'];
                $nome_materias_primas = $sql_sel_materias_primas_dados['nome'];

				if($nome_materias_primas == $nome_materia){
					echo "<option value='".$codigo_materias_primas."' selected>".$nome_materias_primas."</option>";
				}else{
	                echo "<option value='".$codigo_materias_primas."'>".$nome_materias_primas."</option>";
				}

              }
              ?>
            </select>
        </td>
        <td>*Setor:</td>
        <td>
          <select name="selsetor[]">
			<?php
				echo "<option value=''>Selecione um setor</option>";
				if($setor=="0"){
					echo "<option value='0' selected>Marcenaria</option>";
				}else{
					echo "<option value='0'>Marcenaria</option>";
				}

				if($setor=="1"){
					echo "<option value='1' selected>Laser</option>";
				}else{
					echo "<option value='1'>Laser</option>";
				}

				if($setor=="2"){
					echo "<option value='2' selected>Laser e Marcenaria</option>";
				}else{
					echo "<option value='2' >Laser e Marcenaria</option>";
				}
			?>
		  </select>
        </td>
      </tr>
      <?php
        if($altura!=""){
      ?>
      <tr>
        <td>Imagem:</td>
        <td><input type="text" name="txtimagem[]" maxlength="255" value="<?php echo $imagem;?>"></td>
        <td>*Número de peças:</td>
        <td><input type="text" name="txtnpecas[]" maxlength="255" value="<?php echo $n_pecas;?>"></td>
      </tr>
      <tr>
        <td>*Largura:</td>
        <td><input type="text" name="txtlargura[]" maxlength="30" value="<?php echo number_format($largura, '2', ',', '');?>"></td>
        <td>*Altura:</td>
        <td><input type="text" name="txtaltura[]" maxlength="15" value="<?php echo number_format($altura, '2', ',', '');?>"></td>
      </tr>
      <tr>
        <td>*Profundidade:</td>
        <td><input type="text" name="txtprofundidade[]" maxlength="30" value="<?php echo number_format($profundidade, '2', ',', '');?>"></td>
        <td>*Preço Unit.:</td>
        <td><input type="text" name="txtpreco[]" maxlength="5" value="<?php echo number_format($preco, '2', ',', '');?>"></td>
      </tr>
      <tr>
        <td>*Quantidade:</td>
        <td><input type="text" name="txtquantidade[]" maxlength="20" value="<?php echo $quantidade;?>"></td>
        <td>Descrição:</td>
        <td><textarea name="txadescricao[]"><?php echo $descricao;?></textarea></td>
      </tr>
      <?php
        }else{
      ?>
      <tr>
        <td>Imagem:</td>
        <td><input type="text" name="txtimagem[]" maxlength="255" value="<?php echo $imagem;?>"></td>
        <td>*Número de peças:</td>
        <td><input type="text" name="txtnpecas[]" maxlength="255" value="<?php echo $n_pecas;?>"></td>
      </tr>
      <tr>
        <td>*Largura:</td>
        <td><input type="text" name="txtlargura[]" maxlength="30" value="<?php echo $largura;?>"></td>
        <td>*Altura:</td>
        <td><input type="text" name="txtaltura[]" maxlength="15" value="<?php echo $altura;?>"></td>
      </tr>
      <tr>
        <td>*Profundidade:</td>
        <td><input type="text" name="txtprofundidade[]" maxlength="30" value="<?php echo $profundidade;?>"></td>
        <td>*Preço Unit.:</td>
        <td><input type="text" name="txtpreco[]" maxlength="5" value="<?php echo $preco;?>"></td>
      </tr>
      <tr>
        <td>*Quantidade:</td>
        <td><input type="text" name="txtquantidade[]" maxlength="20" value="<?php echo $quantidade;?>"></td>
        <td>Descrição:</td>
        <td><textarea name="txadescricao[]"><?php echo $descricao;?></textarea></td>
      </tr>
      <?php
        }
      ?>
      <tr>
        <td colspan="4">Obrigatórios*</td>
      </tr>
      <tr>
        <td colspan="4">
          <a href="#" class="removerDiv" title="Remover linha">- Remover este produto</a>
        </td>
      </tr>
  </table><!-- Fecha table linhas -->
  <div class="botoes">
    <button class="botao_limpar" type="reset" name="btnlimpar">Limpar</button>
    <button class="botao_registrar" type="submit" name="btnregistrar">Registrar</button>
  </div>
</form>
