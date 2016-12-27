<?php
    date_default_timezone_set("America/Monterrey");

    class TableRows extends RecursiveIteratorIterator{
        function __construct($it){
            parent::__construct($it, self::LEAVES_ONLY);
        }
        function current(){
            return $display_string .="<td>".parent::current()."</td>"; 
        }
        function beginChildren(){
            return $display_string .= "<tr>";
        }
        function endChildern(){
            return $display_string .= "</tr>";
        }
    }

    $servername = "localhost";
    $username = "root";
    $password = "";

    $conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve data from Query String
    $order = $_GET['order'];
    $part = $_GET['part'];

    //build query
    $query = ("SELECT testlog.ID, WorkOrder, WorkDiv, Descripcion, PrevProgress, NewProgress, PrevAvance, NewAvance, ValidUntil
               FROM testlog, testorders, testpiezas
               WHERE WorkOrder = :order
               AND WorkDiv = :part
               AND WorkOrder = OrdenTrabajo
               AND WorkDiv = Partida
               AND testpiezas.ID = testorders.Pieza
               ORDER BY testorders.ID, ValidUntil DESC, WorkDiv");

    $data = $conn->prepare($query);

    $data->bindParam(':order', $order);
    $data->bindParam(':part', $part);
    $data->execute();

    $i=0;

    echo '
        <form action="php/pdfLogs.php" target="_blank" method="POST" id="pdfRequestForm">
            <button style="margin-top: 5px; margin-bottom: 15px;" type="submit" class="btn btn-danger" name="ReqPDF" id="ReqPDF">
                <span class="glyphicon glyphicon-save-file"></span> Generar Reporte
            </button>

    ';

    ob_start();

    echo "<div class='table-responsive'>
     <table class='table table-striped table-hover table-bordered table-condensed'>
     <thead>
     <tr>
     <th class = 'col-md-0'>Orden Trabajo</th>
     <th class = 'col-md-0'>Partida</th>
     <th class = 'col-md-4'>Descripcion</th>
     <th class = 'col-md-2'>Proceso Actual</th>
     <th class = 'col-md-2'>Proceso Previo</th>
     <th class = 'col-md-1'>Avance Actual</th>
     <th class = 'col-md-1'>Avance Previo</th>
     <th class = 'col-md-2'>Fecha Actualizacion</th>
     </tr>
     </thead>
     <tbody>";

    while($row=$data->fetch(PDO::FETCH_ASSOC)){

        if($i === 0){
            echo "<tr class='info'>
          <td><strong><em>$row[WorkOrder]</em></strong></td>
          <td><strong><em>$row[WorkDiv]</em></strong></td>
          <td><strong><em> $row[Descripcion]</em> </strong></td>
          <td class='text-warning'><strong><em>$row[NewProgress]</em></strong></td>
          <td class='text-danger'><strong><em>$row[PrevProgress]</em></strong></td>
          <td class='text-success'><strong><em>$row[NewAvance]%</em></strong></td>
          <td class='text-danger'><strong><em>$row[PrevAvance]%</em></strong></td>
          <td><strong><em>$row[ValidUntil]</em></strong></td>
          </tr>";
        }

        else{
          echo "<tr>
          <td>$row[WorkOrder]</td>
          <td>$row[WorkDiv]</td>
          <td> $row[Descripcion] </td>
          <td>$row[NewProgress]</td>
          <td>$row[PrevProgress]</td>
          <td>$row[NewAvance]%</td>
          <td>$row[PrevAvance]%</td>
          <td>$row[ValidUntil]</td>
          </tr>";
        }

        $i++;
    }

    echo "</tbody></table></div>";

    
    $html = ob_get_contents();

    echo '<input type="hidden" name = "object" value = "'.$html.'" id = "object"> </form>';
    

?>