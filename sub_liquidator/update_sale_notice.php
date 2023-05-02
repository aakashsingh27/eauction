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

$iid=$_GET['id'];
$slt_sel_dtl="select * from create_sale where id='$iid' and create_by_liquiditor_id='$a_idchk'";
$qst_slt_sel_dtl=$db->query($slt_sel_dtl);
$clct_slt_sel_dtl=$qst_slt_sel_dtl->fetch_assoc();


$bfr_tem=$clct_slt_sel_dtl['buffer_time'];
$title=$clct_slt_sel_dtl['Title'];
$increamental=$clct_slt_sel_dtl['Incremental'];
$rsvrd_prce=$clct_slt_sel_dtl['Reserve_Price'];
$strt_det=$clct_slt_sel_dtl['Start_Date_Auction'];
$end_det=$clct_slt_sel_dtl['End_Date_Auction'];
$sl_ntc_id=$clct_slt_sel_dtl['id'];
$cmpny_id=$clct_slt_sel_dtl['company_id'];
$acttn_typ=$clct_slt_sel_dtl['auction_type'];
$eemp=$clct_slt_sel_dtl['emp'];

$cety_id=$clct_slt_sel_dtl['city_id'];


$stset_id=$clct_slt_sel_dtl['state_id'];
$prprty_type=$clct_slt_sel_dtl['property_type'];



$clt_prprty_dtl="select * from type_of_property where id='$prprty_type'";
$qst_clt_prprty_dtl=$db->query($clt_prprty_dtl);
$clct_clt_prprty_dtl=$qst_clt_prprty_dtl->fetch_assoc();

$prpty_type=$clct_clt_prprty_dtl['property_type'];



$clt_sttet_dtl="select * from state where id='$stset_id'";
$qst_clt_sttet_dtl=$db->query($clt_sttet_dtl);
$clct_clt_sttet_dtl=$qst_clt_sttet_dtl->fetch_assoc();

$stet_nem=$clct_clt_sttet_dtl['state_name'];



$clt_cty_dtl="select * from city where id='$cety_id'";
$qst_clt_cty_dtl=$db->query($clt_cty_dtl);
$clct_clt_cty_dtl=$qst_clt_cty_dtl->fetch_assoc();

$cety_name=$clct_clt_cty_dtl['city_name'];




$ppdf=$clct_slt_sel_dtl['Pdf'];


$clt_cmp_dtl="select * from company where id='$cmpny_id'";
$qst_clt_cmp_dtl=$db->query($clt_cmp_dtl);

$clt_cmp_dtl=$qst_clt_cmp_dtl->fetch_assoc();

$cemp_neem=$clt_cmp_dtl['company_name'];

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<h2 class="mt-30 page-title" style="
    color: red;
    font-size: 30px;
    font-weight: 600;
">Update Sale Notice</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active"></li>
</ol>
<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
 





<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Enter Title</label>
<input type="text" name="ttle"  class="form-control" value="<?php echo $title;?>"  placeholder="Enter Title" required>
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Type of Property</label>
<select name="prprty_typ"  class="form-control" required>

<option value="<?php echo $prprty_type;?>"><?php echo $prpty_type;?></option>
<?php 

$slt_typ_prprty_dtl="select * from type_of_property";
$qst_slt_typ_prprty_dtl=$db->query($slt_typ_prprty_dtl);
while($clct_slt_typ_prprty_dtl=$qst_slt_typ_prprty_dtl->fetch_assoc())
{

  $prty_ttyp=$clct_slt_typ_prprty_dtl['property_type'];
  $prty_iid=$clct_slt_typ_prprty_dtl['id'];


?>

<option value="<?php echo $prty_iid;?>"><?php echo $prty_ttyp;?></option>
<?php } ?>


</select>
</div>




<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Incremental Value</label>
<input type="number" name="inputValue"  min='0' value="<?php echo $increamental;?>" class="form-control"  placeholder="Enter Incremental value" required>
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Date Of Auction</label>
<input type="datetime-local" name="inputStartDate" value="<?php echo $strt_det;?>" class="form-control"  placeholder="Enter Liquitor password" required>
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Reserve Price</label>
<input type="number" name="inputPrice" min='0' value="<?php echo $rsvrd_prce;?>" class="form-control"  placeholder="Enter Reserve Price" required>
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Last Date Submission</label>
<input type="datetime-local" name="inputEndDate" value="<?php echo $end_det;?>"  class="form-control" required>
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">buffer time in minutes</label>
<input type="number" name="bffr_time" min='0' class="form-control" value="<?php echo $bfr_tem;?>" placeholder='Enter buffer time' required>
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Company name</label>
<select name="bffr_time"  class="form-control" required>

