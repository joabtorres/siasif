<?php

class feedbackController extends controller {

    public function index() {
        if ($this->checkUser() >= 1) {
            $viewName = "feedback";
            $dados = array();
            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                if (!empty($_POST['nDescricao'])) {
                    $cruddb = new usuario();
                    $usuario = $cruddb->read_specific("SELECT * FROM usuario WHERE cod=:cod", array('cod' => $_SESSION['usuario_siasif']['cod']));
                    $email = array(
                        'nome' => $usuario['nome'] . ' ' . $usuario['sobrenome'],
                        'email' => $usuario['email'],
                        'mensagem' => $_POST['nDescricao']
                    );
                    if ($this->email($email)) {
                        $dados['erro'] = array('class' => 'alert-success', 'msg' => "Email enviado com sucesso!");
                    } else {
                         $dados['erro'] = array('class' => 'alert-danger', 'msg' => "ERRO NO ENVIO DO E-MAIL!");
                    }
                } else {
                    $dados['erro'] = array('class' => 'alert-danger', 'msg' => "Informe uma descrição!");
                }
            }
            $this->loadTemplate($viewName, $dados);
        }
    }

    private function email($mensagem) {
        $assunto = 'SIASIF: Feedback de - ' . $mensagem['nome'];
        $destinatario = 'joabtorres1508@gmail.com';
        $mensagem = '<!DOCTYPE html>
			<html lang="pt-br">
			<head>
				<meta charset="UTF-8">
				<title>' . $assunto . '</title>
			</head>
			<body>
				<div style="width: 98%;display: block;margin: 10px auto;padding: 0;font-family: sans-serif, Arial;border : 2px solid #357ca5;">
				<h3 style="background: #357ca5;color: white;padding: 10px;margin: 0;">' . $assunto . '</h3>
					<p style="padding: 10px;line-height: 30px;">
                                            DE: <b>' . $mensagem['nome'] . '</b> <br/>
                                            E-mail: <b>' . $mensagem['email'] . '</b> <br/>
                                            Mensagem: <br/>' . $mensagem['mensagem'] . '
					</p>
				</div>
			</body>
			</html>';
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: ' . $assunto . ' <joabtorres.develop@gmail.com>' . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();
        if (mail($destinatario, $assunto, $mensagem, $headers)) {
            return true;
        } else {
            return false;
        }
    }

}

?>