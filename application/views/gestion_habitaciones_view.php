<!-- *** Modal para Nueva Habitación *** -->
<div class="modal fade" id="modal_nueva_habitacion" tabindex="-1" role="dialog" aria-labelledby="modal_nueva_habitacion">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nueva Habitación</h4>
      </div>
      <div class="modal-body">
        <div class="input-group form-group">
		  <span class="input-group-addon" id="basic-addon3">Codigo: </span>
		  <input type="text" class="form-control" id="cod_hab" aria-describedby="basic-addon3">
		</div>
		<div class="input-group form-group">
		  <span class="input-group-addon" id="basic-addon3">Tipo Habitación: </span>
		  <!-- <input type="text" class="form-control" id="tipo_hab" aria-describedby="basic-addon3"> -->
		  <select name="tipo_hab" id="tipo_hab" class="form-control" aria-describedby="basic-addon3">
		  	<option value="0">...</option>
		  </select>
		</div>
		<div class="input-group form-group">
		  <span class="input-group-addon" id="basic-addon3">Estado: </span>
		  <!-- <input type="text" class="form-control" id="estado_hab" aria-describedby="basic-addon3"> -->
		  <select name="tipo_hab" id="estado_hab" class="form-control" aria-describedby="basic-addon3">
		  	<option value="0">...</option>
		  	<option value="libre">Libre</option>
		  	<option value="ocupado">Ocupado</option>
		  	<option value="reservado">Reservado</option>
		  	<option value="mantenimiento">Mantenimiento</option>
		  	<option value="sucio">Sucio</option>
		  </select>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="nueva_hab" data-dismiss="modal">Guardar Habitación</button>
      </div>
    </div>
  </div>
</div>
<!-- *** FIN venta modal para Nueva Habitación *** -->
<!-- *** Modal para Tipo Habitación *** -->
<div class="modal fade" id="modal_tipo_habitacion" tabindex="-1" role="dialog" aria-labelledby="modal_tipo_habitacion">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Tipo de Habitación</h4>
      </div>
      <div class="modal-body">
        <div class="input-group form-group">
		  <span class="input-group-addon" id="basic-addon3">Descripción: </span>
		  <input type="text" class="form-control" id="desc_tipo_hab" aria-describedby="basic-addon3">
		</div>
		<div class="input-group form-group">
		  <span class="input-group-addon" id="basic-addon3"># de Personas: </span>
		  <input type="text" class="form-control" id="num_personas" aria-describedby="basic-addon3">
		</div>
		<div class="input-group form-group">
		  <span class="input-group-addon" id="basic-addon3">Costo: </span>
		  <input type="text" class="form-control" id="costo_hab" aria-describedby="basic-addon3">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="guarda_tipo" class="btn btn-primary" data-dismiss="modal">Guardar Tipo de Habitación</button>
      </div>
    </div>
  </div>
</div>
<!-- *** FIN venta modal para Tipo Habitación *** -->
<!-- *** Modal para Edicion de Tipo Habitación *** -->
<div class="modal fade" id="modal_edit_tipo_habitacion" tabindex="-1" role="dialog" aria-labelledby="modal_edit_tipo_habitacion">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Tipo de Habitación</h4>
      </div>
      <div class="modal-body">
        <div class="input-group form-group">
          <input type="hidden" id="ed_id_tipo">
		  <span class="input-group-addon" id="basic-addon3">Descripción: </span>
		  <input type="text" class="form-control" id="ed_desc_tipo_hab" aria-describedby="basic-addon3">
		</div>
		<div class="input-group form-group">
		  <span class="input-group-addon" id="basic-addon3"># de Personas: </span>
		  <input type="text" class="form-control" id="ed_num_personas" aria-describedby="basic-addon3">
		</div>
		<div class="input-group form-group">
		  <span class="input-group-addon" id="basic-addon3">Costo: </span>
		  <input type="text" class="form-control" id="ed_costo_hab" aria-describedby="basic-addon3">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="edita_tipo" class="btn btn-primary" data-dismiss="modal">Editar Tipo de Habitación</button>
      </div>
    </div>
  </div>
