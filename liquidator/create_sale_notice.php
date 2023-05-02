<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');
$crt_det_tem =date('Y-m-d h:i');

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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?php
include 'header.php';
?>




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
<label class="form-label" style="font-size:16px !important;">Choose Asset id</label>
<select name="cmp_id"  class="form-control" required style="border:1px solid black !important;">
<option value="">-Choose Asset id-</option>

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
<label class="form-label" style="font-size:16px !important;">Company name</label>
<select name="spr_cmnpy_neme"  class="form-control"  required style="border:1px solid black !important;">
<option value="">Choose company name</option>
<?php 
$clt_cemp_dtl="select * from assign_display_company_liquidator where liquidator_id='$a_idchk'";
$qst_clt_cemp_dtl=$db->query($clt_cemp_dtl);
while($clct_clt_cemp_dtl=$qst_clt_cemp_dtl->fetch_assoc())
{
  $cmp_iid=$clct_clt_cemp_dtl['company_id'];

  $clt_comp_nem_dtl="select * from display_company where id='$cmp_iid'";
  $qst_clt_comp_nem_dtl=$db->query($clt_comp_nem_dtl);
  $clct_clt_comp_nem_dtl=$qst_clt_comp_nem_dtl->fetch_assoc();

  $cempo_neme=$clct_clt_comp_nem_dtl['company_name'];

  $cempo_id=$clct_clt_comp_nem_dtl['id'];
  ?>


<option value="<?php echo  $cempo_id;?>"><?php echo $cempo_neme;?></option>

  <?php
}

?>
</select>
</div>

 



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Enter Title</label>
<textarea name="ttle"  class="form-control" placeholder="Enter title" required style="border:1px solid black !important;"></textarea>
</div>




<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Property type</label>
<select name="prprpt_typ"  class="form-control" required style="border:1px solid black !important;">
<option value="">-Choose property type-</option>

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
<input type="number" name="inputValue"  class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength='15' placeholder="Enter Incremental value" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Date Of Auction</label>
<input type="datetime-local" id="act_det" name="inputStartDate"  class="form-control"  min="<?php echo $crt_det_tem;?>" placeholder="Enter Liquitor password" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Reserve Price</label>
<input type="number" name="inputPrice"  min="0" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength='15' placeholder="Enter Reserve Price" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Last Date Submission</label>
<input type="datetime-local" name="inputEndDate"  id="last_id"  class="form-control" required style="border:1px solid black !important;">
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Buffer Time In Minutes</label>
<input type="number" name="bffr_time"  class="form-control" required placeholder='Enter Buffer Time in Minutes' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength='4'  required style="border:1px solid black !important;">
</div>











<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Auction Type</label>
<select name="actn_type"  class="form-control" required style="border:1px solid black !important;">
<option value="">-Choose auction type-</option>


<option value="reverse">reverse</option>
<option value="forward">forward</option>

</select>
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">EMD (Earnest Money Deposit):	</label>
<input type='number' name="emp_amnt" placeholder='Enter EMD ' class="form-control" min='0' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength='6' required style="border:1px solid black !important;">

</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Document 1 :	</label>
<input type='file' name="pdf" class="form-control" required style="border:1px solid black !important;" required>

</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Document 2 :	</label>
<input type='file' name="pdf2" class="form-control"  style="border:1px solid black !important;">

</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Document 3 :	</label>
<input type='file' name="pdf3" class="form-control"  style="border:1px solid black !important;">

</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Document 4 :	</label>
<input type='file' name="pdf4" class="form-control"  style="border:1px solid black !important;">

</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Document 5:	</label>
<input type='file' name="pdf5" class="form-control"  style="border:1px solid black !important;">

</div>




<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Choose State :	</label>
<select name="stet" id="sttet" class="form-control" required style="border:1px solid black !important;">
<option value="">-Choose state-</option>

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
<select name="city" id="cttett" class="form-control" required style="border:1px solid black !important;">
<option value="">-Choose City-</option>

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

$sepr_cmpy_neme=$_POST['spr_cmnpy_neme'];

$setet_iid=$_POST['stet'];
$targetfolder = "sale_notice_pdf/";
$file_name=$_FILES['pdf']['name'];
$targetfolder = $targetfolder . basename( $_FILES['pdf']['name']) ;
move_uploaded_file($_FILES['pdf']['tmp_name'], $targetfolder);
  
    


//pdf2 start
$targetfolder2 = "sale_notice_pdf/";
$file_name2=$_FILES['pdf2']['name'];
$targetfolder2 = $targetfolder2 . basename( $_FILES['pdf2']['name']) ;
move_uploaded_file($_FILES['pdf2']['tmp_name'], $targetfolder2);
  
//pdf 2 end



//pdf3 start
$targetfolder3 = "sale_notice_pdf/";
$file_name3=$_FILES['pdf3']['name'];
$targetfolder3 = $targetfolder3 . basename( $_FILES['pdf3']['name']) ;
move_uploaded_file($_FILES['pdf3']['tmp_name'], $targetfolder3);
  
//pdf 3 end

//pdf4 start
$targetfolder4 = "sale_notice_pdf/";
$file_name4=$_FILES['pdf4']['name'];
$targetfolder4 = $targetfolder4 . basename( $_FILES['pdf4']['name']) ;
move_uploaded_file($_FILES['pdf4']['tmp_name'], $targetfolder4);
  
//pdf 4 end

//pdf5 start
$targetfolder5 = "sale_notice_pdf/";
$file_name5=$_FILES['pdf5']['name'];
$targetfolder5 = $targetfolder5 . basename( $_FILES['pdf5']['name']) ;
move_uploaded_file($_FILES['pdf5']['tmp_name'], $targetfolder5);
  
//pdf 5 end
    


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
       `Pdf2`='$file_name2',
       `Pdf3`='$file_name3',
       `Pdf4`='$file_name4',
       `Pdf5`='$file_name5',
       `city_id`='$cty_iid',
       `super_company_name`='$sepr_cmpy_neme',
       `buffer_time`='$bfr_tem'";
    $result=mysqli_query($db,$sql);
    
    // print_r($sql);
    if($result)
    {
      
       echo "<script>alert('Sales notice added successfully');
         window.location.href='';
       </script>";
      // echo "check";
      
     
     
    } else { 
      echo "<script>alert('Not inserted please try again');
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
$(document).ready(function(){
$('#sttet').change(function(){
  
var sttet_iid=$('#sttet').val();
$.ajax({
url: "city_ajax.php",
type: "POST",
data    : {txt1:sttet_iid},
cache: false,
success: function(data){
$('#cttett').html(data);


}
});
});
});
</script>
<script>
$(document).ready(function() { 
 $("#sttet,#cttett").select2();
 
 
 
 
 
 
 
 
});



$(document).ready(function(){
$('#act_det').change(function(){
var act_strt_det=$('#act_det').val();

$('#last_id').attr("min",act_strt_det);

});
});


</script>



<?php
ob_flush();

?>