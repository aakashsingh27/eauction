<?php
@ob_start();
//session_start();
require_once 'config/config.php';
date_default_timezone_set("Asia/Kolkata");
$cr_dt_ymd=date('Y-m-d');
 $det_tem=date('d-m-Y H:i:s');

$time_stamp=date('Y-m-d H:i:s');
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

$det_tme=date('Y-m-d H:i:s');
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
<li class="breadcrumb-item active" style="font-size: 18px;font-weight: bold;color: black !important;">Assign A Bidders</li>
</ol>

<div class="container-fluid">

<form method="POST" action="" enctype="multipart/form-data">
<div class="row">
 

<div class="form-group col-md-6 col-xs-6">
<label class="form-label" style="font-size:16px !important;">Choose Bidder</label>
<select name="bdr_id"  class="form-control"  required style="border:1px solid black !important;">
<option value="">Choose Bidder</option>

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
<label class="form-label" style="font-size:16px !important;">Company</label>
<select name="cmpny_id"  class="form-control" required style="border:1px solid black !important;">
<option value="">Choose Company</option>
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

$sql="INSERT INTO `assign_bidders_by_liquidator` set 
`bidder_id`='$bdr_iid',
`company_id`='$cempy_id',
`liquidator_id`='$a_idchk',
`date_time`='$det_tme'";
$result=mysqli_query($db,$sql);
    
    // print_r($sql);
    if($result)
    {
        $slt_bdr_dtl="select * from newbidder_login where id='$bdr_iid'";
        $qst_slt_bdr_dtl=$db->query($slt_bdr_dtl);
        
        $clct_slt_bdr_dtl=$qst_slt_bdr_dtl->fetch_assoc();
        
        $bdder_nem=$clct_slt_bdr_dtl['Bidder_Name'];
        
        $bdder_uid=$clct_slt_bdr_dtl['uid'];
        $bdder_pswd=$clct_slt_bdr_dtl['Bidder_Password'];
        
        
        
        $clt_cmpy_dtl="select * from company where id='$cempy_id'";
        $qst_clt_cmpy_dtl=$db->query($clt_cmpy_dtl);
        $clct_clt_cmpy_dtl=$qst_clt_cmpy_dtl->fetch_assoc();
        
        $cmp_nem=$clct_clt_cmpy_dtl['company_name'];
        
        
        
        $clt_bd_dtls="select * from create_sale where company_id='$cempy_id' and create_by_liquiditor_id='$a_idchk' and Start_Date_Auction > '$time_stamp' and End_Date_Auction > '$time_stamp'";
        $qst_clt_bd_dtls=$db->query($clt_bd_dtls);
        $clct_clt_bd_dtls=$qst_clt_bd_dtls->fetch_assoc();
        
        $strt_tem=$clct_clt_bd_dtls['Start_Date_Auction'];
        $end_tem=$clct_clt_bd_dtls['End_Date_Auction'];
        
      $updt_bdr_sts="update newbidder_login set status='active' where id='$bdr_iid'";
      $qst_updt_bdr_sts=$db->query($updt_bdr_sts);
      if($qst_updt_bdr_sts)
      {
          
        
          
          include('company_assigned_mail_approval.php');
          
          
echo "<script>alert('Bidder assigned added Successfully');
         window.location.href='';
       </script>";
      }
      
      
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