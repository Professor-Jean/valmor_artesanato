<?php $permissao_acesso = 0; ?>
<h1>Aviso de Cadastro de Retorno da Manutenção</h1>
<?php

  $p_maquinas_id = $_POST['hidmaquinasid'];
  $p_marca = $_POST['txtmarca'];
  $p_modelo = $_POST['txtmodelo'];
  $p_dataretorno = $_POST['txtdataretorno'];
  $p_valor = str_replace(',','.',$_POST['txtvalor']);
  $p_descricao = $_POST['txadescricao'];

  $sql_sel_movimentacoes = "SELECT * FROM movimentacoes WHERE maquinas_id='".$p_maquinas_id."' AND status='1'";
  $sql_sel_movimentacoes_preparado = $conexaobd->prepare($sql_sel_movimentacoes);
  $sql_sel_movimentacoes_preparado->execute();
  $sql_sel_movimentacoes_dados = $sql_sel_movimentacoes_preparado->fetch();


  $texto = "";
  $operacao = "Cadastro";
  $icone_erro_confirmacao = "../visual/imagens/erro.png";
  $redirecionar_link = "?pasta=manutencoes/&arquivo=va_fmins_retorno_manutencoes&ext=php&id=".$p_maquinas_id;

  if(!checar_vazio($p_marca)){
      $caso = "validacao";
      $assunto = "marca";
    }else if(!checar_vazio($p_modelo)){
        $caso = "validacao";
        $assunto = "modelo";
      }else if(!checar_vazio($p_dataretorno)){
          $caso = "validacao";
          $assunto = "data de retorno";
        }else if(!checar_vazio($p_valor)){
            $caso = "validacao";
            $assunto = "valor";
          }else if(!checar_data($p_dataretorno)){
                $caso = "validacao";
                $assunto = "data de retorno";
              }else{

              $dataretorno = implode("", array_reverse(explode("/", $p_dataretorno)));
              $datasaida = implode("", explode("-", $sql_sel_movimentacoes_dados['data_saida']));

              if($dataretorno<$datasaida){
                $caso = "data";
                $assunto = "de retorno";
              }else{


              $sql_sel_movimentacoes = "SELECT * FROM movimentacoes WHERE maquinas_id='".$p_maquinas_id."' AND status='1'";
              $sql_sel_movimentacoes_preparado = $conexaobd->prepare($sql_sel_movimentacoes);
              $sql_sel_movimentacoes_preparado->execute();

              if($sql_sel_movimentacoes_preparado->rowCount()==1){

                $tabela = "movimentacoes";

                $dados = array(
                  'status'         => '0',
                  'data_retorno'   => $dataretorno,
                  'preco'          => $p_valor,
                  'descricao'      => $p_descricao
                );

                $condicao = "maquinas_id='".$p_maquinas_id."'";

                $sql_alt_saida_manutencoes_resultado = alterar($tabela, $dados, $condicao);

                if($sql_alt_saida_manutencoes_resultado){
                  $caso = "sucesso";
                  $assunto = "retorno da manutenção";
                  $operacao = "Cadastro";
                  $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
                  $redirecionar_link = "?pasta=consultas/&arquivo=va_vismaquinas_consultas&ext=php";
                }else{
                  $caso = "bancodedados";
                  $assunto = "retorno da manutenção";
                  $operacao = "cadastro";
                }
              }else{
                $caso = "existencia";
                $assunto = "retorno da manutenção";
              }
            }
  }
?>
<div class="aviso">
  <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
  <a href="<?php echo $redirecionar_link ?>"><button class="botao_retornar" name="btnretornar" type="button">Retornar</button></a>
</div>
