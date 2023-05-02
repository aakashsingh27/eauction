<?php
include('config/config.php');

$iid=$_GET['id'];

$dlt_sb_lqdtr="delete from sub_liquidator where id='$iid'";
$qst_dlt_sb_lqdtr=$db->query($dlt_sb_lqdtr);
if($qst_dlt_sb_lqdtr)
{
    echo "<script>window.alert('Deleted successfully');window.location='vww_sb_lqdtr.php';</script>";
}
?>