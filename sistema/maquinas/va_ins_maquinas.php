<?php
  $permissao_acesso = 0;
?>
<h1>Aviso de Registro de Máquina</h1>
<?php

  $p_marca = $_POST['txtmarca'];
  $p_modelo = $_POST['txtmodelo'];
  $p_data_de_aquisicao = $_POST['txtdataaquisicao'];
  $p_descricao = $_POST['txadescricao'];

  $texto = "";
  $operacao = "cadastro";
  $icone_erro_confirmacao = "../visual/imagens/erro.png";

  $data = implode("-", array_reverse(explode("/", $p_data_de_aquisicao)));

  if(!checar_vazio($p_marca)){
      $caso = "validacao";
      $assunto = "marca";
    }else if(!checar_vazio($p_modelo)){
        $caso = "validacao";
        $assunto = "modelo";
      }else{

        $sql_sel_maquinas = "SELECT * FROM maquinas WHERE marca='".$p_marca."' AND modelo='".$p_modelo."' ";
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

          $sql_ins_maquinas_resultado = adicionar($tabela, $dados);

          if($sql_ins_maquinas_resultado){
            $caso = "sucesso";
            $assunto = "máquina";
            $operacao = "Cadastro";
            $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
          }else{
            $caso = "bancodedados";
            $assunto = "máquina";
            $operacao = "cadastro";
          }
        }else{
          $caso = "existencia";
          $assunto = "máquina";
        }
  }
?>
<div class="aviso">
  <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
  <a href="?pasta=maquinas/&arquivo=va_fmins_maquinas&ext=php"><button class="botao_retornar" name="btnretornar" type="button">Retornar</button></a>
</div>
