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
        <link rel="stylesheet" type="text/css" href="CSS\index_style.css" />
    
    </head>
    <style>
        body{
            background-image: url('images/background_image.jpg')
        }
    </style>
    <body>

        <nav>
            <div class="logo">
                  <img src="images\logo.png"> 
            </div>
            
        </nav>
        
        <div class="parent">
            <div class="child">
                <form method="POST">
                    <input type="text" name="username" placeholder="Nom d'utlisateur">
                    <input type="password" name="password" placeholder="Mot de passe">
                    <input type="submit" name="lgn_submit" value="Se connecter">
                    <?php

                    if(isset($_POST['lgn_submit']))
                    {
                    if(!empty($_POST['username'])&&!empty($_POST['password'])&&isset($_POST['lgn_submit']))
                    {
                        $uname = $_POST['username'];
                        $pwd = $_POST['password'];
                        $query = "SELECT * FROM adminLog WHERE pseudo='$uname' && password='$pwd'";
                        $query1 ="SELECT * FROM suplog WHERE pseudo='$uname' && password='$pwd'";
                        $query2 ="SELECT * FROM users WHERE pseudo='$uname' && mdp='$pwd'";
                        if(mysqli_num_rows(mysqli_query($con,$query))>0){
                            $_SESSION['username'] = $uname;
                            header('Location:admin.php');
                        }elseif(mysqli_num_rows(mysqli_query($con,$query1))>0){
                            $_SESSION['username'] = $uname;
                            header('Location:display_sup.php');

                        }elseif(mysqli_num_rows(mysqli_query($con,$query2))>0){
                            $_SESSION['username'] = $uname;
                            header('Location:statistics.php');
                        }else{
                        echo'<p style="text-align: center; font-weight:bold;font-size:12px"> 
                        Nom d\'utilisateur ou mot de passe incorrect</p>';
                    }}}?>
                </form> 
                     
            </div>
        </div>
        
        

    </body>
</html>