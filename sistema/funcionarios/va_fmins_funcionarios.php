<?php
  $permissao_acesso = 0;
?>
<style>
.inputlogradouro{
  width: 100%;
}
</style>
<h1>Registro de Funcionários</h1>
<form name="frminsfuncionarios" method="POST" action="?pasta=funcionarios/&arquivo=va_ins_funcionarios&ext=php" onSubmit="return validarFormAltFuncionarios()">
<table>
  <tr>
    <td>*Nome:</td>
    <td><input type="text" name="txtnome" maxlength="45"></td>
    <td>*Cargo:</td>
    <td><input type="text" name="txtcargo" maxlength="30"></td>
  </tr>
  <tr>
    <td>*Telefone:</td>
    <td><input type="text" name="txttelefone" maxlength="15"></td>
    <td>Permissão:</td>
    <td>
      <select name="selpermissao">
        <option value="">Selecione uma Permissão</option>
        <option value="0">Administrador</option>
        <option value="1">Vendedor</option>
      </select>
    </td>
  </tr>
  <tr>
    <td>Usuário:</td>
    <td><input type="text" name="txtusuario" maxlength="20" ></td>
    <td>Senha:</td>
    <td><input type="password" name="pwdsenha" maxlength="20" ></td>
  </tr>
  <tr>
    <td>Cidade:</td>
    <td><input type="text" name="txtcidade" maxlength="30" ></td>
    <td>Bairro:</td>
    <td colspan=""><input type="text" name="txtbairro" maxlength="30" ></td>
  </tr>
  <tr>
    <td>Logradouro:</td>
    <td colspan="3"><input type="text" name="txtlogradouro" maxlength="40" class="inputlogradouro" ></td>
  </tr>
  <tr>
    <td>Número:</td>
    <td><input type="text" name="txtnumero" maxlength="5" ></td>
    <td>Comp:</td>
    <td><input type="text" name="txtcomp" maxlength="20" ></td>
  </tr>
  <tr>
    <td>CEP:</td>
    <td colspan="3"><input type="text" name="txtcep" maxlength="8" placeholder="Apenas os números" ></td>
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
<h1>Funcionários Registrados</h1>
<?php

$sql_sel_funcionarios = "SELECT funcionarios.*, usuarios.usuario, usuarios.permissao, usuarios.id AS usuarios_id FROM funcionarios
INNER JOIN usuarios ON funcionarios.usuario_id=usuarios.id ORDER BY nome ASC";
$sql_sel_funcionarios_preparado = $conexaobd->prepare($sql_sel_funcionarios);
$sql_sel_funcionarios_preparado->execute();

?>
<div class="registros">
<table width="80%">
  <thead>
    <tr>
      <th width="12%">Nome</th>
      <th width="12%">Telefone</th>
      <th width="11%">Cargo</th>
      <th width="12%">Usuário</th>
      <th width="12%">Permissão</th>
      <th width="7%">Alterar</th>
      <th width="7%">Excluir</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if($sql_sel_funcionarios_preparado->rowCount()>0){
        while($sql_sel_funcionarios_dados = $sql_sel_funcionarios_preparado->fetch()){

          if($sql_sel_funcionarios_dados['permissao']==""){
            $permissao = "-";
          }else if($sql_sel_funcionarios_dados['permissao']=='0'){
            $permissao = "Administrador";
          }else if($sql_sel_funcionarios_dados['permissao']=='1'){
            $permissao = "Vendedor";
          }

          if($sql_sel_funcionarios_dados['usuario']==""){
            $usuario = "-";
          }else{
            $usuario = $sql_sel_funcionarios_dados['usuario'];
          }

    ?>
    <tr>
      <td><?php echo $sql_sel_funcionarios_dados['nome']; ?></td>
      <td><?php echo $sql_sel_funcionarios_dados['telefone']; ?></td>
      <td><?php echo $sql_sel_funcionarios_dados['cargo']; ?></td>
      <td><?php echo $usuario; ?></td>
      <td><?php echo $permissao; ?></td>
      <td align="center"><a href="?pasta=funcionarios/&arquivo=va_fmalt_funcionarios&ext=php&id=<?php echo $sql_sel_funcionarios_dados['id']; ?>&usuario_id=<?php echo $sql_sel_funcionarios_dados['usuario_id']; ?>&enderecos_id=<?php echo $sql_sel_funcionarios_dados['enderecos_id'] ?>" title="Alterar registro"><img class="icone_tabela" src="../visual/imagens/editar.png"></a></td>
      <td align="center" onclick="return confirmar_exclusao('funcionário', '<?php echo addslashes($sql_sel_funcionarios_dados['nome']);?>')"><?php echo exclusaoSegura($sql_sel_funcionarios_dados['id'], '?pasta=funcionarios/&arquivo=va_del_funcionarios&ext=php', $sql_sel_funcionarios_dados['enderecos_id'], $sql_sel_funcionarios_dados['usuarios_id'])  ?></td>
    </tr>
    <?php
        }
      }else{
    ?>
      <tr>
        <td align="center" colspan="7">Não há registro de funcionários</td>
      </tr>
    <?php
      }
    ?>
  </tbody>
</table>
</div>
