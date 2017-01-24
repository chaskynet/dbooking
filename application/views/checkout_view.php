<div class="input-group form-group">
  <span class="input-group-addon" id="basic-addon3">Clientes: </span>
  
  <?php
  		foreach ($clientes as $key) {
  ?>
  	<a href="#" id='cli_<?=$key->id_clientes;?>' data-toggle='collapse' data-target='#reg_clients_<?=$key->id_clientes;?>' aria-expanded="false">
  		<img src='<?=base_url();?>assets/images/people.png' class='people'>
  	</a> 
  <?php
  		};
  		foreach ($clientes as $key) {
  ?>
  	<div class="row col-md-12">
	  	<div class='collapse' id='reg_clients_<?=$key->id_clientes;?>' data-cliente='<?=$key->id_clientes;?>'>
		    <div class='row' style = 'margin-left:15px;'>
		      <div class='col-md-4 input-group form-group' style='float: left;'>
		        <span class='input-group-addon' id='label_ci_passport'>CI/Pasaporte: </span>
		        <input type='text' class='form-control' id='ci_passport' aria-describedby='basic-label_ci_passport' value='<?=$key->nit_cliente;?>' disabled>
		      </div>
		      <div class='col-md-7 input-group form-group' style='float: right;with:66%;'>
		        <span class='input-group-addon' id='basic-addon3'>Nombre y Apellidos: </span>
		        <input type='text' class='form-control' id='nombre_apell' aria-describedby='basic-addon3' value="<?=$key->rsocial;?>" disabled>
		      </div>
		    </div>
		    <div class='row'>
		      <div class='col-md-3 form-group'>
		        Nacionalidad: 
		        <input type='text' class='form-control' id='nacionalidad' aria-describedby='basic-addon3' value="<?=$key->pais;?>" disabled>
		      </div>
		      <div class='col-md-4 form-group'>
		        Ciudad: 
		        <input type='text' class='form-control' id='ciudad' aria-describedby='basic-addon3' value="<?=$key->ciudad;?>" disabled>
		      </div>
		      <div class='col-md-5 form-group'>
		        Dirección: 
		        <input type='text' class='form-control' id='direccion' aria-describedby='basic-addon3' value="<?=$key->direccion;?>" disabled>
		      </div>
		    </div>
	  	</div>
  	</div>
  <?php
  		};
  ?>
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
  <input type="text" class="form-control" id="adelanto" aria-describedby="basic-addon3" value="<?=$datos->adelanto?>">
</div>
<div class="input-group form-group">
  <span class="input-group-addon" id="basic-addon3">Total: </span>
  <input type="text" class="form-control" id="total" aria-describedby="basic-addon3" value="<?=($datos->costo*$datos->dias)-$datos->adelanto;?>">
</div>
<div class="row form-group">
	<div class="col-lg-4">
	    <div class="input-group">
	      <input type="text" class="form-control" aria-label="sucio" value="Sucio" disabled>
	      <span class="input-group-addon">
	        <input type="radio" aria-label="sucio" name="estado_hab" id="sucio">
	      </span>
	    </div>
  	</div>
  	<div class="col-lg-4">
	    <div class="input-group">
	      <input type="text" class="form-control" aria-label="limpio" value="Limpio" disabled>
	      <span class="input-group-addon">
	        <input type="radio" aria-label="limpio" name="estado_hab" id="limpio">
	      </span>
	    </div>
  	</div>
  	<div class="col-lg-4">
	    <div class="input-group">
	      <input type="text" class="form-control" aria-label="reservado" value="Reservado" disabled>
	      <span class="input-group-addon">
	        <input type="radio" aria-label="reservado" name="estado_hab" id="reservado">
	      </span>
	    </div>
  	</div>
</div>
