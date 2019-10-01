<div id="section-container">
    <div class="row" >
        <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
            <h2>Inicial</h2>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-tachometer-alt"></i> Inicial</li>
            </ol>
        </div>
    </div>
    <!--FIM pagina-header-->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                Olá <strong><?php echo trim($_SESSION['usuario_siasif']['nome']); ?></strong>, bem-vindo ao Sistema de Gerenciamento de Afastamento para Qualificação de Servidores do IFPA - SIASIF.
            </div>
        </div>
    </div>
    <!--FIM .ROW-->
    <div class="row">
        <div class="col-md-6">
            <section class=" panel panel-black">
                <header class="panel-heading">
                    <i class="fa fa-chart-pie fa-3x pull-left" ></i>
                    <h4 class="panel-title font-bold">Modalidades </h4>
		    <div>Servidores com status afastado</div>
                </header>
                <article class="panel-body">
                    <canvas id="grafico_tipo_modalidade" width="100%"></canvas>
                </article>
            </section>
        </div>
        <div class="col-md-6">
            <section class=" panel panel-black">
                <header class="panel-heading">
                    <i class="fa fa-chart-pie fa-3x pull-left" ></i>
                    <h4 class="panel-title font-bold">Relatórios</h4>
		    <div>Servidores com status afastado</div>
                </header>
                <article class="panel-body">
                    <canvas id="grafico_status_relatorio" width="100%"></canvas>
                </article>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <section class=" panel panel-black">
                <header class="panel-heading">
                    <i class="fa fa-chart-pie fa-3x pull-left" ></i>
                    <h4 class="panel-title font-bold">Categorias </h4>
		    <div>Servidores com status afastado</div>
                </header>
                <article class="panel-body">
                    <canvas id="grafico_tipo_categoria" width="100%"></canvas>
                </article>
            </section>
        </div>
        <div class="col-md-6">
            <section class=" panel panel-black">
                <header class="panel-heading">
                    <i class="fa fa-chart-pie fa-3x pull-left" ></i>
                    <h4 class="panel-title font-bold">Tipo do Afastamento </h4>
                    <div>Servidores com status afastado</div>
                </header>
                <article class="panel-body">
                    <canvas id="grafico_tipo_afastamento" width="100%"></canvas>
                </article>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class=" panel panel-black">
                <header class="panel-heading">
                    <i class="fa fa-chart-bar fa-3x pull-left" ></i>
                    <h4 class="panel-title font-bold">Unidades </h4>
                    <div>Servidores afastados por campus</div>
                </header>
                <article class="panel-body">
                    <canvas id="grafico_servidores_por_unidades"  height="80vh" ></canvas>
                </article>
            </section>
        </div>
    </div>

</div>
<!-- /#section-container -->


<script src="<?php echo BASE_URL ?>/assets/js/Chart.min.js"></script>


<script>
    //variaveis de servidores afastados por modalidade
    var mestrado = 0;
    var minter = 0;
    var doutorado = 0;
    var dinter = 0;
    var posDoutorado = 0;
</script>

<?php
if (isset($modalidade) && is_array($modalidade)) {
    echo "<script> ";
    foreach ($modalidade as $indice) {
	switch ($indice['modalidade']) {
	    case "Mestrado":
		echo "var mestrado = " . $indice['qtd'] . "; ";
		break;
	    case "MINTER/Estágio":
		echo "var minter = " . $indice['qtd'] . "; ";
		break;
	    case "Doutorado":
		echo "var doutorado = " . $indice['qtd'] . "; ";
		break;
	    case "DINTER/Estágio":
		echo "var dinter = " . $indice['qtd'] . "; ";
		break;
	    case "Pós-Doutorado":
		echo "var posDoutorado = " . $indice['qtd'] . "; ";
		break;
	}
    }
    echo "</script> ";
}
echo "<script> ";
echo "var emdias = " . $relatorio['emdias'] . "; ";
echo "var pendentes = " . $relatorio['pendente'] . "; ";
echo " </script>";
?>

<script>
    //variaveis de servidores afastados por  categoria
    var docente = 0;
    var tae = 0;
</script>

<?php
if (isset($categoria) && is_array($categoria)) {
    echo "<script>";
    foreach ($categoria as $indice) {
	switch ($indice['categoria']) {
	    case "Docente":
		echo " var docente = " . $indice['qtd'] . "; ";
		break;
	    case "TAE":
		echo " var tae = " . $indice['qtd'] . "; ";
		break;
	}
    }
    echo "</script>";
}
?>
<script>
   //variaveis de servidores afastados por tipo de afastamento
    var parcial = 0;
    var total = 0;
