jQuery(document).ready(function($){
    
   var orderstatus= $('#order_status').val();
    if(orderstatus=='wc-bad-order' || orderstatus=='wc-refunded'){
           $('#reasonMessage').attr('required',true);
    }else{
           $('#reasonMessage').removeAttr('required');
    }
   jQuery(document).on('change','#order_status',function(){
       var orderstatus=jQuery(this).val();
       if(orderstatus=='wc-bad-order' || orderstatus=='wc-refunded'){
           $('#reasonMessage').attr('required',true);
       }else{
           $('#reasonMessage').removeAttr('required');
       }   
   });
});