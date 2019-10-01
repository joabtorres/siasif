<?php
ob_start();
?>

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
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/relatorio.css" media=”print” >
    </head>

    <body>
	<table style="width:100%;">	    
	    <tr>
		<td align="left">
		    <img src="<?php echo BASE_URL . '/assets/imagens/logo_siasif_pdf.png'; ?>" alt="Logo" style="width: 170px;"/>
		</td>
		<td align="left">
		    <img src="<?php echo BASE_URL . '/assets/imagens/logo_proppg.png'; ?>" alt="Logo" style="width: 150px;"/>
		</td>
		<td align="right">
		    <img src="<?php echo BASE_URL . '/assets/imagens/ifpa.png'; ?>" alt="Logo" style="width: 100px;"/>
		</td>
	    </tr>
	    <tr>
		<td align="center" colspan="3">
		    <p>Sistema de Gerenciamento de Afastamento para Qualificação de Servidores do IFPA - SIASIF</p><br/>
		    <h4>Perfil do Servidor</h4>
		</td>
	    </tr>
	</table>

        <table class="table">
            <tr>
                <th colspan="4"><h4 class="text-destaque">Dados Pessoais</h4></th>
            </tr>
            <tr>
                <td rowspan="4"><img src="<?php echo!empty($servidor['imagem']) ? BASE_URL . '/' . $servidor['imagem'] : BASE_URL . '/assets/imagens/foto_ilustrato3x4.png' ?>" width="100px"/></td>
            </tr>
            <tr>
                <td><span class="text-destaque">Nome:</span><br> <?php echo!empty($servidor['nome']) ? $servidor['nome'] : '' ?></td>
                <td><span class="text-destaque">Unidade:</span> <br><?php echo!empty($servidor['unidade']) ? $servidor['unidade'] : '' ?></td>
                <td><span class="text-destaque">Status do Afastamento:</span> <br><?php echo!empty($servidor['status']) ? "Concluído" : "Afastado" ?></td>
            </tr>
            <tr>
                <td><span class="text-destaque">SIAPE:</span> <br><?php echo!empty($servidor['siape']) ? $servidor['siape'] : '' ?></td>                                      
                <td><span class="text-destaque">CPF:</span> <br><?php echo!empty($servidor['cpf']) ? $servidor['cpf'] : '' ?></td>
                <td><span class="text-destaque">Gênero:</span> <br><?php echo!empty($servidor['genero']) ? $servidor['genero'] : '' ?></td>
            </tr>
            <tr>
                <td ><span class="text-destaque">Área de Atuação:</span> <br><?php echo!empty($servidor['atuacao']) ? $servidor['atuacao'] : '' ?></td>
                <td ><span class="text-destaque">Telefone:</span> <br><?php echo!empty($servidor['telefone']) ? $servidor['telefone'] : '' ?></td>
                <td > <span class="text-destaque">E-mail:</span> <br><?php echo!empty($servidor['email']) ? $servidor['email'] : '' ?></td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <th colspan="3"><h4 class="text-destaque">Dados do afastamento</h4></th>
            </tr>
            <tr>
                <td><span class="text-destaque">Nº do Ato:</span><br> <?php echo!empty($servidor['numero_ato']) ? $servidor['numero_ato'] : '' ?></td>
                <td><span class="text-destaque">Tipo de Ato:</span><br> <?php echo!empty($servidor['ato']) ? $servidor['ato'] : '' ?></td>
                <td><span class="text-destaque">Tipo do Afastamento:</span><br> <?php echo!empty($servidor['afastamento']) ? $servidor['afastamento'] : '' ?></td>
            </tr>
            <tr>
                <td><span class="text-destaque">Categoria:</span><br> <?php echo!empty($servidor['categoria']) ? $servidor['categoria'] : '' ?></td>
                <td><span class="text-destaque">Modalidade:</span><br> <?php echo!empty($servidor['modalidade']) ? $servidor['modalidade'] : '' ?></td>
                <td><span class="text-destaque">Destino:</span><br> <?php echo!empty($servidor['destino']) ? $servidor['destino'] : '' ?></td>
            </tr>
            <tr>
                <td colspan="3"><span class="text-destaque">Instituição:</span><br> <?php echo!empty($servidor['instituicao']) ? $servidor['instituicao'] : '' ?></td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <th colspan="3"><h4 class="text-destaque">Périodo de Afastamento</h4></th>
            </tr>
            <tr>
                <td><span class="text-destaque">Data de Início:</span><br> <?php echo!empty($servidor['inicio']) ? $this->formatDateView($servidor['inicio']) : '' ?></td>
                <td><span class="text-destaque">Data de Término:</span><br> <?php echo!empty($servidor['termino']) ? $this->formatDateView($servidor['termino']) : '' ?></td>
	    </tr>
        </table>

        <table class="table">
	    <tr>
		<th colspan="4"><h4 class="text-destaque">Entrega de Relatórios</h4></th>
	    </tr>
	    <?php
	    if (isset($relatorios) && !empty($relatorios)) {
		$qtd = 1;
		?>
    	    <tr>
    		<th>#</th>
    		<th>Status</th>
    		<th>Data</th>
    		<th>Anexo</th>
    	    </tr>
		<?php
		foreach ($relatorios as $indice):
		    ?>
		    <tr>
			<td><?php echo $qtd ?></td>
			<td><?php echo!empty($indice['status']) ? "Entregue" : "Pendente" ?></td>
			<td><?php echo!empty($indice['data']) ? $this->formatDateView($indice['data']) : '' ?></td>
			<td><?php echo!empty($indice['anexo']) ? '<a href="' . BASE_URL . '/' . $indice['anexo'] . '" download>' . BASE_URL . '/' . $indice['anexo'] . '</a>' : '' ?></td>
		    </tr>
		    <?php
		    $qtd++;
		endforeach;
	    }else {
		echo '<tr><td colspan="4">Desculpe, não foi possível localizar nenhum registro.</td></tr>';
	    }
	    ?>

        </table>

        <table class="table">
	    <tr>
		<th colspan="4"> <h4 class="text-destaque"> Ata de Defesa</h4></th>
	    </tr>
	    <?php
	    if (isset($defesa) && !empty($defesa)) {
		$qtd = 1;
		?>
    	    <tr>
    		<th>#</th>
    		<th>Status</th>
    		<th>Data</th>
    		<th>Anexo</th>
    	    </tr>
		<?php
		foreach ($defesa as $indice):
		    ?>
		    <tr>
			<td><?php echo $qtd ?></td>
			<td><?php echo!empty($indice['status']) ? "Entregue" : "Pendente" ?></td>
			<td><?php echo!empty($indice['data']) ? $this->formatDateView($indice['data']) : '' ?></td>
			<td><?php echo!empty($indice['anexo']) ? '<a href="' . BASE_URL . '/' . $indice['anexo'] . '" download>' . BASE_URL . '/' . $indice['anexo'] . '</a>' : '' ?></td>
		    </tr>
		    <?php
		    $qtd++;
		endforeach;
	    }else {
		echo '<tr><td colspan="4">Desculpe, não foi possível localizar nenhum registro.</td></tr>';
	    }
	    ?>

        </table>

        <table class="table">
	    <tr>
		<th colspan="5"><h4 class="text-destaque"> Prorrogação</h4></th>
	    </tr>

	    <?php
	    if (isset($prorrogacao) && !empty($prorrogacao)) {
		$qtd = 1;
		?>
    	    <tr>
    		<th>#</th>
    		<th>Data Inicial</th>
    		<th>Data Final</th>
    		<th>Tipo do Ato</th>
    		<th>Nº do Ato</th>
    	    </tr>
		<?php
		foreach ($prorrogacao as $indice):
		    ?>
		    <tr>
			<td><?php echo $qtd ?></td>
			<td><?php echo!empty($indice['inicio']) ? $this->formatDateView($indice['inicio']) : '' ?></td>
			<td><?php echo!empty($indice['termino']) ? $this->formatDateView($indice['termino']) : '' ?></td>
			<td><?php echo!empty($indice['ato']) ? $indice['ato'] : '' ?></td>
			<td><?php echo!empty($indice['numero_ato']) ? $indice['numero_ato'] : '' ?></td>
		    </tr>
		    <?php
		    $qtd++;
		endforeach;
	    }else {
		echo '<tr><td colspan="4">Desculpe, não foi possível localizar nenhum registro.</td></tr>';
	    }
	    ?>

        </table>
	<table>
	    <tr>
		<td align="right">Este documento foi gerado em <?php echo $this->formatDateView(date("Y-m-d")) . ' as ' . date("H:i:s", (time()-10800)) ?>.</td>
	    </tr>
	</table>
    </body>

</html>

<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
$mpdf->WriteHTML($html);
$arquivo = 'ficha_do_servidor_' . md5(time()) . '.pdf';
$mpdf->Output($arquivo, 'I');
?>
