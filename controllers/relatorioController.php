<?php

/**
 *  classe "relatorioController"' é responsável para fazer o gerenciamento na dos relatorios unidade, servidores e geração de arquivos em pdf
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe relatorioController
 */
class relatorioController extends controller {

    /**
     * Está função pertence a uma action do controle MVC, ela chama a  função cooperados();
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index() {
	$this->unidade(1);
    }

    /**
     * Está função pertence a uma action do controle MVC, responsável para fazer uma buscar rápida, unidade ou nome do servidor.
     * @param int $page - paginação
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function buscarapida($page = 1) {
	if ($this->checkUser() >= 1) {
	    $view = "servidor/busca_rapido";
	    $dados = array();
	    $crudModel = new crud_db();
	    if (!isset($_GET['nSerachCampo']) || !isset($_GET['nSearchFinalidade'])) {
		header("location: 404");
	    }

	    if (isset($_GET['nSerachCampo']) && !empty($_GET['nSerachCampo'])) {
		$sql = "SELECT u.nome AS unidade, s.* FROM servidor AS s INNER JOIN unidade AS u WHERE u.cod=s.unidade_cod ";
		$sql_qtd = "SELECT COUNT(s.cod) AS qtd FROM servidor AS s INNER JOIN unidade AS u WHERE u.cod=s.unidade_cod ";
		switch ($_GET['nSearchFinalidade']) {
		    case "Servidor";
			$sql = $sql . " AND s.nome LIKE '%" . addslashes($_GET['nSerachCampo']) . "%' ";
			$sql_qtd = $sql_qtd . " AND s.nome LIKE '%" . addslashes($_GET['nSerachCampo']) . "%' ";
			break;
		    case "Unidade";
			$sql = $sql . " AND u.nome LIKE '%" . addslashes($_GET['nSerachCampo']) . "%' ";
			$sql_qtd = $sql_qtd . " AND u.nome LIKE '%" . addslashes($_GET['nSerachCampo']) . "%' ";
			break;
		    default :
			header("location: home");
			break;
		}
		//paginacao
		$limite = 12;
		$total_registro = $crudModel->read_specific($sql_qtd);
		$paginas = $total_registro['qtd'] / $limite;
		$indice = 0;
		$pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
		$indice = ($pagina_atual - 1) * $limite;
		$dados["paginas"] = $paginas;
		$dados["pagina_atual"] = $pagina_atual;
		$dados['metodo_buscar'] = "?nSearchFinalidade=" . $_GET['nSearchFinalidade'] . "&nSerachCampo=" . $_GET['nSerachCampo'];

		$sql = $sql . " ORDER BY s.cod ASC LIMIT $indice,$limite";
		$dados['servidores'] = $crudModel->read($sql);
	    } else {
		//paginacao
		$limite = 12;
		$total_registro = $crudModel->read_specific("SELECT COUNT(s.cod) AS qtd FROM servidor AS s INNER JOIN unidade AS u WHERE u.cod=s.unidade_cod ");
		$paginas = $total_registro['qtd'] / $limite;
		$indice = 0;
		$pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
		$indice = ($pagina_atual - 1) * $limite;
		$dados["paginas"] = $paginas;
		$dados["pagina_atual"] = $pagina_atual;
		$dados['metodo_buscar'] = "?nSearchFinalidade=" . $_GET['nSearchFinalidade'] . "&nSerachCampo=" . $_GET['nSerachCampo'];

		$dados['servidores'] = $crudModel->read("SELECT u.nome AS unidade, s.* FROM servidor AS s INNER JOIN unidade AS u WHERE u.cod=s.unidade_cod ORDER BY s.cod ASC LIMIT $indice,$limite");
	    }
	    $this->loadTemplate($view, $dados);
	} else {
	    header("location: home");
	}
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responsável para mostra todas as unidades.
     * @param int $page - paginação
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function unidade($page = 1) {
	if ($this->checkUser()) {
	    $viewName = "unidade/relatorio";
	    $dados = array();
	    $crudModel = new crud_db();
	    $array = array();
	    $dados['list_unidades'] = $crudModel->read("SELECT * FROM unidade ORDER BY nome ASC");
	    $sql_servidor = "SELECT s.*, TIMESTAMPDIFF(MONTH, s.inicio, s.termino) as qtd_total_meses, TIMESTAMPDIFF(MONTH, s.inicio, now()) as qtd_meses_atual FROM unidade as u INNER JOIN servidor AS s WHERE u.cod=s.unidade_cod ";
	    if (isset($_GET['nBuscarBT'])) {
		$parametros = "?nUnidade=" . $_GET['nUnidade'] . "&nAtuacao=" . $_GET['nAtuacao'] . "&nStatus=" . $_GET['nStatus'] . "&nTipo=" . $_GET['nTipo'] . "&nModalidade=" . $_GET['nModalidade'] . "&nCategoria=" . $_GET['nCategoria'] . "&nDestino=" . $_GET['nDestino'] . "&nInicio=" . $_GET['nInicio'] . "&nTermino=" . $_GET['nTermino'] . "&nNome=" . $_GET['nNome'] . "&nRelatorio=" . $_GET['nRelatorio'] . "&nDefesa=" . $_GET['nDefesa'] . "&nProrrogacao=" . $_GET['nProrrogacao'] . "&nModoPDF=0&nBuscarBT=BuscarBT";
		if ($_GET['nModoPDF'] == 1) {
		    $url = BASE_URL . "/relatorio/unidade_pdf" . $parametros;
		    echo "<script>window.open('$url', '_blank')</script>";
		}
		//unidade
		if (!empty($_GET['nUnidade'])) {
		    $sql = "SELECT DISTINCT(u.cod), u.nome FROM unidade as u INNER JOIN servidor AS s WHERE u.cod=s.unidade_cod ";
		    $sql = $sql . " AND u.cod=:cod ";
		    $sql_servidor .= " AND u.cod=:cod ";
		    $array['cod'] = addslashes($_GET['nUnidade']);
		} else {
		    $sql = "SELECT DISTINCT(u.cod), u.nome FROM unidade as u LEFT JOIN servidor AS s on u.cod=s.unidade_cod WHERE u.cod>0 ";
		}
		//status
		if (!empty($_GET['nStatus'])) {
		    $sql = $sql . " AND s.status=:status";
		    $sql_servidor .= " AND s.status=:status";
		    switch ($_GET['nStatus']) {
			case "Concluído":
			    $array['status'] = 1;
			    break;
			case "Afastado":
			    $array['status'] = 0;
			    break;
			default :
			    header("location: home");
			    break;
		    }
		}
		//tipo area de atuacao
		if (!empty($_GET['nAtuacao'])) {
		    $sql .= " AND s.atuacao=:atuacao ";
		    $sql_servidor .= " AND s.atuacao=:atuacao ";
		    $array['atuacao'] = addslashes($_GET['nAtuacao']);
		}
		//tipo do ato
		if (!empty($_GET['nTipo'])) {
		    $sql .= " AND s.ato=:ato ";
		    $sql_servidor .= " AND s.ato=:ato ";
		    $array['ato'] = addslashes($_GET['nTipo']);
		}
		//modalidade
		if (!empty($_GET['nModalidade'])) {
		    $sql .= " AND s.modalidade=:modalidade ";
		    $sql_servidor .= " AND s.modalidade=:modalidade ";
		    $array['modalidade'] = addslashes($_GET['nModalidade']);
		}
		//categoria
		if (!empty($_GET['nCategoria'])) {
		    $sql .= " AND s.categoria=:categoria ";
		    $sql_servidor .= " AND s.categoria=:categoria ";
		    $array['categoria'] = addslashes($_GET['nCategoria']);
		}
		//modalidade
		if (!empty($_GET['nDestino'])) {
		    $sql .= " AND s.destino=:destino ";
		    $sql_servidor .= " AND s.destino=:destino ";
		    $array['destino'] = addslashes($_GET['nDestino']);
		}
		if (!empty($_GET['nInicio'])) {
		    $sql .= " AND s.inicio LIKE '%" . $this->formatDateBD(addslashes($_GET['nInicio'])) . "%' ";
		    $sql_servidor .= " AND s.inicio LIKE '%" . $this->formatDateBD(addslashes($_GET['nInicio'])) . "%' ";
		}
		if (!empty($_GET['nTermino'])) {
		    $sql .= " AND s.termino LIKE '%" . $this->formatDateBD(addslashes($_GET['nTermino'])) . "%' ";
		    $sql_servidor .= " AND s.termino LIKE '%" . $this->formatDateBD(addslashes($_GET['nTermino'])) . "%' ";
		}
		if (!empty($_GET['nNome'])) {
		    $sql .= " AND s.nome LIKE '%" . addslashes($_GET['nNome']) . "%' ";
		    $sql_servidor .= " AND s.nome LIKE '%" . addslashes($_GET['nNome']) . "%' ";
		}

		//paginacao
		$limite = 4;
		$total_registro = $crudModel->read($sql, $array);
		$paginas = count($total_registro) / $limite;
		$indice = 0;
		$pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
		$indice = ($pagina_atual - 1) * $limite;
		$dados["paginas"] = $paginas;
		$dados["pagina_atual"] = $pagina_atual;
		$dados['metodo_buscar'] = $parametros;
		$sql .= " LIMIT $indice,$limite ";
		$unidades = $crudModel->read($sql, $array);
	    } else {
		//paginacao
		$limite = 4;
		$total_registro = $crudModel->read_specific("SELECT COUNT(cod) AS qtd FROM unidade");
		$paginas = $total_registro['qtd'] / $limite;
		$indice = 0;
		$pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
		$indice = ($pagina_atual - 1) * $limite;
		$dados["paginas"] = $paginas;
		$dados["pagina_atual"] = $pagina_atual;
		$dados['metodo_buscar'] = "";
		$unidades = $crudModel->read("SELECT * FROM unidade ORDER BY cod ASC LIMIT $indice,$limite");
	    }
	    if (!empty($unidades)) {
		foreach ($unidades as $indice => $key) {
		    if (is_array($array) && !empty($array)) {
			$data = $array;
			if (!isset($array['cod'])) {
			    $sql_servidor .= " AND u.cod=:cod";
			    $data['cod'] = $key['cod'];
			}
		    } else {
			$sql_servidor .= " AND u.cod=:cod";
			$data = array('cod' => $key['cod']);
		    }

		    $resultado = $crudModel->read($sql_servidor, $data);
		    if (is_array($resultado)) {
			foreach ($resultado as $indice2 => $key2) {
			    $qtd_total_meses = $key2['qtd_total_meses'];
			    $qtd_meses_atual = $key2['qtd_meses_atual'];
			    $qtd_relatorio = $crudModel->read_specific("SELECT count(cod) as qtd FROM relatorio WHERE servidor_cod=:cod AND status=1", array('cod' => $key2['cod']));
			    $qtd_relatorio = isset($qtd_relatorio['qtd']) ? $qtd_relatorio['qtd'] : 0;
			    $qtd_minima_relatorio = ($qtd_meses_atual <= $qtd_total_meses) ? round($qtd_meses_atual / 6) : round($qtd_total_meses / 6);


			    if ($qtd_relatorio >= $qtd_minima_relatorio) {
				$resultado[$indice2]['relatorio'] = "Em dias";
			    } else {
				$resultado[$indice2]['relatorio'] = "Pendente";
			    }
			    $defesa = $crudModel->read_specific("SELECT count(cod) as qtd FROM defesa WHERE servidor_cod=:cod AND status=1", array('cod' => $key2['cod']));
			    $prorrogacao = $crudModel->read_specific("SELECT count(cod) as qtd FROM prorrogacao WHERE servidor_cod=:cod", array('cod' => $key2['cod']));
			    $resultado[$indice2]['defesa'] = (is_array($defesa) && $defesa['qtd'] >= 1) ? "Entregue" : "Pendente";
			    $resultado[$indice2]['prorrogacao'] = (is_array($prorrogacao) && $prorrogacao['qtd'] >= 1) ? "Solicitada" : "Não solicitada";

			    //verifica tipo de relatórios
			    if (isset($_GET['nRelatorio']) && !empty($_GET['nRelatorio'])) {
				switch ($_GET['nRelatorio']) {
				    case "Em dias";
					if ($resultado[$indice2]['relatorio'] == "Pendente") {
					    unset($resultado[$indice2]);
					}
					break;
				    case "Pendente":
					if ($resultado[$indice2]['relatorio'] != "Pendente") {
					    unset($resultado[$indice2]);
					}
					break;
				}
			    }
			    if (isset($_GET['nDefesa']) && !empty($_GET['nDefesa'])) {
				switch ($_GET['nDefesa']) {
				    case "Entregue";
					if ($resultado[$indice2]['defesa'] == "Pendente") {
					    unset($resultado[$indice2]);
					}
					break;
				    case "Pendente":
					if ($resultado[$indice2]['defesa'] != "Pendente") {
					    unset($resultado[$indice2]);
					}
					break;
				}
			    }
			    if (isset($_GET['nProrrogacao']) && !empty($_GET['nProrrogacao'])) {
				switch ($_GET['nProrrogacao']) {
				    case "Solicitada";
					if ($resultado[$indice2]['prorrogacao'] != "Solicitada") {
					    unset($resultado[$indice2]);
					}
					break;
				    default:
					if ($resultado[$indice2]['prorrogacao'] == "Solicitada") {
					    unset($resultado[$indice2]);
					}
					break;
				}
			    }
			}
		    }
		    if (is_array($resultado)) {
			$unidades[$indice]['servidor'] = $resultado;
		    }
		}
	    }
	    $dados['unidades'] = $unidades;
	    $this->loadTemplate($viewName, $dados);
	} else {
	    header("location: home");
	}
    }

    /**
     * Está função pertence a uma action do controle MVC, responsável para fazer uma buscar rápida, por nz ou nome.
     * @param int $page - paginação
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function servidor($page = 1) {
	if ($this->checkUser()) {
	    $viewName = "servidor/relatorio";
	    $dados = array();
	    $crudModel = new crud_db();
	    $array = array();
	    $sql_servidor = "SELECT s.*, TIMESTAMPDIFF(MONTH, s.inicio, s.termino) as qtd_total_meses, TIMESTAMPDIFF(MONTH, s.inicio, now()) as qtd_meses_atual FROM unidade as u INNER JOIN servidor AS s WHERE u.cod=s.unidade_cod ";
	    $dados['list_unidades'] = $crudModel->read("SELECT * FROM unidade ORDER BY nome ASC");
	    if (isset($_GET['nBuscarBT'])) {
		$parametros = "?nUnidade=" . $_GET['nUnidade'] . "&nAtuacao=" . $_GET['nAtuacao'] . "&nStatus=" . $_GET['nStatus'] . "&nTipo=" . $_GET['nTipo'] . "&nModalidade=" . $_GET['nModalidade'] . "&nCategoria=" . $_GET['nCategoria'] . "&nDestino=" . $_GET['nDestino'] . "&nInicio=" . $_GET['nInicio'] . "&nTermino=" . $_GET['nTermino'] . "&nNome=" . $_GET['nNome'] . "&nRelatorio=" . $_GET['nRelatorio'] . "&nDefesa=" . $_GET['nDefesa'] . "&nProrrogacao=" . $_GET['nProrrogacao'] . "&nModoPDF=" . $_GET['nModoPDF'] . "&nBuscarBT=BuscarBT";
		if ($_GET['nModoPDF'] == 1) {
		    $url = BASE_URL . "/relatorio/relatorio_pdf" . $parametros;
		    echo "<script>window.open('$url', '_blank')</script>";
		}
		//unidade
		if (!empty($_GET['nUnidade'])) {
		    $sql_servidor .= " AND u.cod=:cod ";
		    $array['cod'] = addslashes($_GET['nUnidade']);
		}
		//status
		if (!empty($_GET['nStatus'])) {
		    $sql_servidor .= " AND s.status=:status";
		    switch ($_GET['nStatus']) {
			case "Concluído":
			    $array['status'] = 1;
			    break;
			case "Afastado":
			    $array['status'] = 0;
			    break;
			default :
			    header("location: home");
			    break;
		    }
		}
		//tipo servidor
		if (!empty($_GET['nAtuacao'])) {
		    $sql_servidor .= " AND s.atuacao=:atuacao ";
		    $array['atuacao'] = addslashes($_GET['nAtuacao']);
		}
		//tipo do ato
		if (!empty($_GET['nTipo'])) {
		    $sql_servidor .= " AND s.ato=:ato ";
		    $array['ato'] = addslashes($_GET['nTipo']);
		}
		//modalidade
		if (!empty($_GET['nModalidade'])) {
		    $sql_servidor .= " AND s.modalidade=:modalidade ";
		    $array['modalidade'] = addslashes($_GET['nModalidade']);
		}
		//modalidade
		if (!empty($_GET['nDestino'])) {
		    $sql_servidor .= " AND s.destino=:destino ";
		    $array['destino'] = addslashes($_GET['nDestino']);
		}
		//categoria
		if (!empty($_GET['nCategoria'])) {
		    $sql_servidor .= " AND s.categoria=:categoria ";
		    $array['categoria'] = addslashes($_GET['nCategoria']);
		}
		if (!empty($_GET['nInicio'])) {
		    $sql_servidor .= " AND s.inicio LIKE '%" . $this->formatDateBD(addslashes($_GET['nInicio'])) . "%' ";
		}
		if (!empty($_GET['nTermino'])) {
		    $sql_servidor .= " AND s.termino LIKE '%" . $this->formatDateBD(addslashes($_GET['nTermino'])) . "%' ";
		}
		if (!empty($_GET['nNome'])) {
		    $sql_servidor .= " AND s.nome LIKE '%" . addslashes($_GET['nNome']) . "%' ";
		}
		//paginacao
		$limite = 30;
		$total_registro = $crudModel->read($sql_servidor, $array);
		$paginas = count($total_registro) / $limite;
		$indice = 0;
		$pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
		$indice = ($pagina_atual - 1) * $limite;
		$dados["paginas"] = $paginas;
		$dados["pagina_atual"] = $pagina_atual;
		$dados['metodo_buscar'] = $parametros;
		$sql_servidor .= " LIMIT $indice,$limite ";
		$servidores = $crudModel->read($sql_servidor, $array);
	    } else {
		//paginacao
		$limite = 30;
		$total_registro = $crudModel->read_specific("SELECT COUNT(cod) AS qtd FROM servidor");
		$paginas = $total_registro['qtd'] / $limite;
		$indice = 0;
		$pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
		$indice = ($pagina_atual - 1) * $limite;
		$dados["paginas"] = $paginas;
		$dados["pagina_atual"] = $pagina_atual;
		$dados['metodo_buscar'] = "";
		$sql_servidor .= "LIMIT $indice,$limite";
		$servidores = $crudModel->read($sql_servidor);
	    }
	    if (is_array($servidores) && !empty($servidores)) {
		foreach ($servidores as $indice => $key) {
		    $qtd_total_meses = $key['qtd_total_meses'];
		    $qtd_meses_atual = $key['qtd_meses_atual'];
		    $qtd_relatorio = $crudModel->read_specific("SELECT count(cod) as qtd FROM relatorio WHERE servidor_cod=:cod AND status=1", array('cod' => $key['cod']));
		    $qtd_relatorio = isset($qtd_relatorio['qtd']) ? $qtd_relatorio['qtd'] : 0;
		    $qtd_minima_relatorio = ($qtd_meses_atual <= $qtd_total_meses) ? round($qtd_meses_atual / 6) : round($qtd_total_meses / 6);


		    if ($qtd_relatorio >= $qtd_minima_relatorio) {
			$servidores[$indice]['relatorio'] = "Em dias";
		    } else {
			$servidores[$indice]['relatorio'] = "Pendente";
		    }
		    $defesa = $crudModel->read_specific("SELECT count(cod) as qtd FROM defesa WHERE servidor_cod=:cod AND status=1", array('cod' => $key['cod']));
		    $prorrogacao = $crudModel->read_specific("SELECT count(cod) as qtd FROM prorrogacao WHERE servidor_cod=:cod", array('cod' => $key['cod']));
		    $servidores[$indice]['defesa'] = (is_array($defesa) && $defesa['qtd'] >= 1) ? "Entregue" : "Pendente";
		    $servidores[$indice]['prorrogacao'] = (is_array($prorrogacao) && $prorrogacao['qtd'] >= 1) ? "Solicitada" : "Não solicitada";

		    //verifica tipo de relatórios
		    if (isset($_GET['nRelatorio']) && !empty($_GET['nRelatorio'])) {
			switch ($_GET['nRelatorio']) {
			    case "Em dias";
				if ($servidores[$indice]['relatorio'] == "Pendente") {
				    unset($servidores[$indice]);
				}
				break;
			    case "Pendente":
				if ($servidores[$indice]['relatorio'] != "Pendente") {
				    unset($servidores[$indice]);
				}
				break;
			}
		    }
		    if (isset($_GET['nDefesa']) && !empty($_GET['nDefesa'])) {
			switch ($_GET['nDefesa']) {
			    case "Entregue";
				if ($servidores[$indice]['defesa'] == "Pendente") {
				    unset($servidores[$indice]);
				}
				break;
			    case "Pendente":
				if ($servidores[$indice]['defesa'] != "Pendente") {
				    unset($servidores[$indice]);
				}
				break;
			}
		    }
		    if (isset($_GET['nProrrogacao']) && !empty($_GET['nProrrogacao'])) {
			switch ($_GET['nProrrogacao']) {
			    case "Solicitada";
				if ($servidores[$indice]['prorrogacao'] != "Solicitada") {
				    unset($servidores[$indice]);
				}
				break;
			    default:
				if ($servidores[$indice]['prorrogacao'] == "Solicitada") {
				    unset($servidores[$indice]);
				}
				break;
			}
		    }
		}
	    }
	    $dados['servidores'] = $servidores;
	    date_default_timezone_set('America/Sao_Paulo');
	    $this->loadTemplate($viewName, $dados);
	} else {
	    header("location: home");
	}
    }

    public function relatorio_pdf() {
	if ($this->checkUser()) {
	    $viewName = "servidor/relatorio_pdf";
	    $dados = array();
	    $crudModel = new crud_db();
	    $data = array();
	    $consulta = array();
	    $sql_servidor = "SELECT s.*, TIMESTAMPDIFF(MONTH, s.inicio, s.termino) as qtd_total_meses, TIMESTAMPDIFF(MONTH, s.inicio, now()) as qtd_meses_atual FROM unidade as u INNER JOIN servidor AS s WHERE u.cod=s.unidade_cod ";
	    if (isset($_GET['nBuscarBT'])) {

		//unidade
		if (!empty($_GET['nUnidade'])) {
		    $sql_servidor .= " AND u.cod=:cod ";
		    $data['cod'] = addslashes($_GET['nUnidade']);
		}
		//status
		if (!empty($_GET['nStatus'])) {
		    $sql_servidor .= " AND s.status=:status";
		    switch ($_GET['nStatus']) {
			case "Concluído":
			    $data['status'] = 1;
			    break;
			case "Afastado":
			    $data['status'] = 0;
			    break;
			default :
			    header("location: home");
			    break;
		    }
		}
		//tipo servidor
		if (!empty($_GET['nAtuacao'])) {
		    $sql_servidor .= " AND s.atuacao=:atuacao ";
		    $data['atuacao'] = addslashes($_GET['nAtuacao']);
		}
		//tipo do ato
		if (!empty($_GET['nTipo'])) {
		    $sql_servidor .= " AND s.ato=:ato ";
		    $data['ato'] = addslashes($_GET['nTipo']);
		}
		//modalidade
		if (!empty($_GET['nModalidade'])) {
		    $sql_servidor .= " AND s.modalidade=:modalidade ";
		    $data['modalidade'] = addslashes($_GET['nModalidade']);
		}
		//categoria
		if (!empty($_GET['nCategoria'])) {
		    $sql_servidor .= " AND s.categoria=:categoria ";
		    $data['categoria'] = addslashes($_GET['nCategoria']);
		}
		//categoria
		if (!empty($_GET['nDestino'])) {
		    $sql_servidor .= " AND s.destino=:destino ";
		    $data['destino'] = addslashes($_GET['nDestino']);
		}
		if (!empty($_GET['nInicio'])) {
		    $sql_servidor .= " AND s.inicio LIKE '%" . $this->formatDateBD(addslashes($_GET['nInicio'])) . "%' ";
		}
		if (!empty($_GET['nTermino'])) {
		    $sql_servidor .= " AND s.termino LIKE '%" . $this->formatDateBD(addslashes($_GET['nTermino'])) . "%' ";
		}
		if (!empty($_GET['nNome'])) {
		    $sql_servidor .= " AND s.nome LIKE '%" . addslashes($_GET['nNome']) . "%' ";
		}

		$consulta['cod'] = $data['cod'];
		$consulta['status'] = addslashes($_GET['nStatus']);
		$consulta['atuacao'] = addslashes($_GET['nAtuacao']);
		$consulta['ato'] = addslashes($_GET['nTipo']);
		$consulta['modalidade'] = addslashes($_GET['nModalidade']);
		$consulta['categoria'] = addslashes($_GET['nCategoria']);
		$consulta['destino'] = addslashes($_GET['nDestino']);
		$consulta['inicio'] = addslashes($_GET['nInicio']);
		$consulta['termino'] = addslashes($_GET['nTermino']);
		$consulta['nome'] = addslashes($_GET['nNome']);
		$consulta['defesa'] = addslashes($_GET['nDefesa']);
		$consulta['relatorio'] = addslashes($_GET['nRelatorio']);
		$consulta['prorrogacao'] = addslashes($_GET['nProrrogacao']);
		$servidores = $crudModel->read($sql_servidor, $data);
	    } else {
		$servidores = $crudModel->read($sql_servidor);
	    }
	    if (is_array($servidores) && !empty($servidores)) {
		foreach ($servidores as $indice => $key) {
		    $qtd_total_meses = $key['qtd_total_meses'];
		    $qtd_meses_atual = $key['qtd_meses_atual'];
		    $qtd_relatorio = $crudModel->read_specific("SELECT count(cod) as qtd FROM relatorio WHERE servidor_cod=:cod AND status=1", array('cod' => $key['cod']));
		    $qtd_relatorio = isset($qtd_relatorio['qtd']) ? $qtd_relatorio['qtd'] : 0;
		    $qtd_minima_relatorio = ($qtd_meses_atual <= $qtd_total_meses) ? round($qtd_meses_atual / 6) : round($qtd_total_meses / 6);


		    if ($qtd_relatorio >= $qtd_minima_relatorio) {
			$servidores[$indice]['relatorio'] = "Em dias";
		    } else {
			$servidores[$indice]['relatorio'] = "Pendente";
		    }
		    $defesa = $crudModel->read_specific("SELECT count(cod) as qtd FROM defesa WHERE servidor_cod=:cod AND status=1", array('cod' => $key['cod']));
		    $prorrogacao = $crudModel->read_specific("SELECT count(cod) as qtd FROM prorrogacao WHERE servidor_cod=:cod", array('cod' => $key['cod']));
		    $servidores[$indice]['defesa'] = (is_array($defesa) && $defesa['qtd'] >= 1) ? "Entregue" : "Pendente";
		    $servidores[$indice]['prorrogacao'] = (is_array($prorrogacao) && $prorrogacao['qtd'] >= 1) ? "Solicitada" : "Não solicitada";

		    //verifica tipo de relatórios
		    if (isset($_GET['nRelatorio']) && !empty($_GET['nRelatorio'])) {
			switch ($_GET['nRelatorio']) {
			    case "Em dias";
				if ($servidores[$indice]['relatorio'] == "Pendente") {
				    unset($servidores[$indice]);
				}
				break;
			    case "Pendente":
				if ($servidores[$indice]['relatorio'] != "Pendente") {
				    unset($servidores[$indice]);
				}
				break;
			}
		    }
		    if (isset($_GET['nDefesa']) && !empty($_GET['nDefesa'])) {
			switch ($_GET['nDefesa']) {
			    case "Entregue";
				if ($servidores[$indice]['defesa'] == "Pendente") {
				    unset($servidores[$indice]);
				}
				break;
			    case "Pendente":
				if ($servidores[$indice]['defesa'] != "Pendente") {
				    unset($servidores[$indice]);
				}
				break;
			}
		    }
		    if (isset($_GET['nProrrogacao']) && !empty($_GET['nProrrogacao'])) {
			switch ($_GET['nProrrogacao']) {
			    case "Solicitada";
				if ($servidores[$indice]['prorrogacao'] != "Solicitada") {
				    unset($servidores[$indice]);
				}
				break;
			    default:
				if ($servidores[$indice]['prorrogacao'] == "Solicitada") {
				    unset($servidores[$indice]);
				}
				break;
			}
		    }
		}
	    }
	    if (isset($consulta['cod']) && !empty($consulta['cod'])) {
		$resultado = $crudModel->read_specific("SELECT nome FROM unidade WHERE cod=:cod", array('cod' => $data['cod']));
		$consulta['unidade'] = $resultado['nome'];
	    }

	    $dados['consulta'] = $consulta;
	    $dados['servidores'] = $servidores;
	    $this->loadView($viewName, $dados);
	} else {
	    header("location: home");
	}
    }

    public function unidade_pdf() {
	if ($this->checkUser()) {
	    $viewName = "unidade/relatorio_pdf";
	    $dados = array();
	    $crudModel = new crud_db();
	    $array = array();
	    $consulta = array();
	    $sql_servidor = "SELECT s.*, TIMESTAMPDIFF(MONTH, s.inicio, s.termino) as qtd_total_meses, TIMESTAMPDIFF(MONTH, s.inicio, now()) as qtd_meses_atual FROM unidade as u INNER JOIN servidor AS s WHERE u.cod=s.unidade_cod ";
	    if (isset($_GET['nBuscarBT'])) {

		//unidade
		if (!empty($_GET['nUnidade'])) {
		    $sql = "SELECT DISTINCT(u.cod), u.nome FROM unidade as u INNER JOIN servidor AS s WHERE u.cod=s.unidade_cod ";
		    $sql = $sql . " AND u.cod=:cod ";
		    $sql_servidor .= " AND u.cod=:cod ";
		    $array['cod'] = addslashes($_GET['nUnidade']);
		} else {
		    $sql = "SELECT DISTINCT(u.cod), u.nome FROM unidade as u LEFT JOIN servidor AS s on u.cod=s.unidade_cod WHERE u.cod>0 ";
		}
		//status
		if (!empty($_GET['nStatus'])) {
		    $sql = $sql . " AND s.status=:status";
		    $sql_servidor .= " AND s.status=:status";
		    switch ($_GET['nStatus']) {
			case "Concluído":
			    $array['status'] = 1;
			    break;
			case "Afastado":
			    $array['status'] = 0;
			    break;
			default :
			    header("location: home");
			    break;
		    }
		}
		//tipo area de atuacao
		if (!empty($_GET['nAtuacao'])) {
		    $sql .= " AND s.atuacao=:atuacao ";
		    $sql_servidor .= " AND s.atuacao=:atuacao ";
		    $array['atuacao'] = addslashes($_GET['nAtuacao']);
		}
		//tipo do ato
		if (!empty($_GET['nTipo'])) {
		    $sql .= " AND s.ato=:ato ";
		    $sql_servidor .= " AND s.ato=:ato ";
		    $array['ato'] = addslashes($_GET['nTipo']);
		}
		//modalidade
		if (!empty($_GET['nModalidade'])) {
		    $sql .= " AND s.modalidade=:modalidade ";
		    $sql_servidor .= " AND s.modalidade=:modalidade ";
		    $array['modalidade'] = addslashes($_GET['nModalidade']);
		}
		//categoria
		if (!empty($_GET['nCategoria'])) {
		    $sql .= " AND s.categoria=:categoria ";
		    $sql_servidor .= " AND s.categoria=:categoria ";
		    $array['categoria'] = addslashes($_GET['nCategoria']);
		}
		//modalidade
		if (!empty($_GET['nDestino'])) {
		    $sql .= " AND s.destino=:destino ";
		    $sql_servidor .= " AND s.destino=:destino ";
		    $array['destino'] = addslashes($_GET['nDestino']);
		}
		if (!empty($_GET['nInicio'])) {
		    $sql .= " AND s.inicio LIKE '%" . $this->formatDateBD(addslashes($_GET['nInicio'])) . "%' ";
		    $sql_servidor .= " AND s.inicio LIKE '%" . $this->formatDateBD(addslashes($_GET['nInicio'])) . "%' ";
		}
		if (!empty($_GET['nTermino'])) {
		    $sql .= " AND s.termino LIKE '%" . $this->formatDateBD(addslashes($_GET['nTermino'])) . "%' ";
		    $sql_servidor .= " AND s.termino LIKE '%" . $this->formatDateBD(addslashes($_GET['nTermino'])) . "%' ";
		}
		if (!empty($_GET['nNome'])) {
		    $sql .= " AND s.nome LIKE '%" . addslashes($_GET['nNome']) . "%' ";
		    $sql_servidor .= " AND s.nome LIKE '%" . addslashes($_GET['nNome']) . "%' ";
		}

		$consulta['cod'] = addslashes($_GET['nUnidade']);
		$consulta['status'] = addslashes($_GET['nStatus']);
		$consulta['atuacao'] = addslashes($_GET['nAtuacao']);
		$consulta['ato'] = addslashes($_GET['nTipo']);
		$consulta['modalidade'] = addslashes($_GET['nModalidade']);
		$consulta['categoria'] = addslashes($_GET['nCategoria']);
		$consulta['destino'] = addslashes($_GET['nDestino']);
		$consulta['inicio'] = addslashes($_GET['nInicio']);
		$consulta['termino'] = addslashes($_GET['nTermino']);
		$consulta['nome'] = addslashes($_GET['nNome']);
		$consulta['defesa'] = addslashes($_GET['nDefesa']);
		$consulta['relatorio'] = addslashes($_GET['nRelatorio']);
		$consulta['prorrogacao'] = addslashes($_GET['nProrrogacao']);
		$unidades = $crudModel->read($sql, $array);
	    } else {
		$unidades = $crudModel->read("SELECT * FROM unidade ORDER BY cod ASC");
	    }
	    if (!empty($unidades)) {
		foreach ($unidades as $indice => $key) {
		    if (is_array($array) && !empty($array)) {
			$data = $array;
			if (!isset($array['cod'])) {
			    $sql_servidor .= " AND u.cod=:cod";
			    $data['cod'] = $key['cod'];
			}
		    } else {
			$sql_servidor .= " AND u.cod=:cod";
			$data = array('cod' => $key['cod']);
		    }

		    $resultado = $crudModel->read($sql_servidor, $data);
		    if (is_array($resultado)) {
			foreach ($resultado as $indice2 => $key2) {
			    $qtd_total_meses = $key2['qtd_total_meses'];
			    $qtd_meses_atual = $key2['qtd_meses_atual'];
			    $qtd_relatorio = $crudModel->read_specific("SELECT count(cod) as qtd FROM relatorio WHERE servidor_cod=:cod AND status=1", array('cod' => $key2['cod']));
			    $qtd_relatorio = isset($qtd_relatorio['qtd']) ? $qtd_relatorio['qtd'] : 0;
			    $qtd_minima_relatorio = ($qtd_meses_atual <= $qtd_total_meses) ? round($qtd_meses_atual / 6) : round($qtd_total_meses / 6);


			    if ($qtd_relatorio >= $qtd_minima_relatorio) {
				$resultado[$indice2]['relatorio'] = "Em dias";
			    } else {
				$resultado[$indice2]['relatorio'] = "Pendente";
			    }
			    $defesa = $crudModel->read_specific("SELECT count(cod) as qtd FROM defesa WHERE servidor_cod=:cod AND status=1", array('cod' => $key2['cod']));
			    $prorrogacao = $crudModel->read_specific("SELECT count(cod) as qtd FROM prorrogacao WHERE servidor_cod=:cod", array('cod' => $key2['cod']));
			    $resultado[$indice2]['defesa'] = (is_array($defesa) && $defesa['qtd'] >= 1) ? "Entregue" : "Pendente";
			    $resultado[$indice2]['prorrogacao'] = (is_array($prorrogacao) && $prorrogacao['qtd'] >= 1) ? "Solicitada" : "Não solicitada";

			    //verifica tipo de relatórios
			    if (isset($_GET['nRelatorio']) && !empty($_GET['nRelatorio'])) {
				switch ($_GET['nRelatorio']) {
				    case "Em dias";
					if ($resultado[$indice2]['relatorio'] == "Pendente") {
					    unset($resultado[$indice2]);
					}
					break;
				    case "Pendente":
					if ($resultado[$indice2]['relatorio'] != "Pendente") {
					    unset($resultado[$indice2]);
					}
					break;
				}
			    }
			    if (isset($_GET['nDefesa']) && !empty($_GET['nDefesa'])) {
				switch ($_GET['nDefesa']) {
				    case "Entregue";
					if ($resultado[$indice2]['defesa'] == "Pendente") {
					    unset($resultado[$indice2]);
					}
					break;
				    case "Pendente":
					if ($resultado[$indice2]['defesa'] != "Pendente") {
					    unset($resultado[$indice2]);
					}
					break;
				}
			    }
			    if (isset($_GET['nProrrogacao']) && !empty($_GET['nProrrogacao'])) {
				switch ($_GET['nProrrogacao']) {
				    case "Solicitada";
					if ($resultado[$indice2]['prorrogacao'] != "Solicitada") {
					    unset($resultado[$indice2]);
					}
					break;
				    default:
					if ($resultado[$indice2]['prorrogacao'] == "Solicitada") {
					    unset($resultado[$indice2]);
					}
					break;
				}
			    }
			}
		    }
		    if (is_array($resultado)) {
			$unidades[$indice]['servidor'] = $resultado;
		    }
		}
	    }

	    if (isset($consulta['cod']) && !empty($consulta['cod'])) {
		$resultado = $crudModel->read_specific("SELECT nome FROM unidade WHERE cod=:cod", array('cod' => $array['cod']));
		$consulta['unidade'] = $resultado['nome'];
	    }
	    $dados['consulta'] = $consulta;
	    $dados['unidades'] = $unidades;
	    $this->loadView($viewName, $dados);
	} else {
	    header("location: home");
	}
    }

}
