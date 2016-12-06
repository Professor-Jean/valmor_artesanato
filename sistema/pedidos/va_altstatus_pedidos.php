<?php
  $permissao_acesso = 1;
?>
<h1>Aviso de Alteração de Status do Pedido</h1>
<?php

// data prevista de entrega aparece apenas quando o orçamento for confirmado
  if(isset($_POST['txtdataprevista'])){
    $data_prevista = $_POST['txtdataprevista'];
    $data_prevista = implode("-", array_reverse(explode("/", $data_prevista)));
  }else{
    $data_prevista = 0;
  }
  if(isset($_POST['txtdataentrega'])){
    $data_entrega = $_POST['txtdataentrega'];
    $data_entrega = implode("-", array_reverse(explode("/", $data_entrega)));
  }else{
    $data_entrega = 0;
  }
  if(isset($_POST['txtimagem'])){
    $imagem = $_POST['txtimagem'];
  }else{
    $imagem = 0;
  }
  if(isset($_POST['txtimagem'])){
    $imagem = $_POST['txtimagem'];
  }else{
    $imagem = 0;
  }

//verificando se os dados vem da página de controle de pedidos ou controle de orçamentos
  if(!isset($_POST['hidorcamentoid'])){
    $g_orcamentos_id = $_GET['id'];
  }else{
    $g_orcamentos_id = $p_orcamentos_id = $_POST['hidorcamentoid'];
  }
  if(!isset($_POST['hidstatusid'])){
    $g_status = $_GET['status'];
  }else{
    $g_status = $p_status = $_POST['hidstatusid'];
  }

  $msg = "";
  $texto = "";
  $operacao = "Alteração";
  $icone_erro_confirmacao = "../visual/imagens/erro.png";
  $redirecionar_link = "?pasta=pedidos/&arquivo=va_ctrlpedido_pedidos&ext=php";
  $pdf_form = "";
  $form = "";
  $pdf_input = "";
  $nome_botao = "Retornar";
  if(!checar_vazio($g_orcamentos_id)){
      $caso = "validacao";
      $assunto = "orçamentos";
    }else if(!checar_vazio($g_status)){
        $caso = "validacao";
        $assunto = "status";
    }else if(!checar_vazio($data_entrega)){
          $caso = "validacao";
          $assunto = "data de entrega";
      }else if(!checar_vazio($data_prevista)){
            $caso = "validacao";
            $assunto = "data prevista";
            $redirecionar_link = "?pasta=pedidos/&arquivo=va_fmaltctrlorcamentos_pedidos&ext=php&id=".$g_orcamentos_id."&status=".$g_status;
        }else if(!checar_vazio($imagem)){
            $caso = "validacao";
            $assunto = "imagem";
            $redirecionar_link = "?pasta=pedidos/&arquivo=va_fmaltctrlorcamentos_pedidos&ext=php&id=".$g_orcamentos_id."&status=".$g_status;
          }else{

            if($g_status=="2"){
              $sql_sel_pedidos = "SELECT * FROM orcamentos WHERE id='".$p_orcamentos_id."' AND status='2'";
              $sql_sel_pedidos_preparado = $conexaobd->prepare($sql_sel_pedidos);
              $sql_sel_pedidos_preparado->execute();

              if($sql_sel_pedidos_preparado->rowCount()==0){

                  $tabela = "orcamentos";

                  $dados = array(
                    'status' => 2,
                    'data_prevista' => $data_prevista
                  );

                  $condicao = "id='".$p_orcamentos_id."'";

                  $sql_alt_orcamentos_resultado = alterar($tabela, $dados, $condicao);

                  if($sql_alt_orcamentos_resultado){

                    $tabela = "orcamentos_has_produtos";

                    $dados = array(
                      'imagem' => $imagem
                    );

                    $condicao = "orcamentos_id='".$p_orcamentos_id."'";

                    $sql_alt_orcamentos_resultado = alterar($tabela, $dados, $condicao);

                    $caso = "sucesso";
                    $assunto = "status";
                    $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
                    $redirecionar_link = "?pasta=pedidos/&arquivo=va_ctrlorcamento_pedidos&ext=php";
                    $pdf_form = "<form action='../complementos/php/va_gerarpdf_php.php' target='_blank' id='gerarpdf' method='POST' onsubmit='return catchContent()'>";
                    $pdf_input = "<input type='hidden' name='dadospdf' id='dadospdf' value=''/>";
                    $form = "</form>";
                    $nome_botao = "Gerar PDF";
                  }else{
                    $caso = "bancodedados";
                    $assunto = "status";
                    $redirecionar_link = "?pasta=pedidos/&arquivo=va_ctrlorcamento_pedidos&ext=php";
                  }
                }else{
                  $caso = "status";
                  $assunto = "confirmado";
                  $redirecionar_link = "?pasta=pedidos/&arquivo=va_ctrlorcamento_pedidos&ext=php";
                }
              }else if($g_status=="1"){

                $sql_sel_pedidos = "SELECT * FROM orcamentos WHERE id='".$g_orcamentos_id."' AND status='1'";
                $sql_sel_pedidos_preparado = $conexaobd->prepare($sql_sel_pedidos);
                $sql_sel_pedidos_preparado->execute();

                if($sql_sel_pedidos_preparado->rowCount()==0){

                  $tabela = "orcamentos";

                  $dados = array(
                    'status' => 1
                  );

                  $condicao = "id='".$g_orcamentos_id."'";

                  $sql_alt_orcamentos_resultado = alterar($tabela, $dados, $condicao);

                  if($sql_alt_orcamentos_resultado){
                    $caso = "sucesso";
                    $assunto = "status";
                    $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
                    $redirecionar_link = "?pasta=pedidos/&arquivo=va_ctrlorcamento_pedidos&ext=php";
                  }else{
                    $caso = "bancodedados";
                    $assunto = "status";
                    $redirecionar_link = "?pasta=pedidos/&arquivo=va_ctrlorcamento_pedidos&ext=php";
                  }
                }else{
                  $caso = "status";
                  $assunto = "cancelado";
                  $redirecionar_link = "?pasta=pedidos/&arquivo=va_ctrlorcamento_pedidos&ext=php";
                }
              }else if($g_status=="3"){

                $sql_sel_pedidos = "SELECT * FROM orcamentos WHERE id='".$g_orcamentos_id."' AND status='3'";
                $sql_sel_pedidos_preparado = $conexaobd->prepare($sql_sel_pedidos);
                $sql_sel_pedidos_preparado->execute();

                if($sql_sel_pedidos_preparado->rowCount()==0){

                  $tabela = "orcamentos";

                  $dados = array(
                    'status' => 3
                  );

                  $condicao = "id='".$g_orcamentos_id."'";

                  $sql_alt_orcamentos_resultado = alterar($tabela, $dados, $condicao);

                  if($sql_alt_orcamentos_resultado){
                    $caso = "sucesso";
                    $assunto = "status";
                    $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
                  }else{
                    $caso = "bancodedados";
                    $assunto = "status";
                  }
                }else{
                  $caso = "status";
                  $assunto = "concluído";
                }

                }else if($g_status=="4"){

                  $sql_sel_pedidos = "SELECT * FROM orcamentos WHERE id='".$g_orcamentos_id."' AND status='4'";
                  $sql_sel_pedidos_preparado = $conexaobd->prepare($sql_sel_pedidos);
                  $sql_sel_pedidos_preparado->execute();

                  if($sql_sel_pedidos_preparado->rowCount()==0){

                    $tabela = "orcamentos";

                    $dados = array(
                      'status' => 4,
                      'data_entrega' => $data_entrega
                    );

                    $condicao = "id='".$g_orcamentos_id."'";

                    $sql_alt_orcamentos_resultado = alterar($tabela, $dados, $condicao);

                    if($sql_alt_orcamentos_resultado){
                      $caso = "sucesso";
                      $assunto = "status";
                      $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
                    }else{
                      $caso = "bancodedados";
                      $assunto = "status";
                    }
                  }else{
                    $caso = "status";
                    $assunto = "entregue";
                  }

                }else if($g_status=="5"){

                    $sql_sel_pedidos = "SELECT * FROM orcamentos WHERE id='".$g_orcamentos_id."' AND status='5'";
                    $sql_sel_pedidos_preparado = $conexaobd->prepare($sql_sel_pedidos);
                    $sql_sel_pedidos_preparado->execute();

                    if($sql_sel_pedidos_preparado->rowCount()==0){

                      $tabela = "orcamentos";

                      $dados = array(
                        'status' => 5
                      );

                      $condicao = "id='".$g_orcamentos_id."'";

                      $sql_alt_orcamentos_resultado = alterar($tabela, $dados, $condicao);

                      if($sql_alt_orcamentos_resultado){
                        $caso = "sucesso";
                        $assunto = "status";
                        $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
                      }else{
                        $caso = "bancodedados";
                        $assunto = "status";
                      }
                    }else{
                      $caso = "status";
                      $assunto = "cancelado";
                    }
                }
      }

