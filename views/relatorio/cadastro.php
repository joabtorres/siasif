<div id="section-container">
    <div class="row" >
        <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
            <h2>Relatório de Afastamento</h2>
            <ol class="breadcrumb">
                <li><a href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer-alt"></i> Inicial</a></li>
                <li><a  href="<?php echo BASE_URL ?>/relatorio/servidor"><i class="fa fa-list-alt"></i> Servidor</a></li>
                <li class="text-uppercase"><a  href="<?php echo BASE_URL . '/servidor/index/' . md5($servidor["cod"]) ?>"><i class="fa fa-user"></i> <?php echo!empty($servidor['nome']) ? $servidor['nome'] : '' ?></a></li>
                <li class="active"><i class="fa fa-plus-square"></i> Relatório de Afastamento</li>
            </ol>
        </div>
    </div>
    <!--FIM pagina-header-->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="alert <?php echo (isset($erro['class'])) ? $erro['class'] : 'alert-warning'; ?> " role="alert" id="alert-msg">
                <button class="close" data-hide="alert">&times;</button>
                <div id="resposta"><?php echo (isset($erro['msg'])) ? $erro['msg'] : '<i class = "fa fa-info-circle" aria-hidden = "true"></i> Preencha os campos corretamente.'; ?></div>
            </div>
        </div>
        <div class="col-md-12 clear">
            <form enctype="multipart/form-data" autocomplete="off" method="POST">
                <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
                <input type="hidden" name="nCodServido" value="<?php echo!empty($relatorio['servidor_cod']) ? $relatorio['servidor_cod'] : !empty($servidor['cod']) ? $servidor['cod'] : ''; ?>"/>
                <input type="hidden" name="nCod" value="<?php echo!empty($relatorio['cod']) ? $relatorio['cod'] : 0; ?>"/>
                <section class="panel panel-black">
                    <header class="panel-heading">
                        <h4 class="panel-title"><i class="fa fa-circle-notch pull-left"></i>Relatório</h4>
                    </header>
                    <article class="panel-body">
                        <div class="row">
                            <div class="col-md-5 form-group">
                                <label >Servidor: </label>
                                <input type="text" disabled="disabled" class="form-control" value="<?php echo (!empty($servidor['nome'])) ? $servidor['nome'] : ''; ?>"/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label >Modalidade: </label>
                                <input type="text" disabled="disabled" class="form-control" value="<?php echo (!empty($servidor['modalidade'])) ? $servidor['modalidade'] : ''; ?>"/>
                            </div>
                            <div class="col-md-2 form-group">
                                <label >Início: </label>
                                <input type="text" disabled="disabled" class="form-control" value="<?php echo (!empty($servidor['inicio'])) ? $this->formatDateView($servidor['inicio']) : ''; ?>"/>
                            </div>
                            <div class="col-md-2 form-group">
                                <label >Término: </label>
                                <input type="text" disabled="disabled" class="form-control" value="<?php echo (!empty($servidor['termino'])) ? $this->formatDateView($servidor['termino']) : ''; ?>"/>
                            </div>
                            <div class="col-md-3 form-group <?php echo (isset($relatorio_error['data']['class'])) ? $relatorio_error['data']['class'] : ''; ?>">
                                <label for='iData' class="control-label">Data *: <?php echo (isset($relatorio_error['data']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $relatorio_error['data']['msg'] . ' </small>' : ''; ?></label>
                                <input type="text" id="iData" name="nData" class="form-control input-data" placeholder="Exemplo: 01/01/2019" value="<?php echo (!empty($relatorio['data'])) ? $relatorio['data'] : ''; ?>"/>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for='iStatus'>Status: </label><br/>
                                <select class="form-control" name="nStatus" id="iStatus">

                                    <?php
                                    $array = array(array('cod' => '0', 'descricao' => 'Pendente'), array('cod' => '1', 'descricao' => 'Entregue'));
                                    foreach ($array as $indice) {
                                        if (isset($relatorio['status']) && $indice['cod'] == $relatorio['status']) {
                                            echo '<option value = "' . $indice['cod'] . '" selected = "selected">' . $indice['descricao'] . '</option>';
                                        } else {
                                            echo '<option value = "' . $indice['cod'] . '">' . $indice['descricao'] . '</option>';
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-md-7 form-group <?php echo (isset($relatorio_error['anexo']['class'])) ? $relatorio_error['anexo']['class'] : ''; ?>">
                                <label class="control-label">Anexo (PDF): <span id="nome_arquivo" class="text-danger"><?php echo (isset($relatorio_error['anexo']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $relatorio_error['anexo']['msg'] . ' </small>' : ''; ?><?php echo isset($relatorio['anexo']) ? $relatorio['anexo'] : null; ?></span></label><br/>
                                <label class="btn btn-success" for="cFile">Escolher arquivo &#187;</label>
                                <input type="file" id="cFile" name="nFile" onchange="readFile(this)"/><small>OBS: Arquivo em PDF, tamanho máximo de 1024KB.</small>
                                <input type="hidden" name="nFileEnviado"  value="<?php echo isset($relatorio['anexo']) ? $relatorio['anexo'] : null; ?>"/>
                            </div>
                        </div>
                    </article>
                </section>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <button type="submit" class="btn btn-success" name="nSalvar" value="Salvar"><i class="fa fa-check-circle" aria-hidden="true"></i> Salvar</button>
                        <a href="<?php echo BASE_URL ?>/home" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>