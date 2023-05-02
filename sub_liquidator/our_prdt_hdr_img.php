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



$glr_hdr_dtl="select * from our_product_header_image where id='1'";
$qst_glr_hdr_dtl=$db->query($glr_hdr_dtl);
$clct_glr_hdr_dtl=$qst_glr_hdr_dtl->fetch_assoc();

$glr_hdr_immg=$clct_glr_hdr_dtl['image'];

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<?php
$sql = "SELECT * FROM blog";
if ($result = mysqli_query($db, $sql)) {
$rowcount = mysqli_num_rows($result);
// echo "The total number of rows are: " . $rowcount;
}
?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<h2 class="mt-30 page-title" style="
    color: red;
    font-size: 30px;
    font-weight: 600;
">our product header image</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active"></li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">


<div class="form-group col-md-12 col-xs-12">
<label class="form-label" style="font-size:16px !important;">Photo Image*</label>
<center>
<img src='our_product_header_image/<?php echo $glr_hdr_immg;?>' style="height:100px; width:100px;">
</center>

<input type="file" name="srvc_img" class="form-control"  style="font-size: 10px !important;font-weight: 600 !important;border: 1px solid grey!important;der-radius: 15px !important; */" required>
</div>




<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button>
</div>
</div>
</form>


<?php 
if(isset($_POST['submit']))
{


$filename6 = $_FILES["srvc_img"]["name"];
$tempname6 = $_FILES["srvc_img"]["tmp_name"];
$folder6= "our_product_header_image/".$filename6;
move_uploaded_file($tempname6, $folder6);




$ad_prdt="update our_product_header_image set
image='$filename6' where id='1'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('Image updated Successfully');
window.location='';</script>";

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