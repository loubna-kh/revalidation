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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    

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
            <div class="agent_stc">
                <form class="agent_search" method="GET">                           
                    <label > Du :</label>
                    <input  name="fdate" type="date">
                    <label > Jusqu\'à :  </label>
                    <input  name="tdate" type="date">
                    <input type="submit" class="src_btn" value="chercher" name="search_PNR">
                </form>
                <div class="display_agent">
                    <table>
                     <thead>
                        <tr>
                            <th>Nom de l'agent Traitant</th>
                            <th>Date du traitement</th>
                            <th>Pnr</th>
                            <th>Agent vérifiant</th>
                            <th>Décision</th>
                            <th>Date du vérification</th>
                        </tr>
                     </thead>
                        <tbody> 
                            <?php
                            
                            if(!empty($_GET['fdate'])&&!empty($_GET['tdate'])&&isset($_GET['search_PNR'])){
                                
                                 $Fdate = $_GET['fdate'];
                                 $Tdate = $_GET['tdate'];
                                 $_SESSION['Fdate']=$Fdate;
                                 $_SESSION['Tdate']=$Tdate;
                                 $query = "SELECT nagentT, DateT, pnr, nagentC, OptionT, DateC FROM controll WHERE DateC BETWEEN '$Fdate' AND '$Tdate'  ORDER BY Id DESC";
                                 $result = mysqli_query($con,$query);
                                 if(mysqli_num_rows($result)>0){
                                    foreach($result as $row){
                                        echo'<tr>
                                                <td>'.$row["nagentT"].'</td>
                                                <td>'.$row["DateT"].'</td>
                                                <td>'.$row["pnr"].'</td>
                                                <td>'.$row["nagentC"].'</td>
                                                <td>'.$row["OptionT"].'</td>
                                                <td>'.$row["DateC"].'</td>
                                            </tr>';
                                                
                                    }
                                /**  */ 
                                

                                

                                /** */

                                 }else{
                                    echo '<p style="text-align:center; color:red;">No data included<p>';
                                 }
                                 

                            }
                            ?>
                 </tbody>
                    </table>
                </div>
                       
                </div>
            
            </main>
</body>
</html>