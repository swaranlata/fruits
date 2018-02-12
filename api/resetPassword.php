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
if(empty($data['currentPassword'])){
     response(0,null,getTextByLang('Please enter your current password.',$data['lang'])); 
}
if(empty($data['newPassword'])){
     response(0,null,getTextByLang('Please enter your new password.',$data['lang'])); 
}
$loggedInUser=AuthUser($data['userId'],'string');
$loggedInUser=convert_array($loggedInUser);
$checkOldPassword=resetPassword($data,'app');
if(!empty($checkOldPassword)){
   wp_set_password($data['newPassword'],$data['userId']); 
   response(1,getTextByLang('Your password has been updated.',$data['lang']),getTextByLang('No Error Found.',$data['lang'])); 
}else{
   response(0,null,getTextByLang('You have entered incorrect old Password.',$data['lang'])); 
}
    

?>