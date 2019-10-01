<div id="section-container">
    <div class="row" >
        <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
            <h2>Busca Rapida</h2>
            <ol class="breadcrumb">
                <li><a  href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer-alt"></i> Inicial</a></li>
                <li class="active"><i class="fa fa-search"></i> Busca Rapida</li>
            </ol>
        </div>
    </div>
    <!--FIM pagina-header-->
    <?php
    if (isset($servidores) && is_array($servidores)) {
        ?>
        <!--modo de exibição em bloco-->
        <?php
        $qtd = 1;
        $row = 1;
        foreach ($servidores as $indice) :
            echo ($row == 1) ? ' <div class="row">' : '';
            ?>
            <div class="col-md-4">
                <div class="thumbnail">
                    <a href="<?php echo BASE_URL . '/servidor/index/' . md5($indice['cod']) ?>">
                        <img src="<?php echo!empty($indice['imagem']) ? BASE_URL . '/' . $indice['imagem'] : BASE_URL . '/assets/imagens/foto_ilustrato3x4.png' ?>" alt="SIASIF - Usuáio" class="img-responsive img-rounded"/>
                    </a>
                    <p class="text-center text-uppercase font-bold"><?php echo!empty($indice['nome']) ? $indice['nome'] : '' ?></p>
                    <p class="text-center text-capitalize font-bold">SIAPE: <?php echo!empty($indice['siape']) ? $indice['siape'] : '' ?></p>
                    <p class="text-center text-capitalize"><?php echo!empty($indice['unidade']) ? $indice['unidade'] : '' ?></p>
                    <div class="caption text-left">
                        <ul class="list-unstyled">
                            <li><span class="text-success"><i class="fas fa-bullhorn"></i> Nº do Ato:</span>  <?php echo!empty($indice['numero_ato']) ? $indice['numero_ato'] : '' ?></li>
                            <li><span class="text-success"><i class="fas fa-book-reader"></i> Tipo do Ato:</span>  <?php echo!empty($indice['ato']) ? $indice['ato'] : '' ?></li>
                            <li><span class="text-success"><i class="fas fa-graduation-cap"></i> Modalide:</span> <?php echo!empty($indice['modalidade']) ? $indice['modalidade'] : '' ?></li>
                            <li><span class="text-success"><i class="far fa-calendar-alt"></i> Périodo:</span> <?php echo!empty($indice['inicio']) ? $this->formatDateView($indice['inicio']) : '' ?> - <?php echo!empty($indice['termino']) ? $this->formatDateView($indice['termino']) : '' ?></li>
                        </ul>

                    </div>
                </div>
            </div>
            <?php
            echo ($row == 3) ? '</div>' : '';
            if ($row >= 3) {
                $row = 1;
            } else {
                $row++;
            }
            ++$qtd;
        endforeach;
        ?>
        <!--fim modo de exibição em bloco-->
        <!--inicio da paginação-->
        <?php
        if (ceil($paginas) > 1) {
            ?>
            <div class = "row">
                <div class = "col-sm-12 col-md-12 col-lg-12">
                    <ul class = "pagination">
                        <?php
                        echo "<li><a href='" . BASE_URL . "/relatorio/buscarapida/1" . $metodo_buscar . "'>&laquo;</a></li>";
                        for ($p = 0; $p < ceil($paginas); $p++) {
                            if ($pagina_atual == ($p + 1)) {
                                echo "<li class='active'><a href='" . BASE_URL . "/relatorio/buscarapida/" . ($p + 1) . $metodo_buscar ."'>" . ($p + 1) . "</a></li>";
                            } else {
                                echo "<li><a href='" . BASE_URL . "/relatorio/buscarapida/" . ($p + 1) . $metodo_buscar . "'>" . ($p + 1) . "</a></li>";
                            }
                        }
                        echo "<li><a href='" . BASE_URL . "/relatorio/buscarapida/" . ceil($paginas) . $metodo_buscar . "'>&raquo;</a></li>";
                        ?>
                    </ul>
                </div> 
            </div> 
            <!--fim da paginação-->

            <?php
        }
    } else {
        echo '<div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        Desculpe, não foi possível localizar nenhum registro !
                    </div>
                </div>
            </div>';
    }
    ?>
</div>