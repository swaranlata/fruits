<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/css/jquery.dataTables.css" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/css/bootstrap.min.css" >
    <script src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/jquery-1.9.1.min.js"></script>   
    <script src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/tether.min.js"></script>
    <script src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/jquery.dataTables.min.js"></script>
    <script src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/bootstrap.min.js"></script>
    <script src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/custom.js"></script>
  </head>
    <?php     
    function getCateringMessages(){
        global $wpdb;
        $messages=$wpdb->get_results('select * from `im_caterings` order by id desc',ARRAY_A);
        return $messages;
    }
    
    
    
    ?>