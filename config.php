<?php

/*
 * config.php  - Este arquivo contem informações referente a: Conexão com banco de dados e URL Pádrão
 */

require 'environment.php';
$config = array();
if (ENVIRONMENT == 'development') {
    //Raiz
    define("BASE_URL", "http://IP_DO_SERVIDOR/siasif");
    //Nome do banco
    $config['dbname'] = 'siasif';
    //host
    $config['host'] = 'localhost';
    //usuario
    $config['dbuser'] = 'root';
    //senha
    $config['dbpass'] = '';
} else {
	//Raiz
    define("BASE_URL", "URL");
    //Nome do banco
    $config['dbname'] = 'BANCO_DE_DADOS';
    //host
    $config['host'] = 'localhost';
    //usuario
    $config['dbuser'] = 'USUARIO_MYSQL';
    //senha
    $config['dbpass'] = 'SENHA_DO_USUÁRIO';
}
?>
