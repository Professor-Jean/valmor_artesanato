<?php
  $permissao_acesso = 1;
?>
<script>
$(document).ready(function(){
$(".toggle").hide();

$("ul").click(function(){
  $(".toggle", this).toggle();
});
});
</script>
<h1>Consulta de Clientes</h1>
<?php
  //Selecionando dados dos clientes
  $sql_sel_clientes = "SELECT clientes.*, enderecos.*
  FROM clientes INNER JOIN enderecos ON clientes.enderecos_id=enderecos.id";
  $sql_sel_clientes_preparado = $conexaobd->prepare($sql_sel_clientes);
  $sql_sel_clientes_preparado->execute();
?>
<div class="consulta_toggle">
  <div class="form_pesquisa">
    <!--Formulário de pesquisa -->
    <form name="frmfilviscliente" method="post" action="?pasta=consultas/&arquivo=va_viscliente_consultas&ext=php">
      <input type="text" name="txtconsulta" placeholder="Pesquisar"/><button type="submit" name="btnpesquisar"><img src="../visual/imagens/pesquisar.png"></button>
    </form>
    <!--Fim formulário de pesquisa -->
  </div>
  <table width="60%">
    <thead>
      <tr>
        <th width="30%">Nome</th>
        <th width="30%">Telefone</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //nova pesquisa baseada no Filtro
      $sql_sel_clientes = "SELECT clientes.*, enderecos.*
      FROM clientes INNER JOIN enderecos ON clientes.enderecos_id=enderecos.id";
      $sql_sel_clientes_preparado = $conexaobd->prepare($sql_sel_clientes);
      $sql_sel_clientes_preparado->execute();

        //caso tenha valor definido faça
        if(isset($_POST['txtconsulta'])){
          //simplifica var
          $filtro = $_POST['txtconsulta'];
            //filtrando através de nome ou telefone
            $sql_sel_clientes = $sql_sel_clientes." AND (clientes.nome LIKE '%$filtro%') OR (clientes.telefone LIKE '%$filtro%') GROUP BY clientes.nome";
            $sql_sel_clientes_preparado = $conexaobd->prepare($sql_sel_clientes);
            $sql_sel_clientes_preparado->execute();
        }

        if($sql_sel_clientes_preparado->rowCount()>0){
          while($sql_sel_clientes_dados = $sql_sel_clientes_preparado->fetch()){
      ?>
      <!--Mostrando dados na tabela -->
      <tr class="titulos">
        <td><?php echo $sql_sel_clientes_dados['nome'];?></td>
        <td><?php echo $sql_sel_clientes_dados['telefone'];?></td>
      </tr>
      <tr>
        <td align="center" colspan="2">
          <ul><button class="botao_mais">+</button>
            <li class="toggle">
              <ul class="tabela_toggle" ><button class="botao_mais">-</button>
                <table>
                  <tr class="dados_consulta">
                    <!--Email do cliente-->
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_clientes_dados['email']==""){
                            echo "E-mail:";
                          }else{
                            echo "E-mail: ".$sql_sel_clientes_dados['email'];
                          }
                        ?>
                    </td>
                    <!--CPF do cliente-->
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_clientes_dados['cpf']==""){
                            echo "CPF: -";
                          }else{
                            echo "CPF: ".$sql_sel_clientes_dados['cpf'];
                          }
                        ?>
                    </td>
                  </tr>
                  <tr>
                    <!--Cidade do cliente-->
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_clientes_dados['cidade']==""){
                            echo "Cidade: -";
                          }else{
                            echo "Cidade: ".$sql_sel_clientes_dados['cidade'];
                          }
                        ?>
                    </td>
                    <!--Bairro do cliente-->
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_clientes_dados['bairro']==""){
                            echo "Bairro: -";
                          }else{
                            echo "Bairro: ".$sql_sel_clientes_dados['bairro'];
                          }
                        ?>
                    </td>
                  </tr>
                  <tr>
                    <!--Endereço do cliente-->
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_clientes_dados['logradouro']==""){
                            echo "Logradouro: -";
                          }else{
                            echo "Logradouro: ".$sql_sel_clientes_dados['logradouro'];
                          }
                        ?>
                    </td>
                    <!--Numero da casa do cliente-->
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_clientes_dados['numero']==""){
                            echo "Número: -";
                          }else{
                            echo "Número: ".$sql_sel_clientes_dados['numero'];
                          }
                        ?>
                    </td>
                  </tr>
                  <!--Complemento da moradia do cliente -->
                  <tr>
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_clientes_dados['complemento']==""){
                            echo "Complemento: -";
                          }else{
                            echo "Complemento: ".$sql_sel_clientes_dados['complemento'];
                          }
                        ?>
                    </td>
                    <!--Cep do cliente-->
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_clientes_dados['cep']==""){
                            echo "CEP: -";
                          }else{
                            echo "CEP: ".$sql_sel_clientes_dados['cep'];
                          }
                        ?>
                    </td>
                  </tr>
                  <tr>
                    <!--Pagina de perfil do cliente-->
                    <td align="left" width="45%" class="dados_consulta_clientes">
                        <?php
                          if($sql_sel_clientes_dados['link_facebook']==""){
                            echo "Facebook: -";
                          }else{
                            echo "Facebook: "
                        ?>
                            <a target="_blank"  href="<?php echo  $sql_sel_clientes_dados['link_facebook'];?>" class="icone_toggle">
                              <img src="../visual/imagens/facebook.png" class="icone_tabela">
                            </a>
                        <?php
                          }
                        ?>
                    </td>
                  </tr>
                </table>
              </ul>
            </li>
          </ul>
        </td>
      </tr>
      <?php
          }
        }else{
      ?>
      <tr>
        <?php
        if(isset($_POST['txtconsulta'])){
          echo '<td align="center" colspan="10">Não há registro para essa pesquisa</td>';
        }else{
         echo '<td align="center" colspan="10">Não há registros de clientes</td>';
        }
        ?>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
