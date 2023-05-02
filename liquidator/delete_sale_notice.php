<?php 
include('config/config.php');

$id=$_GET['id'];


 $clt_lev_bddng_cnt="select * from livebidding where salenotice_id='$id'";

$qst_clt_lev_bddng_cnt=$db->query($clt_lev_bddng_cnt);
$clt_lv_bdng_cnt=mysqli_num_rows($qst_clt_lev_bddng_cnt);

if($clt_lv_bdng_cnt > 0)
{
       echo "<script>window.alert('This Entry is already exist in livebidding first delete from there.');window.location='view_sale_notice.php';</script>";
}
else if($clt_lv_bdng_cnt==0)
{





$dlt_sel_ntec="delete from create_sale where id='$id'";
$qst_dlt_sel_ntec=$db->query($dlt_sel_ntec);
if($qst_dlt_sel_ntec)
{
echo "<script>window.location='view_sale_notice.php';window.alert('Sales notice deleted successfully');</script>";
}
}
?>