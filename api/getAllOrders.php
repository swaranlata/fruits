<?php
require '../wp-config.php';
$data = $_GET;
$data['lang']=qtranxf_getLanguage();
if(empty($data['lang'])){
 response(0,array(),getTextByLang('Please select language.',$data['lang']));   
}else{
    if(!in_array($data['lang'],array('en','ar'))){
      response(0,array(),getTextByLang('Please select correct language.',$data['lang']));   
    }    
}
if($data['offset']==''){
  response(0,array(),getTextByLang('Please enter the offset.',$data['lang']));   
}
$loggedUser=AuthUser($data['userId'],array());   
$getAllOrders=getAllOrders($data['userId'],'app',$data['offset']);
if(!empty($getAllOrders)){
   response(1,$getAllOrders,getTextByLang('No Error Found.',$data['lang']));   
}else{
   response(0,array(),getTextByLang('No data found.',$data['lang'])); 
}
?>