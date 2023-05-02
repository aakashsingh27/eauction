<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');

$crt_det_tem=date('Y-m-d h:i:s');

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
$slt_sel_dtl="select * from create_sale where id='$iid'";
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


$prpt_typ=$clct_slt_sel_dtl['property_type'];
$sete_iid=$clct_slt_sel_dtl['state_id'];
$ctt_id=$clct_slt_sel_dtl['city_id'];


$lqdtr_idd=$clct_slt_sel_dtl['create_by_liquiditor_id'];

$clt_lqdtr_id="select * from add_liquidator where id='$lqdtr_idd'";
$qst_clt_lqdtr_id=$db->query($clt_lqdtr_id);
$clct_clt_lqdtr_id=$qst_clt_lqdtr_id->fetch_assoc();


$lqdter_neme=$clct_clt_lqdtr_id['liquidator_name'];



$clt_prtyy_dtl="select * from type_of_property where id='$prpt_typ'";
$qst_clt_prtyy_dtl=$db->query($clt_prtyy_dtl);

$clt_clt_prtyy_dtl=$qst_clt_prtyy_dtl->fetch_assoc();

$prty_nee=$clt_clt_prtyy_dtl['property_type'];




$clt_sssste_dtl_dtl="select * from state where id='$sete_iid'";
$qst_clt_sssste_dtl_dtl=$db->query($clt_sssste_dtl_dtl);

$clt_clt_sssste_dtl_dtl=$qst_clt_sssste_dtl_dtl->fetch_assoc();

$stete_nee=$clt_clt_sssste_dtl_dtl['state_name'];






$clt_city_dtl_dtl="select * from city where id='$ctt_id'";
$qst_clt_cirty_dtl_dtl=$db->query($clt_city_dtl_dtl);

$clt_clt_city_dtl_dtl=$qst_clt_cirty_dtl_dtl->fetch_assoc();

$city_nee=$clt_clt_city_dtl_dtl['city_name'];






$spr_cmmmp_neme=$clct_slt_sel_dtl['super_company_name'];

$dsp_cmp_neme_dtl="select * from display_company where id='$spr_cmmmp_neme'";
$qst_dsp_cmp_neme_dtl=$db->query($dsp_cmp_neme_dtl);
$clct_dsp_cmp_neme_dtl=$qst_dsp_cmp_neme_dtl->fetch_assoc();

$cemm_dsp_neme=$clct_dsp_cmp_neme_dtl['company_name'];



$ppdf=$clct_slt_sel_dtl['Pdf'];

$ppdf2=$clct_slt_sel_dtl['pdf2'];
$ppdf3=$clct_slt_sel_dtl['pdf3'];
$ppdf4=$clct_slt_sel_dtl['pdf4'];
$ppdf5=$clct_slt_sel_dtl['pdf5'];


$clt_cmp_dtl="select * from company where id='$cmpny_id'";
$qst_clt_cmp_dtl=$db->query($clt_cmp_dtl);

$clt_cmp_dtl=$qst_clt_cmp_dtl->fetch_assoc();

$cemp_neem=$clt_cmp_dtl['company_name'];

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
">Update Sale Notice</h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Update Sale Notice</li>
</ol>
<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
 

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Choose Liquidator</label>
<select name="lqdtr" id='lqdtr_id' class="form-control" required style="border:1px solid black !important;">
<option value="<?php echo $lqdtr_idd;?>"><?php echo $lqdter_neme;?></option>
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
<label class="form-label" style="font-size:16px !important;">Asset ID</label>
<select name="asst_iid" id="cmnp_id" class="form-control" required style="border:1px solid black !important;">

<option value="<?php echo $cmpny_id;?>"><?php echo $cemp_neem;?></option>



</select>
</div>  



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Display company name</label>
<select name="spr_cmp_neme" id="dsp_cml_nmem" class="form-control" required style="border:1px solid black !important;">
<option value="<?php echo $spr_cmmmp_neme;?>"> <?php echo $cemm_dsp_neme;?></option>



