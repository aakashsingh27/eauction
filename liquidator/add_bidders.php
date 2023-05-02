<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');
$crt_det_tme=date('Y-m-d');

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

<div id="layoutSidenav_content">
<main>
<div class="container-fluid" >

<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;"> Add Bidders</li>
</ol>

<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
 

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Enter Name</label>
<input type="text" name="bdr_nem" maxlength='50'  class="form-control"  placeholder="Enter Name" required style="border:1px solid black !important;">
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Bidder Email</label>
<input type="email" name="bdr_emnl" maxlength='60'  class="form-control"  placeholder="Enter Email" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Bidder UID</label>
<input type="number" name="bdr_uid"  min='0' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength='20' class="form-control"  placeholder="Enter Bidder UID" required style="border:1px solid black !important;">
</div>





<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Bidder Mobile</label>
<input type="number" name="bdr_mbl"   min='0'  class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength='10' placeholder="Enter Bidder Mobile" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Bidder Password</label>
<input type="password" name="bidr_pwd"  class="form-control" maxlength='50' placeholder="Enter Bidder Password" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-12">
<center>
<button type='submit' name="submit" class='btn btn-primary'>Submit</button>
</center>
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
$bdr_uiid=$_POST['bdr_uid'];
      
$slt_dplc="select * from newbidder_login where `uid`='$bdr_uiid'";
$qst_slt_dplc=$db->query($slt_dplc);
$bdr_cnt=mysqli_num_rows($qst_slt_dplc);  
if($bdr_cnt==0)
{



$sql="INSERT INTO `newbidder_login` set 
`bidder_add_by_liquiditor_id`='$a_idchk',
`Bidder_Name`='$bdr_nem',
`Bidder_Email`='$bdr_emml',
`Bidder_Password`='$bdr_pwd',
`bidder_mobile`='$bdr_mbl_nber',
`uid`='$bdr_uiid',
`status`='deactive'";
    $result=mysqli_query($db,$sql);
    
    // print_r($sql);
    if($result)
    {
      
       echo "<script>alert('Bidder added Successfully');
         window.location.href='';
       </script>";
      // echo "check";
      include('bidder_mail.php');
     
     
    } else { 
      echo "<script>alert(' Not inserted Please Try Again');
         window.location.href='';
       </script>";
      // echo "not check";
    }
}
else
{
    echo "<script>alert('This bidder UID is already registered please try again');
    window.location.href='';
  </script>";
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