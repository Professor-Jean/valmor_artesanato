<?php
  $permissao_acesso = 1;
?>
<style>
.inputlongo{
  width: 100%;
}
</style>
<h1>Registro de Cliente</h1>
<form name="frminsclientes" method="POST" action="?pasta=clientes/&arquivo=va_ins_clientes&ext=php" onSubmit="return validarFormInsClientes()">
<table>
  <tr>
    <td>*Nome:</td>
    <td><input type="text" name="txtnome" maxlength="45" ></td>
    <td>CPF:</td>
    <td><input type="text" name="txtcpf" maxlength="12" ></td>
  </tr>
  <tr>
    <td>*E-mail:</td>
    <td><input type="text" name="txtemail" maxlength="60" ></td>
    <td>*Telefone:</td>
    <td><input type="text" name="txttelefone" maxlength="15" ></td>
  </tr>
  <tr>
    <td>Facebook:</td>
    <td colspan="3"><input type="text" name="txtfacebook" maxlength="80" class="inputlongo"></td>
  </tr>
  <tr>
    <td>Bairro:</td>
    <td><input type="text" name="txtbairro" maxlength="30" ></td>
    <td>Cidade:</td>
    <td><input type="text" name="txtcidade" maxlength="30"></td>
  </tr>
  <tr>
    <td>Logradouro:</td>
    <td colspan="3"><input type="text" name="txtlogradouro" maxlength="40" class="inputlongo" ></td>
  </tr>
  <tr>
    <td>Número:</td>
    <td><input type="text" name="txtnumero" maxlength="5" ></td>
    <td>Comp:</td>
    <td><input type="text" name="txtcomp" maxlength="20"></td>
  </tr>
  <tr>
    <td>CEP:</td>
    <td colspan="3"><input type="text" name="txtcep" maxlength="8" ></td>
  </tr>
  <tr>
    <td colspan="4">Obrigatórios*</td>
  </tr>
</table>
<div class="botoes">
  <button class="botao_limpar" type="reset" name="btnlimpar">Limpar</button>
  <button class="botao_registrar" type="submit" name="btnregistrar">Registrar</button>
</div>
</form>
<h1>Clientes Registrados</h1>
<?php

$sql_sel_clientes = "SELECT * FROM clientes" ;
$sql_sel_clientes_preparado = $conexaobd->prepare($sql_sel_clientes);
$sql_sel_clientes_preparado->execute();

?>
<div class="registros">
<table width="80%">
  <thead>
    <tr>
      <th width="20%">Nome</th>
      <th width="20%">E-mail</th>
      <th width="16%">Telefone</th>
      <th width="12%">Alterar</th>
      <th width="12%">Excluir</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if($sql_sel_clientes_preparado->rowCount()>0){
        while($sql_sel_clientes_dados = $sql_sel_clientes_preparado->fetch()){
    ?>
    <tr>
      <td><?php echo $sql_sel_clientes_dados['nome']; ?></td>
      <td><?php echo $sql_sel_clientes_dados['email']; ?></td>
      <td><?php echo $sql_sel_clientes_dados['telefone']; ?></td>
      <td align="center"><a href="?pasta=clientes/&arquivo=va_fmalt_clientes&ext=php&id=<?php echo $sql_sel_clientes_dados['id'];?>&enderecos_id=<?php echo $sql_sel_clientes_dados['enderecos_id'] ?>" title="Alterar registro"><img class="icone_tabela" src="../visual/imagens/editar.png"></a></td>
      <td align="center"><?php echo exclusaoSegura($sql_sel_clientes_dados['id'], '?pasta=clientes/&arquivo=va_del_clientes&ext=php', $sql_sel_clientes_dados['enderecos_id']) ?></td>
    </tr>
    <?php
        }
      }else{
    ?>
      <tr>
        <td align="center" colspan="5">Não há registros de clientes.</td>
      </tr>
    <?php
      }
    ?>
  </tbody>
</table>
</div>
