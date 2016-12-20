<div class="row">
	<div class="col-md-4">
		<button type="button" class="btn btn-default" aria-label="Left Align" style="margin-left:10px;margin-top:5px;" id="imprimeCaja">
		  <span class="glyphicon glyphicon glyphicon-print" aria-hidden="true"></span>
		</button>
	</div>
</div>

<div class="row-fluid">
	<div class="panel panel-primary panel_caja" data-container="body" data-toggle="popover" title="Kardex de la Caja" data-content="La Caja esta lista la Apertura!!">
		<div class="panel-heading">
			Reporte de Habitaciones <?=date('d/m/Y');?> Usuario: <?=$this->session->userdata['usuario'];?>
			<!-- <button class="btn btn-info">Abrir</button> -->
		</div>

			<div class="panel-body">
			   <table class="table table-hover">
			   		<tr>
			   			<th>Habitaciones Ocupadas</th>
			   			<td><?=$ocupadas->ocupadas;?></td>
			   		</tr>
			   		<tr>
			   			<th>Habitaciones Libres</th>
			   			<td><?=$libres->libres;?></td>
			   		</tr>
			   		<tr>
			   			<th>Habitaciones Reservadas</th>
			   			<td>0</td>
			   		</tr>
			   		<tr style="font-size: 15px;background-color: #FC373F;color: #FFF;">
			   			<th>Total Recaudado</th>
			   			<td class="text-right;"><?=$ingresos->ingresos;?> BS.</td>
			   		</tr>
			   </table>
			</div>
	</div>
	
</div>