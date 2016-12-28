<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/estilos.css">
</head>
<body>
<div class="container">

<div class="row-fluid">
		<div class="panel-heading text-center">
			Reporte de Habitaciones <?=date('d/m/Y');?> Usuario: <?=$this->session->userdata['usuario'];?>
			<!-- <button class="btn btn-info">Abrir</button> -->
		</div>

			<div class="panel-body">
			   <table class="table table-hover">
			   		<tr>
			   			<th class="cabecera_tabla">Habitaciones Ocupadas</th>
			   			<td class="text_bold cabecera_tabla"><?=count($detalle_ocupadas);//$ocupadas->ocupadas;?></td>
			   			<?php $i = 0;foreach ($detalle_ocupadas as $key) { ?>
				   			<tr>
				   				<td class="text-center"><?=++$i;?></td>
				   				<td><?=$key->codigo;?></td>
				   			</tr>
			   			<?php } ?>
			   		</tr>
			   		<tr>
			   			<th class="cabecera_tabla">Habitaciones Libres</th>
			   			<td class="text_bold cabecera_tabla"><?=count($detalle_libres); //$libres->libres;?></td>
			   			<?php $j = 0;foreach ($detalle_libres as $key) { ?>
				   			<tr>
				   				<td class="text-center"><?=++$j;?></td>
				   				<td><?=$key->codigo;?></td>
				   			</tr>
			   			<?php } ?>
			   		</tr>
			   		<tr>
			   			<th class="cabecera_tabla">Habitaciones Reservadas</th>
			   			<td class="text_bold cabecera_tabla"><?=count($detalle_reservadas);//$reservadas->reservadas;?></td>
			   			<?php $j = 0;foreach ($detalle_reservadas as $key) { ?>
				   			<tr>
				   				<td class="text-center"><?=++$j;?></td>
				   				<td><?=$key->codigo;?></td>
				   			</tr>
			   			<?php } ?>
			   		</tr>
			   		<tr style="font-size: 15px;background-color: #FC373F;color: white;">
			   			<th style="color:white;">Total Recaudado</th>
			   			<td class="text-right;" style="color: white;"><?=$ingresos->ingresos;?> BS.</td>
			   		</tr>
			   </table>
			</div>
	</div>
	
</div>
</div>
</body>
</html>