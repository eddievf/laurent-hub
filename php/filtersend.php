<?php
	#SELECTS
	$Orders = $_POST["Orders"];
	$OrdenTrabajo = $_POST["OrdenTrabajo"];
	$OrdenCompra = $_POST["OrdenCompra"];
	$Cliente = $_POST["Cliente"];
	$FechaSolicitud = $_POST["FechaSolicitud"];
	$Partida = $_POST["Partida"];
	$Pieza = $_POST["Pieza"];
	$Cantidad = $_POST["Cantidad"];
	$Progress = $_POST["Progress"];
	$Avance = $_POST["Avance"];
	$FechaCompromiso = $_POST["FechaCompromiso"];
	$FechaReal = $_POST["FechaReal"];
	$Factura = $_POST["Factura"];
					
	#WHERES
	$WhereWork = $_POST["WhereWork"];
	$WhereMuns = $_POST["WhereMuns"];
	$WhereClient = $_POST["WhereClient"];
	$WhereProg = $_POST["WhereProg"];
	$WhereNotProg = $_POST["WhereNotProg"];

	#ORDERBY
	$OrderBy = $_POST["OrderBy"];
		$ReqDate = $_POST["ReqDate"];
		$WorkOrder = $_POST["WorkOrder"];
		$MunsOrder = $_POST["MunsOrder"];

	if($OrdenTrabajo == 1){
		$QuerySelect[]="OrdenTrabajo";
	}
					

	if($OrdenCompra == 1){
		$QuerySelect[] = "OrdenCompra";
	}
					

	if($Cliente == 1){
		$QuerySelect[] = "testorders.Cliente";
	}

	if($Partida == 1){
		$QuerySelect[] = "Partida";
	}

	if($Pieza == 1){
		$QuerySelect[] = "Descripcion";
	}

	if($Cantidad == 1){
		$QuerySelect[] = "Cantidad";
	}

	if($FechaSolicitud == 1){
		$QuerySelect[] = "FechaSolicitud";
	}
			
	if($Progress == 1){
		$QuerySelect[] = "Progress";
	}
					

	if($Avance == 1){
		$QuerySelect[] = "Avance";
	}

	if($FechaCompromiso == 1){
		$QuerySelect[] = "FechaCompromiso";
	}

	if($FechaReal == 1){
		$QuerySelect[] = "FechaReal";
	}
					
	if($Factura == 1){
		$QuerySelect[] = "Factura";
	}

	$selectcount = count($QuerySelect);

	$query_string= "SELECT ";

	if($selectcount>0){
		for ($i=0; $i < $selectcount-1; $i++) { 
			$query_string .= $QuerySelect[$i].", ";
		}
		$query_string .= $QuerySelect[($selectcount-1)];
	}

	$query_string .= " FROM testorders, testpiezas WHERE (testpiezas.ID = testorders.Pieza) ";
					
	if ($WhereWork == 0){
		$query_string .= "";
	}
	else{
		$WhereWorkOrder = $_POST["WhereWorkOrder"];
		$query_string .= "AND OrdenTrabajo = ".$WhereWorkOrder." ";
	}

					
	if ($WhereMuns == 0){
		$query_string .= "";
	}
	else{
		$WhereMunsOrder = $_POST["WhereMunsOrder"];
		$query_string .= "AND OrdenCompra = ".$WhereMunsOrder." ";
	}

	if ($WhereClient == 0){
		$query_string .= "";
	}
	else{
		$WhereClientName = $_POST["WhereClientName"];
		$query_string .= "AND testorders.Cliente LIKE '%".$WhereClientName."%' ";
	}

	if($WhereProg == 0){
		$query_string .= "";
	}
	else{
		$WhereProgIs = $_POST["WhereProgIs"];
		$query_string .= "AND Progress LIKE '%".$WhereProgIs."%'  ";
	}

	if($WhereNotProg == 0){
		$query_string .= "";
	}
	else{
		$WhereProgIsNot = $_POST["WhereProgIsNot"];
		$query_string .= "AND Progress NOT LIKE '%".$WhereProgIsNot."%'  ";
	}

	//END WHERE IFS

					
	if ($OrderBy == 0){
		$query_string .= "ORDER BY OrdenTrabajo, Partida";
	}
	else{
		$query_string .= "ORDER BY ";
						
		if($ReqDate == 0){
			$query_string .= "";
		}
		else{
			if($WorkOrder == 0 && $MunsOrder == 0){
				$query_string .= "FechaSolicitud ";
			}
			else{
				$query_string .= "FechaSolicitud, ";
			}
		}
						
		if($WorkOrder == 0){
			$query_string .= "";
		}
		else{
			if($MunsOrder == 0){
				$query_string .= "OrdenTrabajo";
			}
			else{
				$query_string .= "OrdenTrabajo, ";
			}
		}
						
		if ($MunsOrder == 0){
			$query_string .= "";
		}
		else{
			$query_string .= "OrdenCompra";
		}
		$query_string .= ", Partida";
	}

	echo '
		<form action="php/filterPDF.php" method="POST" id="pdfRequestForm">
			<button type="submit" class="btn btn-primary" name="ReqPDF" id="ReqPDF">
				<span class="glyphicon glyphicon-save-file"></span> Generar Reporte
			</button>
			
	';
	ob_start();


	echo '
		<h2>ORDENES EN PROGRESO</h2>
		<table class="table table-striped table-hover table-bordered table-condensed">
    		<thead>
      			<tr>';
        			if ($OrdenTrabajo == 1){
        				echo '<th class = "col-md-1">Orden Trabajo</th>';
        			}
        			if ($OrdenCompra == 1){
        				echo '<th class = "col-md-1">Orden Compra</th>';
        			}
        			if ($Cliente == 1){
        				echo '<th class = "col-md-1">Cliente</th>';
        			}
        			if ($Partida == 1){
        				echo '<th class = "col-md-1">Partida</th>';
        			}
        			if ($Pieza == 1){
        				echo '<th class = "col-md-4">Pieza</th>';
        			}
        			if ($Cantidad == 1){
        				echo '<th class = "col-md-1">Cant.</th>';
        			}
        			if ($FechaSolicitud == 1){
        				echo '<th class = "col-md-1">Fecha Solicitud</th>';
        			}
        			if ($Avance == 1){
        				echo '<th class = "col-md-2">Estado Actual</th>';
        			}
        			if ($Progress == 1){
        				echo '<th class = "col-md-1">Avance</th>';
        			}
        			if ($FechaCompromiso == 1){
        				echo '<th class = "col-md-1">Fecha Estimada</th>';
        			}
        			if ($FechaReal == 1){
        				echo '<th class = "col-md-1">Fecha Entrega</th>';
        			}
        			if ($Factura == 1){
        				echo '<th class = "col-md-1">Factura</th>';
        			}
   		echo 	'</tr>
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
		$stmt = $conn->prepare($query_string);

		$stmt->execute();

		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		foreach(new TableRows (new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v){
			echo $v;
		}
	}
	catch (PDOException $e){
		echo "
			<div class= 'alert alert-danger'><p class='text-center'><strong>[ERROR] </strong> :: <u>".$e->getMessage()."</u> :: (error: JD07)</p></div>";
	}

	$conn = null;
	

	echo '
	</tbody>
  </table> ';

  $html = ob_get_contents();

  echo "<input type='hidden' name='object' value='".$html."'/>";

	
?>