<option value="<?php echo $cmpny_id;?>"><?php echo $cemp_neem;?></option>
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
<label class="form-label" style="font-size:16px !important;">Auction type</label>
<select name="actn_ttype"  class="form-control" required>

<option value="<?php echo $acttn_typ;?>"><?php echo $acttn_typ;?></option>

<option value="forward">forward</option>
<option value="reverse">reverse</option>
</select>
</div>





<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">EMP</label>
<input type='number' value="<?php echo $eemp;?>" name="ernst_mny_dpst" placeholder='Enter Emp' min='0' class="form-control" required>


</div>




<div class="form-group col-md-6 col-xs-6">

<label class="form-label" style="font-size:16px !important;">PDF (  <a href='sale_notice_pdf/<?php echo $ppdf;?>'>View Pdf</a> )</label>
<input type='file' name="pdf" class="form-control">


</div>


<div class="form-group col-md-6 col-xs-6">

<label class="form-label" style="font-size:16px !important;">Choose state</label>
<select name="sttsset" class="form-control">


<option value="<?php echo $stset_id; ?>"><?php echo $stet_nem; ?></option>
<?php 
$slt_sttate_dtl="select * from state";
$qst_slt_sttate_dtl=$db->query($slt_sttate_dtl);
while($clct_slt_sttate_dtl=$qst_slt_sttate_dtl->fetch_assoc())
{
  $seete_nem=$clct_slt_sttate_dtl['state_name'];
  $seete_id=$clct_slt_sttate_dtl['id'];
  ?>
  <option value="<?php echo $seete_id;?>"><?php echo $seete_nem;?></option>
  <?php
}
?>
</select>


</div>

<div class="form-group col-md-6 col-xs-6">

<label class="form-label" style="font-size:16px !important;">Choose City</label>
<select name="cety" class="form-control">


<option value="<?php echo $cety_id; ?>"><?php echo $cety_name; ?></option>
<?php 
$slt_cet_dtl="select * from city";
$qst_slt_cet_dtl=$db->query($slt_cet_dtl);
while($clct_slt_cet_dtl=$qst_slt_cet_dtl->fetch_assoc())
{
  $ceety_nem=$clct_slt_cet_dtl['city_name'];
  $ceety_id=$clct_slt_cet_dtl['id'];
  ?>
  <option value="<?php echo $ceety_id;?>"><?php echo $ceety_nem;?></option>
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
   // collect value of input field
    // $Bidder_Id =$_POST['Bidder_Id'];
    
$prpty_idd=$_POST['prprty_typ'];
$Title =$_POST['ttle'];
$Incremental =$_POST['inputValue'];
$Reserve_Price = $_POST['inputPrice'];
$Start_Date_Auction = $_POST['inputStartDate'];
$End_Date_Auction = $_POST['inputEndDate'];
$bfr_tem=$_POST['bffr_time'];
$actn_ttyp=$_POST['actn_ttype'];
  
$ern_mny_dpst=$_POST['ernst_mny_dpst'];
    
$cet_id=$_POST['cety'];
$steeet_id=$_POST['sttsset'];


$targetfolder = "sale_notice_pdf/";
$file_name=$_FILES['pdf']['name'];
$targetfolder = $targetfolder . basename( $_FILES['pdf']['name']) ;
move_uploaded_file($_FILES['pdf']['tmp_name'], $targetfolder);
  
    
if($file_name=='')
{

$sql="update `create_sale` set 
`Title`='$Title',
`Incremental`='$Incremental',
`Reserve_Price`='$Reserve_Price',
`Start_Date_Auction`='$Start_Date_Auction',
`End_Date_Auction`='$End_Date_Auction',
`create_by_liquiditor_id`='$emp_id',
`auction_type`='$actn_ttyp',
`emp`='$ern_mny_dpst',
`property_type`='$prpty_idd',
`city_id`='$cet_id',
`state_id`='$steeet_id',
`buffer_time`='$bfr_tem' where id='$iid' and create_by_liquiditor_id='$a_idchk'";
    $result=mysqli_query($db,$sql);
}
else if($file_name!='')   
{
  $sql="update `create_sale` set 
`Title`='$Title',
`Incremental`='$Incremental',
`Reserve_Price`='$Reserve_Price',
`Start_Date_Auction`='$Start_Date_Auction',
`End_Date_Auction`='$End_Date_Auction',
`create_by_liquiditor_id`='$emp_id',
`auction_type`='$actn_ttyp',
`emp`='$ern_mny_dpst',
`city_id`='$cet_id',
`state_id`='$steeet_id',
`pdf`='$file_name',
`buffer_time`='$bfr_tem' where id='$iid' and create_by_liquiditor_id='$a_idchk'";
    $result=mysqli_query($db,$sql);
}
    // print_r($sql);
    if($result)
    {
      
       echo "<script>alert('sale Notic updated Successfully');
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