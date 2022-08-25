<?php 
      session_start();
      $host = "localhost";
      $user = "root";
      $password = "";
      $dbname = "bowebpage";
      $con = mysqli_connect($host, $user ,$password,$dbname);
      if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];
        $sql = "DELETE FROM `statistic` WHERE Id=$id";
        $query=mysqli_query($con,$sql);
        if($query){
            header('Location:statistics.php');
        }
      }
      
        
      
      
?>