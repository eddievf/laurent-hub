<?php
session_start();
if(!empty($_SESSION['logged'])){
  error_reporting(0);

	$KEY = $_GET['file'];

	$servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$query = "SELECT Filepath FROM testpiezas WHERE (ProdKey = :key)";

    $data = $conn->prepare($query);

		$data->bindParam(':key', $KEY);
		$data->execute();

    while($row=$data->fetch(PDO::FETCH_ASSOC)) {
   		$file = $row['Filepath'];
   	}

   	if($file == NULL){
   		exit ("<a href = '../forms_maq.php'>Regrese a la Pantalla Anterior</a> ");
   	}
	
    $pathinfo = pathinfo($file);
    $filename = $pathinfo['basename'];
    $tmp = explode('.',$file);
    header('content-type:application/'.end($tmp));
    Header("Content-Disposition: attachment; filename=".$filename); //to set download filename
    exit(file_get_contents($file));

}
else{
  header("location: ../notfound.php");
}