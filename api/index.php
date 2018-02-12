<?php
require '../wp-config.php';
$user=get_users();
foreach($user as $k=>$v){
   // update_user_meta($v->ID,'meta-box-order_dashboard','a:4:{s:6:"normal";s:75:"dashboard_browser_nag,example_dashboard_widget,woocommerce_dashboard_status";s:4:"side";s:0:"";s:7:"column3";s:0:"";s:7:"column4";s:0:"";}');
    update_user_meta($v->ID,'meta-box-order_dashboard','a:2:{i:0;s:19:"woocommerce_dashboard_status";i:1;s:17:"example_dashboard_widget";}');

}
die;

pr($user);








$productItems=get_field('select_product', 591);
if(!empty($productItems)){
    foreach($productItems as $k=>$v){
       echo $fruitID=get_the_title($v['fruit_name'][0]->ID);
       //echo $fruitWeight=$v['weight'];
    }
}

pr($data);

?>