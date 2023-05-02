<?php

@ob_start();
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



date_default_timezone_set('Asia/Kolkata');
$timestamp = date("Y-m-d H:i:s");






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
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<!--<h2 class="mt-30 page-title"></h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Live Bids</li>
</ol>


<div class="row">
<div class='col-md-12'>
<center>
<h1>Live Bidding</h1>

</center>


<div class="row justify-content-center">



<?php 

    $clt_sel_notc_dtl="select * from create_sale where create_by_liquiditor_id='$a_idchk'";
    $qst_clt_sel_notc_dtl=$db->query($clt_sel_notc_dtl);
    while($clct_clt_sel_notc_dtl=$qst_clt_sel_notc_dtl->fetch_assoc())
    {
    
    $ttel=$clct_clt_sel_notc_dtl['Title'];
    $incrmnt=$clct_clt_sel_notc_dtl['Incremental'];
    $rsrv_prce=$clct_clt_sel_notc_dtl['Reserve_Price'];
    $strt_act_det=$clct_clt_sel_notc_dtl['Start_Date_Auction'];
    $end_actn_det=$clct_clt_sel_notc_dtl['End_Date_Auction'];
$cmp_iid=$clct_clt_sel_notc_dtl['company_id'];
$sls_id=$clct_clt_sel_notc_dtl['id'];
$actn_type=$clct_clt_sel_notc_dtl['auction_type'];

if($end_actn_det >=$timestamp and $strt_act_det < $timestamp)
{
$clt_cmpy_dtl="select * from company where id='$cmp_iid'";
$qst_clt_cmp=$db->query($clt_cmpy_dtl);
$clct_clt_cmp=$qst_clt_cmp->fetch_assoc();

$cmep_nem=$clct_clt_cmp['company_name'];

?>

  <div class="card col-md-4  m-2"  style="width: 20rem;">
  <div class="card-body">
    <h5 class="card-title"><?php echo $ttel;?></h5>
    <h6 class="card-subtitle mb-2 text-muted">Company :- <?php echo $cmep_nem;?></h6>


    <p class="card-text"><span>Auction Type :-</span> <?php echo $actn_type;?></p>
    
    <p class="card-text"><span>Starts from :-</span> <?php echo $strt_act_det;?></p>

    <p class="card-text"><span>End :-</span><?php echo $end_actn_det;?></p>

    <p class="card-text"><span>Rerserved price :-</span><?php echo $rsrv_prce;?></p>
    <a href="vw_live_bidding_details.php?id=<?php echo $sls_id;?>" class="card-link btn btn-primary">View live Bid</a> <a href="vw_bid_ddtls.php?id=<?php echo $sls_id;?>" class="card-link btn btn-danger">View Bid Details</a>
  </div>
</div>
<?php 
}

}
?>



  </div>






  <center>
<h1>Start Soon Bid</h1>

</center>

  <div class="row justify-content-center">



<?php 

    $clt_sel_notc_dtl="select * from create_sale where create_by_liquiditor_id='$a_idchk' and End_Date_Auction > '$timestamp' and Start_Date_Auction > '$timestamp'";
    $qst_clt_sel_notc_dtl=$db->query($clt_sel_notc_dtl);
    $strt_snn_bid_cnmt=mysqli_num_rows($qst_clt_sel_notc_dtl);
    if($strt_snn_bid_cnmt==0)
    {
echo "<h4 style='color:red;font-weight:bold;'>No BId is Pending</h4>";
    }
    else
    {
    while($clct_clt_sel_notc_dtl=$qst_clt_sel_notc_dtl->fetch_assoc())
    {
    
    $ttel=$clct_clt_sel_notc_dtl['Title'];
    $incrmnt=$clct_clt_sel_notc_dtl['Incremental'];
    $rsrv_prce=$clct_clt_sel_notc_dtl['Reserve_Price'];
    $strt_act_det=$clct_clt_sel_notc_dtl['Start_Date_Auction'];
    $end_actn_det=$clct_clt_sel_notc_dtl['End_Date_Auction'];
$cmp_iid=$clct_clt_sel_notc_dtl['company_id'];
$sls_id=$clct_clt_sel_notc_dtl['id'];

$actn_type=$clct_clt_sel_notc_dtl['auction_type'];








if($end_actn_det > $timestamp and $strt_act_det > $timestamp)
{
$clt_cmpy_dtl="select * from company where id='$cmp_iid'";
$qst_clt_cmp=$db->query($clt_cmpy_dtl);
$clct_clt_cmp=$qst_clt_cmp->fetch_assoc();

$cmep_nem=$clct_clt_cmp['company_name'];

?>

  <div class="card col-md-4  m-2"  style="width: 20rem;">
  <div class="card-body">
    <h5 class="card-title"><?php echo $ttel;?></h5>
    <h6 class="card-subtitle mb-2 text-muted">Company :- <?php echo $cmep_nem;?></h6>
    <p class='card-text'><span>Auction Type :-</span> <?php echo $actn_type;?></p>
    <p class="card-text"><span>Starts From :-</span> <?php echo $strt_act_det;?></p>

    <p class="card-text"><span>End :-</span><?php echo $end_actn_det;?></p>

    <p class="card-text"><span>Rerserved Price :-</span><?php echo $rsrv_prce;?></p>
    <a href="#" onclick='alert("Bid not started Yet");' class="card-link btn btn-primary">View Live Bid</a> <a href="#" onclick='alert("Bid not started Yet");' class="card-link btn btn-danger">View Bid Details</a>
  </div>
</div>
<?php 
}

}
    }
?>



  </div>





 









</div>




</div>

</div>
</main>

<?php include 'footer.php'; 

ob_flush();

?>