<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Booking - Olgas</title>

	<!-- <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/bootstrap/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/estilos.css">
	<!-- <link rel="shortcut icon" href="<?= base_url();?>assets/images/favicon.ico"> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- <script type="text/javascript" src="<?= base_url();?>assets/js/jquery-1.12.1.min.js"></script> -->
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 caja_logo">
				<div >
					<div align="center" class="">
						<h2>DBooking</h2>
						<!-- <img src="<?php echo base_url();?>assets/images/hostel-logo-01.png" class="logo" alt="Hostel Logo"> -->
						
					</div>
				</div>
				<?php
					$attributes = array('class' => 'form_login', 'class' => 'text-center','id' => 'form_login'); 
					echo form_open('main_controller/login_validation', $attributes);
				?>
					<div class="form-group alert" role="alert" name="errores" id="errores">
						<?php echo validation_errors();?>
					</div>
					<div class="form-group input-group input-group-sm col-sm-7 col-md-offset-3">
					  <span class="input-group-addon glyphicon glyphicon-user" id="sizing-addon1"></span>
					  <input type="text" class="form-control" placeholder="Usuario" aria-describedby="sizing-addon1" name="usuario" id="usuario" autofocus>
					</div>

					<div class="form-group input-group input-group-sm col-sm-7 col-md-offset-3">
					  <span class="input-group-addon glyphicon glyphicon-lock" id="sizing-addon1"></span>
					  <input type="password" class="form-control" placeholder="Password" aria-describedby="sizing-addon1" name="password" id="password">
					</div>

					<input type="submit" value="Ingresar" class="btn btn-primary">
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

</body>
</html>