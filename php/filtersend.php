<?php
	
			/*$servername = "localhost";
			$username = "root";
			$password = "";

					$conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);

					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$stmt = $conn->prepare("INSERT INTO testOrders (OrdenTrabajo, OrdenCompra, Cliente, FechaSolicitud, Partida, 
							Pieza, Cantidad, Progress )
							VALUES (:OrdenTrabajo, :OrdenCompra, :Cliente, :FechaSolicitud, :Partida, :Pieza, :Cantidad, :Progress) "); */

					#SELECT
					echo "--SELECTS** <br>";
					$Orders = $_POST["Orders"];
					echo "Orders - VALUE: ".$Orders."<br>";

					$OrdenTrabajo = $_POST["OrdenTrabajo"];
					echo "OrdenTrabajo - VALUE: ".$OrdenTrabajo."<br>";

					$OrdenCompra = $_POST["OrdenCompra"];
					echo "OrdenCompra - VALUE: ".$OrdenCompra."<br>";

					$Cliente = $_POST["Cliente"];
					echo "Cliente - VALUE: ".$Cliente."<br>";

					$FechaSolicitud = $_POST["FechaSolicitud"];
					echo "FechaSolicitud - VALUE: ".$FechaSolicitud."<br>";

					$Partida = $_POST["Partida"];
					echo "Partida - VALUE: ".$Partida."<br>";

					$Pieza = $_POST["Pieza"];
					echo "Pieza - VALUE: ".$Pieza."<br>";

					$Cantidad = $_POST["Cantidad"];
					echo "Cantidad - VALUE: ".$Cantidad."<br>";

					$Progress = $_POST["Progress"];
					echo "Progress - VALUE: ".$Progress."<br>";

					$Avance = $_POST["Avance"];
					echo "Avance - VALUE: ".$Avance."<br>";

					$FechaCompromiso = $_POST["FechaCompromiso"];
					echo "Fecha Compromiso - VALUE: ".$FechaCompromiso."<br>";

					$FechaReal = $_POST["FechaReal"];
					echo "FechaReal - VALUE: ".$FechaReal."<br>";

					$Factura = $_POST["Factura"];
					echo "Factura - VALUE: ".$Factura."<br><br>";

					echo "--WHERES** <br>";
					$WhereWork = $_POST["WhereWork"];
					echo "<u>WhereWork- VALUE: ".$WhereWork."</u><br>";

					if ($WhereWork == 0){
						echo "";
					}
					else{
						$WhereWorkOrder = $_POST["WhereWorkOrder"];
						echo "<i>WhereWorkOrder - VALUE: ".$WhereWorkOrder."</i><br>";
					}

					$WhereMuns = $_POST["WhereMuns"];
					echo "<u>WhereMuns - VALUE: ".$WhereMuns."</u><br>";
					if ($WhereMuns == 0){
						echo "";
					}
					else{
						$WhereMunsOrder = $_POST["WhereMunsOrder"];
						echo "<i>WhereMunsOrder - VALUE: ".$WhereMunsOrder."</i><br>";
					}

					$WhereClient = $_POST["WhereClient"];
					echo "<u>WhereClient - VALUE: ".$WhereClient."</u><br>";
					if ($WhereClient == 0){
						echo "";
					}
					else{
						$WhereClientName = $_POST["WhereClientName"];
						echo "<i>WhereClientName - VALUE: ".$WhereClientName."</i><br>";
					}

					$WhereAva = $_POST["WhereAva"];
					echo "<u>WhereAva - VALUE: ".$WhereAva."</u><br>";
					if($WhereAva == 0){
						echo "";
					}
					else{
						$WhereAvaIs = $_POST["WhereAvaIs"];
						echo "<i>WhereAvaIs - VALUE: ".$WhereAvaIs."</i><br>";
					}

					#ORDERBY
					echo "<br>--ORDERBYS ** <br>";
					$OrderBy = $_POST["OrderBy"];
					echo "<u>OrderBy - VALUE: ".$OrderBy."<u><br>";
					if ($OrderBy == 0){
						echo "";
					}
					else{
						$ReqDate = $_POST["ReqDate"];
						echo "<i>ReqDate - VALUE: ".$ReqDate."<br>";
						$WorkOrder = $_POST["WorkOrder"];
						echo "<i>WorkOrder - VALUE: ".$WorkOrder."<br>";
						$MunsOrder = $_POST["MunsOrder"];
						echo "<i>MunsOrder - VALUE: ".$MunsOrder."<br>";
					}

?>