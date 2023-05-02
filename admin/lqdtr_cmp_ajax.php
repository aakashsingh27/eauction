
<?php   
include('config/config.php');
$lqdtr_id=$_POST['txt1'];
$slt_cmp_dtl="select * from assign_liquidator where liquidator_id='$lqdtr_id'";
$qst_slt_cmp_dtl=$db->query($slt_cmp_dtl);
?>
<option value="">choose asset</option>
<?php
while($clct_slt_cmp_dtl=$qst_slt_cmp_dtl->fetch_assoc())
{

  $cmpp_iud=$clct_slt_cmp_dtl['company_id'];

  $clt_cmp_dtl="select * from company where id='$cmpp_iud'";
  $qst_clt_cmp_dtl=$db->query($clt_cmp_dtl);
  $clct_clt_cmp_dtl=$qst_clt_cmp_dtl->fetch_assoc();

  $cmp_nem=$clct_clt_cmp_dtl['company_name'];
  $cmpid=$clct_clt_cmp_dtl['id'];


?>

<option value="<?php echo $cmpid;?>"><?php echo $cmp_nem;?></option>
<?php } ?>