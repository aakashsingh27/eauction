<?php 
include("config/config.php");
$bdr_iid=$_GET['id'];

$clt_cndtn="select * from assign_bidders_by_liquidator where bidder_id='$bdr_iid'";
$qst_clt_cndtn=$db->query($clt_cndtn);
$assgn_ccnt=mysqli_num_rows($qst_clt_cndtn);


$clt_lv_bdng_cndtn="select * from livebidding where bidder_fid='$bdr_iid'";
$qst_clt_lv_bdng_cndtn=$db->query($clt_lv_bdng_cndtn);
$live_bidding_ccnt=mysqli_num_rows($qst_clt_lv_bdng_cndtn);


$clt_exstng_bdng_cndtn="select * from existing_bidders_request where bidder_id='$bdr_iid'";
$qst_clt_exstng_bdng_cndtn=$db->query($clt_exstng_bdng_cndtn);
$exstng_bidding_ccnt=mysqli_num_rows($qst_clt_exstng_bdng_cndtn);

if($assgn_ccnt > 0)
{
    echo "<script>window.alert('This bidder found in assign_bidders_by_liquidator table please delete first from here.');window.location='vw_bidders.php';</script>";
}
else if($live_bidding_ccnt > 0)
{
    echo "<script>window.alert('This bidder found in livebidding table please delete first from here.');window.location='vw_bidders.php';</script>";
}
else if($exstng_bidding_ccnt > 0)
{
     echo "<script>window.alert('This bidder found in existing_bidders_request table please delete first from here.');window.location='vw_bidders.php';</script>";
}
else if($assgn_ccnt==0 and $live_bidding_ccnt==0 and $exstng_bidding_ccnt==0)
{

$dtl_bdr="delete from newbidder_login where id='$bdr_iid'";
$qst_dtl_bdr=$db->query($dtl_bdr);

if($qst_dtl_bdr)
{
    echo "<script>window.alert('Bidder Deleted successfully');window.location='vw_bidders.php';</script>";

}
}

?>