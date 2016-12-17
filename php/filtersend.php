<?php
					

					echo "--START** <br>";
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
					$WhereAva = $_POST["WhereAva"];

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
					

					if($FechaSolicitud == 1){
						$QuerySelect[] = "FechaSolicitud";
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

					print_r($QuerySelect);

					echo "WOW, array count is --> ".$selectcount."<br>";

					if($selectcount>0){

						echo "SELECT ";
						for ($i=0; $i < $selectcount-1; $i++) { 
							echo $QuerySelect[$i].", ";
						}

						echo $QuerySelect[($selectcount-1)];
					}

					
					//END SELECT IFS

					echo "<br>FROM testorders, testpiezas <br> WHERE (testpiezas.ID = testorders.Pieza) <br>";
					
					if ($WhereWork == 0){
						echo "";
					}
					else{
						$WhereWorkOrder = $_POST["WhereWorkOrder"];
						echo "AND OrdenTrabajo = ".$WhereWorkOrder."<br>";
					}

					
					if ($WhereMuns == 0){
						echo "";
					}
					else{
						$WhereMunsOrder = $_POST["WhereMunsOrder"];
						echo "AND OrdenCompra = ".$WhereMunsOrder."<br>";
					}

					if ($WhereClient == 0){
						echo "";
					}
					else{
						$WhereClientName = $_POST["WhereClientName"];
						echo "AND testorders.Cliente LIKE '%".$WhereClientName."%' <br>";
					}

					if($WhereAva == 0){
						echo "";
					}
					else{
						$WhereAvaIs = $_POST["WhereAvaIs"];
						echo "AND Avance = ".$Avance."<br>";
					}

					//END WHERE IFS

					
					if ($OrderBy == 0){
						echo "ORDER BY OrdenTrabajo, Partida";
					}
					else{
						echo "ORDER BY ";
						
						if($ReqDate == 0){
							echo "";
						}
						else{
							if($WorkOrder == 0 && $MunsOrder == 0){
								echo "FechaSolicitud ";
							}
							else{
								echo "FechaSolicitud, ";
							}
						}
						
						if($WorkOrder == 0){
							echo "";
						}
						else{
							if($MunsOrder == 0){
								echo "OrdenTrabajo";
							}
							else{
								echo "OrdenTrabajo, ";
							}
						}
						
						if ($MunsOrder == 0){
							echo "";
						}
						else{
							echo "OrdenCompra";
						}

						echo ", Partida";
					}

?>