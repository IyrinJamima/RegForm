<?php
   include('database.php');
/*ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);*/
   $response = new stdclass();
   if($_REQUEST['username'] == "" || $_REQUEST['password'] == ""){
       $response->message = "please fill the empty field";
       echo json_encode($response);
   }else{
      $sql = "select * from user where username = '".$_REQUEST['username']."'";
      $res = mysqli_query($db,$sql);
      $readvalue = mysqli_fetch_assoc($res);
      if($readvalue['password'] == $_REQUEST['password']){
        $response->data = $readvalue;
        $response->message = "login successful";
        echo json_encode($response);    
      }else{
        $response->message = "invalid username or password";
        echo json_encode($response);
      }
   }

 
?>
