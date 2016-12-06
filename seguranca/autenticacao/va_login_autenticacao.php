<?php
  //recebendo variaveis
  $p_usuario = $_POST['txtusuario'];
  $p_senha = $_POST['pwdsenha'];

  $dificultar_senha = md5($dificultar.$p_senha);

  if($p_usuario==""){ //fazendo a validação
		echo "<div class='login_msg'>Preencha o campo usuário.</div>";
  }else if($p_senha==""){
			echo "<div class='login_msg'>Preencha o campo senha.</div>";
		}else{

			$sql_sel_usuarios = "SELECT * FROM usuarios WHERE usuario='".addslashes($p_usuario)."' AND senha='".$dificultar_senha."' "; //Checando a compatibilidade de senha usuário
			$sql_sel_usuarios_preparado = $conexaobd->prepare($sql_sel_usuarios);
			$sql_sel_usuarios_preparado->execute();

			if($sql_sel_usuarios_preparado->rowCount()>0){//sessão que direciona para backend correto.
				$sql_sel_usuarios_dados = $sql_sel_usuarios_preparado->fetch();
				//inicia sessão
				session_start();
				//armazenando o id de usuario, para sabermos quem esta autenticando
				$_SESSION['idUsuario'] = $sql_sel_usuarios_dados['id'];
        //armazenando o nome de usuário da sessão
				$_SESSION['usuario'] = $sql_sel_usuarios_dados['usuario'];
        //armazenando a permissão do usuário dessa sessão
				$_SESSION['permissao'] = $sql_sel_usuarios_dados['permissao'];
        //armazenando o id do usuário
				$_SESSION['idSessao'] = session_id();

				if(($_SESSION['permissao']==0)||($_SESSION['permissao']==1)){
          header ('Location: sistema/va_principal_sistema.php'); //Redireciona para o backend administrador geral caso a permissão seja de adm geral
				}else{
					echo "<div class='login_msg'>Erro - Permissão errada.</div>"; // Erro, pois não deve existir permissões diferentes de 1 e 0
				}

			}else{
				echo "<div class='login_msg'>Erro - Usuário não encontrado.</div>";
			}
		}//Fecha autenticação
?>
