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
        <link rel="stylesheet" type="text/css" href="CSS/statistics.css" />
    </head>
    <body>

        <!------- navbar ----->

        
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
                <button><a style="text-decoration: none; color:white;" href="logout.php">Se déconnecter </a></button>
            </div>
            
        
    </div>

            
        </nav>

        <!------- Main page ----->

<div class="main_page">
    
   <div class="container_search">
      <form class="agent_search" method="GET">
        <label>Du</label>
        <input type="date" name="Fdate">
        <label>Jusqu'à</label>
        <input type="date" name="Tdate">
        <input type="submit" value="Nombre des Pnrs Traités" name="submit_agent">
        
                                <?php
                                     if(isset($_GET['Fdate'])&&isset($_GET['Tdate'])&&isset($_GET['submit_agent'])){
                                     $Fdate = $_GET['Fdate'];
                                     $Tdate = $_GET['Tdate'];
                                     $uname = $_SESSION['username'];
                                     if(!empty($Fdate)&&!empty($Tdate)){
                                        
                                    $results = mysqli_query($con,"SELECT COUNT(Id)  FROM statistic WHERE DateT BETWEEN '$Fdate' AND '$Tdate' AND username = '$uname'");
                                      while($rows = mysqli_fetch_array($results)){
                                             echo '<label style="font-size:18px;">'.$rows['COUNT(Id)'].'</label>';
                                      }
                                    
                                     }
                                    }

                                     ?>

    </form>
   </div>
     
        

   <div class="div1">
    
    <main>
        
        <div class="insertion_form">
            <form method="POST">
                <div class="inputs_labels">
                    
                    <div class="inputs"> 
                    <input placeholder="Pnr (E/R)"  type="text" name="pnr" maxlength="6">
                    <input placeholder="Nombre de Passagers" type="number" name="Npsg">
                    <input placeholder="Date du traitementt" type="date" name="date">
                    <select name="Rrevalidation" >
                        <option value="">Raison de revalidation</option>
                        <option value="un">Un</option>
                        <option value="surbook">Surbook</option>
                        <option value="affret">Affret</option>
                        <option value="gratuit">Gratuit</option>
                        <option value="tk">Tk</option>
                        
                        <option value="accdrm">Accord DRRM</option>
                        <option value="accrrc">Accord RRC_CCO</option>
                    </select>
                    <input placeholder="Commentaire(Facultatif)" type="text" name="comment" maxlength="15">
                    <select name="type" >
                        <option value="">Type d'echange</option>
                        <option value="echange">Echange</option>
                        <option value="revalidation">Revalidation</option>
                    </select>
                    <input placeholder="Pnr QE16" type="text" name="Qe16" maxlength="6">
                    <input placeholder="EMD émis " type="text" name="emd" maxlength="14">
                    </div>
                    
                </div>
                <?php
                if(isset($_POST['add'])){
        if((!empty($_POST['pnr'])&&!empty($_POST['date'])
        &&!empty($_POST['Rrevalidation'])&&!empty($_POST['type'])
        &&!empty($_POST['Npsg']))
        
        ||!empty($_POST['Qe16'])&&!empty($_POST['date'])||!empty($_POST['emd'])&&!empty($_POST['date'])){
            $pnr = $_POST['pnr'];
            $npax = $_POST['Npsg'];
            $date = $_POST['date'];
            $raison = $_POST['Rrevalidation'];
            $comment = $_POST['comment'];
            $type = $_POST['type'];
            $qe16 = $_POST['Qe16'];
            $emd = $_POST['emd'];

            $query = "INSERT INTO statistic VALUES('','{$_SESSION['username']}','$date','$pnr','$npax','$raison','$comment','$type','$qe16' ,'$emd' )";
            mysqli_query($con,$query);
        }else{
            echo"<p style='text-align: center; color:red;font-family:monospace;'>il faut saisir tous les champs</p>";
        }
        
      } 
                 ?>
                <div class="form_btn">
                    

                    <button class="add" name="add">Ajouter</button>
                    
                </div>
            </form>
            
        </div>
        
        
        <div class="data_selection">
             <table>
                <thead>
                <tr>
                    
                    <th>Date</th>
                    <th>Pnr (E/R)</th>
                    <th>Nbr Pax</th>
                    <th>Raison</th>
                    <th>Commentaire</th>
                    <th>Type</th>
                    <th>Pnr Qe16</th>
                    <th>EMD 147-</th>
                    
                </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT Id, DateT, Pnr, NPax, Rrevalidate , Comment, TypeT, Qe16,EMD FROM statistic WHERE username = '".$_SESSION['username']."' AND DateT = CURDATE()";
                    $result = $con->query($sql);
                    if($result-> num_rows>0){
                        while($row = $result->fetch_assoc()){
                            echo'<tr>
                                     <td>'.$row["DateT"].'</td>
                                     <td>'.$row["Pnr"].'</td>
                                     <td>'.$row["NPax"].'</td>
                                     <td>'.$row["Rrevalidate"].'</td>
                                     <td>'.$row["Comment"].'</td>
                                     <td>'.$row["TypeT"].'</td>
                                     <td>'.$row["Qe16"].'</td>
                                     <td>'.$row["EMD"].'</td>
                                     
                                     </tr>';
                        }
                    }

                    ?>
                </tbody>
                
            </table>
        </div>
         
     
    </main>
     
   <div class="controll">
    <div class="title">
    <h4> Chercher les Pnrs à controller </h4>
    </div>
        <div class="controll_search">
            
            <form method="GET">
            <div class="controll_labels">    
            <input type="date" name="controll_date">
            <input type="text" name="controll_name" placeholder="Nom d'agent">
            </div>
            <input type="submit" name="controll_submit" value="Cherher">
            </form>

        </div>
        <div class="display_controll">
            <table>
                <thead>
                    <th>La date</th>
                    <th>Pnrs</th>
                </thead>
                <tbody>
                <?php
                if(!empty($_GET['controll_date'])&&!empty($_GET['controll_name'])&&isset($_GET['controll_submit'])){
                    $uname = $_GET['controll_name'];
                    $srcDate = $_GET['controll_date'];
                    $sqlCtrl = "SELECT DateT, Pnr FROM statistic WHERE username = '$uname' AND DateT = '$srcDate' ";
                    $resultCtrl = $con->query($sqlCtrl);
                    if($resultCtrl-> num_rows>0){
                        while($row = $resultCtrl->fetch_assoc()){
                            echo'<tr>
                                     <td>'.$row["DateT"].'</td>
                                     <td>'.$row["Pnr"].'</td>
                                </tr>';
                        }
                    }
                }

                    ?>
                </tbody>
            </table> 
        </div>
        <div class="save_data">
         <form method="POST">
            <div class="inputs_container">
            <input type="text" placeholder="Copier le Pnr" name="pnr_ctrl">
            <select name="controll_decision">
                <option value="">Choissisez</option>
                <option value="Okay">Sans Anomalie</option>
                <option value="Anomalie">Avec Anomalie</option>
            </select> 
            </div>
            <div class="ctrl_btn">
            <input type="submit" name="save" value="Enregistrer"></form>
        </div> 
        </div> 
    </div>
    
   </div> 
    <?php
        if(!empty($_POST['pnr_ctrl'])&&!empty($_POST['controll_decision'])&&isset($_POST['save'])){
            $uname = $_GET['controll_name'];
            $srcDate = $_GET['controll_date'];
            $pnrC = $_POST['pnr_ctrl'];
            $option = $_POST['controll_decision'];
            $query = "INSERT INTO controll VALUES('','$uname','$srcDate','$pnrC',
            '{$_SESSION['username']}','$option',CURDATE())";
            mysqli_query($con,$query);
        }
        
                    
                            
    ?> 


</div>

    

   
    
    
     

</body>
</html>