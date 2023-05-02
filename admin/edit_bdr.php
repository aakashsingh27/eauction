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

$bdrs_id=$_GET['id'];


$usr_lst="select * from newbidder_login where  id='$bdrs_id'";
$qst_usr_lst=$db->query($usr_lst);
$sno=1;
$clct_usr_lst=$qst_usr_lst->fetch_assoc();
$bdr_nem=$clct_usr_lst['Bidder_Name'];
$bdr_emnl=$clct_usr_lst['Bidder_Email'];
$bdr_mnbl=$clct_usr_lst['bidder_mobile'];
$bdr_pswd=$clct_usr_lst['Bidder_Password'];
$bdr_sts=$clct_usr_lst['status'];
$bdr_uuid=$clct_usr_lst['uid'];
$bdr_id=$clct_usr_lst['id'];



?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid" >
<!--<h2 class="mt-30 page-title" style="-->
<!--    color: red;-->
<!--    font-size: 30px;-->
<!--    font-weight: 600;-->
<!--">Edit Bidder</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Edit Bidder</li>
</ol>
<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Enter name</label>
<input type="text" name="bdr_nem" value="<?php echo $bdr_nem;?>" maxlength="30" class="form-control"  placeholder="Enter name" required style="border:1px solid black !important;">
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Bidder email</label>
<input type="email" name="bdr_emnl"  value="<?php echo $bdr_emnl;?>"  maxlength="50" class="form-control"  placeholder="Enter Bidder email" required style="border:1px solid black !important;">
</div>




<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Bidder mobile</label>
<input type="number" name="bdr_mbl"  class="form-control" value="<?php echo $bdr_mnbl;?>" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Enter bidder mobile" required style="border:1px solid black !important;">
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Bidder UID</label>
<input type="number" name="bdr_uuid"  class="form-control" value="<?php echo $bdr_uuid;?>"  maxlength="20" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Enter bidder UID" required style="border:1px solid black !important;">
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Bidder password</label>
<input type="text" name="bidr_pwd" maxlength="30" class="form-control" value="<?php echo $bdr_pswd;?>"  placeholder="Enter bidder password" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Status</label>
<select name="bidr_sts"  class="form-control" required style="border:1px solid black !important;">
<option value="<?php echo $bdr_sts;?>" ><?php echo $bdr_sts;?></option>
<?php 
if($bdr_sts=="active")
{
?>
<option value="deactive">deactive</option>
<?php 
}
if($bdr_sts=="deactive")
{
?>
<option value="active">active</option>
<?php 
}
?>

</select>
</div>

<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button>

<a href="view_bdrs.php" class='btn btn-warning' >Back</a>
</div>
</div>
</form>

<?php 



if(isset($_POST['submit']))
{
$bdr_nem =$_POST['bdr_nem'];
$bdr_emml =$_POST['bdr_emnl'];
$bdr_pwd = $_POST['bidr_pwd'];
$bdr_mbl_nber=$_POST['bdr_mbl'];
$bdr_stts=$_POST['bidr_sts'];
$bbedr_uiiid=$_POST['bdr_uuid'];

$clt_bddr_cnt="select * from newbidder_login where `uid`='$bbedr_uiiid' and id='$bdrs_id'";
$qst_clt_bddr_cnt=$db->query($clt_bddr_cnt);

$cclt_bddr_cnt=mysqli_num_rows($qst_clt_bddr_cnt);
if($cclt_bddr_cnt==1)
{

$sql="update `newbidder_login` set 
`Bidder_Name`='$bdr_nem',
`Bidder_Email`='$bdr_emml',
`Bidder_Password`='$bdr_pwd',
`bidder_mobile`='$bdr_mbl_nber',
`status`='$bdr_stts' where id='$bdrs_id'";
$result=mysqli_query($db,$sql);

// print_r($sql);
if($result)
{

echo "<script>alert('Bidder update successfully.');
window.location.href='';
</script>";
// echo "check";



} else { 
echo "<script>alert(' Not inserted please try again.');
window.location.href='';
</script>";
// echo "not check";
}
}
else if($cclt_bddr_cnt==0)
{
    $clt_dbddr_cnt="select * from newbidder_login where `uid`='$bbedr_uiiid'";
$qst_clst_bddr_cnt=$db->query($clt_dbddr_cnt);

$cclt_bsdddr_cnt=mysqli_num_rows($qst_clst_bddr_cnt);
if($cclt_bsdddr_cnt==0)
{
    $sql="update `newbidder_login` set 
`Bidder_Name`='$bdr_nem',
`Bidder_Email`='$bdr_emml',
`Bidder_Password`='$bdr_pwd',
`bidder_mobile`='$bdr_mbl_nber',
`uid`='$bbedr_uiiid',
`status`='$bdr_stts' where id='$bdrs_id'";
$result=mysqli_query($db,$sql);

if($result)
{
echo "<script>window.alert('Bidder updated successfully.');window.location='';</script>";
}
}
else
{
echo "<script>window.alert('This UID is already exist please try again.');window.location='';</script>";
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