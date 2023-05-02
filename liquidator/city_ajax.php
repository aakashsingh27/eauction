<?php 
include('config/config.php');
$ste_id=$_POST['txt1'];

$clt_cty_dtl="select * from `city` where `state_id`='$ste_id'";
$qst_clt_cty_dtl=$db->query($clt_cty_dtl);
?>
<option value="">Choose City</option>
<?php
while($clct_clt_cty_dtl=$qst_clt_cty_dtl->fetch_assoc())
{
    $city_neme=$clct_clt_cty_dtl['city_name'];
    $city_id=$clct_clt_cty_dtl['id'];
    ?>
<option value='<?php echo $city_id;?>'><?php echo $city_neme;?></option>
    <?php
}

?>