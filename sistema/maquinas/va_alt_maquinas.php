<?php
  $permissao_acesso = 0;
?>
<h1>Aviso de Alteração de Registro de Máquina</h1>
<?php

  $p_maquinas_id = $_POST['hidmaquinasid'];

  $p_marca = $_POST['txtmarca'];
  $p_modelo = $_POST['txtmodelo'];
  $p_data_de_aquisicao = $_POST['txtdataaquisicao'];
  $p_descricao = $_POST['txadescricao'];

  $texto = "";
  $operacao = "alteração";
  $icone_erro_confirmacao = "../visual/imagens/erro.png";

  $redirecionar_link = "?pasta=maquinas/&arquivo=va_fmalt_maquinas&ext=php&id=".$p_maquinas_id;

  $data = implode("-", array_reverse(explode("/", $p_data_de_aquisicao)));

  if(!checar_vazio($p_marca)){
      $caso = "validacao";
      $assunto = "marca";
    }else if(!checar_vazio($p_modelo)){
        $caso = "validacao";
        $assunto = "modelo";
      }else{

        $sql_sel_maquinas = "SELECT * FROM maquinas WHERE marca='".$p_marca."' AND modelo='".$p_modelo."' AND id<>'".$p_maquinas_id."'";
        $sql_sel_maquinas_preparado = $conexaobd->prepare($sql_sel_maquinas);
        $sql_sel_maquinas_preparado->execute();

        if($sql_sel_maquinas_preparado->rowCount()==0){

          $tabela = "maquinas";

          $dados = array(
            'marca'          => $p_marca,
            'modelo'         => $p_modelo,
            'data_aquisicao' => $data,
            'descricao'      => $p_descricao
          );

          $condicao = "id='".$p_maquinas_id."'";

          $sql_alt_maquinas_resultado = alterar($tabela, $dados, $condicao);

          if($sql_alt_maquinas_resultado){
            $caso = "sucesso";
            $assunto = "máquina";
            $operacao = "Alteração";
            $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
            $redirecionar_link = "?pasta=maquinas/&arquivo=va_fmins_maquinas&ext=php";
          }else{
            $caso = "bancodedados";
            $assunto = "máquina";
            $operacao = "alteração";
          }
        }else{
          $caso = "existencia";
          $assunto = "máquina";
        }
  }
?>
<div class="aviso">
  <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
  <a href="<?php echo $redirecionar_link ?>"><button class="botao_retornar" name="btnretornar" type="button">Retornar</button></a>
</div>
