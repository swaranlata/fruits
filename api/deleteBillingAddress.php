<?php
require '../wp-config.php';
global $wpdb;
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
if(empty($data['addressId'])){
   response(0,null,getTextByLang('Please enter address id.',$data['lang'])); 
}
if(empty($data['lang'])){
 response(0,null,getTextByLang('Please select language.',$data['lang']));   
}else{
    if(!in_array($data['lang'],array('en','ar'))){
      response(0,null,getTextByLang('Please select correct language.',$data['lang']));   
    }    
}
$loggedUser=AuthUser($data['userId'],'string'); 
$getAddress=get_user_meta($data['userId'],'wc_multiple_shipping_addresses',true);
$data['addressId']=$data['addressId']-1;
if(!isset($getAddress[$data['addressId']])){
    response(0,null,getTextByLang('No Address Found.',$data['lang'])); 
}
/*
$getAddress='select * from `im_billing_details` where `userId`="'.$data['userId'].'" and `id`="'.$data['addressId'].'"';
$row=$wpdb->get_row($getAddress,ARRAY_A);
if(empty($row)){
    response(0,null,getTextByLang('No Address Found.',$data['lang'])); 
} */
$deleteBillingAddress=deleteBillingAddress($data['addressId'],$data['userId'],'app');
if(!empty($deleteBillingAddress)){
   response(1,getTextByLang('Billing address deleted successfully.',$data['lang']),getTextByLang('No Error Found.',$data['lang']));   
}else{
   response(0,null,getTextByLang('Something went wrong.Please try again.',$data['lang'])); 
}
?>