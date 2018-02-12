<?php
require '../wp-config.php';
echo get_field($_GET['type'],$_GET['product']);
die;
?>