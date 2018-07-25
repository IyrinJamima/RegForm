<?php
/*ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);  */
include('login.php');
if (mysqli_connect_errno()){
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else{
    if(isset($_REQUEST['submit'])!=''){
      if($_REQUEST['id']==''){
        if($_REQUEST['firstname']=='' || $_REQUEST['lastname']=='' || $_REQUEST['email']=='' || $_REQUEST['phonenumber']==''|| $_REQUEST['gender']=='' || $_FILES['image']=='' || $_REQUEST['password']==''){
            echo "please fill the empty field.";
        }else{
                $image=$_FILES['image']['name'];
                $target="./Images/".basename($image);
    
                $sql="insert into registration (first_name,last_name,email_id,phonenumber,gender,image,password) values ('".$_REQUEST['firstname']."', '".$_REQUEST['lastname']."', '".$_REQUEST['email']."', '".$_REQUEST['phonenumber']."', '".$_REQUEST['gender']."', '".$image."', '".$_REQUEST['password']."')";
                $res=$con->query($sql);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "Failed to upload image";
                }
           }   
      }else{
           $image=$_FILES['image']['name'];
           $target="./Images/".basename($image);
           $update_sql = "update registration set first_name = '".$_REQUEST ['firstname']."', image = '".$image."' where id = ".$_REQUEST['id']; 
           $res=$con->query($update_sql);
           if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                    $msg = "Image uploaded successfully";
                }else{
                    $msg = "Failed to upload image";
                } 
           header("Location:$_SERVER[PHP_SELF]"); 
       }
   
    }
     if(isset($_GET['edit_id'])){
         $sql_query = "select * from registration where id=".$_GET['edit_id'];
         $result = mysqli_query($con, $sql_query);
         $read_value = mysqli_fetch_array($result);
    }
    if(isset($_GET['delete_id'])){
         $sql_query = "delete from registration where id=".$_GET['delete_id'];
         $res = $con->query($sql_query);
         header("Location:$_SERVER[PHP_SELF]"); 
    }
$sql_query="SELECT * FROM registration";
$result_set=mysqli_query($con, $sql_query);
}
?>
<html>
<head>
<title>REGISTRATION FORM</title>
<style type="text/css">
   #content{
   	width: 37%;
   	margin: 20px auto;
   	border: 1px solid #000;
   }
   form{
   	width: 50%;
   	margin: 20px auto;
   }
   form div{
   	margin-top: 5px;
   }
   #img_div{
   	width: 80%;
   	padding: 5px;
   	margin: 15px auto;
   	border: 1px solid #cbcbcb;
   }
   #img_div:after{
	content: "";
   	display: block;
   	clear: both;
   }
   img{
   	float: left;
   	margin: 5px;
   	width: 100px;
   	height: 100px;
   }
</style>
</head>
<body background = "2.jpg" style = "backround-repeat:none;width:100%">
<form name="registration" method="post" action="#" enctype="multipart/form-data" align="center">
<input type="hidden" name="id" value="<?php echo $read_value['id']; ?>">
<p style="margin-leftalign:55px">FIRST-NAME:<input type="text" name="firstname" value="<?php echo $read_value['first_name']; ?>"/><br/><br/>
LAST-NAME:<input type="text" name="lastname" value="<?php echo $read_value['last_name']; ?>"/><br/><br/>
EMAIL-ID:<input type="text" name="email" value="<?php echo $read_value['email_id']; ?>"/><br/><br/>
GENDER:<input type="radio" name="gender" value="male" <?php echo ($read_value['gender']=='male')?'checked':''?> />Male
<input type="radio" name="gender" value="female" <?php echo ($read_value['gender']=='female')?'checked':''?>/>Female<br/><br/>
MOBILE-NUMBER:<input type="text" name="phonenumber" value="<?php echo $read_value['phonenumber']; ?>"/><br/><br/>
IMAGE:<input type="file" name="image"/></p><br/><br/>
<input type="submit" name="submit" value="submit">
</form>
<div id ="form">
<div id ="content">
<table align="center">
<table border="1px">
<th>firstname</th>
<th>lastname</th>
<th>email</th>
<th>phonenumber</th>
<th>gender</th>
<th>image</th>
<th>edit</th>
<th>delete</th>
<th>password</th>
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
    <td><input type ='button' name ='edit' onclick="javascript:edit_form('<?php echo $row['id']; ?>')" value ="edit"></td>
    <td><input type ='button' name ='delete' onclick="javascript:delete_form('<?php echo $row['id']; ?>')" value ="delete"></td>
    
    </tr>
</table>
    <?php
   }
    ?>

</body>
</html>
<script>
    function edit_form(id){
         if(confirm('sure to edit')){
             window.location.href='index.php?edit_id=' +id;
           }
       }
   function delete_form(id){
         if(confirm('sure to delete')){
             window.location.href='index.php?delete_id=' +id;

           }
       }
</script>

