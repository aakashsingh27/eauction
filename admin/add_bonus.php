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

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


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
">Add User Bonus</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active"></li>
</ol>
<div class="container-fluid">


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-md-12 col-xs-6 ">
<label class="form-label" style="font-size:16px !important;">Choose User*</label>
<select name="usr_nme" id="ddsd" class="form-control"  style="font-size: 20px !important;font-weight: 600 !important;border: 2px solid grey!important;border-radius: 15px !important;" required>
    <option>Choose User </option>
    <?php 
    
    $usr_dtl="select * from users where user_password!=''";
    $qst_usr_dtl=$db->query($usr_dtl);
    while($clct_usr_dtl=$qst_usr_dtl->fetch_assoc())
    {
        $uu_id=$clct_usr_dtl['user_id'];
        $uu_name=$clct_usr_dtl['user_name'];
        $uu_eml=$clct_usr_dtl['user_email'];
        $uu_mbl=$clct_usr_dtl['user_mobile'];
        $usr_wldt_amt=$clct_usr_dtl['wallet_amount'];
    ?>
    
    <option value="<?php echo $uu_id?>"><?php echo $uu_name?> (<?php echo $uu_eml ?>)--(<?php echo $uu_mbl ?>) (Wallet Amount-- <?php echo $usr_wldt_amt?>)</option>
    
    
    <?php 
    }
    ?>
    </select>
</div>

<div class="form-group col-md-12 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Add Bonus Amount*</label>
<input type="text" name="bns_amnt" class="form-control" placeholder="Enter Bonus Amount" style="font-size: 11px !important;font-weight: 600 !important;border: 1px solid grey!important;der-radius: 15px !important; */" required>
</div>

<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button>
</div>
</div>
</form>


<?php 
if(isset($_POST['submit']))
{

$emp_nem=$_POST['usr_nme'];
$bsn_amnt=$_POST['bns_amnt'];

echo $usr_dlt="select * from users where user_id='$emp_nem'";
$qst_usr_dlt=$db->query($usr_dlt);
$clct_usr_dlt=$qst_usr_dlt->fetch_assoc();

$usr_wlt_amt=$clct_usr_dlt['wallet_amount'];


$fnl_wlt_amt=$usr_wlt_amt+$bsn_amnt;



$ad_trsnctn="insert into transaction_history set 
user_id='$emp_nem',
date='$cr_dt_ymd',
credit_amount='$bsn_amnt',
description='Bonus Add By Admin'";
$qst_ad_trsnctn=$db->query($ad_trsnctn);
if($qst_ad_trsnctn)
{
    
    $upd_usr_blnc="update users set wallet_amount='$fnl_wlt_amt' where user_id='$emp_nem'";
    $qst_upd_usr_blnc=$db->query($upd_usr_blnc);
    if($qst_upd_usr_blnc)
{
    echo "<script>window.alert('Bonus Added Successfully');window.location='';</script>";
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
<?php
ob_flush();

?>