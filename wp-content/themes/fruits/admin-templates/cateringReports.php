<?php 
include('includes/header.php');
function getLastNDays($days, $format = 'Y-m-d'){
    $m = date("m"); $de= date("d"); $y= date("Y");
    $dateArray = array();
    for($i=0; $i<=$days-1; $i++){
        $dateArray[] = date($format, mktime(0,0,0,$m,($de-$i),$y)); 
    }
    return array_reverse($dateArray);
}
$arr = getLastNDays(7);
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
$dataSet='';
if(isset($_GET['start_date']) and !empty($_GET['start_date'])  and isset($_GET['end_date']) and !empty($_GET['end_date'])){   
    $dataSet='check';
    $startDate=date('Y-m-d',strtotime($_GET['start_date']));
    $stop_date = date('Y-m-d H:i:s', strtotime($_GET['end_date'] . ' +1 day'));
    $end_date=date('Y-m-d',strtotime($stop_date)); 
    if(date('Y',strtotime($_GET['start_date']))==date('Y',strtotime($end_date))){
        if(date('Y-m',strtotime($_GET['start_date']))==date('Y-m',strtotime($end_date))){
            $graphType='singleMonth';  
        }else{
           $graphType='singleYear';   
        }          
    }else{
        $graphType='multiYear';  
    }
    $row=$wpdb->get_results('select * from `im_caterings` WHERE created BETWEEN "'.$startDate.'" and "'.$end_date.'"',ARRAY_A);  
   
}
?>
<style>
    #container {
        min-width: 310px;
        max-width: 800px;
        height: 400px;
        margin: 0 auto
    }

</style>
<link rel="stylesheet" href="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/css/bootstrap.min.css">

<link type="text/css" href="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/css/jquery-ui.css" rel="stylesheet">

<div class="customAdmin">
    <h2>Catering Reports</h2>
    <div class="stats_range clearfix">
        <ul class="list-inline">
            <li class="<?php if($type=='yearly'){
    echo 'active';
}?>"><a href="<?php echo site_url().'/wp-admin/admin.php?page=catering-reports&type=yearly'; ?>">Year</a></li>
            <li class="<?php if($type=='last-month'){
    echo 'active';
}?>"><a href="<?php echo site_url().'/wp-admin/admin.php?page=catering-reports&type=last-month'; ?>">Last month</a></li>
            <li class="<?php if($type==''){
    echo 'active';
}?>"><a href="<?php echo site_url().'/wp-admin/admin.php?page=catering-reports'; ?>">This month</a></li>
            <li class="<?php if($type=='last-7-days'){
    echo 'active';
}?>"><a href="<?php echo site_url().'/wp-admin/admin.php?page=catering-reports&type=last-7-days'; ?>">Last 7 days</a></li>
            <li class="custom <?php if($type=='catering-reports'){
    echo 'active';
}?>" >
                Custom:
                <form method="GET" action="">
                  <div>  
                        <input type="hidden" name="page" value="catering-reports"/>
                        <input type="hidden" name="type" value="catering-reports"/>
                        <input type="text" id="startDate" class="range_datepicker" name="start_date"
                               value="<?php  if(isset($_GET['start_date']) and !empty($_GET['start_date'])){
                               echo $_GET['start_date'];                                                                                 
                            }
                       ?>" placeholder="mm/dd/yyyy" size="11" >
                        <span>&ndash;</span>
                        <input type="text"  id="endDate"  class="range_datepicker" name="end_date" value="<?php  if(isset($_GET['end_date']) and !empty($_GET['end_date'])){
                               echo $_GET['end_date'];                                                                                 
                            }
                       ?>" placeholder="mm/dd/yyyy" size="11">
                        <input type="submit" value="Go" class="button">
                  </div>
                </form>
            </li>
        </ul>
    </div>
    <?php 
    $url='';
    if($_GET['type']=='catering-reports'){
                $url='&start_date='.$_GET['start_date'].'&end_date='.$_GET['end_date'];
       }
    if(!empty($row)){
       ?>
 <a class="exporting" href="<?php echo site_url(); ?>/wp-admin/admin.php?page=export_csv&type=<?php echo $type.$url; ?>">export csv</a>
    <?php
    }else{?>
     <a class="exportError" href="javascript:void(0);">export csv</a>
    <?php        
    }
    ?>
   
</div>
<div id="container"></div>

