<!-- Ventana Modal de Resumen de Movimiento de Articulos-->
	<div id="modal_edita_usuario" class="modal fade" role="dialog">
	  <div class="modal-dialog caja_usr">
	    <!-- Modal content-->
	    <div class="modal-content" style="padding-left:2%;padding-right:2%;">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Editar datos del usuario: </h4>
	      </div>
	      <div class="modal-body well" id="modal_content_usuario" style="padding: 2% 2% 2% 2%;">
	      		<input type="hidden" id="id_usuario">
	      		<div class="row">
					<div class="col-md-4">
						<label for="usuario">Usuario:
							<input type="text" id="ed_usuario" class="form-control col-lg-1">
						</label>
						<label for="nombre">Nombre:
							<input type="text" id="ed_nombre" class="form-control col-lg-1">
						</label>

						<label for="ed_apaterno">Apellido Paterno: 
							<input type="text" id="ed_apaterno" class="form-control col-lg-1">
						</label>
						<label for="amaterno">Apellido Materno: 
							<input type="text" id="ed_amaterno" class="form-control col-lg-1">
						</label>	
						<label for="ci">C.I.: 
							<input type="text" id="ed_ci" class="form-control">
						</label>

						<label for="password">Password: 
							<input type="checkbox" id="chk_password">
							<input type="password" id="ed_password" class="form-control" disabled>
						</label>
					<!-- -->
					</div>
					
					<div class="col-md-6">
						<div class="form-group input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_adm_hab" name="chk_permisos[]">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Adm. de Habitaciones" disabled>
					    </div>

					    <div class="form-group input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." name="chk_permisos[]" id="chk_gestion_usrs">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Gestion de Usuarios" disabled>
					    </div>

					    <div class="form-group input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_adm_clientes" name="chk_permisos[]">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Adm. de Clientes" disabled>
					    </div>

					    <div class="form-group input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_asigna_hab" name="chk_permisos[]">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Asigna Habitación" disabled>
					    </div>
					    <div class="form-group input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_rep_caja" name="chk_permisos[]">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Reporte Caja" disabled>
					    </div>
					</div>
					<!-- Segunda Columna -->
					<!--<div class="form-group col-xs-4">
						 <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_anula_factura" name="chk_permisos[]">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Anular Facturas" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_exportar_txt" name="chk_permisos[]">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Exportar a TXT" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_borra_art" name="chk_permisos[]">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Borrar Articulos" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_conf_productos_2" name="chk_permisos[]">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Conf. Articulos Mayor" disabled>
					    </div> 

					</div>-->

				</div>

	      </div>
	      
	      <div class="modal-footer">
			<input type="submit" value="Actualizar Usuario" id="actualizar_usuario" class="btn btn-primary">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>

<!-- ***************************************** -->
<!-- Ventana Modal de Creacion de nuevos Usuarios-->
<div id="modal_creacion_usuarios" class="modal fade" role="dialog">
  <div class="modal-dialog caja_usr">
    <!-- Modal content-->
    <div class="modal-content" style="padding-left:2%;padding-right:2%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Creación de nuevo Usuario</h4>
      </div>
      <div class="modal-body well" id="modal_content_resumen" style="padding: 2% 2% 2% 2%;">
       		
       			<div class="row">
       				<div class="col-md-4">
						
						<div>
							<label for="usuario">Usuario: </label>
							<input type="text" id="usuario" class="form-control">
						</div>
						<div>
							<label for="nombre">Nombre: </label>
							<input type="text" id="nombre" class="form-control">
						</div>
						<div>
							<label for="apaterno">Apellido Paterno: </label>
							<input type="text" id="apaterno" class="form-control">
						</div>
						<div>
							<label for="amaterno">Apellido Materno: </label>
							<input type="text" id="amaterno" class="form-control">
						</div>
						<div>
							<label for="ci">C.I.: </label>
							<input type="text" id="ci" class="form-control">
						</div>
						<div>
							<label for="password">Password: </label>
							<input type="password" id="password" class="form-control">
						</div>
						<div class="boton_crear">
							<input type="submit" value="Crear Usuario" id="crear_usuario" class="btn btn-primary">
						</div>
					</div>
					<div class="col-md-6 para_check_new">
						<div class="form-group input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_adm_hab" name="permiso[]">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Adm. de Habitaciones" disabled>
					    </div>

					    <div class="form-group input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." name="permiso[]" id="chk_gestion_usrs">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Gestion de Usuarios" disabled>
					    </div>

					    <div class="form-group input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_adm_clientes" name="permiso[]">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Adm. de Clientes" disabled>
					    </div>

					    <div class="form-group input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_asigna_hab" name="permiso[]">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Asigna Habitación" disabled>
					    </div>
					    <div class="form-group input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." id="chk_rep_caja" name="permiso[]">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Reporte Caja" disabled>
					    </div>

					</div>
					<!-- Segunda Columna -->
					<!--<div class="form-group col-xs-4 para_check_new">
						 <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." name="permiso[]" id="chk_anula_factura">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Anular Facturas" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." name="permiso[]" id="chk_exportar_txt">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Exportar a TXT" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." name="permiso[]" id="chk_borra_art">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Borrar Articulos" disabled>
					    </div>

					    <div class="input-group para_check">
					      <span class="input-group-addon">
					        <input type="checkbox" aria-label="..." name="permiso[]" id="chk_conf_productos_2">
					      </span>
					      <input type="text" class="form-control" aria-label="..." value="Conf. Articulos Mayor" disabled>
					    </div> 

					</div>-->
				</div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cerrar_creacion_usr">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- ***************************************** -->
<div class="row-fluid">
	<div class="span12">
		<h2>Lista de usuarios</h2>
		<button class="btn" id="agregar-articulos" data-toggle="modal" data-target="#modal_creacion_usuarios">Nuevo Usuario</button>
		<table class="table table-bordered table-striped table-hover table-condensed">
			<tr>
				<th>#</th>
				
				<th>Usuario</th>
				<th>Nombre Completo</th>
				<th>C.I.</th>
				<th>Estado</th>
				<!-- <th>Rol</th> -->
			</tr>
			<?php
				$i = 0;
				foreach ($usuarios as $key) {
					$i++;
			?>
			<tr id="<?= $key->id_usuario; ?>">
				<td><?= $i; ?>&nbsp; <a href="#" id="elimina_usr"><span class="glyphicon glyphicon-trash"></span></a></td>

				<td><?= $key->uname; ?></td>
				<td><a href="#" data-toggle="modal" data-target="#modal_edita_usuario" id="nombre_usuario"><?= $key->nombre.' '.$key->apaterno.' '.$key->amaterno; ?></a></td>
				<td class="centrar"><?= $key->ci; ?></td>
				<td class="centrar"><?= $key->estado ? 'Activo' : 'Desactivado'; ?></td>
				<!-- <td class="centrar"><?= $key->rol ? 'Usuario' : 'Administrador'; ?></td> -->
			</tr>
			<?php
				}
			?>
		</table>
	</div>
</div>


