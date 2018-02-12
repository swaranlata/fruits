<?php
require '../wp-config.php';
$data = $_GET;
$data['lang']=qtranxf_getLanguage();
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
$loggedUser=AuthUser($data['userId'],array()); 
$getBillingAddresses=getBillingAddresses($data['userId']);
if(!empty($getBillingAddresses)){
   response(1,$getBillingAddresses,getTextByLang('No Error Found.',$data['lang']));   
}else{
   response(0,array(),getTextByLang('No data found.',$data['lang'])); 
}
?>