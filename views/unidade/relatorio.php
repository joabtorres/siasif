<div id="section-container">
    <div class="row" >
        <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
            <h2> Unidades</h2>
            <ol class="breadcrumb">
                <li><a  href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer-alt"></i> Inicial</a></li>
                <li class="active"><i class="fas fa-landmark"></i> Relatórios de unidades</li>
            </ol>
        </div>
    </div>
    <!--FIM pagina-header-->
    <div class="row">
        <div class="col-md-12 clear">
            <form method="GET" autocomplete="off" action="<?php echo BASE_URL ?>/relatorio/unidade/1">
                <section class="panel panel-success">
                    <header class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <h4 class="panel-title"><i class="fa fa-search pull-left"></i> Painel de Busca <i class="fa fa-eye pull-right"></i></h4> </a>
                    </header>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <article class="panel-body">
                            <div class="row">
                                <div class="col-md-4 form-group">
				    <label for='iUnidade'>Unidade:* </label>
                                    <select class="form-control" name="nUnidade"  id="iUnidade">
					<option value="" selected="selected">Todas</option>
					<?php
					if (is_array($list_unidades)):
					    foreach ($list_unidades as $indice) {
						echo "<option value=" . $indice['cod'] . ">" . $indice['nome'] . "</option>";
					    }
					endif;
					?>
                                    </select>
                                </div>
				<div class="col-md-3 form-group">
                                    <label for="iAtuacao" class="control-label">Área de Atuação:</label><br/>
                                    <select id="iAtuacao" name="nAtuacao" class="form-control">
					<option value="" selected="selected">Todas</option>
					<?php
					$array = array('Artes', 'Ciências Biológicas', 'Ciências Agrárias', 'Ciências da Saúde', 'Ciências Sociais Aplicadas', 'Educação', 'Educação Física', 'Engenharias', 'Filosofia', 'Física', 'Geografia', 'História', 'Informática', 'Língua Portuguesa', 'Matemática', 'Química', 'Sociologia', 'Outros');
					for ($i = 0; $i < count($array); $i++) {
					    echo '<option value="' . $array[$i] . '">' . $array[$i] . '</option>';
					}
					?>
                                    </select>
                                </div>
				<div class="col-md-3 col-lg-2 form-group">
                                    <label for='iStatus'>Status: </label>
                                    <select id="iStatus" name="nStatus" class="form-control">
                                        <option value="" selected="selected">Todas</option>
                                        <option value="Afastado">Afastado</option>
                                        <option  value="Concluído">Concluído</option>
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for='iTipo'>Tipo de Afastamento: </label>
                                    <select id="iTipo" name="nTipo" class="form-control">
                                        <option value="" selected="selected">Todos</option>
                                        <option value="Portaria">Portaria</option>
                                        <option  value="Resolução">Resolução</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-lg-2 form-group">
                                    <label for="iModalidade" class="control-label">Modalidade:</label><br/>
				    <select id="iModalidade" name="nModalidade" class="form-control">
					<option value="" selected="selected">Todas</option>
					<?php
					$array = array('Mestrado', 'MINTER/Estágio', 'Doutorado', 'DINTER/Estágio', 'Pós-Doutorado');
					for ($i = 0; $i < count($array); $i++) {
					    echo '<option value="' . $array[$i] . '">' . $array[$i] . '</option>';
					}
					?>
				    </select>
                                </div>

                                <div class="col-md-3 col-lg-2 form-group">
                                    <label for='iCategoria'>Categoria: </label>
                                    <select id="iCategoria" name="nCategoria" class="form-control">
                                        <option value="" selected="selected">Todas</option>
                                        <option value="Docente">Docente</option>
                                        <option  value="TAE">TAE</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-lg-2 form-group">
                                    <label for="iDestino" class="control-label">Destino:</label><br/>
				    <select id="iDestino" name="nDestino" class="form-control">
					<option value="" selected="selected">Todas</option>
					<?php
					$array = array('Nacional', 'Internacional');
					for ($i = 0; $i < count($array); $i++) {
					    echo '<option value="' . $array[$i] . '">' . $array[$i] . '</option>';
					}
					?>
				    </select>
                                </div>
                                <div class="col-md-3 col-lg-3 form-group">
                                    <label for='iInicio'>Data de início: </label>
                                    <input type="text" id="iInicio" name="nInicio" class="form-control input-data"/>
                                </div>
                                <div class="col-md-3 col-lg-3 form-group">
                                    <label for='iTermino'>Data de término: </label>
                                    <input type="text" id="iTermino" name="nTermino" class="form-control input-data"/>
                                </div>
                                <div class="col-md-3 col-lg-6 form-group">
                                    <label for='iNome'>Servidor: </label>
                                    <input type="text" id="iNome" name="nNome" class="form-control"/>
                                </div>

				<div class="col-md-3 col-lg-2 form-group">
                                    <label for="iRelatorio" class="control-label">Relátórios:</label><br/>
				    <select id="iRelatorio" name="nRelatorio" class="form-control">
					<option value="" selected="selected">Todos</option>
					<option value="Em dias" >Em dias</option>
					<option value="Pendente" >Pendente</option>
					?>
				    </select>
                                </div>
				<div class="col-md-3 col-lg-2 form-group">
                                    <label for="iDefesa" class="control-label">Defesa:</label><br/>
				    <select id="iDefesa" name="nDefesa" class="form-control">
					<option value="" selected="selected">Todas</option>
					<option value="Entregue" >Entregue</option>
					<option value="Pendente" >Pendente</option>
					?>
				    </select>
                                </div>
				<div class="col-md-3 col-lg-2 form-group">
                                    <label for="iProrrogacao" class="control-label">Prorrogação:</label><br/>
				    <select id="iProrrogacao" name="nProrrogacao" class="form-control">
					<option value="" selected="selected">Todas</option>
					<option value="Solicitada" >Solicitada</option>
					<option value="Não Solicitada" >Não solicitada</option>
					?>
				    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Gerar PDF:</label><br/>
                                    <label><input type="radio" name="nModoPDF" value="1"/> Sim </label>
                                    <label><input type="radio" name="nModoPDF" value="0" checked="checked" /> Não </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="submit" name="nBuscarBT" value="BuscarBT" class="btn btn-warning"><i class="fa fa-search pull-left"></i> Buscar</button>
                                </div>
                            </div>
                        </article>
                    </div>
                </section>
            </form>
        </div>
    </div>
    <div class="row">
	<?php
	if (!empty($unidades)) {
	    $qtd = 1;
	    foreach ($unidades as $indice):
		?>
		<div class="col-md-12">
		    <section class="panel <?php echo ($qtd % 2 == 0) ? 'panel-success' : 'panel-black'; ?>">
			<header class="panel-heading">
			    <h4 class="text-upercase"> <?php echo!empty($indice['nome']) ? $indice['nome'] : '' ?> 
				<?php if ($this->checkUser() >= 3): ?>
	    			<span class="pull-right">
	    			    <a class="btn btn-primary btn-xs" href="<?php echo BASE_URL . '/editar/unidade/' . md5($indice['cod']) ?>" title="Editar"><i class="fa fa-pencil-alt"></i></a> 
	    			    <button type="button"  class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal_unidade_<?php echo $indice['cod']; ?>" title="Excluir"><i class="fa fa-trash"></i></button>
	    			</span>
				<?php endif; ?>
			    </h4>
			</header>
			<?php
			if (!empty($indice['servidor'])) {
			    ?>
	    		<article class="table-responsive">
	    		    <table class="table table-striped table-bordered table-hover table-condensed">
	    			<tr>
	    			    <th>#</th>
	    			    <th>Servidor</th>
	    			    <th>SIAPE</th>
	    			    <th>Nº do Ato</th>
	    			    <th>Tipo do Ato</th>
	    			    <th>Modalidade</th>
	    			    <th>Período</th>
	    			</tr>
				    <?php
				    $qtd2 = 1;
				    foreach ($indice['servidor'] as $indice):
					?>
					<tr>
					    <td><?php echo $qtd2 ?></td>
					    <td><a href="<?php echo BASE_URL . "/servidor/index/" . md5($indice['cod']) ?>"><?php echo!empty($indice['nome']) ? $indice['nome'] : '' ?></a></td>
					    <td><?php echo!empty($indice['siape']) ? $indice['siape'] : '' ?></td>
					    <td><?php echo!empty($indice['numero_ato']) ? $indice['numero_ato'] : '' ?></td>
					    <td><?php echo!empty($indice['ato']) ? $indice['ato'] : '' ?></td>
					    <td><?php echo!empty($indice['modalidade']) ? $indice['modalidade'] : '' ?></td>
					    <td><?php echo!empty($indice['inicio']) ? $this->formatDateView($indice['inicio']) : '' ?> - <?php echo!empty($indice['termino']) ? $this->formatDateView($indice['termino']) : '' ?></td>
					</tr>
					<?php
					$qtd2++;
				    endforeach;
				    ?>
	    		    </table>
	    		</article>
			    <?php
			} else {
			    echo '<article class="panel-body"><p class="text-danger"><i class="fa fa-times"></i> Desculpe, não foi possível localizar nenhum servidor registrado nesta unidade.</p></article>';
			}
			?>
		    </section>
		</div>
		<?php
		$qtd++;
	    endforeach;
	} else {
	    echo '<div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-times"></i> Desculpe, não foi possível localizar nenhum registro !
                    </div>
                </div>';
	}
	?>
    </div>
    <!--inicio da paginação-->
    <?php
    if (ceil($paginas) > 1) {
	?>
        <div class = "row">
    	<div class = "col-sm-12 col-md-12 col-lg-12">
    	    <ul class = "pagination">
		    <?php
		    echo "<li><a href='" . BASE_URL . "/relatorio/unidade/1" . $metodo_buscar . "'>&laquo;</a></li>";
		    for ($p = 0; $p < ceil($paginas); $p++) {
			if ($pagina_atual == ($p + 1)) {
			    echo "<li class='active'><a href='" . BASE_URL . "/relatorio/unidade/" . ($p + 1) . $metodo_buscar . "'>" . ($p + 1) . "</a></li>";
			} else {
			    echo "<li><a href='" . BASE_URL . "/relatorio/unidade/" . ($p + 1) . $metodo_buscar . "'>" . ($p + 1) . "</a></li>";
			}
		    }
		    echo "<li><a href='" . BASE_URL . "/relatorio/unidade/" . ceil($paginas) . $metodo_buscar . "'>&raquo;</a></li>";
		    ?>
    	    </ul>
    	</div> 
        </div> 

    <?php }
    ?>
    <!--fim da paginação-->
