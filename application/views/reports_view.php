<div class="row">
	<div class="col-md-3">
		<div class="input-group input-group-sm">
		  <span class="input-group-addon" id="sizing-addon3">Buscar Habitación:</span>
		  <input type="text" id="habitacion" class="form-control" placeholder="Habitacion" aria-describedby="sizing-addon3">
		</div>
	</div>
	<div class="col-md-3">
		<div class="input-group input-group-sm">
		  <span class="input-group-addon" id="sizing-addon3">Fecha CheckIn:</span>
		  <input type="text" id="fch_ckin" class="form-control" placeholder="Habitacion" aria-describedby="sizing-addon3">
		</div>
	</div>

	<div class="col-md-4">
		<button type="button" class="btn" aria-label="Left Align" id="imprimeReport">
		  <span class="glyphicon glyphicon glyphicon-print" aria-hidden="true"></span>
		</button>
	</div>

	<form action="to_pdf_report" target="_blank" method="post" id="frm_pdf_report" name="frm_pdf_report">
		<?php if (isset($clientes)) { ?>
			<input type="hidden" id="h_cod_hab" name = "h_cod_hab" value="<?=$cod_hab;?>">
		<?php } ?>
	</form>

</div>
<div class="row">
	<div class="col-md-12">
		<div class="well-lg">
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
		</div>
	</div>
</div>
