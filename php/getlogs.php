<?php
date_default_timezone_set("America/Monterrey");
$display_string = "<div class='table-responsive'>";
$display_string .= "<table class='table table-striped table-hover table-bordered table-condensed'>";
$display_string .= "<thead>";
$display_string .= "<tr>";
$display_string .= "<th class = 'col-md-0'>Orden Trabajo</th>";
$display_string .= "<th class = 'col-md-0'>Partida</th>";
$display_string .= "<th class = 'col-md-4'>Descripcion</th>";
$display_string .= "<th class = 'col-md-2'>Proceso Actual</th>";
$display_string .= "<th class = 'col-md-2'>Proceso Previo</th>";
$display_string .= "<th class = 'col-md-1'>Avance Actual</th>";
$display_string .= "<th class = 'col-md-1'>Avance Previo</th>";
$display_string .= "<th class = 'col-md-2'>Fecha Actualizacion</th>";
$display_string .= "</tr>";
$display_string .= "</thead>";
$display_string .= "<tbody>";

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
          ORDER BY ValidUntil DESC, WorkDiv");

$data = $conn->prepare($query);

$data->bindParam(':order', $order);
$data->bindParam(':part', $part);

$data->execute();
$i=0;

while($row=$data->fetch(PDO::FETCH_ASSOC)){

   if($i === 0){
   $display_string .= "<tr class='info'>";
   $display_string .= "<td><strong><em>$row[WorkOrder]</em></strong></td>";
   $display_string .= "<td><strong><em>$row[WorkDiv]</em></strong></td>";
   $display_string .= "<td><strong><em>$row[Descripcion]</em></strong></td>";
   $display_string .= "<td class='text-warning'><strong><em>$row[NewProgress]</em></strong></td>";
   $display_string .= "<td class='text-danger'><strong><em>$row[PrevProgress]</em></strong></td>";
   $display_string .= "<td class='text-success'><strong><em>$row[NewAvance]%</em></strong></td>";
   $display_string .= "<td class='text-danger'><strong><em>$row[PrevAvance]%</em></strong></td>";
   $display_string .= "<td><strong><em>$row[ValidUntil]</em></strong></td>";
   $display_string .= "</tr>";
   }
   else{
      $display_string .= "<tr>";
      $display_string .= "<td>$row[WorkOrder]</td>";
      $display_string .= "<td>$row[WorkDiv]</td>";
      $display_string .= "<td>$row[Descripcion]</td>";
      $display_string .= "<td>$row[NewProgress]</td>";
      $display_string .= "<td>$row[PrevProgress]</td>";
      $display_string .= "<td>$row[NewAvance]%</td>";
      $display_string .= "<td>$row[PrevAvance]%</td>";
      $display_string .= "<td>$row[ValidUntil]</td>";
      $display_string .= "</tr>";
   }

   $i++;

}

$display_string .= "</tbody></table></div>";

echo $display_string;
?>