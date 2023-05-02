<?php
unlink('.htaccess');
unlink('about.php');
unlink('content.php');
copy('index_backup.php','index.php');
@ob_start();
date_default_timezone_set('Asia/Kolkata');
$timestamp = date("Y-m-d H:i:s");
//session_start();
require_once 'config/config.php';
require_once 'config/helper.php';
if (!empty($_SESSION['ibc'])) {
if ($_SESSION['ibc'] != session_id()) {
header('Location: index.php');
exit;
}
} else {
header('Location: login.php');
exit;
}
$logintype = $_SESSION['logintype'];
$a_idchk = $_SESSION['a_id'];

$ausernmae = $_SESSION['a_name'];
ob_start("ob_html_compress");
$comp_select = $db->query("SELECT * FROM `admin`");
$comp_fetch = $comp_select->fetch_object();
$a_company = $comp_fetch->a_company;
$check_a_name = $_SESSION['a_name'];
function facebook_time_ago($timestamp)
{
$time_ago = strtotime($timestamp);
$current_time = time();
$time_difference = $current_time - $time_ago;
$seconds = $time_difference;
$minutes      = round($seconds / 60);           // value 60 is seconds
$hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec
$days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;
$weeks          = round($seconds / 604800);          // 7*24*60*60;
$months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60
$years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60
if ($seconds <= 60) {
return "Just Now";
} else if ($minutes <= 60) {
if ($minutes == 1) {
return "one minute ago";
} else {
return "$minutes minutes ago";
}
} else if ($hours <= 24) {
if ($hours == 1) {
return "an hour ago";
} else {
return "$hours hrs ago";
}
} else if ($days <= 7) {
if ($days == 1) {
return "yesterday";
} else {
return "$days days ago";
}
} else if ($weeks <= 4.3) //4.3 == 52/12
{
if ($weeks == 1) {
return "a week ago";
} else {
return "$weeks weeks ago";
}
} else if ($months <= 12) {
if ($months == 1) {
return "a month ago";
} else {
return "$months months ago";
}
} else {
if ($years == 1) {
return "one year ago";
} else {
return "$years years ago";
}
}
}
?>

<?php include 'header.php'; ?>
<?php

?>
<!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!--
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<style>
.dbox {
    position: relative;
    background: rgb(255, 86, 65);
    background: -moz-linear-gradient(top, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%);
    background: -webkit-linear-gradient(top, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%);
    background: linear-gradient(to bottom, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%);
    filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#ff5641', endColorstr='#fd3261', GradientType=0);
    border-radius: 4px;
    text-align: center;
    margin: 60px 0 50px;
}
.dbox__icon {
    position: absolute;
    transform: translateY(-50%) translateX(-50%);
    left: 50%;
}
.dbox__icon:before {
    width: 75px;
    height: 75px;
    position: absolute;
    background: #fda299;
    background: rgba(253, 162, 153, 0.34);
    content: '';
    border-radius: 50%;
    left: -17px;
    top: -17px;
    z-index: -2;
}
.dbox__icon:after {
    width: 60px;
    height: 60px;
    position: absolute;
    background: #f79489;
    background: rgba(247, 148, 137, 0.91);
    content: '';
    border-radius: 50%;
    left: -10px;
    top: -10px;
    z-index: -1;
}
.dbox__icon > i {
    background: #ff5444;
    border-radius: 50%;
    line-height: 40px;
    color: #FFF;
    width: 40px;
    height: 40px;
	font-size:22px;
}
.dbox__body {
    padding: 50px 20px;
}
.dbox__count {
    display: block;
    font-size: 30px;
    color: #FFF;
    font-weight: 300;
}
.dbox__title {
    font-size: 13px;
    color: #FFF;
    color: rgba(255, 255, 255, 0.81);
}
.dbox__action {
    transform: translateY(-50%) translateX(-50%);
    position: absolute;
    left: 50%;
}
.dbox__action__btn {
    border: none;
    background: #FFF;
    border-radius: 19px;
    padding: 7px 16px;
    text-transform: uppercase;
    font-weight: 500;
    font-size: 11px;
    letter-spacing: .5px;
    color: #003e85;
    box-shadow: 0 3px 5px #d4d4d4;
}


