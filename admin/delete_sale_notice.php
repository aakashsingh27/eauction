<?php 
@ob_start();
include('config/config.php');

$sls_ntec_id=$_GET['id'];




 $clt_lev_bddng_cnt="select * from livebidding where salenotice_id='$sls_ntec_id'";

$qst_clt_lev_bddng_cnt=$db->query($clt_lev_bddng_cnt);
$clt_lv_bdng_cnt=mysqli_num_rows($qst_clt_lev_bddng_cnt);

if($clt_lv_bdng_cnt > 0)
{
       echo "<script>window.alert('This Entry is already exist in livebidding first delete from there.');window.location='view_sales_notice.php';</script>";
}
else if($clt_lv_bdng_cnt==0)
{
$slt_detl="delete from create_sale where id='$sls_ntec_id'";
$qst_slt_detl=$db->query($slt_detl);

if($qst_slt_detl)
{
    echo "<script>window.alert('Sales notice deleted successfully.');window.location='view_sales_notice.php';</script>";
}
}



ob_flush();
?>