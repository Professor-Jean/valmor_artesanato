<?php
  $permissao_acesso = 0;
?>
<h1>Aviso de Exclusão de Cadastro de Funcionários</h1>
<?php

  $p_id = $_POST['id'];
  $p_usuario_id = $_POST['usuarios_id'];
  $p_enderecos_id = $_POST['enderecos_id'];

  $sql_sel_funcionarios = "SELECT funcionarios.id AS funcionarios_id, funcionarios.enderecos_id AS funcionarios_enderecos_id, clientes.enderecos_id AS clientes_enderecos_id, enderecos.id AS enderecos_id FROM enderecos
  INNER JOIN funcionarios ON funcionarios.enderecos_id = enderecos.id
  INNER JOIN clientes ON clientes.enderecos_id = enderecos.id
  WHERE MD5(funcionarios.enderecos_id)='".$p_enderecos_id."' OR MD5(clientes.enderecos_id)='".$p_enderecos_id."'";
  $sql_sel_funcionarios_preparado = $conexaobd->prepare($sql_sel_funcionarios);
  $sql_sel_funcionarios_preparado->execute();

  $texto = "";
  $operacao = "exclusão";
  $icone_erro_confirmacao = "../visual/imagens/erro.png";

  if(!checar_vazio($p_id)){
      $caso = "vazio";
      $assunto = "Funcionarios";
    }else if(!checar_vazio($p_usuario_id)){
        $caso = "vazio";
        $assunto = "Funcionarios";
      }else if(!checar_vazio($p_enderecos_id)){
        $caso = "vazio";
        $assunto = "Funcionarios";
      }else{
        $sql_sel_usuarios = "SELECT * FROM usuarios WHERE MD5(id)='".$p_usuario_id."'";
        $sql_sel_usuarios_preparado = $conexaobd->prepare($sql_sel_usuarios);
        $sql_sel_usuarios_preparado->execute();
        $sql_sel_usuarios_dados = $sql_sel_usuarios_preparado->fetch();

        if($sql_sel_usuarios_dados['usuario']==$_SESSION['usuario']){
          $caso = "bancodedados";
          $assunto = "usuário, você próprio não pode se deletar";
          $operacao = "exclusão";
        }else{
            $tabela = "funcionarios";

            $condicao = "MD5(id)='".$p_id."'";

            $sql_del_funcionarios_resultado = deletar($tabela, $condicao);

            if($sql_del_funcionarios_resultado){

              $tabela = "usuarios";

              $condicao = "MD5(id)='".$p_usuario_id."'";

              $sql_del_usuarios_resultado = deletar($tabela, $condicao);

              if($sql_del_usuarios_resultado){

                  if($sql_sel_funcionarios_preparado->rowCount()==0){

                    $tabela = "enderecos";

                    $condicao = "MD5(id)='".$p_enderecos_id."'";

                    $sql_del_enderecos_resultado = deletar($tabela, $condicao);

                if($sql_del_enderecos_resultado){
                    $caso = "sucesso";
                    $assunto = "funcionário";
                    $operacao = "Exclusão";
                    $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
                }else{
                  $caso = "integridade";
                  $assunto = "endereço, porém o funcionário foi excluído com sucesso";
                  $operacao = "Exclusão";
                  $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
                }
              }else{
                $caso = "sucesso";
                $assunto = "funcionário";
                $operacao = "Exclusão";
                $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
              }
            }else{
              $caso = "bancodedados";
              $assunto = "usuário";
              $operacao = "exclusão";
            }
          }else{
            $caso = "bancodedados";
            $assunto = "funcionário";
            $operacao = "exclusão";
          }
        }
  }
?>
<div class="aviso">
  <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
  <a href="?pasta=funcionarios/&arquivo=va_fmins_funcionarios&ext=php"><button class="botao_retornar" name="btnretornar" type="button">Retornar</button></a>
</div>
