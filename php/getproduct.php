<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
$prod = intval($_GET['prod']);


$servername = "localhost";
$username = "root";
$password = "";

$conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//$sql="SELECT * FROM testorders WHERE id = '".$prod."'";
$query = "SELECT ID, ProdKey, Descripcion, Cliente, CodigoProducto, Filepath, Departamento
          FROM testpiezas
          WHERE (ID = :ID)";

$data = $conn->prepare($query);

$data->bindParam(':ID', $prod);
$data->execute();

date_default_timezone_set("America/Monterrey");
$echofun = date("Y-m-d H:i:s");

while($row=$data->fetch(PDO::FETCH_ASSOC)) {
    $ProdKey = $row['ProdKey'];
    $Descripcion = $row['Descripcion'];
    $Cliente = $row['Cliente'];
    $ProdCode =  $row['CodigoProducto'];
    $Filepath = $row['Filepath'];
    $Departamento = $row['Departamento'];
    }

echo "
<div class = 'container'>
    <form class = 'form-horizontal' role = 'form' method = 'POST' action = 'produpdateor.php' enctype= 'multipart/form-data'>

    <div class = 'form-group row'>
        <label for = 'ProdKey' class = 'sr-only'>Product Key</label>
        <div class = 'col-sm-7'>
        <input class = 'form-control' type = 'hidden' value = '".$ProdKey."' name = 'ProdKey' id = 'ProdKey'>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'DateTime' class = 'col-sm-2'>Hora de Consulta</label>
        <div class = 'col-sm-7'>
        <input class = 'form-control' type = 'text' value = '".$echofun."' id = 'DateTime' readonly>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'Descripcion' class='col-sm-2 col-form-label'>Descripcion</label>
        <div class = 'col-sm-7'>
        <input class ='form-control' type='text' value='".$Descripcion."' name = 'Descripcion' id='Descripcion'>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'Cliente' class = 'col-sm-2 col-form-label'>Cliente</label>
        <div class = 'col-sm-7'>
        <input class = 'form-control' type='text' value='".$Cliente."' name = 'Cliente' id = 'Cliente'>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ProdCode' class = 'col-sm-2 col-form-label'>Codigo de Producto</label>
        <div class = 'col-sm-7'>
        <input class = 'form-control' type='text' value='".$ProdCode."' name = 'ProdCode' id = 'ProdCode'>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'Departamento' class = 'col-sm-2 col-form-label'>Departamento</label>
        <div class = 'col-sm-7'>
        <input class = 'form-control' type='text' value='".$Departamento."' name = 'Departamento' id = 'Departamento'>
        </div>
    </div>
    <div class='form-group row'>
        <label for='ProdSummary' class='col-sm-2 col-form-label'>Diseño Actual</label>
        <div class='col-sm-7'>
        ";
        if($Filepath == NULL){
            echo "<div class= 'alert alert-danger'><p class='text-center'><small><u>Aún no hay dibujo para este producto</u></small></p></div>";
        }
        else{
            echo "<div class= 'alert alert-success'><p class = 'text-center'><small><a href = '/indevtest/fileHandler.php?file=".$ProdKey."'><span class='glyphicon glyphicon-download'></span> ".$Descripcion.".pdf</a></small></p></div>";
        }
        echo "
        </div>
    </div>
    <div class = 'form-group row'>
        <label for='userfile' class='col-sm-2 col-form-label'>Cargar Dibujo</label>
        <div class='col-sm-10'>
            <input type='hidden' name='MAX_FILE_SIZE' value='3145728' />
            <input type='file' name='userfile' id='userfile'>
            <p class='help-block'> Solo se permite la subida de <span class='glyphicon glyphicon-file'></span>.pdf</p>
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




?>
</body>
</html>