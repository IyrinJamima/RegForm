<?php
$hostname="localhost";
$username="root"; 
$password="root";       
$database="form_validation";  
$con=mysqli_connect($hostname,$username,$password);
if(! $con)
{
die('Connection Failed'.mysql_error());
}

mysqli_select_db($database,$con);
?>
