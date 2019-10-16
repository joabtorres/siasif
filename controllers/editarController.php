<?php

/**
 * A classe 'editarController' é responsável para fazer o gerenciamento na edição de usuários, unidade, servidores, relatórios semestral, ata de defesa e prorrogação de afastamento
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2019, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe editarController
 */
class editarController extends controller {

    /**
     * Está função pertence a uma action do controle MVC, ela é chama a função unidade($cod);
     * @access public
     * @param string $cod - código da unidade em md5
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index($cod) {
	$this->unidade($cod);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de editar a unidade e valida os campus preenchidos via formulário.
     * @access public
     * @param string $cod - código do usuario em md5
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function unidade($cod) {
	if ($this->checkUser() >= 3 && !empty($cod)) {
	    $viewName = "unidade/edicao";
	    $dados = array();
	    $crudModel = new crud_db();
	    $resultado = $crudModel->read_specific('SELECT * FROM unidade WHERE md5(cod)=:cod', array('cod' => $cod));
	    if (is_array($resultado)) {
		$dados['unidade'] = $resultado;
	    } else {
		header("location: home");
	    }
	    if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
		if (!empty($_POST['nNome'])) {
		    $unidade = array('cod' => $_POST['nCod'], 'nome' => addslashes($_POST['nNome']));
		    $resultado = $crudModel->update("UPDATE unidade SET nome =:nome WHERE cod=:cod", $unidade);
		    if ($resultado) {
			$dados['erro'] = array('class' => 'alert-success', 'msg' => '<i class="fas fa-check-double"></i> Alteração realizada com sucesso!');
		    } else {
			$dados['unidade'] = $unidade;
		    }
		} else {
		    $dados['erro'] = array('class' => 'alert-danger', 'msg' => '<i class="fa fa-times"></i> Preenchar os campos obrigatórios.');
		}
	    }

	    $this->loadTemplate($viewName, $dados);
	} else {
	    header("location: home");
	}
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de editar uma novo servidor  e valida os campus preenchidos via formulário.
     * @access public
     * @param string $cod - código do servidor em md5
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function servidor($cod) {
	if (($this->checkUser() >= 2) && !empty($cod)) {
	    $viewName = "servidor/edicao";
	    $dados = array();
	    $servidor_error = array();
	    $crudModel = new crud_db();
	    $servidor = array();
	    if ($this->checkUser() == 3) {
		$dados['unidades'] = $crudModel->read("SELECT * FROM unidade ORDER BY nome ASC");
	    } else {
		$dados['unidades'] = $crudModel->read("SELECT * FROM unidade WHERE cod=:cod ORDER BY nome ASC", array('cod' => $this->checkUnidade()));
	    }
	    $resultado = $crudModel->read_specific("SELECT * FROM servidor WHERE md5(cod)=:cod", array('cod' => $cod));

	    if (is_array($resultado) && !empty($resultado)) {
		$resultado['inicio'] = $this->formatDateView($resultado['inicio']);
		$resultado['termino'] = $this->formatDateView($resultado['termino']);
		$dados['servidor'] = $resultado;
	    } else {
		header("location: home");
	    }
	    if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
		//cod
		$servidor['cod'] = addslashes($_POST['nCod']);
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

		    $resultado = $crudModel->create("UPDATE servidor SET nome=:nome, status=:status, unidade_cod=:unidade_cod, siape=:siape, cpf=:cpf, genero=:genero, atuacao=:atuacao, telefone=:telefone, email=:email, imagem=:imagem, ato=:ato, numero_ato=:numero_ato, afastamento=:afastamento, categoria=:categoria, modalidade=:modalidade, destino=:destino, instituicao=:instituicao, inicio=:inicio, termino=:termino WHERE cod=:cod", $servidor);

		    if ($resultado) {
			$dados['erro'] = array('class' => 'alert-success', 'msg' => '<i class="fas fa-check-double"></i> Alteração realizada com sucesso.');
		    }
		    $servidor['inicio'] = $this->formatDateView($servidor['inicio']);
		    $servidor['termino'] = $this->formatDateView($servidor['termino']);
		    $dados['servidor'] = $servidor;
		}
	    }
	    $this->loadTemplate($viewName, $dados);
	} else {
	    header("location: home");
	}
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de editar relatórios semestral do servidor e valida os campus preenchidos via formulário.
     * @access public
     * @param string $cod - código do relatorio em md5
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function relatorio($cod) {
	if ($this->checkUser() >= 2 && !empty($cod)) {
	    $viewName = "relatorio/edicao";
	    $dados = array();
	    $relatorio_error = array();
	    $crudModel = new crud_db();
	    $resultado = $crudModel->read_specific("SELECT * FROM relatorio WHERE md5(cod)=:cod", array('cod' => $cod));
	    if (is_array($resultado) && !empty($resultado)) {
		$dados['relatorio'] = $resultado;
		$dados['servidor'] = $crudModel->read_specific("SELECT * FROM servidor WHERE cod=:cod", array('cod' => $resultado['servidor_cod']));
	    } else {
		header("location: home");
	    }
	    if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
		$relatorio = array();
		//cod
		$relatorio['cod'] = addslashes($_POST['nCod']);
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
		    $resultado = $crudModel->create("UPDATE relatorio SET status=:status, data=:data, anexo=:anexo WHERE cod=:cod", $relatorio);
		    if ($resultado) {
			$dados['erro'] = array('class' => 'alert-success', 'msg' => '<i class="fas fa-check-double"></i> Alteração realizada com sucesso!');
			$dados['relatorio'] = $relatorio;
			$relatorio['data'] = $this->formatDateView($relatorio['data']);
		    }
		}
	    }
	    $this->loadTemplate($viewName, $dados);
	} else {
	    header("location: home");
	}
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de editar data de defesa do servidor e valida os campus preenchidos via formulário.
     * @access public
     * @param string $cod - código da defesa em md5
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function defesa($cod) {
	if ($this->checkUser() >= 2 && !empty($cod)) {
	    $viewName = "defesa/edicao";
	    $dados = array();
	    $defesa_error = array();
	    $crudModel = new crud_db();
	    $resultado = $crudModel->read_specific("SELECT * FROM defesa WHERE md5(cod)=:cod", array('cod' => $cod));
	    if (is_array($resultado) && !empty($resultado)) {
		$dados['defesa'] = $resultado;
		$dados['servidor'] = $crudModel->read_specific("SELECT * FROM servidor WHERE cod=:cod", array('cod' => $resultado['servidor_cod']));
	    } else {
		header("location: home");
	    }
	    if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
		$defesa = array();
		//cod
		$defesa['cod'] = addslashes($_POST['nCod']);
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
		    $resultado = $crudModel->create("UPDATE defesa SET status=:status, data=:data, anexo=:anexo WHERE cod=:cod", $defesa);
		    if ($resultado) {
			$dados['erro'] = array('class' => 'alert-success', 'msg' => '<i class="fas fa-check-double"></i> Alteração realizada com sucesso!');
			$dados['defesa'] = $defesa;
			$defesa['data'] = $this->formatDateView($defesa['data']);
		    }
		}
	    }
	    $this->loadTemplate($viewName, $dados);
	} else {
	    header("location: home");
	}
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de editar prorrogação do servidor e valida os campus preenchidos via formulário.
     * @access public
     * @param string $cod - código da prorrogação em md5
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function prorrogacao($cod) {
	if ($this->checkUser() >= 2 && !empty($cod)) {
	    $viewName = "prorrogacao/edicao";
	    $dados = array();
	    $prorrogacao_error = array();
	    $crudModel = new crud_db();
	    $resultado = $crudModel->read_specific("SELECT * FROM prorrogacao WHERE md5(cod)=:cod", array('cod' => $cod));
	    if (is_array($resultado) && !empty($resultado)) {
		$dados['prorrogacao'] = $resultado;
		$dados['servidor'] = $crudModel->read_specific("SELECT * FROM servidor WHERE cod=:cod", array('cod' => $resultado['servidor_cod']));
	    } else {
		header("location: home");
	    }
	    if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
		$prorrogacao = array();
		//cod
		$prorrogacao['cod'] = addslashes($_POST['nCod']);
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
		    $resultado = $crudModel->create("UPDATE prorrogacao SET inicio=:inicio, termino=:termino, ato=:ato, numero_ato=:numero_ato WHERE cod=:cod", $prorrogacao);
		    if ($resultado) {
			$dados['erro'] = array('class' => 'alert-success', 'msg' => '<i class="fas fa-check-double"></i> Alteração realizada com sucesso!');
			$dados['prorrogacao'] = $prorrogacao;
		    }
		}
	    }
	    $this->loadTemplate($viewName, $dados);
	} else {
	    header("location: home");
	}
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controle nas ações de editar usuario e valida os campus preenchidos via formulário.
     * @param string $cod - código do usuario em md5
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function usuario($cod) {
	if (($this->checkUser() && $cod == md5($_SESSION['usuario_siasif']['cod'])) || ($this->checkUser() >= 3)) {
	    $view = "usuario/editar";
	    $dados = array();
	    $usuarioModel = new usuario();
	    //pesquisa usuário
	    $crudModel = new crud_db();
	    $dados['unidades'] = $crudModel->read("SELECT * FROM unidade ORDER BY nome ASC");
	    $result_usuario = $usuarioModel->read_specific("SELECT * FROM usuario WHERE md5(cod)=:cod", array('cod' => addslashes(trim($cod))));
	    if ($result_usuario) {

		$dados['usuario'] = $result_usuario;

		if (isset($_POST['nSalvar'])) {
		    if ($this->checkUser() != 4) {
			//codigo
			$usuario = array('cod' => addslashes(trim($_POST['nCodUsuario'])));
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
			//sobrenome
			if (!empty($_POST['nUsuario'])) {
			    $usuario['usuario'] = addslashes($_POST['nUsuario']);
			    if ($usuarioModel->read_specific('SELECT * FROM usuario WHERE usuario=:usuario AND cod != :cod ', array('usuario' => $usuario['usuario'], 'cod' => $usuario['cod']))) {
				$dados['usuario_erro']['usuario']['msg'] = 'usuário já cadastrado';
				$dados['usuario_erro']['usuario']['class'] = 'has-error';
				$dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível alterar um usuario para um nome de usuário já cadastrado, por favor informe outro nome de usuário';
				$dados['erro']['class'] = 'alert-danger';
				$usuario['usuario'] = null;
			    }
			} else {
			    $dados['usuario_erro']['usuario']['msg'] = 'Informe o usuário';
			    $dados['usuario_erro']['usuario']['class'] = 'has-error';
			}
			//senha
			if (!empty($_POST['nSenha']) && !empty($_POST['nRepetirSenha'])) {
			    //senha
			    if ($_POST['nSenha'] == $_POST['nRepetirSenha']) {
				$usuario['senha'] = addslashes($_POST['nSenha']);
			    } else {
				$dados['usuario_erro']['senha']['msg'] = "Os campos 'Nova Senha' e 'Repetir Nova Senha' não estão iguais! ";
				$dados['usuario_erro']['senha']['class'] = 'has-error';
			    }
			}
			//unidade
			if (isset($_POST['nUnidade'])) {
			    $usuario['unidade_cod'] = addslashes($_POST['nUnidade']);
			}else{
			    $usuario['unidade_cod'] = $result_usuario['unidade_cod'];
			}

			//cargo
			if (!empty($_POST['nCargo'])) {
			    $usuario['cargo'] = addslashes($_POST['nCargo']);
			} else {
			    $dados['usuario_erro']['cargo']['msg'] = 'Informe o cargo, senão não será exibido o cargo';
			    $dados['usuario_erro']['cargo']['class'] = 'has-warning';
			}
			//sexo
			$usuario['genero'] = addslashes($_POST['nSexo']);

			//nivel de acesso
			if (!empty($_POST['tNivelDeAcesso'])) {
			    $usuario['nivel_acesso'] = addslashes($_POST['tNivelDeAcesso']);
			} else {
			    $usuario['nivel_acesso'] = $result_usuario['nivel_acesso'];
			}
			//status
			if (isset($_POST['nStatuUsuario']) && !empty($_POST['nStatuUsuario'])) {
			    $usuario['status'] = addslashes($_POST['nStatuUsuario']);
			} else {
			    $usuario['status'] = 0;
			}


			//imagem
			if (isset($_FILES['tImagem-1']) && $_FILES['tImagem-1']['error'] == 0) {
			    $usuario['imagem'] = $_FILES['tImagem-1'];
			    $usuario['img_atual'] = $result_usuario['imagem'];
			} else if (!empty($_POST['nImagem-user'])) {
			    $usuario['imagem'] = addslashes($_POST['nImagem-user']);
			} else {
			    $usuario['imagem'] = $result_usuario['imagem'];
			    $usuario['delete_img'] = true;
			}

			if (isset($dados['usuario_erro']) && !empty($dados['usuario_erro'])) {
			    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Preencha todos os campos obrigatórios (*).';
			    $dados['erro']['class'] = 'alert-danger';
			} else {
			    $resultado = $usuarioModel->update($usuario);
			    $dados['usuario'] = $resultado;

			    //SE O USUÁRIO EM EDIÇÃO E O MESMO QUE ESTÁ LOGADO NO SITEMA ELE VAI ALTERAR OS DADOS DO USUÁRIO LOGADO
			    if ($cod == md5($_SESSION['usuario_siasif']['cod']) && !empty($resultado)) {
				//nome
				$_SESSION['usuario_siasif']['nome'] = $resultado['nome'];
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
			    }

			    $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Alteração realizada com sucesso!';
			    $dados['erro']['class'] = 'alert-success';
			    $_POST = array();
			}
		    } else {
			$dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Este usuário não pode ser alterado.';
			$dados['erro']['class'] = 'alert-danger';
			$_POST = array();
		    }
		}
		$this->loadTemplate($view, $dados);
	    } else {
		header('location: home');
	    }
	} else {
	    header('location: home');
	}
    }

}
