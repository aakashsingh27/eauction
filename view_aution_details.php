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
<head>
<style>
.box {
  width: 200px;
  height: 300px;
  position: relative;
  border: 1px solid #bbb;
  background: #eee;
  float: left;
  margin: 20px;
}
.ribbon {
  position: absolute;
  right: -5px;
  top: -5px;
  z-index: 1;
  overflow: hidden;
  width: 93px;
  height: 93px;
  text-align: right;
}
.ribbon span {
  font-size: 0.8rem;
  color: #fff;
  text-transform: uppercase;
  text-align: center;
  font-weight: bold;
  line-height: 32px;
  transform: rotate(45deg);
  width: 125px;
  display: block;
  background: #79a70a;
  background: linear-gradient(#9bc90d 0%, #79a70a 100%);
  box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
  position: absolute;
  top: 17px; // change this, if no border
  right: -29px; // change this, if no border
}

.ribbon span::before {
   content: '';
   position: absolute; 
   left: 0px; top: 100%;
   z-index: -1;
   border-left: 3px solid #79A70A;
   border-right: 3px solid transparent;
   border-bottom: 3px solid transparent;
   border-top: 3px solid #79A70A;
}
.ribbon span::after {
   content: '';
   position: absolute; 
   right: 0%; top: 100%;
   z-index: -1;
   border-right: 3px solid #79A70A;
   border-left: 3px solid transparent;
   border-bottom: 3px solid transparent;
   border-top: 3px solid #79A70A;
}

.red span {
  background: linear-gradient(#f70505 0%, #8f0808 100%);
}
.red span::before {
  border-left-color: #8f0808;
  border-top-color: #8f0808;
}
.red span::after {
  border-right-color: #8f0808;
  border-top-color: #8f0808;
}

.blue span {
  background: linear-gradient(#2989d8 0%, #1e5799 100%);
}
.blue span::before {
  border-left-color: #1e5799;
  border-top-color: #1e5799;
}
.blue span::after {
  border-right-color: #1e5799;
  border-top-color: #1e5799;
}

.foo {
  clear: both;
}

.bar {
  content: "";
  left: 0px;
  top: 100%;
  z-index: -1;
  border-left: 3px solid #79a70a;
  border-right: 3px solid transparent;
  border-bottom: 3px solid transparent;
  border-top: 3px solid #79a70a;
}

.baz {
  font-size: 1rem;
  color: #fff;
  text-transform: uppercase;
  text-align: center;
  font-weight: bold;
  line-height: 2em;
  transform: rotate(45deg);
  width: 100px;
  display: block;
  background: #79a70a;
  background: linear-gradient(#9bc90d 0%, #79a70a 100%);
  box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
  position: absolute;
  top: 100px;
  left: 1000px;
}

body{background: #eee}.news{width: 160px}.news-scroll a{text-decoration: none}.dot{height: 6px;width: 6px;margin-left: 3px;margin-right: 3px;margin-top: 2px !important;background-color: rgb(207,23,23);border-radius: 50%;display: inline-block}
</style>     </head>
  <body style="background: aliceblue;">




<div class="container">
  <div class="section-title">
    <span><strong><h4 class="">All Live Auctions </h4></strong></span>
  </div>
  
  
  <?php 
//live bid count start
$live_bid_cnt="SELECT `liquidator_id`
FROM assign_bidders_by_liquidator
LEFT JOIN create_sale
ON assign_bidders_by_liquidator.company_id = create_sale.company_id where assign_bidders_by_liquidator.bidder_id='$bdr_iid' and create_sale.Start_Date_Auction <='$timestamp' and create_sale.End_Date_Auction >='$timestamp'";

$qst_live_bid_cnt=$db->query($live_bid_cnt);
$ccnt_live_bid=mysqli_num_rows($qst_live_bid_cnt);
//live bid count end



//coming soon bid start
 $cmng_bid_cnt="SELECT `liquidator_id`
FROM assign_bidders_by_liquidator
LEFT JOIN create_sale
ON assign_bidders_by_liquidator.company_id = create_sale.company_id where assign_bidders_by_liquidator.bidder_id='$bdr_iid' and create_sale.Start_Date_Auction  > '$timestamp' and create_sale.End_Date_Auction  > '$timestamp'";

$qst_cmng_bid_cnt=$db->query($cmng_bid_cnt);
$ccnt_cmng_snn_live_bid=mysqli_num_rows($qst_cmng_bid_cnt);

//coming soon bid end


//closed bid count start
$clsed_bid_cnt="SELECT `liquidator_id`
FROM assign_bidders_by_liquidator
LEFT JOIN create_sale
ON assign_bidders_by_liquidator.company_id = create_sale.company_id where assign_bidders_by_liquidator.bidder_id='$bdr_iid' and create_sale.Start_Date_Auction  < '$timestamp' and create_sale.End_Date_Auction  < '$timestamp'";

$qst_clsed_bid_cnt=$db->query($clsed_bid_cnt);
$ccnt_clsed_bid_cnt=mysqli_num_rows($qst_clsed_bid_cnt);


//closed bid count end


if($ccnt_live_bid==0)
{
  ?>
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center breaking-news bg-white">
                <div class="d-flex flex-row flex-grow-1 flex-fill justify-content-center bg-danger py-2 text-white px-1 news"><span class="d-flex align-items-center">&nbsp;Live Status</span></div>
                <marquee class="news-scroll" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();"> <a href="#">There is no live bid Started yet</a> <span class="dot"></span> 
                </marquee>
            </div>
        </div>
    </div>
 <?php 
}
 ?>
  <div class="row justify-content-center">

<?php 





$clt_actn_dtl="select * from assign_bidders_by_liquidator where  bidder_id='$bdr_iid'";

$qst_clt_actn_dtl=$db->query($clt_actn_dtl);

while($clct_clt_actn_dtl=$qst_clt_actn_dtl->fetch_assoc())
{
    $cmp_id=$clct_clt_actn_dtl['company_id'];

    $clt_sel_notc_dtl="select * from create_sale where company_id='$cmp_id'";
    $qst_clt_sel_notc_dtl=$db->query($clt_sel_notc_dtl);
    $sel_netc_cnt=mysqli_num_rows($qst_clt_sel_notc_dtl);
    
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
$sepr_cmpy_nem=$clct_clt_sel_notc_dtl['super_company_name'];
if($strt_act_det <= $timestamp and $end_actn_det >=$timestamp)
{
$clt_cmpy_dtl="select * from company where id='$cmp_iid'";
$qst_clt_cmp=$db->query($clt_cmpy_dtl);
$clct_clt_cmp=$qst_clt_cmp->fetch_assoc();

$cmep_nem=$clct_clt_cmp['company_name'];

?>

  <div class="card col-md-6 m-2"  style="width: 20rem; border-radius: 20px 20px;border:2px solid orange" >
        <div class="ribbon"><span>New</span></div>
  <div class="card-body">
    <h5 class="card-title"><?php echo $ttel;?></h5>
    <h6 class="card-subtitle mb-2 text-muted">Company - <?php echo $sepr_cmpy_nem;?></h6>
    <p class="card-text"><span>Starts Time -</span> <?php echo $strt_act_det;?></p>

    <p class="card-text"><span>End Time -</span><?php echo $end_actn_det;?></p>
<p class='card-text'><span>Auction type</span> - <?php echo $actn_type;?></p>
    <p class="card-text"><span>Rerserved price -</span><?php echo $rsrv_prce;?> ₹</p>
    <p class="card-text"><span>Earnest money deposit -</span><?php echo $eeemp;?> ₹</p>
    <a href="bideshboard.php?id=<?php echo $sls_id;?>" class="card-link btn btn-warning" style="
    border: 2px solid #feae54; background: #feae54;
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
    <span><strong><h4 >Coming Soon Auctions </h4></strong></span>
  </div>
  <?php 
if($ccnt_cmng_snn_live_bid==0)
{
    ?>
<div class="row">
<div class="col-md-12">
<div class="d-flex justify-content-between align-items-center breaking-news bg-white">
<div class="d-flex flex-row flex-grow-1 flex-fill justify-content-center bg-danger py-2 text-white px-1 news"><span class="d-flex align-items-center">&nbsp; Status</span></div>
<marquee class="news-scroll" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();"> <a href="#">There Is No Coming Soon Bid.</a> <span class="dot"></span> 
</marquee>
</div>
</div>
</div>
    <?php
}
?>
  <div class="row justify-content-center">

<?php 

$clt_actn_dtl="select * from assign_bidders_by_liquidator where bidder_id='$bdr_iid'";

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

<div class="card col-md-6 m-2"  style="width: 20rem; border-radius: 20px 20px;border:2px solid orange" >
<div class="ribbon blue"><span>Upcoming</span></div>
<div class="card-body">
<h5 class="card-title"><?php echo $ttel;?></h5>
<h6 class="card-subtitle mb-2 text-muted">Company - <?php echo $cmep_nem;?></h6>
<p class="card-text"><span>starts from -</span> <?php echo $strt_act_det;?></p>

<p class="card-text"><span>End -</span><?php echo $end_actn_det;?></p>
<p class='card-text'><span>Auction type</span> - <?php echo $actn_type;?></p>
<p class="card-text"><span>Rerserved price -</span><?php echo $rsrv_prce;?> ₹</p>
<p class="card-text"><span>Earnest money deposit -</span><?php echo $eeemp;?> ₹</p>
<button type='button' onclick="alert('This bid is not started yet');" class="card-link btn btn-warning" style="
border: 2px solid feae54; background: #feae54;
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


<?php 
if($ccnt_live_bid==0)
{
    ?>
    
    <?php
}
?>
  </div>

  <div class="section-title">
    <span><strong><h4 class="">Closed Auctions </h4></strong></span>
  </div>
  <?php
  
if($ccnt_clsed_bid_cnt==0)
{
  ?>
<div class="row">
<div class="col-md-12">
<div class="d-flex justify-content-between align-items-center breaking-news bg-white">
<div class="d-flex flex-row flex-grow-1 flex-fill justify-content-center bg-danger py-2 text-white px-1 news"><span class="d-flex align-items-center">&nbsp;Live Status</span></div>
<marquee class="news-scroll" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();"> <a href="#">There is no Closed auction yet</a> <span class="dot"></span> 
</marquee>
</div>
</div>
</div>
 <?php 
}
 ?>
  <div class="row justify-content-center">

<?php 
$clt_actn_dtl="select * from assign_bidders_by_liquidator where bidder_id='$bdr_iid'";

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
  <div class="card col-md-6 m-2"  style="width: 20rem; border-radius: 20px 20px;border:2px solid orange" >
       <div class="ribbon red"><span>Closed</span></div>
  <div class="card-body">
    <h5 class="card-title"><?php echo $ttel;?></h5>
    <h6 class="card-subtitle mb-2 text-muted">Company - <?php echo $cmep_nem;?></h6>
    <p class="card-text"><span>Starts From :-</span> <?php echo $strt_act_det;?></p>

    <p class="card-text"><span>End -</span><?php echo $end_actn_det;?></p>
<p class='card-text'><span>Auction Type</span> - <?php echo $actn_type;?></p>
    <p class="card-text"><span>Rerserved Price -</span><?php echo $rsrv_prce;?> ₹</p>
    <p class="card-text"><span>Earnest Money Deposit -</span><?php echo $eeemp;?> ₹</p>
    <button type='button' onclick="alert('This Bid is closed');" class="card-link btn " style="
    border: 2px solid ##feae54; background: #feae54;
">View Details</button>
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