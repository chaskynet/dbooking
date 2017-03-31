<!-- *** Modal para Apertura de Caja *** -->
<div class="modal fade" id="modal_detalle_cierre_cja" role="dialog" aria-labelledby="modal_detalle_cierre_cja">
  <div class="modal-dialog" role="document" style="width: 55%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" data-codhab="">Detalle Cierre de Caja</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<table class="table table-condensed" id="detalle_mov_cierre_cja">
				<thead>
					<tr>
						<th>#</th>
						<th>Fecha</th>
						<th>Tipo Mov</th>
						<th>Tipo Doc</th>
						<th>Num_doc</th>
						<th>Monto</th>
					</tr>
				</thead>
				
			</table>
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
<table class="table table-condensed" id="detalle_cierre_cja">
	<thead>
		<tr>
			<th>#</th>
			<th>Fecha cierre</th>
			<th>Monto Cierre</th>
			<th>Obs</th>
			<th>Usuario Cierre</th>
		</tr>
	</thead>
	<tfoot>
		<?php $total = 0; foreach ($cierres_caja as $key) { 

			$total = $key->monto + $total;
			} ?>
		<tr>
			<td colspan="2">Total</td>
			<td id="total_caja"><?=$total;?></td>
		</tr>
	</tfoot>
	<tbody>
		<?php $i = 1; foreach ($cierres_caja as $key) { ?>
		<tr id="<?=$key->id_estado_caja;?>" data-toggle='modal' data-target='#modal_detalle_cierre_cja'>
			<td><?=$i++;?></td>
			<td><?=$key->fecha;?></td>
			<td><?=$key->monto;?></td>
			<td><?=$key->obs;?></td>
			<td><?=$key->usuario;?></td>
		</tr>		
		<?php } ?>
	</tbody>
</table>