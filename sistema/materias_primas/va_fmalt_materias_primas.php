<?php $permissao_acesso="1"; ?>
<div class="conteudo"><!--Inicio conteúdo-->
  <h1>Alteração de Matéria-Prima</h1>
  <?php
    $g_id = $_GET['id'];
    $sql_sel_materias_primas = "SELECT * FROM materias_primas WHERE id='".$g_id."' ";

    $sql_sel_materias_primas_preparado = $conexaobd->prepare($sql_sel_materias_primas);
    $sql_sel_materias_primas_preparado->execute();

    $sql_sel_materias_primas_dados = $sql_sel_materias_primas_preparado->fetch();
  ?>
  <form name="frmaltmateriasprimas" method="post" action="?pasta=materias_primas/&arquivo=va_alt_materias_primas&ext=php" onsubmit="return validarFormAltMateriasPrimas()">
    <input type="hidden" name="hidmateriaprimaid" value="<?php echo $sql_sel_materias_primas_dados['id'];?>">
    <table>
      <tr>
        <td>*Nome:</td>
        <td><input type="text" name="txtnome" maxlength="20" value="<?php echo $sql_sel_materias_primas_dados['nome'];?>"></td>
      </tr>
      <tr>
        <td>Descrição:</td>
        <td><textarea name="txadescricao" maxlength="100"><?php echo $sql_sel_materias_primas_dados['descricao'];?></textarea></td>
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
