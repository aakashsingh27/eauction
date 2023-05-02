<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');

$crt_det_tme=date('d-m-Y H:i:s');

echo $uiid=rand(9999,99999);



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
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Add Bidder</li>
</ol>
<div class="container-fluid">

<form method="POST" action="import_bidder.php" enctype="multipart/form-data">
<div class="row">

<div class='col-md-12'>
<h3>Upload Csv</h3>
<hr style="
    border: 1px solid #707070;
"></hr>
</div>
<div class='col-md-12'>
<a href="bidder_csv/bidder_data_format.csv" download class='btn btn-primary' style="float:right;">Download Format</a>
    </div>




<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Choose Liquidator</label>
<select class="form-control" name="lqd_id" required style="border:1px solid black !important;">
<option value="">Choose Liquidator</option>

<?php 
$clt_lqdtrr="select * from add_liquidator";
$qst_clt_lqdtrr=$db->query($clt_lqdtrr);
while($clct_clt_lqdtrr=$qst_clt_lqdtrr->fetch_assoc())
{
$lqdtr_id=$clct_clt_lqdtrr['id'];
$lqdtr_nem=$clct_clt_lqdtrr['liquidator_name'];
?>

<option value="<?php echo $lqdtr_id;?>"><?php echo $lqdtr_nem;?></option>

<?php 
}
?>
</select>
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Choose Status</label>
<select class="form-control" name="sttes" required style="border:1px solid black !important;">
<option value="">Choose Status</option>

<option value="active">active</option>
<option value="deactive">deactive</option>
</select>
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Choose file</label>
<input type="file" name="file" accept=".csv" class="form-control" required style="border:1px solid black !important;">
</div>

<div class="form-group col-md-12">
 <button type="submit" name="Import" class="btn btn-primary" >
Submit
  </button>
 <button type="button" class="btn btn-warning" onclick="window.location='view_liquiditor.php';">Back</button>
</div>
</div>
</form>


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