<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/jquery-1.12.3.min.js"></script>
<script src="<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/bootstrap.min.js"></script>
<script type='text/javascript' src='<?php  echo get_stylesheet_directory_uri(); ?>/admin-templates/js/jquery-ui.js'></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script>
    jQuery(document).ready(function(){
        jQuery(document).on('click','.exportError',function(){
            alert('No Records found to export.');
            return false;            
        });
         jQuery('#startDate').datepicker({
              maxDate: 0,
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1
         });
         jQuery('#endDate').datepicker({
               maxDate: 0,
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1
         }); 
    });  
    <?php 
    if(!empty($dataSet)){
        if($graphType=='singleYear'){
            $array=array();
            $numberOfAttendees=array();
            if(!empty($row)){    
                $months=array(1,2,3,4,5,6,7,8,9,10,11,12);
                foreach($months as $kk=>$vv){
                    $count=0;
                    $countNumber=0;
                    $userNumber=0;
                    foreach($row as $k=>$v){
                        $created=date('m',strtotime($v['created']));
                        if($vv==$created){
                            $count += $v['price'];
                            $countNumber += $v['numberOfAttendees'];
                            $userNumber++;
                        }                  
                    }
                    $array[$vv] = $count; 
                    $numberOfAttendees[] = $countNumber; 
                    $userArray[] = $userNumber; 
                }

            }  
        ?>
            Highcharts.chart('container', {
        credits: {
            enabled: false
        },
        chart: {
            type: 'line'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            min: 0,
            tickInterval: 100,
            title: {
                text: 'Price and Number of attendees Values'

            }

        },
        title: {
            text: 'Catering Orders'
        },

        plotOptions: {
            series: {
                minPointLength: 3
            }
        },

        series: [{
            name: 'Price',
            data: [<?php echo $string= implode(',',$array); ?>]
        }, {
            name: 'Number of attendees',
            data: [<?php echo $string= implode(',',$numberOfAttendees); ?>]
        },{
            name: 'Number of applications for Catering',
            data: [<?php echo $string= implode(',',$userArray); ?>]
        }]
    });
        <?php
        }
        elseif($graphType=='singleMonth'){            
            $getFullDate= $startDate;
            $firstDay= date("d", strtotime($_GET['start_date']));
            $lastDay= date("d",strtotime($_GET['end_date'])); 
            $list=array();
            $month = date('m',strtotime($getFullDate));
            $year = date('Y',strtotime($getFullDate));
            $array=array();
            $arrayAttendees=array();
            for($d=$firstDay; $d<=$lastDay; $d++){                
                 $price=0;
                 $numberOfAttendees=0;
                $userNumber=0;
                 $time=strtotime($year.'-'.$month.'-'.$d); 
                 $date=date('Y-m-d', $time);
                 foreach($row as $k=>$v){                   
                        if(trim($date)==trim(date('Y-m-d',strtotime($v['created'])))){
                          $price +=$v['price'];
                          $numberOfAttendees += $v['numberOfAttendees'];
                            $userNumber++;
                        }
                }  
                $array[date('d M', $time)]=$price;
                $arrayAttendees[date('d M', $time)]=$numberOfAttendees;
                $userArray[date('d M', $time)]=$userNumber;
                $list[]=date('d M', $time);    
               
            }
                            
        ?>
    Highcharts.chart('container', {
        credits: {
            enabled: false
        },
        chart: {
            type: 'line'
        },
        xAxis: {
            categories: ["<?php echo $string= implode('", "',$list); ?>"]
        },
        yAxis: {
            min: 0,
            tickInterval: 100,
            title: {
                text: 'Price and Number of attendees Values'

            }
        },
        title: {
            text: 'Catering Orders'
        },

        plotOptions: {
            series: {
                minPointLength: 3
            }
        },
        series: [{
            name: 'Price',
            data: [<?php echo $string= implode(',',$array); ?>]
        }, {
            name: 'Number of attendees',
            data: [<?php echo $string= implode(',',$arrayAttendees); ?>]
        }, {
            name: 'Number of applications for Catering',
            data: [<?php echo $string= implode(',',$userArray); ?>]
        }
    ]
    });
    <?php

        }else{
            $getFullDate= $startDate;
            $firstDay= date("Y", strtotime($_GET['start_date']));
            $lastDay= date("Y",strtotime($_GET['end_date'])); 
            $list=array();
            $month = date('m',strtotime($getFullDate));
            $year = date('Y',strtotime($getFullDate));
            $array=array();
            $arrayAttendees=array();
            for($d=$firstDay; $d<=$lastDay; $d++){                
                 $price=0;
                 $userNum=0;
                 $numberOfAttendees=0;
                 $time=strtotime($year.'-'.$month.'-'.$d); 
                 $date=date('Y-m-d', $time);
                 foreach($row as $k=>$v){                   
                    if($d==date('Y',strtotime($v['created']))){
                      $price +=$v['price'];
                      $numberOfAttendees += $v['numberOfAttendees'];
                        $userNum++;
                    }
                }  
                $array[$d]=$price;
                $arrayAttendees[$d]=$numberOfAttendees;
                $userArray[$d]=$userNum;
                $list[]=$d;   
            }            
            ?>
       Highcharts.chart('container', {
        credits: {
            enabled: false
        },
        chart: {
            type: 'line'
        },
        xAxis: {
            categories: [<?php echo implode(',',$list); ?>]
        },
        yAxis: {
            min: 0,
            tickInterval: 100,
            title: {
                text: 'Price and Number of attendees Values'

            }

        },
        title: {
            text: 'Catering Orders'
        },

        plotOptions: {
            series: {
                minPointLength: 3
            }
        },

        series: [{
            name: 'Price',
            data: [<?php echo $string= implode(',',$array); ?>]
        }, {
            name: 'Number of attendees',
            data: [<?php echo $string= implode(',',$arrayAttendees); ?>]
        }, {
            name: 'Number of applications for Catering',
            data: [<?php echo $string= implode(',',$userArray); ?>]
        }]
    });
    
    
    <?php
            
            
            
        }
    }else{
    if($type=='yearly'){  
    $array=array();
    $numberOfAttendees=array();
    if(!empty($row)){    
        $months=array(1,2,3,4,5,6,7,8,9,10,11,12);
        foreach($months as $kk=>$vv){
            $count=0;
            $countNumber=0;
            $userNum=0;
            foreach($row as $k=>$v){
                $created=date('m',strtotime($v['created']));
                if($vv==$created){
                    $count+=$v['price'];
                    $countNumber+=$v['numberOfAttendees'];
                    $userNum++;
                }                  
            }
            $array[$vv] = $count; 
            $userArray[$vv] = $userNum; 
            $numberOfAttendees[] = $countNumber; 
        }

    }  
?>
    Highcharts.chart('container', {
        credits: {
            enabled: false
        },
        chart: {
            type: 'line'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            min: 0,
            tickInterval: 100,
            title: {
                text: 'Price and Number of attendees Values'

            }

        },
        title: {
            text: 'Catering Orders price by Current Year'
        },

        plotOptions: {
            series: {
                minPointLength: 3
            }
        },

        series: [{
            name: 'Price',
            data: [<?php echo $string= implode(',',$array); ?>]
        }, {
            name: 'Number of attendees',
            data: [<?php echo $string= implode(',',$numberOfAttendees); ?>]
        }, {
             name: 'Number of applications for Catering',
            data: [<?php echo $string= implode(',',$userArray); ?>]
        }]
    });
    <?php }
    elseif($type=='last-month'){
    $getFullDate= date("Y-m-d", strtotime("first day of previous month"));
    $firstDay= date("d", strtotime("first day of previous month"));
    $lastDay= date("d", strtotime("last day of previous month")); 
    $list=array();
    $month = date('m',strtotime($getFullDate));
    $year = date('y',strtotime($getFullDate));
    $array=array();
    $arrayAttendees=array();
    for($d=$firstDay; $d<=$lastDay; $d++)
    {
    $price=0;
    $numberOfAttendees=0;
        $userNum=0;
    $time=strtotime($year.'-'.$month.'-'.$d); 
    foreach($row as $k=>$v){
        if(date('Y-m-d', $time)==date('Y-m-d',strtotime($v['created']))){
          $price  +=$v['price'];
          $numberOfAttendees +=$v['numberOfAttendees'];
            $userNum++;
        }
    }       
    $array[date('d M', $time)] =$price;
        $userArray[date('d M', $time)] = $userNum; 
    $arrayAttendees[date('d M', $time)]=$numberOfAttendees;
    if (date('m', $time)==$month)       
        $list[]=date('d M', $time);
    } 

    ?>
    Highcharts.chart('container', {
        credits: {
            enabled: false
        },
        chart: {
            type: 'line'
        },
        xAxis: {
            categories: ["<?php echo $string= implode('", "',$list); ?>"]
        },
        yAxis: {
            min: 0,
            tickInterval: 100,
            title: {
                text: 'Price and Number of attendees Values'

            }

        },
        title: {
            text: 'Catering Orders by last month'
        },

        plotOptions: {
            series: {
                minPointLength: 3
            }
        },

        series: [{
            name: 'Price',
            data: [<?php echo $string= implode(',',$array); ?>]
        }, {
            name: 'Number of attendees',
            data: [<?php echo $string= implode(',',$arrayAttendees); ?>]
        }, {
             name: 'Number of applications for Catering',
            data: [<?php echo $string= implode(',',$userArray); ?>]
        }]
    });

    <?php

    }
    elseif($type=='last-7-days'){
        $list=array();
        $array=array();
        $arrayAttendees=array();
        foreach($arr as $kk=>$vv)
        {
            $price=0;
            $userNum=0;
            $numberOfAttendees=0;
            $time=strtotime($vv); 
            foreach($row as $k=>$v){
                if($vv==date('Y-m-d',strtotime($v['created']))){
                  $price  +=$v['price'];
                  $numberOfAttendees +=$v['numberOfAttendees'];
                    $userNum++;
                }
            }       
            $array[date('d M', $time)] =$price;
            $userArray[date('d M', $time)] =$userNum;
            $arrayAttendees[date('d M', $time)]=$numberOfAttendees;             
            $list[]=date('d M', $time);
        }
         ?>
    Highcharts.chart('container', {
        credits: {
            enabled: false
        },
        chart: {
            type: 'line'
        },
        xAxis: {
            categories: ["<?php echo $string= implode('", "',$list); ?>"]
        },
        yAxis: {
            min: 0,
            tickInterval: 100,
            title: {
                text: 'Price and Number of attendees Values'

            }

        },
        title: {
            text: 'Catering Orders by last 7 days'
        },

        plotOptions: {
            series: {
                minPointLength: 3
            }
        },

        series: [{
            name: 'Price',
            data: [<?php echo $string= implode(',',$array); ?>]
        }, {
            name: 'Number of attendees',
            data: [<?php echo $string= implode(',',$arrayAttendees); ?>]
        }, {
            name: 'Number of applications for Catering',
            data: [<?php echo $string= implode(',',$userArray); ?>]
        }]
    });

    <?php

    }
    else{
            $getFullDate= date("Y-m-d",time());
            $firstDay= date("d", strtotime("first day of this month"));
            $lastDay= date("d", strtotime("last day of this month")); 
            $list=array();
            $month = date('m',strtotime($getFullDate));
            $year = date('y',strtotime($getFullDate));
            $array=array();
            $arrayAttendees=array();
            for($d=$firstDay; $d<=$lastDay; $d++)
            {
            $price=0;
                $userNum=0;
            $numberOfAttendees=0;
            $time=strtotime($year.'-'.$month.'-'.$d); 
            foreach($row as $k=>$v){
                if(date('Y-m-d', $time)==date('Y-m-d',strtotime($v['created']))){
                  $price  +=$v['price'];
                  $numberOfAttendees +=$v['numberOfAttendees'];
                    $userNum++;
                }
            }       
            $array[date('d M', $time)] =$price;
            $userArray[date('d M', $time)] =$userNum;
            $arrayAttendees[date('d M', $time)]=$numberOfAttendees;
            if (date('m', $time)==$month)       
                $list[]=date('d M', $time);
            } 
        ?>
    Highcharts.chart('container', {
        credits: {
            enabled: false
        },
        chart: {
            type: 'line'
        },
        xAxis: {
            categories: ["<?php echo $string= implode('", "',$list); ?>"]
        },
        yAxis: {
            min: 0,
            tickInterval: 100,
            title: {
                text: 'Price and Number of attendees Values'

            }

        },
        title: {
            text: 'Catering Orders by current month'
        },

        plotOptions: {
            series: {
                minPointLength: 3
            }
        },

        series: [{
            name: 'Price',
            data: [<?php echo $string= implode(',',$array); ?>]
        }, {
            name: 'Number of attendees',
            data: [<?php echo $string= implode(',',$arrayAttendees); ?>]
        }, {
             name: 'Number of applications for Catering',
            data: [<?php echo $string= implode(',',$userArray); ?>]
        }]
    });
    <?php

    }
    }
    
    ?>
    jQuery('.highcharts-button').hide();

</script>
