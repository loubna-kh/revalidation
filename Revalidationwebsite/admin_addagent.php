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
        <link rel="stylesheet" type="text/css" href="CSS/admin_styles.css" />
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
                echo'<p>Bienvenue Mr '.$username.'</p>';
                ?>
                <button><a style="text-decoration: none; color:white;" href="logout.php">Se déconnecter </a></button>
            </div>
            
        </nav>
    </div>
   <div class="parent">
    <div class="menu_bar">
        <form method="POST" class="form_option">
            <input type="submit" value="Profil" name="profile">
            <input type="submit" value="Superviseur" name="superviseur">
            <input type="submit" value="Agent" name="agent">
            <input type="submit" value="Activité en temps réel" name="activity">

        </form>
    </div>
   </div>

   <main>

   <?php
            if(isset($_POST['profile'])){
                header('location:admin-update.php');
                
            }


            if(isset($_POST['superviseur'])){
                header('location:admin_addsup.php');
            }
            

            if(isset($_POST['agent'])){
                header('location:admin_addagent.php');
            }

            if(isset($_POST['activity'])){
                header('location:admin.php');
            }

            
?>
            <div class="Manage_superviseur">
            <h1>Gestions des comptes Accés agent </h1>
            <div class="seperate">  
            <div class="scroler"> 
            <table>
                <?php
                    
                       
                       $query = "SELECT * FROM users  ORDER BY id DESC";
                       $result = mysqli_query($con,$query);
                        if(mysqli_num_rows($result)>0){
                        foreach($result as $row){
                            echo'<tr>
                                <td>'.$row["pseudo"].'</td>
                                <td><label style="color:gray;"> Mot de passe : </label></td>
                                <td style="color:gray;">'.$row["mdp"].'</td>
                                
                                <td class="tdesign">
                                
                                <td><form method="POST" >
                                 <button class="deletedanger"><a name="delete_agent" href="deleteagent.php?deleteagentid='.$row["id"].'">
                                  Supprimer</a></button></td>
                                 </form>
                                
                                </td>
                                </td>
                                </tr>';
                                                            
                        }}else{
                            echo '<tr><td colspan="2" style="text-align:center; color:red;">No data included</td></tr>';
                         }
                         
                                        
                echo'  
                </table>
                </div>
                ';
                
                if(isset($_POST['addagent'])){
                    echo'<div class="container_update">
                    <form method="POST" class="update_form">
                       <input type="text" name="add_agent" placeholder="Nouveau Nom d\'utilisateur ">
                       <input type="password"  name="add_pwd" placeholder="Nouveau Mot de passe ">
                      <input type="submit" class="add_sub" name="add_log_agent" value="Enregistrer">
                   </form>
                   </div>';
                }
                /** Insert AGENT */  
                if(isset($_POST['add_log_agent'])){
                    if(!empty($_POST['add_agent'])&&!empty($_POST['add_pwd'])){
                    
                        $agent_name = $_POST['add_agent'];
                        $agent_pwd = $_POST['add_pwd'];
            
                        $query = "INSERT INTO users VALUES('','$agent_name','$agent_pwd' )";
                        mysqli_query($con,$query);
                    }else{
                        echo"<p style='text-align: center; color:red;font-family:monospace;'>il faut saisir tous les champs</p>";
                    }
                }
                
                /** UPDATE AGENT */  
               

                echo'<div><form method="POST"><input class="addsup"
                 name="addagent" type="submit" value="Ajouter un Agent">
                </form>
            </div>
            </div>
        </div>';
        
  ?>
   


   </main>
    </body>
</html>