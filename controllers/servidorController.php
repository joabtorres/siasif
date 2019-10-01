<?php

/**
 * A classe 'servidorController' é responsável para fazer o carregamento da ficha do servidor de forma detalhada
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2019, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe unidadeController
 */
class servidorController extends controller {

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel por carrega a view  presente no diretorio views/servidor_detalhe.php com seus respectivos dados;
     * @param string $cod_servidor - código da servidor em md5
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index($cod_servidor) {
        if ($this->checkUser() && !empty($cod_servidor)) {
            $viewName = "servidor/ficha";
            $dados = array();
            $crudModel = new crud_db();
            $resultado = $crudModel->read_specific("SELECT u.nome AS unidade, s.* FROM servidor AS s INNER JOIN unidade AS u WHERE u.cod=s.unidade_cod AND md5(s.cod) = :cod", array('cod' => $cod_servidor));
            if (is_array($resultado) && !empty($resultado)) {
                $dados['servidor'] = $resultado;
                $dados['relatorios'] = $crudModel->read("SELECT * FROM relatorio WHERE md5(servidor_cod) = :cod", array('cod' => $cod_servidor));
                $dados['defesa'] = $crudModel->read("SELECT * FROM defesa WHERE md5(servidor_cod) = :cod", array('cod' => $cod_servidor));
                $dados['prorrogacao'] = $crudModel->read("SELECT * FROM prorrogacao WHERE md5(servidor_cod) = :cod", array('cod' => $cod_servidor));
            }
            $this->loadTemplate($viewName, $dados);
        } else {
            header("Location: /home");
        }
    }

    public function pdf($cod_servidor) {
        if ($this->checkUser() && !empty($cod_servidor)) {
            $viewName = "servidor/ficha_pdf";
            $dados = array();
            $crudModel = new crud_db();
            $resultado = $crudModel->read_specific("SELECT u.nome AS unidade, s.* FROM servidor AS s INNER JOIN unidade AS u WHERE u.cod=s.unidade_cod AND md5(s.cod) = :cod", array('cod' => $cod_servidor));
            if (is_array($resultado) && !empty($resultado)) {
                $dados['servidor'] = $resultado;
                $dados['relatorios'] = $crudModel->read("SELECT * FROM relatorio WHERE md5(servidor_cod) = :cod", array('cod' => $cod_servidor));
                $dados['defesa'] = $crudModel->read("SELECT * FROM defesa WHERE md5(servidor_cod) = :cod", array('cod' => $cod_servidor));
                $dados['prorrogacao'] = $crudModel->read("SELECT * FROM prorrogacao WHERE md5(servidor_cod) = :cod", array('cod' => $cod_servidor));
            }
            $this->loadView($viewName, $dados);
        } else {
            header("Location: /home");
        }
    }

}
