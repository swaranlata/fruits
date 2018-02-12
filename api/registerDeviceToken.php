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
if(empty($data['deviceToken'])){
   response(0,null,getTextByLang('Please enter the device token.',$data['lang']));  
}
if(empty($data['deviceType'])){
   response(0,null,getTextByLang('Please enter the device type.',$data['lang'])); 
}
$loggedUser=AuthUser($data['userId'],'string'); 
update_user_meta($data['userId'],'deviceToken',$data['deviceToken']);
update_user_meta($data['userId'],'deviceType',$data['deviceType']);
response(1, getTextByLang('Device token and type updated successfully.',$data['lang']), getTextByLang('No Error found.',$data['lang']));  
?>