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
if(empty($data['addressTitle'])){
   response(0,null,getTextByLang('Please enter your address title.',$data['lang'])); 
}
if(empty($data['area'])){
   response(0,null,getTextByLang('Please enter your area.',$data['lang'])); 
}
if($data['addressType']==''){
   response(0,null,getTextByLang('Please enter your address type.',$data['lang'])); 
}else{
    if(!in_array($data['addressType'],array(0,1,2))){
      response(0,null,getTextByLang('Please enter valid address type.',$data['lang']));    
    }
}
if(empty($data['block'])){
   response(0,null,getTextByLang('Please enter your block.',$data['lang'])); 
}
if(empty($data['street'])){
   response(0,null,getTextByLang('Please enter your street.',$data['lang'])); 
}
if(empty($data['addressType'])){//home
   if(empty($data['house'])){
    response(0,null,getTextByLang('Please enter your house.',$data['lang'])); 
   }     
}elseif($data['addressType']=='1'){//appartment
    if(empty($data['building'])){
      response(0,null,getTextByLang('Please enter your building.',$data['lang'])); 
    }
    if(empty($data['floor'])){
       response(0,null,getTextByLang('Please enter your floor.',$data['lang'])); 
    }
    if(empty($data['apartmentNumber'])){
       response(0,null,getTextByLang('Please enter your appartment number.',$data['lang'])); 
    }      
}else{//office
     if(empty($data['building'])){
      response(0,null,getTextByLang('Please enter your building.',$data['lang'])); 
    }
    if(empty($data['floor'])){
       response(0,null,getTextByLang('Please enter your floor.',$data['lang'])); 
    }
    if(empty($data['office'])){
        response(0,null,getTextByLang('Please enter your office.',$data['lang'])); 
    }
}
if(empty($data['avenue'])){
   //response(0,null,getTextByLang('Please enter your avenue.',$data['lang'])); 
}
if(empty($data['additionalDirections'])){
   response(0,null,getTextByLang('Please enter additional directions.',$data['lang'])); 
}
if(empty($data['phoneNumber'])){
   response(0,null,getTextByLang('Please enter phone number.',$data['lang'])); 
}if(empty($data['postalCode'])){
   //response(0,null,getTextByLang('Please enter postal code.',$data['lang'])); 
}
$loggedUser=AuthUser($data['userId'],'string'); 
$addBillingAddress=addBillingAddress($data,'app');
if(!empty($addBillingAddress)){
   response(1,getTextByLang('Billing address added successfully.',$data['lang']),getTextByLang('No Error Found.',$data['lang']));   
}else{
    response(0,null,getTextByLang('Something went wrong.Please try again.',$data['lang'])); 
}
?>