<?php 
session_start();
global $wpdb;
$customer_orders = get_posts(
    array(
       'numberposts' => -1,
       'post_type'   => wc_get_order_types(),
       'post_status' => array('wc-pending'),
        'orderby' => 'date',
        'order' => 'DESC'
    )
 );
if($_SESSION['productsCount']<count($customer_orders)){
 $_SESSION['productsCount']=count($customer_orders);
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
<p style="amountAssigned"> <strong>Total Amount </strong>:
        <?php echo $totalprice; ?> KD</p>
    <table id="example" class="display wp-list-table widefat dynamicContent" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Email</th>
                <th style="width:400px !important;">Address</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php 
        $counter=1;
        if(!empty($customer_orders)){
           foreach($customer_orders as $k=>$v){
               $orderStatus=get_post($v->ID);
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
                <td>
                    <?php echo $counter; ?>
                </td>
                <td>#
                    <?php echo $v->ID.' Order by '.ucfirst($user->data->display_name).'<br>'.$user->data->user_email;?></td>
                <td>
                    <?php echo $user->data->user_email;?>
                </td>
                <td>
                    <?php echo ucfirst($orderData['billing']['first_name']).','.$orderData['billing']['company'].','.$orderData['billing']['address_1'].','.$orderData['billing']['city'].','.$orderData['billing']['state'].','.$orderData['billing']['postcode'];?>
                </td>
                <td>
                    <?php echo date('F d,Y',strtotime($v->post_date));?>
                </td>
                <td>
                    <?php echo $orderData['total'];?> KD</td>
                <td>Pending Payment</td>
                <td class="order_actions column-order_actions">
                    <p>
                        <?php if($orderStatus->post_status=='wc-pending'){
                    ?>
                         <a title="Processing" class="button tips processing checkProcessingState" href="<?php echo wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=processing&order_id=' . $v->ID ), 'woocommerce-mark-order-status' ); ?>" data-attr-val="<?php echo wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=processing&order_id=' . $v->ID ), 'woocommerce-mark-order-status' ); ?>">Processing</a>
                         <a title="Cancelled" class="button tips view parcial" href="<?php echo wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=cancelled&order_id=' . $v->ID ), 'woocommerce-mark-order-status' ); ?>">Cancelled</a>
                        <?php
                 
             }elseif($orderStatus->post_status=='wc-processing'){
                 ?>
                         <a title="Complete" class="button tips complete" href="<?php echo wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=completed&order_id=' . $v->ID ), 'woocommerce-mark-order-status' ); ?>">Complete</a>
                         <a title="Cancelled" class="button tips view parcial" href="<?php echo wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=cancelled&order_id=' . $v->ID ), 'woocommerce-mark-order-status' ); ?>">Cancelled</a>
                        <?php
                 
             }elseif($orderStatus->post_status=='wc-completed'){
                 ?>
                        <a title="Refund Order" class="button tips view refund" href="<?php echo wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=refunded&order_id=' . $v->ID ), 'woocommerce-mark-order-status' ); ?>">Refund Order</a>
                        <a title="Replace Order" class="button tips view replace" href="<?php echo wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=bad-order&order_id=' . $v->ID ), 'woocommerce-mark-order-status' ); ?>">Replace Order</a>
                        <?php
             }
                        ?>
                       

                       
                       
                         <a class="button tips view edit" title="Edit Details" href="<?php echo CUSTOM_ADMIN_URL.'post.php?post='.$v->ID.'&action=edit';?>"><i class="fa fa-pencil"></i></a>



                     <!--   <a class="button tips view view1" title="View Details" href="<?php //echo CUSTOM_ADMIN_URL.'post.php?post='.$v->ID.'&action=edit';?>"><i class="fa fa-eye"></i></a>-->
                       
                    </p>
                    	
                </td>
            </tr>
            <?php
          $counter++;
           } 
        }
        ?>

        </tbody>
       <!-- <tfoot>
            <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Email</th>
                <th style="width:400px !important;">Address</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </tfoot>-->

    </table>
<?php    
} ?>