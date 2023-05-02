<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');
$crt_det_tme= date('Y-m-d h:i:s');
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
<div class="container-fluid" >
<!--<h2 class="mt-30 page-title" style="
    color: red;
    font-size: 30px;
    font-weight: 600;
">Add Bidders</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Add Bidders</li>
</ol>

<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
 



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Choose Liquidator</label>
<select name="lqdetr" class="form-control" required style="border:1px solid black !important;">
<option value="">-Choose Liquidator-</option>
<?php 
$clt_dtl="select * from add_liquidator";
$qst_clt_dtl=$db->query($clt_dtl);
while($clct_clt_dtl=$qst_clt_dtl->fetch_assoc())
{
    $lqdtr_id=$clct_clt_dtl['id'];
    $lqdtr_nem=$clct_clt_dtl['liquidator_name'];
    
    ?>
<option value="<?php echo $lqdtr_id;?>"><?php echo $lqdtr_nem;?></option>
    <?php
}



?>

</select>
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Enter name</label>
<input type="text" name="bdr_nem"   class="form-control" maxlength="30" placeholder="Enter name" required style="border:1px solid black !important;">
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Bidder email</label>
<input type="email" name="bdr_emnl"  class="form-control"  maxlength="50"  placeholder="Enter bidder email" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Bidder UID</label>
<input type="number" name="bdr_uid"  min='0' class="form-control"  maxlength="20" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Enter Bidder UID" required style="border:1px solid black !important;">
</div>





<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Bidder mobile</label>
<input type="number" name="bdr_mbl"   min='0'  class="form-control" pattern="\d{10}" maxlength="10" minlength='10' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  placeholder="Enter bidder mobile" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Bidder password</label>
<input type="password" name="bidr_pwd"  class="form-control" maxlength="20" placeholder="Enter bidder password" required style="border:1px solid black !important;">
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
<h5 style="font-weight:bold;"> Do you want to add bidder and send email notification ?</h5>
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

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Submit</button> <a href="view_bdrs.php" class="btn btn-warning">Back</a>
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
$lqdtr_iiid=$_POST['lqdetr'];
      
$slt_dplc="select * from newbidder_login where `uid`='$bdr_uiid'";
$qst_slt_dplc=$db->query($slt_dplc);
$bdr_cnt=mysqli_num_rows($qst_slt_dplc);  
if($bdr_cnt==0)
{



$sql="INSERT INTO `newbidder_login` set 
`bidder_add_by_liquiditor_id`='$lqdtr_iiid',
`Bidder_Name`='$bdr_nem',
`Bidder_Email`='$bdr_emml',
`Bidder_Password`='$bdr_pwd',
`bidder_mobile`='$bdr_mbl_nber',
`email_sent_status`='sent',
`uid`='$bdr_uiid',
`status`='deactive'";
    $result=mysqli_query($db,$sql);
    
    // print_r($sql);
    if($result)
    {
      include('bidder_mail.php');
       echo "<script>alert('Bidder added successfully.');
         window.location.href='';
       </script>";
      // echo "check";
      
     
     
    } else { 
      echo "<script>alert('Not inserted please try again.');
         window.location.href='';
       </script>";
      // echo "not check";
    }
}
else
{
    echo "<script>alert('This bidder UID is already registered please try again.');
    window.location.href='';
  </script>";
}
}


if(isset($_POST['sbt_without_email']))
{
  $bdr_nem =$_POST['bdr_nem'];
$bdr_emml =$_POST['bdr_emnl'];
$bdr_pwd = $_POST['bidr_pwd'];
$bdr_mbl_nber=$_POST['bdr_mbl'];
$bdr_uiid=$_POST['bdr_uid'];
$lqdtr_iiid=$_POST['lqdetr'];
      
$slt_dplc="select * from newbidder_login where `uid`='$bdr_uiid'";
$qst_slt_dplc=$db->query($slt_dplc);
$bdr_cnt=mysqli_num_rows($qst_slt_dplc);  
if($bdr_cnt==0)
{



$sql="INSERT INTO `newbidder_login` set 
`bidder_add_by_liquiditor_id`='$lqdtr_iiid',
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
    
       echo "<script>alert('Bidder added successfully.');
         window.location.href='';
       </script>";
      // echo "check";
      
     
     
    } else { 
      echo "<script>alert('Not inserted please try again.');
         window.location.href='';
       </script>";
      // echo "not check";
    }
}
else
{
    echo "<script>alert('This bidder UID is already registered please try again.');
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