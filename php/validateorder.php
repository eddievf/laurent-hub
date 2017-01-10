<?php
session_start();
if(!empty($_SESSION['logged'])){


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[PYMAQ] MAQUINADOS - Confirmación Formularios</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="../css/welcome.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="../js/scrollspy.js"></script>
	<script src="../js/getinfo.js"></script>

	<?php
	header("refresh: 3; url= ../forms_maq.php");
	//database connection
    try{
      $servername = "localhost";
      $username = "root";
      $password = "";

      $conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
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
					<li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
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

				date_default_timezone_set("America/Monterrey");
				$echofun = date("Y-m-d H:i:s");


				$servername = "localhost";
				$username = "root";
				$password = "";

				try{
					$conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);

					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$OrdenFolio = $_POST['OrdenFolio'];
					$UserValid = $_POST['UserValid'];
					$FreeDate = $_POST['DateTime'];
					$OrdenTrabajo = $_POST['OrdenTrabajo'];
					$OrdenCompra = $_POST['OrdenCompra'];
					$Validate = $_POST['Validate'];

					if($Validate == 1){
						$stmt = $conn->prepare("UPDATE testorders
												SET OrdenTrabajo = :OrdenTrabajo, OrdenCompra = :OrdenCompra, Validate = :Validate, UserValid = :UserValid, FreedomDate = :FreeDate
												WHERE OrdenTrabajo = :OrdenFolio");
					}

					else{
						$stmt = $conn->prepare("UPDATE testorders
												SET OrdenTrabajo = :OrdenTrabajo, OrdenCompra = :OrdenCompra, Validate = :Validate
												WHERE OrdenTrabajo = :OrdenFolio");
					}

					$stmt->bindParam(':OrdenTrabajo', $OrdenTrabajo);
					$stmt->bindParam(':OrdenCompra', $OrdenCompra);
					$stmt->bindParam(':Validate', $Validate);
					$stmt->bindParam(':OrdenFolio', $OrdenFolio);

					if($Validate == 1){
						$stmt->bindParam(':UserValid', $UserValid);
						$stmt->bindParam(':FreeDate', $FreeDate);

					}
					

				?>
				<div class="panel panel-default" id="success">
					<div class="panel-heading">
						<h3 class="panel-title">Se ha recibido la siguiente información</h3>
					</div>
					<div class="panel-body">
						<ul class="list-group">
				<?php

					echo "<li class='list-group-item'><strong>Orden Registrada</strong>: ".$OrdenTrabajo."</li>";
					echo "<li class='list-group-item'><strong>Orden Compra</strong>: ".$OrdenCompra."</li>";
					echo "<li class='list-group-item'><strong>Estado Actual</strong>: ".$Validate."</li>";
					if($Validate == 1){
						echo "<li class='list-group-item'><strong>Usuario que Libera: </strong>".$UserValid."</li>";
						echo "<li class='list-group-item'><strong>Fecha de Liberacion: </strong>".$FreeDate."</li>";

					}
					echo "<li class='list-group-item'><strong>Orden Folio</strong>: ".$OrdenFolio."</li></ul>
					</div>
				</div>
					";

					$stmt->execute();
					echo "
					<div id= 'successpanel' class= 'panel panel-success'>
						<div class='panel-heading'>
							<h3 class='panel-title'><strong>[SUCCESS]</strong> :: Actualizacion Exitosa</h3>
						</div>
						<div class='panel-body'>
							<p><strong>[PRODUCT]</strong> :: <u>La información del producto ha sido actualizada con la información más reciente</u></p>
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
							</div>
						</div>
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