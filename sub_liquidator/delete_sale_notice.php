<?php 
include('config/config.php');

$id=$_GET['id'];

$dlt_sel_ntec="delete from create_sale where id='$id'";
$qst_dlt_sel_ntec=$db->query($dlt_sel_ntec);
if($qst_dlt_sel_ntec)
{
echo "<script>window.location='view_sale_notice.php';window.alert('sale notice deleted successfully');</script>";

}

?>