<?php 
@ob_start();
session_start();
$a_idchk = $_SESSION['a_id'];

date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
$crt_det= date('Y-m-d');
include("config/config.php");

$rqt_id=$_POST['rqst_id'];
$dsaprv_reason=$_POST['reason'];


$upd_bdr_rqst="update existing_bidders_request set reason_for_disapprove='$dsaprv_reason',status='disapproved' where id='$rqt_id'";

$qst_upd_bdr_rqst=$db->query($upd_bdr_rqst);
if($qst_upd_bdr_rqst)
{
    echo "<script>window.alert('Request disapproved successfully');window.location='view_exstng_bdr_rqst.php';</script>"; 
}



ob_flush();
?>