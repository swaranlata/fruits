<?php
require '../wp-config.php';
$data=$_GET;
$orderDetails = wc_get_order($_GET['orderId']);
$orderData = $orderDetails->get_data(); 
$items=$orderDetails->get_items(); 
if(!empty($items)){  
    $k=0;
    foreach($items as $item) 
    {   
        $product_id = $item['product_id'];
        $product_qty = $item['quantity'];                                
        $productDesc=get_post($product_id);
        $orders[$k]['total']=$orderData['total'];
        $orders[$k]['price']=(string)get_post_meta($product_id,'_regular_price',true);
        $orders[$k]['name']=get_the_title($product_id);
        $orders[$k]['quantity']= (string) $product_qty;          
        $k++;
    }      
}
echo json_encode(array('data'=>$orders));
die;
?>