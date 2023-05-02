<?php
@ob_start();

 include('admin/config/config.php'); ?>


<?php 
date_default_timezone_set('Asia/Kolkata');
$timestamp = date("Y-m-d H:i:s");

if(isset($_SESSION['bddr_id']))
{
$lqdtr_id=$_SESSION['liquiditor_id'];
$bdr_iid=$_SESSION['bddr_id'];
}
else
{
  echo "<script>window.location='bidder_login.php';window.alert('Please login');</script>";
}
?>



<style>
  textarea{
    resize: none;
  }
  </style>
  

<?php include("header.php");?>
<html>
<head> </head>
  <body style="background: #29296e;">




<div class="container">
  <div class="section-title">
    <span><strong><h4 class="text-white">All Live Auctions </h4></strong></span>
  </div>
  <div class="row justify-content-center">

<?php 
$clt_actn_dtl="select * from assign_bidders_by_liquidator where liquidator_id='$lqdtr_id' and bidder_id='$bdr_iid'";

$qst_clt_actn_dtl=$db->query($clt_actn_dtl);

while($clct_clt_actn_dtl=$qst_clt_actn_dtl->fetch_assoc())
{
    $cmp_id=$clct_clt_actn_dtl['company_id'];

    $clt_sel_notc_dtl="select * from create_sale where company_id='$cmp_id'";
    $qst_clt_sel_notc_dtl=$db->query($clt_sel_notc_dtl);
    while($clct_clt_sel_notc_dtl=$qst_clt_sel_notc_dtl->fetch_assoc())
    {
    
    $ttel=$clct_clt_sel_notc_dtl['Title'];
    $incrmnt=$clct_clt_sel_notc_dtl['Incremental'];
    $rsrv_prce=$clct_clt_sel_notc_dtl['Reserve_Price'];
    $strt_act_det=$clct_clt_sel_notc_dtl['Start_Date_Auction'];
    $end_actn_det=$clct_clt_sel_notc_dtl['End_Date_Auction'];
    $actn_type=$clct_clt_sel_notc_dtl['auction_type'];
$cmp_iid=$clct_clt_sel_notc_dtl['company_id'];
$sls_id=$clct_clt_sel_notc_dtl['id'];
$eeemp=$clct_clt_sel_notc_dtl['emp'];
if($strt_act_det <= $timestamp and $end_actn_det >=$timestamp)
{
$clt_cmpy_dtl="select * from company where id='$cmp_iid'";
$qst_clt_cmp=$db->query($clt_cmpy_dtl);
$clct_clt_cmp=$qst_clt_cmp->fetch_assoc();

$cmep_nem=$clct_clt_cmp['company_name'];

?>

  <div class="card col-md-6 m-2"  style="width: 20rem; border-radius: 20px 20px;border:6px solid orange" >
  <div class="card-body">
    <h5 class="card-title"><?php echo $ttel;?></h5>
    <h6 class="card-subtitle mb-2 text-muted">company :- <?php echo $cmep_nem;?></h6>
    <p class="card-text"><span>starts from :-</span> <?php echo $strt_act_det;?></p>

    <p class="card-text"><span>End :-</span><?php echo $end_actn_det;?></p>
<p class='card-text'><span>Auction type</span> :- <?php echo $actn_type;?></p>
    <p class="card-text"><span>Rerserved price :-</span><?php echo $rsrv_prce;?> ₹</p>
    <p class="card-text"><span>Earnest money deposit :-</span><?php echo $eeemp;?> ₹</p>
    <a href="bideshboard.php?id=<?php echo $sls_id;?>" class="card-link btn btn-warning" style="
    border: 2px solid #29296e;
">View details</a>
  </div>
</div>
<?php 
}
else
{
?>

<?php


}
}
}
?>



  </div>



  <div class="section-title">
    <span><strong><h4 class="text-white">Coming soon Auctions </h4></strong></span>
  </div>
  <div class="row justify-content-center">

<?php 
$clt_actn_dtl="select * from assign_bidders_by_liquidator where liquidator_id='$lqdtr_id' and bidder_id='$bdr_iid'";

$qst_clt_actn_dtl=$db->query($clt_actn_dtl);

