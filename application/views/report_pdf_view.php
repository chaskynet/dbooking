<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/estilos.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="well-lg">
					<table class="table table-bordered table-condensed table-striped">
						<thead>
							<tr>
								<th>
									Fecha
								</th>
								<th>
									# Habitación
								</th>
								<th>
									Nombre Completo
								</th>
								<th>
									# Fecha CheckIn
								</th>
								<th>
									# Fecha CheckOut
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								if (isset($clientes)) {
									foreach ($clientes as $key) {
							?>
							<tr>
								<td>
									<?=date("d-m-Y");?>
								</td>
								<td>
									<?=$cod_hab;?>
								</td>
								<td>
									<?=$key->rsocial;?>
								</td>
								<td>
									<?=date("d-m-Y");?>
								</td>
								<td>
									<?=date("d-m-Y");?>
								</td>
							</tr>
							<?php	
									}
								 	
								 } 
							 ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>