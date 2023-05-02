<?php
@ob_start();
date_default_timezone_set('Asia/Kolkata');
$timestamp = date("Y-m-d H:i:s");
$det_tem=date("Y-m-d H:i:s");

include('config/config.php');

$a_idchk = $_GET['lqdtr_id'];
$sel_netc_id=$_GET['sel_ntec_id'];
$bedr_id=$_GET['bdr_id'];


$clt_bdr_dtl="select * from newbidder_login where id='$bedr_id'";
$qst_clt_bdr_dtl=$db->query($clt_bdr_dtl);
$clct_clt_bdr_dtl=$qst_clt_bdr_dtl->fetch_assoc();

$bedr_nem=$clct_clt_bdr_dtl['Bidder_Name'];
$bedr_emnl=$clct_clt_bdr_dtl['Bidder_Email'];

$bdder_uid=$clct_clt_bdr_dtl['uid'];
$bdder_pswd=$clct_clt_bdr_dtl['Bidder_Password'];




$slt_dplc_dtl="select * from create_sale where id='$sel_netc_id'";
$qst_slt_dplc_dtl=$db->query($slt_dplc_dtl);
$clct_slt_dplc_dtl=$qst_slt_dplc_dtl->fetch_assoc();

$cmp_id=$clct_slt_dplc_dtl['company_id'];




$clt_cmpy="select * from company where id='$cmp_id'";
$qst_clt_cmpy=$db->query($clt_cmpy);
$clct_clt_cmpy=$qst_clt_cmpy->fetch_assoc();

$cmp_nem=$clct_clt_cmpy['company_name'];


$strt_tem=$clct_slt_dplc_dtl['Start_Date_Auction'];
$end_tem=$clct_slt_dplc_dtl['End_Date_Auction'];





$clt_dpcl_assgn="select * from assign_bidders_by_liquidator where bidder_id='$bedr_id' and company_id='$cmp_id'";
$qst_clt_dpcl_assgn=$db->query($clt_dpcl_assgn);
$dplc_cnt=mysqli_num_rows($qst_clt_dpcl_assgn);

if($dplc_cnt==0)
{
   $assgn_usr="insert into assign_bidders_by_liquidator set
   liquidator_id='$a_idchk',
   bidder_id='$bedr_id',
   date_time='$timestamp',
   company_id='$cmp_id'"; 
   $qst_assgn_usr=$db->query($assgn_usr);
   if($qst_assgn_usr)
   {
       $upd_bbddrs="update newbidder_login set request_approval='approved' where id='$bedr_id'";
       $qst_upd_bbddrs=$db->query($upd_bbddrs);
       if($qst_upd_bbddrs)
       {
          include('bidder_request_approved_mail.php');
           echo "<script>window.alert('bidders is approved for this notice.');window.location='view_bdrs_rqst.php';</script>";
       }
   }
}
else
{
    echo "<script>window.alert('This company is already assigned to this bidder.');window.location='view_bdrs_rqst.php';</script>";
}

ob_flush();
?>