<?php
  $permissao_acesso = 1;
?>
<h1>Aviso de Cadastro de Cliente</h1>
<?php

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

  $texto = "";
  $operacao = "cadastro";
  $icone_erro_confirmacao = "../visual/imagens/erro.png";
  // serve para informar que os campos opcionais não foram preenchidos corretamente
  $controle = 1;
  // checa se não foi preenchido apenas com espaço
if(!checar_vazio_espaco($p_cpf)){
$caso = "validacao";
$assunto = "CPF";
$controle = 0;
}
if(!checar_numero($p_cpf)){
$caso = "validacao";
$assunto = "CPF";
$controle = 0;
}
if(!checar_vazio_espaco($p_facebook)){
$caso = "validacao";
$assunto = "Facebook";
$controle = 0;
}
if(!checar_vazio_espaco($p_bairro)){
$caso = "validacao";
$assunto = "bairro";
$controle = 0;
}
if(!checar_vazio_espaco($p_cidade)){
$caso = "validacao";
$assunto = "cidade";
$controle = 0;
}
if(!checar_vazio_espaco($p_logradouro)){
$caso = "validacao";
$assunto = "logradouro";
$controle = 0;
}
if(!checar_vazio_espaco($p_numero)){
$caso = "validacao";
$assunto = "número";
$controle = 0;
}
if(!checar_vazio_espaco($p_comp)){
$caso = "validacao";
$assunto = "complemento";
$controle = 0;
}
if(!checar_vazio_espaco($p_cep)){
$caso = "validacao";
$assunto = "CEP";
$controle = 0;
}

  //obrigatórios
  //caso não esteja vazio e não tenha problema
  if(!checar_vazio($p_nome)&&$controle==1){
      $caso = "validacao";
      $assunto = "nome";
    }else if(!checar_vazio($p_email)&&$controle==1){
        $caso = "validacao";
        $assunto = "e-mail";
      }else if(!checar_vazio($p_telefone)&&$controle==1){
          $caso = "validacao";
          $assunto = "telefone";
        }else{

            $sql_sel_clientes = "SELECT * FROM clientes WHERE telefone='".$p_telefone."' AND nome='".$p_nome."' AND email='".$p_email."'";
            $sql_sel_clientes_preparado = $conexaobd->prepare($sql_sel_clientes);
            $sql_sel_clientes_preparado->execute();

            if($sql_sel_clientes_preparado->rowCount()==0){

                $sql_sel_enderecos = "SELECT * FROM enderecos WHERE cidade='".$p_cidade."' AND bairro='".$p_bairro."' AND logradouro='".$p_logradouro."' AND numero='".$p_numero."' AND complemento='".$p_comp."' AND cep='".$p_cep."'";
                $sql_sel_enderecos_preparado = $conexaobd->prepare($sql_sel_enderecos);
                $sql_sel_enderecos_preparado->execute();

                if($sql_sel_enderecos_preparado->rowCount()==0){

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

                  if($sql_ins_enderecos_resultado){
                    $valor = $conexaobd->lastInsertId();
                    $condicao_endereco = 1;
                  }else{
                    $caso = "bancodedados";
                    $assunto = "cliente";
                    $operacao = "cadastro";
                  }

                }else{

                  $sql_sel_enderecos_dados = $sql_sel_enderecos_preparado->fetch();
                  $valor = $sql_sel_enderecos_dados['id'];
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
                      'enderecos_id' => $enderecos_id,
                    );

                    $sql_ins_clientes_resultado = adicionar($tabela, $dados);

                    if($sql_ins_clientes_resultado){
                      $caso = "sucesso";
                      $assunto = "cliente";
                      $operacao = "Cadastro";
                      $icone_erro_confirmacao = "../visual/imagens/sucesso.png";
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
  <a href="?pasta=clientes/&arquivo=va_fmins_clientes&ext=php"><button class="botao_retornar" name="btnretornar" type="button">Retornar</button></a>
</div>
