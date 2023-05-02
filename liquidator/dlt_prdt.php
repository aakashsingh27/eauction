<?php 
include("config/conig.php");

$prd_id=$_GET['id'];

$dlt_prd="delete from products where id='$prd_id'";
$qst_dlt_prd=$db->query($dlt_prd);

if($qst_dlt_prd)
{
    echo "<script>window.alert('Deleted Success');window.location='';</script>";
}


?>