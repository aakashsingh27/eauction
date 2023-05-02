<?php 
@ob_start();
session_start();
$a_idchk = $_SESSION['a_id'];

date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
$crt_det= date('Y-m-d');
include("config/config.php");

$rqt_id=$_GET['reqst_id'];
$bedr_id=$_GET['bdr_id'];
$cemp_id=$_GET['cmp_id'];

$slt_Dtl="select * from assign_bidders_by_liquidator where bidder_id='$bedr_id' and company_id='$cemp_id'";
$qst_slt_Dtl=$db->query($slt_Dtl);

$asgn_bddr_cnt=mysqli_num_rows($qst_slt_Dtl);

if($asgn_bddr_cnt==0)
{


$ad_rqst="insert into assign_bidders_by_liquidator set
liquidator_id='$a_idchk',
bidder_id='$bedr_id',
company_id='$cemp_id',
date_time='$crt_det'";
$qst_ad_rqst=$db->query($ad_rqst);
if($qst_ad_rqst)
{
   $udpt_rqst="update existing_bidders_request set status='approved' where id='$rqt_id'";

    $qst_udpt_rqst=$db->query($udpt_rqst);
    
    echo "<script>window.location='view_exstng_bdr_rqst.php';window.alert('Request approved successfully');</script>";
}

}
else
{
    echo "<script>window.alert('This compnay is already assigned to this user');window.location='view_exstng_bdr_rqst.php';</script>";
}
ob_flush();
?>