<?php
require '../wp-config.php';
$data = $_REQUEST;
$data['lang']=qtranxf_getLanguage();
if(empty($data['lang'])){
 response(0,array(),getTextByLang('Please select language.',$data['lang']));   
}else{
    if(!in_array($data['lang'],array('en','ar'))){
      response(0,array(),getTextByLang('Please select correct language.',$data['lang']));   
    }    
}
$getSliderImages=getSliderImages();
if(!empty($getSliderImages)){
  $allData['sliderImage']=$getSliderImages;
    if(!empty($data['userId'])){
       $allData['cartCount']=getCartCount($data['userId']);   
    }else{
       $allData['cartCount']="0"; 
    }  
  response(1,$allData,getTextByLang('No Error Found.',$data['lang']));   
}else{
   response(0,array(),getTextByLang('No data found.',$data['lang'])); 
}
?>