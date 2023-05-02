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

$pg_id=$_GET['id'];


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

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
">Header page Service </h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active"></li>
</ol>
<div class="container-fluid">
<?php 


$usr_lst="select * from header_pages where id='$pg_id'";
$qst_usr_lst=$db->query($usr_lst);

$clct_usr_lst=$qst_usr_lst->fetch_assoc();
$vdo_lnk=$clct_usr_lst['video_link'];
$immg=$clct_usr_lst['image'];
$hddr_ttl=$clct_usr_lst['title'];
$dscpttn=$clct_usr_lst['description'];
$hdr_bnr_img=$clct_usr_lst['banner_image'];

?>


<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
    <div class='col-md-12'>
        <br>
<center><img src="header_page_image/<?php echo $immg;?>" style="height:100px;width:100px;"></center> <br> 
    </div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Image*</label>
<input type="file" name="hddr_immg" class="form-control"  style="font-size: 10px !important;font-weight: 600 !important;border: 1px solid grey!important;der-radius: 15px !important; */" >
</div>

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Title*</label>
<input type="text" name="hddr_ttle" class="form-control" value="<?php echo $hddr_ttl;?>" style="font-size: 10px !important;font-weight: 600 !important;border: 1px solid grey!important;der-radius: 15px !important; */" >
</div>


<div class="form-group col-md-6 col-xs-12">
<label class="form-label" style="font-size:16px !important;">Video Link*</label>
<input type="text" name="vdo_lnk" class="form-control" value="<?php echo $vdo_lnk;?>" style="font-size: 10px !important;font-weight: 600 !important;border: 1px solid grey!important;der-radius: 15px !important; */" >
</div>


<div class="form-group col-md-6 col-xs-12">
<label class="form-label" style="font-size:16px !important;">Header banner Image*</label>
<img src='header_banner_image/<?php echo $hdr_bnr_img;?>' style='height:100px;width:100px;' data-toggle="modal" data-target="#exampleModal">
</div>


<div class="form-group col-md-12 col-xs-12 ">
<label class="form-label" style="font-size:16px !important;">Details*</label>
<textarea name="srv_dtl"  placeholder='Enter Description' class="form-control"  style="font-size: 10px !important;font-weight: 600 !important;border: 2px solid grey!important;border-radius: 15px !important;" >
    <?php echo $dscpttn?></textarea>
 
</div>

<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button>
</div>
</div>
</form>

<?php 
if(isset($_POST['submit']))
{



$filename6 = $_FILES["hddr_immg"]["name"];
$tempname6 = $_FILES["hddr_immg"]["tmp_name"];    
$folder6= "header_page_image/".$filename6;
move_uploaded_file($tempname6, $folder6);

$hdr_tstl=$_POST['hddr_ttle'];
$vdo_lnkkk=$_POST['vdo_lnk'];
$srv_desc=$_POST['srv_dtl'];


if($filename6!='')
{


echo $ad_prdt="update header_pages set
description='$srv_desc',
title='$hdr_tstl',
video_link='$vdo_lnkkk',
image='$filename6' where id='$pg_id'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('Content Updated Successfully');window.location='';</script>";

}
else
{
    echo "<script>window.alert('Error');window.location='';</script>";
}

}
else
{
$ad_prdt="update header_pages set
description='$srv_desc',
title='$hdr_tstl',
video_link='$vdo_lnkkk' where id='$pg_id'";

$qst_ad_prdt=$db->query($ad_prdt);

if($qst_ad_prdt)
{
echo "<script>window.alert('Content Updated Successfully');window.location='';</script>";

}
else
{
    echo "<script>window.alert('Error');window.location='';</script>";
}

}
}
?>


</div>
</div>
</main>









<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<center><img src='header_banner_image/<?php echo $hdr_bnr_img;?>' style='height:100px;width:100px;'></center><br>
<form action='' method='POST' enctype='multipart/form-data'>
    
    <input type='file' name='hdr_bnr_img' required> <button type='submit' name='sbmmmt_img' class='btn btn-danger'>Submit</button>
    
</form>

<?php 

if(isset($_POST['sbmmmt_img']))
{
$filename9 = $_FILES["hdr_bnr_img"]["name"];
$tempname9 = $_FILES["hdr_bnr_img"]["tmp_name"];    
$folder9= "header_banner_image/".$filename9;
move_uploaded_file($tempname9, $folder9);


$updt_hdr_img="update header_pages set banner_image='$filename9' where id='$pg_id'";
$qst_updt_hdr_img=$db->query($updt_hdr_img);
if($qst_updt_hdr_img)
{
    echo "<script>window.location='';window.alert('header banner image updated successfully');</script>";
}

}

?>


      </div>
      <div class="modal-footer">
       <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>













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