<div id="section-container">
    <div class="row" >
        <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
            <h2 class="text-uppercase"><?php echo!empty($servidor['nome']) ? $servidor['nome'] : '' ?></h2>
            <ol class="breadcrumb">
                <li><a  href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer-alt"></i> Inicial</a></li>
                <li><a  href="<?php echo BASE_URL ?>/relatorio/servidor"><i class="fa fa-list-alt"></i> Servidor</a></li>
                <li class="active text-uppercase"><i class="fa fa-user"></i> <?php echo!empty($servidor['nome']) ? $servidor['nome'] : '' ?></li>
            </ol>
        </div>
    </div>
    <!--FIM pagina-header-->
    <div class="col-md-12 clear">
        <p class="text-right">
            <a class="btn btn-success btn-xs" href="<?php echo BASE_URL . '/servidor/pdf/' . md5($servidor['cod']); ?>" title="Imprimir" target="_blank"><i class="fas fa-print"></i> Imprimir</a> 
	    <?php if (($this->checkUser() >= 3) || ($this->checkUnidade() == $servidor['unidade_cod'] && $this->checkUser() >= 2)): ?>
    	    <a class="btn btn-primary btn-xs" href="<?php echo BASE_URL . '/editar/servidor/' . md5($servidor['cod']); ?>" title="Editar"><i class="fa fa-pencil-alt"></i> Editar</a> 
		<?php if ($this->checkUser() >= 3): ?>
		    <button type="button"  class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal_servidor_<?php echo md5($servidor['cod']) ?>" title="Excluir"><i class="fa fa-trash"></i> Excluir</button>
		    <?php
		endif;
	    endif;
	    ?>
	</p>
    </div>
    <div class="row">
        <div class="col-md-12 clear">

            <section class="panel panel-black">
                <header class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-user-alt"></i> Servidor</h4>
                </header>
                <article class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-2">
                            <img src="<?php echo!empty($servidor['imagem']) ? BASE_URL . '/' . $servidor['imagem'] : BASE_URL . '/assets/imagens/foto_ilustrato3x4.png' ?>" class="img-responsive img-rounded img-center" style="max-width: 150px; max-height: 200px; margin: 10px auto;"/>
                        </div>
                        <div class="col-md-9 col-lg-10">
                            <section class="panel panel-black">
                                <header class="panel-heading">
                                    <h4 class="panel-title"><i class="fas fa-user-lock"></i> Dados Pessoais</h4>
                                </header>
                                <article class="panel-body">
                                    <!--inicio row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p><span class="text-destaque">Nome:</span> <?php echo!empty($servidor['nome']) ? $servidor['nome'] : '' ?></p>
                                        </div>
                                        <div class="col-md-4 ">
                                            <p><span class="text-destaque">Unidade:</span> <?php echo!empty($servidor['unidade']) ? $servidor['unidade'] : '' ?></p>
                                        </div>
                                        <div class="col-md-4 ">
                                            <p><span class="text-destaque">Status do Afastamento:</span> <?php echo!empty($servidor['status']) ? "Concluído" : "Afastado" ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><span class="text-destaque">SIAPE:</span> <?php echo!empty($servidor['siape']) ? $servidor['siape'] : '' ?></p>
                                        </div>
                                        <div class="col-md-4"> 
                                            <p><span class="text-destaque">CPF:</span> <?php echo!empty($servidor['cpf']) ? $servidor['cpf'] : '' ?></p>
                                        </div>                                
                                        <div class="col-md-4"> 
                                            <p><span class="text-destaque">Gênero:</span> <?php echo!empty($servidor['genero']) ? $servidor['genero'] : '' ?></p>
                                        </div>  	
					<div class="col-md-4">
                                            <p><span class="text-destaque">Área de Atuação:</span> <?php echo!empty($servidor['atuacao']) ? $servidor['atuacao'] : '' ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><span class="text-destaque">Telefone:</span> <?php echo!empty($servidor['telefone']) ? $servidor['telefone'] : '' ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><span class="text-destaque">E-mail:</span> <?php echo!empty($servidor['email']) ? $servidor['email'] : '' ?></p>
                                        </div>
                                    </div>
                                    <!--fim row--> 
                                </article>
                            </section>

                        </div> <!-- fim col-md-5 -->

                    </div>
                </article>
            </section>
        </div>
        <div class="col-md-12 clear">
            <section class="panel panel-black">
                <header class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-circle-notch"></i> Dados do afastamento</h4>
                </header>
                <article class="panel-body">
                    <!--inicio row-->
                    <div class="row">
                        <div class="col-md-3">
                            <p><span class="text-destaque">Nº do Ato:</span> <?php echo!empty($servidor['numero_ato']) ? $servidor['numero_ato'] : '' ?></p>
                        </div>
                        <div class="col-md-3 ">
                            <p><span class="text-destaque">Tipo de Ato:</span> <?php echo!empty($servidor['ato']) ? $servidor['ato'] : '' ?></p>
                        </div>

                        <div class="col-md-3">
                            <p><span class="text-destaque">Tipo do Afastamento:</span> <?php echo!empty($servidor['afastamento']) ? $servidor['afastamento'] : '' ?></p>
                        </div>
                        <div class="col-md-3"> 
                            <p><span class="text-destaque">Categoria:</span> <?php echo!empty($servidor['categoria']) ? $servidor['categoria'] : '' ?></p>
                        </div>                                
                        <div class="col-md-3"> 
                            <p><span class="text-destaque">Modalidade:</span> <?php echo!empty($servidor['modalidade']) ? $servidor['modalidade'] : '' ?></p>
                        </div>
                        <div class="col-md-3">
                            <p><span class="text-destaque">Destino:</span> <?php echo!empty($servidor['destino']) ? $servidor['destino'] : '' ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><span class="text-destaque">Instituição:</span> <?php echo!empty($servidor['instituicao']) ? $servidor['instituicao'] : '' ?></p>
                        </div>
                    </div>
                    <!--fim row--> 
                </article>
            </section>

        </div> <!-- fim col-md-12 clear -->
        <div class="col-md-12 clear">
            <section class="panel panel-black">
                <header class="panel-heading">
                    <h4 class="panel-title"><i class="far fa-calendar"></i> Período de Afastamento</h4>
                </header>
                <article class="panel-body">
                    <!--inicio row-->
                    <div class="row">
                        <div class="col-sm-6 col-md-3 ">
                            <p><span class="text-destaque">Data de Início:</span> <?php echo!empty($servidor['inicio']) ? $this->formatDateView($servidor['inicio']) : '' ?></p>
                        </div>
                        <div class="col-sm-6 col-md-3 ">
                            <p><span class="text-destaque">Data de Término:</span> <?php echo!empty($servidor['termino']) ? $this->formatDateView($servidor['termino']) : '' ?></p>
                        </div>
                    </div>
                    <!--fim row-->
                </article>
            </section>
        </div>

        <!--fim col-md-12 clea-->
        <div class="col-md-12 clear">
            <section class="panel panel-black">
                <header class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-calendar-alt  pull-left"></i> Entrega de Relatórios</h4>
                </header>
		<?php if (($this->checkUser() >= 3) || ($this->checkUnidade() == $servidor['unidade_cod'] && $this->checkUser() >= 2)): ?>
    		<article class="panel-body">
    		    <span class="pull-right"><a href="<?php echo BASE_URL . '/cadastrar/relatorio/' . md5($servidor['cod']) ?>" class="btn btn-sm btn-success" title="Adicionar Relatório"><i class="fa fa-plus-circle"></i> Adicionar</a></span>
    		</article>
		<?php endif; ?>
                <article class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <tr>
                            <th>#</th>
                            <th>Status</th>
                            <th>Data</th>
                            <th>Anexo</th>
			    <?php if (($this->checkUser() >= 3) || ($this->checkUnidade() == $servidor['unidade_cod'] && $this->checkUser() >= 2)): ?>
    			    <th>Ação</th>
			    <?php endif; ?>
                        </tr>
			<?php
			if (isset($relatorios) && !empty($relatorios)):
			    $qtd = 1;
			    foreach ($relatorios as $indice):
				?>
				<tr>
				    <td><?php echo $qtd ?></td>
				    <td><?php echo!empty($indice['status']) ? "Entregue" : "Pendente" ?></td>
				    <td><?php echo!empty($indice['data']) ? $this->formatDateView($indice['data']) : '' ?></td>
				    <td><?php echo!empty($indice['anexo']) ? '<a href="' . BASE_URL . '/' . $indice['anexo'] . '" download>Baixar arquivo</a>' : '' ?></td>
				     <?php if (($this->checkUser() >= 3) || ($this->checkUnidade() == $servidor['unidade_cod'] && $this->checkUser() >= 2)): ?>
	    			    <td class="table-acao text-center">
	    				<a class="btn btn-primary btn-xs" href="<?php echo BASE_URL . '/editar/relatorio/' . md5($indice['cod']); ?>" title="Editar"><i class="fa fa-pencil-alt"></i></a> 
					    <?php if ($this->checkUser() >= 3): ?>
						<button type="button"  class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal_relatorio_<?php echo md5($indice['cod']) ?>" title="Excluir"><i class="fa fa-trash"></i></button>
					    <?php endif; ?>
	    			    </td>
				    <?php endif; ?>
				</tr>
				<?php
				$qtd++;
			    endforeach;
			endif;
			?>

                    </table>
                </article>
            </section>
        </div>
        <!--fim col-md-12 clea-->
        <div class="col-md-12 clear">
            <section class="panel panel-black">
                <header class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-calendar-alt  pull-left"></i> Ata de Defesa</h4>
                </header>
		<?php if (($this->checkUser() >= 3) || ($this->checkUnidade() == $servidor['unidade_cod'] && $this->checkUser() >= 2)): ?>
    		<article class="panel-body">
    		    <span class="pull-right"><a href="<?php echo BASE_URL . '/cadastrar/defesa/' . md5($servidor['cod']) ?>" class="btn btn-sm btn-success" title="Adicionar Relatório"><i class="fa fa-plus-circle"></i> Adicionar</a></span>
    		</article>
		<?php endif; ?>
                <article class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <tr>
                            <th>#</th>
                            <th>Status</th>
                            <th>Data</th>
                            <th>Anexo</th>
			    <?php if (($this->checkUser() >= 3) || ($this->checkUnidade() == $servidor['unidade_cod'] && $this->checkUser() >= 2)): ?>
    			    <th>Ação</th>
			    <?php endif; ?>
                        </tr>
			<?php
			if (isset($defesa) && !empty($defesa)):
			    $qtd = 1;
			    foreach ($defesa as $indice):
				?>
				<tr>
				    <td><?php echo $qtd ?></td>
				    <td><?php echo!empty($indice['status']) ? "Entregue" : "Pendente" ?></td>
				    <td><?php echo!empty($indice['data']) ? $this->formatDateView($indice['data']) : '' ?></td>
				    <td><?php echo!empty($indice['anexo']) ? '<a href="' . BASE_URL . '/' . $indice['anexo'] . '" download>Baixar arquivo</a>' : '' ?></td>
				    <?php if (($this->checkUser() >= 3) || ($this->checkUnidade() == $servidor['unidade_cod'] && $this->checkUser() >= 2)): ?>
	    			    <td class="table-acao text-center">
	    				<a class="btn btn-primary btn-xs" href="<?php echo BASE_URL . '/editar/defesa/' . md5($indice['cod']); ?>" title="Editar"><i class="fa fa-pencil-alt"></i></a> 
					    <?php if ($this->checkUser() >= 3): ?>
						<button type="button"  class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal_defesa_<?php echo md5($indice['cod']) ?>" title="Excluir"><i class="fa fa-trash"></i></button>
					    <?php endif; ?>
	    			    </td>
				    <?php endif; ?>
				</tr>
				<?php
				$qtd++;
			    endforeach;
			endif;
			?>

                    </table>
                </article>
            </section>
        </div>
        <!--fim col-md-12 clea-->
        <div class="col-md-12 clear">
            <section class="panel panel-black">
                <header class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-calendar-alt  pull-left"></i> Prorrogação</h4>
                </header>
		<?php if (($this->checkUser() >= 3) || ($this->checkUnidade() == $servidor['unidade_cod'] && $this->checkUser() >= 2)): ?>
    		<article class="panel-body">
    		    <span class="pull-right"><a href="<?php echo BASE_URL . '/cadastrar/prorrogacao/' . md5($servidor['cod']) ?>" class="btn btn-sm btn-success" title="Adicionar Relatório"><i class="fa fa-plus-circle"></i> Adicionar</a></span>
    		</article>
		<?php endif; ?>
                <article class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <tr>
                            <th>#</th>
                            <th>Data Inicial</th>
                            <th>Data Final</th>
                            <th>Tipo do Ato</th>
                            <th>Nº do Ato</th>
			    <?php if (($this->checkUser() >= 3) || ($this->checkUnidade() == $servidor['unidade_cod'] && $this->checkUser() >= 2)): ?>
    			    <th>Ação</th>
			    <?php endif; ?>
                        </tr>
			<?php
			if (isset($prorrogacao) && !empty($prorrogacao)):
			    $qtd = 1;
			    foreach ($prorrogacao as $indice):
				?>
				<tr>
				    <td><?php echo $qtd ?></td>
				    <td><?php echo!empty($indice['inicio']) ? $this->formatDateView($indice['inicio']) : '' ?></td>
				    <td><?php echo!empty($indice['termino']) ? $this->formatDateView($indice['termino']) : '' ?></td>
				    <td><?php echo!empty($indice['ato']) ? $indice['ato'] : '' ?></td>
				    <td><?php echo!empty($indice['numero_ato']) ? $indice['numero_ato'] : '' ?></td>
				    <?php if (($this->checkUser() >= 3) || ($this->checkUnidade() == $servidor['unidade_cod'] && $this->checkUser() >= 2)): ?>
	    			    <td class="table-acao text-center">
	    				<a class="btn btn-primary btn-xs" href="<?php echo BASE_URL . '/editar/prorrogacao/' . md5($indice['cod']); ?>" title="Editar"><i class="fa fa-pencil-alt"></i></a> 
					    <?php if ($this->checkUser() >= 3): ?>
						<button type="button"  class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal_prorrogacao_<?php echo md5($indice['cod']) ?>" title="Excluir"><i class="fa fa-trash"></i></button>
					    <?php endif ?>
	    			    </td>
				    <?php endif; ?>
				</tr>
				<?php
				$qtd++;
			    endforeach;
			endif;
			?>

                    </table>
                </article>
            </section>
        </div>
        <!--fim col-md-12 clea-->
    </div>
