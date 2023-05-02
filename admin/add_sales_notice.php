<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');

$crt_det_tem=date('Y-m-d h:i');

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<!--<h2 class="mt-30 page-title" style="
    color: red;
    font-size: 30px;
    font-weight: 600;
">Create Sale Notice</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;"> Create Sale Notice</li>
</ol>
<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
 
<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Choose Liquidator</label>
<select name="lqdtr" id='lqdtr_id' class="form-control" required style="border:1px solid black !important;">
<option value="">-Choose Liquidator-</option>
<?php 
$clt_lqdtr_dtl="select * from add_liquidator";
$qst_clt_lqdtr_dtl=$db->query($clt_lqdtr_dtl);
while($clct_clt_lqdtr_dtl=$qst_clt_lqdtr_dtl->fetch_assoc())
{
    
    $lqdtr_nem=$clct_clt_lqdtr_dtl['liquidator_name'];
    $lqdtr_id=$clct_clt_lqdtr_dtl['id'];
    ?>
<option value="<?php echo $lqdtr_id;?>"><?php echo $lqdtr_nem;?></option>
    <?php
}
?>
</select>
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Choose Asset ID</label>
<select name="cmp_id" id='cmnp_id' class="form-control" required style="border:1px solid black !important;">
<option value="">-Choose asset-</option>

</select>
</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Display company name</label>
<select id="dsp_cml_nmem" name="spr_cmpy_neme"  class="form-control"  required style="border:1px solid black !important;">
<option value="">Choose dipslay company name</option>
</select>
</div>






<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Property type </label>
<select name="prprty_type" id="prprty_typy"  class="form-control"   required style="border:1px solid black !important;">
<option value="">Choose property type</option>
<?php 
$clt_prt_typ="select * from type_of_property";
$qst_clt_prt_typ=$db->query($clt_prt_typ);
while($clct_clt_prt_typ=$qst_clt_prt_typ->fetch_assoc())
{
    $tpe_prt=$clct_clt_prt_typ['property_type'];
    $tpe_id=$clct_clt_prt_typ['id'];
    ?>
    <option value="<?php echo $tpe_id;?>"><?php echo $tpe_prt;?></option>
    <?php
}
?>

</select>
</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Enter Title </label>
<input type="text" name="ttle"  class="form-control"  maxlength="80" placeholder="Enter Title" required style="border:1px solid black !important;">
</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Incremental Value</label>
<input type="number" name="inputValue"  class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="5" placeholder="Enter Incremental value" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Date Of Auction</label>
<input type="datetime-local" name="inputStartDate" id="act_det" class="form-control" min="<?php echo $crt_det_tem;?>" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Reserve Price</label>
<input type="number" name="inputPrice"  min="0" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="8" placeholder="Enter Reserve Price" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Last Date Submission</label>
<input type="datetime-local" name="inputEndDate" id="last_id"  class="form-control" required style="border:1px solid black !important;">
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Buffer Time In Minutes</label>
<input type="number" name="bffr_time"  class="form-control" required placeholder='Enter Buffer Time' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" required style="border:1px solid black !important;">
</div>








<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Auction Type</label>
<select name="actn_type"  id="actnn_ttyp" class="form-control" required style="border:1px solid black !important;">
<option value="">-choose Auction type-</option>


<option value="reverse">reverse</option>
<option value="forward">forward</option>

</select>
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">EMD(Earnest Money Deposit):	</label>
<input type='number' name="emp_amnt" placeholder='Enter EMP ' class="form-control" min='0' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="5" required style="border:1px solid black !important;">

</div>





<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">PDF :	</label>
<input type='file' name="pdf" class="form-control"  required style="border:1px solid black !important;">

</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">PDF 2 :	</label>
<input type='file' name="pdf2" class="form-control"  style="border:1px solid black !important;">

</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">PDF 3 :	</label>
<input type='file' name="pdf3" class="form-control"  style="border:1px solid black !important;">

</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">PDF 4 :	</label>
<input type='file' name="pdf4" class="form-control"  style="border:1px solid black !important;">

</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">PDF 5 :	</label>
<input type='file' name="pdf5" class="form-control" style="border:1px solid black !important;">

</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Choose State :	</label>
<select name="stet" id="sttettet" class="form-control" required style="border:1px solid black !important;">
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

<button type='submit' name="submit" class='btn btn-primary'>Submit</button> <button type="button" class="btn btn-warning" onclick="window.history.back()">Back</button>
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
$ccity=$_POST['city'];
$setet=$_POST['stet'];
$emp_id=$_POST['lqdtr'];
$prty_typ=$_POST['prprty_type'];


$spr_cmpny_neme=$_POST['spr_cmpy_neme'];

//pdf1 start
$targetfolder = "../liquidator/sale_notice_pdf/";
$file_name=$_FILES['pdf']['name'];
$targetfolder = $targetfolder . basename( $_FILES['pdf']['name']) ;
move_uploaded_file($_FILES['pdf']['tmp_name'], $targetfolder);
  
//pdf 1 end


//pdf2 start
$targetfolder2 = "../liquidator/sale_notice_pdf/";
$file_name2=$_FILES['pdf2']['name'];
$targetfolder2 = $targetfolder2 . basename( $_FILES['pdf2']['name']) ;
move_uploaded_file($_FILES['pdf2']['tmp_name'], $targetfolder2);
  
//pdf 2 end



//pdf3 start
$targetfolder3 = "../liquidator/sale_notice_pdf/";
$file_name3=$_FILES['pdf3']['name'];
$targetfolder3 = $targetfolder3 . basename( $_FILES['pdf3']['name']) ;
move_uploaded_file($_FILES['pdf3']['tmp_name'], $targetfolder3);
  
//pdf 3 end

//pdf4 start
$targetfolder4 = "../liquidator/sale_notice_pdf/";
$file_name4=$_FILES['pdf4']['name'];
$targetfolder4 = $targetfolder4 . basename( $_FILES['pdf4']['name']) ;
move_uploaded_file($_FILES['pdf4']['tmp_name'], $targetfolder4);
  
//pdf 4 end

//pdf5 start
$targetfolder5 = "../liquidator/sale_notice_pdf/";
$file_name5=$_FILES['pdf5']['name'];
$targetfolder5 = $targetfolder5 . basename( $_FILES['pdf5']['name']) ;
move_uploaded_file($_FILES['pdf5']['tmp_name'], $targetfolder5);
  
//pdf 5 end
    
$sql="INSERT INTO `create_sale` set 
`Title`='$Title',
`Incremental`='$Incremental',
`Reserve_Price`='$Reserve_Price',
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
`city_id`='$ccity',
`property_type`='$prty_typ',
`state_id`='$setet',
`super_company_name`='$spr_cmpny_neme',
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
$(document).ready(function(){
$('#sttettet').change(function(){
var sttet_iid=$('#sttettet').val();
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
 $("#sttettet , #cttett ,#lqdtr_id ,#prprty_typy , #cmnp_id, #actnn_ttyp, #dsp_cml_nmem").select2();
});
</script>





<script>
$(document).ready(function(){
$('#lqdtr_id').change(function(){
var lqd_id=$('#lqdtr_id').val();


$.ajax({
url: "lqdtr_cmp_ajax.php",
type: "POST",
data    : {txt1:lqd_id},
cache: false,
success: function(data){
$('#cmnp_id').html(data);

}
});


$.ajax({
url: "lqdtr_dsp_cmp_ajax.php",
type: "POST",
data    : {txt1:lqd_id},
cache: false,
success: function(data){
$('#dsp_cml_nmem').html(data);

}
});






});
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