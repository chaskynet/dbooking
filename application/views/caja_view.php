<!-- *** Modal para Apertura de Caja *** -->
<div class="modal fade" id="modal_apertura_caja" role="dialog" aria-labelledby="modal_apertura_caja">
  <div class="modal-dialog" role="document" style="width: 55%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" data-codhab="">Apertura de Caja</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="row form-group col-md-12">
				<div class="col-md-6 input-group" style="float: left;">
				  <span class="input-group-addon" id="basic-addon3">Monto de Apertura: </span>
				  <input type="text" class="form-control" id="monto_apertura" aria-describedby="basic-addon3">
				</div>
				<div class="col-md-5 input-group" style="float: right;">
				  <span class="input-group-addon" id="basic-addon3">Observaciones: </span>
				  <textarea rows="4" cols="50" class="form-control" id="observaciones_apertura" aria-describedby="basic-addon3">
    			  </textarea>
				</div>
			</div>
      		
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="guarda_apertura"  data-dismiss="modal">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- *** FIN venta modal para Apertura de Caja *** -->
<!-- *** Modal para Cierre de Caja *** -->
<div class="modal fade" id="modal_cierre_caja" role="dialog" aria-labelledby="modal_cierre_caja">
  <div class="modal-dialog" role="document" style="width: 55%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" data-codhab="">Cierre de Caja</h4>
      </div>
      <div class="modal-body">
        <div class="row">
      		<div class="row form-group col-md-12">
				<div class="col-md-6 input-group" style="float: left;">
				  <span class="input-group-addon" id="basic-addon3">Monto de Cierre: </span>
				  <input type="text" class="form-control" id="monto_cierre" aria-describedby="basic-addon3">
				</div>
				<div class="col-md-5 input-group" style="float: right;">
				  <span class="input-group-addon" id="basic-addon3">Observaciones: </span>
				  <textarea rows="4" cols="50" class="form-control" id="observaciones_cierre" aria-describedby="basic-addon3">
    			  </textarea>
				</div>
			</div>
      		
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="guarda_cierre"  data-dismiss="modal">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- *** FIN venta modal para Ciere de Caja *** -->
<div class="row">
	<div class="col-md-6">
		<h3 style="display: inline-block;">Movimientos Caja</h3> Estado: <button id="estado_caja" class="btn estado_caja"><?=$estado[0]->estado;?></button>
		
	</div>
	<div class="col-md-6">
		<?=($estado[0]->estado == 'cerrado')?"<button class='btn btn-primary' id='abrir_caja' data-toggle='modal' data-target='#modal_apertura_caja'>ABRIR CAJA</button>":"<button class='btn btn-danger' id='cerrar_caja' data-toggle='modal' data-target='#modal_cierre_caja'>CERRAR CAJA</button><form action='pdf_cierre_caja' target='_blank' method='post' id='frm_pdf_cierre_caja' name='frm_pdf_cierre_caja'><input type='hidden' id='id_estado_caja' name='id_estado_caja' value='".$estado[0]->id_estado_caja."'></form>";?>
	</div>
</div>

<div class="row-fluid">
	<div class="col-md-6" id="caja_chica">
		<div class="col-md-5 col-sm-4">
			<div class="form-group text-center">
				<label for="monto">Ingreso</label>
				<input type="radio" id="ingreso" name="movimiento" class="form-control" <?=($estado[0]->estado == 'cerrado'?'disabled':'');?>>
			</div>
		</div>
		<div class="col-md-5 col-sm-4">
			<div class="form-group text-center">
				<label for="monto">Egreso</label>
				<input type="radio" id="egreso" name="movimiento" class="form-control" <?=($estado[0]->estado == 'cerrado'?'disabled':'');?>>
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
			<label for="monto">Imagen Doc: </label>
			<!-- <input type="text" id="num_doc" class="form-control" disabled> -->
			<button>Habilitar Camara</button>
		</div>
		<div class="form-group col-md-12">
			<label for="monto">Concepto</label>
			<input type="text" id="concepto" class="form-control" disabled>
		</div>
		<div class="form-group col-md-12">
			<button id="guarda_mov" class="btn btn-primary" disabled>Guardar</button>
		</div>
	</div>
	<div class="col-md-6">
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