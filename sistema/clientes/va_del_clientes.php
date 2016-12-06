<?php
  $permissao_acesso = 1;
?>
<h1>Aviso de Exclusão de Registro de Cliente</h1>
<?php

  $p_cliente_id = $_POST['id'];
  $p_endereco_id = $_POST['enderecos_id'];

  $texto = "";
  $operacao = "exclusão";
  $icone_erro_confirmacao = "../visual/imagens/erro.png";

  $sql_sel_enderecos = "SELECT funcionarios.id AS funcionarios_id, funcionarios.enderecos_id AS funcionarios_enderecos_id, clientes.enderecos_id AS clientes_enderecos_id, enderecos.id AS enderecos_id FROM enderecos
  INNER JOIN funcionarios ON funcionarios.enderecos_id = enderecos.id
  INNER JOIN clientes ON clientes.enderecos_id = enderecos.id
  WHERE MD5(funcionarios.enderecos_id)='".$p_endereco_id."' OR MD5(clientes.enderecos_id)='".$p_endereco_id."'";
  $sql_sel_enderecos_preparado = $conexaobd->prepare($sql_sel_enderecos);
  $sql_sel_enderecos_preparado->execute();

  if(!checar_vazio($p_cliente_id)){
      $caso = "vazio";
      $assunto = "Cliente";
    }else if(!checar_vazio($p_endereco_id)){
        $caso = "vazio";
        $assunto = "Cliente";
        }else{

              $sql_sel_orcamentos = "SELECT id FROM orcamentos WHERE MD5(clientes_id)='".$p_cliente_id."'";
              $sql_sel_orcamentos_preparado = $conexaobd->prepare($sql_sel_orcamentos);
              $sql_sel_orcamentos_preparado->execute();

              if($sql_sel_orcamentos_preparado->rowCount()==0){

                $tabela = "clientes";

                $condicao = "MD5(id)='".$p_cliente_id."'";

                $sql_del_clientes_resultado = deletar($tabela, $condicao);

                if($sql_sel_enderecos_preparado->rowCount()==0){

                  $tabela = "enderecos";

                  $condicao = "MD5(id)='".$p_endereco_id."'";

                  $sql_del_enderecos_resultado = deletar($tabela, $condicao);

                  if($sql_del_enderecos_resultado){
                      $caso = "sucesso";
                      $assunto = "cliente";
                      $operacao = "Exclusão";
                      $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
                  }else{
                    $caso = "bancodedados";
                    $assunto = "cliente";
                    $operacao = "exclusão";
                  }
                }else{
                  $caso = "sucesso";
                  $assunto = "cliente";
                  $operacao = "Exclusão";
                  $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
                }
              }else{
                $caso = "integridade";
                $assunto = "cliente";
                $operacao = "exclusão";
              }
          }
?>

<div class="aviso">
  <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
  <a href="?pasta=clientes/&arquivo=va_fmins_clientes&ext=php"><button class="botao_retornar" name="btnretornar" type="button">Retornar</button></a>
</div>
