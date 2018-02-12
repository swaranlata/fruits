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
if(empty($data['userId'])){
   response(0,array(),getTextByLang('Please enter user id.',$data['lang'])); 
}
$loggedUser=AuthUser($data['userId'],array()); 
$getCartProducts=getCartProducts($data['userId']);
$addressList=getAddressList($data['userId']);
/*$url=site_url().'/api/getCartItems.php?userId='.$data['userId'].'&lang=en';
$getCartProducts=json_decode(file_get_contents($url),true);
$array['enBasketList']=array();
$array['arBasketList']=array();
if(!empty($getCartProducts['data'])){
    $array['enBasketList']=$getCartProducts['data'];
}
$arurl=site_url().'/api/getCartItems.php?userId='.$data['userId'].'&lang=ar';
$argetCartProducts=json_decode(file_get_contents($arurl),true);
if(!empty($argetCartProducts['data'])){
    $array['arBasketList']=$argetCartProducts['data'];
}*/
if(!empty($getCartProducts)){    
    $array['basketList']=$getCartProducts;
    $array['addressList']=$addressList;
    response(1,$array,getTextByLang('No Error Found.',$data['lang']));   
}else{
    $array['basketList']=array();
    $array['addressList']=$addressList;
   response(0,$array,getTextByLang('No data found.',$data['lang'])); 
}
?>