?>
<div class="aviso">
  <p>
    <img src="<?php echo $icone_erro_confirmacao; ?>"/>
    <?php
        if($msg!=""){
          echo $msg;
        }else{
          echo reposicaoMensagem($caso, $assunto, $operacao);
        }
    ?>
  </p>
  <?php
    echo $pdf_form; //aparecerá caso seja confirmado o orçamento aparecendo o form de PDF
    echo $pdf_input; // input para gerar PDF
  ?>
  <a href="<?php echo $redirecionar_link; ?>"><button class="botao_retornar" name="btnretornar" type="submit"><?php echo $nome_botao; ?></button></a>
  <?php
    echo $form;
    if($g_status=="2"&&$caso=="sucesso"){
      ?>
      <a href="<?php echo $redirecionar_link; ?>"><button class="botao_retornar" name="btnretornar" type="submit">Retornar</button></a>
      <?php
    }
  ?>
</div>
<?php
  $sql_sel_pedidos = "SELECT clientes.nome AS cliente_nome, produtos.nome AS produto_nome,
  clientes.telefone, orcamentos_has_produtos.produtos_id, orcamentos_has_produtos.quantidade, orcamentos.id,
  orcamentos.status, orcamentos.data_orcamento, orcamentos.data_prevista, orcamentos_has_produtos.preco AS orcamentos_has_produtos_preco,
  produtos.preco AS produtos_preco FROM orcamentos_has_produtos
  INNER JOIN produtos ON orcamentos_has_produtos.produtos_id = produtos.id
  INNER JOIN orcamentos ON orcamentos_has_produtos.orcamentos_id = orcamentos.id
  INNER JOIN clientes ON orcamentos.clientes_id = clientes.id
  WHERE (orcamentos.id='".$g_orcamentos_id."') AND (orcamentos.status='2' OR orcamentos.status='3')";
  $sql_sel_pedidos_preparado = $conexaobd->prepare($sql_sel_pedidos);
  $sql_sel_pedidos_preparado->execute();
  $sql_sel_pedidos_dados = $sql_sel_pedidos_preparado->fetch();
