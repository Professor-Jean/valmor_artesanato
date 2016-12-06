<?php
  $permissao_acesso = 0;
?>
<h1>Aviso de Alteração de Cadastro de Funcionários</h1>
<?php

  $p_funcionarios_id = $_POST['hidfuncionariosid'];
  $p_usuarios_id = $_POST['hidusuarioid'];
  $p_enderecos_id = $_POST['hidenderecosid'];

  $p_nome = $_POST['txtnome'];
  $p_cargo = $_POST['txtcargo'];
  $p_usuario = $_POST['txtusuario'];
  $p_senha = $_POST['pwdsenha'];
  $p_permissao = $_POST['selpermissao'];
  $p_telefone = $_POST['txttelefone'];
  $p_cidade = $_POST['txtcidade'];
  $p_bairro = $_POST['txtbairro'];
  $p_logradouro = $_POST['txtlogradouro'];
  $p_numero = $_POST['txtnumero'];
  $p_comp = $_POST['txtcomp'];
  $p_cep = $_POST['txtcep'];

  $dificultar_senha = md5($dificultar.$p_senha);

  $redirecionar_link = "?pasta=funcionarios/&arquivo=va_fmalt_funcionarios&ext=php&id=".$p_funcionarios_id."&usuario_id=".$p_usuarios_id."&enderecos_id=".$p_enderecos_id;

  $texto = "";
  $operacao = "alteração";
  $icone_erro_confirmacao = "../visual/imagens/erro.png";

  if(!checar_vazio($p_nome)){
      $caso = "validacao";
      $assunto = "nome";
    }else if(!checar_vazio($p_cargo)){
        $caso = "validacao";
        $assunto = "cargo";
      }else if(!checar_vazio($p_telefone)){
          $caso = "validacao";
          $assunto = "telefone";
        }else if(($p_usuario<>""||$p_senha<>"")&&(!checar_vazio($p_permissao))){
            $caso = "validacao";
            $assunto = "permissão";
          }else if(($p_permissao<>""||$p_senha<>"")&&(!checar_vazio($p_usuario))){
              $caso = "validacao";
              $assunto = "usuário";
            }else if(($p_permissao<>""||$p_usuario<>"")&&(!checar_vazio($p_senha))){
                $caso = "validacao";
                $assunto = "senha";
              }else{

              $sql_sel_usuarios = "SELECT usuario FROM usuarios WHERE id<>'".$p_usuarios_id."' AND usuario='".$p_usuario."'";
              $sql_sel_usuarios_preparado = $conexaobd->prepare($sql_sel_usuarios);
              $sql_sel_usuarios_preparado->execute();

              if($sql_sel_usuarios_preparado->rowCount()==0){

                $sql_sel_funcionarios = "SELECT * FROM funcionarios WHERE telefone='".$p_telefone."' AND nome='".$p_nome."' AND cargo='".$p_cargo."' AND id<>'".$p_funcionarios_id."'";
                $sql_sel_funcionarios_preparado = $conexaobd->prepare($sql_sel_funcionarios);
                $sql_sel_funcionarios_preparado->execute();

                if($sql_sel_funcionarios_preparado->rowCount()==0){

                  $sql_sel_enderecos = "SELECT * FROM enderecos
                  WHERE cidade='".$p_cidade."'
                  AND bairro='".$p_bairro."' AND logradouro='".$p_logradouro."'
                  AND numero='".$p_numero."' AND complemento='".$p_comp."'
                  AND cep='".$p_cep."'";
                  $sql_sel_enderecos_preparado = $conexaobd->prepare($sql_sel_enderecos);
                  $sql_sel_enderecos_preparado->execute();

                  if($sql_sel_enderecos_preparado->rowCount()==1){

                    $tabela = "enderecos";

                    $dados = array(
                      'cidade'      => $p_cidade,
                      'bairro'      => $p_bairro,
                      'logradouro'  => $p_logradouro,
                      'numero'      => $p_numero,
                      'complemento' => $p_comp,
                      'cep'         => $p_cep
                    );

                    $condicao = "id='".$p_enderecos_id."'";

                    $sql_alt_enderecos_resultado = alterar($tabela, $dados, $condicao);

                    if($sql_alt_enderecos_resultado){
                      $valor = $p_enderecos_id;
                      $condicao_endereco = 1;
                    }else{
                      $caso = "bancodedados";
                      $assunto = "funcionários";
                      $operacao = "cadastro";
                    }

                  }else{

                    $tabela = "enderecos";

                    $dados = array(
                      'cidade'      => $p_cidade,
                      'bairro'      => $p_bairro,
                      'logradouro'  => $p_logradouro,
                      'numero'      => $p_numero,
                      'complemento' => $p_comp,
                      'cep'         => $p_cep
                    );

                    $sql_ins_enderecos_resultado = adicionar($tabela, $dados);

                    $valor = $conexaobd->lastInsertId();
                    $condicao_endereco = 0;

                  }
                    if($condicao_endereco==0||$condicao_endereco==1){

                      $enderecos_id = $valor;

                      $tabela = "usuarios";

                      $dados = array(
                        'usuario'   => $p_usuario,
                        'senha'     => $dificultar_senha,
                        'permissao' => $p_permissao
                      );

                      $condicao = "id='".$p_usuarios_id."'";

                      $sql_alt_usuarios_resultado = alterar($tabela, $dados, $condicao);

                      if($sql_alt_usuarios_resultado){

                        $tabela = "funcionarios";

                        $dados = array(
                          'nome'         => $p_nome,
                          'cargo'        => $p_cargo,
                          'telefone'     => $p_telefone,
                          'enderecos_id' => $enderecos_id
                        );

                        $condicao = "id='".$p_funcionarios_id."' AND enderecos_id='".$p_enderecos_id."' AND usuario_id='".$p_usuarios_id."'";

                        $sql_alt_funcionarios_resultado = alterar($tabela, $dados, $condicao);

                        if($sql_alt_funcionarios_resultado){
                          $caso = "sucesso";
                          $assunto = "funcionário";
                          $operacao = "Alteração";
                          $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
                          $redirecionar_link = "?pasta=funcionarios/&arquivo=va_fmins_funcionarios&ext=php";
                        }else{
                          $caso = "bancodedados";
                          $assunto = "funcionário";
                          $operacao = "alteração";
                        }
                      }else{
                        $caso = "bancodedados";
                        $assunto = "funcionário";
                        $operacao = "alteração";
                      }
                    }else{
                      $caso = "bancodedados";
                      $assunto = "funcionário";
                      $operacao = "alteração";
                    }
                  }else{
                    $caso = "existencia";
                    $assunto = "funcionário";
                  }
                }else{
                  $caso = "existencia";
                  $assunto = "usuário";
                }
  }
?>
<div class="aviso">
  <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
  <a href="<?php echo $redirecionar_link; ?>"><button class="botao_retornar" name="btnretornar" type="button">Retornar</button></a>
</div>
