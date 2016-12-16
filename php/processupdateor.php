<html>

<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[PYMAQ] MAQUINADOS - Formularios</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="css/welcome.css" rel="stylesheet">
	<link href="css/circle.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>

<body>

TRANSFERENCIA UPDATE ORDERS <br>

<?php

date_default_timezone_set("America/Monterrey");
$echofun = date("Y-m-d h:i:sa");


$servername = "localhost";
$username = "root";
$password = "";

try{
	$conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "Connected Succesfully <br>";

	$stmt = $conn->prepare("UPDATE testorders
							SET Progress = :UpdateProgress, Avance = :UpdateAvance
							WHERE ID = :recordID");

	$log = $conn->prepare(" INSERT INTO testlog (WorkOrder, WorkDiv, PrevProgress, NewProgress, PrevAvance, 
							NewAvance,ValidUntil )
							VALUES (:OrdenTrabajo, :Partida, :PrevProgress, :NewProgress, :PrevAvance,
							:NewAvance, :ValidUntil) ");

	$recordID = $_POST['recordID'];
	$OrdenTrabajo = $_POST['OrdenTrabajo'];
	$Partida = $_POST['Partida'];
	$PrevProgress = $_POST['PrevProgress'];
	$PrevAvance = $_POST['PrevAvance'];
	$NewProgress = $_POST['NewProgress'];
	$NewAvance = $_POST['NewAvance'];

	$log->bindParam(':OrdenTrabajo', $OrdenTrabajo);
	$log->bindParam(':Partida', $Partida);
	$log->bindParam(':PrevProgress',$PrevProgress);
	$log->bindParam(':NewProgress', $NewProgress);
	$log->bindParam(':PrevAvance', $PrevAvance);
	$log->bindParam(':NewAvance', $NewAvance);
	$log->bindParam(':ValidUntil', $echofun);
	$log->execute();
	echo "Successful Creation of LOG Records<br>";



	$stmt->bindParam(':UpdateProgress', $NewProgress);
	$stmt->bindParam(':UpdateAvance', $NewAvance);
	$stmt->bindParam(':recordID', $recordID);
	$stmt->execute();
	echo "Successful UPDATE of Records<br>";

	
}

catch (PDOException $e){
	echo "[OH NO, UN DUEÑAS]".$e->getMessage()."<br>";
}

$conn = null;

?>

<a href="http://localhost/indevdep/welcome_rev.php">Confirm Orders ->YAY<- </a><br>

<a href="http://localhost/indevdep/forms_maq.php">Return to Update page </a>


</body>
</html>