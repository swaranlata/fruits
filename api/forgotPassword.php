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
if (!email_exists($data['email'])) {
   response(0, null, getTextByLang('Email is not registered with us.',$data['lang']));
}
$user=get_user_by('email',$data['email']);
if(!empty($user)){
    $user=convert_array($user);    
    $password=randomString(8);
    wp_set_password($password,$user['ID']);  
    $name=$user['data']['display_name'];
    $to = $data['email'];
    $subject = 'Password Update';
    $message='You have requested for password change,your new password has been updated, <br> New Password : '.$password.'<br> Login with your new password.';
    $emailTemplate=file_get_contents(get_stylesheet_directory_uri().'/email-template.php');
    $emailTemplate=str_replace('[NAME]',$name,$emailTemplate);
    $emailTemplate=str_replace('[MESSAGE]',$message,$emailTemplate);
    send_email($to,'New Password Updation',$emailTemplate);  
    response(1,getTextByLang('Your new password has been sent to your registered email id.',$data['lang']),getTextByLang('No Error Found.',$data['lang']));     
}
?>
