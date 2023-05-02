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



$sub_lqdtr_id=$_GET['id'];

$clt_sb_lqdtr="select * from sub_liquidator where id='$sub_lqdtr_id' and add_by_liquidator='$a_idchk'";
$qst_clt_sb_lqdtr=$db->query($clt_sb_lqdtr);
$clct_clt_sb_lqdtr=$qst_clt_sb_lqdtr->fetch_assoc();

$nem=$clct_clt_sb_lqdtr['name'];
$emnl=$clct_clt_sb_lqdtr['email'];
$mbel=$clct_clt_sb_lqdtr['mobile'];
$paswd=$clct_clt_sb_lqdtr['password'];



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
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Add Sub Liquidtor</li>
</ol>
<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
 



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Name</label>
<input type='text' name="nem" value="<?php echo $nem;?>" placeholder='Enter name' class="form-control" required style="border:1px solid black !important;">
</div>




<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Email</label>
<input type="email" name="emnl"  class="form-control" value="<?php echo $emnl;?>" placeholder="Enter Email" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Mobile</label>
<input type="number" name="mobile"  class="form-control" value='<?php echo $mbel;?>' placeholder="Enter Mobile Number" required style="border:1px solid black !important;">
</div>


<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Password</label>
<input type="text" name="password"  min="0" class="form-control" value='<?php echo $paswd;?>' placeholder="Enter Password" required style="border:1px solid black !important;">
</div>



<div class="form-group col-md-12">

<button type='submit' name="submit" class='btn btn-primary'>Submit</button>
</div>
</div>
</form>

<?php 


  
  if(isset($_POST['submit']))
  {
 
$name =$_POST['nem'];
$emsnl =$_POST['emnl'];
$mbel = $_POST['mobile'];
$psswds = $_POST['password'];


     $sql="update `sub_liquidator` set 
    `name`='$name',
    `email`='$emsnl',
    `mobile`='$mbel',
    `password`='$psswds' where `add_by_liquidator`='$a_idchk' and id='$sub_lqdtr_id'";
    $result=mysqli_query($db,$sql);
    
    // print_r($sql);
    if($result)
    {
      
       echo "<script>alert('Sub Liquidator added Successfully');
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