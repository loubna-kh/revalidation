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
                    <input  name="from_date" type="date">
                    <label > Jusqu\'à :  </label>
                    <input  name="to_date" type="date">
                    <input  placeholder="Nom de l'agent" name="search_name" type="text">
                    <input type="submit" class="src_btn" value="chercher" name="search">
                </form>
                <div class="display_agent">
                    <table>
                     <thead>
                        <tr>
                            <th>Nom de l'agent</th>
                            <th>La date</th>
                            <th>Pnr</th>
                            <th class="nbr">Nombre des passagers</th>
                            <th>La raison</th>
                            <th>Commentaire</th>
                            <th>Type</th>
                            <th> Qe16</th>
                            <th>EMD </th>
                        </tr>
                     </thead>
                        <tbody
                           <?php 
                            if(isset($_GET['from_date'])&&isset($_GET['to_date'])&&isset($_GET['search_name'])){
                                
                                 $Fdate = $_GET['from_date'];
                                 $Tdate = $_GET['to_date'];
                                 $uname = $_GET['search_name'];
                                 $_SESSION['Fdate']=$Fdate;
                                 $_SESSION['Tdate']=$Tdate;
                                 $_SESSION['uname']=$uname;
                                 $query = "SELECT username, DateT, Pnr, NPax, Rrevalidate , Comment, TypeT, Qe16,EMD FROM statistic WHERE DateT	BETWEEN '$Fdate' AND '$Tdate'  AND username = '$uname' ORDER BY Id DESC";
                                 $result = mysqli_query($con,$query);
                                 if(mysqli_num_rows($result)>0){
                                    foreach($result as $row){
                                        echo'<tr>
                                                <td>'.$row["username"].'</td>
                                                <td>'.$row["DateT"].'</td>
                                                <td>'.$row["Pnr"].'</td>
                                                <td>'.$row["NPax"].'</td>
                                                <td>'.$row["Rrevalidate"].'</td>
                                                <td>'.$row["Comment"].'</td>
                                                <td>'.$row["TypeT"].'</td>
                                                <td>'.$row["Qe16"].'</td>
                                                <td>'.$row["EMD"].'</td></tr>';
                                                
                                    }
                                /**  */ 
                                

                                

                                /** */

                                 }else{
                                    echo '<p style="text-align:center; color:red;">No data included<p>';
                                 }
                                 

                            }
                 echo'</tbody>
                    </table>
                </div>
                <div class="statistic_agent">
                        <form class="form_data" action="export.php" method="POST">
                            <label>Nombre des passagers</label>';
                        
                            if(!empty($Fdate)&&!empty($Tdate)&&!empty($uname)){
                            $results = mysqli_query($con,"SELECT SUM(NPax)  FROM statistic WHERE DateT BETWEEN '$Fdate' AND '$Tdate'  AND username = '$uname'");
                              while($rows = mysqli_fetch_array($results)){
                                     echo '<label>'.$rows['SUM(NPax)'].'</label>';
                              }
                            }

                        
                            echo'<label>Nombres des Pnrs et EMDs</label>';
                        
                             if(!empty($Fdate)&&!empty($Tdate)&&!empty($uname)){
                            $results = mysqli_query($con,"SELECT COUNT(Pnr)  FROM statistic WHERE DateT BETWEEN '$Fdate' AND '$Tdate'  AND username = '$uname'");
                              while($rows = mysqli_fetch_array($results)){
                                     echo '<label>'.$rows['COUNT(Pnr)'].'</label>';
                              }
                            
                             }

                         ?>    

                       
                           <input name="export" class="export" type="submit"  value="Télécharger votre fichier format Excel">
                        </form> </div>        
                </div>
            
    </main>
    
</body></html>