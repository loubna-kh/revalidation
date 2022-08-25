<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$dbname = "bowebpage";
$con = mysqli_connect($host, $user, $password, $dbname);
if(isset($_SERVER['HTTPS'])&& $_SERVER['HTTPS']==='on'){
  $url = "https://";
}else{
  $url = "http://";
  $url .= $_SERVER['HTTP_HOST'];
  $url .= $_SERVER['REQUEST_URI'];
  $url;
}
$page = $url;
$sec = "3";

?>


<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="refresh" content="<?php echo $sec; ?>" URL="<?php echo $page;?>">
  <meta charset="UTF-8">
  <title>Revalidation statistics</title>
  <link rel="icon" href="images\atlasonline.ico" type="image/icon type">
  <link rel="stylesheet" type="text/css" href="CSS/realtime.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>

<body>

  <div class="container">
    <nav>
      <div class="logo">
        <a href="index.php"><img src="images\logo.png"> </a>
      </div>



  </div>



<main>
  <div class="real_time">
    <div class="container_table">
    <table>
      <thead>
      <th> Nom d'agent </th>
        <th> Nombre des Pnrs Traités </th>
      </thead>
      <!--- select data -->
      <?php
      $sql4 = "SELECT DISTINCT(username) FROM statistic GROUP BY username";
      $query4 = mysqli_query($con, $sql4);
      foreach ($query4 as $row) {
        $name = $row['username'];
        echo '
        
        
        
        <tr>
        
        <td>' . $name . '';
        $sql5 = "SELECT COUNT(Pnr) as countpnr FROM statistic WHERE DateT = CURDATE()  AND username = '$name'";
        $result5 = mysqli_query($con, $sql5);
        foreach ($result5 as $rows) {
          echo '</td><td>' . $rows['countpnr'] . '</td>';
        }

        echo '</tr>';
      }


      ?>


    </table>
    </div>
  </div>
  </main>
</body>

</html>