<!-- *** Modal para Nuevo cliente *** -->
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
<!-- *** FIN venta modal para Nuevo Cliente *** -->
<!-- *** Modal para Edicion de Cliente *** -->
<div class="modal fade" id="modal_edita_cliente" tabindex="-1" role="dialog" aria-labelledby="modal_tipo_habitacion">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edita cliente</h4>
        <input type="hidden" id="id_cliente">
      </div>
      <div class="modal-body">
        <div class="input-group form-group">
		  <span class="input-group-addon" id="basic-addon3">Nombre Completo: </span>
		  <input type="text" class="form-control" id="ed_nombre" aria-describedby="basic-addon3">
		</div>
		<div class="input-group form-group">
		  <span class="input-group-addon" id="basic-addon3"># de Doc: </span>
		  <input type="text" class="form-control" id="ed_num_doc" aria-describedby="basic-addon3">
		</div>
		<div class="input-group form-group">
		  <span class="input-group-addon" id="basic-addon3">Pais: </span>
		  <input type="text" class="form-control" id="ed_pais" aria-describedby="basic-addon3">
		</div>
		<div class="input-group form-group">
		  <span class="input-group-addon" id="basic-addon3">Ciudad: </span>
		  <input type="text" class="form-control" id="ed_ciudad" aria-describedby="basic-addon3">
		</div>
		<div class="input-group form-group">
		  <span class="input-group-addon" id="basic-addon3">Dirección: </span>
		  <input type="text" class="form-control" id="ed_direccion" aria-describedby="basic-addon3">
		</div>
		<div class="input-group form-group">
		  <span class="input-group-addon" id="basic-addon3">Teléfono: </span>
		  <input type="text" class="form-control" id="ed_telefono" aria-describedby="basic-addon3">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="guarda_edita_cliente" class="btn btn-primary" data-dismiss="modal">Editar Cliente</button>
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
			<tr id="<?=$key->id_clientes;?>">
				<td><?= ++$i; ?>&nbsp; <a href="#" id="elimina_cliente"><span class="glyphicon glyphicon-trash"></span></a></td>
				<td id="nombre_cliente"><a href="#" id="edita_cliente" data-toggle="modal" data-target="#modal_edita_cliente"><?=$key->rsocial;?></a></td>
				<td id="num_doc_cliente"><?=$key->nit_cliente;?></td>
				<td id="pais_cliente"><?=$key->pais;?></td>
				<td id="ciudad_cliente"><?=$key->ciudad;?></td>
				<td id="direccion_cliente"><?=$key->direccion;?></td>
				<td id="telefono_cliente"><?=$key->telefono;?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<!-- ******* -->
