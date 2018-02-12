<?php
require '../wp-config.php';
if(isset($_SERVER['REQUEST_METHOD']) and $_SERVER['REQUEST_METHOD']=='GET'){
  $data=$_GET;  
  $data['lang']=qtranxf_getLanguage();
}else{   
  $encoded_data = file_get_contents('php://input');
  $data = json_decode($encoded_data, true); 
}
if(empty($data['name'])){
   response(0,null,getTextByLang('Please enter your name.',$data['lang'])); 
}
if(empty($data['userId'])){
   response(0,null,getTextByLang('Please enter the user id.',$data['lang'])); 
}
if(empty($data['lang'])){
 response(0,null,getTextByLang('Please select language.',$data['lang']));   
}else{
    if(!in_array($data['lang'],array('en','ar'))){
      response(0,null,getTextByLang('Please select correct language.',$data['lang']));   
    }    
}
if(empty($data['email'])){
  response(0,null,getTextByLang('Please enter your email.',$data['lang']));  
}else{
     $emailValid=CheckValidEmail($data['email']);
     if(empty($emailValid)){
      response(0, null, getTextByLang('Please enter valid email address.',$data['lang']));   
     }      
}
if(empty($data['phoneNumber'])){
   response(0,null,getTextByLang('Please enter your phone.',$data['lang'])); 
}else{
    if(!is_numeric($data['phoneNumber'])){
     response(0,null,getTextByLang('Please enter valid phone number.',$data['lang'])); 
    }
}
if(empty($data['description'])){
   response(0,null,getTextByLang('Please enter description.',$data['lang'])); 
}
if(empty($data['numberOfAttendees'])){
   response(0,null,getTextByLang('Please enter number of attendees.',$data['lang'])); 
}
if(empty($data['dateOfEvent'])){
   response(0,null,getTextByLang('Please enter the date of event',$data['lang'])); 
}
$date=strtotime(inputChangeDate($data['dateOfEvent']));
$weekDate= strtotime(date('Y-m-d', strtotime('+1 Week')));
if($weekDate>$date){
  response(0,null,getTextByLang('Date must be one week before the event date.',$data['lang'])); 
}
$data['dateOfEvent']=$date;
AuthUser($data['userId'],'string');
$addCatering=addCatering($data,'app');
if(!empty($addCatering)){
    /* Send Email in catering */
    response(1,getTextByLang('catering message has been sent successfully.',$data['lang']),getTextByLang('No Error Found.',$data['lang'])); 
}else{
    response(0,null,getTextByLang('Something went wrong.Please try again.',$data['lang'])); 
}
?>