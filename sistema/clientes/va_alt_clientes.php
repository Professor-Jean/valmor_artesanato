<?php
  $permissao_acesso = 1;
?>
<h1>Aviso de Alteração de Cadastro de Clientes</h1>
<?php

  $p_cliente_id = $_POST['hidclienteid'];
  $p_endereco_id = $_POST['hidenderecoid'];

  $p_nome = $_POST['txtnome'];
  $p_cpf = $_POST['txtcpf'];
  $p_email = $_POST['txtemail'];
  $p_telefone = $_POST['txttelefone'];
  $p_facebook = $_POST['txtfacebook'];
  $p_bairro = $_POST['txtbairro'];
  $p_cidade = $_POST['txtcidade'];
  $p_logradouro = $_POST['txtlogradouro'];
  $p_numero = $_POST['txtnumero'];
  $p_comp = $_POST['txtcomp'];
  $p_cep = $_POST['txtcep'];

  $redirecionar_link = "?pasta=clientes/&arquivo=va_fmalt_clientes&ext=php&id=".$p_cliente_id."&enderecos_id=".$p_endereco_id;

  $valor = $p_endereco_id;
  $texto = "";
  $operacao = "cadastro";
  $icone_erro_confirmacao = "../visual/imagens/erro.png";

  if(!checar_vazio($p_nome)){
      $caso = "validacao";
      $assunto = "nome";
    }else if(!checar_vazio($p_email)){
        $caso = "validacao";
        $assunto = "e-mail";
      }else if(!checar_vazio($p_telefone)){
          $caso = "validacao";
          $assunto = "telefone";
        }else{

            $sql_sel_clientes = "SELECT * FROM clientes WHERE telefone='".$p_telefone."' AND nome='".$p_nome."' AND email='".$p_email."' id<>'".$p_cliente_id."'";
            $sql_sel_clientes_preparado = $conexaobd->prepare($sql_sel_clientes);
            $sql_sel_clientes_preparado->execute();

            if($sql_sel_clientes_preparado->rowCount()==0){

                $sql_sel_enderecos = "SELECT enderecos.*, clientes.id FROM enderecos
                INNER JOIN clientes ON clientes.enderecos_id = enderecos.id
                WHERE cidade='".$p_cidade."'
                AND bairro='".$p_bairro."' AND logradouro='".$p_logradouro."'
                AND numero='".$p_numero."' AND complemento='".$p_comp."' AND cep='".$p_cep."'";
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

                  $condicao = "id='".$p_endereco_id."'";

                  $sql_alt_enderecos_resultado = alterar($tabela, $dados, $condicao);

                  if($sql_alt_enderecos_resultado){
                    $condicao_endereco = 1;
                  }else{
                    $caso = "bancodedados";
                    $assunto = "cliente";
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

                    $tabela = "clientes";

                    $dados = array(
                      'nome'         => $p_nome,
                      'email'        => $p_email,
                      'telefone'     => $p_telefone,
                      'cpf'          => $p_cpf,
                      'link_facebook'=> $p_facebook,
                      'enderecos_id' => $enderecos_id
                    );

                    $condicao = "id='".$p_cliente_id."'";

                    $sql_alt_clientes_resultado = alterar($tabela, $dados, $condicao);

                    if($sql_alt_clientes_resultado){
                      $caso = "sucesso";
                      $assunto = "cliente";
                      $operacao = "Cadastro";
                      $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
                      $redirecionar_link = "?pasta=clientes/&arquivo=va_fmins_clientes&ext=php";
                    }else{
                      $caso = "bancodedados";
                      $assunto = "cliente";
                      $operacao = "cadastro";
                    }
                  }else{
                    $caso = "bancodedados";
                    $assunto = "cliente";
                    $operacao = "cadastro";
                  }

              }else{
                $caso = "existencia";
                $assunto = "cliente";
              }


        }
?>
<div class="aviso">
  <p><img src="<?php echo $icone_erro_confirmacao; ?>"/><?php echo reposicaoMensagem($caso, $assunto, $operacao); ?></p>
  <a href="<?php echo $redirecionar_link;?>"><button class="botao_retornar" name="btnretornar" type="button">Retornar</button></a>
</div>
