<!DOCTYPE html>
<?php
  ob_start(); //Ativa o buffer de saída não enviando a saída de script, exceto os cabeçalhos.
  session_start(); //Inicia a sessão de usuário

  include "../seguranca/va_setup_seguranca.php";
  include "../seguranca/database/va_conexao_database.php";
  include "../complementos/php/va_operacao_php.php";
  include "../complementos/php/va_repositormensagens_php.php";
  include "../complementos/php/va_exclusaosegura_php.php";
  include "../complementos/php/va_validacao_php.php";

?>
<html>
  <head>
    <title>Valmor Artesanatos</title>
    <meta charset='utf-8'/>
    <meta name='author' content="Arthur Paiva Camilo, Henrique Werner Junkes, Matheus Leitzke e Thiago Nicolodi.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- links de estilo -->
    <link href="../visual/css/va_estilo_css.css" rel="stylesheet" type="text/css">
    <link href="../visual/css/va_reset_css.css" rel="stylesheet" type="text/css">
    <link href="../visual/css/va_jquery-ui.min_css.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"type="text/css">

    <!-- links de script -->
    <script type="text/javascript" src="../complementos/js/va_jquery_js.js"></script>
    <script type="text/javascript" src="../complementos/js/va_validacaoformulariosbackend_js.js"></script>
    <script type="text/javascript" src="../complementos/js/va_confirmaracao_js.js"></script>
    <script type="text/javascript" src="../complementos/js/va_jquery-ui.min_js.js"></script>
    <script type="text/javascript" src="../complementos/js/va_auxiliar_js.js"></script>
    <script type="text/javascript" src="../complementos/js/va_calendario_js.js"></script>
    <script type="text/javascript" src="../complementos/js/va_mestredetalhes_js.js"></script>
    <script type="text/javascript">
    $(function(){
      $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true
      });
    });
  </script>
  </head>
  <body>
    <header>
      <img src="../visual/imagens/logo_escrita.png"/> <!--Logo da empresa-->
      <nav> <!--Itens do Menu da página-->
        <ul>
          <li class="dropdown">
            <a class="dropbtn">Cliente</a>
            <div class="dropdown-content">
              <a href="?pasta=clientes/&arquivo=va_fmins_clientes&ext=php">Registro de Cliente</a>
              <a href="?pasta=consultas/&arquivo=va_viscliente_consultas&ext=php">Consulta de Cliente</a>
              <a href="?pasta=historicos/&arquivo=va_hispedidocliente_historicos&ext=php">Histórico de Pedido do Cliente</a>
            </div>
          </li>
          <li class="dropdown">
            <a class="dropbtn">Produto</a>
            <div class="dropdown-content">
              <a href="?pasta=materias_primas/&arquivo=va_fmins_materias_primas&ext=php">Registro de Matéria-Prima</a>
              <a href="?pasta=categorias/&arquivo=va_fmins_categorias&ext=php">Registro de Categoria de Produto</a>
              <a href="?pasta=produtos/&arquivo=va_fmins_produtos&ext=php">Registro de Produto</a>
              <a href="?pasta=consultas/&arquivo=va_visproduto_consultas&ext=php">Consulta de Produto</a>
            </div>
          </li>
          <li class="dropdown">
            <a class="dropbtn">Pedido</a>
            <div class="dropdown-content">
              <a href="?pasta=pedidos/&arquivo=va_fmins_pedidos&ext=php">Registro de Orçamento</a>
              <a href="?pasta=consultas/&arquivo=va_visservicosrealizados_consultas&ext=php">Consulta de Serviços Realizados</a>
              <a href="?pasta=pedidos/&arquivo=va_rel_pedidos&ext=php">Relatório de Pedidos</a>
              <a href="?pasta=pedidos/&arquivo=va_ctrlorcamento_pedidos&ext=php">Controle de Orçamento</a>
              <a href="?pasta=pedidos/&arquivo=va_ctrlpedido_pedidos&ext=php">Controle de Pedidos</a>
              <a href="?pasta=consultas/&arquivo=va_vispedido_consultas&ext=php">Consulta de Pedidos</a>
            </div>
          </li>

          <?php
            if($_SESSION['permissao']==0){
            echo '<li class="dropdown">
                    <a class="dropbtn">Maquinário</a>
                    <div class="dropdown-content">
                      <a href="?pasta=maquinas/&arquivo=va_fmins_maquinas&ext=php">Registro de Máquinas</a>
                      <a href="?pasta=consultas/&arquivo=va_vismaquinas_consultas&ext=php">Consulta de Máquinas</a>
                      <a href="?pasta=historicos/&arquivo=va_hismanutencoes_historicos&ext=php">Histórico de Manutenções</a>
                    </div>
                  </li>
                  <li class="dropdown">
                    <a href="?pasta=funcionarios/&arquivo=va_fmins_funcionarios&ext=php" class="dropbtn">Funcionário</a>
                  </li>';
            }
            //notificação
            //Adicionando o modelo de data
            $hoje="20".date("y-m-d");
            //Pegando dados caso a data prevista de entrega for igual o dia atual e caso o status for entre 2 e 3
            $sql_sel_orcamentos="SELECT * FROM orcamentos WHERE data_prevista='".$hoje."' AND (status='2' OR status='3')";
            $sql_sel_orcamentos_preparado = $conexaobd->prepare($sql_sel_orcamentos);
            $sql_sel_orcamentos_preparado->execute();
          ?>
        </ul>
          <?php
            //caso exista uma data prevista para hoje mude a cor do botão
            if($sql_sel_orcamentos_preparado->rowCount()>0){
          ?>
              <a href="?pasta=pedidos/&arquivo=va_ctrlpedido_pedidos&ext=php&data=<?php echo $hoje?>" title="Produto a ser entregue"><img class="botao_notificacao" src="../visual/imagens/icone_entrega.png"/></a>
          <?php
          }else{
          ?>
            <img class="botao_notificacao" src="../visual/imagens/icone_notificacao.png"/>
          <?php
          }
          ?>
        <a href="../seguranca/autenticacao/va_logout_autenticacao.php" title="Sair"><img class="logout" src="../visual/imagens/logout.png"/></a><!--Botão para logout do software-->
      </nav>
    </header>
    <div>
      <div class="conteudo"><!--Inicio conteúdo-->
        <?php
          if(isset($_GET['pasta'])&&isset($_GET['arquivo'])&&isset($_GET['ext'])){
            if(!include $_GET['pasta'].$_GET['arquivo'].".".$_GET['ext']){
              echo "<h1>Página não encontrada!</h1>";
            }else{
              include "../seguranca/autenticacao/va_permissao_autenticacao.php";
            }
          }else{
            include "va_inicial_sistema.php";
          }
        ?>
      </div><!--Fim conteúdo-->
      <footer>
        <p>VALMOR ARTESANATO - 2016</p>
      </footer>
    </div>
  </body>
</html>
