<?php
require '../wp-config.php';
if(isset($_SERVER['REQUEST_METHOD']) and $_SERVER['REQUEST_METHOD']=='GET'){
  $data=$_GET;  
  $data['lang']=qtranxf_getLanguage();
}else{   
  $encoded_data = file_get_contents('php://input');
  $data = json_decode($encoded_data, true); 
}
if(empty($data['email'])){
  response(0,null,getTextByLang('Please enter your email.',$data['lang']));  
}else{
     $emailValid=CheckValidEmail($data['email']);
     if(empty($emailValid)){
      response(0, null, getTextByLang('Please enter valid email address.',$data['lang']));   
     }      
}
if(empty($data['lang'])){
 response(0,null,getTextByLang('Please select language.',$data['lang']));   
}else{
    if(!in_array($data['lang'],array('en','ar'))){
      response(0,null,getTextByLang('Please select correct language.',$data['lang']));   
    }    
}
if(empty($data['password'])){
  response(0,null,getTextByLang('Please enter your password.',$data['lang']));  
}
if (!email_exists($data['email'])) {
   response(0, null, getTextByLang('Email is not registered with us.',$data['lang']));
}
$user_id=login($data,'app');
if(!empty($user_id)){
    $returnData=getUserDetails($user_id);    
    $returnData['cartCount']=getCartCount($user_id);
    response(1,$returnData,getTextByLang('No Error Found.',$data['lang']));  
}else{
   response(0,null,getTextByLang('Invalid email and password combination.',$data['lang']));      
}
?>
