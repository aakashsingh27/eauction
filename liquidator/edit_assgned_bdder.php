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


$det_tme=date('Y-m-d H:i:s');



$asgn_id=$_GET['id'];



$usr_lst="select * from assign_bidders_by_liquidator where liquidator_id='$a_idchk' and id='$asgn_id'";
$qst_usr_lst=$db->query($usr_lst);

$clct_usr_lst=$qst_usr_lst->fetch_assoc();
    $cmp_id=$clct_usr_lst['company_id'];
    $bdder_id=$clct_usr_lst['bidder_id'];
    $iiidd=$clct_usr_lst['id'];
    


$clt_bdr_dtl="select * from newbidder_login where id='$bdder_id'";
$qst_clt_bdr_dtl=$db->query($clt_bdr_dtl);
$clct_clt_bdr_dtl=$qst_clt_bdr_dtl->fetch_assoc();
$bdder_nem=$clct_clt_bdr_dtl['Bidder_Name'];
$bdr_uid=$clct_clt_bdr_dtl['uid'];
$bdrr_id=$clct_clt_bdr_dtl['id'];


    $clt_cmp_dtl="select * from company where id='$cmp_id'";
    $qst_clt_cmp_dtl=$db->query($clt_cmp_dtl);
$clct_clt_cmp_dtl=$qst_clt_cmp_dtl->fetch_assoc();
$cmp_nem=$clct_clt_cmp_dtl['company_name'];
$cemp_id=$clct_clt_cmp_dtl['id'];





?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include 'header.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid" >
<h2 class="mt-30 page-title" style="
    color: red;
    font-size: 30px;
    font-weight: 600;
">Assign a Bidders</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item active"></li>
</ol>

<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
 

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Choose Bidder</label>
<select name="bdr_id"  class="form-control"  required>
<option value="<?php echo $bdrr_id;?>"><?php echo $bdder_nem;?></option>

<?php 
$slt_bdr_dtl="select * from newbidder_login where bidder_add_by_liquiditor_id='$a_idchk'";
$qst_slt_bdr_dtl=$db->query($slt_bdr_dtl);
while($clct_slt_bdr_dtl=$qst_slt_bdr_dtl->fetch_assoc())
{
   
   $bder_nem=$clct_slt_bdr_dtl['Bidder_Name'];
   $bder_id=$clct_slt_bdr_dtl['id'];
   
   ?>
   <option value="<?php echo $bder_id;?>"><?php echo $bder_nem;?></option>

    <?php
}



?>


</select>
</div>



<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Asset ID</label>
<select name="cmpny_id"  class="form-control" required>
<option value="<?php echo $cemp_id;?>"><?php echo $cmp_nem;?></option>
<?php 
$slt_cmp_dtl="select * from assign_liquidator where liquidator_id='$a_idchk'";
$qst_slt_cmp_dtl=$db->query($slt_cmp_dtl);
while($clct_slt_cmp_dtl=$qst_slt_cmp_dtl->fetch_assoc())
{
    $cemp_id=$clct_slt_cmp_dtl['company_id'];


    $clt_dtl="select * from company where id='$cemp_id'";
    $qst_clt_dtl=$db->query($clt_dtl);
    $clct_clt_dtl=$qst_clt_dtl->fetch_assoc();

    $cemp_nem=$clct_clt_dtl['company_name'];
    $cmp_id=$clct_clt_dtl['id'];
    
    
    ?>
<option value="<?php echo $cmp_id;?>"><?php echo $cemp_nem;?></option>
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

$bdr_iid =$_POST['bdr_id'];
$cempy_id =$_POST['cmpny_id'];
      
$slt_dplc="select * from assign_bidders_by_liquidator where `bidder_id`='$bdr_iid' and `company_id`='$cempy_id' and `liquidator_id`='$a_idchk'";
$qst_slt_dplc=$db->query($slt_dplc);
$bdr_cnt=mysqli_num_rows($qst_slt_dplc);  
if($bdr_cnt==0)
{

$sql="update `assign_bidders_by_liquidator` set 
`bidder_id`='$bdr_iid',
`company_id`='$cempy_id' where `liquidator_id`='$a_idchk' and id='$asgn_id'";
$result=mysqli_query($db,$sql);
    
    // print_r($sql);
    if($result)
    {
      
       echo "<script>alert('Bidder assigned Updated Successfully');
         window.location.href='';
       </script>";
      // echo "check";
      
     
     
    } else { 
      echo "<script>alert('Not inserted Please Try Again');
         window.location.href='';
       </script>";
      // echo "not check";
    }
}
else
{
    echo "<script>alert('This bidder is already assigned to this company please try again');
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