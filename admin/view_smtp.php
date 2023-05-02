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




$clt_dtl="select * from email_api_credentials where id='1'";
$qst_clt_dtl=$db->query($clt_dtl);
$clct_clt_dtl=$qst_clt_dtl->fetch_assoc();

$usre_emnl=$clct_clt_dtl['email'];
$psewd=$clct_clt_dtl['password'];
$prt_nubr=$clct_clt_dtl['port_number'];
$honst=$clct_clt_dtl['host'];
$smtp_auuth=$clct_clt_dtl['smtp_auth'];
$smtp_screr=$clct_clt_dtl['smtp_secure'];
$frem_emnnl=$clct_clt_dtl['from_mail'];



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
<!--">View SMTP</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">View SMTP</li>
</ol>
<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">

<div class='col-md-12'>
<!--<h3>Basic Details</h3>-->
<hr style="
    border: 1px solid #707070;
"></hr>
</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">User email</label>
<input type="email" name="usr_emnl" maxlength='80' class="form-control"  value="<?php echo $usre_emnl;?>" placeholder="Enter user email" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Password</label>
<input type="text" name="password"  class="form-control" value="<?php echo $psewd;?>" autocomplete="off" placeholder="Enter mail password" required style="border:1px solid black !important;">
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Port number</label>
<input type="number" name="prt_nmber"  class="form-control" maxlength='50'  value="<?php echo $prt_nubr;?>" placeholder="Enter port number" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Host</label>
<input type="text" name="hst"  class="form-control" maxlength='40' placeholder="Enter host" value="<?php echo $honst;?>" required style="border:1px solid black !important;">
</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">SMPT auth</label>
<input type="text" name="smpt_auth"  class="form-control" placeholder="Enter SMPT auth" value="<?php echo $smtp_auuth;?>" required style="border:1px solid black !important;">
</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">SMPT secure</label>
<input type="text" name="smpt_scre"  class="form-control" placeholder="Enter SMPT secure" value="<?php echo $smtp_screr;?>" required style="border:1px solid black !important;">
</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">From mail</label>
<input type="text" name="frm_emnl"  class="form-control" placeholder="Enter from mail" value="<?php echo $frem_emnnl;?>" required style="border:1px solid black !important;">
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
        <h5 style="font-weight:bold;"> Do you want to update SMTP ?</h5>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
       <button type='submit' name="submit" class='btn btn-primary'>Submit</button>   <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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

$uesr_eml=$_POST['usr_emnl'];
$paswdd=$_POST['password'];
$port_nubr=$_POST['prt_nmber'];
$hsot=$_POST['hst'];
$smtpp_auth=$_POST['smpt_auth'];
$smpt_secre=$_POST['smpt_scre'];
$frem_emnl=$_POST['frm_emnl'];
    
$ad_prdt="update email_api_credentials set
email='$uesr_eml',
password='$paswdd',
port_number='$port_nubr',
host='$hsot',
smtp_auth='$smtpp_auth',
smtp_secure='$smpt_secre',
from_mail='$frem_emnl' where id='1'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('SMTP updated successfully.');window.location='';</script>";

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