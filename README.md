# Sistema de Gerenciamento de Afastamento para Qualificação de Servidores do IFPA - SIASIF

BANCO DE DADOS OFICIAL = BANCO DE DADOS - OFICIAL.sql

BANCO DE DADOS DEMOSTRATIVO = BD - DEMONSTRATIVO.sql

# Etapas:
1º) baixe o projeto no link: https://github.com/joabtorres/siasif;

2º) extraia a pasta siasif dentro do servidor local (www);

3º) Crie o banco de dados no phpMyAdmin com a collaction utf8_general_ci;

4º) importe o banco de dados "BANCO DE DADOS - OFICIAL.sql (contido dentro da pasta siasif)" dentro do banco recém criado;

5º) Abra o arquivo config.php (contido dentro da pasta siasif);

6º) no arquivo config.php, defina a url através "http://ENDRECO_IP_DO_SERVIDOR/siasif", por exemplo "http://192.168.0.15/siasif";

7º) no arquivo config.php, informe o nome do banco, usuário e senha.

OBS: Vale ressaltar que a versão do PHP deve está na versão 5.x (exemplo: 5.6)
