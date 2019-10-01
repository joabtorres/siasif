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
		    <h4>Relatório de Informações Consolidadas</h4>
		</td>
	    </tr>
	</table>
	<table class="table">
            <tr>
		<th colspan="2">Unidade</th>
		<th>Área de Atuação</th>
		<th>Status</th>
		<th>Tipo de Afastamento</th>
		<th>Modalidade</th>
		<th>Categoria</th>
	    </tr>
	    <tr>
		<td colspan="2"><?php echo (isset($consulta['unidade']) && !empty($consulta['unidade'])) ? $consulta['unidade'] : 'Todas'; ?></td>
		<td><?php echo (isset($consulta['atuacao']) && !empty($consulta['atuacao'])) ? $consulta['atuacao'] : 'Todas'; ?></td>
		<td><?php echo (isset($consulta['status']) && !empty($consulta['status'])) ? $consulta['status'] : 'Todos'; ?></td>
		<td><?php echo (isset($consulta['ato']) && !empty($consulta['ato'])) ? $consulta['ato'] : 'Todos'; ?></td>
		<td><?php echo (isset($consulta['modalidade']) && !empty($consulta['modalidade'])) ? $consulta['modalidade'] : 'Todas'; ?></td>
		<td><?php echo (isset($consulta['categoria']) && !empty($consulta['categoria'])) ? $consulta['categoria'] : 'Todas'; ?></td>
	    </tr>    

	    <tr>
		<th>Destino</th>
		<th>Relatórios</th>
		<th>Defesa</th>
		<th>Prorrogação</th>
		<th>Data de Início</th>
		<th>Data de Término</th>
		<th>Servidor</th>
	    </tr>

	    <tr>
		<td><?php echo (isset($consulta['destino']) && !empty($consulta['destino'])) ? $consulta['destino'] : 'Todos'; ?></td>
		<td><?php echo (isset($consulta['relatorio']) && !empty($consulta['relatorio'])) ? $consulta['relatorio'] : 'Todas'; ?></td>
		<td><?php echo (isset($consulta['defesa']) && !empty($consulta['defesa'])) ? $consulta['defesa'] : 'Todos'; ?></td>
		<td><?php echo (isset($consulta['prorrogacao']) && !empty($consulta['prorrogacao'])) ? $consulta['prorrogacao'] : 'Todos'; ?></td>
		<td><?php echo (isset($consulta['inicio']) && !empty($consulta['inicio'])) ? $consulta['inicio'] : ''; ?></td>
		<td><?php echo (isset($consulta['termino']) && !empty($consulta['termino'])) ? $consulta['termino'] : ''; ?></td>
		<td><?php echo (isset($consulta['nome']) && !empty($consulta['nome'])) ? $consulta['nome'] : ''; ?></td>
	    </tr>   
        </table>
	<?php
	if (!empty($unidades)) {
	    $qtd = 1;
	    foreach ($unidades as $indice):
		?>
		<h4 class="text-upercase"> <?php echo!empty($indice['nome']) ? $indice['nome'] : '' ?> 
		    <table class="table">
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
			if (isset($indice['servidor'])) {
			    $qtd2 = 1;
			    foreach ($indice['servidor'] as $indice):
				?>
				<tr>
				    <td><?php echo $qtd2 ?></td>
				    <td><?php echo!empty($indice['nome']) ? $indice['nome'] : '' ?></td>
				    <td><?php echo!empty($indice['siape']) ? $indice['siape'] : '' ?></td>
				    <td><?php echo!empty($indice['numero_ato']) ? $indice['numero_ato'] : '' ?></td>
				    <td><?php echo!empty($indice['ato']) ? $indice['ato'] : '' ?></td>
				    <td><?php echo!empty($indice['modalidade']) ? $indice['modalidade'] : '' ?></td>
				    <td><?php echo!empty($indice['inicio']) ? $this->formatDateView($indice['inicio']) : '' ?> - <?php echo!empty($indice['termino']) ? $this->formatDateView($indice['termino']) : '' ?></td>
				</tr>
				<?php
				$qtd2++;
			    endforeach;
			} else {
			    echo "<tr><td colspan='7'>Desculpe, não foi possível localizar nenhum registro. </td></tr>";
			}
			?>
		    </table>
		    <?php
		    $qtd++;
		endforeach;
	    }else{
		echo '<i class="fa fa-times"></i> Desculpe, não foi possível localizar nenhum registro!';
	    }
	    ?>
	    <table>
		<tr>

		    <td align="right">Este documento foi gerado em <?php echo $this->formatDateView(date("Y-m-d")) . ' as ' . date("H:i:s", (time() - 10800)) ?>.</td>
		</tr>
	    </table>
    </body>

</html>

<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
$mpdf->WriteHTML($html);
$arquivo = 'ficha_do_servidor_' . md5(time()) . '.pdf';
$mpdf->Output($arquivo, 'I');
?>
