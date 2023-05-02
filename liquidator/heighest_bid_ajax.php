<?php 
include('config/config.php');
$sls_id=$_POST['txt1'];
$sql=mysqli_query($db,"select * from create_sale where id='$sls_id'");
$result=mysqli_fetch_assoc($sql);

$actn_type=$result['auction_type'];
if($actn_type=="forward")
{
    $Incremental=$result['Incremental'];
}
else if($actn_type=="reverse")
{
    $Incremental=-$result['Incremental']; 
}
$clt_dtl="select * from livebidding  where salenotice_id='$sls_id'";
$qst_clt_dtl=$db->query($clt_dtl);
$clt_dtl_cnt=mysqli_num_rows($qst_clt_dtl);

if($clt_dtl_cnt==0)

{
$heighest_bid=0;
$reserve_price=$result['Reserve_Price'];
$bid_amnnt=$reserve_price;
$next_bid=$bid_amnnt+$Incremental;

echo json_encode(["status"=>1,"heighest_bid"=>"$heighest_bid ₹","next_bid"=>"$bid_amnnt ₹","next_bid_vl"=>$bid_amnnt]);
}
else
{

if($actn_type=="forward")
{

    $clt_lv_bdng="select max(highestBid) as high_bid from livebidding where salenotice_id='$sls_id'";
    $qst_clt_lv_bdng=$db->query($clt_lv_bdng);
    $clct_clt_lv_bdng=$qst_clt_lv_bdng->fetch_assoc();
    
     $heighest_bid=$clct_clt_lv_bdng['high_bid'];
    
     $bid_amnnt=$heighest_bid+$Incremental;
    






     $slt_hgst_bddr_dtl="select * from livebidding where salenotice_id='$sls_id' and highestBid='$heighest_bid'";
     $qst_slt_hgst_bddr_dtl=$db->query($slt_hgst_bddr_dtl);
     $clct_slt_hgst_bddr_dtl=$qst_slt_hgst_bddr_dtl->fetch_assoc();
     
     $bder_iid=$clct_slt_hgst_bddr_dtl['bidder_fid'];
     $ip_aaddrs=$clct_slt_hgst_bddr_dtl['ipaddress'];
     
     $slt_beedr_dtl="select * from newbidder_login where id='$bder_iid'";
     $qst_slt_beedr_dtl=$db->query($slt_beedr_dtl);
     $clct_slt_beedr_dtl=$qst_slt_beedr_dtl->fetch_assoc();
     
     $bddr_uid=$clct_slt_beedr_dtl['uid'];
     








    echo json_encode(["status"=>1,"heighest_bid"=>"$heighest_bid ₹","next_bid"=>"$bid_amnnt ₹","next_bid_vl"=>$bid_amnnt,"heighest_bid_uid"=>$bddr_uid,"ip_addrs"=>"$ip_aaddrs"]);
    
}
else if($actn_type=="reverse")
{
$clt_lv_bdng="select min(highestBid) as high_bid from livebidding where salenotice_id='$sls_id'";
$qst_clt_lv_bdng=$db->query($clt_lv_bdng);
$clct_clt_lv_bdng=$qst_clt_lv_bdng->fetch_assoc();

 $heighest_bid=$clct_clt_lv_bdng['high_bid'];

 $bid_amnnt=$heighest_bid+$Incremental;



 $slt_hgst_bddr_dtl="select * from livebidding where salenotice_id='$sls_id' and highestBid='$heighest_bid'";
 $qst_slt_hgst_bddr_dtl=$db->query($slt_hgst_bddr_dtl);
 $clct_slt_hgst_bddr_dtl=$qst_slt_hgst_bddr_dtl->fetch_assoc();
 
 $bder_iid=$clct_slt_hgst_bddr_dtl['bidder_fid'];
 $ip_aaddrs=$clct_slt_hgst_bddr_dtl['ipaddress'];
 
 $slt_beedr_dtl="select * from newbidder_login where id='$bder_iid'";
 $qst_slt_beedr_dtl=$db->query($slt_beedr_dtl);
 $clct_slt_beedr_dtl=$qst_slt_beedr_dtl->fetch_assoc();
 
 $bddr_uid=$clct_slt_beedr_dtl['uid'];


echo json_encode(["status"=>1,"heighest_bid"=>"$heighest_bid ₹","next_bid"=>"$bid_amnnt ₹","next_bid_vl"=>$bid_amnnt,"heighest_bid_uid"=>$bddr_uid,"ip_addrs"=>"$ip_aaddrs"]);

}
}
?>