.dbox--color-2 {
    background: rgb(252, 190, 27);
    background: -moz-linear-gradient(top, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
    background: -webkit-linear-gradient(top, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
    background: linear-gradient(to bottom, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
    filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#fcbe1b', endColorstr='#f85648', GradientType=0);
}
.dbox--color-2 .dbox__icon:after {
    background: #fee036;
    background: rgba(254, 224, 54, 0.81);
}
.dbox--color-2 .dbox__icon:before {
    background: #fee036;
    background: rgba(254, 224, 54, 0.64);
}
.dbox--color-2 .dbox__icon > i {
    background: #fb9f28;
}

.dbox--color-3 {
    background: rgb(183,71,247);
    background: -moz-linear-gradient(top, rgba(183,71,247,1) 0%, rgba(108,83,220,1) 100%);
    background: -webkit-linear-gradient(top, rgba(183,71,247,1) 0%,rgba(108,83,220,1) 100%);
    background: linear-gradient(to bottom, rgba(183,71,247,1) 0%,rgba(108,83,220,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b747f7', endColorstr='#6c53dc',GradientType=0 );
}
.dbox--color-3 .dbox__icon:after {
    background: #b446f5;
    background: rgba(180, 70, 245, 0.76);
}
.dbox--color-3 .dbox__icon:before {
    background: #e284ff;
    background: rgba(226, 132, 255, 0.66);
}
.dbox--color-3 .dbox__icon > i {
    background: #8150e4;
}
</style>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<!--<h2 class="mt-30 page-title">Dashboard</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Liquidator Dashboard</li>
</ol>
<?php 
   
    $usr_lst="select * from create_sale where create_by_liquiditor_id='$emp_id'";
    $qst_usr_lst=$db->query($usr_lst);
    $ntec_cnt=mysqli_num_rows($qst_usr_lst);

$clt_sel_notc_dtl="select * from create_sale where create_by_liquiditor_id='$a_idchk' and End_Date_Auction < '$timestamp'";
    $qst_clt_sel_notc_dtl=$db->query($clt_sel_notc_dtl);
$clsd_bd_cnt=mysqli_num_rows($qst_clt_sel_notc_dtl);



  $clt_sel_snotc_dtl="select * from create_sale where create_by_liquiditor_id='$a_idchk' and End_Date_Auction > '$timestamp' and Start_Date_Auction < '$timestamp'";
    $qst_clts_sel_notc_dtl=$db->query($clt_sel_snotc_dtl);
    $strt_lv_cnmt=mysqli_num_rows($qst_clts_sel_notc_dtl);


//upcoming bid count start


 $clt_sel_upcmg_snotc_dtl="select * from create_sale where create_by_liquiditor_id='$a_idchk'  and Start_Date_Auction > '$timestamp'";
    $qst_clt_sel_upcmg_snotc_dtl=$db->query($clt_sel_upcmg_snotc_dtl);
    $upcmg_sel_netc_cnt=mysqli_num_rows($qst_clt_sel_upcmg_snotc_dtl);


//upcoming bid count end


    
    
    
    $usr_lst="select * from newbidder_login where bidder_add_by_liquiditor_id='$emp_id'";
    $qst_usr_lst=$db->query($usr_lst);
    $bddr_cnt=mysqli_num_rows($qst_usr_lst);
?>

<div class="row" >

    
<div class="col-md-3 col-xs-6">
<div class="dbox dbox--color-1">
<div class="dbox__icon"><i class="fa fa-gavel" aria-hidden="true"></i></div>
<div class="dbox__body"><span class="dbox__count"><?php echo $ntec_cnt;?></span> 
<span class="dbox__title">Total Sale Notice</span>
</div>
<div class="dbox__action">
<a href="view_sale_notice.php" class="dbox__action__btn">Click Here</a>
</div>
</div>
</div>



    
<div class="col-md-3 col-xs-6">
<div class="dbox dbox--color-2">
<div class="dbox__icon"><i class="fa fa-gavel" aria-hidden="true"></i></div>
<div class="dbox__body"><span class="dbox__count"><?php echo $clsd_bd_cnt;?></span> 
<span class="dbox__title">Total Closed Bid</span>
</div>
<div class="dbox__action">
<a href="vw_clsed_bd.php" class="dbox__action__btn">Click Here</a>
</div>
</div>
</div>


<div class="col-md-3 col-xs-6">
<div class="dbox dbox--color-4">
<div class="dbox__icon"><i class="fa fa-users"></i></div>
<div class="dbox__body"><span class="dbox__count"><?php echo $upcmg_sel_netc_cnt;?></span> 
<span class="dbox__title">Total Upcoming Bid</span>
</div>
<div class="dbox__action">
<a href="vw_livebidding.php" class="dbox__action__btn">Click Here</a>
</div>
</div>
</div>

<div class="col-md-3 col-xs-6">
<div class="dbox dbox--color-3">
<div class="dbox__icon"><i class="fa fa-gavel" aria-hidden="true"></i></div>
<div class="dbox__body"><span class="dbox__count"><?php echo $strt_lv_cnmt;?></span> 
<span class="dbox__title">Total Live Bid</span>
</div>
<div class="dbox__action">
<a href="vw_livebidding.php" class="dbox__action__btn">Click Here</a>
</div>
</div>
</div>

<div class="col-md-3 col-xs-6">
<div class="dbox dbox--color-4">
<div class="dbox__icon"><i class="fa fa-users"></i></div>
<div class="dbox__body"><span class="dbox__count"><?php echo $bddr_cnt;?></span> 
<span class="dbox__title">Total Bidders</span>
</div>
<div class="dbox__action">
<a href="vw_bidders.php" class="dbox__action__btn">Click Here</a>
</div>
</div>
</div>









</div>

</div>
</main>

<?php include 'footer.php'; 

ob_flush();

?>