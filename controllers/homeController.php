<?php

/**
 * A classe 'homeController' é responsável para fazer o carregamento da página home do sistema
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2019, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe homeController
 */
class homeController extends controller {

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel por carrega a view  presente no diretorio views/home.php, desde que o usuário esteja logado no sistema
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index() {
	if ($this->checkUser() >= 1) {
	    $view = "home";
	    $dados = array();
	    $crudModel = new crud_db();
	    $dados['modalidade'] = $crudModel->read("SELECT modalidade, count(cod) as qtd FROM servidor WHERE status = 0 GROUP BY modalidade");
	    $dados['relatorio'] = $this->statusRelatorio();
	    $dados['categoria'] = $crudModel->read("SELECT categoria, count(cod) AS qtd FROM servidor WHERE status=0 GROUP BY categoria;");
	    $dados['afastamento'] = $crudModel->read("SELECT afastamento, count(cod) AS qtd FROM servidor WHERE status=0 GROUP BY afastamento;");
	    $dados['unidade'] = $crudModel->read("SELECT u.cod, COUNT(s.cod) as qtd FROM unidade as u INNER JOIN servidor AS s ON u.cod=s.unidade_cod WHERE s.status=0 GROUP BY u.cod");
	    $this->loadTemplate($view, $dados);
	} else {
	    $_SESSION = array();
	    $url = "location: ".BASE_URL."/login";
			header($url);
	}
    }

    private function statusRelatorio() {
	$relatorio = array('emdias' => 0, 'pendente' => 0);
	$crudModel = new crud_db();
	$servidores = $crudModel->read("SELECT TIMESTAMPDIFF(MONTH, inicio, termino) as qtd_total_meses, TIMESTAMPDIFF(MONTH, inicio, now()) as qtd_meses_atual, cod FROM servidor");
	if (is_array($servidores) && !empty($servidores)) {
	    foreach ($servidores as $indice) {
		$qtd_total_meses = $indice['qtd_total_meses'];
		$qtd_meses_atual = $indice['qtd_meses_atual'];
		$qtd_relatorio = $crudModel->read_specific("SELECT count(cod) as qtd FROM relatorio WHERE servidor_cod=:cod AND status=1", array('cod' => $indice['cod']));
		$qtd_relatorio = isset($qtd_relatorio['qtd']) ? $qtd_relatorio['qtd'] : 0;
		$qtd_minima_relatorio = ($qtd_meses_atual <= $qtd_total_meses) ? round($qtd_meses_atual / 6) : round($qtd_total_meses / 6);
		if ($qtd_relatorio >= $qtd_minima_relatorio) {
		    $relatorio['emdias'] = $relatorio['emdias'] + 1;
		} else {
		    $relatorio['pendente'] = $relatorio['pendente'] + 1;
		}
	    }
	}
	return $relatorio;
    }

}
