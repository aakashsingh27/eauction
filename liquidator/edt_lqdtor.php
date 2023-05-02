<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');

if (!empty($_SESSION['ibc'])) {
if ($_SESSION['ibc'] != session_id()) {
header('Location: index.php');
exit;
}
} else {
header('Location: login.php');
exit;
}
$logintype = $_SESSION['logintype'];
$a_idchk = $_SESSION['a_id'];

$ausernmae = $_SESSION['a_name'];

$comp_select = $db->query("SELECT * FROM `admin`");
$comp_fetch = $comp_select->fetch_object();
$a_company = $comp_fetch->a_company;
$check_a_name = $_SESSION['a_name'];



$lqtor_id=$_GET['id'];

$clt_dtl="select * from add_liquidator where id='$lqtor_id'";
$qst_clt_dtl=$db->query($clt_dtl);
$clct_clt_dtl=$qst_clt_dtl->fetch_assoc();

$lqdtr_nem=$clct_clt_dtl['liquidator_name'];
$lqdtr_emnl=$clct_clt_dtl['liquidator_email'];
$lqdtr_pswd=$clct_clt_dtl['liquidator_password'];
$lqdtr_adrs=$clct_clt_dtl['liquidator_address'];
$lqdtr_adrs2=$clct_clt_dtl['liquidator_address2'];
$lqd_cty=$clct_clt_dtl['input_city'];
$stte=$clct_clt_dtl['input_state'];
$pnced=$clct_clt_dtl['input_zip'];



?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<h2 class="mt-30 page-title" style="
    color: red;
    font-size: 30px;
    font-weight: 600;
">Edit Liquiditor</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active"></li>
</ol>
<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
 





<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquiditor name</label>
<input type="text" name="ttle" value="<?php echo $lqdtr_nem;?>" class="form-control"  placeholder="Enter Liquitor name">
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquiditor Email</label>
<input type="email" name="lqditor_emnl" value="<?php echo $lqdtr_emnl;?>" class="form-control"  placeholder="Enter Liquitor Email">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquiditor Password</label>
<input type="text" name="lqditor_pswd" value="<?php echo $lqdtr_pswd;?>" class="form-control"  placeholder="Enter Liquitor password">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquiditor Address</label>
<input type="text" name="lqditor_adrs" value="<?php echo $lqdtr_adrs;?>" class="form-control"  placeholder="Enter Liquitor address">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquiditor Address 2</label>
<input type="text" name="lqditor_adrstw" value="<?php echo $lqdtr_adrs2;?>" class="form-control"  placeholder="Enter Liquitor address">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquiditor City</label>
<input type="text" name="lqditor_cty" value="<?php echo $lqd_cty;?>" class="form-control"  placeholder="Enter Liquitor city">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquiditor State</label>
<input type="text" name="lqditor_stet" class="form-control"  placeholder="Enter Liquitor State" value="<?php echo $stte?>">
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquiditor Pincode</label>
<input type="text" name="lqditor_pnced" value="<?php echo $pnced?>" class="form-control"  placeholder="Enter Liquitor Pincode">
</div>




<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button>
</div>
</div>
</form>

<?php 
if(isset($_POST['submit']))
{

$ttel=$_POST['ttle'];

$lqdtr_eml=$_POST['lqditor_emnl'];

$lqdtr_pswd=$_POST['lqditor_pswd'];

$lqdtr_adrs=$_POST['lqditor_adrs'];

$lqdtr_adr_tw=$_POST['lqditor_adrstw'];

$lqdtr_cty=$_POST['lqditor_cty'];

$lqdtr_stet=$_POST['lqditor_stet'];

$lqdtr_pnced=$_POST['lqditor_pnced'];



$ad_prdt="update add_liquidator set
liquidator_name='$ttel',
liquidator_email='$lqdtr_eml',
liquidator_password='$lqdtr_pswd',
liquidator_address='$lqdtr_adrs',
liquidator_address2='$lqdtr_adr_tw',
input_city='$lqdtr_cty',
input_state='$lqdtr_stet',
input_zip='$lqdtr_pnced' where id='$lqtor_id'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('Liquiditor updated Successfully');window.location='';</script>";

}
else
{
    echo "<script>window.alert('Error');window.location='';</script>";
}


}
?>


</div>
</div>
</main>




<?php include 'footer.php'; 
?>


<script>
$(document).ready(function() { 
 $("#ddsd").select2();
});
</script>


<script>
                        CKEDITOR.replace( 'srv_dtl' );
                </script>

<?php
ob_flush();

?>