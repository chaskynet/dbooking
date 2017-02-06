<!-- *** Modal para Edicion de Conf Habitación *** -->
<div class="modal fade" id="modal_chk_in_out" role="dialog" aria-labelledby="modal_chk_in_out">
  <div class="modal-dialog" role="document" style="width: 55%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" data-codhab="">Check In Habitación</h4>
      </div>
      <div class="modal-body">
        <p>...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="save_chk_in_out"  data-chkinout="">Guardar</button>
        <div id="sec_actualiza" style="width: 14%;display: inline-block;"></div>
      </div>
    </div>
  </div>
</div>
<!-- *** FIN venta modal para Edicion de Conf de Habitación *** -->
<div class="row-fluid">
	<?php
		foreach ($pisos as $key) {
	?>
		<button class="btn btn-primary" type="button" id="habs_por_piso" data-piso = "<?=$key->piso_hab;?>">
		  Piso <span class="badge"><?=$key->piso_hab;?></span> <?=$key->num_hab;?>
		</button>
	<?php
		}
	?>
</div>
<div class="row-fluid">
	<?php $i = 0;
		foreach ($habitaciones as $key) {
			$i++;
	?>
	<div class="panel panel-<?php if ($key->estado == 'libre' || $key->estado == 'limpio') {
		echo 'success';
	} elseif ($key->estado == 'ocupado') {
		echo 'danger';
	} elseif ($key->estado == 'Mantenimiento') {
		echo 'warning';
	} elseif ($key->estado == 'sucio') {
		echo 'info';
	} elseif ($key->estado == 'Reservado') {
		echo 'primary';
	}?> panel_habitaciones">
		<div class="panel-heading codigo_habitacion">
			Hab. <?=$key->codigo?>
			<button class="btn btn-<?php if ($key->estado == 'libre' || $key->estado == 'limpio') {
					echo 'info';
				} elseif ($key->estado == 'ocupado') {
					echo 'danger';
				} elseif ($key->estado == 'sucio') {
					echo 'warning';
				} elseif ($key->estado == 'Mantenimiento') {
					echo 'warning';
				} elseif ($key->estado == 'Reservado') {
					echo 'success';
				}?>" id="btn_chk_in_out" data-toggle="modal" data-target="#modal_chk_in_out" data-codigo = '<?=$key->codigo?>'>
				<?php
				switch ($key->estado) {
					case 'libre':
						echo 'Check In';
						break;
					case 'limpio':
						echo 'Check In';
						break;
					case 'Reservado':
						echo 'Check In';
						break;
					case 'ocupado':
						echo 'Check Out';
						break;
					case 'Mantenimiento':
						echo 'Habilitar';
						break;
					case 'sucio':
						echo 'Habilitar';
						break;
				}
				?>
			</button> 

			<?php
				if ($key->estado == 'libre' || $key->estado == 'limpio') {
			?>
				<div class="btn-group">
				  <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="chg_estado_hab">
				    ... <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
				     <li><a href="#" id="chg_reserva" data-codigo = "<?=$key->codigo;?>">Reservado</a></li>
				     <li><a href="#" id="chg_mantenimiento" data-codigo = "<?=$key->codigo;?>">Mantenimiento</a></li>
				  </ul>
				</div>
			<?php	}
				?>
		</div>
		<div class="panel-body" data-container="body" data-toggle="popover" title="Observaciones de la Habitacion" data-content="<?=$key->obs;?>">
		   <table class="table">
		   		<tr>
		   			<th>Estado</th>
		   			<td><?=$key->estado;?></td>
		   		</tr>
		   		<tr>
		   			<!-- <th>Tipo Hab: </th> -->
		   			<td colspan="2" class="text-center"><?=$key->descripcion;?></td>
		   		</tr>
		   		<tr>
		   			<th>Fecha</th>
		   			<td><?=date('d/m/Y');?></td>
		   		</tr>
		   </table>
		</div>
	</div>
	<?php } ?>
</div>