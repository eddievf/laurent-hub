<?php
session_start();
if(!empty($_SESSION['logged'])){


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="widht device-width, initial-scale=1">
	<title>[PYMAQ] MAQUINADOS - Confirmar Formularios</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="../css/welcome.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="../js/scrollspy.js"></script>
	<script src="../js/getinfo.js"></script>

	<?php
		date_default_timezone_set("America/Monterrey");
		//header("refresh: 13; url=http://localhost/indevdep/forms_maq.php");

		try{
			$servername = "localhost";
			$username = "root";
			$password = "";

			$conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
      		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			echo "
				<div class= 'alert alert-danger'><p class='text-center'><strong>[ERROR] </strong> :: <u>".$e->getMessage()."</u> :: (error: JD01)</p></div>
				";
		}
	?>

</head>
<body>
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
					<li><a href="../welcome_rev.php">Inicio</a></li>
					<li><a href="../forms_maq.php">Formularios</a></li>
					<li><a href="../filter_maq.php">Reportes</a></li>
					<li class="dropdown">
              			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Departamentos <span class="caret"></span></a>
              			<ul class="dropdown-menu">
                			<li><a href="../welcome_rev.php">Maquinados</a></li>
                			<li><a href="#">Almacen</a></li>
                			<li><a href="#">Troquelado</a></li>
                			<li role="separator" class="divider"></li>
                			<li><a href="#">Almacen</a></li>
                			<li><a href="#">Embarque</a></li>
              			</ul>
					</li>
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
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
					<li><a href="#infopanel">Información</a></li>
					<li><a href="#successpanel">Actualizado</a></li>
					<li><a href="#dangerpanel">Error</a></li>
			</div>
			<!--end sidebar-->
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<!--Main Content-->	

			<?php
				/*GettingVariables*/
					$OrdenCompra = $_POST['OrdenCompra'];
					$UserValid = $_POST['UserValid'];
					$DateTime = $_POST['DateTime'];
					$OrdenTrabajo = $_POST['OrdenTrabajo'];
					$Cliente = $_POST['Cliente'];

					$val = $conn->prepare("SELECT ID, OrdenTrabajo, Partida, Cantidad, CantPending, Pieza, Factura, Progress, Avance
										   FROM testorders
										   WHERE OrdenTrabajo = :order");

					$stmt = $conn->prepare("UPDATE testorders
											SET CantPending = :cantpending , Factura = :factura, Partial = :partial, Progress = :progress
											WHERE ID = :OrdenID");

					$log = $conn->prepare(" INSERT INTO testlog (WorkOrder, WorkDiv, PrevProgress, NewProgress, PrevAvance, 
											NewAvance,ValidUntil )
											VALUES (:OrdenTrabajo, :Partida, :PrevProgress, :NewProgress, :PrevAvance,
											:NewAvance, :ValidUntil) ");

					$val->bindParam(':order', $OrdenTrabajo);
					$val->execute();

					while($row = $val->fetch(PDO::FETCH_ASSOC)){
						$part = $row['Partida'];
						$ID[$part] = $row['ID'];
						$WorkOrder[$part] = $row['OrdenTrabajo'];
						$CantidadTotal[$part] = $row['Cantidad'];
						$CantidadPendiente[$part] = $row['CantPending'];
						$Pieza[$part] = $row['Pieza'];
						$LoggedFactura[$part] = $row['Factura'];
						$FactString[$part] = ''.$LoggedFactura[$part];
						$Progress[$part] = $row['Progress'];
						$PrevAvance[$part] = $row['Avance'];
					}

			?>

			<?php
				echo "<div id='infopanel'></div>";

				for ($i=1; $i <= $part ; $i++) { 

					if($CantidadPendiente[$i] != 0 ){
						echo "<div class='panel panel-default' id='success'>
								<div class='panel-heading'>
									<h3 class='panel-title'>Información de Partida [".$i."]</h3>
								</div>
								<div class='panel-body'>
									<ul class='list-group'>";

						$postCant = "RealCant".$ID[$i];
						$postFact = "Factura".$ID[$i];
						$postIDOr = "OrdenID".$ID[$i];

						$RealCant[$i] = $_POST[$postCant];
						$Factura[$i] = $_POST[$postFact];
						$OrdenID[$i] = $_POST[$postIDOr];

						echo "<li class='list-group-item'><strong>Cantidad Facturada</strong>:  ".$RealCant[$i]."</li>";
						echo "<li class='list-group-item'><strong>Folio de Factura</strong>: ".$Factura[$i]."</li>";
						echo "<li class='list-group-item'><strong>Orden de Trabajo</strong>: ".$WorkOrder[$i]."</li>
									</ul>
								</div>
							  </div>";

						$cantResult[$i] = $CantidadPendiente[$i] - $RealCant[$i];

						if($cantResult[$i] == $CantidadPendiente[$i]){
							echo "
							<div id='warningpanel' class='panel panel-warning'>
								<div class= 'panel-heading'>
									<h3 class='panel-title'><strong>[Alert]</strong> :: Sin información para actualizar</h3>
								</div>
								<div class= 'panel-body'>
									<p><strong><span class='text-warning'>[JD12-1]</span></strong> :: <u>Cantidad Pendiente sin cambios</u><br>
									No se han indicado piezas a facturar. La Partida no será actualizada.</p>
								</div>
							</div>
							";
						}

						if($cantResult[$i] < 0){
							echo "
								<div id='dangerpanel' class='panel panel-danger'>
									<div class= 'panel-heading'>
										<h3 class='panel-title'><strong>[ERROR]</strong> :: Actualizacion no completada</h3>
									</div>
									<div class= 'panel-body'>
										<p><strong><span class='text-danger'>[JD12-2]</span></strong> :: <u>Cantidad Pendiente resulta menor a 0</u><br>
										<span class= 'text-danger'>La cantidad de piezas a facturar supera la cantidad de Pendientes registrados.<br>
										Vuelva al formulario y reingrese la información correctamente.</span></p>
									</div>
								</div>
								";
							exit();

						}

						else{

							if($cantResult[$i] == 0){
								$NewProgress[$i] = "Facturacion - ".$Factura[$i].". (Final)";
									$PartialState[$i] = 1;
							}
							else{
								$NewProgress[$i] = "Facturacion - ".$Factura[$i].". (Parcial)";
								$PartialState[$i] = 0;
							}


							if($LoggedFactura[$i] == 0){
								$FactString[$i] = $Factura[$i];
							}
							else{
								$FactString[$i] .= ", ".$Factura[$i];
							}


							$stmt->bindParam(':cantpending', $cantResult[$i]);

							if($cantResult[$i] == $CantidadPendiente[$i]){
								$FactString[$i] = $LoggedFactura[$i];
								$NewProgress[$i] = $Progress[$i];
							}

							$stmt->bindParam(':factura', $FactString[$i]);
							$stmt->bindParam(':partial', $PartialState[$i]);
							$stmt->bindParam(':progress', $NewProgress[$i]);
							$stmt->bindParam(':OrdenID', $OrdenID[$i]);
							$stmt->execute();
							echo "
								<div id= 'successpanel' class= 'panel panel-success'>
									<div class='panel-heading'>
										<h3 class='panel-title'><strong>[SUCCESS]</strong> :: Actualizacion Exitosa</h3>
									</div>
									<div class='panel-body'>
										<p><strong>[PRODUCT]</strong> :: <u>La partida (".$WorkOrder[$i]." - ".$i.") ha sido actualizada con la información más reciente</u></p><br>
										<p><strong>[LOG]</strong> :: <u>La información del Proceso ha sido registrada</u></p>
									</div>
								</div>
								<hr style='color: black; height: 1px; background-color:black;' />
							";

							$log->bindParam(':OrdenTrabajo', $WorkOrder[$i]);
							$log->bindParam(':Partida', $i);
							$log->bindParam(':PrevProgress',$Progress[$i]);
							$log->bindParam(':NewProgress', $NewProgress[$i]);
							$log->bindParam(':PrevAvance', $PrevAvance[$i]);
							$log->bindParam(':NewAvance', $PrevAvance[$i]);
							$log->bindParam(':ValidUntil', $DateTime);
							$log->execute();
						}
					}
				}
			?>

<?php
	}
	else{
	header("location: ../notfound.php");
}
?>