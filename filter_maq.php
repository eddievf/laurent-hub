<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[PYMAQ] MAQUINADOS - Formularios</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="css/welcome.css" rel="stylesheet">
	<link href="css/circle.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/scrollspy.js"></script>
	<script src="js/getinfo.js"></script>
	<!--bootstrap select-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>

	

</head>
<body data-spy="scroll" data-target="#side-nav" data-offset="180">
<!--navbar group-->
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Filters Maquinados</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="welcome_rev.php">Inicio</a></li>
					<li><a href="forms_maq.php">Formularios</a></li>
					<li><a href="filter_maq.php">Reportes</a></li>
					<li class="dropdown">
              			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Departamentos <span class="caret"></span></a>
              			<ul class="dropdown-menu">
                			<li><a href="welcome_rev.php">Maquinados</a></li>
                			<li><a href="#">Almacen</a></li>
                			<li><a href="#">Troquelado</a></li>
                			<li role="separator" class="divider"></li>
                			<li><a href="#">Almacen</a></li>
                			<li><a href="#">Embarque</a></li>
              			</ul>
					</li>
					<li><a href="#">Help</a></li>
				</ul>
			</div><!--collapse-->
		</div><!--container fluid-->
	</nav>
<!--webpage layout-->
	<div class="container-fluid">
		<div class="row">
			<!--SIDEBAR-->
			<div class="col-sm-3 col-md-2 sidebar affix" id="side-nav">
				<?php
					date_default_timezone_set("America/Monterrey");
					$regdate = "Registro en ".date("Y-m-d");
					//database connection
    				try{
      					$servername = "localhost";
      					$username = "root";
      					$password = "";

      					$conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
      					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      					echo '<div class = "alert alert-success text-center"> <strong> CONN </strong> :: Conexion Establecida </div>';
    				}
    				catch (PDOException $e){
						echo "
							<div class= 'alert alert-danger'><p class='text-center'><strong>[ERROR] </strong> :: <u>".$e->getMessage()."</u> :: (error: JD01)</p></div>";
    				}
  				?>
  				<ul class="nav nav-sidebar">
					<li><a href="#results">Consulta Informacion</a></li>
				</ul>
				<ul class="nav nav-sidebar">
					<li><a href="#selects">SELECT</a></li>
				</ul>

			</div>
			<!--end sidebar-->
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<!--Main Content-->	
				<div id="results">			
				<h1 class="page-header">Reporte de Producción y Procesos</h1>
				
					<div class="container-fluid" id="txtHint">
						<div class="row placeholders">
							
							<div class="jumbotron jumbotron-fluid">
								<div class="container">
									<h2 class="display-3">Consulta detallada de información</h2>
									<p class="lead text-muted"><i>En la parte inferior se encuentran los campos disponibles para consulta de información.<br>Tras seleccionar la información requerida, esta se mostrará en esta sección.</i></p>
								</div>
							</div>
	
						</div>	
					</div>
				</div>

				<div class="container" id="selects">
				<form>
					<div class="row">
						<div class="col-md-4">
							<h3>Campos Disponibles</h3>
							<div class="form-group">

								<div class="checkbox">
									<label>
										<input type="checkbox" name="Orders" value="True">Ordenes
									</label>
								</div>

								<div class="checkbox col-md-offset-1">
									<label>
										<input type="checkbox" name="OrdenTrabajo" value="True">Orden de Trabajo
									</label>
								</div>
								<div class="checkbox col-md-offset-1">
									<label>
										<input type="checkbox" name="OrdenCompra" value="True">Orden de Compra
									</label>
								</div>
								<div class="checkbox col-md-offset-1">
									<label>
										<input type="checkbox" name="Cliente" value="True">Cliente
									</label>
								</div>
								<div class="checkbox col-md-offset-1">
									<label>
										<input type="checkbox" name="FechaSolicitud" value="True">Fecha de Solicitud
									</label>
								</div>
								<div class="checkbox col-md-offset-1">
									<label>
										<input type="checkbox" name="Partida" value="True">Partida
									</label>
								</div>
								<div class="checkbox col-md-offset-1">
									<label>
										<input type="checkbox" name="Pieza" value="True">Pieza
									</label>
								</div>
								<div class="checkbox col-md-offset-1">
									<label>
										<input type="checkbox" name="Cantidad" value="True">Cantidad
									</label>
								</div>
								<div class="checkbox col-md-offset-1">
									<label>
										<input type="checkbox" name="Progress" value="True">Proceso Actual
									</label>
								</div>
								<div class="checkbox col-md-offset-1">
									<label>
										<input type="checkbox" name="Avance" value="True">(%) Avance
									</label>
								</div>
								<div class="checkbox col-md-offset-1">
									<label>
										<input type="checkbox" name="Fecha" value="True">Fecha de Compromiso
									</label>
								</div>
								<div class="checkbox col-md-offset-1">
									<label>
										<input type="checkbox" name="FechaReal" value="True">Fecha Real
									</label>
								</div>
								<div class="checkbox col-md-offset-1">
									<label>
										<input type="checkbox" name="Factura" value="True">Factura
									</label>
								</div>
							
							</div>
						</div>

						<div class="col-md-4 col-md-push-1">
							<h3>Ordenar</h3>
							<div class="form-group">

								<div class="checkbox">
									<label>
										<input type="checkbox" name="OrderBy" value="True">Ordenar por Campos
									</label>
								</div>
								<div class="checkbox col-md-offset-1">
									<label>
										<input type="checkbox" name="ReqDate" value="True">Fecha de Solicitud
									</label>
								</div>
								<div class="checkbox col-md-offset-1">
									<label>
										<input type="checkbox" name="WorkOrder" value="True">Orden de Trabajo
									</label>
								</div>
								<div class="checkbox col-md-offset-1">
									<label>
										<input type="checkbox" name="MunsOrder" value="True">Orden de Compra
									</label>
								</div>
							</div>
							<h3>Condiciones</h3>
							<div class="form-group form-group-sm">

								<div class="checkbox">
									<label>
										<input type="checkbox" name="Condition" value="True">Seleccionar Condicionales
									</label>
								</div>
								<div class="form-group row">
									<label for="WhereWork" class="col-sm-2 col-form-label">Orden Trabajo</label>
									<div class="col-sm-6">
										<input class="form-control" type="number" placeholder="Folio Orden Trabajo" name="WhereWork" id="WhereWork">
									</div>
								</div>
								<div class="form-group row">
									<label for="WhereMuns" class="col-sm-2 col-form-label">Orden Compra</label>
									<div class="col-sm-6">
										<input class="form-control" type="number" placeholder="Folio Orden Compra" name="WhereMuns" id="WhereMuns">
									</div>
								</div>
									
							</div>

							
							
						</div>

					</div>

					<div class="row">

						<div class="col-md-4">
							<h3>Condiciones</h3>
						</div>
						
					</div>

				</form>
				</div>
						
				

				
				

			</div><!--Main Content until here-->	



		</div>
	</div>

</body>
</html>