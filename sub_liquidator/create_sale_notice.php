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

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<!--<h2 class="mt-30 page-title" style="-->
<!--    color: red;-->
<!--    font-size: 30px;-->
<!--    font-weight: 600;-->
<!--">Create Sale Notice</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Create Sale Notice</li>
</ol>
<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
 
<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Enter Title</label>
<input type="text" name="ttle"  class="form-control"  placeholder="Enter Title" required style="border:1px solid black !important;">
</div>




<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Property Type</label>
<select name="prprpt_typ"  class="form-control" required style="border:1px solid black !important;">
<option value="">Choose property type</option>

<?php   

$slt_prprty_typ="select * from type_of_property";
$qst_slt_prprty_typ=$db->query($slt_prprty_typ);
while($clct_slt_prprty_typ=$qst_slt_prprty_typ->fetch_assoc())
{
$proprty_typ=$clct_slt_prprty_typ['property_type'];
$prprty_typ_id=$clct_slt_prprty_typ['id'];
?>
<option value="<?php echo $prprty_typ_id;?>"><?php echo $proprty_typ;?></option>
<?php } ?>
</select>
</div>




<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Incremental Value</label>
<input type="number" name="inputValue"  class="form-control"  placeholder="Enter Incremental value" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Date Of Auction</label>
<input type="datetime-local" name="inputStartDate"  class="form-control"  placeholder="Enter Liquitor password" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Reserve Price</label>
<input type="number" name="inputPrice"  min="0" class="form-control"  placeholder="Enter Reserve Price" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Last Date Submission</label>
<input type="datetime-local" name="inputEndDate"  class="form-control" required style="border:1px solid black !important;">
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Buffer Time In Minutes</label>
<input type="number" name="bffr_time"  class="form-control" required placeholder='Enter buffer time' required style="border:1px solid black !important;">
</div>





<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Choose Company</label>
<select name="cmp_id"  class="form-control" required style="border:1px solid black !important;">
<option value="">Choose Company</option>

<?php   

$slt_cmp_dtl="select * from assign_liquidator where liquidator_id='$a_idchk'";
$qst_slt_cmp_dtl=$db->query($slt_cmp_dtl);
while($clct_slt_cmp_dtl=$qst_slt_cmp_dtl->fetch_assoc())
{

  $cmpp_iud=$clct_slt_cmp_dtl['company_id'];

  $clt_cmp_dtl="select * from company where id='$cmpp_iud'";
  $qst_clt_cmp_dtl=$db->query($clt_cmp_dtl);
  $clct_clt_cmp_dtl=$qst_clt_cmp_dtl->fetch_assoc();

  $cmp_nem=$clct_clt_cmp_dtl['company_name'];
  $cmpid=$clct_clt_cmp_dtl['id'];


?>

<option value="<?php echo $cmpid;?>"><?php echo $cmp_nem;?></option>
<?php } ?>
</select>
</div>





<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Auction Type</label>
<select name="actn_type"  class="form-control" required style="border:1px solid black !important;">
<option value="">Choose Auction Type</option>


<option value="reverse">reverse</option>
<option value="forward">forward</option>

</select>
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">EMD (Earnest Money Deposit):	</label>
<input type='number' name="emp_amnt" placeholder='Enter EMP ' class="form-control" min='0' required style="border:1px solid black !important;">

</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">PDF :	</label>
<input type='file' name="pdf" class="form-control" accept=".pdf" required style="border:1px solid black !important;">

</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Choose State :	</label>
<select name="stet" class="form-control" required style="border:1px solid black !important;">
<option value="">Choose State</option>

<?php 
$clt_stet_dtl="select * from state";
$qst_clt_stet_dtl=$db->query($clt_stet_dtl);
while($clct_clt_stet_dtl=$qst_clt_stet_dtl->fetch_assoc())
{
  $stet_nem=$clct_clt_stet_dtl['state_name'];
  $sttet_id=$clct_clt_stet_dtl['id'];

  ?>
<option value="<?php echo $sttet_id?>"><?php echo $stet_nem;?></option>
  <?php
}


?>
</select>

</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Choose city :	</label>
<select name="city" class="form-control" required style="border:1px solid black !important;">
<option value="">Choose City</option>

<?php 
$clt_acty_dtl="select * from city";
$qst_clt_acty_dtl=$db->query($clt_acty_dtl);
while($clct_clt_acty_dtl=$qst_clt_acty_dtl->fetch_assoc())
{
  $cty_nem=$clct_clt_acty_dtl['city_name'];
  $cty_id=$clct_clt_acty_dtl['id'];

  ?>
<option value="<?php echo $cty_id?>"><?php echo $cty_nem;?></option>
  <?php
}


?>
</select>

</div>













<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button>
</div>
</div>
</form>

<?php 


  
  if(isset($_POST['submit']))
  {
 
$Title =$_POST['ttle'];
$Incremental =$_POST['inputValue'];
$Reserve_Price = $_POST['inputPrice'];
$Start_Date_Auction = $_POST['inputStartDate'];
$End_Date_Auction = $_POST['inputEndDate'];
$bfr_tem=$_POST['bffr_time'];
$ccmp_id=$_POST['cmp_id'];
$actn_type=$_POST['actn_type'];
$emp_amant=$_POST['emp_amnt'];

$cty_iid=$_POST['city'];

$prprty_ttyp=$_POST['prprpt_typ'];

$setet_iid=$_POST['stet'];
$targetfolder = "sale_notice_pdf/";
$file_name=$_FILES['pdf']['name'];
$targetfolder = $targetfolder . basename( $_FILES['pdf']['name']) ;
move_uploaded_file($_FILES['pdf']['tmp_name'], $targetfolder);
  
    
     $sql="INSERT INTO `create_sale` set 
    `Title`='$Title',
    `state_id`='$setet_iid',
    `Incremental`='$Incremental',
    `Reserve_Price`='$Reserve_Price',
    `property_type`='$prprty_ttyp',
      `Start_Date_Auction`='$Start_Date_Auction',
       `End_Date_Auction`='$End_Date_Auction',
       `create_by_liquiditor_id`='$emp_id',
       `company_id`='$ccmp_id',
       `auction_type`='$actn_type',
       `emp`='$emp_amant',
       `Pdf`='$file_name',
       `city_id`='$cty_iid',
       `buffer_time`='$bfr_tem'";
    $result=mysqli_query($db,$sql);
    
    // print_r($sql);
    if($result)
    {
      
       echo "<script>alert('Notic added Successfully');
         window.location.href='';
       </script>";
      // echo "check";
      
     
     
    } else { 
      echo "<script>alert(' Not inserted Please Try Again');
         window.location.href='';
       </script>";
      // echo "not check";
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