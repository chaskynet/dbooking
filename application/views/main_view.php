<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DBooking - Hotel</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/js/jquery-ui-1.11.4/jquery-ui.min.css">
	<!-- <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="<?=base_url();?>assets/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="<?=base_url();?>assets/css/estilos_side_menu.css">
	<link rel="stylesheet" href="<?=base_url();?>assets/css/estilos.css">

	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<header>
		<?php $permisos = $this->session->userdata('permisos'); ?>
		<div  class="menu_bar_icon">
            <a href="logout" class="bt-icon-menu" style=" float:right; "> 
            	<i class="glyphicon glyphicon-off"></i>
            </a>
            <label style=" float:right; padding: 18px ; color: #AAAAAA; font-size:0.9em;">
            	<?= $this->session->userdata('usuario');?>
            </label>
            <a href="principal">
		    	<label style="margin-left:5%;padding-top:5px;color: #FFF;">
		        	<h3 class="titulo" id="fullscr">DBooking</h3>
		        </label>
	        </a>
			<label style="margin-left:5%;padding-top:5px;color: #FFF;" id="estado_caja">
	        <?php if ($this->session->userdata('estado_caja') == 'cerrado') { ?>
		        	<button class="btn btn-danger" style="color: #fff;font-weight:bold;" id="caja">Caja CERRADA!</button>
		        <?php } else {?>
		        	<button class="btn btn-primary" style="color: #fff;font-weight:bold;" id="caja">Caja ABIERTA!</button>
		     <?php } ?>
	        </label>
        </div>
		<div class="menu_bar quitar_float lado" >
            <a href="#" style="color:#AAA660;"> <span class="glyphicon glyphicon-menu-hamburger"></span></a>
        </div>
        <nav class='llevar-adelante'>
            <ul>
            	<?php if(in_array('chk_adm_hab', $permisos)){ ?>
            	<li>                
                    <a href="#" id="adm_habitaciones" data-tipo="todo"> <i class="glyphicon glyphicon-bed"></i> &nbsp; Adm. de habitaciones </a>
                </li>
                <?php } if(in_array('chk_gestion_usrs', $permisos)){ ?>
                <li>                      
                    <a href="#" id="gestion-usuarios"> <i class="glyphicon glyphicon-user"></i> &nbsp; Gestion de Usuarios </a>
                </li>
                <?php }  if(in_array('chk_adm_clientes', $permisos)){?>
            	<li>                      
                    <a href="#" id="gestion-clientes"> <i class="glyphicon glyphicon-star"></i> &nbsp; Gestion de Clientes </a>
                </li>
                <?php }  if(in_array('chk_asigna_hab', $permisos)){?>
                <li>                      
                    <a href="#" id="asignar_habitacion"> <i class="glyphicon glyphicon-bed"></i> &nbsp; Habitaciones </a>
                </li>
                <?php }  if(in_array('chk_rep_caja', $permisos)){?>
                <li>                      
                    <a href="#" id="caja"> <i class="glyphicon glyphicon-usd"></i> &nbsp; Caja </a>
                </li>
                <?php } ?>
                <li>                      
                    <a href="#" id="reportes"> <i class="glyphicon glyphicon-list-alt"></i> &nbsp; Reportes </a>
                </li>
                <li>
                    <a href="logout"> <i class="glyphicon glyphicon-off"></i> &nbsp; Salir </a>
                </li>
            </ul>
        </nav>
	</header>
	<!-- DIV contenedor para la impresion -->
	<div id="printer" style="display:none"></div>
	<!-- FIN contenedor para la impresion -->

	<!--  ****** Contenido principal ******  -->
	<div class="container-fluid well" id="contenido">
	<?php if(in_array('chk_rep_caja', $permisos)){?>
		<div class="row-fluid">
			<div class="col-md-4">
				<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Clientes</h3>
				  </div>
				  <div class="panel-body">
				  	<button class="btn" style="width:100%;"> Clientes Registrados <span class="badge">4</span></button>
				    
				  </div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title"><span class="glyphicon glyphicon-usd"></span> Ingresos</h3>
				  </div>
				  <div class="panel-body">
				  	<button class="btn" style="width:100%;"><span class="glyphicon glyphicon-usd"></span> Facturación del día <span class="badge"><?=$ingresos->ingresos;?> BS.</span></button>
				  </div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title"><span class="glyphicon glyphicon-bed"></span> Habitaciones</h3>
				  </div>
				  <div class="panel-body">
				  	<div class="list-group">
					  	<a href="#" class="list-group-item list-group-item-info" style="width:100%;"> Habitaciones Ocupadas <span class="badge"><?=count($detalle_ocupadas);?></span></a>

					  	<a href="#" class="list-group-item list-group-item-success" style="width:100%;"> Habitaciones Disponibles <span class="badge"><?=count($detalle_libres); ?></span></a>
				  			
					  	<a href="#" class="list-group-item list-group-item-warning" style="width:100%;"> Habitaciones Reservadas <span class="badge"><?=count($detalle_reservadas); ?></span></a>
				  	</div>
				  </div>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>
	<!-- <script type="text/javascript" src="<?=base_url();?>assets/js/jquery-1.12.1.min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- <script type="text/javascript" src="<?=base_url();?>assets/js/jquery-ui-1.11.4/jquery-ui.min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/bower_components/moment/min/moment.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/jquery.printarea.js"></script>
	<!-- <script type="text/javascript" src="<?=base_url();?>assets/css/bootstrap/js/bootstrap.min.js"></script> -->
	<script type="text/javascript" src="<?=base_url();?>assets/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script type="text/javascript" src="<?php echo base_url();?>assets/js/AjaxFileUploader/ajaxfileupload.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/sidebar.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/js/dbooking.js"></script>
</body>
</html>