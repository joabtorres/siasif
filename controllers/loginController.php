<?php

/**
 * A classe 'loginController' é responsável por fazer validação de login para que tenha acesso ao sistema, podendo verifica se o e-mail e valido e exibindo a opção de recupera senha, 
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe loginController
 */
class loginController extends controller {

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel por carrega a view  presente no diretorio views/login.php, além disso, ela faz validações de usuário, tenha digitado corretamento todos os campos do login e o usuário esteja registrado no banco será criado um array $_SESSION['usuario_siasif'] com os seguintes dados: nome, url da foto, nível de acesso e usuário ativo e chama a função recupera,caso usuário deseja recupera a senha.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com
     */
    public function index() {
	$view = "login";
	$dados = array();
	$_SESSION = array();
	if (isset($_POST['nEntrar']) && !empty($_POST['nEntrar'])) {
	    //recaptcha validando
	    if (!empty($_POST['nSerachUsuario']) && !empty($_POST['nSearchSenha'])) {
		$usuario = array('usuario' => addslashes($_POST['nSerachUsuario']), 'senha' => md5(sha1($_POST['nSearchSenha'])));
		$dominio = strstr($usuario['usuario'], '@');
		$usuarioModel = new usuario();
		if ($dominio) {
		    $resultado = $usuarioModel->read_specific('SELECT * FROM usuario WHERE email=:usuario AND senha=:senha AND status = 1', $usuario);
		    if (!$resultado) {
			$dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> O Campo Usuário ou Senha está incorreto!';
		    }
		} else {
		    $resultado = $usuarioModel->read_specific('SELECT * FROM usuario WHERE usuario=:usuario AND senha=:senha AND status = 1', $usuario);
		    if (!$resultado) {
			$dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> O Campo Usuário ou Senha está incorreto!';
		    }
		}
		if (!isset($dados['erro']) && empty($dados['erro'])) {
		    //inicando sessao
		    $_SESSION['usuario_siasif'] = array();
		    //codigo
		    $_SESSION['usuario_siasif']['cod'] = $resultado['cod'];
		    //nome
		    $_SESSION['usuario_siasif']['nome'] = $resultado['nome'];
		    //cod_unidade
		    $_SESSION['usuario_siasif']['unidade_cod'] = $resultado['unidade_cod'];
		    //sobrenome
		    $_SESSION['usuario_siasif']['sobrenome'] = $resultado['sobrenome'];
		    //cargo
		    $_SESSION['usuario_siasif']['cargo'] = $resultado['cargo'];
		    //img
		    $_SESSION['usuario_siasif']['imagem'] = $resultado['imagem'];
		    //nivel
		    $_SESSION['usuario_siasif']['nivel'] = $resultado['nivel_acesso'];
		    //statu
		    $_SESSION['usuario_siasif']['statu'] = $resultado['status'];
		    header("location: /home");
		}
	    } else {
		$dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> O Campo Usuário ou Senha não está preenchido!';
	    }
	}

	$this->loadView($view, $dados);

	//criando nova senha
	if (isset($_POST['nEnviar'])) {
	    $email = addslashes(trim($_POST['nEmail']));
	    $_POST = null;
	    if ($this->validar_email($email) && $this->recuperar($email)) {
		echo '<script>$("#modal_confirmacao_email").modal();</script>';
	    } else {
		echo '<script>$("#modal_invalido_email").modal();</script>';
	    }
	}
    }

