<?php $permissao_acesso = 0; ?>
<h1>Aviso de Cadastro de Saída para Manutenção</h1>
<?php
  $p_maquinas_id = $_POST['hidmaquinasid'];
  $p_marca = $_POST['txtmarca'];
  $p_modelo = $_POST['txtmodelo'];
  $p_datasaida = $_POST['txtdatasaida'];
  $p_dataprevistaretorno = $_POST['txtdataprevistaretorno'];
  $p_valor = str_replace(',', '.', $_POST['txtvalor']);
  $p_descricao = $_POST['txadescricao'];

  $redirecionar_link = "?pasta=manutencoes/&arquivo=va_fmins_saida_manutencoes&ext=php&id=".$p_maquinas_id;
  $operacao = "Cadastro";
  $icone_erro_confirmacao = "../visual/imagens/erro.png";

  $p_datasaida = implode("-", array_reverse(explode("/", $p_datasaida)));
  $p_dataprevistaretorno = implode("-", array_reverse(explode("/", $p_dataprevistaretorno)));

  if(!checar_vazio($p_datasaida)){
      $caso = "validacao";
      $assunto = "data de saída";
    }else if(!checar_vazio($p_dataprevistaretorno)){
        $caso = "validacao";
        $assunto = "data prevista de retorno";
      }else if(!checar_vazio($p_valor)){
          $caso = "validacao";
          $assunto = "valor";
        }else{

          $p_dataprevistaretorno = implode("", explode("-", $p_dataprevistaretorno));
          $datasaida = implode("", explode("-", $p_datasaida));

          if($p_dataprevistaretorno<$datasaida){
            $caso = "data";
            $assunto = "prevista de retorno";
          }else{

          $sql_sel_movimentacoes = "SELECT * FROM movimentacoes WHERE maquinas_id='".$p_maquinas_id."' AND status='1'";
          $sql_sel_movimentacoes_preparado = $conexaobd->prepare($sql_sel_movimentacoes);
          $sql_sel_movimentacoes_preparado->execute();


          if($sql_sel_movimentacoes_preparado->rowCount()==0){

            $tabela = "movimentacoes";

            $dados = array(
              'maquinas_id'    => $p_maquinas_id,
              'status'         => '1',
              'data_saida'     => $p_datasaida,
              'data_prevista'  => $p_dataprevistaretorno,
              'data_retorno'   => $p_dataprevistaretorno,
              'preco'          => $p_valor,
              'descricao'      => $p_descricao
            );

            $sql_ins_movimentacoes_resultado = adicionar($tabela, $dados);

            if($sql_ins_movimentacoes_resultado){
              $caso = "sucesso";
              $assunto = "saída para manutenção";
              $operacao = "Cadastro";
              $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
              $redirecionar_link = "?pasta=manutencoes/&arquivo=va_fmins_saida_manutencoes&ext=php";
            }else{
              $caso = "bancodedados";
              $assunto = "saída para manutenção";
              $operacao = "cadastro";
            }
          }else{
            $caso = "existencia";
            $assunto = "saída para manutenção";
          }
        }
  }
?>
<div class="aviso">
  <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
  <a href="<?php echo $redirecionar_link; ?>"><button class="botao_retornar" name="btnretornar" type="button">Retornar</button></a>
</div>
