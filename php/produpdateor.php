<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[PYMAQ] MAQUINADOS - Confirmación Formularios</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="http://localhost/indevdep/css/welcome.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/scrollspy.js"></script>
	<script src="js/getinfo.js"></script>
	<!--bootstrap select-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>


	<?php
	header("refresh: 3; url= http://localhost/indevdep/forms_maq.php");
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

				function SomethingHappened($filerror){
					echo "<div id='dangerpanel' class='panel panel-danger'>
							<div class= 'panel-heading'>
								<h3 class='panel-title'><strong>[ERROR]</strong> :: Upload FAILED with error ".$_FILES['userfile']['error']."<br></h3>
							</div>
							<div class= 'panel-body'>
								<p><strong><span class='text-danger'>[FILE ERROR]</span></strong> ::";

								switch ($filerror) {
									case '1':
									case '2':
										echo "Verificar el tamaño del Archivo. Si el Archivo que se desea cargar excede 3MB, comunicarse con el Webmaster.<br>:ERROR: [JD FILE-".$filerror."]";
										break;

									case '3':
										echo ":ERROR: [JD FILE-".$filerror."] - El archivo solo ha sido cargado parcialmente. Por favor, intente nuevamente<br>Si el error persiste, verificar la conexión a internet o comunicarse con el Webmaster.";
										break;

									case '6':
									case '7':
									case '8':
										echo ":ERROR: [JD FILE-".$filerror."] - Ha sucedido un error en la carga del archivo. Por favor, intente nuevamente<br>Si el error persiste, verificar la conexión a internet o comunicarse con el Webmaster.";
										break;
									default:
										echo ":ERROR: [JD FILE-SHEET] -  <U>Algo Pasó</u>. El Archivo no ha emitido un Código de Error. Por favor, intente nuevamente<br>Si el error persiste, verificar la conexión a internet o comunicarse con el Webmaster para verificar el problema.";
										break;
								}

								echo "<br>
								<span class= 'text-danger'>Verificar la conexión a la base de datos y que <u>todos</u> los campos hayan sido actualizados.</span></p>
							</div>
						</div>";	
				}

				date_default_timezone_set("America/Monterrey");
				$echofun = date("Y-m-d H:i:s");


				$servername = "localhost";
				$username = "root";
				$password = "";

				try{
					$conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);

					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					print_r($_FILES);

					$target_path = "C:/Users/Maggie/Documents/upload/";
					$target_path = $target_path . basename( $_FILES['userfile']['name']);

					if($_FILES['userfile']['error'] != 0 ){
						if($_FILES['userfile']['error'] != 4){

							die( SomethingHappened($_FILES['userfile']['error']) );
						}
					}

					if($_FILES['userfile']['error'] == 0){
						$stmt = $conn->prepare("UPDATE testpiezas
												SET Descripcion = :Descripcion, Cliente = :Cliente, CodigoProducto = :ProdCode, Filepath = :Filepath, Departamento = :Departamento 
												WHERE ProdKey = :KEY");
					}

					else{
						$stmt = $conn->prepare("UPDATE testpiezas
												SET Descripcion = :Descripcion, Cliente = :Cliente, CodigoProducto = :ProdCode, Departamento = :Departamento 
												WHERE ProdKey = :KEY");
					}

					$stmt->bindParam(':Descripcion', $Descripcion);
					$stmt->bindParam(':KEY', $ProdKey);
					$stmt->bindParam(':Cliente', $Cliente);
					$stmt->bindParam(':ProdCode', $ProdCode);
					$stmt->bindParam(':Departamento', $Departamento);

					if($_FILES['userfile']['error'] != 4){
						$finfo = finfo_open(FILEINFO_MIME_TYPE);
						$mime = finfo_file($finfo, $_FILES['userfile']['tmp_name']);
						echo $mime;
						finfo_close($finfo);

						switch($mime){
							case 'application/pdf':
								echo " - File Supported OK<br>";
								break;
							default:
								die("Not Supported File Format = ".$mime."<br>");
						}
						
						if(move_uploaded_file($_FILES['userfile']['tmp_name'], $target_path)) {
    					//echo "The file ".  basename( $_FILES['userfile']['name'])." has been uploaded<br>";
    					$stmt->bindParam(':Filepath', $target_path);
    					}

						else{
    						echo "There was an error uploading the file<br>";
						}
					}
					
					$ProdKey = $_POST['ProdKey'];
					$Descripcion = $_POST['Descripcion'];
					$Cliente = $_POST['Cliente'];
					$ProdCode = $_POST['ProdCode'];
					$Departamento = $_POST['Departamento'];


				?>
				<div class="panel panel-default" id="success">
					<div class="panel-heading">
						<h3 class="panel-title">Se ha recibido la siguiente información</h3>
					</div>
					<div class="panel-body">
						<ul class="list-group">
				<?php

					echo "<li class='list-group-item'><strong>Descripcion</strong>: ".$Descripcion."</li>";
					echo "<li class='list-group-item'><strong>Cliente</strong>: ".$Cliente."</li>";

					if($_FILES['userfile']['error'] != 4 ){
						echo "<li class = 'list-group-item'><strong>Archivo de Diseño</strong> (si aplica): The file ".basename( $_FILES['userfile']['name'])." fue cargado</li>"; 
						
					}
					
					echo "<li class='list-group-item'><strong>Codigo de Pieza</strong>: ".$ProdCode."</li>";
					echo "<li class='list-group-item'><strong>Departamento</strong>: ".$Departamento."</li></ul>
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