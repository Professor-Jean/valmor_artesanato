<?php
  $permissao_acesso = 0;
?>
<style>
.inputlongo{
  width: 100%;
}
</style>
<?php
  if(isset($_GET['id'])){
?>
<h1>Movimentação de Saída Para Manutenção</h1>
<?php
    $g_id = $_GET['id'];

    $sql_sel_maquinas = "SELECT id, modelo, marca FROM maquinas WHERE id='".$g_id."' ";
    $sql_sel_maquinas_preparado = $conexaobd->prepare($sql_sel_maquinas);
    $sql_sel_maquinas_preparado->execute();

    $sql_sel_maquinas_dados = $sql_sel_maquinas_preparado->fetch();
?>
<form name="frminssaidamanutencoes" method="POST" action="?pasta=manutencoes/&arquivo=va_ins_saida_manutencoes&ext=php" onSubmit="return validarFormInsSaidaManutencao()">
<input type="hidden" name="hidmaquinasid" value="<?php echo $g_id;?>">
<table>
  <tr>
    <td>*Marca:</td>
    <td><input type="text" name="txtmarca" value="<?php echo $sql_sel_maquinas_dados['marca'];?>" readonly></td>
  </tr>
  <tr>
    <td>*Modelo:</td>
    <td><input type="text" name="txtmodelo" value="<?php echo $sql_sel_maquinas_dados['modelo'];?>" readonly></td>
  </tr>
  <tr>
    <td>*Data de saída:</td>
    <td><input type="text" name="txtdatasaida" class="datepicker" readonly></td>
  </tr>
  <tr>
    <td>*Data prevista de retorno:</td>
    <td><input type="text" name="txtdataprevistaretorno" class="datepicker" readonly></td>
  </tr>
  <tr>
    <td>*Valor:</td>
    <td><input type="text" name="txtvalor" maxlength="9"></td>
  </tr>
  <tr>
    <td>Descrição:</td>
    <td><textarea name="txadescricao" maxlength="100"></textarea></td>
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
<?php
  }
 ?>
<h1>Manutenções Registradas</h1>
<?php
  $sql_sel_movimentacoes = "SELECT movimentacoes.*, maquinas.marca, maquinas.modelo FROM movimentacoes
  INNER JOIN maquinas ON movimentacoes.maquinas_id=maquinas.id WHERE status='1'";
  $sql_sel_movimentacoes_preparado = $conexaobd->prepare($sql_sel_movimentacoes);
  $sql_sel_movimentacoes_preparado->execute();
?>
<div class="registros">
<table width="80%">
  <thead>
    <tr>
      <th width="20%">Marca</th>
      <th width="15%">Modelo</th>
      <th width="12.5%">Data de saída</th>
      <th width="12.5%">Data prevista de retorno</th>
      <th width="10%">Valor</th>
      <th width="20%">Descrição</th>
      <th width="10%">Alterar</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if($sql_sel_movimentacoes_preparado->rowCount()>0){
        while($sql_sel_movimentacoes_dados = $sql_sel_movimentacoes_preparado->fetch()){
    ?>
    <tr>
      <td><?php echo $sql_sel_movimentacoes_dados['marca']; ?></td>
      <td><?php echo $sql_sel_movimentacoes_dados['modelo']; ?></td>
      <td><?php echo implode("/", array_reverse(explode("-", $sql_sel_movimentacoes_dados['data_saida']))); ?></td>
      <td><?php echo implode("/", array_reverse(explode("-", $sql_sel_movimentacoes_dados['data_prevista']))); ?></td>
      <td>R$<?php echo number_format($sql_sel_movimentacoes_dados['preco'], '2', ',', '.'); ?></td>
      <td>
        <?php
        if($sql_sel_movimentacoes_dados['descricao']==""){
          echo "-";
        }else{
          echo $sql_sel_movimentacoes_dados['descricao'];
        }
        ?>
      </td>
      <td align="center"><a href="?pasta=manutencoes/&arquivo=va_fmalt_saida_manutencoes&ext=php&id=<?php echo $sql_sel_movimentacoes_dados['maquinas_id']; ?>" title="Alterar registro"><img class="icone_tabela" src="../visual/imagens/editar.png"></a></td>
    </tr>
    <?php
        }
      }else{
    ?>
      <tr>
        <td align="center" colspan="7">Não há registros de saída de manutenções</td>
      </tr>
    <?php
      }
    ?>
    </tbody>
  </table>
</div>
