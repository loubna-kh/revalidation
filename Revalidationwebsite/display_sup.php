<?php 
      session_start();
      $host = "localhost";
      $user = "root";
      $password = "";
      $dbname = "bowebpage";
      $con = mysqli_connect($host, $user ,$password,$dbname);
     
      
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Revalidation statistics</title>
    <link rel="icon" href="images\atlasonline.ico" type="image/icon type">
    <link rel="stylesheet" type="text/css" href="CSS/display_styles.css" />
    <script src="./chartjs/chart.min.js"></script>
    

</head>
<body>


    <div class="container">
        <nav>
            <div class="logo">
                  <a href="index.php"><img src="images\logo.png"> </a>
            </div>
            <div class="signout">
                <?php 
                $username = $_SESSION['username'];
                echo'<p>Bienvenue  '.$username.'</p>';
                ?>
                <button><a style="text-decoration: none;color:white" href="logout.php">Se déconnecter </a></button>
            </div>
            
        
    </div>
        
    <div class="parent">

                    <div class="nav_bar">
                    <form method="POST">
                            <input name="dashboard" type="submit" value="Page d'acceuil" >
                            <input name="agent_stc" type="submit" value="Statistique par agent">
                            <input name="realtime" type="submit" value="Activité en temps réel">
                            <input name="ctrl_pnr" type="submit" value="Les PNRs Vérifiées">
                            <input name="search_pnr" type="submit" value="Chercher un PNR">
                        
                      </form>
                    </div>
    </div>
<style>
    
</style>   
<main>
<?php
            if(isset($_POST['dashboard'])){
                header('location:display_sup.php');
                
            }


            if(isset($_POST['agent_stc'])){
                header('location:statistique_par_agent.php');
            }
            

            if(isset($_POST['realtime'])){
                header('location:Activites_en_temps_reel.php');
            }

            if(isset($_POST['ctrl_pnr'])){
                header('location:pnr_controller.php');
            }

            if(isset($_POST['search_pnr'])){    
                header('location:search_pnr.php');
                

            }
        ?>
            
                <div class="dashboard">
                <form class="search_dashboard" method="GET">                           
                               <label> Du :</label>
                               <input  name="Dashboard_Fdate" type="date">
                               <label> Jusqu\'à :  </label>
                               <input name="Dashboard_Tdate" type="date">
                               <input type="submit" class="src_btn" value="chercher" name="search_charts">
               </form>
               <div class="charts">
               
                   <div class="chart_one">
                    <?php
                            $qe16='';
                            $pnr = '';
                            $emd = '';
                           if(!empty('Dashboard_Fdate')&&!empty('Dashboard_Tdate')&&isset($_GET['search_charts'])){
                               $Fdate = $_GET['Dashboard_Fdate'];
                               $Tdate = $_GET['Dashboard_Tdate'];
                               $sql1 = "SELECT count(Qe16) as numQe FROM statistic  WHERE DateT BETWEEN '$Fdate' AND '$Tdate' AND Qe16 !='' ";
                               $query1 = $con->query($sql1);
                                   foreach($query1 as $data1){
                                       $qe16 =  $data1['numQe'];
                                   }
                               $sql2 = "SELECT count(Pnr) as numPnr FROM statistic WHERE DateT BETWEEN '$Fdate' AND '$Tdate' AND  Pnr !='' ";
                               $query2 = $con->query($sql2);
                                   foreach($query2 as $data2){
                                       $pnr =  $data2['numPnr'];
                                   }
                               $sql3 = "SELECT count(EMD) as numEmd FROM statistic WHERE DateT BETWEEN '$Fdate' AND '$Tdate' AND  EMD !='' ";
                               $query3 = $con->query($sql3);
                                   foreach($query3 as $data3){
                                       $emd =  $data3['numEmd'];
                                   }
           
                                   
           
           
                           }else{
                               $sql1 = "SELECT count(Qe16) as numQe FROM statistic WHERE  DateT = CURDATE() AND Qe16 !='' ";
                               $query1 = $con->query($sql1);
                                   foreach($query1 as $data1){
                                       $qe16 =  $data1['numQe'];
                                   }
                               $sql2 = "SELECT count(Pnr) as numPnr FROM statistic WHERE  DateT = CURDATE() AND  Pnr !='' ";
                               $query2 = $con->query($sql2);
                                   foreach($query2 as $data2){
                                       $pnr =  $data2['numPnr'];
                                   }
                               $sql3 = "SELECT count(EMD) as numEmd FROM statistic WHERE  DateT = CURDATE() AND  EMD !='' ";
                               $query3 = $con->query($sql3);
                                   foreach($query3 as $data3){
                                       $emd =  $data3['numEmd'];
                                   }
                           }
           
                       
                           echo '<canvas id="lineChart"></canvas>
                   </div>
                   <div class="chart_two">';
                           $Agent_Name='';
                           $Pnr = '';
                           if(!empty('Dashboard_Fdate')&&!empty('Dashboard_Tdate')&&isset($_GET['search_charts'])){
                               $Fdate = $_GET['Dashboard_Fdate'];
                               $Tdate = $_GET['Dashboard_Tdate'];
                               $sql = "SELECT username , COUNT(Pnr) as numPnr FROM statistic where DateT BETWEEN '$Fdate' AND '$Tdate' GROUP BY username";
                               $query = $con->query($sql);
                                   foreach($query as $data){
                                        $Agent_Name[] =  $data['username'];
                                        $Pnr[] = $data['numPnr'];
           
                                   }
                           }else{
                               $sql = "SELECT username , COUNT(Pnr) as numPnr FROM statistic where DateT = CURDATE() GROUP BY username";
                               $query = $con->query($sql);
                                   foreach($query as $data){
                                       $Agent_Name[] =  $data['username'];
                                       $Pnr []= $data['numPnr'];
                                   }
                           }
           
                       
                       echo '<canvas id="myChart"></canvas>
                   </div>
               
               </div>
                
               </div>'; 
               ?>
   
   
        
               
            

            

                            

    


