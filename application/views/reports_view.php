<div class="row">
	<div class="col-md-6">
	<div class="col-md-5">
		<div class="input-group input-group-sm">
		  <span class="input-group-addon" id="sizing-addon3">Habitación:</span>
		  <input type="text" id="habitacion" class="form-control" placeholder="Habitacion" aria-describedby="sizing-addon3">
		</div>
	</div>
	<div class="col-md-5">
		<div class="input-group input-group-sm">
		  <span class="input-group-addon" id="sizing-addon3">Fch CheckIn:</span>
		  <input type="text" id="fch_ckin" class="form-control" placeholder="Habitacion" aria-describedby="sizing-addon3">
		</div>
	</div>

	<div class="col-md-2">
		<button type="button" class="btn" aria-label="Left Align" id="imprimeReport">
		  <span class="glyphicon glyphicon glyphicon-print" aria-hidden="true"></span>
		</button>
	</div>

	<form action="to_pdf_report" target="_blank" method="post" id="frm_pdf_report" name="frm_pdf_report">
		<?php if (isset($clientes)) { ?>
			<input type="hidden" id="h_cod_hab" name = "h_cod_hab" value="<?=$cod_hab;?>">
		<?php } ?>
	</form>
		<!-- <div class="well-lg"> -->
			<table class="table table-bordered table-condensed table-striped">
				<thead>
					<tr>
						<th>
							Fecha
						</th>
						<th>
							# Habitación
						</th>
						<th>
							Nombre Completo
						</th>
						<th>
							# Fecha CheckIn
						</th>
						<th>
							# Fecha CheckOut
						</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						if (isset($clientes)) {
							foreach ($clientes as $key) {
					?>
					<tr>
						<td>
							<?=date("d-m-Y");?>
						</td>
						<td>
							<?=$cod_hab;?>
						</td>
						<td>
							<?=$key->rsocial;?>
						</td>
						<td>
							<?=date("d-m-Y");?>
						</td>
						<td>
							<?=date("d-m-Y");?>
						</td>
					</tr>
					<?php	
							}
						 	
						 } 
					 ?>
				</tbody>
			</table>
		<!-- </div> -->
	</div>
	
	<form action="to_pdf_caja" target="_blank" method="post" id="frm_pdf_caja" name="frm_pdf_caja">
	</form>
	<div class="col-md-6" style="float: right;">
		<button type="button" class="btn btn-default" aria-label="Left Align" style="margin-left:10px;margin-top:5px;" id="imprimeCaja">
		  <span class="glyphicon glyphicon glyphicon-print" aria-hidden="true"></span>
		</button>
	</div>
	<div class="col-md-6">
		<div class="panel panel-primary" data-container="body">
			<div class="panel-heading">
				Reporte de Habitaciones <?=date('d/m/Y');?> Usuario: <?=$this->session->userdata['usuario'];?>
			</div>

				<div class="panel-body">
				   <table class="table table-hover">
				   		<tr>
				   			<th class="cabecera_tabla">Habitaciones Ocupadas</th>
				   			<td class="text_bold cabecera_tabla"><?=count($detalle_ocupadas);?></td>
				   			<?php $i = 0;foreach ($detalle_ocupadas as $key) { ?>
					   			<tr>
					   				<td class="text-center"><?=++$i;?></td>
					   				<td><?=$key->codigo;?></td>
					   			</tr>
				   			<?php } ?>
				   		</tr>
				   		<tr>
				   			<th class="cabecera_tabla">Habitaciones Libres</th>
				   			<td class="text_bold cabecera_tabla"><?=count($detalle_libres); ?></td>
				   			<?php $j = 0;foreach ($detalle_libres as $key) { ?>
					   			<tr>
					   				<td class="text-center"><?=++$j;?></td>
					   				<td><?=$key->codigo;?></td>
					   			</tr>
				   			<?php } ?>
				   		</tr>
				   		<tr>
				   			<th class="cabecera_tabla">Habitaciones Reservadas</th>
				   			<td class="text_bold cabecera_tabla"><?=count($detalle_reservadas);?></td>
				   			<?php $j = 0;foreach ($detalle_reservadas as $key) { ?>
					   			<tr>
					   				<td class="text-center"><?=++$j;?></td>
					   				<td><?=$key->codigo;?></td>
					   			</tr>
				   			<?php } ?>
				   		</tr>
				   		<tr style="font-size: 15px;background-color: #FC373F;color: #FFF;">
				   			<th>Total Recaudado</th>
				   			<td class="text-right;"><?=$ingresos->ingresos;?> BS.</td>
				   		</tr>
				   </table>
				</div>
		</div>
		
	</div>

</div>
