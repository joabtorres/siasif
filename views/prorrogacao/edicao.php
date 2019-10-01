<div id="section-container">
    <div class="row" >
        <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
            <h2>Prorrogação de Afastamento</h2>
            <ol class="breadcrumb">
                <li><a href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer-alt"></i> Inicial</a></li>
                <li><a  href="<?php echo BASE_URL ?>/relatorio/servidor"><i class="fa fa-list-alt"></i> Servidor</a></li>
                <li class="text-uppercase"><a  href="<?php echo BASE_URL . '/servidor/index/' . md5($servidor["cod"]) ?>"><i class="fa fa-user"></i> <?php echo!empty($servidor['nome']) ? $servidor['nome'] : '' ?></a></li>
                <li class="active"><i class="fa fa-plus-square"></i> Prorrogação de Afastamento</li>
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
                <input type="hidden" name="nCodServido" value="<?php echo!empty($prorrogacao['servidor_cod']) ? $prorrogacao['servidor_cod'] : !empty($servidor['cod']) ? $servidor['cod'] : ''; ?>"/>
                <input type="hidden" name="nCod" value="<?php echo!empty($prorrogacao['cod']) ? $prorrogacao['cod'] : 0; ?>"/>
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
                            <div class="col-md-3 form-group <?php echo (isset($prorrogacao_error['numero_ato']['class'])) ? $prorrogacao_error['numero_ato']['class'] : ''; ?>">
                                <label for='iNumeroAto' class="control-label">Nº do Ato:* <?php echo (isset($prorrogacao_error['numero_ato']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $prorrogacao_error['numero_ato']['msg'] . ' </small>' : ''; ?></label>
                                <input type="text" id="iNumeroAto" name="nNumeroAto" class="form-control" placeholder="Exemplo: 2015790058" value="<?php echo (!empty($prorrogacao['numero_ato'])) ? $prorrogacao['numero_ato'] : ''; ?>"/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="iATO" class="control-label">Tipo do Ato:</label><br/>
                                <select id="iATO" name="nATO" class="form-control">

                                    <?php
                                    $array = array('Portaria', 'Resolução');
                                    for ($i = 0; $i < count($array); $i++) {
                                        if ($array[$i] == $prorrogacao['ato']) {
                                            echo '<option value="' . $array[$i] . '" selected>' . $array[$i] . '</option>';
                                        } else {
                                            echo '<option value="' . $array[$i] . '">' . $array[$i] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="col-md-3 form-group <?php echo (isset($prorrogacao_error['inicio']['class'])) ? $prorrogacao_error['inicio']['class'] : ''; ?>">
                                <label for='iInicio' class="control-label">Data de Início:* <?php echo (isset($prorrogacao_error['inicio']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $prorrogacao_error['inicio']['msg'] . ' </small>' : ''; ?></label>
                                <input type="text" id="iInicio" name="nInicio" class="form-control input-data" placeholder="Exemplo: 01/01/2019" value="<?php echo (!empty($prorrogacao['inicio'])) ? $this->formatDateView($prorrogacao['inicio'])  : ''; ?>"/>
                            </div>
                            <div class="col-md-3 form-group <?php echo (isset($prorrogacao_error['termino']['class'])) ? $prorrogacao_error['termino']['class'] : ''; ?>">
                                <label for='iTermino' class="control-label">Data de Término:* <?php echo (isset($prorrogacao_error['termino']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $prorrogacao_error['termino']['msg'] . ' </small>' : ''; ?></label>
                                <input type="text" id="iTermino" name="nTermino" class="form-control input-data" placeholder="Exemplo: 31/12/2020" value="<?php echo (!empty($prorrogacao['termino'])) ? $this->formatDateView($prorrogacao['termino']) : ''; ?>"/>
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