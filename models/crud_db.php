<?php

/**
 * A classe 'crud_db' é responsável para efetiva comandos sql no banco de dados, como, insert, update, select, delete, count;
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2019, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package models
 * @example classe crud_db
 */
class crud_db extends model {

    /**
     * String $numRows - referente q quantidade de linhas obtidas no select;
     * @access private
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    private $numRows;

    /**
     * Está função tem como objetivo retorna a quantidade de registro encontrados armazenados na variavel $numRows
     * @access public
     * @return int
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function getNumRows() {
        return $this->numRows;
    }

    /**
     * Está função é responsável para cadastrar novos registros;
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return boolean 
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function create($sql_command, $data) {
        try {
            $sql = $this->db->prepare($sql_command);
            foreach ($data as $indice => $valor) {
                $sql->bindValue(":" . $indice, $valor);
            }
            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            echo '<script> alert("Mensagem: ' . $ex->getMessage() . '")</script>';
        }
    }

    /**
     * Está função é responsável para consultas no banco e retorna os resultados obtidos;
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return array $sql->fetchAll() [caso encontre] | bollean FALSE [caso contrário] 
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function read($sql_command, $data = array()) {
        if (!empty($data)) {
            $sql = $this->db->prepare($sql_command);
            foreach ($data as $indice => $valor) {
                $sql->bindValue(":" . $indice, $valor);
            }
            $sql->execute();
        } else {
            $sql = $this->db->query($sql_command);
        }

        if ($sql->rowCount() > 0) {
            $this->numRows = $sql->rowCount();
            return $sql->fetchAll();
        } else {
            $this->numRows = 0;
            return FALSE;
        }
    }

    /**
     * Está função é responsável para consultas no banco e retorna os resultados obtidos;
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return array $sql->fetch() [caso encontre] | bollean FALSE [caso contrário] 
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function read_specific($sql_command, $data = array()) {
        if (!empty($data)) {
            $sql = $this->db->prepare($sql_command);

            foreach ($data as $indice => $valor) {
                $sql->bindValue(":" . $indice, $valor);
            }
            $sql->execute();
        } else {
            $sql = $this->db->query($sql_command);
        }
        if ($sql->rowCount() > 0) {
            $this->numRows = $sql->rowCount();
            return $sql->fetch();
        } else {
            $this->numRows = 0;
            return FALSE;
        }
    }

    /**
     * Está função é responsável para altera um registro específico;
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return bollean TRUE ou FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function update($sql_command, $data) {
        try {
            $sql = $this->db->prepare($sql_command);
            foreach ($data as $indice => $valor) {
                $sql->bindValue(":" . $indice, $valor);
            }
            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            echo '<script> alert("Mensagem: ' . $ex->getMessage() . '")</script>';
        }
    }

    /**
     * Está é responsável excluir um registro específico
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return boolean TRUE or FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function remove($sql_command, $data) {
        $sql = $this->db->prepare($sql_command);
        foreach ($data as $indice => $valor) {
            $sql->bindValue(":" . $indice, $valor);
        }
        $sql->execute();
        return true;
    }

    /**
     * Está função é responsável para salva uma imágem no diretório uploads/servidores/
     * @access public
     * @return string url da imagem ou null
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function save_image($file) {
        $imagem = array();
        $largura = 150;
        $altura = 200;
        $imagem['temp'] = $file['tmp_name'];
        $imagem['extensao'] = explode(".", $file['name']);
        $imagem['extensao'] = strtolower(end($imagem['extensao']));
        $imagem['name'] = md5(rand(1000, 900000) . time()) . '.' . $imagem['extensao'];
        $imagem['diretorio'] = 'uploads/servidores';
        if ($imagem['extensao'] == 'jpg' || $imagem['extensao'] == 'jpeg' || $imagem['extensao'] == 'png') {

            list($larguraOriginal, $alturaOriginal) = getimagesize($imagem['temp']);


            $ratio = max($largura / $larguraOriginal, $altura / $alturaOriginal);
            $alturaOriginal = $altura / $ratio;
            $x = ($larguraOriginal - $largura / $ratio) / 2;
            $larguraOriginal = $largura / $ratio;


            $imagem_final = imagecreatetruecolor($largura, $altura);

            if ($imagem['extensao'] == 'jpg' || $imagem['extensao'] == 'jpeg') {
                $imagem_original = imagecreatefromjpeg($imagem['temp']);
                imagecopyresampled($imagem_final, $imagem_original, 0, 0, $x, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);
                imagejpeg($imagem_final, $imagem['diretorio'] . "/" . $imagem['name'], 90);
            } else if ($imagem['extensao'] == 'png') {
                $imagem_original = imagecreatefrompng($imagem['temp']);
                imagecopyresampled($imagem_final, $imagem_original, 0, 0, $x, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);
                imagepng($imagem_final, $imagem['diretorio'] . "/" . $imagem['name']);
            }
            return $imagem['diretorio'] . "/" . $imagem['name'];
        } else {
            return null;
        }
    }

    public function save_pdf($file) {
        $arquivo = array();
        $arquivo['temp'] = $file['tmp_name'];
        $arquivo['extensao'] = explode(".", $file['name']);
        $arquivo['extensao'] = strtolower(end($arquivo['extensao']));
        $arquivo['name'] = md5(md5(rand(1000, 900000) . time())) . '.' . $arquivo['extensao'];
        $arquivo['diretorio'] = 'uploads/media';
        $arquivo['arquivo'] = $arquivo['diretorio'] . "/" . $arquivo['name'];
        if ($arquivo['extensao'] == 'pdf') {
            if (move_uploaded_file($arquivo['temp'], $arquivo['arquivo'])) {
                return $arquivo['arquivo'];
            } else {
                 return null;
            }
        } else {
            return null;
        }
    }

    /**
     * Está é responsável excluir uma imagem de usuário;
     * @param String $url_image - diretório do arquivo;
     * @access private
     * @return boolean TRUE or FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function delete_file($url_image) {
        if (file_exists($url_image)) {
            unlink($url_image);
            return true;
        } else {
            FALSE;
        }
    }

}
