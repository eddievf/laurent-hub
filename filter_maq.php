<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[PYMAQ] MAQUINADOS - Filtros</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
	<link href="css/welcome.css" rel="stylesheet">
	<link href="css/circle.css" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/scrollspy.js"></script>
	<script src="js/getinfo.js"></script>
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
					<li><a href="#results">Informacion</a></li>
				</ul>
				<ul class="nav nav-sidebar">
					<li><a href="#presets">Consultas Comunes</a></li>
					<li><a href="#selects">Consulta Personal</a></li>
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

				<div class="container-fluid" id="presets">
					<h2 class="sub-header">Consultas Predeterminadas</h2>
					<div class="btn-group btn-group-justified" role="group" aria-label="...">
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-default">Query A</button>
						</div>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-default">Query B</button>
						</div>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-default">Query C</button>
						</div>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-default">Query D</button>
						</div>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-default">Query E</button>
						</div>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-default">Query F</button>
						</div>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-default">Query G</button>
						</div>
					</div>
				</div>

				<div class="container-fluid" id="selects">
					<h2 class="sub-header">Consultas Personalizadas</h2>
					<form>
						<div class="row">
							<div class="col-md-4">
								<h3><u>Campos Disponibles</u></h3>
								<div class="form-group">

									<div class="checkbox">
										<label>
											<input type="checkbox" name="Orders" value="True"><b>Seleccionar Todos</b>
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
								
								<h3><u>Condiciones</u></h3>
								<div class="form-group form-group-sm">

									
									<div class="form-group row">
										<label for="WhereWorkOrder" class="col-sm-6 col-form-label">
											<input type="checkbox" name="WhereWork" id="WhereWork" value="true"> Orden Trabajo
										</label>
										<div class="col-sm-6">
											<input class="form-control" type="number" placeholder="Folio Orden Trabajo" name="WhereWorkOrder" id="WhereWorkOrder">
										</div>
									</div>

									<div class="form-group row">
										<label for="WhereMunsOrder" class="col-sm-6 col-form-label">
											<input type="checkbox" name="WhereMuns" id="WhereMuns" value="true"> Orden Compra 
										</label>
										<div class="col-sm-6">
											<input class="form-control" type="number" placeholder="Folio Orden Compra" name="WhereMunsOrder" id="WhereMunsOrder">
										</div>
									</div>

									<div class="form-group row">
										<label for="WhereClientName" class="col-sm-6 col-form-label">
											<input type="checkbox" name="WhereClient" id="WhereClient" value="true"> Cliente
										</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" placeholder="Nombre Cliente" name="WhereClientName" id="WhereClientName">
										</div>
									</div>

									<div class="form-group row">
										<label for="WhereAvaIs" class="col-sm-6 col-form-label">
											<input type="checkbox" name="WhereAva" id="WhereAva" value="true"> (%) Avance
										</label>
										<div class="col-sm-6">
											<input class="form-control" type="number" placeholder="Buscar segun Avance" name="WhereAvaIs" id="WhereAvaIs">
										</div>
									</div>

									<h3><u>Ordenar</u></h3>
								<div class="form-group">

									<div class="checkbox">
										<label>
											<input type="checkbox" name="OrderBy" value="True"><b>Ordenar por Campos<b>
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
								
								
							</div>

						</div>

						

					</form>
				</div>
						
				

				
				

			</div><!--Main Content until here-->	



		</div>
	</div>

</body>
</html>