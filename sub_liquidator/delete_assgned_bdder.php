<?php 
include('config/config.php');

$iid=$_GET['id'];

$dlt_assgn_bdr="delete from assign_bidders_by_liquidator where id='$iid'";
$qst_dlt_assgn_bdr=$db->query($dlt_assgn_bdr);
if($qst_dlt_assgn_bdr)
{
    echo "<script>window.location='view_assigned_bidders.php';window.alert('assign bidders deleted successfully');</script>";
}

?>