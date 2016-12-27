<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[PYMAQ] MAQUINADOS - Formularios</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
	<link href="css/welcome.css" rel="stylesheet">
	<link href="css/circle.css" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/scrollspy.js"></script>
	<script src="js/getinfo.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>

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
				<a class="navbar-brand" href="#">Forms Maquinados</a>
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
			<!--sidebar-->
			<div class="col-sm-3 col-md-2 sidebar affix" id="side-nav">
				<ul class="nav nav-sidebar">
					<li><a href="#morework">Ordenes Nuevas</a></li>
					<li><a href="#updatework">Actualizacion de Ordenes</a></li>
					<li><a href="#closingwork">Cierre de Ordenes</a></li>
				</ul>
			</div>
			<!--end sidebar-->
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<!--Main Content-->	
				<div id="morework">
				<h1 class="page-header">Production Dashboard</h1>
				<!--Focus Images-->
				<div class="container-fluid">
					<div class="row placeholders">
						
							
							<div class="jumbotron jumbotron-fluid">
								<div class="container">
									<h2 class="display-3">Registro de Ordenes Nuevas</h2>
									<p class="lead text-muted"><i>Ingresar los datos de las Ordenes de Trabajo a Producir</i></p><br>
								</div>


								<div class="container">
								<form class="form-horizontal" role="form" method="POST" action="php/createor.php">

									<div class="form-group row">
										<label for="OrdenTrabajo" class="col-sm-2 col-form-label">Orden de Trabajo</label>
										<div class="col-sm-6">
										<input class="form-control" type="text" placeholder="Ingresar Folio de la Orden (0 de no existir)" name="OrdenTrabajo" id="OrdenTrabajo" autofocus required>
										</div>
									</div>
									<div class="form-group row">
										<label for="OrdenCompra" class="col-sm-2 col-form-label">Orden de Compra</label>
										<div class="col-sm-6">
										<input class="form-control" type="text" placeholder="Ingresar Orden de Compra (0 de no existir)" name="OrdenCompra" id="OrdenCompra" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="Pieza" class="col-sm-2 col-form-label">Pieza</label>
										<div class="col-sm-6">
										<select class="form-control selectpicker" data-live-search="true" name="Pieza">
											<?php		
												$query = ("SELECT ID, Descripcion from testpiezas ORDER BY ID");
												$data = $conn->prepare($query);
												$data->execute();
												while($row=$data->fetch(PDO::FETCH_ASSOC)){
												echo '<option value="'.$row['ID'].'">'.$row['Descripcion'].'</option>';
												}
												
											?>
										</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="Cliente" class="col-sm-2 col-form-label">Cliente</label>
										<div class="col-sm-6">
										<input class="form-control" type="text" placeholder="Ingresar Nombre de Cliente" name="Cliente" id="Cliente" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="FechaSolicitud" class="col-sm-2 col-form-label">Fecha de Solicitud</label>
										<div class="col-sm-6">
										<input class="form-control" type="date" placeholder="Ingresar fecha marcada en Orden" name="FechaSolicitud" id="FechaSolicitud" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="Partida" class="col-sm-2 col-form-label">Partida</label>
										<div class="col-sm-6">
										<input class="form-control" type="number" placeholder="Ingresar numero Partida de la Pieza" name="Partida" id="Partida" required>
										</div>
									</div>
									
									<div class="form-group row">
										<label for="Cantidad" class="col-sm-2 col-form-label">Cantidad</label>
										<div class="col-sm-6">
										<input class="form-control" type="number" placeholder="Cantidad de Piezas a Fabricar" name="Cantidad" id="Cantidad" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="Registry" class="sr-only">Registro</label>
										<div class="col-sm-6">
										<input class="form-control" type="hidden" value="<?php echo htmlspecialchars($regdate); ?>" name="Registry" id="Registry">
									</div>
									<div class="form-group row">
										<div class="col-sm-6">
										<button type="submit" class="btn btn-primary">Aceptar</button>
										</div>
									</div>
								</form>
								<!--End New Order Form-->
								</div>
								<!--End New Order Container-->
							</div>
								<!--End New Order Jumbotron-->
						
						<!--End New Order-->
					</div>
						<!--Row Class Placeholders-->
				</div>
						<!--Container Fluid-->
				</div>
				<!--Div with ID-->							
				<!--END OF NEW ORDER-->

				<!--START OF UPDATE-->
				<div class="container-fluid" id="updatework">
					<div class="jumbotron jumbotron-fluid">
						<div class="container">
							<h2 class="display-3">Actualización de Ordenes</h2>
							<p class="lead text-muted"><i>Actualizar Información de las Ordenes en Proceso</i></p><br>
						</div>
						<div class="container">
							<select class="custom-select selectpicker offset-sm-2 col-sm-8" name="orders" data-live-search="true" onchange="showOrder(this.value)">
							  <?php

							      $selectorder = ("SELECT testorders.ID, OrdenTrabajo, Partida, Descripcion, Progress
							                 FROM testorders, testpiezas
							                 WHERE (testpiezas.id)=(testorders.pieza)
							                 AND Progress <> 'Entregado'
							                 ORDER BY OrdenTrabajo, Partida");

							      $data = $conn->prepare($selectorder);
							      $data->execute();
							      

							      while($row=$data->fetch(PDO::FETCH_ASSOC)){
							        
							        echo '<option value="'.$row['ID'].'">'.$row['OrdenTrabajo'].' - '.$row['Descripcion'].'</option>';
							      }

							    ?>
							  </select>
						</div>
						<br>

						<div class="container" id="txtHint"><b> Seleccione la Orden / Partida del Menú Superior. </b></div>
						<br>
						<br>
					</div>
				</div><!--END OF UPDATE-->

				
					

			</div><!--Main Content until here-->	



		</div>
	</div>

</body>
</html>