<div id="section-container">
    <div class="row" >
        <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
            <h2>Cadastrar Servidor</h2>
            <ol class="breadcrumb">
                <li><a href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer-alt"></i> Inicial</a></li>
                <li class="active"><i class="fa fa-user-plus"></i> Cadastrar Servidor</li>
            </ol>
        </div>
    </div>
    <!--FIM pagina-header-->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="alert <?php echo (isset($erro['class'])) ? $erro['class'] : 'alert-warning'; ?> " role="alert" id="alert-msg">
                <button class="close" data-hide="alert">&times;</button>
                <div id="resposta"><?php echo (isset($erro['msg'])) ? $erro['msg'] : '<i class="fa fa-info-circle" aria-hidden="true"></i> Preencha os campos corretamente.'; ?></div>
            </div>
        </div>
        <div class="col-md-12 clear">
            <form method="POST" enctype="multipart/form-data" autocomplete="off" id="form_servidor">
                <input type="hidden" name="nCod" value="<?php echo!empty($unidade['cod']) ? $unidade['cod'] : 0; ?>"/>
                <section class="panel panel-black">
                    <header class="panel-heading">
                        <h4 class="panel-title"><i class="fa fa-user pull-left"></i>Dados Pessoais</h4>
                    </header>
                    <article class="panel-body">
                        <div class="col-md-3 col-lg-2">
                            <p class="text-center" id="fotos">
                                <img src="<?php echo (isset($servidor['imagem']) && !empty($servidor['imagem'])) ? BASE_URL . '/' . $servidor['imagem'] : BASE_URL . '/assets/imagens/foto_ilustrato3x4.png'; ?>" class="img-center img-responsive" alt="Usuario" id="viewImagem-1"/>
                                <input type="hidden" name="qtd_fotos" value="1">
                                <label class="btn btn-success" for="cFileImagem">Escolher Imagem</label>
                                <input type="file" name="tImagem-1" id="cFileImagem" onchange="readURL(this)"/>
                                <input type="hidden" name="nImagemCooperado"  value="<?php echo isset($servidor['imagem']) ? $servidor['imagem'] : null; ?>"/>
                            </p>
                        </div>
                        <div class="col-md-9 col-lg-10">
                            <div class="row">
                                <div class="col-md-5 form-group <?php echo (isset($servidor_error['nome']['class'])) ? $servidor_error['nome']['class'] : ''; ?>">
                                    <label for='iNome' class="control-label">Nome:* <?php echo (isset($servidor_error['nome']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $servidor_error['nome']['msg'] . ' </small>' : ''; ?></label>
                                    <input type="text" id="iNome" name="nNome" class="form-control" placeholder="Exemplo: Joab Torres Alencar" value="<?php echo (!empty($servidor['nome'])) ? $servidor['nome'] : ''; ?>"/>
                                </div>                                
                                <div class="col-md-2 form-group">
                                    <label for='iStatus'>Status:* </label><br/>
                                    <select class="form-control" name="nStatus" id="iStatus">

                                        <?php
                                        $array = array(array('cod' => '0', 'descricao' => 'Afastado'), array('cod' => '1', 'descricao' => 'Concluído'));
                                        foreach ($array as $indice) {
                                            if (isset($servidor['status']) && $indice['cod'] == $servidor['status']) {
                                                echo '<option value = "' . $indice['cod'] . '" selected = "selected">' . $indice['descricao'] . '</option>';
                                            } else {
                                                echo '<option value = "' . $indice['cod'] . '">' . $indice['descricao'] . '</option>';
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for='iUnidade'>Unidade:* </label>
                                    <select class="form-control" name="nUnidade"  id="iUnidade">
                                        <?php
                                        if (is_array($unidades)):
                                            foreach ($unidades as $indice) {
                                                if (!empty($servidor['unidade_cod']) && $servidor['unidade_cod'] == $indice['cod']) {
                                                    echo "<option value=" . $indice['cod'] . " selected>" . $indice['nome'] . "</option>";
                                                } else {
                                                    echo "<option value=" . $indice['cod'] . ">" . $indice['nome'] . "</option>";
                                                }
                                            }
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">                            
                                <div class="col-md-4 form-group <?php echo (isset($servidor_error['siape']['class'])) ? $servidor_error['siape']['class'] : ''; ?>">
                                    <label for='iSIAPE' class="control-label">SIAPE:* <?php echo (isset($servidor_error['siape']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $servidor_error['siape']['msg'] . ' </small>' : ''; ?></label>
                                    <input type="text" id="iSIAPE" name="nSIAPE" class="form-control" placeholder="Exemplo: 2015790058" value="<?php echo (!empty($servidor['siape'])) ? $servidor['siape'] : ''; ?>"/>
                                </div>
                                <div class="col-md-4 form-group <?php echo (isset($servidor_error['cpf']['class'])) ? $servidor_error['cpf']['class'] : ''; ?>">
                                    <label for='iCPF' class="control-label">CPF:* <?php echo (isset($servidor_error['cpf']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $servidor_error['cpf']['msg'] . ' </small>' : ''; ?></label>
                                    <input type="text" id="iCPF" name="nCPF" class="form-control input-cpf" placeholder="Exemplo: 222.333.555-50" value="<?php echo (!empty($servidor['cpf'])) ? $servidor['cpf'] : ''; ?>"/>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="iGenero" class="control-label">Gênero:</label><br/>
                                    <select id="iGenero" name="nGenero" class="form-control">

                                        <?php
                                        $array = array('Masculino', 'Feminino');
                                        for ($i = 0; $i < count($array); $i++) {
                                            if ($array[$i] == $servidor['genero']) {
                                                echo '<option value="' . $array[$i] . '" selected>' . $array[$i] . '</option>';
                                            } else {
                                                echo '<option value="' . $array[$i] . '">' . $array[$i] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
				<div class="col-md-4 form-group">
                                    <label for="iAtuacao" class="control-label">Área de Atuação:</label><br/>
                                    <select id="iAtuacao" name="nAtuacao" class="form-control">

                                        <?php
                                        $array = array('Artes', 'Ciências Biológicas', 'Ciências Agrárias', 'Ciências da Saúde', 'Ciências Sociais Aplicadas', 'Educação', 'Educação Física', 'Engenharias', 'Filosofia', 'Física', 'Geografia', 'História', 'Informática', 'Língua Portuguesa', 'Matemática', 'Química', 'Sociologia', 'Outros');
                                        for ($i = 0; $i < count($array); $i++) {
                                            if ($array[$i] == $servidor['atuacao']) {
                                                echo '<option value="' . $array[$i] . '" selected>' . $array[$i] . '</option>';
                                            } else {
                                                echo '<option value="' . $array[$i] . '">' . $array[$i] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for='iTelefone' class="control-label">Telefone:</label>
                                    <input type="text" id="iTelefone" name="nTelefone" class="form-control" placeholder="Exemplo: (93) 99244-6665 / (92) 98155-6644" value="<?php echo (!empty($servidor['telefone'])) ? $servidor['telefone'] : ''; ?>"/>
                                </div>
                                <div class="col-md-4 form-group ">
                                    <label for='iEmail' class="control-label">Email:</label>
                                    <input type="email" id="iEmail" name="nEmail" class="form-control" placeholder="Exemplo: joab.alencar@email.com.br" value="<?php echo (!empty($servidor['email'])) ? $servidor['email'] : ''; ?>"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <span class="text-success">Observação: Carregue somente imagens na proporção 3x4, caso contrário a imagem ficará distorcida.</span>
                                </div>
                            </div>
                        </div> <!-- FIM COL-MD-10 -->
                    </article>
                </section>
                <section class="panel panel-black">
                    <header class="panel-heading">
                        <h4 class="panel-title"><i class="fa fa-circle-notch pull-left"></i>Dados do afastamento</h4>
                    </header>
                    <article class="panel-body">
                        <div class="row">
                            <div class="col-md-4 form-group <?php echo (isset($servidor_error['numero_ato']['class'])) ? $servidor_error['numero_ato']['class'] : ''; ?>">
                                <label for='iNumeroAto' class="control-label">Nº do Ato:* <?php echo (isset($servidor_error['numero_ato']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $servidor_error['numero_ato']['msg'] . ' </small>' : ''; ?></label>
                                <input type="text" id="iNumeroAto" name="nNumeroAto" class="form-control" placeholder="Exemplo: 2015790058" value="<?php echo (!empty($servidor['numero_ato'])) ? $servidor['numero_ato'] : ''; ?>"/>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="iATO" class="control-label">Tipo do Ato:</label><br/>
                                <select id="iATO" name="nATO" class="form-control">

                                    <?php
                                    $array = array('Portaria', 'Resolução');
                                    for ($i = 0; $i < count($array); $i++) {
                                        if ($array[$i] == $servidor['ato']) {
                                            echo '<option value="' . $array[$i] . '" selected>' . $array[$i] . '</option>';
                                        } else {
                                            echo '<option value="' . $array[$i] . '">' . $array[$i] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="iAfastamento" class="control-label">Tipo do Afastamento:</label><br/>
                                <select id="iAfastamento" name="nAfastamento" class="form-control">

                                    <?php
                                    $array = array('Parcial', 'Total');
                                    for ($i = 0; $i < count($array); $i++) {
                                        if ($array[$i] == $servidor['afastamento']) {
                                            echo '<option value="' . $array[$i] . '" selected>' . $array[$i] . '</option>';
                                        } else {
                                            echo '<option value="' . $array[$i] . '">' . $array[$i] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4 form-group">
                                <label for="iCategoria" class="control-label">Categoria:</label><br/>
                                <select id="iCategoria" name="nCategoria" class="form-control">

                                    <?php
                                    $array = array('Docente', 'TAE');
                                    for ($i = 0; $i < count($array); $i++) {
                                        if ($array[$i] == $servidor['categoria']) {
                                            echo '<option value="' . $array[$i] . '" selected>' . $array[$i] . '</option>';
                                        } else {
                                            echo '<option value="' . $array[$i] . '">' . $array[$i] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="iModalidade" class="control-label">Modalidade:</label><br/>
                                <select id="iModalidade" name="nModalidade" class="form-control">

                                    <?php
                                    $array = array('Mestrado', 'MINTER/Estágio', 'Doutorado', 'DINTER/Estágio', 'Pós-Doutorado');
                                    for ($i = 0; $i < count($array); $i++) {
                                        if ($array[$i] == $servidor['modalidade']) {
                                            echo '<option value="' . $array[$i] . '" selected>' . $array[$i] . '</option>';
                                        } else {
                                            echo '<option value="' . $array[$i] . '">' . $array[$i] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="iDestino" class="control-label">Destino:</label><br/>
                                <select id="iDestino" name="nDestino" class="form-control">

                                    <?php
                                    $array = array('Nacional', 'Internacional');
                                    for ($i = 0; $i < count($array); $i++) {
                                        if ($array[$i] == $servidor['destino']) {
                                            echo '<option value="' . $array[$i] . '" selected>' . $array[$i] . '</option>';
                                        } else {
                                            echo '<option value="' . $array[$i] . '">' . $array[$i] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12 form-group ">
                                <label for='iInstituicao' class="control-label">Instituição:</label>
                                <input type="text" id="iInstituicao" name="nInstituicao" class="form-control" placeholder="Exemplo: IFPA - Campus Castanhal" value="<?php echo (!empty($servidor['instituicao'])) ? $servidor['instituicao'] : ''; ?>"/>
                            </div>
                        </div>
                    </article>
                </section>
                <section class="panel panel-black">
                    <header class="panel-heading">
                        <h4 class="panel-title"><i class="far fa-calendar-alt"></i> Periodo</h4>
                    </header>
                    <article class="panel-body">
                        <div class="row">
                            <div class="col-md-6 form-group <?php echo (isset($servidor_error['inicio']['class'])) ? $servidor_error['inicio']['class'] : ''; ?>">
                                <label for='iInicio' class="control-label">Data de Início:* <?php echo (isset($servidor_error['inicio']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $servidor_error['inicio']['msg'] . ' </small>' : ''; ?></label>
                                <input type="text" id="iInicio" name="nInicio" class="form-control input-data" placeholder="Exemplo: 01/01/2019" value="<?php echo (!empty($servidor['inicio'])) ? $servidor['inicio'] : ''; ?>"/>
                            </div>
                            <div class="col-md-6 form-group <?php echo (isset($servidor_error['termino']['class'])) ? $servidor_error['termino']['class'] : ''; ?>">
                                <label for='iTermino' class="control-label">Data de Término:* <?php echo (isset($servidor_error['termino']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $servidor_error['termino']['msg'] . ' </small>' : ''; ?></label>
                                <input type="text" id="iTermino" name="nTermino" class="form-control input-data" placeholder="Exemplo: 31/12/2020" value="<?php echo (!empty($servidor['termino'])) ? $servidor['termino'] : ''; ?>"/>
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