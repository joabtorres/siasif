<?php ?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/gif" href="<?php echo BASE_URL ?>/assets/imagens/icon.png" sizes="32x32" />
        <meta property="ogg:title" content="SIASIF - Sistema de Gerenciamento de Afastamento para Qualificação de Servidores do IFPA">
        <meta property="ogg:description" content="SIASIF - Sistema de Gerenciamento de Afastamento para Qualificação de Servidores do IFPA">
        <title> SIASIF - Sistema de Gerenciamento de Afastamento para Qualificação de Servidores do IFPA </title>
        <!-- Bootstrap -->
        <link href="<?php echo BASE_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/estilo.css">

        <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
        <script src="<?php echo BASE_URL ?>/assets/js/jquery-3.1.1.min.js"></script>
        <script>
	    var base_url = "<?php echo BASE_URL ?>";
	    function mostrarConteudo() {
		var elemento = document.getElementById("tela_load");
		elemento.style.display = "none";

		var elemento = document.getElementById("tela_sistema");
		if (elemento) {
		    elemento.style.display = "block";
		}

		var elemento = document.getElementById("interface_login");
		if (elemento) {
		    elemento.style.display = "block";
		}
	    }
        </script>
    </head>

    <body>
        <div id="tela_load">
            <img src="<?php BASE_URL ?>/assets/imagens/loading.gif" style="display: block; margin: auto; margin-top: 300px;">
        </div>
        <div id="tela_sistema">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="menu_sistema">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo BASE_URL ?>/"><img src="<?php echo BASE_URL ?>/assets/imagens/logo_menu.png" alt=""></a>
                </div>
                <!-- Top Menu Items -->

                <ul class="nav navbar-right top-nav">
                    <li>
                        <form action="<?php echo BASE_URL ?>/relatorio/buscarapida/1" class="navbar-form" method="GET" autocomplete="off" name="nSearchSGL">
                            <div class="form-group">
                                <label ><input type="radio" name="nSearchFinalidade" value="Servidor" checked> Servidor (nome)</label>
                                <label ><input type="radio" name="nSearchFinalidade" value="Unidade" > Unidade</label>
                            </div>
                            <div class="input-group">
                                <input type="text" name="nSerachCampo" class="form-control">
                                <span class="input-group-addon" onclick="submit_form_navbar()"><span class="fa fa-search"></span></span>
                            </div>
                            <input type="submit" name="nBuscar" vale="buscar" style="display: none;">
                        </form>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['usuario_siasif']['nome'] ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo BASE_URL ?>/editar/usuario/<?php echo md5($_SESSION['usuario_siasif']['cod']) ?>"><i class="fas fa-users-cog"></i> Editar Perfil</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo BASE_URL ?>/usuario/sair"><i class="fa fa-sign-out-alt "></i> Sair</a>
                            </li>

                        </ul>
                    </li>
                </ul>

                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <nav class="side-nav">
                        <figure>
                            <img src="<?php echo BASE_URL . '/' . $_SESSION['usuario_siasif']['imagem']; ?>" class="pull-left img-circle" >
                            <figcaption>
                                <p class="text-uppercase"><?php echo $_SESSION['usuario_siasif']['nome'] . ' ' . $_SESSION['usuario_siasif']['sobrenome'] ?></p>
                                <p class="text-uppercase"><?php echo $_SESSION['usuario_siasif']['cargo']; ?></p>
                            </figcaption>
                        </figure>
                        <ul class="nav navbar-nav">

                            <li >
                                <a href="<?php echo BASE_URL ?>"><i class="fa fa-tachometer-alt "></i> Inicial</a>
                            </li>
			    <?php if ($this->checkUser() >= 2) : ?>
    			    <li>
    				<a href="javascript:;" data-toggle="collapse" data-target="#menu_cadastro"><i class="fa fa-plus-circle "></i> Cadastrar <i class="fa fa-fw fa-caret-down pull-right"></i></a>
    				<ul id="menu_cadastro" class="collapse">
					<?php if ($this->checkUser() >= 3) : ?>
					    <li>
						<a href="<?php echo BASE_URL ?>/cadastrar/unidade"><i class="fa fa-plus-circle"></i> Unidade</a>
					    </li>
					<?php endif; ?>
    				    <li>
    					<a href="<?php echo BASE_URL ?>/cadastrar/servidor"><i class="fa fa-user-plus"></i> Servidor</a>
    				    </li>
    				</ul>
    			    </li>
			    <?php endif; ?>
                            <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#menu_relatorio"><i class="fa fa-list-ul"></i> Relatórios <i class="fa fa-fw fa-caret-down pull-right"></i></a>
                                <ul id="menu_relatorio" class="collapse">
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/relatorio/unidade"><i class="fas fa-landmark"></i> Unidade</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/relatorio/servidor"><i class="fas fa-user-friends"></i>Servidor</a>
                                    </li>
                                </ul>
                            </li>							
                            <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#menu_usuario"><i class="fa fa-users"></i> Usuários <i class="fa fa-fw fa-caret-down pull-right"></i></a>
                                <ul id="menu_usuario" class="collapse">
				    <?php if ($this->checkUser() >= 3) : ?>
    				    <li>
    					<a href="<?php echo BASE_URL ?>/cadastrar/usuario"><i class="fa fa-user-plus"></i> Novo Usuário</a>
    				    </li>
				    <?php endif; ?>

                                    <li>
                                        <a href="<?php echo BASE_URL ?>/editar/usuario/<?php echo md5($_SESSION['usuario_siasif']['cod']) ?>"><i class="fa fa-user"></i> Editar Perfil</a>
                                    </li>
				    <?php if ($this->checkUser() >= 3) : ?>
    				    <li>
    					<a href="<?php echo BASE_URL ?>/usuario/index"><i class="fa fa-users"></i> Listar Usuários</a>
    				    </li>
				    <?php endif; ?>
                                </ul>
                            </li>

                            <li>
                                <a href="<?php echo BASE_URL ?>/feedback"><i class="fa fa-comments"></i> Feedback</a>
                            </li>
                            <li>
                                <a href="<?php echo BASE_URL ?>/usuario/sair"><i class="fa fa-sign-out-alt"></i> Sair</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- FIM SIDE-NAV-->
                </div>
                <!-- /.navbar-collapse -->
            </nav>
            <div id="conteudo_sistema">
                <div class="container-fluid">
		    <?php $this->loadViewInTemplate($viewName, $viewData) ?>

                    <div id="rodape">
                        <p class="text-right " style="color: #666">&copy; Copyright 2019 - <a href="http://lattes.cnpq.br/0856780614635850" target="_blank" style="color: #666">Joab Torres Alencar</a></p>
                        <br>
                    </div>
                    <!--FIM #rodape-->
                </div>
            </div>
            <!-- /#conteudo_sistema -->
        </div>
        <!-- /#tela_sistema -->



        <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
        <script src="<?php echo BASE_URL ?>/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo BASE_URL ?>/assets/js/jquery.maskedinput.min.js"></script>
        <script src="<?php echo BASE_URL ?>/assets/js/jquery.maskMoney.js"></script>
        <script src="<?php echo BASE_URL ?>/assets/js/script.js"  ></script>
        <script src="<?php echo BASE_URL ?>/assets/js/fontawesome-all.min.js"  ></script>
        <!--MODAL - ESTRUTURA BÁSICA-->
        <section class="modal fade" id="modal_recupera" tabindex="-1" role="dialog">
            <article class="modal-dialog modal-md" role="document">
                <section class="modal-content">
                    <header class="modal-header bg-primary">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p class="panel-title">Mensagem</p>
                    </header>
                    <article class="modal-body">
                        <p class="text-justify">Lorem Ipsum Dolor!</p>
                    </article>
                    <footer class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Fechar</button>
                    </footer>
                </section>
            </article>
        </section>
        <!--MODAL - ESTRUTURA BÁSICA-->
    </body>

</html>