</script>

<?php
if (isset($afastamento) && is_array($afastamento)) {

    foreach ($afastamento as $indice) {
	switch ($indice['afastamento']) {
	    case "Parcial":
		echo "<script> var parcial = " . $indice['qtd'] . "</script>";
		break;
	    case "Total":
		echo "<script> var total = " . $indice['qtd'] . "</script>";
		break;
	}
    }
}
?>

<script>

    //variaveis de servidores afastados por unidades
    var abatetuba = 0;
    var altamira = 0;
    var ananindeua = 0;
    var belem = 0;
    var braganca = 0;
    var breves = 0;
    var cameta = 0;
    var castanhal = 0;
    var itaituba = 0;
    var araguaia = 0;
    var maraba_industrial = 0;
    var maraba_rural = 0;
    var obidos = 0;
    var paragominas = 0;
    var parauapebas = 0;
    var santarem = 0;
    var tucurui = 0;
    var vigia = 0;
    var reitoria = 0;
</script>
<?php
if (isset($unidade) && is_array($unidade)) {
    echo " <script> ";
    foreach ($unidade as $indice) {
	switch ($indice['cod']) {
	    case 1: // 	IFPA - Campus Abaetetuba
		echo "var abatetuba = " . $indice['qtd'] . "; ";
		break;
	    case 2: // 	IFPA - Campus Altamira
		echo "var altamira = " . $indice['qtd'] . "; ";
		break;
	    case 3: //IFPA - Campus Ananindeua
		echo "var ananindeua = " . $indice['qtd'] . "; ";
		break;
	    case 4: //IFPA - Campus Belém
		echo "var belem = " . $indice['qtd'] . "; ";
		break;
	    case 5: // 	IFPA - Campus Bragança
		echo "var braganca = " . $indice['qtd'] . "; ";
		break;
	    case 6: //IFPA - Campus Breves
		echo "var breves = " . $indice['qtd'] . "; ";
		break;
	    case 7: // 	IFPA - Campus Cametá
		echo "var cameta = " . $indice['qtd'] . "; ";
		break;
	    case 8:// 	IFPA - Campus Castanhal 
		echo "var castanhal = " . $indice['qtd'] . "; ";
		break;
	    case 9: //  IFPA - Campus Itaituba
		echo "var itaituba = " . $indice['qtd'] . "; ";
		break;
	    case 10://IFPA - Campus Conceição Araguaia 
		echo "var araguaia = " . $indice['qtd'] . "; ";
		break;
	    case 11: // IFPA - Campus Marabá Industrial
		echo "var maraba_industrial = " . $indice['qtd'] . "; ";
		break;
	    case 12: // IFPA - Campus Marabá Rural
		echo "var maraba_rural = " . $indice['qtd'] . "; ";
		break;
	    case 13: //IFPA - Campus Óbidos
		echo "var obidos = " . $indice['qtd'] . "; ";
		break;
	    case 14: //IFPA - Campus Paragominas 
		echo "var paragominas = " . $indice['qtd'] . "; ";
		break;
	    case 15: //IFPA - Campus Parauapebas 
		echo "var parauapebas = " . $indice['qtd'] . "; ";
		break;
	    case 16: //IFPA - Campus Santarém 
		echo "var santarem = " . $indice['qtd'] . "; ";
		break;
	    case 17: //IFPA - Campus Tucuruí 
		echo "var tucurui = " . $indice['qtd'] . "; ";
		break;
	    case 18: //IFPA - Campus Vigia 
		echo "var vigia = " . $indice['qtd'] . "; ";
		break;
	    case 19: // Reitoria
		echo "var reitoria = " . $indice['qtd'] . "; ";
		break;
	}
    }
    echo "</script> ";
}
?>
<script type="text/javascript">
    graficoStatusRelatorio();
    graficoTipoModalidadesAfastadas();
    graficoTipoCategoriasAfastadas();
    graficoTipoAfastamento();
    graficoServidoresAfastadosPorUnidades();
    function graficoTipoModalidadesAfastadas() {
	var data = {
	    datasets: [{
		    data: [mestrado, minter, doutorado, dinter, posDoutorado],
		    backgroundColor: [
			'#00a950',
			'#58595b',
			'#dd4b39',
			'#537bc4',
			'#f67019',
			'#acc236',
			'#8549ba',
			'#56d798',
			'#f53794',
			'#4dc9f6',
			'#dd4b39',
			'#f38b4a',
			'#56d798',
			'#f67019',
			'#166a8f'
		    ],
		    hoverBackgroundColor: [
			'#00a950',
			'#58595b',
			'#dd4b39',
			'#537bc4',
			'#f67019',
			'#acc236',
			'#8549ba',
			'#56d798',
			'#f53794',
			'#4dc9f6',
			'#dd4b39',
			'#f38b4a',
			'#56d798',
			'#f67019',
			'#166a8f'
		    ]
		}],
	    labels: [
		'Mestrado', 'MINTER/Estágio', 'Doutorado', 'DINTER/Estágio', 'Pós-Doutorado'
	    ]
	};
	var option = {
	    responsive: true,
	    legend: {
		position: 'right'
	    },
	    title: {
		display: false,
		text: 'Modalidades Registrados'
	    },
	    animation: {
		animateScale: true,
		animateRotate: true
	    }
	};
	var ctx = document.getElementById("grafico_tipo_modalidade");
	var myChart = new Chart(ctx, {
	    type: 'doughnut',
	    data: data,
	    options: option
	});
    }

    function graficoStatusRelatorio() {
	var data = {
	    datasets: [{
		    data: [emdias, pendentes],
		    backgroundColor: [
			'#00a950',
			'#58595b',
			'#dd4b39',
			'#537bc4',
			'#f67019',
			'#acc236',
			'#8549ba',
			'#56d798',
			'#f53794',
			'#4dc9f6',
			'#dd4b39',
			'#f38b4a',
			'#56d798',
			'#f67019',
			'#166a8f'
		    ],
		    hoverBackgroundColor: [
			'#00a950',
			'#58595b',
			'#dd4b39',
			'#537bc4',
			'#f67019',
			'#acc236',
			'#8549ba',
			'#56d798',
			'#f53794',
			'#4dc9f6',
			'#dd4b39',
			'#f38b4a',
			'#56d798',
			'#f67019',
			'#166a8f'
		    ]
		}],
	    labels: [
		'Em dias',
		'Pendentes'
	    ]
	};
	var option = {
	    responsive: true,
	    legend: {
		position: 'right'
	    },
	    title: {
		display: false,
		text: 'Servidores Registrados'
	    },
	    animation: {
		animateScale: true,
		animateRotate: true
	    }
	};
	var ctx = document.getElementById("grafico_status_relatorio");
	var myChart = new Chart(ctx, {
	    type: 'doughnut',
	    data: data,
	    options: option
	});
    }
    function graficoTipoCategoriasAfastadas() {
	var data = {
	    datasets: [{
		    data: [docente, tae],
		    backgroundColor: [
			'#00a950',
			'#58595b',
			'#dd4b39',
			'#537bc4',
			'#f67019',
			'#acc236',
			'#8549ba',
			'#56d798',
			'#f53794',
			'#4dc9f6',
			'#dd4b39',
			'#f38b4a',
			'#56d798',
			'#f67019',
			'#166a8f'
		    ],
		    hoverBackgroundColor: [
			'#00a950',
			'#58595b',
			'#dd4b39',
			'#537bc4',
			'#f67019',
			'#acc236',
			'#8549ba',
			'#56d798',
			'#f53794',
			'#4dc9f6',
			'#dd4b39',
			'#f38b4a',
			'#56d798',
			'#f67019',
			'#166a8f'
		    ]
		}],
	    labels: [
		'Docente', 'TAE'
	    ]
	};
	var option = {
	    responsive: true,
	    legend: {
		position: 'right'
	    },
	    title: {
		display: false,
		text: 'Modalidades Registrados'
	    },
	    animation: {
		animateScale: true,
		animateRotate: true
	    }
	};
	var ctx = document.getElementById("grafico_tipo_categoria");
	var myChart = new Chart(ctx, {
	    type: 'doughnut',
	    data: data,
	    options: option
	});
    }
    function graficoTipoAfastamento() {
	var data = {
	    datasets: [{
		    data: [parcial, total],
		    backgroundColor: [
			'#00a950',
			'#58595b',
			'#dd4b39',
			'#537bc4',
			'#f67019',
			'#acc236',
			'#8549ba',
			'#56d798',
			'#f53794',
			'#4dc9f6',
			'#dd4b39',
			'#f38b4a',
			'#56d798',
			'#f67019',
			'#166a8f'
		    ],
		    hoverBackgroundColor: [
			'#00a950',
			'#58595b',
			'#dd4b39',
			'#537bc4',
			'#f67019',
			'#acc236',
			'#8549ba',
			'#56d798',
			'#f53794',
			'#4dc9f6',
			'#dd4b39',
			'#f38b4a',
			'#56d798',
			'#f67019',
			'#166a8f'
		    ]
		}],
	    labels: [
		'Parcial', 'Total'
	    ]
	};
	var option = {
	    responsive: true,
	    legend: {
		position: 'right'
	    },
	    title: {
		display: false,
		text: 'Modalidades Registrados'
	    },
	    animation: {
		animateScale: true,
		animateRotate: true
	    }
	};
	var ctx = document.getElementById("grafico_tipo_afastamento");
	var myChart = new Chart(ctx, {
	    type: 'doughnut',
	    data: data,
	    options: option
	});
    }

    function graficoServidoresAfastadosPorUnidades() {
	var horizontalBarChartData = {
	    labels: [],
	    datasets: [{
		    label: 'Abaetetuba',
		    backgroundColor: gera_cor(),
		    borderWidth: 1,
		    data: [
			abatetuba, 0
		    ]
		}, {
		    label: 'Altamira',
		    backgroundColor: gera_cor(),
		    data: [
			altamira, 0
		    ]
		}, {
		    label: 'Ananindeua',
		    backgroundColor: gera_cor(),
		    data: [
			ananindeua, 0
		    ]
		}, {
		    label: 'Belém',
		    backgroundColor: gera_cor(),
		    data: [
			belem, 0
		    ]
		}, {
		    label: 'Bragança',
		    backgroundColor: gera_cor(),
		    data: [
			braganca, 0
		    ]
		}, {
		    label: 'Breves',
		    backgroundColor: gera_cor(),
		    data: [
			breves, 0
		    ]
		}, {
		    label: 'Caméta',
		    backgroundColor: gera_cor(),
		    data: [
			cameta, 0
		    ]
		}, {
		    label: 'Castanhal',
		    backgroundColor: gera_cor(),
		    data: [
			castanhal, 0
		    ]
		}, {
		    label: 'Itaituba',
		    backgroundColor: gera_cor(),
		    data: [
			itaituba, 0
		    ]
		}, {
		    label: 'Conceição Araguaia',
		    backgroundColor: gera_cor(),
		    data: [
			araguaia, 0
		    ]
		}, {
		    label: 'Marabá Industrial',
		    backgroundColor: gera_cor(),
		    data: [
			maraba_industrial, 0
		    ]
		}, {
		    label: 'Maraba Rural',
		    backgroundColor: gera_cor(),
		    data: [
			maraba_rural, 0
		    ]
		}, {
		    label: 'Óbidos',
		    backgroundColor: gera_cor(),
		    data: [
			obidos, 0
		    ]
		}, {
		    label: 'Paragominas',
		    backgroundColor: gera_cor(),
		    data: [
			paragominas, 0
		    ]
		}, {
		    label: 'Parauapebas',
		    backgroundColor: gera_cor(),
		    data: [
			parauapebas, 0
		    ]
		}, {
		    label: 'Santarém',
		    backgroundColor: gera_cor(),
		    data: [
			santarem, 0
		    ]
		}, {
		    label: 'Tucuruí',
		    backgroundColor: gera_cor(),
		    data: [
			tucurui, 0
		    ]
		}, {
		    label: 'Vigia',
		    backgroundColor: gera_cor(),
		    data: [
			vigia, 0
		    ]
		}, {
		    label: 'Reitoria',
		    backgroundColor: gera_cor(),
		    data: [
			reitoria, 0
		    ]
		}
	    ]

	};
	var option = {

	    elements: {
		rectangle: {
		    borderWidth: 1
		}
	    },
	    responsive: true,
	    legend: {
		position: 'right'
	    },
	    title: {
		display: false,
		text: 'Servidores afastado por unidades'
	    }
	};
	window.onload = function () {
	    var ctx = document.getElementById('grafico_servidores_por_unidades').getContext('2d');
	    window.myHorizontalBar = new Chart(ctx, {
		type: 'bar',
		data: horizontalBarChartData,
		options: option
	    });
	};
    }

    function gera_cor() {
	var hexadecimais = '0123456789ABCDEF';
	var cor = '#';

	// Pega um número aleatório no array acima
	for (var i = 0; i < 6; i++) {
	    //E concatena à variável cor
	    cor += hexadecimais[Math.floor(Math.random() * 16)];
	}
	return cor;
    }
</script>