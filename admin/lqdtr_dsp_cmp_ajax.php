<?php
include("config/config.php");

$lqdtr_id=$_POST['txt1'];

$clt_dtl_dspl_cmpy="select * from assign_display_company_liquidator where liquidator_id='$lqdtr_id'";
$qst_clt_dtl_dspl_cmpy=$db->query($clt_dtl_dspl_cmpy);
?>

<option value="">Choose Display company name</option>
<?php
while($clct_clt_dtl_dspl_cmpy=$qst_clt_dtl_dspl_cmpy->fetch_assoc())
{
$dsp_cmp_id=$clct_clt_dtl_dspl_cmpy['company_id'];

$clt_cmp_dtl="select * from `display_company` where `id`='$dsp_cmp_id'";
$qst_clt_cmp_dtl=$db->query($clt_cmp_dtl);
$clct_clt_cmp_dtl=$qst_clt_cmp_dtl->fetch_assoc();

$cemp_neem=$clct_clt_cmp_dtl['company_name'];
$cemp_iid=$clct_clt_cmp_dtl['id'];
?>
<option value="<?php echo $cemp_iid;?>"><?php echo $cemp_neem;?></option>
<?php
}




?>