</div>
<!-- *** FIN venta modal para Edicion de Tipo Habitación *** -->
<!-- *** Modal para Edicion de Conf Habitación *** -->
<div class="modal fade" id="modal_edit_conf_habitacion" tabindex="-1" role="dialog" aria-labelledby="modal_edit_conf_habitacion">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nueva Habitación</h4>
      </div>
      <div class="modal-body">
        <div class="input-group form-group">
		  <span class="input-group-addon" id="basic-addon3">Codigo: </span>
		  <input type="text" class="form-control" id="cod_hab" aria-describedby="basic-addon3">
		</div>
		<div class="input-group form-group">
		  <span class="input-group-addon" id="basic-addon3">Tipo Habitación: </span>
		  <!-- <input type="text" class="form-control" id="tipo_hab" aria-describedby="basic-addon3"> -->
		  <select name="tipo_hab" id="tipo_hab" class="form-control" aria-describedby="basic-addon3">
		  	<option value="0">...</option>
		  </select>
		</div>
		<div class="input-group form-group">
		  <span class="input-group-addon" id="basic-addon3">Estado: </span>
		  <!-- <input type="text" class="form-control" id="estado_hab" aria-describedby="basic-addon3"> -->
		  <select name="tipo_hab" id="estado_hab" class="form-control" aria-describedby="basic-addon3">
		  	<option value="0">...</option>
		  	<option value="libre">Libre</option>
		  	<option value="ocupado">Ocupado</option>
		  	<option value="reservado">Reservado</option>
		  	<option value="mantenimiento">Mantenimiento</option>
		  </select>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="edit_hab" data-dismiss="modal">Actualizar Habitación</button>
      </div>
    </div>
  </div>
</div>
<!-- *** FIN venta modal para Edicion de Conf de Habitación *** -->

<!-- *** Panel para Gestión de Habitación *** -->
<!-- Botones de acceso a las diferentes areas de la gestion de Habitaciones -->
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#gestion_habitaciones" aria-expanded="false" aria-controls="gestion_habitaciones">
  Gestión de Habitaciones
</button>
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#tipo_habitaciones" aria-expanded="false" aria-controls="tipo_habitaciones">
  Tipo de Habitaciones
</button>
<!-- ******************************************** -->
<!-- Seccion contenido de los paneles desplegables -->
<div class="collapse" id="gestion_habitaciones">
  <div class="well">
	<div class="row">
		<h3 style='padding-top:0px;margin-top:0px;'>Gestión de Habitaciones</h3>
		<button class="btn btn-danger" id="nueva_habitacion" data-toggle="modal" data-target="#modal_nueva_habitacion"><span class="glyphicon glyphicon-plus"></span> Nueva Habitación</button>
		
		<table class="table table-bordered table-striped table-hover table-condensed" id="habitaciones_conf">
			<thead>
				<tr>
					<th>#</th>
					<th>Codigo</th>
					<th>Descripción</th>
					<th>Costo</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$i = 0;
				foreach ($habitaciones as $key) {
					$i++;
			?>
				<tr id="<?= $key->id_habitacion; ?>">
					<td><?= $i; ?>&nbsp; <a href="#" id="elimina_hab"><span class="glyphicon glyphicon-trash"></span></a></td>
					<td><a href="#" data-toggle="modal" data-target="#modal_edit_conf_habitacion" id="edit_conf_habitacion"><?= $key->codigo; ?></a></td>
					<td id="desc_hab"><?= $key->descripcion; ?></td>
					<td id="costo_hab"><?= $key->costo; ?></td>
					<td id="estado_hab"><?= $key->estado; ?></td>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>
  </div>
</div>
<!-- ******* -->

<!-- *** Panel para Tipo de Habitación *** -->

<div class="collapse" id="tipo_habitaciones">
  <div class="well">
	<div class="row">
		<h3 style='padding-top:0px;margin-top:0px;'>Tipo de Habitaciones</h3>
		<button class="btn btn-danger" id="agregar-articulos" data-toggle="modal" data-target="#modal_tipo_habitacion"><span class="glyphicon glyphicon-plus"></span> Nuevo Tipo </button>
		
		<table class="table table-bordered table-striped table-hover table-condensed" id="tabla_tipo_habitaciones">
			<thead>
				<tr>
					<th>#</th>
					<th>Descripción</th>
					<th>Nro. Personas</th>
					<th>Costo</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$i = 0;
				foreach ($tipos as $key) {
					$i++;
			?>
			<tr id="<?=$key->id_tipo_hab?>">
				<td><?=$i;?></td>
				<td id="tipo_desc"><a href="#" id="edit_tipo" data-toggle="modal" data-target="#modal_edit_tipo_habitacion"><?=$key->descripcion;?></a></td>
				<td id="tipo_num_per"><?=$key->personas;?></td>
				<td id="tipo_costo"><?=$key->costo;?></td>
			</tr>
			<?php
				}
			?>
			</tbody>
		</table>
	</div>
  </div>
</div>
<!-- ******* -->
