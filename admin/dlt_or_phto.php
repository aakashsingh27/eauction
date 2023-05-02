<?php 
session_start();
include("config/config.php");
$bnr_id=$_GET['id'];



$dlt_bnr="delete from our_photo_gallery where id='$bnr_id'";
$qst_dlt_bnr=$db->query($dlt_bnr);

if($qst_dlt_bnr)
{
    echo "<script>window.alert('Photo Deleted Successfully');window.location='vw_phto.php';</script>";
}



?>