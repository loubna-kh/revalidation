<?php 
// Database configuration 
$host     = "localhost"; 
$user = "root"; 
$password = ""; 
$dbname     = "bowebpage"; 
 
// Create database connection 
$con = new mysqli($host, $user, $password, $dbname); 
 
// Check connection 
if ($con->connect_error) { 
    die("Connection failed: " . $con->connect_error); 
}