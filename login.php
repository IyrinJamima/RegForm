<?php
/*ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);  */
include('db.php');
if(mysqli_connect_errno()){
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else{
    if(isset($_REQUEST['submit'])!=''){
        if($_REQUEST['username']=='' || $_REQUEST['password']==''){
            echo "please fill the empty field.";
        }else{
            $sql="select * from registration where email_id = ".$_GET['email_id'];
   
            $result_set = mysqli_qurry($con, $sql);
            $row = mysqli_fetch_assoc($result_set);
            if($row['password'] == $_REQUEST['password']){
            $_SESSION['email'] = $_REQUEST['email_id'];
            header('Location: home.php');
             }
           }
         } 
?>
<html>
   <head>
      <title>Login Page</title>
      </head>
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Registration</b></div>
				
            <div style = "margin:30px">
               <form action = "#" method = "post" enctype="multipart/form-data" align="center">
                  <label>UserName  :</label><input type = "text" name = "email_id"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password"/><br/><br />
                  <input type="submit" name="submit" value="submit">
                  <input type ='button' name ='registration' onclick="javascript:registration_form()" value="registration">
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>
<script>
function registration_form(){
         if(confirm('sure to login')){
             window.location.href='home.php';
           }
       }
</script>

