<?php
include('database.php');
#print_r($_REQUEST);
if($_REQUEST['name']=='' || $_REQUEST['username']=='' || $_REQUEST['password']==''){
    echo "please fill the empty field";
}else{
    $sql = "select count(id) as count from user where username = '".$_REQUEST['username']."'";
    $result = mysqli_query($db,$sql);
    $read_value = mysqli_fetch_assoc($result);
    //echo $read_value['count'];
    //print_r($read_value);
    if($read_value['count'] > 0){
         $response = new stdClass();
         $response->data = $read_value;
         $response->message = "this username or password already exists";
         echo json_encode($response);
    }else{
       $sql = "insert into user (name,username,password) values ('".$_REQUEST['name']."','".$_REQUEST['username']."','".$_REQUEST['password']."')";
       $result = $db->query($sql);
       echo "Inserted Successfully";
       }      
    
}
?>
