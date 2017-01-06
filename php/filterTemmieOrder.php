<?php
session_start();
if(!empty($_SESSION)){


	$TemmieOrderNumber = $_POST["TemmieOrderNumber"];

	echo '
  	<form action="php/pdfTemmie.php" target="_blank" method="POST" id="pdfRequestTemmie">
			<button type="submit" class="btn btn-primary" name="ReqPDF" id="ReqPDF">
				<span class="glyphicon glyphicon-save-file"></span> Generar Reporte
			</button>
  	<span class= "text-info"><h2>Orden de Compra: <u>'.$TemmieOrderNumber.'</u></h2></span>';

  	ob_start();

	echo '
  
  	<table class="table table-striped table-hover table-bordered table-condensed">
    	<thead>
      		<tr>
        		<th class = "col-md-0">Orden Trabajo</th>
        		<th class = "col-md-0">Orden Compra</th>
        		<th class = "col-md-1">Cliente</th>
        		<th class = "col-md-0">Partida</th>
        		<th class = "col-md-4">Pieza</th>
        		<th class = "col-md-0">Cant.</th>
        		<th class = "col-md-1">Fecha Solicitud</th>
        		<th class = "col-md-1">Avance</th>
        		<th class = "col-md-2">Estado Actual</th>
        		<th class = "col-md-1">Fecha Real</th>
      		</tr>
    	</thead>
    	<tbody> ';
	
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


	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "test";



	try{
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT OrdenTrabajo, OrdenCompra, testorders.Cliente, Partida, Descripcion, Cantidad,
								FechaSolicitud, Avance, Progress, FechaReal
								FROM testOrders, testPiezas
								WHERE (testpiezas.id)=(testorders.pieza)
								AND OrdenCompra = :TemmieOrderNumber
								ORDER BY FechaSolicitud, Partida");

		$stmt->bindParam(':TemmieOrderNumber', $TemmieOrderNumber);
		$stmt->execute();
		

		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		foreach(new TableRows (new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v){
			echo $v;
		}
	}
	catch (PDOException $e){
		echo "
			<div class= 'alert alert-danger'><p class='text-center'><strong>[OH NOES] </strong> :: <u>".$e->getMessage()."</u> :: (error: hOi01 - JD07)</p></div>";
	}

	$conn = null;
	

	echo '
	</tbody>
  </table>
	';

	$html = ob_get_contents();

	echo "<input type='hidden' name='object' value='".$html."' />";
}
else{
	header("location: ../notfound.php");
}

?>