<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
$q = intval($_GET['q']);


$servername = "localhost";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//$sql="SELECT * FROM testorders WHERE id = '".$q."'";
$query = "SELECT testorders.ID, OrdenTrabajo, Partida, Descripcion, Avance, Progress
          FROM testpiezas, testorders 
          WHERE (testorders.ID = :ID)
          AND (testpiezas.ID = testorders.Pieza)";

$data = $conn->prepare($query);

$data->bindParam(':ID', $q);
$data->execute();

date_default_timezone_set("America/Monterrey");
$echofun = date("Y-m-d h:i:sa");

while($row=$data->fetch(PDO::FETCH_ASSOC)) {
    $ID = $row['ID'];
    $OrdenTrabajo = $row['OrdenTrabajo'];
    $Partida = $row['Partida'];
    $Pieza =  $row['Descripcion'];
    $PrevAvance = $row['Avance'];
    $PrevProgress = $row['Progress'];
    }

echo "
<div class = 'container'>
    <form class = 'form-horizontal' role = 'form' method = 'POST' action = 'php/updateor.php'>

    <div class = 'form-group row'>
        <label for = 'recordID' class = 'sr-only'>ID</label>
        <div class = 'col-sm-6'>
        <input class = 'form-control' type = 'hidden' value = '".$ID."' name = 'recordID' id = 'recordID'>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'DateTime' class = 'col-sm-2'>Hora de Consulta</label>
        <div class = 'col-sm-6'>
        <input class = 'form-control' type = 'text' value = '".$echofun."' id = 'DateTime' readonly>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'OrdenTrabajo' class='col-sm-2 col-form-label'>Orden de Trabajo</label>
        <div class = 'col-sm-6'>
        <input class ='form-control' type='text' value='".$OrdenTrabajo."' name = 'OrdenTrabajo' id='OrdenTrabajo' readonly>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'Partida' class = 'col-sm-2 col-form-label'>Partida</label>
        <div class = 'col-sm-6'>
        <input class = 'form-control' type='text' value='".$Partida."' name = 'Partida' id = 'Partida' readonly>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'Pieza' class = 'col-sm-2 col-form-label'>Pieza</label>
        <div class = 'col-sm-6'>
        <input class = 'form-control' type='text' value='".$Pieza."' name = 'Pieza' id = 'Pieza' readonly>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'PrevProgress' class = 'col-sm-2 col-form-label'>Proceso Anterior</label>
        <div class = 'col-sm-6'>
        <input class = 'form-control' type='text' value ='".$PrevProgress."' name = 'PrevProgress' id = 'PrevProgress' readonly>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'PrevAvance' class = 'col-sm-2 col-form-label'> (%) Avance Anterior</label>
        <div class = 'col-sm-6'>
        <input class = 'form-control' type='text' value='".$PrevAvance."' name = 'PrevAvance' id = 'PrevAvance' readonly>
        </div>
    </div>

    <div class = 'form-group row'>
        <label for = 'NewProgress' class = 'col-sm-2 col-form-label'>Proceso Actual</label>
        <div class = 'col-sm-6'>
        <input class = 'form-control' type='text' name = 'NewProgress' id = 'NewProgress' title = 'Ingresar el Proceso Actual del Producto' required>
        </div>
    </div>

    <div class = 'form-group row'>
        <label for = 'NewAvance' class = 'col-sm-2 col-form-label'>(%) Avance Actual</label>
        <div class = 'col-sm-6'>
        <input class = 'form-control' type='number' name = 'NewAvance' id = 'NewAvance' required>
        </div>
    </div>
    
    <div class = 'form-group row'>
        <div class = 'offset-sm-2 col-sm-6'>
        <button type = 'submit' class = 'btn btn-primary'>Actualizar</button>
        </div>
    </div>
    
    </form>
</div>





";



$conn = NULL;
?>
</body>
</html>