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
	<link href="http://localhost/indevdep/css/welcome.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/scrollspy.js"></script>
	<script src="js/getinfo.js"></script>

	<?php
		date_default_timezone_set("America/Monterrey");
		//header("refresh: 5; url=http://localhost/indevdep/forms_maq.php");

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

					echo "<br>".$UserValid."<br>";
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
						echo "WorkOrder (".$part.") es igual a ".$WorkOrder[$part]." <br>";
						$CantidadTotal[$part] = $row['Cantidad'];
						$CantidadPendiente[$part] = $row['CantPending'];
						$Pieza[$part] = $row['Pieza'];
						$LoggedFactura[$part] = $row['Factura'];
						$FactString[$part] = ''.$LoggedFactura[$part];
						$Progress[$part] = $row['Progress'];
						$PrevAvance[$part] = $row['Avance'];
					}

					for ($i=1; $i <= $part ; $i++) { 
						echo	"<br>Contenido:
							<br>Part = ".$i."
							<br>ID(".$i.") = ".$ID[$i]."
							<br>OrdenTrabajo(".$i.") = ".$WorkOrder[$i]."
							<br>CantidadTotal(".$i.") = ".$CantidadTotal[$i]."
							<br>CantidadPendiente(".$i.") = ".$CantidadPendiente[$i]."
							<br>Pieza(".$i.") = ".$Pieza[$i]."
							<br>Factura(".$i.") = ".$LoggedFactura[$i]."
							<br>End<br>";

						if($CantidadPendiente[$i] != 0 ){

							$postCant = "RealCant".$ID[$i];
							$postFact = "Factura".$ID[$i];
							$postIDOr = "OrdenID".$ID[$i];

							$RealCant[$i] = $_POST[$postCant];
							$Factura[$i] = $_POST[$postFact];
							$OrdenID[$i] = $_POST[$postIDOr];

							echo "<br>VARS<br>
							<br>RealCant(".$i.") = ".$RealCant[$i]."
							<br>Factura(".$i.") = ".$Factura[$i]."
							<br>OrdenID(".$i.") = ".$OrdenID[$i]."
							<br><br> END VARS <br>

							";

							$cantResult[$i] = $CantidadPendiente[$i] - $RealCant[$i];

							if($cantResult[$i] == $CantidadPendiente[$i]){
								echo "Error, Nothing sent to Database as Pendings remain the same. Thank You<br>";
							}

							if($cantResult[$i] < 0){
								echo "Something Happened";
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
								echo "woohoo ".$i."<br>";

								$log->bindParam(':OrdenTrabajo', $WorkOrder[$i]);
								$log->bindParam(':Partida', $i);
								$log->bindParam(':PrevProgress',$Progress[$i]);
								$log->bindParam(':NewProgress', $NewProgress[$i]);
								$log->bindParam(':PrevAvance', $PrevAvance[$i]);
								$log->bindParam(':NewAvance', $PrevAvance[$i]);
								$log->bindParam(':ValidUntil', $DateTime);
								$log->execute();
								echo "hooray ".$i."<br>";
							}
						}

						else{
							echo "<br>No Pending Products<br><br>";
						}

						

						

					}
					


				?>

			</div><!--Main Content until here-->	



		</div>
	</div>

</body>
</html>
<?php
	}
	else{
	header("location: ../notfound.php");
}
?>