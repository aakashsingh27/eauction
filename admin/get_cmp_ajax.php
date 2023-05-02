<?php 
include("config/config.php");

$lqdter_iid=$_POST['txt1'];

$clt_lqdtr="select * from assign_liquidator where liquidator_id='$lqdter_iid'";
$qst_clt_lqdtr=$db->query($clt_lqdtr);
?>
<option value=''>-Choose Company-</option>
<?php
while($clct_clt_lqdtr=$qst_clt_lqdtr->fetch_assoc())
{
    
    $cmp_iid=$clct_clt_lqdtr['company_id'];
    
    
    $clt_dtl="select * from company where id='$cmp_iid'";
    $qst_clt_dtl=$db->query($clt_dtl);
    $clct_clt_dtl=$qst_clt_dtl->fetch_assoc();
    
    $cemp_nem=$clct_clt_dtl['company_name'];
     $cemp_id=$clct_clt_dtl['id'];
    ?>
    <option value="<?php echo $cemp_id;?>"><?php echo $cemp_nem;?></option>
    <?php
}
?>