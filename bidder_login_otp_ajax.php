<?php 
date_default_timezone_set("Asia/Kolkata");
include('admin/config/config.php');

$crt_det_tme=date("Y-m-d h:i:s");

$bidder_uid=$_POST['txt1'];
$bidder_pwd=$_POST['txt2'];

$clt_usr_dtl="select * from newbidder_login where uid='$bidder_uid' and Bidder_Password='$bidder_pwd' and status='active'";

$qst_clt_usr_dtl=$db->query($clt_usr_dtl);
$bderr_cnt=mysqli_num_rows($qst_clt_usr_dtl);

if($bderr_cnt==1)
{
$clct_clt_usr_dtl=$qst_clt_usr_dtl->fetch_assoc();
$usrr_id=$clct_clt_usr_dtl['id'];
$lqdtr_id=$clct_clt_usr_dtl['bidder_add_by_liquiditor_id'];
$bidder_emnl=$clct_clt_usr_dtl['Bidder_Email'];

$otp=rand(11111,999999);


$upd_otp="update newbidder_login set otp='$otp' where id='$usrr_id'";
$qst_upd_otp=$db->query($upd_otp);
if($qst_upd_otp)
{

include('bidder_signin_otp.php');

echo json_encode(array("status"=>1,"Response"=>"Opt Sent successfully"));

}
}
else
{
    echo json_encode(array("status"=>0,"Response"=>"Wrong cridentials"));
}

?>