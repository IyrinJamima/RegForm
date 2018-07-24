<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);  
include('db.php');
if (mysqli_connect_errno()){
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else{
    if(isset($_REQUEST['submit'])!=''){
        if($_REQUEST['firstname']=='' || $_REQUEST['lastname']=='' || $_REQUEST['email']=='' || $_REQUEST['phonenumber']==''|| $_REQUEST['gender']=='' || $_FILES['image']==''){
            echo "please fill the empty field.";
        }else{
                $image=$_FILES['image']['name'];
                $target="./Images/".basename($image);
    
                $sql="insert into registration (first_name,last_name,email_id,phonenumber,gender,image) values ('".$_REQUEST['firstname']."', '".$_REQUEST['lastname']."', '".$_REQUEST['email']."', '".$_REQUEST['phonenumber']."', '".$_REQUEST['gender']."', '".$image."')";
                $res=$con->query($sql);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "Failed to upload image";
                }
           }         
    }
$sql_query="SELECT * FROM registration";
$result_set=mysqli_query($con, $sql_query);
}
?>
<html>
<head>
<title>REGISTRATION FORM</title>
<body>
<form name="registration" method="post" action="#" enctype="multipart/form-data">
FIRST-NAME:<input type="text" name="firstname" value=""></br>
LAST-NAME:<input type="text" name="lastname" value=""></br>
EMAIL-ID:<input type="text" name="email" value=""></br>
GENDER:<input type="radio" name="gender" value="male">Male
<input type="radio" name="gender" value="female">Female</br>
MOBILE-NUMBER:<input type="text" name="phonenumber" value=""></br>
IMAGE:<input type="file" name="image"></br>
<input type="submit" name="submit" value="submit">
</form>
<div id ="form">
<div id ="content">
<table align="center">
<th>firstname</th>
<th>lastname</th>
<th>email</th>
<th>phonenumber</th>
<th>gender</th>
<th>image</th>
<?php
while($row=mysqli_fetch_array($result_set)){
    ?>
    <tr>
    <td><?php echo $row['first_name']; ?></td>
    <td><?php echo $row['last_name']; ?></td>
    <td><?php echo $row['email_id']; ?></td>
    <td><?php echo $row['phonenumber']; ?></td>
    <td><?php echo $row['gender']; ?></td>
    <td><?php echo "<img src ='./Images/".$row['image']."'>"; ?></td>
    </tr>
    <?php
   }
    ?>

</body>
</head>
</html>


