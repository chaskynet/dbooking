<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cierre de Caja</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/estilos.css">
</head>
<body>
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
							<th>Tipo Mov</th>
							<th>Tipo Doc</th>
							<th>Num_doc</th>
							<th>Monto</th>
						</tr>
					</thead>
					<tfoot>
						<?php $total = 0; foreach ($detalle_mov as $key) { 

							$total = ($key->tipo_mov == 'ingreso')?$total + $key->monto:$total - $key->monto;
							} ?>
						<tr>
							<td colspan="4">Total</td>
							<td id="total_caja"><?=$total;?></td>
						</tr>
					</tfoot>
					<tbody>
						<?php $i = 1; foreach ($detalle_mov as $key) { ?>
						<tr>
							<td><?=$i;?></td>
							<td><?=$key->tipo_mov;?></td>
							<td><?=$key->tipo_doc;?></td>
							<td><?=$key->num_doc?></td>
							<td><?=$key->monto;?></td>
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