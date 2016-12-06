<?php
  $permissao_acesso = 0;

  $g_id = $_GET['id'];

  $sql_sel_maquinas = "SELECT * FROM maquinas WHERE id='".$g_id."'";
  $sql_sel_maquinas_preparado = $conexaobd->prepare($sql_sel_maquinas);
  $sql_sel_maquinas_preparado->execute();
  $sql_sel_maquinas_dados = $sql_sel_maquinas_preparado->fetch();

?>
<style>
.inputlogradouro{
  width: 100%;
}
</style>
<h1>Alterar Registro de Máquina</h1>
<form name="frmaltmaquinas" method="POST" action="?pasta=maquinas/&arquivo=va_alt_maquinas&ext=php" onsubmit="return validarFormAltMaquinas()">
<input type="hidden" name="hidmaquinasid" value="<?php echo $g_id;?>">
<table>
  <tr>
    <td>*Marca:</td>
    <td><input type="text" name="txtmarca" maxlength="25" value="<?php echo $sql_sel_maquinas_dados['marca'];?>"></td>
  </tr>
  <tr>
    <td>*Modelo:</td>
    <td><input type="text" name="txtmodelo" maxlength="45"value="<?php echo $sql_sel_maquinas_dados['modelo'];?>"></td>
  </tr>
  <tr>
    <td>Data de Aquisição:</td>
    <?php
      if($sql_sel_maquinas_dados['data_aquisicao']!=""){
        $data = explode("-", $sql_sel_maquinas_dados['data_aquisicao']);
    ?>
        <td><input type="text" class="datepicker" name="txtdataaquisicao" maxlength="10" placeholder="DD/MM/AAAA" value="<?php echo $data[2]."/".$data[1]."/".$data[0];?>" readonly></td>
    <?php
      }else{
    ?>
        <td><input type="text" class="datepicker" name="txtdataaquisicao" maxlength="10" placeholder="DD/MM/AAAA" value="" readonly></td>
    <?php
      }
    ?>
  </tr>
  <tr>
    <td>Descrição:</td>
    <td><textarea name="txadescricao" maxlength="255" value="<?php echo $sql_sel_maquinas_dados['descricao'];?>"></textarea></td>
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
