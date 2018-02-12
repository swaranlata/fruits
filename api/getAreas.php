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
$getAllAreas=getAllAreas();
if(!empty($getAllAreas)){   
   response(1,$getAllAreas,getTextByLang('No Error Found.',$data['lang']));   
}else{
   response(0,$array,getTextByLang('No data found.',$data['lang'])); 
}
?>