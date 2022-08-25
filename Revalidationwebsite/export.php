<?php 
include 'dbConfig.php';
session_start();


$Fdate = $_SESSION['Fdate'];
$Tdate = $_SESSION['Tdate'];
$uname = $_SESSION['uname'];

  // Filter the excel data 
function filterData(&$str){ 
  $str = preg_replace("/\t/", "\\t", $str); 
  $str = preg_replace("/\r?\n/", "\\n", $str); 
  if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

// Excel file name for download 
$fileName = "statistics_" . date('Y-m-d') . ".xls"; 

// Column names 
$fields = array('Nom Agent', 'Date', 'Pnr', 'Nombre Pax', 'Raison', 'Commentaire', 'Type','Qe16', 'EMD'); 

// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 

// Fetch records from database 
$query2 = $con->query("SELECT username, DateT, Pnr, NPax, Rrevalidate , Comment, TypeT ,Qe16,EMD FROM 
statistic WHERE DateT	BETWEEN '$Fdate' AND '$Tdate'  AND username = '$uname'"); 
if($query2->num_rows > 0){ 
  // Output each row of the data 
  while($row = $query2->fetch_assoc()){  
      $lineData = array($row['username'], $row['DateT'], $row['Pnr'], $row['NPax'],
       $row['Rrevalidate'], $row['Comment'], $row['TypeT'], $row['Qe16'], $row['EMD']); 
      array_walk($lineData, 'filterData'); 
      $excelData .= implode("\t", array_values($lineData)) . "\n"; 
  } 
}else{ 
  $excelData .= 'No records found...'. "\n"; 
} 

// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 

// Render excel data 
echo $excelData; 

exit;
?>