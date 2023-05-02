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
$lqdtr_mbel=$clct_clt_dtl['mobile'];



?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<!--<h2 class="mt-30 page-title" style="
    color: red;
    font-size: 30px;
    font-weight: 600;
">Edit Liquidator</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Edit Liquidator</li>
</ol>
<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
 

<div class='col-md-12'>
<h3>Basic Details</h3>
<hr style="
    border: 1px solid #6a6a6a;
"></hr>
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquidator Name</label>
<input type="text" name="ttle" value="<?php echo $lqdtr_nem;?>" class="form-control"  placeholder="Enter Liquidator name" style="border:1px solid black !important;" required>
</div>




<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquidator Mobile</label>
<input type="number" name="lqditor_mbl" value="<?php echo $lqdtr_mbel;?>" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" autocomplete="off" maxlength='10'  placeholder="Enter Liquidator Mobile" style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquidator Email</label>
<input type="email" name="lqditor_emnl" value="<?php echo $lqdtr_emnl;?>" class="form-control"  placeholder="Enter Liquitor Email" style="border:1px solid black !important;" required>
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquidator Password</label>
<input type="text" name="lqditor_pswd" value="<?php echo $lqdtr_pswd;?>" class="form-control"  placeholder="Enter Liquitor password" style="border:1px solid black !important;" required>
</div>

<div class='col-md-12'>
<h3>Address</h3>
<hr style="
    border: 1px solid #6a6a6a;
"></hr>
</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquidator Address</label>
<input type="text" name="lqditor_adrs" value="<?php echo $lqdtr_adrs;?>" class="form-control"  placeholder="Enter liquidator address" style="border:1px solid black !important;" required>
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquidator Address 2</label>
<input type="text" name="lqditor_adrstw" value="<?php echo $lqdtr_adrs2;?>" class="form-control"  placeholder="Enter liquidator address" style="border:1px solid black !important;" required>
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquidator City</label>
<input type="text" name="lqditor_cty" value="<?php echo $lqd_cty;?>" class="form-control"  placeholder="Enter liquidator city" style="border:1px solid black !important;" required>
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquidator State</label>
<input type="text" name="lqditor_stet" class="form-control"  placeholder="Enter liquidator state" value="<?php echo $stte?>" style="border:1px solid black !important;" required>
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquidator Pincode</label>
<input type="number" min='0' name="lqditor_pnced" value="<?php echo $pnced?>" class="form-control"  placeholder="Enter liquidator pincode" style="border:1px solid black !important;" required>
</div>




<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button> <a href="view_liquiditor.php" class="btn btn-warning" >Back</a>
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

$lqd_mbel=$_POST['lqditor_mbl'];


$clt_ldqtrr_dplc_eml="select * from add_liquidator where liquidator_email='$lqdtr_eml' and id='$lqtor_id'";
$qst_clt_ldqtrr_dplc_eml=$db->query($clt_ldqtrr_dplc_eml);
$clt_cnt_ldqtrr_dplc_eml=mysqli_num_rows($qst_clt_ldqtrr_dplc_eml);

if($clt_cnt_ldqtrr_dplc_eml==1)
{

$ad_prdt="update add_liquidator set
liquidator_name='$ttel',
liquidator_email='$lqdtr_eml',
liquidator_password='$lqdtr_pswd',
liquidator_address='$lqdtr_adrs',
liquidator_address2='$lqdtr_adr_tw',
input_city='$lqdtr_cty',
mobile='$lqd_mbel',
input_state='$lqdtr_stet',
input_zip='$lqdtr_pnced' where id='$lqtor_id'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('Liquidator updated successfully.');window.location='';</script>";

}
else
{
    echo "<script>window.alert('Error');window.location='';</script>";
}

}
elseif($clt_cnt_ldqtrr_dplc_eml==0)
{
    
    $clt_dplc_cnt="select * from add_liquidator where liquidator_email='$lqdtr_eml' and id!='$lqtor_id'";
    $qst_clt_dplc_cnt=$db->query($clt_dplc_cnt);
    $clct_dplc_eml_cnt=mysqli_num_rows($qst_clt_dplc_cnt);
    
    if($clct_dplc_eml_cnt==0)
    {
        $ad_prdt="update add_liquidator set
liquidator_name='$ttel',
liquidator_email='$lqdtr_eml',
liquidator_password='$lqdtr_pswd',
liquidator_address='$lqdtr_adrs',
liquidator_address2='$lqdtr_adr_tw',
input_city='$lqdtr_cty',
mobile='$lqd_mbel',
input_state='$lqdtr_stet',
input_zip='$lqdtr_pnced' where id='$lqtor_id'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('Liquidator updated successfully.');window.location='view_liquiditor.php';</script>";

}
else
{
    echo "<script>window.alert('Error');window.location='';</script>";
}
        
    }
    else
    {
        echo "<script>window.alert('This email is already exist please try again.');window.location='';</script>";
    }
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