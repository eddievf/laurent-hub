<?php
    session_start();

    if(!empty($_SESSION['logged'])){

?>

<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
$turret = intval($_GET['turret']);
$table_string = "";
$partcount = 0;


$servername = "localhost";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//$sql="SELECT * FROM testorders WHERE id = '".$turret."'";
$query = ("SELECT testorders.ID, OrdenTrabajo, OrdenCompra, testorders.Cliente, CantPending, Descripcion, FechaSolicitud, Prioridad, ProdKey, Filepath, Partida, Factura, Validate
          FROM testorders, testpiezas
          WHERE (testpiezas.ID) = (testorders.Pieza)
          AND OrdenCompra = :order

          ORDER BY Partida");

$data = $conn->prepare($query);

$data->bindParam(':order', $turret);
$data->execute();

date_default_timezone_set("America/Monterrey");
$echofun = date("Y-m-d H:i:s");

while($row=$data->fetch(PDO::FETCH_ASSOC)) {
    $ID = $row['ID'];
    $OrdenTrabajo = $row['OrdenTrabajo'];
    $OrdenCompra = $row['OrdenCompra'];
    $Cliente = $row['Cliente'];
    $Cantidad = $row['CantPending'];
    $Descripcion = $row['Descripcion'];
    $FechaSolicitud = $row['FechaSolicitud'];
    $Prioridad = $row['Prioridad'];
    $ProdKey = $row['ProdKey'];
    $Filepath = $row['Filepath'];
    $Partida = $row['Partida'];
    $Factura = $row['Factura'];
    $Validate = $row['Validate'];
    $partcount = $partcount + 1;

    $table_string .= "<div class = 'nottable row'><div class = 'col-md-2'>$row[OrdenCompra]</div>
                      <div class = 'col-md-4'>";

                      if(!empty($Factura)){
                        if($Cantidad == 0){
                            $table_string .= "<span class = 'label label-success'>Done</span> ";
                        }

                        else{
                            $table_string .= "<span class='label label-warning'>Parcial</span> "; 
                        }
                        
                      }
                       

    $table_string .= "$row[Descripcion]</div>
                      <div style='text-align: center;' class = 'col-md-2'>$row[CantPending]</div>
                      <div class = 'col-md-2'>
                        <input class='form-control' type='number' name='RealCant".$ID."' id='RealCant".$ID."' ";

                       if($row['CantPending']==0){
                        $table_string .= "disabled>";
                       }
                       else{
                        $table_string .= "required>";
                       }

    $table_string .= "
                      </div>
                      <div class = 'col-md-2'>
                        <input class='form-control' type='number' name='Factura".$ID."' id='Factura".$ID."' ";

                        if($row['CantPending']==0){
                        $table_string .= "disabled>";
                       }
                       else{
                        $table_string .= " placeholder='# o R#'>";
                       }
                      
    $table_string .= "</div>
                      <input class='form-control' type='hidden' name='OrdenID".$ID."' id='OrdenID".$ID."' value = ".$ID.">
                      </div>
                        ";
                    
}

echo "
<div class = 'container'>
    <form class = 'form-horizontal' role = 'form' method = 'POST' action = 'php/bagtagit.php' id='closingorder' enctype= 'multipart/form-data'>

    <div class = 'form-group row'>
        <label for = 'OrdenCompra' class = 'sr-only'>IDCompra</label>
        <div class = 'col-sm-7'>
        <input class = 'form-control' type = 'hidden' value = '".$OrdenCompra."' name = 'OrdenCompra' id = 'OrdenCompra'>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'user' class = 'sr-only'>Usuario Valida</label>
        <div class = 'col-sm-7'>
        <input class = 'form-control' type = 'hidden' value= '".$_SESSION['user']."' name = 'UserValid' id = 'UserValid'>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'DateTime' class = 'col-sm-2'>Hora de Consulta</label>
        <div class = 'col-sm-7'>
        <input class = 'form-control' type = 'text' value = '".$echofun."' name = 'DateTime' id = 'DateTime' readonly>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'OrdenTrabajo' class='col-sm-2 col-form-label'>Orden de Trabajo</label>
        <div class = 'col-sm-4'>
        <input class ='form-control' type='number' value='".$OrdenTrabajo."' name = 'OrdenTrabajo' id='OrdenTrabajo' readonly>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'Cliente' class = 'col-sm-2 col-form-label'>Cliente</label>
        <div class = 'col-sm-5'>
        <input class = 'form-control' type='text' value='".$Cliente."' name = 'Cliente' id = 'Cliente' readonly>
        </div>
    </div>



    <div class='container-fluid'>
        <div class='nottabletop row'>
            <div class='col-md-2'><strong>Orden de Compra</strong></div>
            <div class='col-md-4'><strong>Descripcion</strong></div>
            <div style='text-align: center;' class='col-md-2'><strong>Cantidad Pendiente</strong></div>
            <div class='col-md-2'><strong>Cantidad<br>Real</strong></div>
            <div class='col-md-2'><strong>Factura</strong><br></div>
        </div>";
                echo $table_string;   
            echo "

    </div>

   <br>
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

<?php
}
else{
    header("location: ../notfound.php");
}
?>