<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[PYMAQ] PRODUCCION </title>
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

	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "test";
		
		try{
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
				<a class="navbar-brand" href="#">Dashboard Maquinados</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="welcome_rev.php">Inicio</a></li>
					<li><a href="forms_maq.php">Formularios</a></li>
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
					<li><a href="#overview">Overview</a></li>
					<li><a href="#reporte">Reporte</a></li>
				</ul>
				<ul class="nav nav-sidebar">
					<li><a href="#consultaorden">Consultas de Estado</a></li>
					<li><a href="#">Hello</a></li>
					<li><a href="#">End of Section</a></li>
				</ul>
				<ul class="nav nav-sidebar">
					<li><a href="#">Section Three</a></li>
					<li><a href="#">Look at this</a></li>
					<li><a href="#">For options </a></li>
				</ul>
			</div>
			<!--end sidebar-->
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<!--Main Content-->	
				<div id="overview">
				<h1 class="page-header">Production Dashboard</h1>
				<!--Focus Images-->
				<div class="container-fluid">
				<div class="row placeholders">

				<?php
					$bars = $conn->prepare(" SELECT OrdenTrabajo, Partida, Descripcion, Avance
							   				 FROM testorders, testpiezas
											 WHERE (testorders.Pieza = testpiezas.ID)
											 ORDER BY RAND()
											 LIMIT 4 ");
					$bars->execute();

					while($check=$bars->fetch(PDO::FETCH_ASSOC)){
						echo "<div class='col-xs-6 col-sm-3 placeholder'>
								<div class='c100 p".$check['Avance']." red img-responsive'>
									<span>".$check['Avance']."%</span>
									<div class='slice'>
										<div class='bar'></div>
										<div class='fill'></div>
									</div>
								</div>
							<h4>".$check['OrdenTrabajo']." - ".$check['Partida']."</h4>
						<span class='text-muted'>".$check['Descripcion']."</span>
					</div>";
					}
				?>
				</div>
				<!--End Focus Images-->
				</div>
				</div>
				<!--Update Table-->							
				<div id="reporte">
				<div class="container-fluid" id="reporte">
				<h2 class="sub-header">Ordenes Abiertas</h2>
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
    					<thead>
      						<tr>
        						<th class = "col-md-0">Orden Trabajo</th>
        						<th class = "col-md-0">Orden Compra</th>
        						<th class = "col-md-1">Cliente</th>
        						<th class = "col-md-0">Partida</th>
        						<th class = "col-md-5">Pieza</th>
        						<th class = "col-md-1">Cantidad</th>
        						<th class = "col-md-2">Fecha Solicitud</th>
        						<th class = "col-md-4">Estado Actual</th>
        						<th class = "col-md-1">Avance</th>
      						</tr>
    					</thead>
    					<tbody>
    						<?php
							class TableRows extends RecursiveIteratorIterator{
								function __construct($it){
									parent::__construct($it, self::LEAVES_ONLY);
								}
	
								function current(){
								return "<td>".parent::current()."</td>"; 
								}

								function beginChildren(){
									echo "<tr>";
								}

								function endChildern(){
									echo "</tr>";
								}
							}							

							try{
								
								$stmt = $conn->prepare("SELECT OrdenTrabajo, OrdenCompra, testorders.Cliente, Partida, Descripcion, Cantidad,
														FechaSolicitud, Progress, Avance
														FROM testOrders, testPiezas
														WHERE (testpiezas.id)=(testorders.pieza)
														AND Progress <> 'Entregado'
														AND Progress <> 'Facturado'
														AND Progress <> 'Finalizado'
														ORDER BY FechaSolicitud, OrdenTrabajo, Partida");
								$stmt->execute();
		
								//echo '<div class = "alert alert-success"> <strong> CONN </strong> :: Conexion Establecida </div>';
								$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
								foreach(new TableRows (new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v){
									echo $v;
								}
							}
							catch (PDOException $e){
								echo "
								<div class= 'alert alert-danger'><strong>[OH NO, UN DUEÑAS]</strong> :: ".$e->getMessage()."</div>";
							}

						
							?>
						</tbody>
					</table>
				</div>

				</div>
				</div>
				<!--Finish Table-->
				<!--Start Order Queries-->
				<div class="container-fluid" id="consultaorden">
				<h2 class="sub-header">Consulta. Piezas en Proceso</h2>

				  <span class="text-danger"><p><tab>Ingresar en los espacios de texto siguientes el <u>Folio de Orden</u> o la <u>Orden de Compra</u> registrados</p></span><br>
					<form class="form-horizontal" role="form">
						<div class="form-group-row">
							<label for="searchwork" class="col-sm-2 col-form-label">Por Orden de Trabajo</label>
							<div class="col-sm-3">
								<input class="form-control" type="number" placeholder="Ingresar Folio de Orden" onkeyup="showHintWork(this.value)">
							</div>
						</div>
						<div class="form-group-row">
							<label for="searchbuy" class="col-sm-2 col-form-label">Por Orden de Compra</label>
							<div class="col-sm-3">
								<input class="form-control" type="number" placeholder="No incluir prefijos" onkeyup="showHintBuy(this.value)">
							</div>
						</div>
					</form>
				</div>

				<abovepad>
				<div class="container-fluid" id="qresult">
					<p><span id="txtHint"></span></p>
				</div>
				<!--Finish Consultas-->
				<!--Start Query by Client-->
				<div class="container-fluid" id="consultacliente">
					<h2 class="sub-header">Consulta. Pendientes por Cliente</h2>


				</div>

		</div>
	</div>
</div>

</body>
</html>