while($clct_clt_actn_dtl=$qst_clt_actn_dtl->fetch_assoc())
{
    $cmp_id=$clct_clt_actn_dtl['company_id'];

    $clt_sel_notc_dtl="select * from create_sale where company_id='$cmp_id'";
    $qst_clt_sel_notc_dtl=$db->query($clt_sel_notc_dtl);
    while($clct_clt_sel_notc_dtl=$qst_clt_sel_notc_dtl->fetch_assoc())
    {
    
    $ttel=$clct_clt_sel_notc_dtl['Title'];
    $incrmnt=$clct_clt_sel_notc_dtl['Incremental'];
    $rsrv_prce=$clct_clt_sel_notc_dtl['Reserve_Price'];
    $strt_act_det=$clct_clt_sel_notc_dtl['Start_Date_Auction'];
    $end_actn_det=$clct_clt_sel_notc_dtl['End_Date_Auction'];
    $actn_type=$clct_clt_sel_notc_dtl['auction_type'];
$cmp_iid=$clct_clt_sel_notc_dtl['company_id'];
$sls_id=$clct_clt_sel_notc_dtl['id'];
$eeemp=$clct_clt_sel_notc_dtl['emp'];
if($strt_act_det > $timestamp and $end_actn_det > $timestamp)
{
$clt_cmpy_dtl="select * from company where id='$cmp_iid'";
$qst_clt_cmp=$db->query($clt_cmpy_dtl);
$clct_clt_cmp=$qst_clt_cmp->fetch_assoc();

$cmep_nem=$clct_clt_cmp['company_name'];

?>

  <div class="card col-md-6 m-2"  style="width: 20rem; border-radius: 20px 20px;border:6px solid orange" >
  <div class="card-body">
    <h5 class="card-title"><?php echo $ttel;?></h5>
    <h6 class="card-subtitle mb-2 text-muted">company :- <?php echo $cmep_nem;?></h6>
    <p class="card-text"><span>starts from :-</span> <?php echo $strt_act_det;?></p>

    <p class="card-text"><span>End :-</span><?php echo $end_actn_det;?></p>
<p class='card-text'><span>Auction type</span> :- <?php echo $actn_type;?></p>
    <p class="card-text"><span>Rerserved price :-</span><?php echo $rsrv_prce;?> ₹</p>
    <p class="card-text"><span>Earnest money deposit :-</span><?php echo $eeemp;?> ₹</p>
    <button type='button' onclick="alert('This bid is not started yet');" class="card-link btn btn-warning" style="
    border: 2px solid #29296e;
">View details</button>
  </div>
</div>
<?php 
}
else
{
?>

<?php


}
}
}
?>



  </div>





  <div class="section-title">
    <span><strong><h4 class="text-white">Closed Auctions </h4></strong></span>
  </div>
  <div class="row justify-content-center">

<?php 
$clt_actn_dtl="select * from assign_bidders_by_liquidator where liquidator_id='$lqdtr_id' and bidder_id='$bdr_iid'";

$qst_clt_actn_dtl=$db->query($clt_actn_dtl);

while($clct_clt_actn_dtl=$qst_clt_actn_dtl->fetch_assoc())
{
    $cmp_id=$clct_clt_actn_dtl['company_id'];

    $clt_sel_notc_dtl="select * from create_sale where company_id='$cmp_id'";
    $qst_clt_sel_notc_dtl=$db->query($clt_sel_notc_dtl);
    while($clct_clt_sel_notc_dtl=$qst_clt_sel_notc_dtl->fetch_assoc())
    {
    
    $ttel=$clct_clt_sel_notc_dtl['Title'];
    $incrmnt=$clct_clt_sel_notc_dtl['Incremental'];
    $rsrv_prce=$clct_clt_sel_notc_dtl['Reserve_Price'];
    $strt_act_det=$clct_clt_sel_notc_dtl['Start_Date_Auction'];
    $end_actn_det=$clct_clt_sel_notc_dtl['End_Date_Auction'];
    $actn_type=$clct_clt_sel_notc_dtl['auction_type'];
$cmp_iid=$clct_clt_sel_notc_dtl['company_id'];
$sls_id=$clct_clt_sel_notc_dtl['id'];
$eeemp=$clct_clt_sel_notc_dtl['emp'];
if($strt_act_det < $timestamp and $end_actn_det < $timestamp)
{
$clt_cmpy_dtl="select * from company where id='$cmp_iid'";
$qst_clt_cmp=$db->query($clt_cmpy_dtl);
$clct_clt_cmp=$qst_clt_cmp->fetch_assoc();

$cmep_nem=$clct_clt_cmp['company_name'];

?>

  <div class="card col-md-6 m-2"  style="width: 20rem; border-radius: 20px 20px;border:6px solid orange" >
  <div class="card-body">
    <h5 class="card-title"><?php echo $ttel;?></h5>
    <h6 class="card-subtitle mb-2 text-muted">company :- <?php echo $cmep_nem;?></h6>
    <p class="card-text"><span>starts from :-</span> <?php echo $strt_act_det;?></p>

    <p class="card-text"><span>End :-</span><?php echo $end_actn_det;?></p>
<p class='card-text'><span>Auction type</span> :- <?php echo $actn_type;?></p>
    <p class="card-text"><span>Rerserved price :-</span><?php echo $rsrv_prce;?> ₹</p>
    <p class="card-text"><span>Earnest money deposit :-</span><?php echo $eeemp;?> ₹</p>
    <button type='button' onclick="alert('This Bid is closed');" class="card-link btn btn-warning" style="
    border: 2px solid #29296e;
">View details</button>
  </div>
</div>
<?php 
}
else
{
?>

<?php


}
}
}
?>



  </div>




</div>


  </body>
</html>
<?php 
ob_flush();
?>