<script>
               const labels = <?php echo json_encode($Agent_Name); ?>;

               const data = {
                       labels: labels,
                   datasets: [{
                       label: 'Traitement des Pnrs par Agent',
                       data: <?php echo json_encode($Pnr); ?>,
                       backgroundColor: [
                                   'rgba(255, 99, 132, 0.2)',
                                   'rgba(255, 159, 64, 0.2)',
                                   'rgba(255, 205, 86, 0.2)',
                                   'rgba(75, 192, 192, 0.2)',
                                   'rgba(54, 162, 235, 0.2)',
                                   'rgba(153, 102, 255, 0.2)',
                                   'rgba(201, 203, 207, 0.2)'
                       ],
                       borderColor: [
                                   'rgb(255, 99, 132)',
                                   'rgb(255, 159, 64)',
                                   'rgb(255, 205, 86)',
                                   'rgb(75, 192, 192)',
                                   'rgb(54, 162, 235)',
                                   'rgb(153, 102, 255)',
                                   'rgb(201, 203, 207)'
                       ],
                       borderWidth: 2
                   }]
               };
               const config = {
                               type: 'bar',
                               data: data,
                               options: {scales: {y: {beginAtZero: true}}},
               };
             const labels1 = [
               '',
               'Pnr (E/R)',
               'QE16',
               'Emision d\'EMD',
               '',
              ];
 
              const data1 = {
                   labels: labels1,
                   datasets: [{
                   label: 'Traitement des Pnr(E/R) , Qe16 , EMD',
                   backgroundColor: 'rgb(255, 99, 132)',
                   borderColor: 'rgb(255, 99, 132)',
                   data: [ ,<?php echo json_encode($pnr);?>,<?php echo json_encode($qe16);?>,<?php echo json_encode($emd);?>, ]
                   ,}]
              };
              const config1 = {
                               type: 'line',
                               data: data1,
                   };
               const lineChart = new Chart(document.getElementById('lineChart'),config1);
               const myChart = new Chart(document.getElementById('myChart'),config);
        </script>    








</main>         
</body>
</html>

