<?php $permissao_acesso = 1; ?>
<h1>Registro de Matéria-Prima</h1>
<form name="frminsmateriasprimas" method="POST" action="?pasta=materias_primas/&arquivo=va_ins_materias_primas&ext=php" onsubmit="return validarFormInsMateriasPrimas()">
  <table>
    <tr>
      <td>*Nome:</td>
      <td><input type="text" name="txtnome" maxlength="30"></td>
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
<h1>Matérias-primas registradas</h1>
<?php
  $sql_sel_materias_primas = "SELECT * FROM materias_primas";
  $sql_sel_materias_primas_preparado = $conexaobd->prepare($sql_sel_materias_primas);
  $sql_sel_materias_primas_preparado->execute();
?>
<div class="registros">
  <table width="80%">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Alterar</th>
        <th>Excluir</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if($sql_sel_materias_primas_preparado->rowCount()>0){
          while($sql_sel_materias_primas_dados = $sql_sel_materias_primas_preparado->fetch()){
      ?>
      <tr>
        <td><?php echo $sql_sel_materias_primas_dados['nome']; ?></td>
        <td>
          <?php
          if($sql_sel_materias_primas_dados['descricao']==""){
            echo "-";
          }else{
            echo $sql_sel_materias_primas_dados['descricao'];
          }
          ?>
        </td>
        <td align="center"><a href="?pasta=materias_primas/&arquivo=va_fmalt_materias_primas&ext=php&id=<?php echo $sql_sel_materias_primas_dados['id']; ?>" title="Alterar registro"><img src="../visual/imagens/editar.png"></td>
        <td align="center" onclick="return confirmar_exclusao('matéria-prima', '<?php echo addslashes($sql_sel_materias_primas_dados['nome']);?>')"> <?php echo exclusaoSegura($sql_sel_materias_primas_dados['id'], '?pasta=materias_primas/&arquivo=va_del_materias_primas&ext=php'); ?></td>
      </tr>
      <?php
          }
        }else{
      ?>
      <tr>
        <td align="center" colspan="4">Não há registros de matérias-primas</td>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
