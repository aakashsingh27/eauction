<?php 
include('config/config.php');

$assign_id=$_GET['id'];

$dlt_assgn_bdr="delete from assign_bidders_by_liquidator where id='$assign_id'";
$qst_dlt_assgn_bdr=$db->query($dlt_assgn_bdr);
if($qst_dlt_assgn_bdr)
{
    echo "<script>window.location='view_assgned_bdrs.php';window.alert('Assign bidder deleted successfully .');</script>";
}
?>