<?php 
include('includes/header.php');
$cateringMessage=getCateringMessages();

?>
  <?php 
$tm=0;
$exist=0;
$classE='notDelete';
if(!empty($cateringMessage)){
    $classE='deleteAllCatering';
   foreach($cateringMessage as $k=>$v){
       $exist=1;
       $tm+=$v['price'];
   }}
             ?>

<link rel="stylesheet" href="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/css/bootstrap.min.css">
<link type="text/css" href="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/css/jquery.dataTables.min.css" rel="stylesheet">
<link type="text/css" href="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/css/buttons.dataTables.min.css" rel="stylesheet">
<link type="text/css" href="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/css/jquery.mCustomScrollbar.css" rel="stylesheet">
<div class="customAdmin">
    <h2>All Catering Messages</h2>
    <a class="addCateringOrder" href="<?php echo site_url().'/wp-admin/admin.php?page=catering-add'; ?>">Add Catering Order</a> 
    
    <?php  ?>
    <a class="<?php echo $classE; ?>" href="javascript:void(0);">Delete All</a>     
    <div style="display:none" class="alert alert-success cateringResp" role="alert">
        Catering Message has been deleted.
    </div>
    <table id="exampleTable" class="display wp-list-table widefat  nowrap dataTable dtr-inline scrollbar" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Description</th>
                <th>Number of Attendees</th>
                <th>Date of Event</th>
                <th>Price</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th colspan="8" style="text-align:right">Total: <?php echo $tm; ?> KD</th>
                <th></th>

            </tr>
        </tfoot>
        <tbody>
            <?php 
        $counter=1;
        if(!empty($cateringMessage)){
           foreach($cateringMessage as $k=>$v){
             ?>
            <tr>
                <td>
                    <?php echo $counter; ?>
                </td>
                <td>
                    <?php echo $v['name'];?>
                </td>
                <td>
                    <?php echo $v['email'];?>
                </td>
                <td>
                    <?php echo $v['phoneNumber'];?>
                </td>
                <td>
                    <?php 
              $count=substr($v['description'],0,20);    
               if(strlen($count)>=20){
                 echo substr($v['description'],0,20).' ...';  
               }else{
                 echo substr($v['description'],0,20);  
               }
               ?>
                </td>
                <td>
                    <?php echo $v['numberOfAttendees'];?>
                </td>
                <td>
                    <?php echo date('d/m/Y',strtotime($v['dateOfEvent']));?>
                </td>
                <td class="<?php echo $v['id'];?>">
                    <?php echo $v['price'];?> KD</td>
                <td>
                    <?php echo date('d/m/Y',strtotime($v['created']));?>
                </td>
                <td><a href="javascript:void(0);" data-id="<?php echo $v['id'];?>" class="viewCateringMessage"><i class="fa fa-eye"></i></a>
                    <a href="javascript:void(0);" data-id="<?php echo $v['id'];?>" class="btn btn-primary editCateringMessage"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:void(0);" data-id="<?php echo $v['id'];?>" class="btn btn-primary deleteCateringMessage"><i class="fa fa-remove"></i>
                </a>
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
                <th>Phone Number</th>
                <th>Description</th>
                <th>Number of Attendees</th>
                <th>Date of Event</th>
                <th>Price</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>
<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/buttons.html5.min.js"></script>
<script src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/bootstrap.min.js"></script>
<script src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
    $(document).ready(function() {
        $("#exampleTable_wrapper").mCustomScrollbar({
            theme: "minimal-dark",
            axis: "x"
        });
        $('table.dataTable tr.odd').css('background', 'none');
        $('table.dataTable tr.odd td.sorting_1').css('background', 'none');
        $('table.dataTable tr.even td.sorting_1').css('background', 'none');
        $(document).on('click', '.paginate_enabled_next', function() {
            $('table.dataTable tr.odd').css('background', 'none');
            $('table.dataTable tr.odd td.sorting_1').css('background', 'none');
            $('table.dataTable tr.even td.sorting_1').css('background', 'none');
        });
        $(document).on('click', '.paginate_disabled_previous', function() {
            $('table.dataTable tr.odd').css('background', 'none');
            $('table.dataTable tr.odd td.sorting_1').css('background', 'none');
            $('table.dataTable tr.even td.sorting_1').css('background', 'none');
        });
        $(document).on('click', '.paginate_enabled_previous', function() {
            $('table.dataTable tr.odd').css('background', 'none');
            $('table.dataTable tr.odd td.sorting_1').css('background', 'none');
            $('table.dataTable tr.even td.sorting_1').css('background', 'none');
        });
        $(document).on('click', '.paginate_disabled_next', function() {
            $('table.dataTable tr.odd').css('background', 'none');
            $('table.dataTable tr.odd td.sorting_1').css('background', 'none');
            $('table.dataTable tr.even td.sorting_1').css('background', 'none');
        });
    });

</script>

<div class="modal fade" id="viewDesc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Catering Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label"><strong>Name:</strong></label>
                        <label for="recipient-name" class="form-control-label" id="cater-name"></label>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label"><strong>Email:</strong></label>
                        <label for="recipient-name" class="form-control-label" id="cater-email"></label>

                    </div>
                    <div class="form-group">
                        <label for="message-text" class="form-control-label"><strong>Message:</strong></label>
                        <label for="message-text" class="form-control-label" id="cater-msg"></label>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="form-control-label"><strong>Phone Number:</strong></label>
                        <label for="message-text" class="form-control-label" id="cater-phone"></label>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="form-control-label"><strong>Number of Attendees:</strong></label>
                        <label for="message-text" class="form-control-label" id="cater-number"></label>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="form-control-label"><strong>Date Of Event:</strong></label>
                        <label for="message-text" class="form-control-label" id="cater-date"></label>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="form-control-label"><strong>Price:</strong></label>
                        <label for="message-text" class="form-control-label" id="cater-price"></label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Send message</button>-->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditCateringMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Catering Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <div class="cateMessage"></div>
                <form>
                    <input type="hidden" name="id" id="catId" value="" />
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label"><strong>Name:</strong></label>
                        <label for="recipient-name" class="form-control-label" id="edit-name"></label>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label"><strong>Email:</strong></label>
                        <label for="recipient-name" class="form-control-label" id="edit-email"></label>

                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label"><strong>Event Date:</strong></label>
                        <label for="recipient-name" class="form-control-label" id="edit-date"></label>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label"><strong>Price:</strong></label>
                        <input type="text" class="form-control" id="edit-price">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="button button-default " data-dismiss="modal">Close</button>
                <button type="button" class="button button-primary saveCatering">Save</button>
            </div>
        </div>
    </div>
</div>
