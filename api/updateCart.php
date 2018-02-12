<?php
require '../wp-config.php';
if(isset($_SERVER['REQUEST_METHOD']) and $_SERVER['REQUEST_METHOD']=='GET'){
  $data=$_GET;  
  $data['lang']=qtranxf_getLanguage();
}else{   
  $encoded_data = file_get_contents('php://input');
  $data = json_decode($encoded_data, true); 
}
global $wpdb;
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
if(empty($data['itemsList'])){
   response(0,null,getTextByLang('Please select some products to update the cart.',$data['lang']));    
}
 $temp=0;
foreach($data['itemsList'] as $k=>$v){    
    $isCartItem = isCartItem($v['itemId'],$data['userId']);
    if(!empty($isCartItem)){
        $temp=1;
      $wpdb->query('update `im_cart` set `quantity`="'.$v['quantity'].'",`price`="'.$v['price'].'" where `productId`="'.$v['itemId'].'" and `userId`="'.$data['userId'].'"');  
    }
}
if(empty($temp)){
 response(0,null,getTextByLang('No products in the cart.',$data['lang']));   
}
response(1,getTextByLang('Cart updated successfully.',$data['lang']),getTextByLang('No Error Found.',$data['lang']));







?>