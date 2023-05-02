<?php 
include("config/config.php");
$iid=$_GET['id'];



$slt_netc_dtl="select * from create_sale where state_id='$iid'";
$qst_slt_netc_dtl=$db->query($slt_netc_dtl);
$sll_netc_cnt=mysqli_num_rows($qst_slt_netc_dtl);

if($sll_netc_cnt > 0)
{
    echo "<script>window.alert('This entry is already exist in create_sale first delete from there.');window.location='ad_stet.php';</script>";
}
else if($sll_netc_cnt == 0)
{
$dlt_stet="delete from state where id='$iid'";
$qst_dlt_stet=$db->query($dlt_stet);

if($qst_dlt_stet)
{
    echo "<script>window.alert('State deleted successfully.');window.location='ad_stet.php';</script>";
}
}

?>