</div>

<?php
if ($this->checkUser() >= 3):
    if (isset($unidades) && is_array($unidades)) :
	foreach ($unidades as $indice) :
	    ?>        
	    <!--MODAL - ESTRUTURA BÁSICA-->
	    <section class="modal fade" id="modal_unidade_<?php echo $indice['cod'] ?>" tabindex="-1" role="dialog">
	        <article class="modal-dialog modal-md" role="document">
	    	<section class="modal-content">
	    	    <header class="modal-header bg-primary">
	    		<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    		<h4 >Deseja remover este registro?</h4>
	    	    </header>
	    	    <article class="modal-body">
	    		<ul class="list-unstyled">
	    		    <li><b>Unidade: </b> <?php echo!empty($indice['nome']) ? $indice['nome'] : '' ?>;</li>
	    		    <li><b>Servidores cadastrados: </b> <?php echo isset($indice['servidor']) && !empty($indice['servidor']) ? count($indice['servidor']) : '0' ?>.</li>
	    		</ul>
	    		<p class="text-justify text-danger"><span class="font-bold">OBS : </span> Ao clicar em "Excluir", este registro e todos registos relacionados ao mesmo deixaram de existir no sistema.</p>
	    	    </article>
	    	    <footer class="modal-footer">
	    		<a class="btn btn-danger pull-left" href="<?php echo BASE_URL . '/excluir/unidade/' . md5($indice['cod']) ?>"> <i class="fa fa-trash"></i> Excluir</a> 
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