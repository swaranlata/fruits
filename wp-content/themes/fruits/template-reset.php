<?php
/* Template Name: Reset Password */
get_header();
$crntLanguage=qtranxf_getLanguage();
global $post;
$token='';
$email='';
$temp=0;
$msg='';
if(isset($_GET['token']) and !empty($_GET['token'])){
  $token=$_GET['token'];  
}else{
      $temp=1;
}
if(isset($_GET['email']) and !empty($_GET['email'])){
  $email=$_GET['email'];   
  $getUserByEmail=get_user_by('email',$email);  
    if(empty($getUserByEmail)){
     $temp=1;   
    }
}else{
    $temp=1;
}
if(!empty($temp)){
  $msg=  'You are accessing the invalid reset password link.';
}
$getUserByEmail=get_user_by('email',$email);
if(!empty($getUserByEmail)){
   $getUserByEmail=convert_array($getUserByEmail); 
    $userId=$getUserByEmail['ID'];
    $token= get_user_meta($userId,'tokenfield',true);
    if($token!=$_GET['token']){
        $msg='You are accessing the invalid reset password link.';
    }
}

?>
    <div class="page-title-bar clearfix" style="background: url(<?php echo get_the_post_thumbnail_url($post->ID,'full'); ?>)">
        <h1>
            <?php echo $post->post_title; ?>
        </h1>
    </div>
    <div class="password-wrap">
        <div class="container">            
            <form  id="resetPassword" action="" method="post">
                <div id="response"></div>
                    <?php  if(!empty($msg)){  ?>
                     <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?php  echo $msg; ?></div>
                    <?php  } ?>
                <input type="hidden" name="action" value="reset_password"/>
                <input type="hidden" name="email" value="<?php  echo @$email; ?>"/>
                <div class="form-group clearfix">
                    <label for="exampleInputPass">New Password</label>
                    <input type="password"  id="newPassword"  name="newPassword" class="form-control">
                </div>
                <div class="form-group clearfix">
                    <label for="exampleInputPass">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control">
                </div>
    <?php            if(!empty($msg)){
   ?><button class="show btn btn-default" class="tryAgain" type="button">Try again</button>
                <?php
}else{
    ?><button class="show btn btn-default" type="submit">Submit</button>
                <?php
} ?>
                
            </form>
        </div>
        <!-- container -->
    </div>
    <?php get_footer(); ?>
