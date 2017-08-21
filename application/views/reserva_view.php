<div class="row">
    <div id="error_form_resmante"></div>
</div>
<?=form_open('','id="form_reserva_hab"');?>
<div class="row">
    <div class="col-md-8 input-group form-group" style="float: left;margin-right: 1%;margin-left: 1%;">
        <span class="input-group-addon" id="basic-addon3">Nombre de Cliente: </span>
        <input type="text" class="form-control" id="clt_1" name = "clt_1" aria-describedby="basic-addon3" placeholder="Nombre Cliente">
        <input type="hidden" name ="id_hab" id ="id_hab" value="<?=$id_hab;?>">
    </div>
</div>
<div class="row">
	<div class='col-md-3 input-group form-group' style="float: left; margin-right: 1%;margin-left: 1%;">
        <div class="form-group">
            <div class='input-group'>
                <input type='text' class="form-control" name="fch_reserva" id="fch" placeholder="Fecha de reserva" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#fch.form-control').datetimepicker({
                    format: 'D-M-YYYY'
                });            
            });
        </script>
    </div>
	<div class='col-md-3 input-group form-group' style="float: left;margin-right: 1%;margin-left: 1%;">
        <div class="form-group">
            <div class='input-group date' id='hr_reserva'>
                <input type='text' class="form-control" name="hr_reserva" id="hr" placeholder="Hora de Reserva" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#hr.form-control').datetimepicker({
                    format: 'H:mm'
                });            
            });
        </script>
    </div>
    <div class='col-md-3 input-group form-group' style="float: left;margin-right: 1%;margin-left: 1%;">
        <div class="form-group">
            <div class='input-group'>
                <input type='text' class="form-control" name="fch_salida" id="fch_salida" placeholder="Salida" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#fch_salida.form-control').datetimepicker({
                    format: 'D-M-YYYY'
                });            
            });
        </script>
    </div>
    <div class='col-md-2 input-group '>
        <div class="form-group">
            <div class='input-group date' id='hr_reserva'>
                <input type='text' class="form-control" name="hr_salida" id="hr_salida" placeholder="Hora de Salida" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#hr_salida.form-control').datetimepicker({
                    format: 'H:mm'
                });            
            });
        </script>
    </div>
</div>
<div class="row">
    <div class="col-md-6 input-group" style="margin-left: 1%;">
        <input type="hidden" name ="id_hab" id ="id_hab" value="<?=$id_hab;?>">
        <span class="input-group-addon" id="basic-addon3">Obs_Reserva: </span>
        <textarea cols="10" rows="3" class="form-control" id="obs_reserva" name = "obs_reserva" aria-describedby="basic-addon3"></textarea>
    </div>
    
</div>
<?=form_close();?>
