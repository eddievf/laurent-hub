<?php
session_start();
if(!empty($_SESSION['logged']))
{

	#SELECTS
	$OrdenTrabajo = $_POST["OrdenTrabajo"];
	$OrdenCompra = $_POST["OrdenCompra"];
	$Cliente = $_POST["Cliente"];
	$FechaSolicitud = $_POST["FechaSolicitud"];
	$Partida = $_POST["Partida"];
	$Pieza = $_POST["Pieza"];
	$Cantidad = $_POST["Cantidad"];
	$CantPending = $_POST["CantPending"];
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
	$WhereNotProg2 = $_POST["WhereNotProg2"];

	#DATES
	$BetweenReqDate = $_POST["BetweenReqDate"];
	$BetweenCompDate = $_POST["BetweenCompDate"];
	$BetweenRealDate =$_POST["BetweenRealDate"];

	#ORDERBY
	$OrderBy = $_POST["OrderBy"];
		$ReqDateDESC = $_POST["ReqDateDESC"];
		$ReqDate = $_POST["ReqDate"];
		$CompDateDESC = $_POST["CompDateDESC"];
		$CompDate = $_POST["CompDate"];
		$RealDateDESC = $_POST["RealDateDESC"];
		$RealDate = $_POST["RealDate"];
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

	if($CantPending == 1){
		$QuerySelect[] = "CantPending";
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

	//WHERE-IFS
					
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
	if($WhereNotProg2 == 0){
		$query_string .= "";
	}
	else{
		$WhereProg2IsNot = $_POST["WhereProg2IsNot"];
		$query_string .= "AND Progress NOT LIKE '%".$WhereProg2IsNot."%'  ";
	}

	//END WHERE IFS

	//DATES
	if($BetweenReqDate == 1){
		$BetweenDateA = $_POST["myDateA"];
		$BetweenDateB = $_POST["myDateB"];

		if($BetweenDateB > $BetweenDateA){
			$query_string .= "AND (FechaSolicitud BETWEEN '".$BetweenDateA."' AND '".$BetweenDateB."') ";
		}
		else{
			echo "
			<div class= 'alert alert-danger'><p class='text-center'><strong>[ERROR] </strong> :: <u>Fecha Final es Posterior a Fecha Inicio</u> :: (error: JD08)</p></div>";
		}
 	}

 	if($BetweenCompDate == 1){
		$BetweenDateA = $_POST["myDateA"];
		$BetweenDateB = $_POST["myDateB"];

		if($BetweenDateB > $BetweenDateA){
			$query_string .= "AND (FechaCompromiso BETWEEN '".$BetweenDateA."' AND '".$BetweenDateB."') ";
		}
		else{
			echo "
			<div class= 'alert alert-danger'><p class='text-center'><strong>[ERROR] </strong> :: <u>Fecha Final es Posterior a Fecha Inicio</u> :: (error: JD08)</p></div>";
		}
 	}

 	if($BetweenRealDate == 1){
		$BetweenDateA = $_POST["myDateA"];
		$BetweenDateB = $_POST["myDateB"];

		if($BetweenDateB > $BetweenDateA){
			$query_string .= "AND (FechaReal BETWEEN '".$BetweenDateA."' AND '".$BetweenDateB."') ";
		}
		else{
			echo "
			<div class= 'alert alert-danger'><p class='text-center'><strong>[ERROR] </strong> :: <u>Fecha Final es Posterior a Fecha Inicio</u> :: (error: JD08)</p></div>";
		}
 	}
 	//END DATES
					
	if ($OrderBy == 0){
		$query_string .= "ORDER BY OrdenTrabajo, Partida";
	}
	else{

		$query_string .= "ORDER BY ";
						
		if($ReqDate == 1){
			$QueryOrder[] = "FechaSolicitud";
		}

		if($ReqDateDESC == 1){
			$QueryOrder[] = "FechaSolicitud DESC";
		}

		if($CompDateDESC == 1){
			$QueryOrder[] = "FechaCompromiso DESC";
		}

		if($CompDate == 1){
			$QueryOrder[] = "FechaCompromiso";
		}

		if($RealDateDESC == 1){
			$QueryOrder[] = "FechaReal DESC";
		}

		if($RealDate == 1){
			$QueryOrder[] = "FechaReal";
		}
						
		if($WorkOrder == 1){
			$QueryOrder[] = "OrdenTrabajo";
		}
		
						
		if ($MunsOrder == 1){
			$QueryOrder[] = "OrdenCompra";
		}

		$orderbycount = count($QueryOrder);

		if($orderbycount>0){
		for ($i=0; $i < $orderbycount; $i++) { 
			$query_string .= $QueryOrder[$i].", ";
		}
		$query_string .= " Partida";
		}
	}

	//echo $query_string;

	echo '
		<form action="php/pdfFilter.php" target="_blank" method="POST" id="pdfRequestForm">
			<button type="submit" class="btn btn-primary" name="ReqPDF" id="ReqPDF">
				<span class="glyphicon glyphicon-save-file"></span> Generar Reporte
			</button>
		<span class="text-info"><h2>Consulta Personalizada</h2></span>
	';
	ob_start();


	echo '
		
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
        			if ($CantPending == 1){
        				echo '<th class = "col-md-1">Cant. Pendiente</th>';
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
        				echo '<th class = "col-md-1">Fecha Programada</th>';
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


}
else{
	header("location: ../notfound.php");
}

	
?>