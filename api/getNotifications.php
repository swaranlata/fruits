<?php
require '../wp-config.php';
$data = $_GET;
global $wpdb;
$data['lang']=qtranxf_getLanguage();
if(empty($data['userId'])){
 response(0,array(),getTextByLang('Please enter user id.',$data['lang']));   
}
if(empty($data['lang'])){
 response(0,array(),getTextByLang('Please select language.',$data['lang']));   
}else{
    if(!in_array($data['lang'],array('en','ar'))){
      response(0,array(),getTextByLang('Please select correct language.',$data['lang']));   
    }    
}
$loggedInUser=AuthUser($data['userId'],array());
$query='select * from `im_notifications` where `opponentId`="'.$data['userId'].'" order by `created` desc';
$results=$wpdb->get_results($query,ARRAY_A);
$notifications=array();
if(!empty($results)){
    foreach($results as $k=>$v){
        $notifications[$k]['notificationId']=$v['id'];
        $notifications[$k]['userId']=$v['userId'];
        $notifications[$k]['name']=getUserName($v['userId']);
        $notifications[$k]['title']=$v['title'];
        $notifications[$k]['isRead']=$v['status'];
        $notifications[$k]['time']=getTiming(strtotime($v['created']));
    }
}
if(!empty($notifications)){
  response(1,$notifications,getTextByLang('No Error Found.',$data['lang']));    
}else{
  response(0,array(),getTextByLang('No Notifications found.',$data['lang']));    
}
?>
