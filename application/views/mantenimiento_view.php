<div class="row">
	<div id="error_form_resmante"></div>
</div>
<div class="row">
<?=form_open('','id="form_mante_hab"');?>
	<div class="col-md-6 input-group" style="margin-left: 1%;">
		<input type="hidden" name ="id_hab" id ="id_hab" value="<?=$id_hab;?>">
	    <span class="input-group-addon" id="basic-addon3">Motivo: </span>
	    <textarea cols="10" rows="5" class="form-control" id="motivo_mantenimiento" name = "motivo_mantenimiento" aria-describedby="basic-addon3"></textarea>
	</div>
<?=form_close();?>
</div>