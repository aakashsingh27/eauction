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
<!--<h2 class="mt-30 page-title" style="
    color: red;
    font-size: 30px;
    font-weight: 600;
">Add Company</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Add display Company</li>
</ol>
<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
 





<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Company name</label>
<input type="text" name="cmp_nem"  class="form-control"  placeholder="Enter company name" style="border:1px solid black !important;" required>
</div>





<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button> <a href="view_company.php" class="btn btn-warning" >Back</a>
</div>
</div>
</form>

<?php 
if(isset($_POST['submit']))
{

$ttel=$_POST['cmp_nem'];


$clt_dtl="select * from display_company where `company_name`='$ttel'";
$qst_clt_dtl=$db->query($clt_dtl);
$cnt_clt_dtl=mysqli_num_rows($qst_clt_dtl);

if($cnt_clt_dtl==0)


{
    $ad_prdt="insert into display_company set
company_name='$ttel'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('display company Added Successfully');window.location='view_disp_company.php';</script>";

}
else
{
    echo "<script>window.alert('Error');window.location='';</script>";
}
}
else
{
    echo "<script>window.location='';window.alert('This display compnay is already exist please try again');</script>";
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