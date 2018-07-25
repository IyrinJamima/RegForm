<?php
include('login.php');
if(isses($_SESSION['email'])){
    $sql= "select * from registration where first_name = ".$_session['email'] ; 
    $result_set = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result_set);
echo $row['first_name'];
 }
<html>
<head>
<title>Home</title>
</head>
<body>
<a href="logout.php"></a>
</body>
</html>

