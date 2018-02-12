<?php
echo require '../../../../wp-config.php';
global $wpdb;
$type='';
if(isset($_GET['type'])){
  $type=$_GET['type'];  
}
if($type=='yearly'){
   $row=$wpdb->get_results('select * from `im_caterings` where YEAR(created) = YEAR(CURDATE())',ARRAY_A); 
}elseif($type=='last-month'){
   $row=$wpdb->get_results('select * from `im_caterings` WHERE YEAR(created) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(created) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)',ARRAY_A);
}elseif($type=='last-7-days'){
   $row=$wpdb->get_results('select * from `im_caterings` where  YEAR(created) = YEAR(CURRENT_DATE()) and created >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)',ARRAY_A);
}else{
   $row=$wpdb->get_results('select * from `im_caterings` WHERE MONTH(created) = MONTH(CURRENT_DATE())
AND YEAR(created) = YEAR(CURRENT_DATE())',ARRAY_A);
}
    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private', false);
    header('Content-Type: text/csv');
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header('Content-Disposition: attachment;filename=' . $fileName);    
    if(isset($assocDataArray['0'])){
        $fp = fopen('php://output', 'w');
        fputcsv($fp, array_keys($assocDataArray['0']));
        foreach($assocDataArray AS $values){
            fputcsv($fp, $values);
        }
        fclose($fp);
    }
    ob_flush();
?>
