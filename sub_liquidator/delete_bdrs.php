<?php 
include('config/config.php');
$idi=$_GET['id'];


$dlet_bidr="delete from newbidder_login where id='$idi'";
$qst_dlet_bidr=$db->query($dlet_bidr);
if($qst_dlet_bidr)
{
    echo "<script>window.location='vw_bidders.php';window.alert('Bidder deleted successfully');</script>";
}
?>