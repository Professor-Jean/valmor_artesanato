<?php $permissao_acesso="1"; ?>
<span class="imprimir"><h1>Relatório de Pedidos</h1></span>
  <div class="form_pdf">
    <form action='../complementos/php/va_gerarpdf_php.php' target="_blank" id='gerarpdf' method='POST' onsubmit='return catchContent()'>
      <input type='hidden' name='dadospdf' id='dadospdf' value=''/>
      <button type="submit" name="btnpdf">Gerar PDF</button>
    </form>
  </div>
  <div class="registros">
  <span class="imprimir">
  <table width="80%">
    <thead>
      <tr>
        <th width="18%">Nome do cliente</th>
        <th width="12%">Entrega Prevista</th>
        <th width="12%">Valor Total</th>
        <th width="18%">Produto</th>
        <th width="16%">Setor</th>
      </tr>
    </thead>
    <tbody>
      <?php

        $sql_sel_orcamentos_has_produtos= "SELECT clientes.nome AS nome_pessoa, produtos.nome AS nome_produto, produtos.*, orcamentos.data_prevista,  orcamentos_has_produtos.altura AS orcamento_altura, orcamentos_has_produtos.preco AS orcamento_preco, orcamentos_has_produtos.quantidade, orcamentos.status, orcamentos_has_produtos.setor FROM orcamentos_has_produtos
        INNER JOIN orcamentos ON orcamentos_has_produtos.orcamentos_id=orcamentos.id
        INNER JOIN clientes ON orcamentos.clientes_id=clientes.id
        INNER JOIN produtos ON orcamentos_has_produtos.produtos_id=produtos.id
        WHERE orcamentos.status>'1' AND orcamentos.status<'5'
        ORDER BY data_entrega  ASC";
        $sql_sel_orcamentos_has_produtos_preparado = $conexaobd->prepare($sql_sel_orcamentos_has_produtos);
        $sql_sel_orcamentos_has_produtos_preparado->execute();

        if($sql_sel_orcamentos_has_produtos_preparado->rowCount()>0){
          while($sql_sel_orcamentos_has_produtos_dados = $sql_sel_orcamentos_has_produtos_preparado->fetch()){

            if($sql_sel_orcamentos_has_produtos_dados['orcamento_altura']==""){
              $preco = $sql_sel_orcamentos_has_produtos_dados['preco'];
            }else{
              $preco = $sql_sel_orcamentos_has_produtos_dados['orcamento_preco'];
            }

            if($sql_sel_orcamentos_has_produtos_dados['setor']=="0"){
                $setor = "Marcenaria";
              }else if($sql_sel_orcamentos_has_produtos_dados['setor']=="1"){
                  $setor = "Laser";
                }else if($sql_sel_orcamentos_has_produtos_dados['setor']=="2"){
                  $setor = "Marcenaria e Laser";
                }


      ?>
      <tr>
        <td><?php echo $sql_sel_orcamentos_has_produtos_dados['nome_pessoa']; ?></td>
        <td>
          <?php
            echo implode("/", array_reverse(explode("-", $sql_sel_orcamentos_has_produtos_dados['data_prevista'])));
          ?>
        </td>
        <td>R$<?php echo number_format($preco,"2",",","."); ?></td>
        <td><?php echo $sql_sel_orcamentos_has_produtos_dados['nome_produto']; ?></td>
        <td><?php echo $setor; ?></td>
      <?php
          }
        }else{
      ?>
      <tr>
        <td align="center" colspan="5">Não há registro de pedidos para essa página</td>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</span>
</div>
