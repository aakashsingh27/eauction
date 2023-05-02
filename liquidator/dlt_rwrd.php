<?php 
@ob_start();
session_start();
include("config/config.php");

$prd_id=$_GET['id'];

$dlt_prd="delete from reward_recogniztion where id='$prd_id'";
$qst_dlt_prd=$db->query($dlt_prd);

if($qst_dlt_prd)
{
    echo "<script>window.alert('Deleted Success');window.location='view_rwrd_rcgnztion.php';</script>";
}

ob_flush();
?>