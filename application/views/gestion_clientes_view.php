<!-- *** Modal para Nueva Habitación *** -->
<div class="modal fade" id="modal_nueva_habitacion" tabindex="-1" role="dialog" aria-labelledby="modal_nueva_habitacion">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nueva Habitación</h4>
      </div>
      <div class="modal-body">
        <div class="input-group">
		  <span class="input-group-addon" id="basic-addon3">Codigo: </span>
		  <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar Habitación</button>
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
        <div class="input-group">
		  <span class="input-group-addon" id="basic-addon3">Descripción: </span>
		  <input type="text" class="form-control" id="desc_tipo_hab" aria-describedby="basic-addon3">
		</div>
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon3"># de Personas: </span>
		  <input type="text" class="form-control" id="num_personas" aria-describedby="basic-addon3">
		</div>
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon3">Costo: </span>
		  <input type="text" class="form-control" id="costo_hab" aria-describedby="basic-addon3">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="guarda_tipo" class="btn btn-primary">Guardar Tipo de Habitación</button>
      </div>
    </div>
  </div>
</div>
<!-- *** FIN venta modal para Tipo Habitación *** -->

<!-- *** Panel para Gestión de Clientes *** -->
<div class="row" style="background-color: #FFFFFF;">
	<table class="table table-condensed table-responsive table-striped table-hover">
		<caption class="text-center">
			<h3>Listado de Clientes</h3>
		</caption>
		<thead>
			<tr>
				<th>#</th>
				<th>Nombre Completo</th>
				<th>CI / Pasaporte</th>
				<th>Pais</th>
				<th>Ciudad</th>
				<th>Direccion</th>
				<th>Telefono</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; foreach ($clientes as $key) {?>
			<tr>
				<td><?=++$i;?></td>
				<td><?=$key->rsocial;?></td>
				<td><?=$key->nit_cliente;?></td>
				<td><?=$key->pais;?></td>
				<td><?=$key->ciudad;?></td>
				<td><?=$key->direccion;?></td>
				<td><?=$key->telefono;?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<!-- ******* -->