</div>
<?php
if ($this->checkUser() >= 3):
    if (isset($servidor) && !empty($servidor)):
	?>
	<!--MODAL - ESTRUTURA BÁSICA-->
	<section class="modal fade" id="modal_servidor_<?php echo md5($servidor['cod']) ?>" tabindex="-1" role="dialog">
	    <article class="modal-dialog modal-md" role="document">
		<section class="modal-content">
		    <header class="modal-header bg-primary">
			<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 >Deseja remover este registro?</h4>
		    </header>
		    <article class="modal-body">
			<ul class="list-unstyled">
			    <li><b>Nome: </b> <?php echo!empty($servidor['nome']) ? $servidor['nome'] : '' ?>;</li>
			    <li><b>Nome: </b> <?php echo!empty($servidor['siape']) ? $servidor['siape'] : '' ?>;</li>
			    <li><b>Nº Ato: </b> <?php echo!empty($servidor['numero_ato']) ? $servidor['numero_ato'] : '' ?>;</li>
			    <li><b>Ato: </b> <?php echo!empty($servidor['ato']) ? $servidor['ato'] : '' ?>;</li>
			    <li><b>Modalidade: </b> <?php echo!empty($servidor['modalidade']) ? $servidor['modalidade'] : '' ?>;</li>
			    <li><b>Data de Inicio: <?php echo!empty($servidor['inicio']) ? $this->formatDateView($servidor['inicio']) : '' ?>;</li>
			    <li><b>Data de Termino: <?php echo!empty($servidor['termino']) ? $this->formatDateView($servidor['termino']) : '' ?>.</li>
			</ul>
			<p class="text-justify text-danger"><span class="font-bold">OBS : </span> Ao clicar em "Excluir", este registro e todos registos relacionados ao mesmo deixaram de existir no sistema.</p>
		    </article>
		    <footer class="modal-footer">
			<a class="btn btn-danger pull-left" href="<?php echo BASE_URL . '/excluir/servidor/' . md5($servidor['cod']) ?>"> <i class="fa fa-trash"></i> Excluir</a> 
			<button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
		    </footer>
		</section>
	    </article>
	</section>
	<?php
    endif;
    ?>


    <?php
    if (isset($relatorios) && !empty($relatorios)):
	foreach ($relatorios as $indice):
	    ?>
	    <!--MODAL - ESTRUTURA BÁSICA-->
	    <section class="modal fade" id="modal_relatorio_<?php echo md5($indice['cod']) ?>" tabindex="-1" role="dialog">
	        <article class="modal-dialog modal-md" role="document">
	    	<section class="modal-content">
	    	    <header class="modal-header bg-primary">
	    		<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    		<h4 >Deseja remover este registro?</h4>
	    	    </header>
	    	    <article class="modal-body">
	    		<ul class="list-unstyled">
	    		    <li><b>Status: </b> <?php echo!empty($indice['status']) ? "Entregue" : "Pendente" ?>;</li>
	    		    <li><b>Data: <?php echo!empty($indice['data']) ? $this->formatDateView($indice['data']) : '' ?>;</li>
	    		    <li><b>Anexo: </b> <?php echo!empty($indice['anexo']) ? '<a href="' . BASE_URL . '/' . $indice['anexo'] . '" download>Baixar arquivo</a>' : '' ?>.</li>
	    		</ul>
	    		<p class="text-justify text-danger"><span class="font-bold">OBS : </span> Se você remove este registro, o mesmo deixará de existir no sistema.</p>
	    	    </article>
	    	    <footer class="modal-footer">
	    		<a class="btn btn-danger pull-left" href="<?php echo BASE_URL . '/excluir/relatorio/' . md5($indice['cod']) ?>"> <i class="fa fa-trash"></i> Excluir</a> 
	    		<button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
	    	    </footer>
	    	</section>
	        </article>
	    </section>
	    <?php
	endforeach;
    endif;
    ?>

    <?php
    if (isset($defesa) && !empty($defesa)):
	foreach ($defesa as $indice):
	    ?>
	    <!--MODAL - ESTRUTURA BÁSICA-->
	    <section class="modal fade" id="modal_defesa_<?php echo md5($indice['cod']) ?>" tabindex="-1" role="dialog">
	        <article class="modal-dialog modal-md" role="document">
	    	<section class="modal-content">
	    	    <header class="modal-header bg-primary">
	    		<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    		<h4 >Deseja remover este registro?</h4>
	    	    </header>
	    	    <article class="modal-body">
	    		<ul class="list-unstyled">
	    		    <li><b>Status: </b> <?php echo!empty($indice['status']) ? "Entregue" : "Pendente" ?>;</li>
	    		    <li><b>Data: <?php echo!empty($indice['data']) ? $this->formatDateView($indice['data']) : '' ?>;</li>
	    		    <li><b>Anexo: </b> <?php echo!empty($indice['anexo']) ? '<a href="' . BASE_URL . '/' . $indice['anexo'] . '" download>Baixar arquivo</a>' : '' ?>.</li>
	    		</ul>
	    		<p class="text-justify text-danger"><span class="font-bold">OBS : </span> Se você remove este registro, o mesmo deixará de existir no sistema.</p>
	    	    </article>
	    	    <footer class="modal-footer">
	    		<a class="btn btn-danger pull-left" href="<?php echo BASE_URL . '/excluir/defesa/' . md5($indice['cod']) ?>"> <i class="fa fa-trash"></i> Excluir</a> 
	    		<button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
	    	    </footer>
	    	</section>
	        </article>
	    </section>
	    <?php
	endforeach;
    endif;
    ?>

    <?php
    if (isset($prorrogacao) && !empty($prorrogacao)):
	foreach ($prorrogacao as $indice):
	    ?>
	    <!--MODAL - ESTRUTURA BÁSICA-->
	    <section class="modal fade" id="modal_prorrogacao_<?php echo md5($indice['cod']) ?>" tabindex="-1" role="dialog">
	        <article class="modal-dialog modal-md" role="document">
	    	<section class="modal-content">
	    	    <header class="modal-header bg-primary">
	    		<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    		<h4 >Deseja remover este registro?</h4>
	    	    </header>
	    	    <article class="modal-body">
	    		<ul class="list-unstyled">
	    		    <li><b>Nº Ato: </b> <?php echo!empty($indice['numero_ato']) ? $indice['numero_ato'] : '' ?>;</li>
	    		    <li><b>Ato: </b> <?php echo!empty($indice['ato']) ? $indice['ato'] : '' ?>;</li>
	    		    <li><b>Data de Inicio: <?php echo!empty($indice['inicio']) ? $this->formatDateView($indice['inicio']) : '' ?>;</li>
	    		    <li><b>Data de Termino: <?php echo!empty($indice['inicio']) ? $this->formatDateView($indice['inicio']) : '' ?>.</li>
	    		</ul>
	    		<p class="text-justify text-danger"><span class="font-bold">OBS : </span> Se você remove este registro, o mesmo deixará de existir no sistema.</p>
	    	    </article>
	    	    <footer class="modal-footer">
	    		<a class="btn btn-danger pull-left" href="<?php echo BASE_URL . '/excluir/defesa/' . md5($indice['cod']) ?>"> <i class="fa fa-trash"></i> Excluir</a> 
	    		<button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
	    	    </footer>
	    	</section>
	        </article>
	    </section>
	    <?php
	endforeach;
    endif;
endif;
?>
