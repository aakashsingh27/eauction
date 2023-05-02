<?php 
session_start();
include("config/config.php");
$bnr_id=$_GET['id'];

$dsp_cmnp="delete from assign_display_company_liquidator where id='$bnr_id'";
$qst_dsp_cmnp=$db->query($dsp_cmnp);

if($qst_dsp_cmnp)
{
    echo "<script>window.alert('Display Compnay Unassigned Successfully');window.location='view_assgn_disp_company.php';</script>";
}

?>