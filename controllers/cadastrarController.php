<?php

/**
 * A classe 'cadastrarController' é responsável para fazer o gerenciamento no cadastro de usuários, unidade, servidores, relatórios semestral, ata de defesa e prorrogação de afastamento
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2019 Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe cadastrarController
 */
class cadastrarController extends controller {

    /**
     * Está função pertence a uma action do controle MVC, ela é chama a função unidade();
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index() {
	$this->unidade();
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra a unidade e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function unidade() {
	if ($this->checkUser() >= 3) {
	    $viewName = "unidade/cadastro";
	    $dados = array();
	    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$requisicao = md5(implode($_POST));

		if (isset($_SESSION['last_request']) && $_SESSION['last_request'] == $requisicao) {
		    header("location: cadastrar/unidade");
		} else {
		    $_SESSION['last_request'] = $requisicao;
		    if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
			if (!empty($_POST['nNome'])) {
			    $crudModel = new crud_db();
			    $unidade = array('nome' => addslashes($_POST['nNome']));
			    $resultado = $crudModel->create("INSERT INTO unidade (nome) VALUES (:nome)", $unidade);
			    if ($resultado) {
				$dados['erro'] = array('class' => 'alert-success', 'msg' => '<i class="fas fa-check-double"></i> Cadastro realizado com sucesso!');
			    } else {
				$dados['unidade'] = $unidade;
			    }
			} else {
			    $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Preenchar os campos obrigatórios.');
			}
		    }
		}
	    }

	    $this->loadTemplate($viewName, $dados);
	} else {
	    header("location: home");
	}
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra uma novo servidor  e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function servidor() {
	if ($this->checkUser() >= 2) {
	    $viewName = "servidor/cadastro";
	    $dados = array();
	    $servidor = array();
	    $servidor_error = array();
	    $crudModel = new crud_db();
	    if ($this->checkUser() == 3) {
		$dados['unidades'] = $crudModel->read("SELECT * FROM unidade ORDER BY nome ASC");
	    } else{
		$dados['unidades'] = $crudModel->read("SELECT * FROM unidade WHERE cod=:cod", array('cod' => $this->checkUnidade()));
	    }


	    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$requisicao = md5(implode($_POST));
		if (isset($_SESSION['last_request']) && $_SESSION['last_request'] == $requisicao) {
		    header("location: cadastrar/servidor");
		} else {

		    if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {

			//nome
			if (isset($_POST['nNome']) && !empty($_POST['nNome'])) {
			    $servidor['nome'] = addslashes($_POST['nNome']);
			} else {
			    $servidor_error['nome']['msg'] = 'Informe o nome';
			    $servidor_error['nome']['class'] = 'has-error';
			}
			//Unidade
			$servidor['unidade_cod'] = addslashes($_POST['nUnidade']);
			//status
			$servidor['status'] = addslashes($_POST['nStatus']);

			//siape
			if (isset($_POST['nSIAPE']) && !empty($_POST['nSIAPE'])) {
			    $servidor['siape'] = addslashes($_POST['nSIAPE']);
			} else {
			    $servidor_error['siape']['msg'] = 'Informe o SIAPE';
			    $servidor_error['siape']['class'] = 'has-error';
			}
			//cpf
			if (isset($_POST['nCPF']) && !empty($_POST['nCPF'])) {
			    $servidor['cpf'] = addslashes($_POST['nCPF']);
			} else {
			    $servidor_error['cpf']['msg'] = 'Informe o CPF';
			    $servidor_error['cpf']['class'] = 'has-error';
			}
			//genero
			$servidor['genero'] = addslashes($_POST['nGenero']);
			//atuacao
			$servidor['atuacao'] = addslashes($_POST['nAtuacao']);
			//telefone
			$servidor['telefone'] = addslashes($_POST['nTelefone']);
			//email
			$servidor['email'] = addslashes($_POST['nEmail']);



			//numero do ato
			if (isset($_POST['nNumeroAto']) && !empty($_POST['nNumeroAto'])) {
			    $servidor['numero_ato'] = addslashes($_POST['nNumeroAto']);
			} else {
			    $servidor_error['numero_ato']['msg'] = 'Informe o número do ato';
			    $servidor_error['numero_ato']['class'] = 'has-error';
			}

			//tipo do ato
			$servidor['ato'] = addslashes($_POST['nATO']);
			//tipo afastamento
			$servidor['afastamento'] = addslashes($_POST['nAfastamento']);
			//tipo Categoria
			$servidor['categoria'] = addslashes($_POST['nCategoria']);
			//tipo nModalidade
			$servidor['modalidade'] = addslashes($_POST['nModalidade']);
			//tipo nModalidade
			$servidor['destino'] = addslashes($_POST['nDestino']);
			//instituicao
			$servidor['instituicao'] = addslashes($_POST['nInstituicao']);

			//data inicio
			if (isset($_POST['nInicio']) && !empty($_POST['nInicio'])) {
			    $servidor['inicio'] = addslashes($_POST['nInicio']);
			} else {
			    $servidor_error['inicio']['msg'] = 'Informe a data de Início';
			    $servidor_error['inicio']['class'] = 'has-error';
			}

			//data termino
			if (isset($_POST['nTermino']) && !empty($_POST['nTermino'])) {
			    $servidor['termino'] = addslashes($_POST['nTermino']);
			} else {
			    $servidor_error['termino']['msg'] = 'Informe a data de Término';
			    $servidor_error['termino']['class'] = 'has-error';
			}
			//imagem
			if ((isset($_FILES['tImagem-1']) && $_FILES['tImagem-1']['error'] == 0) && (empty($servidor_error))) {
			    $servidor['imagem'] = $crudModel->save_image($_FILES['tImagem-1']);
			    if (!empty($_POST['nImagemCooperado'])) {
				$crudModel->delete_file($_POST['nImagemCooperado']);
			    }
			} else {
			    $servidor['imagem'] = addslashes($_POST['nImagemCooperado']);
			}
			if (is_array($servidor_error) && !empty($servidor_error)) {
			    $dados['servidor_error'] = $servidor_error;
			    $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Preenchar os campos obrigatórios.');
			    $dados['servidor'] = $servidor;
			} else {
			    $servidor['inicio'] = $this->formatDateBD($servidor['inicio']);
			    $servidor['termino'] = $this->formatDateBD($servidor['termino']);
			    $resultado = $crudModel->create("INSERT INTO servidor(unidade_cod, siape, nome,status, cpf, genero, atuacao, telefone, email, imagem, ato, numero_ato, afastamento, categoria, modalidade, destino, instituicao, inicio, termino, cadastro) VALUES (:unidade_cod, :siape, :nome,:status, :cpf, :genero, :atuacao, :telefone, :email, :imagem, :ato, :numero_ato, :afastamento, :categoria, :modalidade, :destino, :instituicao, :inicio, :termino, now())", $servidor);

			    if ($resultado) {
				$_SESSION['last_request'] = $requisicao;
				$dados['erro'] = array('class' => 'alert-success', 'msg' => '<i class="fas fa-check-double"></i> Cadastro realizado com sucesso!');
			    } else {
				$servidor['inicio'] = $this->formatDateView($servidor['inicio']);
				$servidor['termino'] = $this->formatDateView($servidor['termino']);
				$dados['servidor'] = $servidor;
			    }
			}
		    }
		}
	    }

	    $this->loadTemplate($viewName, $dados);
	} else {
	    header("location: home");
	}
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra relatórios semestral do servidor e valida os campus preenchidos via formulário.
     * @access public
     * @param string $cod_servidor - código do servidor em md5
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function relatorio($cod_servidor) {
	if ($this->checkUser() >= 2 && !empty($cod_servidor)) {
	    $viewName = "relatorio/cadastro";
	    $dados = array();
	    $relatorio_error = array();
	    $crudModel = new crud_db();
	    $resultado = $crudModel->read_specific("SELECT * FROM servidor WHERE md5(cod)=:cod", array('cod' => $cod_servidor));
	    if (is_array($resultado) && !empty($resultado)) {
		$dados['servidor'] = $resultado;
	    } else {
		header("location: home");
	    }
	    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$requisicao = md5(implode($_POST));
		if (isset($_SESSION['last_request']) && $_SESSION['last_request'] == $requisicao) {
		    header("location: cadastrar/relatorio/" . $cod_servidor);
		} else {
		    if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
			$relatorio = array();
			//cod_servidor
			$relatorio['servidor_cod'] = addslashes($_POST['nCodServido']);
			//data
			if (isset($_POST['nData']) && !empty($_POST['nData'])) {
			    $relatorio['data'] = addslashes($_POST['nData']);
			} else {
			    $relatorio_error['data']['msg'] = 'Informe a data';
			    $relatorio_error['data']['class'] = 'has-error';
			}
			//status
			$relatorio['status'] = $_POST['nStatus'];

			//pdf
			if ((isset($_FILES['nFile']) && $_FILES['nFile']['error'] == 0) && (empty($relatorio_error))) {
			    // Tamanho máximo do arquivo (em Bytes)
			    $tamanhoPermitido = 1024 * 1024 * 1; // bMb
			    if ($tamanhoPermitido < $_FILES['nFile']['size']) {
				$relatorio_error['anexo']['msg'] = 'O arquivo enviado é muito grande, envie arquivos de até 1 MB';
				$relatorio_error['anexo']['class'] = 'has-error';
			    } else {
				$relatorio['anexo'] = $crudModel->save_pdf($_FILES['nFile']);
				if (!empty($_POST['nFileEnviado'])) {
				    $crudModel->delete_file($_POST['nFileEnviado']);
				}
			    }
			} else {
			    $relatorio['anexo'] = addslashes($_POST['nFileEnviado']);
			}
			if (is_array($relatorio_error) && !empty($relatorio_error)) {
			    $dados['relatorio_error'] = $relatorio_error;
			    $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Preenchar os campos obrigatórios.');
			    $dados['relatorio'] = $relatorio;
			} else {
			    $relatorio['data'] = $this->formatDateBD($relatorio['data']);
			    $resultado = $crudModel->create("INSERT INTO relatorio (servidor_cod, status, data, anexo) VALUES (:servidor_cod, :status, :data, :anexo) ", $relatorio);
			    if ($resultado) {
				$_SESSION['last_request'] = $requisicao;
				$dados['erro'] = array('class' => 'alert-success', 'msg' => '<i class="fas fa-check-double"></i> Cadastro realizado com sucesso!');
			    } else {
				$relatorio['data'] = $this->formatDateView($relatorio['data']);
				$dados['relatorio'] = $relatorio;
			    }
			}
		    }
		}
	    }

	    $this->loadTemplate($viewName, $dados);
	} else {
	    header("location: home");
	}
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra data de defesa do servidor e valida os campus preenchidos via formulário.
     * @access public
     * @param string $cod_servidor - código do servidor em md5
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function defesa($cod_servidor) {
	if ($this->checkUser() >= 2 && !empty($cod_servidor)) {
	    $viewName = "defesa/cadastro";
	    $dados = array();
	    $defesa_error = array();
	    $crudModel = new crud_db();
	    $resultado = $crudModel->read_specific("SELECT * FROM servidor WHERE md5(cod)=:cod", array('cod' => $cod_servidor));
	    if (is_array($resultado) && !empty($resultado)) {
		$dados['servidor'] = $resultado;
	    } else {
		header("location: home");
	    }
	    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$requisicao = md5(implode($_POST));
		if (isset($_SESSION['last_request']) && $_SESSION['last_request'] == $requisicao) {
		    header("location: cadastrar/defesa/" . $cod_servidor);
		} else {
		    if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
			$defesa = array();
			//cod_servidor
			$defesa['servidor_cod'] = addslashes($_POST['nCodServido']);
			//data
			if (isset($_POST['nData']) && !empty($_POST['nData'])) {
			    $defesa['data'] = addslashes($_POST['nData']);
			} else {
			    $defesa_error['data']['msg'] = 'Informe a data';
			    $defesa_error['data']['class'] = 'has-error';
			}
			//status
			$defesa['status'] = $_POST['nStatus'];

			//pdf
			if ((isset($_FILES['nFile']) && $_FILES['nFile']['error'] == 0) && (empty($defesa_error))) {
			    // Tamanho máximo do arquivo (em Bytes)
			    $tamanhoPermitido = 1024 * 1024 * 1; // bMb
			    if ($tamanhoPermitido < $_FILES['nFile']['size']) {
				$defesa_error['anexo']['msg'] = 'O arquivo enviado é muito grande, envie arquivos de até 1 MB';
				$defesa_error['anexo']['class'] = 'has-error';
			    } else {
				$defesa['anexo'] = $crudModel->save_pdf($_FILES['nFile']);
				if (!empty($_POST['nFileEnviado'])) {
				    $crudModel->delete_file($_POST['nFileEnviado']);
				}
			    }
			} else {
			    $defesa['anexo'] = addslashes($_POST['nFileEnviado']);
			}
			if (is_array($defesa_error) && !empty($defesa_error)) {
			    $dados['defesa_error'] = $defesa_error;
			    $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Preenchar os campos obrigatórios.');
			    $dados['defesa'] = $defesa;
			} else {
			    $defesa['data'] = $this->formatDateBD($defesa['data']);
			    $resultado = $crudModel->create("INSERT INTO defesa (servidor_cod, status, data, anexo) VALUES (:servidor_cod, :status, :data, :anexo) ", $defesa);
			    if ($resultado) {
				$_SESSION['last_request'] = $requisicao;
				$dados['erro'] = array('class' => 'alert-success', 'msg' => '<i class="fas fa-check-double"></i> Cadastro realizado com sucesso!');
			    } else {
				$defesa['data'] = $this->formatDateView($defesa['data']);
				$dados['defesa'] = $defesa;
			    }
			}
		    }
		}
	    }

	    $this->loadTemplate($viewName, $dados);
	} else {
	    header("location: home");
	}
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra prorrogação do servidor e valida os campus preenchidos via formulário.
     * @access public
     * @param string $cod_servidor - código do servidor em md5
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function prorrogacao($cod_servidor) {
	if ($this->checkUser() >= 2 && !empty($cod_servidor)) {
	    $viewName = "prorrogacao/cadastro";
	    $dados = array();
	    $prorrogacao_error = array();
	    $crudModel = new crud_db();
	    $resultado = $crudModel->read_specific("SELECT * FROM servidor WHERE md5(cod)=:cod", array('cod' => $cod_servidor));
	    if (is_array($resultado) && !empty($resultado)) {
		$dados['servidor'] = $resultado;
	    } else {
		header("location: home");
	    }
	    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$requisicao = md5(implode($_POST));

		if (isset($_SESSION['last_request']) && $_SESSION['last_request'] == $requisicao) {
		    header("location: cadastrar/prorrogacao/" . $cod_servidor);
		} else {
		    if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
			$prorrogacao = array();
			//cod servido
			$prorrogacao['servidor_cod'] = addslashes($_POST['nCodServido']);
			//numero do ato
			if (isset($_POST['nNumeroAto']) && !empty($_POST['nNumeroAto'])) {
			    $prorrogacao['numero_ato'] = addslashes($_POST['nNumeroAto']);
			} else {
			    $prorrogacao_error['numero_ato']['msg'] = 'Informe o número do ato';
			    $prorrogacao_error['numero_ato']['class'] = 'has-error';
			}

			//tipo do ato
			$prorrogacao['ato'] = addslashes($_POST['nATO']);
			//data inicio
			if (isset($_POST['nInicio']) && !empty($_POST['nInicio'])) {
			    $prorrogacao['inicio'] = addslashes($_POST['nInicio']);
			} else {
			    $prorrogacao_error['inicio']['msg'] = 'Informe a data de Início';
			    $prorrogacao_error['inicio']['class'] = 'has-error';
			}

			//data termino
			if (isset($_POST['nTermino']) && !empty($_POST['nTermino'])) {
			    $prorrogacao['termino'] = addslashes($_POST['nTermino']);
			} else {
			    $prorrogacao_error['termino']['msg'] = 'Informe a data de Término';
			    $prorrogacao_error['termino']['class'] = 'has-error';
			}

			if (is_array($prorrogacao_error) && !empty($prorrogacao_error)) {
			    $dados['prorrogacao_error'] = $prorrogacao_error;
			    $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Preenchar os campos obrigatórios.');
			    $dados['prorrogacao'] = $prorrogacao;
			} else {
			    $prorrogacao['inicio'] = $this->formatDateBD($prorrogacao['inicio']);
			    $prorrogacao['termino'] = $this->formatDateBD($prorrogacao['termino']);
			    $resultado = $crudModel->create("INSERT INTO prorrogacao (servidor_cod, inicio, termino, ato, numero_ato) VALUES (:servidor_cod,:inicio, :termino, :ato, :numero_ato) ", $prorrogacao);
			    if ($resultado) {
				$_SESSION['last_request'] = $requisicao;
				$dados['erro'] = array('class' => 'alert-success', 'msg' => '<i class="fas fa-check-double"></i> Cadastro realizado com sucesso!');
			    } else {
				$prorrogacao['inicio'] = $this->formatDateView($prorrogacao['inicio']);
				$prorrogacao['termino'] = $this->formatDateView($prorrogacao['termino']);
				$dados['prorrogacao'] = $prorrogacao;
			    }
			}
		    }
		}
	    }

	    $this->loadTemplate($viewName, $dados);
	} else {
	    header("location: home");
	}
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controle nas ações de cadastra usuario e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function usuario() {
	if ($this->checkUser() >= 3) {
	    $view = "usuario/cadastro";
	    $dados = array();
	    $usuarioModel = new usuario();
	    $crudModel = new crud_db();
	    $dados['unidades'] = $crudModel->read("SELECT * FROM unidade ORDER BY nome ASC");
	    //Array que vai armazena os dados do usuário;
	    $usuario = array();
	    if (isset($_POST['nSalvar'])) {
		//nome
		if (!empty($_POST['nNome'])) {
		    $usuario['nome'] = addslashes($_POST['nNome']);
		} else {
		    $dados['usuario_erro']['nome']['msg'] = 'Informe o nome';
		    $dados['usuario_erro']['nome']['class'] = 'has-error';
		}
		//sobrenome
		if (!empty($_POST['nSobrenome'])) {
		    $usuario['sobrenome'] = addslashes($_POST['nSobrenome']);
		} else {
		    $dados['usuario_erro']['sobrenome']['msg'] = 'Informe o sobrenome';
		    $dados['usuario_erro']['sobrenome']['class'] = 'has-error';
		}
		//usuario
		if (!empty($_POST['nUsuario'])) {
		    $usuario['usuario'] = addslashes($_POST['nUsuario']);
		    if ($usuarioModel->read_specific('SELECT * FROM usuario WHERE usuario=:usuario', array('usuario' => $usuario['usuario']))) {
			$dados['usuario_erro']['usuario']['msg'] = 'usuário já cadastrado';
			$dados['usuario_erro']['usuario']['class'] = 'has-error';
			$dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível cadastrar um usuario já cadastrado, por favor informe outro nome de usuário';
			$dados['erro']['class'] = 'alert-danger';
			$usuario['usuario'] = null;
		    }
		} else {
		    $dados['usuario_erro']['usuario']['msg'] = 'Informe o usuário';
		    $dados['usuario_erro']['usuario']['class'] = 'has-error';
		}
		//email
		if (!empty($_POST['nEmail'])) {
		    $usuario['email'] = addslashes($_POST['nEmail']);
		    if ($usuarioModel->read_specific('SELECT * FROM usuario WHERE email=:email', array('email' => $usuario['email']))) {
			$dados['usuario_erro']['email']['msg'] = 'E-mail já cadastrado';
			$dados['usuario_erro']['email']['class'] = 'has-error';
			$dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível cadastrar um e-mail já cadastrado, por favor informe outro endereço de e-mail';
			$dados['erro']['class'] = 'alert-danger';
			$usuario['email'] = null;
		    }
		} else {
		    $dados['usuario_erro']['email']['msg'] = 'Informe o e-mail';
		    $dados['usuario_erro']['email']['class'] = 'has-error';
		}
		//email
		if (!empty($_POST['nSenha']) && !empty($_POST['nRepetirSenha'])) {
		    //senha
		    if ($_POST['nSenha'] == $_POST['nRepetirSenha']) {
			$usuario['senha'] = $_POST['nSenha'];
		    } else {
			$dados['usuario_erro']['senha']['msg'] = "Os campos 'Senha' e 'Repetir Senha' não estão iguais! ";
			$dados['usuario_erro']['senha']['class'] = 'has-error';
		    }
		} else {
		    $dados['usuario_erro']['senha']['msg'] = "Os campos 'Senha' e 'Repetir Senha' devem ser preenchidos";
		    $dados['usuario_erro']['senha']['class'] = 'has-error';
		}
		//unidade
		$usuario['unidade_cod'] = addslashes($_POST['nUnidade']);
		//cargo
		if (!empty($_POST['nCargo'])) {
		    $usuario['cargo'] = addslashes($_POST['nCargo']);
		} else {
		    $dados['usuario_erro']['cargo']['msg'] = 'Informe o cargo, senão não será exibido o cargo';
		    $dados['usuario_erro']['cargo']['class'] = 'has-error';
		}
		//sexo
		$usuario['sexo'] = addslashes($_POST['nSexo']);

		//nivel de acesso
		$usuario['nivel'] = addslashes($_POST['tNivelDeAcesso']);

		//imagem
		if (isset($_FILES['tImagem-1']) && $_FILES['tImagem-1']['error'] == 0) {
		    $usuario['imagem'] = $_FILES['tImagem-1'];
		}
		if (isset($dados['usuario_erro']) && !empty($dados['usuario_erro'])) {
		    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Preencha todos os campos obrigatórios (*).';
		    $dados['erro']['class'] = 'alert-danger';
		} else {
		    $usuarioModel->create($usuario);
		    $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Cadastro realizado com sucesso!';
		    $dados['erro']['class'] = 'alert-success';
		    $_POST = array();
		}
	    }
	    $dados['usuario'] = $usuario;
	    $this->loadTemplate($view, $dados);
	} else {
	    header("location: home");
	}
    }

}
