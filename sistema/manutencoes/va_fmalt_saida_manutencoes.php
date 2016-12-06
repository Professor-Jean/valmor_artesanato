<?php $permissao_acesso="0"; ?>
<div class="conteudo"><!--Inicio conteúdo-->
  <h1>Alteração de Manutenção</h1>
  <?php
    $g_id = $_GET['id'];

    $sql_sel_movimentacoes = "SELECT movimentacoes.*, maquinas.marca, maquinas.modelo FROM movimentacoes
    INNER JOIN maquinas ON movimentacoes.maquinas_id=maquinas.id WHERE movimentacoes.maquinas_id='".$g_id."' AND status=1";
    $sql_sel_movimentacoes_preparado = $conexaobd->prepare($sql_sel_movimentacoes);
    $sql_sel_movimentacoes_preparado->execute();

    $sql_sel_movimentacoes_dados = $sql_sel_movimentacoes_preparado->fetch();
  ?>
  <form name="frmaltsaidamanutencoes" method="POST" action="?pasta=manutencoes/&arquivo=va_alt_saida_manutencoes&ext=php" onsubmit="return validarFormAltSaidaManutencao()">
  <input type="hidden" name="hidmaquinasid" value="<?php echo $g_id;?>">
  <table>
    <tr>
      <td>*Marca:</td>
      <td><input type="text" name="txtmarca" value="<?php echo $sql_sel_movimentacoes_dados['marca'];?>" readonly></td>
    </tr>
    <tr>
      <td>*Modelo:</td>
      <td><input type="text" name="txtmodelo" value="<?php echo $sql_sel_movimentacoes_dados['modelo'];?>" readonly></td>
    </tr>
    <tr>
      <td>*Data de saída:</td>
      <td><input type="text" name="txtdatasaida" class="datepicker" value="<?php echo implode("/", array_reverse(explode("-", $sql_sel_movimentacoes_dados['data_saida']))); ?>" readonly></td>
    </tr>
    <tr>
      <td>*Data prevista de retorno:</td>
      <td><input type="text" name="txtdataprevistaretorno" class="datepicker" value="<?php echo implode("/", array_reverse(explode("-", $sql_sel_movimentacoes_dados['data_prevista']))); ?>" readonly></td>
    </tr>
    <tr>
      <td>*Valor:</td>
      <td><input type="text" name="txtvalor" value="<?php echo number_format($sql_sel_movimentacoes_dados['preco'], '2', ',', '.')?>" maxlength="9"></td>
    </tr>
    <tr>
      <td>Descrição:</td>
      <td><textarea name="txadescricao" maxlength="100"><?php echo $sql_sel_movimentacoes_dados['descricao'];?></textarea></td>
    </tr>
    <tr>
      <td colspan="2">Obrigatórios*</td>
    </tr>
  </table>
    <div class="botoes">
      <button class="botao_limpar" type="button" name="btnlimpar">Limpar</button>
      <button class="botao_registrar" type="submit" name="btnregistrar">Registrar</button>
    </div>
  </form>
</div><!--Fim conteúdo-->
