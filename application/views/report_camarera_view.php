
	<table class="table table-condensed">
		<caption>
			<?php
				foreach ($pisos as $key) {
			?>
			<button class="btn btn-primary" id="rep_hab_camarera" data-piso = "<?=$key->piso_hab;?>">Piso <span class="badge"><?=$key->piso_hab;?></span> <?=$key->num_hab;?> habs.</button>
			<?php } ?>
		</caption>
		<thead>
			<tr>
				<th>Habitación</th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Camarera</th>
				<th>Trabajo</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($repo_camarera as $key) { $fch_hr = date_create($key->fch_reporte);?>
				<td><?=$key->cod_hab;?></td>
				<td><?=date_format($fch_hr, "d-m-Y");?></td>
				<td><?=date_format($fch_hr, "H:m:s");?></td>
				<td><?=$key->usuario;?></td>
				<td><?=$key->reporte;?></td>
			<?php } ?>
		</tbody>
	</table>