    public function login404() {
	$view = "login";
	$dados = array();
	$_SESSION = array();
	if (isset($_POST['nEntrar']) && !empty($_POST['nEntrar'])) {
	    //recaptcha validando
	    if (!empty($_POST['nSerachUsuario']) && !empty($_POST['nSearchSenha'])) {
		$usuario = array('usuario' => addslashes($_POST['nSerachUsuario']), 'senha' => md5(sha1($_POST['nSearchSenha'])));
		$dominio = strstr($usuario['usuario'], '@');
		$usuarioModel = new usuario();
		if ($dominio) {
		    $resultado = $usuarioModel->read_specific('SELECT * FROM usuario WHERE email=:usuario AND senha=:senha AND status = 1', $usuario);
		    if (!$resultado) {
			$dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> O Campo Usuário ou Senha está incorreto!';
		    }
		} else {
		    $resultado = $usuarioModel->read_specific('SELECT * FROM usuario WHERE usuario=:usuario AND senha=:senha AND status = 1', $usuario);
		    if (!$resultado) {
			$dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> O Campo Usuário ou Senha está incorreto!';
		    }
		}
		if (!isset($dados['erro']) && empty($dados['erro'])) {
		    //inicando sessao
		    $_SESSION['usuario_siasif'] = array();
		    //codigo
		    $_SESSION['usuario_siasif']['cod'] = $resultado['cod'];
		    //nome
		    $_SESSION['usuario_siasif']['nome'] = $resultado['nome'];
		    //cod_unidade
		    $_SESSION['usuario_siasif']['unidade_cod'] = $resultado['unidade_cod'];
		    //sobrenome
		    $_SESSION['usuario_siasif']['sobrenome'] = $resultado['sobrenome'];
		    //cargo
		    $_SESSION['usuario_siasif']['cargo'] = $resultado['cargo'];
		    //img
		    $_SESSION['usuario_siasif']['imagem'] = $resultado['imagem'];
		    //nivel
		    $_SESSION['usuario_siasif']['nivel'] = $resultado['nivel_acesso'];
		    //statu
		    $_SESSION['usuario_siasif']['statu'] = $resultado['status'];
		    header("location: /home");
		}
	    } else {
		$dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> O Campo Usuário ou Senha não está preenchido!';
	    }
	}
	$this->loadView($view, $dados);

	//criando nova senha
	if (isset($_POST['nEnviar'])) {
	    $email = addslashes(trim($_POST['nEmail']));
	    $_POST = null;
	    if ($this->validar_email($email) && $this->recuperar($email)) {
		echo '<script>$("#modal_confirmacao_email").modal();</script>';
	    } else {
		echo '<script>$("#modal_invalido_email").modal();</script>';
	    }
	}
    }

    /**
     * Está função verifica se o usuário está cadastrado no sistema, se ele estive será criado uma nova senha e enviado para o respectivo email
     * @return bollean 
     * @access private
     * @author Joab Torres <joabtorres1508@gmail.com>
     * 
     */
    private function recuperar($email) {
	$usuarioModel = new usuario();
	$usuario = $usuarioModel->read_specific("SELECT nivel_acesso as nivel FROM usuario where email=:email", array("email" => $email));
	if ($usuario['nivel'] != 4) {
	    $senha = $usuarioModel->newpassword($email);
	    if ($senha) {
		// envia email ao usuário
		$assunto = 'SIASIF - Sistema de Gerenciamento de Afastamento para Qualificação de Servidores do IFPA';
		$destinatario = $email;
		$mensagem = '<!DOCTYPE html>
			<html lang="pt-br">
			<head>
				<meta charset="UTF-8">
				<title>' . $assunto . '</title>
			</head>
			<body>
				<div style="width: 98%;display: block;margin: 10px auto;padding: 0;font-family: sans-serif, Arial;border : 2px solid #357ca5;">
				<h3 style="background: #357ca5;color: white;padding: 10px;margin: 0;">Nova Senha! <br/> <small>' . $assunto . ' - Nova Senha</small></h3>
					<p style="padding: 10px;line-height: 30px;">
                                            Você solicitou uma nova senha de acesso ao <b>' . $assunto . '</b>, confira abaixo sua nova senha de acesso: <br/>
                                            <span style="font-weight:bold">Email: </span><span style="color: #357ca5;">' . $email . '</span><br/>
                                            <span style="font-weight:bold">Nova Senha: </span> <span style="color: #357ca5;">' . $senha . '</span><br/>
                                                 <a href="' . BASE_URL . '" style="text-decoration: none;">Carregar Página</a>
					</p>
				</div>
			</body>
			</html>';
		$assunto .= " - NOVA SENHA";
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'From: ' . $assunto . ' <joabtorres.develop@gmail.com>' . "\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();
		mail($destinatario, $assunto, $mensagem, $headers);
		return true;
	    } else {
		return false;
	    }
	} else {
	    return false;
	}
    }

    /**
     * Está função verifica  se o e-mail do usuário é valido, ou seja, se seu servido de email existe.
     * @param String $email
     * @return bollean 
     * @access private
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    private function validar_email($email) {
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	    list($usuario, $dominio) = explode("@", $email);
	    if (checkdnsrr($dominio, 'MX')) {
		return true;
	    } else {
		return false;
	    }
	} else {
	    return false;
	}
    }

}
