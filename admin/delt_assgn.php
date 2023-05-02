<?php 
include('config/config.php');
$iid=$_GET['id'];

$dlt_cmpy="delete from assign_liquidator where id='$iid'";
$qst_dlt_cmpy=$db->query($dlt_cmpy);
if($qst_dlt_cmpy)
{
echo "<script>window.location='view_asgn_lqdtr.php';window.alert('assign liquidator deleted succesfully');</script>";

}

?>