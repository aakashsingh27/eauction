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





$prv_dtl="select * from plan_details where id='1'";
$qst_prv_dtl=$db->query($prv_dtl);
$clct_prv_dtl=$qst_prv_dtl->fetch_assoc();

$prv_cnt=$clct_prv_dtl['content'];



?>

<?php include 'header.php'; ?>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
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
">Plan Details Content</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active"></li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-12 ">
<label class="form-label" style="font-size:22px !important; padding-top:5px;padding-bottom:5px;">Plan Details Content</label>
<textarea name="hm_cntnt" class="form-control" ><?php echo $prv_cnt?></textarea>



<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary' style='margin-top:5px;'>Submit</button>
</div>
</div>
</form>


<?php 
if(isset($_POST['submit']))
{

$prc_cntnt=$_POST['hm_cntnt'];



$ad_trsnctn="update plan_details set 
content='$prc_cntnt'
where id='1'";
$qst_ad_trsnctn=$db->query($ad_trsnctn);
if($qst_ad_trsnctn)
{
 echo "<script>window.alert('Plan Details content Updated Successfully');window.location=''</script>";   
}


}
?>


</div>
</div>
</main>
<script>
CKEDITOR.replace( 'hm_cntnt' );
</script>

<?php include 'footer.php'; 

ob_flush();

?>