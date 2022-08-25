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

  
            
            <div class="update_profile">
            <h1>Modifier le compte Admin</h1>
            <form method="POST">
            <input type="text" name="Admin_Username" placeholder="Nouveau nom d\'utilisateur">
            <input type="text" name="Admin_Npwd" placeholder="Nouveau Mot de passe">
            <input type="submit" name="update_admin" value="Enregistrer">
            </form></div>
            <?php 
            if(isset($_POST['update_admin'])){
                $pseudo = $_POST['Admin_Username'];
                $admin_pwd = $_POST['Admin_Npwd'];
                $sql = "UPDATE adminlog SET  pseudo='".$pseudo."',password='".$admin_pwd."' WHERE 1";
                mysqli_query($con,$sql);
                

            }
        ?>
        


   </main>
    </body>
</html>