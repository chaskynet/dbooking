<div class="row">
	<div class='col-md-5 input-group form-group' style="float: left; margin-right: 1%;margin-left: 1%;">
		<span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
        <input type='text' class="form-control" id='fch_reserva' />
        <script type="text/javascript">
            $(function () {
                $('#fch_reserva').datetimepicker({
	                	format: 'D/M/YYYY'
	                	});
            });
        </script>
    </div>
	<div class='col-md-5 input-group form-group'>
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-time"></span>
        </span>
        <input type='text' class="form-control" id='hr_reserva' />
        <script type="text/javascript">
            $(function () {
                $('#hr_reserva').datetimepicker({
	                	format: 'LT'
	                	});
            });
        </script>
    </div>
</div>