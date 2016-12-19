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
				
					<div class="container-fluid" id="showFilter">
						<div class="row placeholders">
							
							<div class="jumbotron jumbotron-fluid">
								<div class="container">
									<h2 class="display-3">Consulta detallada de información</h2>
									<p class="lead text-muted"><i>En la parte inferior se encuentran los campos disponibles para consulta de información.<br>Tras solicitar la información requerida, esta se mostrará en esta sección.</i></p>
								</div>
							</div>
	
						</div>	
					</div>
				</div>

				<div class="container-fluid" id="presets">
					<h2 class="sub-header">Consultas Predeterminadas</h2>
					<div class="btn-group btn-group-justified" role="group" aria-label="...">
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-default" name="buttonOpen" id="buttonOpen">Ordenes Abiertas</button>
						</div>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-default" name="buttonStopped" id="buttonStopped">Proceso Detenido</button>
						</div>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-default" name="buttonDone" id="buttonDone">All Done in Last Month</button>
						</div>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalWork" name="buttonWork" id="buttonWork">Orden Trabajo*</button>
						</div>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalMuns" name="buttonMuns" id="buttonMuns">Orden de Compra*</button>
						</div>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalClient" name="buttonClient" id="buttonClient">Ordenes de Cliente*</button>
						</div>
						
					</div>
				</div>

			<!--MODALS-->
				<div id="modalWork" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="modalWork" aria-hidden="true">
					<div class="modal-dialog modal-sm" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Ingresar Orden de Trabajo</h4>
							</div>
							<form id="WorkOrderFilter" method="POST">
							<div class="modal-body">
								
									<div class="form-group">
										<label for="WorkOrderNumber">Numero de Orden</label>
										<input type="number" class="form-control" id="WorkOrderNumber" name="WorkOrderNumber" placeholder="Folio de Orden de Trabajo">
									</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-primary">Aceptar</button>
							</form>
							</div>
						</div>
					</div>
				</div>

				<div id="modalMuns" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="modalWork" aria-hidden="true">
					<div class="modal-dialog modal-sm" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Ingresar Orden de Compra</h4>
							</div>
							<form id="TemmieOrderFilter" method="POST">
							<div class="modal-body">
								<div class="form-group">
									<label for="TemmieOrderNumber">Numero de Orden</label>
									<input type="number" class="form-control" id="TemmieOrderNumber" name="TemmieOrderNumber" placeholder="Folio de Orden de Compra">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-primary">Aceptar</button>
							</form>
							</div>
						</div>
					</div>
				</div>

				<div id="modalClient" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="modalWork" aria-hidden="true">
					<div class="modal-dialog modal-sm" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Ingresar Nombre de Cliente</h4>
							</div>
							<form id="ClientFilter" method="POST">
							<div class="modal-body">
								<div class="form-group">
									<label for="ClientText">Cliente </label>
									<input type="text" class="form-control" id="ClientText" name="ClientText" placeholder="Nombre de Cliente">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-primary">Aceptar</button>
							</form>
							</div>
						</div>
					</div>
				</div>
			<!--MODALS-->


				<div class="container-fluid" id="selects">
					<h2 class="sub-header">Consultas Personalizadas</h2>
					<form class="form-horizontal" role="form" method="POST" action="php/filtersend.php">
						<div class="row">
							<div class="col-md-4">
								<h3><u>Campos Disponibles</u></h3>
								<div class="form-group">

									<div class="checkbox">
										<label>
											<input type="hidden" name="Orders" id="OrdersHidden" value="0">
											<input type="checkbox" name="Orders" id="Orders" value="1"><b>Seleccionar Todos</b>
										</label>
									</div>

									<div class="checkbox col-md-offset-1">
										<label>
											<input type="hidden" name="OrdenTrabajo" id="OrdenTrabajoHidden" value="0">
											<input type="checkbox" name="OrdenTrabajo" id="Orders" value="1">Orden de Trabajo
										</label>
									</div>
									<div class="checkbox col-md-offset-1">
										<label>
											<input type="hidden" name="OrdenCompra" id="OrdenCompraHidden" value="0">
											<input type="checkbox" name="OrdenCompra" id="OrdenCompra" value="1">Orden de Compra
										</label>
									</div>
									<div class="checkbox col-md-offset-1">
										<label>
											<input type="hidden" name="Cliente" id="ClienteHidden" value="0">
											<input type="checkbox" name="Cliente" id="Cliente" value="1">Cliente
										</label>
									</div>
									<div class="checkbox col-md-offset-1">
										<label>
											<input type="hidden" name="FechaSolicitud" id="FechaSolicitudHidden" value="0">
											<input type="checkbox" name="FechaSolicitud" id="FechaSolicitud" value="1">Fecha de Solicitud
										</label>
									</div>
									<div class="checkbox col-md-offset-1">
										<label>
											<input type="hidden" name="Partida" id="PartidaHidden" value="0">
											<input type="checkbox" name="Partida" id="Partida" value="1">Partida
										</label>
									</div>
									<div class="checkbox col-md-offset-1">
										<label>
											<input type="hidden" name="Pieza" id="PiezaHidden" value="0">
											<input type="checkbox" name="Pieza" id="Pieza" value="1">Pieza
										</label>
									</div>
									<div class="checkbox col-md-offset-1">
										<label>
											<input type="hidden" name="Cantidad" id="CantidadHidden" value="0">
											<input type="checkbox" name="Cantidad" id="Cantidad" value="1">Cantidad
										</label>
									</div>
									<div class="checkbox col-md-offset-1">
										<label>
											<input type="hidden" name="Progress" id="ProgressHidden" value="0">
											<input type="checkbox" name="Progress" id="Progress" value="1">Proceso Actual
										</label>
									</div>
									<div class="checkbox col-md-offset-1">
										<label>
											<input type="hidden" name="Avance" id="AvanceHidden" value="0">
											<input type="checkbox" name="Avance" id="Avance" value="1">(%) Avance
										</label>
									</div>
									<div class="checkbox col-md-offset-1">
										<label>
											<input type="hidden" name="FechaCompromiso" id="FechaCompromisoHidden" value="0">
											<input type="checkbox" name="FechaCompromiso" id="FechaCompromiso" value="1">Fecha de Compromiso
										</label>
									</div>
									<div class="checkbox col-md-offset-1">
										<label>
											<input type="hidden" name="FechaReal" id="FechaRealHidden" value="0">
											<input type="checkbox" name="FechaReal" id="FechaRealHidden" value="1">Fecha Real
										</label>
									</div>
									<div class="checkbox col-md-offset-1">
										<label>
											<input type="hidden" name="Factura" id="FacturaHidden" value="0">
											<input type="checkbox" name="Factura" id="Factura" value="1">Factura
										</label>
									</div>
								
								</div>
							</div>

							<div class="col-md-4 col-md-push-1">
								
								<h3><u>Condiciones</u></h3>
								<div class="form-group form-group-sm">

									
									<div class="form-group row">
										<label for="WhereWorkOrder" class="col-sm-6 col-form-label">
											<input type="hidden" name="WhereWork" id="WhereWorkHidden" value="0">
											<input type="checkbox" name="WhereWork" id="WhereWork" value="1"> Orden Trabajo  =
										</label>
										<div class="col-sm-6">
											<input class="form-control" type="number" placeholder="Folio Orden Trabajo" name="WhereWorkOrder" id="WhereWorkOrder">
										</div>
									</div>

									<div class="form-group row">
										<label for="WhereMunsOrder" class="col-sm-6 col-form-label">
											<input type="hidden" name="WhereMuns" id="WhereMunsHidden" value="0">
											<input type="checkbox" name="WhereMuns" id="WhereMuns" value="1"> Orden Compra  =
										</label>
										<div class="col-sm-6">
											<input class="form-control" type="number" placeholder="# Orden Compra" name="WhereMunsOrder" id="WhereMunsOrder">
										</div>
									</div>

									<div class="form-group row">
										<label for="WhereClientName" class="col-sm-6 col-form-label">
											<input type="hidden" name="WhereClient" id="WhereClientHidden" value="0">
											<input type="checkbox" name="WhereClient" id="WhereClient" value="1"> Cliente</p>
										</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" placeholder="Nombre Cliente" name="WhereClientName" id="WhereClientName">
										</div>
									</div>

									<div class="form-group row">
										<label for="WhereAvaIs" class="col-sm-6 col-form-label">
											<input type="hidden" name="WhereProg" id="WhereProogHidden" value="0">
											<input type="checkbox" name="WhereProg" id="WhereProg" value="1"> Proceso Actual  =/=
										</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" placeholder="Buscar por Estado" name="WhereProgIs" id="WhereProgIs">
										</div>
									</div>

									<h3><u>Ordenar</u></h3>
								<div class="form-group">

									<div class="checkbox">
										<label>
											<input type="hidden" name="OrderBy" id="OrderByHidden" value="0">
											<input type="checkbox" name="OrderBy" id="OrderBy" value="1"><b>Ordenar por Campos<b>
										</label>
									</div>
									<div class="checkbox col-md-offset-1">
										<label>
											<input type="hidden" name="ReqDate" id="ReqDateHidden" value="0">
											<input type="checkbox" name="ReqDate" id="ReqDate" value="1">Fecha de Solicitud
										</label>
									</div>
									<div class="checkbox col-md-offset-1">
										<label>
											<input type="hidden" name="WorkOrder" id="WorkOrderHidden" value="0">
											<input type="checkbox" name="WorkOrder" id="WorkOrder" value="1">Orden de Trabajo
										</label>
									</div>
									<div class="checkbox col-md-offset-1">
										<label>
											<input type="hidden" name="MunsOrder" id="MunsOrderHidden" value="0">
											<input type="checkbox" name="MunsOrder" value="1">Orden de Compra
										</label>
									</div>
								</div>

								
								
							</div>

						</div>
						<div class="col-md-1 col-md-push-2">
							<div class="form-group">
								<div class="col-sm-6">
								<br>
									<button type="submit" class="btn btn-primary">Aceptar</button>
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