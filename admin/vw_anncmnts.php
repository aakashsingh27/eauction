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


$clt_dtl="select * from latest_announcement where id='1'";
$qst_clt_dtl=$db->query($clt_dtl);
$clct_clt_dtl=$qst_clt_dtl->fetch_assoc();

$anncment_cnt=$clct_clt_dtl['content'];

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid" >
<!--<h2 class="mt-30 page-title" style="
    color: red;
    font-size: 30px;
    font-weight: 600;
"></h2>-->
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Announcements</li>
</ol>

<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
 

<div class="form-group col-md-12 col-xs-12">
<label class="form-label" style="font-size:16px !important;">Announcements</label>
<textarea name="anncmnt" class="form-control" maxlength="200" placeholder='Add Announcement Content' required style="border:1px solid black !important;"><?php  echo $anncment_cnt;?></textarea>

</div>




<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button> <a href="index.php" class="btn btn-warning" >Back to dashboard</a>
</div>
</div>
</form>

<?php 


  
  if(isset($_POST['submit']))
  {

$cncnt =$_POST['anncmnt'];


$sql="update `latest_announcement` set 
`content`='$cncnt' where id='1'";
    $result=mysqli_query($db,$sql);
    
    
    if($result)
    {
      
       echo "<script>alert('Announcements updated Successfully');
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