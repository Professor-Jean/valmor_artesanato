<?php
  $permissao_acesso = 1;

  $g_id = $_GET['id'];
  $g_enderecos_id = $_GET['enderecos_id'];

  $sql_sel_clientes = "SELECT clientes.*, enderecos.* FROM clientes
  INNER JOIN enderecos ON clientes.enderecos_id = enderecos.id
  WHERE clientes.id = '".$g_id."' AND clientes.enderecos_id = '".$g_enderecos_id."' ";
  $sql_sel_clientes_preparado = $conexaobd->prepare($sql_sel_clientes);
  $sql_sel_clientes_preparado->execute();

  $sql_sel_clientes_dados = $sql_sel_clientes_preparado->fetch();

?>
<style>
.inputlongo{
  width: 100%;
}
</style>
<h1>Alterar Registro de Cliente</h1>
<form name="frmaltclientes" method="POST" action="?pasta=clientes/&arquivo=va_alt_clientes&ext=php" onsubmit="return validarFormAltClientes()">
  <input type="hidden" name="hidclienteid" value="<?php echo $g_id;?>">
  <input type="hidden" name="hidenderecoid" value="<?php echo $sql_sel_clientes_dados['enderecos_id'];?>">
  <table>
    <tr>
      <td>*Nome:</td>
      <td><input type="text" name="txtnome" maxlength="45" value="<?php echo $sql_sel_clientes_dados['nome'];?>"></td>
      <td>CPF:</td>
      <td><input type="text" name="txtcpf" maxlength="12" value="<?php echo $sql_sel_clientes_dados['cpf'];?>"></td>
    </tr>
    <tr>
      <td>*E-mail:</td>
      <td><input type="text" name="txtemail" maxlength="60" value="<?php echo $sql_sel_clientes_dados['email'];?>"></td>
      <td>*Telefone:</td>
      <td><input type="text" name="txttelefone" maxlength="15" value="<?php echo $sql_sel_clientes_dados['telefone'];?>"></td>
    </tr>
    <tr>
      <td>Facebook:</td>
      <td colspan="3"><input type="text" name="txtfacebook" maxlength="80" class="inputlongo" value="<?php echo $sql_sel_clientes_dados['link_facebook'];?>"></td>
    </tr>
    <tr>
      <td>Bairro:</td>
      <td><input type="text" name="txtbairro" maxlength="30" value="<?php echo $sql_sel_clientes_dados['bairro'];?>"></td>
      <td>Cidade:</td>
      <td><input type="text" name="txtcidade" maxlength="30" value="<?php echo $sql_sel_clientes_dados['cidade'];?>"></td>
    </tr>
    <tr>
      <td>Logradouro:</td>
      <td colspan="3"><input type="text" name="txtlogradouro" maxlength="40" class="inputlongo" value="<?php echo $sql_sel_clientes_dados['logradouro'];?>"></td>
    </tr>
    <tr>
      <td>Número:</td>
      <td><input type="text" name="txtnumero" maxlength="5" value="<?php echo $sql_sel_clientes_dados['numero'];?>"></td>
      <td>Comp:</td>
      <td><input type="text" name="txtcomp" maxlength="20" value="<?php echo $sql_sel_clientes_dados['complemento'];?>"></td>
    </tr>
    <tr>
      <td>CEP:</td>
      <td colspan="3"><input type="text" name="txtcep" maxlength="8" value="<?php echo $sql_sel_clientes_dados['cep'];?>"></td>
    </tr>
    <tr>
      <td colspan="4">Obrigatórios*</td>
    </tr>
  </table>
  <div class="botoes">
    <button class="botao_limpar" type="button" name="btnlimpar">Limpar</button>
    <button class="botao_registrar" type="submit" name="btnregistrar">Registrar</button>
  </div>
</form>
