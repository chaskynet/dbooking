<div class="row form-group col-md-12">
  <div class="input-group col-md-5" style="float: left;">
    <span class="input-group-addon" id="basic-addon3">Fecha: </span>
    <input type="text" class="form-control" id="fecha_checkin" aria-describedby="basic-addon3" value="<?=date('d-m-Y');?>" disabled>
  </div>
  <div class="input-group col-md-5" style="float: right;">
    <span class="input-group-addon" id="basic-addon3">Hora: </span>
    <input type="text" class="form-control" id="hora_checkin" aria-describedby="basic-addon3" value="<?=date('H:i:s');?>" disabled>
  </div>
</div>
<div class="row form-group col-md-12">
  <div class="col-md-6 input-group " style="float: left;">
    <span class="input-group-addon" id="basic-addon3">Tarifa: </span>
    <input type="text" class="form-control" id="tarifa_hab" name = "tarifa_hab" aria-describedby="basic-addon3" value="<?php echo $datos->costo; ?>">
  </div>
  <div class="col-md-6 input-group " style="float: right;">
    <span class="input-group-addon">
      <input type="checkbox" aria-label="..." id="desayuno" name="desayuno">
    </span>
    <input type="text" class="form-control" aria-label="..." value="Desayuno" disabled>
  </div>
</div>

<div class="row form-group col-md-12">
  <div class="row col-md-12">
    <div class="col-md-3 input-group " style="float: left;">
        <label for="" style="float: left;"># de Personas: </label>
        <a href="" class="thumbnail btn_add" id="add_people"><img src="<?=base_url();?>assets/images/add.png" alt=""></a>
    </div>
    <div class="col-md-9 input-group" id="num_personas" style="float: left;">

    </div>
  </div>
  <div class="row col-md-12" id="tabulador_reg_clientes">
  </div>
</div>

<div class="row form-group">
  <div class="input-group col-md-3 " style="float: left;">
    <span class="input-group-addon" id="basic-addon3">Adelanto: </span>
    <input type="text" class="form-control" id="adelanto" name="adelanto" aria-describedby="basic-addon3">
  </div>
  <div class="col-md-8 input-group">
    <span class="input-group-addon" id="basic-addon3">Observaciones: </span>
    <textarea rows="2" cols="50" class="form-control" id="observaciones" aria-describedby="basic-addon3">
    </textarea>
  </div>
</div>

