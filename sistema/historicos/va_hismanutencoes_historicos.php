<?php
 $permissao_acesso="0";

 $sql_sel_movimentacoes = "SELECT movimentacoes.*, maquinas.marca, maquinas.modelo FROM movimentacoes
 INNER JOIN maquinas ON movimentacoes.maquinas_id=maquinas.id
 WHERE movimentacoes.status='0'
 ORDER BY marca ASC";
 $sql_sel_movimentacoes_preparado = $conexaobd->prepare($sql_sel_movimentacoes);
 $sql_sel_movimentacoes_preparado->execute();
?>
<script>
  $(document).ready(function(){
    $(".toggle").hide();

    $("ul").click(function(){
      $(".toggle", this).toggle();
    });
  });
</script>
<style>
  .tabela_toggle table{
    border: none;
  }
</style>
<h1>Histórico de Manutenções</h1>
<div class="consulta_toggle">
  <div class="form_pesquisa">
    <form name="frmhismanutencoes" method="POST">
      <input type="text" name="txtfiltro" placeholder="Pesquisar"/><button type="submit" name="btnpesquisar"><img src="../visual/imagens/pesquisar.png"></button>
    </form>
  </div>
  <table width="60%">
    <thead>
      <tr>
        <th width="30%">Marca</th>
        <th width="30%">Modelo</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if(isset($_POST['txtfiltro'])){

          $p_filtro = $_POST['txtfiltro'];

          //Select para o filtro
          $sql_sel_movimentacoes = "SELECT movimentacoes.*, maquinas.modelo, maquinas.marca FROM movimentacoes
          INNER JOIN maquinas ON movimentacoes.maquinas_id=maquinas.id
          WHERE (movimentacoes.status='0')
          AND marca LIKE '%$p_filtro%'
          OR modelo LIKE '%$p_filtro%'
          ORDER BY marca ASC";
          $sql_sel_movimentacoes_preparado = $conexaobd->prepare($sql_sel_movimentacoes);
          $sql_sel_movimentacoes_preparado->execute();
        }

        if($sql_sel_movimentacoes_preparado->rowCount()>0){
          while($sql_sel_movimentacoes_dados = $sql_sel_movimentacoes_preparado->fetch()){
      ?>
      <tr class="titulos">
        <td><?php echo $sql_sel_movimentacoes_dados['marca'] ?></td>
        <td><?php echo $sql_sel_movimentacoes_dados['modelo'] ?></td>
      </tr>
      <tr >
        <td align="center" colspan="2">
          <ul><button class="botao_mais">+</button>
            <li class="toggle">
              <ul class="tabela_toggle" ><button class="botao_mais">-</button>
                <table>
                  <tr>
                    <td align="left" width="45%" class="dados_consulta_maquinas">
                        <?php
                          echo "Data de saída: ".implode("/", array_reverse(explode("-", $sql_sel_movimentacoes_dados['data_saida'])));
                        ?>
                      </td>
                      <td align="left" width="45%" class="dados_consulta_maquinas">
                      <?php echo "Data de retorno: ".implode("/", array_reverse(explode("-", $sql_sel_movimentacoes_dados['data_retorno']))); ?>
                      </td>
                  </tr>
                  <tr>
                    <td align="left" width="45%" class="dados_consulta_maquinas">
                    <?php echo "Data prevista de retorno: ".implode("/", array_reverse(explode("-", $sql_sel_movimentacoes_dados['data_prevista'])));?>
                    </td>
                    <td align="left" width="45%" class="dados_consulta_maquinas">
                    <?php
                      if($sql_sel_movimentacoes_dados['descricao']==""){
                        echo "Descrição de retorno: -";
                      }else{
                        echo "Descrição de retorno: ".$sql_sel_movimentacoes_dados['descricao'];
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
            if(!isset($txtconsulta)){
              echo '<td align="center" colspan="10">Não há registro de manutenções para essa pesquisa</td>';
            }else{
             echo '<td align="center" colspan="10">Não há registros de manutenções</td>';
            }
          ?>
        </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
