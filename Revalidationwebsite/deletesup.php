<?php 
      session_start();
      $host = "localhost";
      $user = "root";
      $password = "";
      $dbname = "bowebpage";
      $con = mysqli_connect($host, $user ,$password,$dbname);
      if(isset($_GET['deletesupid'])){
        $id = $_GET['deletesupid'];
        $sql = "DELETE FROM suplog WHERE id=$id";
        $query=mysqli_query($con,$sql);
        if($query){
            header('Location:admin.php');
        }
      }
        
      
      
?>