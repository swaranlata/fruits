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
if(empty($data['itemsList'])){
  response(0,null,getTextByLang('Please enter item list.',$data['lang']));  
}
if(empty($data['deliveryAddress'])){
  response(0,null,getTextByLang('Please enter address id.',$data['lang']));  
}
if(empty($data['totalPayble'])){
  response(0,null,getTextByLang('Please enter total amount to pay.',$data['lang']));  
}
if($data['paymentType']==''){
  response(0,null,getTextByLang('Please select payment mode.',$data['lang']));  
}else{
    if(!in_array($data['paymentType'],array(0,1))){
       response(0,null,getTextByLang('Please select valid payment mode.',$data['lang']));   
    }
}
if(empty($data['userId'])){
  response(0,null,getTextByLang('Please enter user id.',$data['lang']));  
}
$loggedUser=AuthUser($data['userId'],'string'); 
$confirmOrder=confirmOrder($data,'app');    
if(!empty($confirmOrder)){
  response(1,$confirmOrder,getTextByLang('Order successfull.',$data['lang']));  
}else{
    
  response(0,null,getTextByLang('Something went wrong.Please try again.',$data['lang']));   
}



?>
