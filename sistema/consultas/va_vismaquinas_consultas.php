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
<?php
  $permissao_acesso = 0;

  $sql_sel_maquinas = "SELECT * FROM maquinas ORDER BY marca ASC";
  $sql_sel_maquinas_preparado = $conexaobd->prepare($sql_sel_maquinas);
  $sql_sel_maquinas_preparado->execute();
?>
<h1>Consulta de Máquinas</h1>
<div class="consulta_toggle">
  <div class="form_pesquisa">
    <form name="frmfilvismaquinas" method="POST" action="?pasta=consultas/&arquivo=va_vismaquinas_consultas&ext=php">
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

          $sql_sel_maquinas = "SELECT * FROM maquinas WHERE marca LIKE '%$p_filtro%' OR modelo LIKE '%$p_filtro%'  ORDER BY marca ASC";
          $sql_sel_maquinas_preparado = $conexaobd->prepare($sql_sel_maquinas);
          $sql_sel_maquinas_preparado->execute();

        }

        if($sql_sel_maquinas_preparado->rowCount()>0){
          while($sql_sel_maquinas_dados = $sql_sel_maquinas_preparado->fetch()){
      ?>
      <tr class="titulos">
        <td><?php echo $sql_sel_maquinas_dados['marca'] ?></td>
        <td><?php echo $sql_sel_maquinas_dados['modelo'] ?></td>
      </tr>
      <tr >
        <td align="center" colspan="2">
          <ul><button class="botao_mais">+</button>
            <li class="toggle">
              <ul class="tabela_toggle" ><button class="botao_mais">-</button>
                <table  >
                  <tr >
                    <td align="left" width="45%" class="dados_consulta_maquinas">
                        <?php
                          if($sql_sel_maquinas_dados['data_aquisicao']==""){
                              echo "Data de Aquisição: - ";
                            }else{
                              $data = explode("-", $sql_sel_maquinas_dados['data_aquisicao']);
                              echo "Data de Aquisição: ".$data[2]."/".$data[1]."/".$data[0];
                            }
                          ?>
                    </td>
                    <td align="left" width="45%" class="dados_consulta_maquinas">
                        <?php
                          if($sql_sel_maquinas_dados['descricao']==""){
                            echo "Descrição: - ";
                          }else{
                            echo "Descrição: ".$sql_sel_maquinas_dados['descricao'];
                          }
                        ?>
                    </td>
                    <?php
                      $sql_sel_movimentacoes = "SELECT status, maquinas_id FROM movimentacoes WHERE status=1 AND maquinas_id='".$sql_sel_maquinas_dados['id']."'";
                      $sql_sel_movimentacoes_preparado = $conexaobd->prepare($sql_sel_movimentacoes);
                      $sql_sel_movimentacoes_preparado->execute();

                      if($sql_sel_movimentacoes_preparado->rowCount()>0){
                    ?>
                        <td align="rigth" width="1%"><a href="?pasta=manutencoes/&arquivo=va_fmins_retorno_manutencoes&ext=php&id=<?php echo $sql_sel_maquinas_dados['id']; ?>" title="Registrar retorno da manutenção" class="icone_toggle"><img class="icone_tabela" src="../visual/imagens/saida.png"></a></td>
                    <?php
                      }else{
                    ?>
                        <td align="rigth" width="1%"><a href="?pasta=manutencoes/&arquivo=va_fmins_saida_manutencoes&ext=php&id=<?php echo $sql_sel_maquinas_dados['id']; ?>" title="Registrar saída à manutenção" class="icone_toggle"><img class="icone_tabela" src="../visual/imagens/retorno.gif"></a></td>
                    <?php
                      }
                    ?>
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
            if(isset($_POST['txtfiltro'])){
              echo '<td align="center" colspan="6">Não há registro de máquinas para essa pesquisa</td>';
            }else{
             echo '<td align="center" colspan="6">Não há registro de máquinas</td>';
            }
          ?>
        </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
