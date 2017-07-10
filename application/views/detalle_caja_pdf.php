<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cierre de Caja</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/estilos.css">
	<style>
		table tbody tr td{
			font-size: 9px;
			padding: 5px 5px;
		}
	</style>
</head>
<body style="font-size: 11px;">
<div class="container">

<div class="row-fluid">
		<div class="panel-heading text-center">
			Cierre de Caja <?=date('d/m/Y');?> Usuario: <?=$this->session->userdata['usuario'];?>
			<!-- <button class="btn btn-info">Abrir</button> -->
		</div>
			<div class="panel-body">
			   <table class="table table-condensed" id="detalle_mov">
					<thead>
						<tr>
							<th>#</th>
							<th>Fecha</th>
							<th>I/E</th>
							<th>Concepto</th>
							<th style="width: 6%;">Tipo Doc.</th>
							<th style="width: 6%;">Num. Doc.</th>
							<th>DEBE</th>
							<th>HABER</th>
							<th>Usuario</th>
						</tr>
					</thead>
					<tfoot style="font-size: 14px;font-weight: bold;">
						<?php $total_debe = 0;$total_haber=0; foreach ($detalle_mov as $key) { 
							($key->tipo_mov == 'ingreso')?$total_debe=$total_debe + $key->monto:$total_haber=$total_haber + $key->monto;
							} ?>
						<tr>
							<td colspan="6">Total</td>
							<td id="total_caja" colspan="1"><strong><?=$total_debe;?> Bs.</strong></td>
							<td id="total_caja" colspan="1"><strong><?=$total_haber;?> Bs.</strong></td>
						</tr>
					</tfoot>
					<tbody>
						<?php $i = 0; foreach ($detalle_mov as $key) { ?>
						<tr>
							<td><?=++$i;?></td>
							<td class="text-center" style="width: 3%;">
								<?php
									$date=date_create($key->fecha);
									echo date_format($date,"d/m/Y");
								?>
							</td>
							<td class="text-center" style="width: 4%;"><?=$key->tipo_mov;?></td>
							<td class="text-center"><?=$key->concepto;?></td>
							<td style="width: 6%;"><?=$key->tipo_doc;?></td>
							<td style="width: 6%;" class="text-center"><?=$key->num_doc;?></td>
							<?php if ($key->tipo_mov == 'ingreso') { ?>
								<td class="cantidad"><?=$key->monto;?></td>
								<td class="cantidad">0.00</td>							
							<?php } else{ ?>
								<td class="cantidad">0.00</td>
								<td class="cantidad"><?=$key->monto;?></td>
							<?php }?>
							<td><?=$key->usuario;?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
	</div>
</div>
</div>
</body>
</html>