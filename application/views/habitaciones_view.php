<!-- *** Modal para Edicion de Conf Habitación *** -->
<div class="modal fade" data-backdrop="static" id="modal_chk_in_out" role="dialog" aria-labelledby="modal_chk_in_out">
  <div class="modal-dialog" role="document" style="width: 55%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" data-codhab="">Check In Habitación</h4>
      </div>
      <div class="modal-body">
        ...
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
<!-- *** Modal para Fecha de Reserva *** -->
<div class="modal fade" data-backdrop="static" id="modal_reserva_mantenimiento" role="dialog" aria-labelledby="modal_reserva_mantenimiento">
  <div class="modal-dialog" role="document" style="width: 55%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" data-codhab="" data-id_hab = "" id="tit_habresman"><span id="cod_habresman"></span></h4>
      </div>

      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-tipo="" data-idhabresman="" id="save_res_mante">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- *** FIN venta modal para Edicion de Conf de Habitación *** -->

<div class="row-fluid">
	<nav class="navbar navbar-default" style="margin-bottom: 0;background-color: #D1ECF8;">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu_adquisiciones" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <!-- <a class="navbar-brand" href="#" id="home_produccion">Producción</a> -->
	    </div>
	    <div class="collapse navbar-collapse" id="menu_adquisiciones">
	      <ul class="nav navbar-nav">
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Habitaciones por Piso <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	          	<?php
					foreach ($pisos as $key) {
				?>
					<li><a href="#" id="habs_por_piso" data-piso = "<?=$key->piso_hab;?>">Piso <span class="badge"><?=$key->piso_hab;?></span> #habitaciones: <?=$key->num_hab;?></a></li>
				<?php
					}
				?>
	            <!-- <li role="separator" class="divider"></li>
	            <li><a href="#" id="compras">Consolidado Compras</a></li> -->
	          </ul>
	        </li>
	      </ul>
	      <!-- <form class="navbar-form navbar-left"> -->
	        <div class="navbar-form navbar-left form-group">
	          <input type="text" class="form-control" placeholder="Habitación" name="buscar_habitacion" id="buscar_habitacion">
	        </div>
	        <!-- <button type="submit" class="btn btn-default">Buscar</button> -->
	      <!-- </form> -->
	      <ul class="nav navbar-nav navbar-right">
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reportes <span class="caret"></span></a>
	          <ul class="dropdown-menu">
		        <li><a href="#" id="rep_camarera">Reporte Camarera</a></li>
		        <li><a href="#" id="rep_desayuno">Reporte Desayuno</a></li>
	          </ul>
	        </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Habitaciones por Estado <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li class="form-group"><a class="btn btn-success" href="#" id="busqueda_habs_estado" data-hab_estado = "libre">Libres</a></li>
	            <li class="form-group"><a class="btn btn-primary" href="#" id="busqueda_habs_estado" data-hab_estado = "Reservado">Reservadas</a></li>
	            <li><a class="btn btn-danger" href="#" id="busqueda_habs_estado" data-hab_estado = "ocupado">Ocupadas</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a class="btn btn-warning" href="#" id="busqueda_habs_estado" data-hab_estado = "mantesucio">Mante/Sucio</a></li>
	            <li><a class="btn btn-warning" href="#" id="busqueda_habs_estado" data-hab_estado = "alquilado">Alquilado</a></li>
	          </ul>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
</div>
<div class="row-fluid" id="contenido_habitaciones">
	<div class="col-md-8" style="padding-left: 0;;">
		<div class="col-md-12" style="padding-left: 0;padding-right: 0;">
		<?php $i = 0;
			foreach ($habitaciones as $key) {
				$i++;
		?>
		<div style="width: 22%;" class="panel panel-<?php if ($key->estado == 'libre' || $key->estado == 'limpio') {
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
					}?>" id="btn_chk_in_out" data-toggle="modal" data-target="#modal_chk_in_out" data-codigo = "<?=$key->codigo;?>" data-idhab="<?=$key->id_habitacion;?>">
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
					     <li><a href="#" id="chg_reserva" data-codigo = "<?=$key->codigo;?>" data-idhab = "<?=$key->id_habitacion;?>" data-toggle="modal" data-target="#modal_reserva_mantenimiento">Reservado</a></li>
					     <li><a href="#" id="chg_mantenimiento" data-codigo = "<?=$key->codigo;?>" data-idhab = "<?=$key->id_habitacion;?>" data-toggle="modal" data-target="#modal_reserva_mantenimiento">Mantenimiento</a></li>
					  </ul>
					</div>
				<?php	} elseif ($key->estado == 'Reservado') { ?>
					<div class="btn-group">
					  <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="chg_estado_hab">
					    ... <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
					     <li><a href="#" id="chg_liberar" data-codigo = "<?=$key->codigo;?>" data-idhab = "<?=$key->id_habitacion;?>" data-toggle="modal" data-target="#modal_chk_in_out">Liberar</a></li>
					  </ul>
					</div>
				<?php } ?>
			</div>
			<div class="panel-body" data-container="body" data-toggle="popover" data-html="true" tabindex="0" title="Observaciones de la Habitacion" data-content="<?=$key->obs;?>">
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
	</div>
	<div class="col-md-4" style="float: right;">
		<table class="table table-condensed table-stripped table-hover">
			<caption>Habitaciones Reservadas</caption>
			<thead>
				<tr>
					<th>Hab.</th>
					<th>Cliente</th>
					<th>Fecha In</th>
					<th>Fecha Out</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($reservadas as $key) { ?>
				<tr>
					<td><?=$key->codigo;?></td>
					<td><?=$key->obs;?></td>
					<td><?=$key->fch_reserva;?></td>
					<td><?=$key->fch_salida;?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
