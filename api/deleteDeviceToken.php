<?php
require '../wp-config.php';
if(isset($_SERVER['REQUEST_METHOD']) and $_SERVER['REQUEST_METHOD']=='GET'){
  $data=$_GET;  
  $data['lang']=qtranxf_getLanguage();
}else{   
  $encoded_data = file_get_contents('php://input');
  $data = json_decode($encoded_data, true); 
}
if(empty($data['userId'])){
   response(0,null,getTextByLang('Please enter user id.',$data['lang']));  
}
if(empty($data['lang'])){
 response(0,null,getTextByLang('Please select language.',$data['lang']));   
}else{
    if(!in_array($data['lang'],array('en','ar'))){
      response(0,null,getTextByLang('Please select correct language.',$data['lang']));   
    }    
}
$loggedUser=AuthUser($data['userId'],'string'); 
update_user_meta($data['userId'],'deviceToken','');
update_user_meta($data['userId'],'deviceType','');
response(1, getTextByLang('Device token and type deleted successfully.',$data['lang']), getTextByLang('No Error found.',$data['lang']));  
?>