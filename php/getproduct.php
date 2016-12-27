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
$query = "SELECT ID, Descripcion, Cliente, CodigoProducto, Filepath
          FROM testpiezas
          WHERE (ID = :ID)";

$data = $conn->prepare($query);

$data->bindParam(':ID', $prod);
$data->execute();

date_default_timezone_set("America/Monterrey");
$echofun = date("Y-m-d H:i:s");

while($row=$data->fetch(PDO::FETCH_ASSOC)) {
    $ID = $row['ID'];
    $Descripcion = $row['Descripcion'];
    $Cliente = $row['Cliente'];
    $ProdCode =  $row['CodigoProducto'];
    $Filepath = $row['Filepath'];
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
        <label for = 'Descripcion' class='col-sm-2 col-form-label'>Descripcion</label>
        <div class = 'col-sm-6'>
        <input class ='form-control' type='text' value='".$Descripcion."' name = 'Descripcion' id='Descripcion'>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'Cliente' class = 'col-sm-2 col-form-label'>Cliente</label>
        <div class = 'col-sm-6'>
        <input class = 'form-control' type='text' value='".$Cliente."' name = 'Cliente' id = 'Cliente'>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'ProdCode' class = 'col-sm-2 col-form-label'>Codigo de Producto</label>
        <div class = 'col-sm-6'>
        <input class = 'form-control' type='text' value='".$ProdCode."' name = 'ProdCode' id = 'ProdCode'>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for = 'Filepath' class = 'col-sm-2 col-form-label'>Archivo Existente</label>
        <div class = 'col-sm-6'>
        <input class = 'form-control' type='text' value ='".$Filepath."' name = 'Filepath' id = 'Filepath'>
        </div>
    </div>
    <div class = 'form-group row'>
        <label for='userfile' class='col-sm-2 col-form-label'>Dibujo</label>
        <div class='col-sm-10'>
            <input type='hidden' name='MAX_FILE_SIZE' value='3145728' />
            <input type='file' name='userfile' id='userfile'>
            <p class='help-block'> Solo se permite la subida de un <span class='glyphicon glyphicon-file'></span> .pdf</p>
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