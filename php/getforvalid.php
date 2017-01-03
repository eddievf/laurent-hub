<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
$dart = intval($_GET['dart']);
$table_string = "";


$servername = "localhost";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//$sql="SELECT * FROM testorders WHERE id = '".$dart."'";
$query = ("SELECT testorders.ID, OrdenTrabajo, OrdenCompra, testorders.Cliente, Descripcion, FechaSolicitud, Prioridad, ProdKey, Filepath, Partida, Validate
          FROM testorders, testpiezas
          WHERE (testpiezas.ID) = (testorders.Pieza)
          AND OrdenTrabajo = :order
          ORDER BY Partida");

$data = $conn->prepare($query);

$data->bindParam(':order', $dart);
$data->execute();

date_default_timezone_set("America/Monterrey");
$echofun = date("Y-m-d H:i:s");

while($row=$data->fetch(PDO::FETCH_ASSOC)) {
    $ID = $row['ID'];
    $OrdenTrabajo = $row['OrdenTrabajo'];
    $OrdenCompra = $row['OrdenCompra'];
    $Cliente = $row['Cliente'];
    $Descripcion = $row['Descripcion'];
    $FechaSolicitud = $row['FechaSolicitud'];
    $Prioridad = $row['Prioridad'];
    $ProdKey = $row['ProdKey'];
    $Filepath = $row['Filepath'];
    $Partida = $row['Partida'];
    $Validate = $row['Validate'];

    $table_string .= "<tr><td>$row[FechaSolicitud]</td>
                      <td>$row[Descripcion]</td>
                      <td>$row[Partida]
                        ";
    if($Filepath == NULL){
            $table_string .= "<td><span class = 'label label-danger'><u>Aún no hay dibujo para $row[Descripcion]</u></span></td>";
        }
        else{
            $table_string .= "<td><span class = 'label'><u><a href = '/indevtest/fileHandler.php?file=$row[ProdKey]'>$row[Descripcion]</a></span></u></td>";
        }

    switch ($Prioridad) {
        case 0:
            $table_string .= "<td><span class = 'label label-info'>Normal</span></td>";
            break;
        
        case 1:
            $table_string .= "<td><span class = 'label label-danger'>Urgente</span></td>";
            break;
    }

    switch ($Validate) {
        case 1:
            $table_string .= "<td><span class = 'label label-success'><span class = 'glyphicon glyphicon-ok-sign'></span> Liberado</span></td></tr>";
            break;

        case 2:
            $table_string .= "<td><span class = 'label label-warning'><span class = 'glyphicon glyphicon-minus-sign'></span> Revision</span></td></tr>";
            break;

        case 3:
            $table_string .= "<td><span class = 'label label-danger'><span class = 'glyphicon glyphicon-remove-sign'></span> Pendiente</span></td></tr>";
            break;

    }
                    
}

echo "
<div class = 'container'>
    <form class = 'form-horizontal' role = 'form' method = 'POST' action = 'php/validateorder.php' enctype= 'multipart/form-data'>

    <div class = 'form-group row'>
        <label for = 'ID' class = 'sr-only'>ID</label>
        <div class = 'col-sm-7'>
        <input class = 'form-control' type = 'hidden' value = '".$ID."' name = 'ID' id = 'ID'>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'DateTime' class = 'col-sm-2'>Hora de Consulta</label>
        <div class = 'col-sm-7'>
        <input class = 'form-control' type = 'text' value = '".$echofun."' id = 'DateTime' readonly>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'OrdenTrabajo' class='col-sm-2 col-form-label'>Orden de Trabajo</label>
        <div class = 'col-sm-4'>
        <input class ='form-control' type='number' value='".$OrdenTrabajo."' name = 'OrdenTrabajo' id='OrdenTrabajo'>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'OrdenCompra' class = 'col-sm-2 col-form-label'>Orden de Compra</label>
        <div class = 'col-sm-5'>
        <input class = 'form-control' type='number' value='".$OrdenCompra."' name = 'OrdenCompra' id = 'OrdenCompra'>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ValidState' class = 'col-sm-2 col-form-label'>Estado de Orden</label>
        <div class = 'col-sm-5'>
                <label class='radio-inline'>
                    <input type='radio' name='Validate' id='ValidFree' value='1'>
                    <span class = 'label label-success'><span class = 'glyphicon glyphicon-ok-sign'></span> Liberado</span>
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='Validate' id='ValidRev' value='2'>
                    <span class = 'label label-warning'><span class = 'glyphicon glyphicon-minus-sign'></span> Revision</span>
                </label>
                <label class='radio-inline'>
                    <input type='radio' name='Validate' id='ValidError' value='3'>
                    <span class = 'label label-danger'><span class = 'glyphicon glyphicon-remove-sign'></span> Pendiente</span>
                </label>
        </div>
    </div>

    <div class='table-responsive'>
        <table class='table table-striped table-hover table-bordered'>
            <thead>
                <tr>
                    <th class = 'col-md-2'>Fecha Solicitud</th>
                    <th class = 'col-md-5'>Pieza</th>
                    <th class = 'col-md-0'>Partida</th>
                    <th class = 'col-md-3'>Dibujo Actual</th>
                    <th class = 'col-md-0'>Prioridad</th>
                    <th class = 'col-md-0'>Liberación</th>
                </tr>
            </thead>
            <tbody>";
                echo $table_string;   
            echo "
            </tbody>
        </table>
    </div>
   
    <div class = 'form-group row'>
        <div class = 'offset-sm-2 col-sm-6'>
        <button type = 'submit' class = 'btn btn-primary'>Actualizar</button>
        </div>
    </div>
    
    </form>
</div>


";




?>
</body>
</html>