?>
<style>
  span{
    display: none;
  }
</style>
<span class="imprimir">
  <h1>Orçamento do(a) <?php echo $sql_sel_pedidos_dados['cliente_nome'] ?></h1>
  <div class="registros">
    <table width="60%">
      <thead>
        <tr>
          <th width="12%">Data do Orçamento</th>
          <th width="12%">Data Prevista</th>
          <th width="12%">Pedido</th>
          <th width="12%">Valor Total</th>
          <th width="12%">Telefone</th>
        </tr>
      </thead>
      <tbody>
        <?php
          //caso tenha valor definido faça
          if($sql_sel_pedidos_preparado->rowCount()>0){

            if($sql_sel_pedidos_dados['orcamentos_has_produtos_preco']==""){
              $preco = $sql_sel_pedidos_dados['produtos_preco'] * $sql_sel_pedidos_dados['quantidade'];
            }else{
              $preco = $sql_sel_pedidos_dados['orcamentos_has_produtos_preco'] * $sql_sel_pedidos_dados['quantidade'];
            }

            $data_orcamentos = explode("-", $sql_sel_pedidos_dados['data_orcamento']);
            $data_prevista = explode("-", $sql_sel_pedidos_dados['data_prevista']);
        ?>
        <tr>
          <td><?php echo $data_orcamentos[2]."/".$data_orcamentos[1]."/".$data_orcamentos[0];?></td>
          <td><?php echo $data_prevista[2]."/".$data_prevista[1]."/".$data_prevista[0];?></td>
          <td><?php echo $sql_sel_pedidos_dados['quantidade'];?>x <?php echo $sql_sel_pedidos_dados['produto_nome'];?></td>
          <td>R$<?php echo number_format($preco,'2',',','.');?></td>
          <td><?php echo $sql_sel_pedidos_dados['telefone'];?></td>
        </tr>
        <?php
          }else{
        ?>
        <tr>
          <td align="center" colspan="5">Não há registros de pedidos.</td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</span>
