<?php 
      session_start();
      $host = "localhost";
      $user = "root";
      $password = "";
      $dbname = "bowebpage";
      $con = mysqli_connect($host, $user ,$password,$dbname);
      if(isset($_GET['deleteagentid'])){
        $id = $_GET['deleteagentid'];
        $sql = "DELETE FROM users WHERE id=$id";
        $query=mysqli_query($con,$sql);
        if($query){
            header('Location:admin.php');
        }
      }
        
      
      
?>