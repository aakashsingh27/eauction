<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');
$crt_det_tme=date('d-m-Y H:i:s');
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


 

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>





<!---------Modal links start------------>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<!--------Modal links end------------->





<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<!--<h2 class="mt-30 page-title" style="
    color: red;
    font-size: 30px;
    font-weight: 600;
">Assign company to liquidator</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Assign company to liquidator</li>
</ol>
<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
 





<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquidator</label>
<select name="lqdtr_id"  class="form-control"  required style="border:1px solid black !important;">
<option value="">-Choose liquidator-</option>
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
<select name="cmp_id"  class="form-control"  style="border:1px solid black !important;" required>
    
<option value="">-Choose company-</option>
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

<!-- Modal -->
<div class="modal fade" id="myModal">
<div class="modal-dialog">
<div class="modal-content">

<!-- Modal Header -->
<div class="modal-header">
<!--  <h4 class="modal-title">Modal Heading</h4>-->
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<!-- Modal body -->
<div class="modal-body">
<h5 style="font-weight:bold;"> Do you want to assign company to liquidator and send email notification ?</h5>
</div>

<!-- Modal footer -->
<div class="modal-footer">
<button type='submit' name="submit" class='btn btn-primary'>Submit with email</button>   <button type="submit" class="btn btn-warning" name="sbt_without_email" >Submit without email</button> <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>

</div>
</div>
</div>
  <!-------Modal End------------->

<div class="form-group col-md-12">

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" class='btn btn-primary'>Submit</button> <a href="view_asgn_lqdtr.php" class="btn btn-warning" >Back</a>
</div>
</div>
</form>

<?php 
if(isset($_POST['submit']))
{

$cmep_id=$_POST['cmp_id'];

$lqdtr_id=$_POST['lqdtr_id'];

$slt_dplc_dtl="select * from assign_liquidator where company_id='$cmep_id' and liquidator_id='$lqdtr_id'";
$qst_slt_dplc_dtl=$db->query($slt_dplc_dtl);
$dplc_cnt=mysqli_num_rows($qst_slt_dplc_dtl);


if($dplc_cnt==0)
{

$clt_dtl="select * from company where id='$cmep_id'";
$qst_clt_dtl=$db->query($clt_dtl);
$clct_clt_dtl=$qst_clt_dtl->fetch_assoc();

$cmp_nem=$clct_clt_dtl['company_name'];


$clt_lqdtr_dtl="select * from add_liquidator where id='$lqdtr_id'";
$qst_clt_lqdtr_dtl=$db->query($clt_lqdtr_dtl);
$clct_clt_lqdtr_dtl=$qst_clt_lqdtr_dtl->fetch_assoc();

$lqdtr_eml=$clct_clt_lqdtr_dtl['liquidator_email'];
$lqdter_nem=$clct_clt_lqdtr_dtl['liquidator_name'];



$ad_prdt="insert into assign_liquidator set
company_id='$cmep_id',
liquidator_id='$lqdtr_id',
email_sent_status='sent'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
    include('liquidator_assign_company_mail.php');
echo "<script>window.alert('Company assigned successfully.');window.location='';</script>";

}
else
{
    echo "<script>window.alert('Error');window.location='';</script>";
}

}
else
{
    echo "<script>window.alert('This company is already assigned to liquidator.');window.location='';</script>";


}
}
?>

<?php 
if(isset($_POST['sbt_without_email']))
{
    $cmep_id=$_POST['cmp_id'];

$lqdtr_id=$_POST['lqdtr_id'];

$slt_dplc_dtl="select * from assign_liquidator where company_id='$cmep_id' and liquidator_id='$lqdtr_id'";
$qst_slt_dplc_dtl=$db->query($slt_dplc_dtl);
$dplc_cnt=mysqli_num_rows($qst_slt_dplc_dtl);


if($dplc_cnt==0)
{

$clt_dtl="select * from company where id='$cmep_id'";
$qst_clt_dtl=$db->query($clt_dtl);
$clct_clt_dtl=$qst_clt_dtl->fetch_assoc();

$cmp_nem=$clct_clt_dtl['company_name'];


$clt_lqdtr_dtl="select * from add_liquidator where id='$lqdtr_id'";
$qst_clt_lqdtr_dtl=$db->query($clt_lqdtr_dtl);
$clct_clt_lqdtr_dtl=$qst_clt_lqdtr_dtl->fetch_assoc();

$lqdtr_eml=$clct_clt_lqdtr_dtl['liquidator_email'];
$lqdter_nem=$clct_clt_lqdtr_dtl['liquidator_name'];



$ad_prdt="insert into assign_liquidator set
company_id='$cmep_id',
liquidator_id='$lqdtr_id'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
    //include('liquidator_assign_company_mail.php');
echo "<script>window.alert('Company assigned successfully.');window.location='';</script>";

}
else
{
    echo "<script>window.alert('Error');window.location='';</script>";
}

}
else
{
    echo "<script>window.alert('This company is already assigned to liquidator.');window.location='';</script>";


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