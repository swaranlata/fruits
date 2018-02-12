<?php 
include('includes/header.php');
?>
<link rel="stylesheet" href="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/css/bootstrap.min.css" >
<link type="text/css" href="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/css/jquery-ui.css" rel="stylesheet">
<div class="customAdmin">
    <h2>Add Catering Order</h2>
  
<div id="cateringResp"></div>
<form id="addCateringMessage" method="post">
      <div class="form-group">
          <input type="hidden" name="action" value="add_catering_message"/>
        <label for="inputEmail">Name</label>
        <input type="text" name="name" class="form-control"  placeholder="Name">
    </div>
    <div class="form-group">
        <label for="inputEmail">Email</label>
        <input type="email" name="email" class="form-control"  placeholder="Email">
    </div>
    <div class="form-group">
        <label for="inputEmail">Phone Number</label>
        <input type="text" maxLength="15" name="phoneNumber" class="form-control"  placeholder="Phone Number">
    </div>
     <div class="form-group">
        <label for="inputEmail">Description</label>
         <textarea name="description" class="form-control"  placeholder="Description"></textarea>
    </div><div class="form-group">
        <label for="inputEmail">Number of Attendees</label>
        <input type="number"  name="numberOfAttendees"  class="form-control"  placeholder="Number of Attendees">
    </div>
    <div class="form-group">
        <label for="inputEmail">Event date</label>
        <input type="text" name="dateOfEvent" id="eventDate" class="form-control" placeholder="Event date">
    </div>  
    <div class="form-group">
        <label for="inputEmail">Price</label>
        <input type="number" name="price" class="form-control" placeholder="Price">
    </div>  
    <button type="submit" name="Submit" value="Submit" class="btn btn-primary addCatOrder">Add Order</button>
</form>
 </div>
<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/jquery-1.12.3.min.js"></script> 
<script type='text/javascript' src='<?php  echo get_stylesheet_directory_uri(); ?>/js/jquery.validate.js?ver=4.8.4'></script>
<script type='text/javascript' src='<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/jquery-ui.js'></script>
<script>
$('#addCateringMessage').validate({
		rules: {
            name: {
				required: true
			},
			email: {
				required: true,
				email: true
			},
            phoneNumber: {
				required: true,
                number:true
			},
			description: {
				required: true
			},
            numberOfAttendees: {
				required: true
			},
            dateOfEvent: {
				required: true
			},
             price: {
				required: true
			}
            
		},		
		submitHandler: function(form) {           
			var formData = $("#addCateringMessage").serializeArray();
            $('.addCatOrder').attr('disabled','disabled');
            $('.loadingAdminLoader').show();
            $.ajax({
				data: formData,
				url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
				type: 'POST',
				dataType: 'json',
				success: function(response) { 
                    $('.loadingAdminLoader').hide();
                   if(response.success==1){
                      $('.addCatOrder').removeAttr('disabled');
                      $('#cateringResp').show();
                      $('#cateringResp').html('<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+response.error+'</div>');
                      $('#addCateringMessage')[0].reset();                       
                      setTimeout(function(){
                        $('#cateringResp').delay(2000).fadeOut();                                               
                      },4000);                    
                    }else{
                         $('.addCatOrder').removeAttr('disabled');
                      $('#cateringResp').show();
                      $('#cateringResp').html('<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+response.error+'</div>');
                      //$('#addCateringMessage')[0].reset(); 
                      setTimeout(function(){
                        $('#cateringResp').delay(2000).fadeOut();                                               
                      },4000);  
                    }
                   
				}
			});
		}
	});
    $('#eventDate').datepicker({
        minDate: 0,
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy"
       
	});
</script>