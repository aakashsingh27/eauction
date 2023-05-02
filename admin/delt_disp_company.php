<?php 
include('config/config.php');
$id=$_GET['id'];



$dlt_cmpy="delete from display_company where id='$id'";
$qst_dlt_cmpy=$db->query($dlt_cmpy);
if($qst_dlt_cmpy)
{
    echo "<script>window.location='view_disp_company.php';window.alert('Company Deleted successfully');</script>";
}

?>