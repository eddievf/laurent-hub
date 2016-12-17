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


					echo "SELECT ";

					if($OrdenTrabajo == 0){
						echo "";
					}
					else{
						if($OrdenCompra == 0 && $Cliente == 0){
							echo "OrdenTrabajo ";
						}
						else{
							echo "OrdenTrabajo, ";
						}
					}

					if($OrdenCompra == 0){
						echo "";
					}
					else{
						if($Cliente == 0 && $FechaSolicitud == 0){
							echo "OrdenCompra ";
						}
						else{
							echo "OrdenCompra, ";
						}
					}

					if($Cliente == 0){
						echo "";
					}
					else{
						if($FechaSolicitud == 0 && $Partida == 0){
							echo "testorders.Cliente ";
						}
						else{
							echo "testorders.Cliente, ";
						}
					}

					if($FechaSolicitud == 0){
						echo "";
					}
					else{
						if($Partida == 0 && $Pieza == 0){
							echo "FechaSolicitud ";
						}
						else{
							echo "FechaSolicitud, ";
						}
					}

					if($Partida == 0){
						echo "";
					}
					else{
						if($Pieza == 0 && $Cantidad == 0){
							echo "Partida ";
						}
						else{
							echo "Partida, ";
						}
					}

					if($Pieza == 0){
						echo "";
					}
					else{
						if($Cantidad == 0 && $Progress == 0){
							echo "Descripcion ";
						}
						else{
							echo "Descripcion, ";
						}
					}

					if($Cantidad == 0){
						echo "";
					}
					else{
						if($Progress == 0 && $Avance == 0){
							echo "Cantidad ";
						}
						else{
							echo "Cantidad, ";
						}
					}

					if($Progress == 0){
						echo "";
					}
					else{
						if($Avance == 0 && $FechaCompromiso == 0){
							echo "Progress ";
						}
						else{
							echo "Progress, ";
						}
					}

					if($Avance == 0){
						echo "";
					}
					else{
						if($FechaCompromiso == 0 && $FechaReal == 0){
							echo "Avance ";
						}
						else{
							echo "Avance, ";
						}
					}

					if($FechaCompromiso == 0){
						echo "";
					}
					else{
						if($FechaReal == 0 && $Factura = 0){
							echo "FechaCompromiso ";
						}
						else{
							echo "FechaCompromiso, ";
						}
					}

					if($FechaReal == 0){
						echo "";
					}
					else{
						if($Factura == 0){
							echo "FechaReal ";
						}
						else{
							echo "FechaReal,";
						}
					}
					
					if($Factura == 0){
						echo "";
					}
					else{
						echo "Factura";
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