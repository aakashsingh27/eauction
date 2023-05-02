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



$iid=$_GET['id'];

$clt_asgn_lqdtr="select * from assign_liquidator where id='$iid'";
$qst_clt_asgn_lqdtr=$db->query($clt_asgn_lqdtr);
$clct_clt_asgn_lqdtr=$qst_clt_asgn_lqdtr->fetch_assoc();

$csmp_id=$clct_clt_asgn_lqdtr['company_id'];
$lqdtor_id=$clct_clt_asgn_lqdtr['liquidator_id'];

$celt_copm_dtl="select * from company where id='$csmp_id'";
$qst_celt_copm_dtl=$db->query($celt_copm_dtl);
$clct_celt_copm_dtl=$qst_celt_copm_dtl->fetch_assoc();
$cmp_nemm=$clct_celt_copm_dtl['company_name'];




$celt_lqdtr_dtl="select * from add_liquidator where id='$lqdtor_id'";
$qst_celt_lqdtr_dtl=$db->query($celt_lqdtr_dtl);
$clcllt_celt_lqdtr_dtl=$qst_celt_lqdtr_dtl->fetch_assoc();

$lqdtor_nem=$clcllt_celt_lqdtr_dtl['liquidator_name'];




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
">Edit Assign company to liquidator</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Edit Assign company to liquidator</li>
</ol>
<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
 





<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquidator</label>
<select name="lqdtr_id"  class="form-control"  required style="border:1px solid black !important;">
<option value="<?php echo $lqdtor_id;?>"><?php echo $lqdtor_nem;?></option>
<?php 
$clt_lqdtr_dtl="select * from add_liquidator";
$qst_clt_lqdtr_dtl=$db->query($clt_lqdtr_dtl);
while($clct_clt_lqdtr_dtl=$qst_clt_lqdtr_dtl->fetch_assoc())
{

$lqdtr_id=$clct_clt_lqdtr_dtl['id'];
$lqdtr_nem=$clct_clt_lqdtr_dtl['liquidator_name'];
?>
<option value="<?php echo $lqdtr_id;?>"><?php echo $lqdtr_nem;?></option>
<?php 
}?>
</select>
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Company name</label>
<select name="cmp_id"  class="form-control"  required style="border:1px solid black !important;">
<option value="<?php echo $csmp_id;?>"><?php echo $cmp_nemm;?></option>
<?php 
$clt_cmp_dtl="select * from company";
$qst_clt_cmp_dtl=$db->query($clt_cmp_dtl);
while($clct_clt_cmp_dtl=$qst_clt_cmp_dtl->fetch_assoc())
{

$cmp_id=$clct_clt_cmp_dtl['id'];
$cmp_nem=$clct_clt_cmp_dtl['company_name'];
?>
<option value="<?php echo $cmp_id;?>"><?php echo $cmp_nem;?></option>
<?php 
}?>
</select>
</div>


<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button> <a href="view_asgn_lqdtr.php" class="btn btn-warning">Back</a>
</div>
</div>
</form>

<?php 
if(isset($_POST['submit']))
{

$cmep_id=$_POST['cmp_id'];

$lqdtr_id=$_POST['lqdtr_id'];

$slt_dplc_dtl="select * from assign_liquidator where company_id='$cmep_id'";
$qst_slt_dplc_dtl=$db->query($slt_dplc_dtl);
$dplc_cnt=mysqli_num_rows($qst_slt_dplc_dtl);


if($dplc_cnt==0)
{


$ad_prdt="update assign_liquidator set
company_id='$cmep_id',
liquidator_id='$lqdtr_id' where id='$iid'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('company assigned updated successfully.');window.location='view_asgn_lqdtr.php';</script>";

}
else
{
    echo "<script>window.alert('Error');window.location='';</script>";
}

}
else
{
    echo "<script>window.alert('this company is already assigned to this liquiditor.');window.location='';</script>";


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