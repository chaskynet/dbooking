<div class="row">
	<div class="col-md-6">
		<h3>Movimientos Caja</h3>
	</div>
	<div class="col-md-6" style="float: right;">
		<button type="button" class="btn btn-default" aria-label="Left Align" style="margin-left:10px;margin-top:5px;" id="imprimeCaja">
		  <span class="glyphicon glyphicon glyphicon-print" aria-hidden="true"></span>
		</button>
	</div>
</div>
<form action="to_pdf_caja" target="_blank" method="post" id="frm_pdf_caja" name="frm_pdf_caja">
	
</form>
<div class="row-fluid">
	<div class="col-md-6" id="caja_chica">
		<div class="col-md-5 col-sm-4">
			<div class="form-group text-center">
				<label for="monto">Ingreso</label>
				<input type="radio" id="ingreso" name="movimiento" class="form-control">
			</div>
		</div>
		<div class="col-md-5 col-sm-4">
			<div class="form-group text-center">
				<label for="monto">Egreso</label>
				<input type="radio" id="egreso" name="movimiento" class="form-control">
			</div>
		</div>
		<div class="form-group col-md-12">
			<label for="monto">Monto</label>
			<input type="text" id="monto" class="form-control" disabled>
		</div>
		<div class="form-group col-md-12">
			<label for="monto">Tipo Documento</label>
			<input type="text" id="tipo_doc" class="form-control" disabled>
		</div>
		<div class="form-group col-md-12">
			<label for="monto">Número Doc</label>
			<input type="text" id="num_doc" class="form-control" disabled>
		</div>
		<div class="form-group col-md-12">
			<label for="monto">Concepto</label>
			<input type="text" id="concepto" class="form-control" disabled>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-primary" data-container="body" data-toggle="popover" title="Kardex de la Caja" data-content="La Caja esta lista la Apertura!!">
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