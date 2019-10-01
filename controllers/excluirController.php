<?php

/**
 * A classe 'excluirrController' é responsável para fazer o gerenciamento na exclusão  de usuários, unidade, servidores, relatórios semestral, ata de defesa e prorrogação de afastamento
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe excluirController
 */
class excluirController extends controller {

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
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de excluir a unidade e todos os registros relacionados ao mesmo. 
     * @access public
     * @param string $cod - código do usuario em md5
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function unidade($cod) {
        if ($this->checkUser() >= 3 && !empty($cod)) {
            $crudModel = new crud_db();
            $resultado = $crudModel->read("SELECT * FROM servidor WHERE md5(unidade_cod)=:cod", array('cod' => addslashes($cod)));
            if (is_array($resultado) && !empty($resultado)) {
                foreach ($resultado as $servidor) {
                    $relatorios = $crudModel->read("SELECT * FROM relatorio WHERE md5(servidor_cod)=:cod", array('cod' => $servidor['cod']));
                    if (is_array($relatorios) && !empty($relatorios)) {
                        foreach ($relatorios as $indice) {
                            $crudModel->delete_file($indice['anexo']);
                        }
                    }
                    $defesa = $crudModel->read("SELECT * FROM defesa WHERE md5(servidor_cod)=:cod", array('cod' => $servidor['cod']));
                    if (is_array($defesa) && !empty($defesa)) {
                        foreach ($defesa as $indice) {
                            $crudModel->delete_file($indice['anexo']);
                        }
                    }
                    $crudModel->delete_file($servidor['imagem']);
                }
            }
            if ($crudModel->remove("DELETE FROM unidade WHERE md5(cod)=:cod", array('cod' => addslashes($cod)))) {
                header("Location: /relatorio/unidade/1");
            }
        } else {
            header("Location: /home");
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de excluir o servidor e todos os registos relacionados ao mesmo
     * @access public
     * @param string $cod - código do servidor em md5
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function servidor($cod) {
        if ($this->checkUser() >= 3 && !empty($cod)) {
            $crudModel = new crud_db();
            $resultado = $crudModel->read_specific("SELECT * FROM servidor WHERE md5(cod)=:cod", array('cod' => addslashes($cod)));
            if ($resultado) {
                $relatorios = $crudModel->read("SELECT * FROM relatorio WHERE md5(servidor_cod)=:cod", array('cod' => $resultado['cod']));
                if (is_array($relatorios) && !empty($relatorios)) {
                    foreach ($relatorios as $indice) {
                        $crudModel->delete_file($indice['anexo']);
                    }
                }
                $defesa = $crudModel->read("SELECT * FROM defesa WHERE md5(servidor_cod)=:cod", array('cod' => $resultado['cod']));
                if (is_array($defesa) && !empty($defesa)) {
                    foreach ($defesa as $indice) {
                        $crudModel->delete_file($indice['anexo']);
                    }
                }
                $crudModel->delete_file($resultado['imagem']);
                if ($crudModel->remove("DELETE FROM servidor WHERE md5(cod)=:cod", array('cod' => $cod))) {
                    header("Location: /home");
                }
            }
        } else {
            header("Location: /home");
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de excluir relatórios semestrais e todos os registos relacionados ao mesmo.
     * @access public
     * @param string $cod - código do relatorio em md5
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function relatorio($cod) {
        if ($this->checkUser() >= 3 && !empty($cod)) {
            $crudModel = new crud_db();
            $resultado = $crudModel->read_specific("SELECT * FROM relatorio WHERE md5(cod)=:cod", array('cod' => addslashes($cod)));
            if ($resultado) {
                $crudModel->delete_file($resultado['anexo']);
                if ($crudModel->remove("DELETE FROM relatorio WHERE md5(cod)=:cod", array('cod' => $cod))) {
                    header("Location: /servidor/index/" . md5($resultado['servidor_cod']));
                }
            }
        } else {
            header("Location: /home");
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de excluir ata de defesa e todos os registos relacionados ao mesmo.
     * @access public
     * @param string $cod - código da defesa em md5
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function defesa($cod) {
        if ($this->checkUser() >= 3 && !empty($cod)) {
            $crudModel = new crud_db();
            $resultado = $crudModel->read_specific("SELECT * FROM defesa WHERE md5(cod)=:cod", array('cod' => addslashes($cod)));
            if ($resultado) {
                $crudModel->delete_file($resultado['anexo']);
                if ($crudModel->remove("DELETE FROM defesa WHERE md5(cod)=:cod", array('cod' => $cod))) {
                    header("Location: /servidor/index/" . md5($resultado['servidor_cod']));
                }
            }
        } else {
            header("Location: /home");
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de excluir a prorrogação do servidor  e todos os registos relacionados ao mesmo.
     * @access public
     * @param string $cod - código da prorrogação em md5
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function prorrogacao($cod) {
        if ($this->checkUser() >= 3 && !empty($cod)) {
            $crudModel = new crud_db();
            $resultado = $crudModel->read_specific("SELECT * FROM prorrogacao WHERE md5(cod)=:cod", array('cod' => addslashes($cod)));
            if ($resultado) {
                if ($crudModel->remove("DELETE FROM prorrogacao WHERE md5(cod)=:cod", array('cod' => $cod))) {
                    header("Location: /servidor/index/" . md5($resultado['servidor_cod']));
                }
            }
        } else {
            header("Location: /home");
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controle nas ações de excluir usuario  e todos os registos relacionados ao mesmo.
     * @param string $cod - código do usuario em md5
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function usuario($cod) {
        if ($this->checkUser() >= 3 && !empty($cod)) {
            $usuarioModel = new usuario();
            $usuarioModel->remove(array('cod' => addslashes($cod)));
            header("Location: /usuario/index");
        } else {
            header("Location: /usuario/index");
        }
    }

}
