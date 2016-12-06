<?php
  $permissao_acesso = 0;

  $g_id = $_GET['id'];
  $g_usuario_id = $_GET['usuario_id'];
  $g_enderecos_id = $_GET['enderecos_id'];

  echo $sql_sel_funcionarios = "SELECT funcionarios.*, usuarios.*, enderecos.* FROM funcionarios
  INNER JOIN usuarios ON funcionarios.usuario_id=usuarios.id
  INNER JOIN enderecos ON funcionarios.enderecos_id=enderecos.id
  WHERE funcionarios.id='".$g_id."' AND funcionarios.usuario_id='".$g_usuario_id."' AND enderecos.id='".$g_enderecos_id."'";
  $sql_sel_funcionarios_preparado = $conexaobd->prepare($sql_sel_funcionarios);
  $sql_sel_funcionarios_preparado->execute();

  $sql_sel_funcionarios_dados = $sql_sel_funcionarios_preparado->fetch();
?>
<style>
.inputlogradouro{
  width: 100%;
}
</style>
<h1>Alteração de Registro de Funcionário</h1>
<form name="frmaltfuncionarios" method="POST" action="?pasta=funcionarios/&arquivo=va_alt_funcionarios&ext=php" onSubmit="return validarFormAltFuncionarios()">
<input type="hidden" name="hidfuncionariosid" value="<?php echo $g_id;?>">
<input type="hidden" name="hidusuarioid" value="<?php echo $sql_sel_funcionarios_dados['usuario_id'];?>">
<input type="hidden" name="hidenderecosid" value="<?php echo $sql_sel_funcionarios_dados['enderecos_id'];?>">
<table>
  <tr>
    <td>*Nome:</td>
    <td><input type="text" name="txtnome" maxlength="45" value="<?php echo $sql_sel_funcionarios_dados['nome']; ?>"></td>
    <td>*Cargo:</td>
    <td><input type="text" name="txtcargo" maxlength="30" value="<?php echo $sql_sel_funcionarios_dados['cargo']; ?>"></td>
  </tr>
  <tr>
    <td>*Telefone:</td>
    <td><input type="text" name="txttelefone" maxlength="15" value="<?php echo $sql_sel_funcionarios_dados['telefone']; ?>"></td>
    <td>Permissão:</td>
    <td>
      <select name="selpermissao">
        <option value="">Selecione uma Permissão</option>
        <?php
          if($sql_sel_funcionarios_dados['permissao']=="0"){
            echo "<option value='0' selected>Administrador</option>";
          }else{
            echo "<option value='0'>Administrador</option>";
          }

          if($sql_sel_funcionarios_dados['permissao']=="1"){
            echo "<option value='1' selected>Vendedor</option>";
          }else{
            echo "<option value='1'>Vendedor</option>";
          }

        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td>Usuário:</td>
    <td><input type="text" name="txtusuario" maxlength="20" value="<?php echo $sql_sel_funcionarios_dados['usuario']; ?>"></td>
    <td>Senha:</td>
    <td><input type="password" name="pwdsenha" maxlength="20" ></td>
  </tr>
  <tr>
    <td>Cidade:</td>
    <td><input type="text" name="txtcidade" maxlength="30" value="<?php echo $sql_sel_funcionarios_dados['cidade']; ?>"></td>
    <td>Bairro:</td>
    <td colspan=""><input type="text" name="txtbairro" maxlength="30" value="<?php echo $sql_sel_funcionarios_dados['bairro']; ?>"></td>
  </tr>
  <tr>
    <td>Logradouro:</td>
    <td colspan="3"><input type="text" name="txtlogradouro" maxlength="40" class="inputlogradouro" value="<?php echo $sql_sel_funcionarios_dados['logradouro']; ?>"></td>
  </tr>
  <tr>
    <td>Número:</td>
    <td><input type="text" name="txtnumero" maxlength="5" value="<?php echo $sql_sel_funcionarios_dados['numero']; ?>"></td>
    <td>Comp:</td>
    <td><input type="text" name="txtcomp" maxlength="20" value="<?php echo $sql_sel_funcionarios_dados['complemento']; ?>"></td>
  </tr>
  <tr>
    <td>CEP:</td>
    <td colspan="3"><input type="text" name="txtcep" maxlength="8" value="<?php echo $sql_sel_funcionarios_dados['cep']; ?>"></td>
  </tr>
  <tr>
    <td colspan="4">Obrigtórios*</td>
  </tr>
</table>
<div class="botoes">
  <button class="botao_limpar" type="button" name="btnlimpar">Limpar</button>
  <button class="botao_registrar" type="submit" name="btnregistrar">Registrar</button>
</div>
</form>
