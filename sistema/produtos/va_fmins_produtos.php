<?php
  $permissao_acesso = 1;
?>

      <div class="conteudo"><!--Inicio conteúdo-->
        <h1>Registro de Produto</h1>
        <!--Formulário de inserção-->
        <form name="frminsprodutos" method="post" action="?pasta=produtos/&arquivo=va_ins_produtos&ext=php" onsubmit="return validarFormInsProdutos()">
          <table>
            <tr>
              <td>*Nome:</td>
              <td><input type="text" name="txtnome" maxlength="45"></td>
            </tr>
            <tr>
              <td>*Categoria:</td>
              <td>
                <select name="selcategoria">
                  <option value="">Selecione uma categoria</option>
                  <?php

                  $sql_sel_categorias = "SELECT * FROM categorias";

                  $sql_sel_categorias_preparado = $conexaobd->prepare($sql_sel_categorias); //preparando a variavel

                  $sql_sel_categorias_preparado->execute();//executando a variavel preparada

                  while($sql_sel_categorias_dados = $sql_sel_categorias_preparado->fetch()){
                    $codigo_categorias = $sql_sel_categorias_dados['id'];
                    $nome_categorias = $sql_sel_categorias_dados['categoria'];
                    echo "<option value='".$codigo_categorias."'>".$nome_categorias."</option>";
                  }
                  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Imagem:</td>
              <td><input type="text" name="txtimagem" maxlength="255"></td>
            </tr>
            <tr>
              <td>*Altura:</td>
              <td><input type="text" name="txtaltura" maxlength="7" placeholder="em cm"></td>
            </tr>
            <tr>
              <td>*Largura:</td>
              <td><input type="text" name="txtlargura" maxlength="7" placeholder="em cm"></td>
            </tr>
            <tr>
              <td>*Profundidade:</td>
              <td><input type="text" name="txtprofundidade" maxlength="7" placeholder="em cm"></td>
            </tr>
            <tr>
              <td>*Número de peças:</td>
              <td><input type="text" name="txtnumeropecas" maxlength="3"></td>
            </tr>
            <tr>
              <td>*Preço:</td>
              <td><input type="text" name="txtpreco" maxlength="7"></td>
            </tr>
            <tr>
              <td>Descrição:</td>
              <td><textarea name="txadescricao"></textarea></td>
            </tr>
            <tr>
              <td colspan="2">Obrigatórios*</td>
            </tr>
          </table>
          <div class="botoes">
            <button class="botao_limpar" type="reset" name="btnlimpar">Limpar</button>
            <button class="botao_registrar" type="submit" name="btnregistrar">Registrar</button>
          </div>
        </form>
        <!--Fim formulário de inserção-->
        <h1>Produtos Registrados</h1>
        <?php
          //pegando os dados dos produtos registrados para mostrar na tabela
          $sql_sel_produtos = "SELECT produtos.*, categorias.categoria FROM produtos INNER JOIN categorias WHERE produtos.categorias_id=categorias.id";
          $sql_sel_produtos_preparado = $conexaobd->prepare($sql_sel_produtos);
          $sql_sel_produtos_preparado->execute();

        ?>
        <div class="registros">
          <table width="80%">
            <thead>
              <tr>
                <th width="10%">Nome</th>
                <th width="10%">Categoria</th>
                <th width="10%">Imagem</th>
                <th width="5%">Altura</th>
                <th width="5%">Largura</th>
                <th width="5%">Profundidade</th>
                <th width="5%">№ de peças</th>
                <th width="30%">Descrição</th>
                <th width="5%">Alterar</th>
                <th width="5%">Excluir</th>
              </tr>
            </thead>
            <tbody>
              <?php
                //caso exista registros no banco, insere os dados na tabela
                if($sql_sel_produtos_preparado->rowCount()>0){
                  while($sql_sel_produtos_dados = $sql_sel_produtos_preparado->fetch()){
              ?>
              <!--Mostrando dados na tabela-->
              <tr>
                <td><?php echo $sql_sel_produtos_dados['nome'];?></td>
                <td><?php echo $sql_sel_produtos_dados['categoria'];?></td>
                <td><a target="_blank" href="<?php echo $sql_sel_produtos_dados['imagem'];?>">link</a></td>
                <td><?php echo number_format($sql_sel_produtos_dados['altura'], '2', ',', '.');?>cm</td>
                <td><?php echo number_format($sql_sel_produtos_dados['largura'], '2', ',', '.');?>cm</td>
                <td><?php echo number_format($sql_sel_produtos_dados['profundidade'], '2', ',', '.');?>cm</td>
                <td><?php echo $sql_sel_produtos_dados['n_pecas'];?></td>
                <td><?php
                      if($sql_sel_produtos_dados['descricao']==""){
                        echo "-";
                      }else{
                        echo $sql_sel_produtos_dados['descricao'];
                      }
                    ?></td>
                <td align="center"><a href="?pasta=produtos/&arquivo=va_fmalt_produtos&ext=php&id=<?php echo $sql_sel_produtos_dados['id'];?>" title="Editar registro"><img src="../visual/imagens/editar.png" width="25px" height="25px"/></td>
                <td align="center" onclick="return confirmar_exclusao('produto', '<?php echo addslashes($sql_sel_produtos_dados['nome']);?>')"><?php echo exclusaoSegura($sql_sel_produtos_dados['id'], '?pasta=produtos/&arquivo=va_del_produtos&ext=php'); ?></td>
              </tr>
              <?php
                  }
                }else{
              ?>
              <tr>
                <td align="center" colspan="9">Não há registros de Produtos.</td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
      </div><!--Fim conteúdo-->
