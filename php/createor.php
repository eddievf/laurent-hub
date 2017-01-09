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
		header("refresh: 5; url=http://localhost/indevdep/forms_maq.php");

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
					<li><a href="#successpanel">Actualizado</a></li>
					<li><a href="#dangerpanel">Error</a></li>
			</div>
			<!--end sidebar-->
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<!--Main Content-->	

			<?php

				try{

					$OrdenTrabajo = $_POST["OrdenTrabajo"];
					$OrdenCompra = $_POST["OrdenCompra"];
					$Cliente = $_POST["ClienteSel"];
					$FechaSolicitud = $_POST["FechaSolicitud"];
					$Partida = $_POST["Partida"];
					$Pieza = $_POST["PiezaSel"];
					$Cantidad = $_POST["Cantidad"];
					$Registry = $_POST["Registry"];
					$Prioridad = $_POST["Prioridad"];

					$val = $conn->prepare("SELECT ID, Filepath FROM testpiezas WHERE ID = :ID");

					$val->bindParam(':ID', $Pieza);

					$val->execute();

					while($row = $val->fetch(PDO::FETCH_ASSOC)){
						$Dibujo = $row['Filepath'];
					}

					if(!empty($Dibujo)){
						$Validate = 2;
					}
					else{
						$Validate = 3;
					}

					$stmt = $conn->prepare("INSERT INTO testOrders (OrdenTrabajo, OrdenCompra, Cliente, FechaSolicitud, Partida, 
							Pieza, Cantidad, CantPending, Progress, Prioridad, Validate )
							VALUES (:OrdenTrabajo, :OrdenCompra, :Cliente, :FechaSolicitud, :Partida, :Pieza, :Cantidad, :CantPending, :Progress, :Prioridad, :Validate) ");

				?>
				<div class="panel panel-default" id="success">
					<div class="panel-heading">
						<h3 class="panel-title">Se ha recibido la siguiente información</h3>
					</div>
					<div class="panel-body">
						<ul class="list-group">
				<?php

					echo "<li class='list-group-item'><strong>Orden Trabajo</strong>: ".$OrdenTrabajo."</li>";
					echo "<li class='list-group-item'><strong>Orden Compra</strong>: ".$OrdenCompra."</li>";
					echo "<li class='list-group-item'><strong>Cliente</strong>: ".$Cliente."</li>";
					echo "<li class='list-group-item'><strong>Fecha Solicitud</strong>: ".$FechaSolicitud."</li>";
					echo "<li class='list-group-item'><strong>Partida</strong>: ".$Partida."</li>";
					echo "<li class='list-group-item'><strong>Pieza</strong>:  ".$Pieza."</li>";
					echo "<li class='list-group-item'><strong>Cantidad</strong>: ".$Cantidad."</li>";
					echo "<li class='list-group-item'><strong>Registry</strong>: ".$Registry."</li></ul>";

					$stmt->bindParam(':OrdenTrabajo',$OrdenTrabajo);
					$stmt->bindParam(':OrdenCompra', $OrdenCompra);
					$stmt->bindParam(':Cliente', $Cliente);
					$stmt->bindParam(':FechaSolicitud', $FechaSolicitud);
					$stmt->bindParam(':Partida', $Partida);
					$stmt->bindParam(':Pieza', $Pieza);
					$stmt->bindParam(':Cantidad', $Cantidad);
					$stmt->bindParam(':CantPending', $Cantidad);
					$stmt->bindParam(':Progress', $Registry);
					$stmt->bindParam(':Prioridad', $Prioridad);
					$stmt->bindParam(':Validate', $Validate);
					$stmt->execute();
					echo "
					<div id= 'successpanel' class= 'panel panel-success'>
						<div class='panel-heading'>
							<h3 class='panel-title'><strong>[SUCCESS]</strong> :: Actualizacion Exitosa</h3>
						</div>
						<div class='panel-body'>
							<p><strong>[ORDER DB]</strong> :: <u>La base de datos ha recibido la información</u></p>
						</div>
					</div>";
					
				}

				catch (PDOException $e){
					echo "
						<div id='dangerpanel' class='panel panel-danger'>
							<div class= 'panel-heading'>
								<h3 class='panel-title'><strong>[ERROR]</strong> :: Actualizacion no completada</h3>
							</div>
							<div class= 'panel-body'>
								<p><strong><span class='text-danger'>[JD04]</span></strong> :: <u>:".$e->getMessage()."</u><br>
								<span class= 'text-danger'>Verificar la conexión a la base de datos y que <u>todos</u> los campos hayan sido actualizados.</span></p>
						";				
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