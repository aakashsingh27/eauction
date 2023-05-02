<?php 
include('config/config.php');

$lqdtr_id=$_POST['txt1'];

$clt_lqdtr_dtl="select * from newbidder_login where bidder_add_by_liquiditor_id='$lqdtr_id'";
$qst_clt_lqdtr_dtl=$db->query($clt_lqdtr_dtl);
?>
<option value="" disabled>-Choose Bidder-</otpion>
<?php
while($clct_clt_lqdtr_dtl=$qst_clt_lqdtr_dtl->fetch_assoc())
{
    $bedr_id=$clct_clt_lqdtr_dtl['id'];
    $bedr_neme=$clct_clt_lqdtr_dtl['Bidder_Name'];
    ?>
    <option value="<?php echo $bedr_id;?>"><?php echo $bedr_neme;?></option>
    <?php
}
?>