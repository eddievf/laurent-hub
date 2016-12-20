

<?php
echo '

  <h2>ORDENES EN PROGRESO</h2>
  
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
		$stmt = $conn->prepare("SELECT OrdenTrabajo, OrdenCompra, testorders.Cliente, Partida, Descripcion, Cantidad, FechaSolicitud, Avance, Progress, FechaReal
								FROM testOrders, testPiezas
								WHERE (testpiezas.id)=(testorders.pieza)
								AND YEAR(FechaReal) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
								AND MONTH(FechaReal) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
								ORDER BY FechaReal, OrdenTrabajo, Partida");


		$stmt->execute();
		

		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		foreach(new TableRows (new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v){
			echo $v;
		}
	}
	catch (PDOException $e){
		echo "[OH NO, UN DUEÑAS]".$e->getMessage();
	}

	$conn = null;
	

	echo '
	</tbody>
  </table>
';

?>