<!DOCTYPE html>
<?php
  include "seguranca/database/va_conexao_database.php";
?>
<html>
  <head>
    <title>Valmor Artesanatos</title>
    <meta charset='utf-8'/>
    <meta name='author' content="Arthur Paiva Camilo, Henrique Werner Junkes, Matheus Leitzke e Thiago Nicolodi.">
    <link href="visual/css/va_estilo_css.css" rel="stylesheet" type="text/css">
    <link href="visual/css/va_reset_css.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <img class="logo" src="visual/imagens/logo.png"/>
    <div class="login">
      <form name="frmlogin" method="POST" action="index.php?pasta=seguranca/autenticacao/&arquivo=va_login_autenticacao&ext=php">
        <table align="center">
          <tr>
            <td>Usuário:</td>
            <td><input name="txtusuario" type="text"/></td>
          </tr>
          <tr>
            <td>Senha:</td>
            <td><input name="pwdsenha" type="password"/></td>
          </tr>
        </table>
        <button name="btnlogin" type="submit">ENTRAR</button>
      </form>
    </div>
    <?php
        if(isset($_GET['pasta'])&&isset($_GET['arquivo'])&&isset($_GET['ext'])){
          if(!include $_GET['pasta'].$_GET['arquivo'].".".$_GET['ext']){
            echo "<h1>Página não encontrada!</h1>";
          }
        }else{
          
        }
      ?>
    <footer>
      <p>VALMOR ARTESANATO - 2016</p>
    </footer>
  </body>
</html>
