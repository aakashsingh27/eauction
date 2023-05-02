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

<!---------Modal links start------------>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<!--------Modal links end------------->




<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<!--<h2 class="mt-30 page-title" style="-->
<!--    color: red;-->
<!--    font-size: 30px;-->
<!--    font-weight: 600;-->
<!--">Add Liquiditor</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Add Liquiditor</li>
</ol>
<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">

<div class='col-md-12'>
<h3>Basic Details</h3>
<hr style="
    border: 1px solid #707070;
"></hr>
</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquiditor name</label>
<input type="text" name="ttle" maxlength='40' class="form-control"  placeholder="Enter liquidator name" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquidator mobile</label>
<input type="number" name="mbel"  class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" autocomplete="off" maxlength='10'  placeholder="Enter Liquidator mobile" required style="border:1px solid black !important;">
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquidator Email</label>
<input type="email" name="lqditor_emnl"  class="form-control" maxlength='50' placeholder="Enter liquidator email" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquidator Password</label>
<input type="text" name="lqditor_pswd"  class="form-control" maxlength='40' placeholder="Enter liquidator password" required style="border:1px solid black !important;">
</div>



<div class='col-md-12' style="margin-top: 15px;">
<h3>Address</h3>
<hr style="
    border: 1px solid #707070;
"></hr>
</div>
<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquidator Address</label>
<input type="text" name="lqditor_adrs"  class="form-control"  maxlength='200' placeholder="Enter liquidator address" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquidator Address 2</label>
<input type="text" name="lqditor_adrstw"  class="form-control" maxlength='200'  placeholder="Enter liquidator address" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquiditor City</label>
<input type="text" name="lqditor_cty"  class="form-control" maxlength="30"  placeholder="Enter liquidator city" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquidator State</label>
<input type="text" name="lqditor_stet" class="form-control" maxlength='30' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" placeholder="Enter Liquitor State" required style="border:1px solid black !important;">
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Liquiditor Pincode</label>
<input type="number" name="lqditor_pnced" min='0' value="<?php echo $pnced?>"  class="form-control"  placeholder="Enter liquidator pincode" required style="border:1px solid black !important;">
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
        <h5 style="font-weight:bold;"> Do you want to add liquidator and send email notification ?</h5>
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
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
Submit
  </button>
 <button type="button" class="btn btn-warning" onclick="window.location='view_liquiditor.php';">Back</button>
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

$lqdtr_mbel=$_POST['mbel'];


$clt_lqdtr_dtl="select * from add_liquidator where liquidator_email='$lqdtr_eml'";
$qst_clt_lqdtr_dtl=$db->query($clt_lqdtr_dtl);
$clt_cnt=mysqli_num_rows($qst_clt_lqdtr_dtl);


if($clt_cnt==0)
{
    
$ad_prdt="insert into add_liquidator set
liquidator_name='$ttel',
liquidator_email='$lqdtr_eml',
liquidator_password='$lqdtr_pswd',
liquidator_address='$lqdtr_adrs',
liquidator_address2='$lqdtr_adr_tw',
input_city='$lqdtr_cty',
mobile='$lqdtr_mbel',
input_state='$lqdtr_stet',
email_sent_status='sent',
input_zip='$lqdtr_pnced'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
include('liquidator_mail.php');
echo "<script>window.alert('Liquidator added successfully.');window.location='';</script>";

}
}
else
{
    echo "<script>window.alert('This email is already exist please try again.');window.location='';</script>";
}


}
?>

<?php 
if(isset($_POST['sbt_without_email']))
{

$ttel=$_POST['ttle'];

$lqdtr_eml=$_POST['lqditor_emnl'];

$lqdtr_pswd=$_POST['lqditor_pswd'];

$lqdtr_adrs=$_POST['lqditor_adrs'];

$lqdtr_adr_tw=$_POST['lqditor_adrstw'];

$lqdtr_cty=$_POST['lqditor_cty'];

$lqdtr_stet=$_POST['lqditor_stet'];

$lqdtr_pnced=$_POST['lqditor_pnced'];

$lqdtr_mbel=$_POST['mbel'];


$clt_lqdtr_dtl="select * from add_liquidator where liquidator_email='$lqdtr_eml'";
$qst_clt_lqdtr_dtl=$db->query($clt_lqdtr_dtl);
$clt_cnt=mysqli_num_rows($qst_clt_lqdtr_dtl);


if($clt_cnt==0)
{
    
$ad_prdt="insert into add_liquidator set
liquidator_name='$ttel',
liquidator_email='$lqdtr_eml',
liquidator_password='$lqdtr_pswd',
liquidator_address='$lqdtr_adrs',
liquidator_address2='$lqdtr_adr_tw',
input_city='$lqdtr_cty',
mobile='$lqdtr_mbel',
input_state='$lqdtr_stet',
input_zip='$lqdtr_pnced'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
//include('liquidator_mail.php');
echo "<script>window.alert('Liquidator added successfully.');window.location='';</script>";

}
}
else
{
    echo "<script>window.alert('This email is already exist please try again.');window.location='';</script>";
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