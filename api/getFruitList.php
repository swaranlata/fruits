<?php
require '../wp-config.php';
$data = $_GET;
$data['lang']=qtranxf_getLanguage();
if($data['type']==''){
  response(0,array(),getTextByLang('Please enter the type.',$data['lang']));   
}else{
    if(!in_array($data['type'],array(0,1))){
       response(0,array(),getTextByLang('Please enter the valid type.',$data['lang']));    
    }
}
if($data['offset']==''){
  response(0,array(),getTextByLang('Please enter the offset.',$data['lang']));   
}
if(empty($data['lang'])){
 response(0,array(),getTextByLang('Please select language.',$data['lang']));   
}else{
    if(!in_array($data['lang'],array('en','ar'))){
      response(0,array(),getTextByLang('Please select correct language.',$data['lang']));   
    }    
}
if(!empty($data['userId'])){
 $loggedUser=AuthUser($data['userId'],array());    
}
$getProducts=getProducts($data['type'],$data['userId'],$data['offset']);
if(!empty($getProducts)){
   response(1,$getProducts,getTextByLang('No Error Found.',$data['lang']));   
}else{
   response(0,array(),getTextByLang('No data found.',$data['lang'])); 
}
?>