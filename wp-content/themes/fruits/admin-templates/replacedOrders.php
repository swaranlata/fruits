<?php 
include('includes/header.php');  
global $wpdb;
$customer_orders =$wpdb->get_results('select * from `im_posts` where `post_status`="wc-bad-order" and `post_type`="shop_order" order by ID desc');
$totalprice=0;
if(!empty($customer_orders)){
   foreach($customer_orders as $k=>$v){
       $getUserDeta=get_post_meta($v->ID,'_customer_user',true);
       if(!empty($getUserDeta)){
         $user=get_user_by('id',$getUserDeta);   
       }else{
         $user=get_user_by('id',$v->post_author);  
       }        
       $orderDetails = wc_get_order($v->ID);
       $orderData = $orderDetails->get_data(); 
       $totalprice+=$orderData['total'];
   }
}
?>
<link type="text/css" href="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/css/jquery.dataTables.min.css" rel="stylesheet">
<link type="text/css" href="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/css/buttons.dataTables.min.css" rel="stylesheet">
<div class="customAdmin">
<h2>All Replaced Orders</h2><p class="amountAssigned" style="amountAssigned"> <strong>Total Amount </strong>: <?php echo $totalprice; ?> KD</p> 
<table id="example" class="display wp-list-table widefat" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Name</th>
            <th>Email</th>
            <th style="width:400px !important;">Address</th>
            <th>Date</th>
            <th>Amount</th>           
            <th>Action</th>           
        </tr>
    </thead>
   
    <tbody>
        <?php 
        $counter=1;
        if(!empty($customer_orders)){
           foreach($customer_orders as $k=>$v){
               $getUserDeta=get_post_meta($v->ID,'_customer_user',true);
               if(!empty($getUserDeta)){
                 $user=get_user_by('id',$getUserDeta);   
               }else{
                 $user=get_user_by('id',$v->post_author);  
               }
               $orderDetails = wc_get_order($v->ID);
               $orderData = $orderDetails->get_data();               
             ?>
            <tr id="post-<?php echo $v->ID; ?>">        
                <td><?php echo $counter; ?></td>
                <td>#<?php echo $v->ID.' Order by '.ucfirst($user->data->display_name).'<br>'.$user->data->user_email;?></td>
                <td><?php echo $user->data->user_email;?></td>
                <td><?php echo ucfirst($orderData['shipping']['first_name']).','.$orderData['shipping']['company'].','.$orderData['shipping']['address_1'].','.$orderData['shipping']['city'].','.$orderData['shipping']['state'].','.$orderData['shipping']['postcode'];?></td>
                <td><?php echo date('F d,Y',strtotime($v->post_date));?></td>           
                <td><?php echo $orderData['total'];?> KD</td>
                <td class="order_actions column-order_actions">                 
                     <p>
                     <a class="button tips view edit" title="Edit Details" href="<?php echo CUSTOM_ADMIN_URL.'post.php?post='.$v->ID.'&action=edit';?>"><i class="fa fa-pencil"></i></a>
                    </p>
                </td>           
            </tr> 
        <?php
          $counter++;
           } 
        }
        ?>
        
    </tbody>
     <tfoot>
        <tr>
            <th>Sr.No</th>
            <th>Name</th>
            <th>Email</th>
            <th style="width:400px !important;">Address</th>
            <th>Date</th>
            <th>Amount</th>           
            <th>Action</th>           
        </tr>
    </tfoot>
    
</table></div>
<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/jquery-1.12.3.min.js"></script> 
<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/buttons.html5.min.js"></script>
<script>
$(document).ready(function(){
    $('table.dataTable tr.odd').css('background','none');
    $('table.dataTable tr.odd td.sorting_1').css('background','none');
    $('table.dataTable tr.even td.sorting_1').css('background','none');
    $(document).on('click','.paginate_enabled_next',function(){
        $('table.dataTable tr.odd').css('background','none');
        $('table.dataTable tr.odd td.sorting_1').css('background','none');
        $('table.dataTable tr.even td.sorting_1').css('background','none');
    });
    $(document).on('click','.paginate_disabled_previous',function(){
        $('table.dataTable tr.odd').css('background','none');
        $('table.dataTable tr.odd td.sorting_1').css('background','none');
        $('table.dataTable tr.even td.sorting_1').css('background','none');
    });$(document).on('click','.paginate_enabled_previous',function(){
        $('table.dataTable tr.odd').css('background','none');
        $('table.dataTable tr.odd td.sorting_1').css('background','none');
        $('table.dataTable tr.even td.sorting_1').css('background','none');
    });
    $(document).on('click','.paginate_disabled_next',function(){
        $('table.dataTable tr.odd').css('background','none');
        $('table.dataTable tr.odd td.sorting_1').css('background','none');
        $('table.dataTable tr.even td.sorting_1').css('background','none');
    });
});
</script>