</select>
</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Enter Title</label>
<input type="text" name="ttle"  class="form-control" value="<?php echo $title;?>"   maxlength="30" placeholder="Enter asset name" required style="border:1px solid black !important;">
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Incremental Value</label>
<input type="number" name="inputValue"  min='0' value="<?php echo $increamental;?>" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" placeholder="Enter Incremental value" required style="border:1px solid black !important;"> 
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Date Of Auction</label>
<input type="datetime-local" name="inputStartDate" id="act_det" value="<?php echo $strt_det;?>" class="form-control"  placeholder="Enter Liquitor password" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Reserve Price</label>
<input type="number" name="inputPrice" min='0' value="<?php echo $rsvrd_prce;?>" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" placeholder="Enter Reserve Price" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Last Date Submission</label>
<input type="datetime-local" name="inputEndDate" value="<?php echo $end_det;?>"  class="form-control" required style="border:1px solid black !important;">
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">buffer time in minutes</label>
<input type="number" name="bffr_time" min='0' class="form-control" value="<?php echo $bfr_tem;?>" placeholder='Enter buffer time' required style="border:1px solid black !important;"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2">
</div>





<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Property type </label>
<select name="prprty_type" id="prprty_typy"  class="form-control"   required style="border:1px solid black !important;">
<option value="<?php echo $prpt_typ;?>"><?php echo $prty_nee;?></option>
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
<label class="form-label" style="font-size:16px !important;">Auction type</label>
<select name="actn_ttype"  class="form-control" required style="border:1px solid black !important;">

<option value="<?php echo $acttn_typ;?>"><?php echo $acttn_typ;?></option>

<option value="forward">forward</option>
<option value="reverse">reverse</option>
</select>
</div>





<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">EMD</label>
<input type='number' value="<?php echo $eemp;?>" name="ernst_mny_dpst" placeholder='Enter Emd' min='0' class="form-control" required style="border:1px solid black !important;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="8">


</div>




<div class="form-group col-md-6 col-xs-6">

<label class="form-label" style="font-size:16px !important;">PDF (  <a href='../liquidator/sale_notice_pdf/<?php echo $ppdf;?>'target="#blank" <?php if($ppdf==''){?> style="pointer-events: none" <?php } ?>>View Pdf</a> ) <span style="font-size:12px; color:red;">Click below image to update document</span></label><br>
<a href="#" data-toggle="modal" data-target="#myModal"><img src="../img/docment_img.webp" style="width:40px;height:40px;"></a>


</div>


<div class="form-group col-md-6 col-xs-6">

<label class="form-label" style="font-size:16px !important;">PDF2 (  <a href='../liquidator/sale_notice_pdf/<?php echo $ppdf2;?>' target="#blank" <?php if($ppdf2==''){?> style="pointer-events: none" <?php } ?>>View Pdf</a> ) <span style="font-size:12px; color:red;">Click below image to update document</span></label><br>
<!-- <img src="../img/docment_img.webp" style="width:40px;height:40px;"> -->
<a href="#" data-toggle="modal" data-target="#myModal2"><img src="../img/docment_img.webp" style="width:40px;height:40px;"></a>

</div>



<div class="form-group col-md-6 col-xs-6">

<label class="form-label" style="font-size:16px !important;">PDF3 (  <a href='../liquidator/sale_notice_pdf/<?php echo $ppdf3;?>' target="#blank" <?php if($ppdf3==''){?> style="pointer-events: none" <?php } ?>>View Pdf</a> ) <span style="font-size:12px; color:red;">Click below image to update document</span></label><br>
<a href="#" data-toggle="modal" data-target="#myModal3"><img src="../img/docment_img.webp" style="width:40px;height:40px;"></a>

</div>


<div class="form-group col-md-6 col-xs-6">

<label class="form-label" style="font-size:16px !important;">PDF4 (  <a href='../liquidator/sale_notice_pdf/<?php echo $ppdf4;?>' target="#blank" <?php if($ppdf4==''){?> style="pointer-events: none" <?php } ?>>View Pdf</a> ) <span style="font-size:12px; color:red;">Click below image to update document</span></label><br>
<a href="#" data-toggle="modal" data-target="#myModal4"><img src="../img/docment_img.webp" style="width:40px;height:40px;"></a>


</div>

<div class="form-group col-md-6 col-xs-6">

<label class="form-label" style="font-size:16px !important;">PDF5 (  <a href='../liquidator/sale_notice_pdf/<?php echo $ppdf5;?>' target="#blank" <?php if($ppdf5==''){?> style="pointer-events: none" <?php } ?>>View Pdf</a> ) <span style="font-size:12px; color:red;">Click below image to update document</span></label><br>
<a href="#" data-toggle="modal" data-target="#myModal5"><img src="../img/docment_img.webp" style="width:40px;height:40px;"></a>



</div>




<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Choose State :	</label>
<select name="stet" id="sttettet" class="form-control" required style="border:1px solid black !important;">
<option value="<?php echo $sete_iid;?>"><?php echo $stete_nee;?></option>

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
<select name="city" id="ctettty" class="form-control" required style="border:1px solid black !important;">
<option value="<?php echo $ctt_id;?>"><?php echo $city_nee;?></option>

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
   // collect value of input field
    // $Bidder_Id =$_POST['Bidder_Id'];
