<?php
  $permissao_acesso = 0;
?>
<style>
.inputlogradouro{
  width: 100%;
}
</style>
<h1>Registro de Máquina</h1>
<form name="frminsmaquinas" method="POST" action="?pasta=maquinas/&arquivo=va_ins_maquinas&ext=php" onsubmit="return validarFormInsMaquinas()">
<table>
  <tr>
    <td>*Marca:</td>
    <td><input type="text" name="txtmarca" maxlength="25"></td>
  </tr>
  <tr>
    <td>*Modelo:</td>
    <td><input type="text" name="txtmodelo" maxlength="45"></td>
  </tr>
  <tr>
    <td>Data de Aquisição:</td>
    <td><input type="text" class="datepicker" name="txtdataaquisicao" maxlength="10" readonly></td>
  </tr>
  <tr>
    <td>Descrição:</td>
    <td><textarea name="txadescricao" maxlength="255"></textarea></td>
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
<h1>Máquinas Registradas</h1>
<?php

$sql_sel_maquinas = "SELECT * FROM maquinas ORDER BY marca ASC";
$sql_sel_maquinas_preparado = $conexaobd->prepare($sql_sel_maquinas);
$sql_sel_maquinas_preparado->execute();

?>
<div class="registros">
<table width="80%">
  <thead>
    <tr>
      <th width="13%">Marca</th>
      <th width="13%">Modelo</th>
      <th width="13%">Data de Aquisição</th>
      <th width="14%">Descrição</th>
      <th width="12%">Alterar</th>
      <th width="12%">Excluir</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if($sql_sel_maquinas_preparado->rowCount()>0){
        while($sql_sel_maquinas_dados = $sql_sel_maquinas_preparado->fetch()){
    ?>
    <tr>
      <td><?php echo $sql_sel_maquinas_dados['marca']; ?></td>
      <td><?php echo $sql_sel_maquinas_dados['modelo']; ?></td>
      <?php
        if($sql_sel_maquinas_dados['data_aquisicao']==""){
          echo "<td> - </td>";
        }else{
          $data = explode("-", $sql_sel_maquinas_dados['data_aquisicao']);
          echo "<td>".$data[2]."/".$data[1]."/".$data[0]."</td>";
        }

        if($sql_sel_maquinas_dados['descricao']==""){
          echo "<td> - </td>";
        }else{
          echo "<td>".$sql_sel_maquinas_dados['descricao']."</td>";
        }

      ?>
      <td align="center"><a href="?pasta=maquinas/&arquivo=va_fmalt_maquinas&ext=php&id=<?php echo $sql_sel_maquinas_dados['id']; ?>" title="Alterar registro"><img class="icone_tabela" src="../visual/imagens/editar.png"></a></td>
      <td align="center" onclick="return confirmar_exclusao('máquina', '<?php echo addslashes($sql_sel_maquinas_dados['marca'])." ".addslashes($sql_sel_maquinas_dados['modelo']);?>')"><?php echo exclusaoSegura($sql_sel_maquinas_dados['id'], '?pasta=maquinas/&arquivo=va_del_maquinas&ext=php');?></td>
    </tr>
    <?php
        }
      }else{
    ?>
      <tr>
        <td align="center" colspan="6">Não há registros de máquinas</td>
      </tr>
    <?php
      }
    ?>
  </tbody>
</table>
</div>
