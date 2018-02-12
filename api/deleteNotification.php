<?php
require '../wp-config.php';
if(isset($_SERVER['REQUEST_METHOD']) and $_SERVER['REQUEST_METHOD']=='GET'){
  $data=$_GET;  
  $data['lang']=qtranxf_getLanguage();
}else{   
  $encoded_data = file_get_contents('php://input');
  $data = json_decode($encoded_data, true); 
}
if(empty($data['lang'])){
 response(0,null,getTextByLang('Please select language.',$data['lang']));   
}else{
    if(!in_array($data['lang'],array('en','ar'))){
      response(0,null,getTextByLang('Please select correct language.',$data['lang']));   
    }    
}
if(empty($data['userId'])){
     response(0,null,getTextByLang('Please enter user id.',$data['lang'])); 
}
global $wpdb;
if(empty($data['notificationId'])){
   response(0,null,getTextByLang('Please enter the notification id.',$data['lang']));   
}
$loggedInUser=AuthUser($data['userId'],'string',array(0,1));
$query='select * from `im_notifications` where `id`="'.$data['notificationId'].'" and `opponentId`="'.$data['userId'].'"';
$res=$wpdb->get_row($query,ARRAY_A);
if(!empty($res)){
   $query=$wpdb->query('delete from `im_notifications` where `id`="'.$res['id'].'"');
   response(1,getTextByLang('Notification deleted successfully.',$data['lang']),getTextByLang('No error found.',$data['lang'])); 
}else{
  response(0,null,getTextByLang('No Notification found to delete.',$data['lang'])); 
}

?>