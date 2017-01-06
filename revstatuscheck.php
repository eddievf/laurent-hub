<?php
session_start();
if(!empty($_SESSION['logged'])){


?>
<!DOCTYPE html>
<html>
<head>

<style>
abovetab{
    padding-top: 25em;
}
tab1 {
    padding-left: 12em;
}
tab2{
    padding-left: 3em;
}
tab3{
    padding-left: 3.5em;
}
tab4{
    padding-left: 3.2em;
}
</style>
</head>
<body>

<?php
error_reporting(0);
$q = intval($_GET['q']);


$servername = "localhost";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//$sql="SELECT * FROM testorders WHERE id = '".$q."'";
$query = "SELECT testorders.ID, OrdenTrabajo, testorders.Cliente, OrdenCompra, Partida, Descripcion, Cantidad, Avance, Progress
          FROM testpiezas, testorders 
          WHERE (OrdenTrabajo LIKE :ID)
          AND (testpiezas.ID = testorders.Pieza)";

$data = $conn->prepare($query);

$data->bindParam(':ID', $q);
$data->execute();

$queryres = array();

while($row=$data->fetch(PDO::FETCH_ASSOC)) {
        $result=$data;
        $queryres[]=$row;

    }
    $count = count($result);


if ($count > 0) {
    date_default_timezone_set("America/Monterrey");
    $echofun = date("Y-m-d h:i:sa");

     echo "
     <br>
     <div class='container'>
        <div class='panel-group col-sm-10'>
            <div class='panel panel-default'>
                <div class='panel-heading'><h4 class='text-center'><strong>Consulta de Avance</strong></h4></div>
            </div>";

    foreach ($queryres as $value) {
        echo "
            <div class='panel panel-default col-sm-6'>
                <div class='panel-heading'>
                    <strong>Pieza: </strong><u>".$value['Descripcion']."</u>
                </div>
                <div class='panel-body'>
                    <strong>Orden de Trabajo: <u>".$value['OrdenTrabajo']."</u></strong><br><strong>Partida: <u>".$value['Partida']."</u></strong>
                </div>
                    <ul class='list-group'>
                        <li class='list-group-item'><strong>Cantidad:<tab2></strong>".$value['Cantidad']."</li>
                        <li class='list-group-item'><strong>Avance: <tab3></strong>".$value['Avance']."%</li>
                        <li class='list-group-item'><strong>Proceso: <tab4></strong>".$value['Progress']."</li>
                    </ul>
                </div>
        ";
    }
    echo "</div>";
}
else {
    echo "<div class= 'alert alert-danger'><strong>[ERROR] </strong> :: Se ha ingresado una <strong><u>Orden de Trabajo</u></strong> que parece no registrada. Verificar Datos :: (error: JD02)</div>";
}   



$conn = NULL;
?>
</body>
</html>
<?php
}
    else{
    header("location: notfound.php");
}
?>