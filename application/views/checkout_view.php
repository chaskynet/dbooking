<div class="input-group form-group">
  <span class="input-group-addon" id="basic-addon3">Nombre: </span>
  <input type="text" class="form-control" id="nombre" aria-describedby="basic-addon3" value="<?=$datos->nombre;?>">
</div>
<div class="row form-group col-md-12">
	<div class="col-md-6 input-group" style="float: left;">
	  <span class="input-group-addon" id="basic-addon3">Fecha Check In: </span>
	  <input type="text" class="form-control" id="fecha_checkout" aria-describedby="basic-addon3" value="<?=$datos->fch_chkin;?>" disabled>
	</div>
	<div class="col-md-5 input-group" style="float: right;">
	  <span class="input-group-addon" id="basic-addon3">Hora Check In: </span>
	  <input type="text" class="form-control" id="hora_checkout" aria-describedby="basic-addon3" value="<?=$datos->hr_chkin;?>" disabled>
	</div>
</div>
<div class="row form-group col-md-12">
	<div class="col-md-6 input-group" style="float: left;">
	  <span class="input-group-addon" id="basic-addon3">Fecha Check Out: </span>
	  <input type="text" class="form-control" id="fecha_checkout" aria-describedby="basic-addon3" value="<?=date('d-m-Y');?>" disabled>
	</div>
	<div class="col-md-5 input-group" style="float: right;">
	  <span class="input-group-addon" id="basic-addon3">Hora Check Out: </span>
	  <input type="text" class="form-control" id="hora_checkout" aria-describedby="basic-addon3" value="<?=date('H:i:s');?>" disabled>
	</div>
</div>
<div class="row form-group col-md-12">
	<div class="col-md-6 input-group" style="float: left;">
	  <span class="input-group-addon" id="basic-addon3"># Días hospedado: </span>
	  <input type="text" class="form-control" id="dias_hosting" aria-describedby="basic-addon3" value="<?=$datos->dias;?>">
	</div>
	<div class="col-md-5 input-group" style="float: right;">
	  <span class="input-group-addon" id="basic-addon3"># Horas extra: </span>
	  <input type="text" class="form-control" id="hrs_extra" aria-describedby="basic-addon3" value="">
	</div>
</div>
<div class="input-group form-group">
  <span class="input-group-addon" id="basic-addon3">Observaciones: </span>
  <input type="text" class="form-control" id="observaciones" aria-describedby="basic-addon3" value="<?=$datos->obs?>">
</div>
<div class="input-group form-group">
  <span class="input-group-addon" id="basic-addon3">Adelanto: </span>
  <input type="text" class="form-control" id="adelanto" aria-describedby="basic-addon3" value="<?=$datos->adelanto?>" disabled>
</div>
<div class="input-group form-group">
  <span class="input-group-addon" id="basic-addon3">Total: </span>
  <input type="text" class="form-control" id="total" aria-describedby="basic-addon3" value="<?=($datos->costo*$datos->dias)-$datos->adelanto;?>">
</div>

<div class="input-group form-group col-md-10">
  <label for="estado_habitacion">Sucio: </label>
  <input type="radio" name = "estado_habitacion" class="form-control" id="habitacion_sucio" aria-describedby="basic-addon3">

  <label for="estado_habitacion">Limpio: </label>
  <input type="radio" name = "estado_habitacion" class="form-control" id="habitacion_limpio" aria-describedby="basic-addon3">

  <label for="estado_habitacion">Mantenimiento: </label>
  <input type="radio" name = "estado_habitacion" class="form-control" id="habitacion_mantenimiento" aria-describedby="basic-addon3">
</div>
