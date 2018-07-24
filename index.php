<?php     
include('db.php');
if (mysqli_connect_errno()){
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else{
    if(isset($_REQUEST['submit'])!=''){
        if($_REQUEST['firstname']=='' || $_REQUEST['lastname']=='' || $_REQUEST['email']=='' || $_REQUEST['phonenumber']==''|| $_REQUEST['gender']=='' || $_FILES['image']==''){
            echo "please fill the empty field.";
        }else{
                $image=$_FILES['image']['name'];
                $target="./images/".basename($image);
    
                $sql="insert into registration (firstname,lastname,email,phonenumber,gender,image) values('".$_REQUEST['firstname']."', '".$_REQUEST['lastname']."', '".$_REQUEST['email']."', '".$_REQUEST['phonenumber']."', '".$_REQUEST['gender']."', '".$image."')";
                $res=$con->query($sql);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "Failed to upload image";
                }
                if($res){
                }else{
                    echo "There is some problem in inserting record";
                }
           }         
    }
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
MOBILE-NUMBER:<input type="text" name="number" value=""></br>
IMAGE:<input type="file" name="image"></br>
<input type="submit" name="submit" value="submit">
</form>
</body>
</head>
</html>