$Title =$_POST['ttle'];
$Incremental =$_POST['inputValue'];
$Reserve_Price = $_POST['inputPrice'];
$Start_Date_Auction = $_POST['inputStartDate'];
$End_Date_Auction = $_POST['inputEndDate'];
$bfr_tem=$_POST['bffr_time'];
$actn_ttyp=$_POST['actn_ttype'];
  
$ern_mny_dpst=$_POST['ernst_mny_dpst'];
    
$sp_cmp_neme=$_POST['spr_cmp_neme'];

$centy=$_POST['city'];
$sette=$_POST['stet'];
$prpt_tyyp=$_POST['prprty_type'];
$asst_iid=$_POST['asst_iid'];
$lqdtr_id=$_POST['lqdtr'];


$targetfolder2 = "../liquidator/sale_notice_pdf/";
$file_name2=$_FILES['pdf2']['name'];
$targetfolder2 = $targetfolder2 . basename( $_FILES['pdf2']['name']) ;
move_uploaded_file($_FILES['pdf2']['tmp_name'], $targetfolder2);



$targetfolder3 = "../liquidator/sale_notice_pdf/";
$file_name3=$_FILES['pdf3']['name'];
$targetfolder3 = $targetfolder3 . basename( $_FILES['pdf3']['name']) ;
move_uploaded_file($_FILES['pdf3']['tmp_name'], $targetfolder3);



$targetfolder4 = "../liquidator/sale_notice_pdf/";
$file_name4=$_FILES['pdf4']['name'];
$targetfolder4 = $targetfolder4 . basename( $_FILES['pdf4']['name']) ;
move_uploaded_file($_FILES['pdf4']['tmp_name'], $targetfolder4);


$targetfolder5 = "../liquidator/sale_notice_pdf/";
$file_name5=$_FILES['pdf5']['name'];
$targetfolder5 = $targetfolder5 . basename( $_FILES['pdf5']['name']) ;
move_uploaded_file($_FILES['pdf5']['tmp_name'], $targetfolder5);
  
    

$sql="update `create_sale` set 
`Title`='$Title',
`Incremental`='$Incremental',
`Reserve_Price`='$Reserve_Price',
`Start_Date_Auction`='$Start_Date_Auction',
`End_Date_Auction`='$End_Date_Auction',
`auction_type`='$actn_ttyp',
`emp`='$ern_mny_dpst',



`city_id`='$centy',
`state_id`='$sette',
`property_type`='$prpt_tyyp',

