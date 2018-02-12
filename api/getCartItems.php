<?php
require '../wp-config.php';
$data = $_GET;
$data['lang']=qtranxf_getLanguage();
$getCartProducts=getCartProducts($data['userId']);
echo json_encode(array('data'=>$getCartProducts));
die;
?>