`company_id`='$asst_iid',
`create_by_liquiditor_id`='$lqdtr_id',
`super_company_name`='$sp_cmp_neme',
`buffer_time`='$bfr_tem' where id='$iid'";
    $result=mysqli_query($db,$sql);


    // print_r($sql);
    if($result)
    {
      
       echo "<script>alert('Sale Notice Updated Successfully');
         window.location.href='view_sales_notice.php';
       </script>";
   
      
     
     
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

<!--------Modal start------->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">PDF 1</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <form action="" method="POST" enctype='multipart/form-data'>

<input type="file" name="pdf" class="form-control" required><br>

<button type='submit' name="sbt_pdf" class='btn btn-primary'>Update</button>

         </form>
         <?php
         
         if(isset($_POST['sbt_pdf']))
         {


          $targetfolder = "../liquidator/sale_notice_pdf/";
          $file_name=$_FILES['pdf']['name'];
          $targetfolder = $targetfolder . basename( $_FILES['pdf']['name']) ;
          move_uploaded_file($_FILES['pdf']['tmp_name'], $targetfolder);
          
          
          $upd_dpdf1="update create_sale set `Pdf`='$file_name' where id='$iid'";
          $qst_upd_dpdf1=$db->query($upd_dpdf1);
          if($qst_upd_dpdf1)
          {
            echo "<script>window.alert('Pdf 1 uploaded successfully'); window.location='';</script>";
          }
          
         }
         
         
         ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<!--------Modal End------------->




<!--------Modal start------->

<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">PDF 2</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <form action="" method="POST" enctype='multipart/form-data'>

<input type="file" name="pdf2" class="form-control" required><br>

<button type='submit' name="sbt_pdf2" class='btn btn-primary'>Update</button>

         </form>
         <?php
         
         if(isset($_POST['sbt_pdf2']))
         {


          $targetfolder2 = "../liquidator/sale_notice_pdf/";
          $file_name2=$_FILES['pdf2']['name'];
          $targetfolder2 = $targetfolder2 . basename( $_FILES['pdf2']['name']) ;
          move_uploaded_file($_FILES['pdf2']['tmp_name'], $targetfolder2);
          
          
          $upd_dpdf2="update create_sale set `pdf2`='$file_name2' where id='$iid'";
          $qst_upd_dpdf2=$db->query($upd_dpdf2);
          if($qst_upd_dpdf2)
          {
            echo "<script>window.alert('Pdf 2 uploaded successfully'); window.location='';</script>";
          }
          
         }
         
         
         ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<!--------Modal End------------->


<!--------Modal start------->

<div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">PDF 3</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <form action="" method="POST" enctype='multipart/form-data'>

<input type="file" name="pdf3" class="form-control" required><br>

<button type='submit' name="sbt_pdf3" class='btn btn-primary'>Update</button>

         </form>
         <?php
         
         if(isset($_POST['sbt_pdf3']))
         {


          $targetfolder3 = "../liquidator/sale_notice_pdf/";
          $file_name3=$_FILES['pdf3']['name'];
          $targetfolder3 = $targetfolder3 . basename( $_FILES['pdf3']['name']) ;
          move_uploaded_file($_FILES['pdf3']['tmp_name'], $targetfolder3);
          
          
          $upd_dpdf3="update create_sale set `pdf3`='$file_name3' where id='$iid'";
          $qst_upd_dpdf3=$db->query($upd_dpdf3);
          if($qst_upd_dpdf3)
          {
            echo "<script>window.alert('Pdf 3 uploaded successfully'); window.location='';</script>";
          }
          
         }
         
         
         ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<!--------Modal End------------->

<!--------Modal start------->

<div class="modal fade" id="myModal4" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">PDF 4</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <form action="" method="POST" enctype='multipart/form-data'>

<input type="file" name="pdf4" class="form-control" required><br>

<button type='submit' name="sbt_pdf4" class='btn btn-primary'>Update</button>

         </form>
         <?php
         
         if(isset($_POST['sbt_pdf4']))
         {


          $targetfolder4 = "../liquidator/sale_notice_pdf/";
          $file_name4=$_FILES['pdf4']['name'];
          $targetfolder4 = $targetfolder4 . basename( $_FILES['pdf4']['name']) ;
          move_uploaded_file($_FILES['pdf4']['tmp_name'], $targetfolder4);
          
          
          $upd_dpdf4="update create_sale set `pdf4`='$file_name4' where id='$iid'";
          $qst_upd_dpdf4=$db->query($upd_dpdf4);
          if($qst_upd_dpdf4)
          {
            echo "<script>window.alert('Pdf 4 uploaded successfully'); window.location='';</script>";
          }
          
         }
         
         
         ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<!--------Modal End------------->




<!--------Modal start------->

<div class="modal fade" id="myModal5" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">PDF 5</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <form action="" method="POST" enctype='multipart/form-data'>

<input type="file" name="pdf5" class="form-control" required><br>

<button type='submit' name="sbt_pdf5" class='btn btn-primary'>Update</button>

         </form>
         <?php
         
         if(isset($_POST['sbt_pdf5']))
         {


          $targetfolder5 = "../liquidator/sale_notice_pdf/";
          $file_name5=$_FILES['pdf5']['name'];
          $targetfolder5 = $targetfolder5 . basename( $_FILES['pdf5']['name']) ;
          move_uploaded_file($_FILES['pdf5']['tmp_name'], $targetfolder5);
          
          
          $upd_dpdf5="update create_sale set `pdf5`='$file_name5' where id='$iid'";
          $qst_upd_dpdf5=$db->query($upd_dpdf5);
          if($qst_upd_dpdf5)
          {
            echo "<script>window.alert('Pdf 5 uploaded successfully'); window.location='';</script>";
          }
          
         }
         
         
         ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<!--------Modal End------------->



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
$('#ctettty').html(data);


}
});
});
});
</script>



<script>
$(document).ready(function() { 
 $("#sttettet , #ctettty ,#lqdtr_id ,#prprty_typy , #cmnp_id, #actnn_ttyp").select2();
});
</script>


<script>
$(document).ready(function() { 
 $("#ddsd").select2();
});
</script>

<script>


$(document).ready(function(){
$('#act_det').change(function(){
var act_strt_det=$('#act_det').val();

$('#last_id').attr("min",act_strt_det);

});
});


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

</script>


<?php
ob_flush();

?>