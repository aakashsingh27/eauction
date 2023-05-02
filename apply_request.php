<?php 
@ob_start();
include("admin/config/config.php");
date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
$crt_Det= date('Y-m-d');

if(isset($_SESSION['bddr_id']))
{
$lqdtr_id=$_SESSION['liquiditor_id'];
$bdr_iid=$_SESSION['bddr_id'];
}
else
{
  echo "<script>window.location='bidder_login.php';window.alert('Please login');</script>";
}

$actn_id=$_GET['company_id'];
$lqdtr_id=$_GET['liquidator_id'];
$sel_netc_id=$_GET['sel_ntec_id'];


$slt_netc_dtl="select * from create_sale where id='$sel_netc_id'";
$qst_slt_netc_dtl=$db->query($slt_netc_dtl);
$clct_slt_netc_dtl=$qst_slt_netc_dtl->fetch_assoc();

$sel_title=$clct_slt_netc_dtl['Title'];



  $slt_dtl="select * from existing_bidders_request where bidder_id='$bdr_iid' and company_id='$actn_id' and status='disapproved'";
$qst_slt_dtl=$db->query($slt_dtl);
$clct_slt_dtl=$qst_slt_dtl->fetch_assoc();

$dsapprv_rssn=$clct_slt_dtl['reason_for_disapprove'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <!--<h2>Modal Example</h2>-->

  <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sent Request This Bid</h4>
        </div>
          <form action='' method="POST" enctype='multipart/form-data'>
        <div class="modal-body">
          <p> Sent Request to This Bid</p>
          <?php
          if($dsapprv_rssn!=NULL)
          {
              ?>
              <p style="color:red;"><span style="font-weight:bold;">Disapproved Reason :- </span> <?php echo $dsapprv_rssn; ?></p>
              <?php
          }
          ?>
          <p><b>Auction Item Name</b> = <span style="color:blue;"><?php echo $sel_title;?></span></p>
          
           <div class="form-group col-md-6">
      <label for="email">Annual Income :</label>
      <input type="number" class="form-control" id="email" placeholder="Enter Annual Income" name="income" required>
    </div>
    <div class="form-group col-md-6">
      <label for="pwd">Pancard:</label>
      <input type="file" class="form-control" id="pwd"  name="pan_card" required>
    </div>
        </div>
        <div class="modal-footer" style="border-top: none;">
     
           
        <button type='submit' name='sbmt' class='btn btn-primary'> Send</button> <button type="button" class="btn btn-default" onclick="history.back()">Back</button>
     
       
       
    
       
       
        </div>
          </form>
      </div>
      
    </div>
  </div>
  
</div>


   <?php  
       if(isset($_POST['sbmt']))
       {
           
           $annl_incem=$_POST['income'];

$filename6 = $_FILES["pan_card"]["name"];
$tempname6 = $_FILES["pan_card"]["tmp_name"];    
$folder6= "liquidator/bid_request_pan_card_images/".$filename6;
move_uploaded_file($tempname6, $folder6);

    
    
    $clt_ddtl="select * from existing_bidders_request where bidder_id='$bdr_iid' and company_id='$actn_id' and status='requested'";  
    $qst_clt_ddtl=$db->query($clt_ddtl);
    $bddr_cccnt=mysqli_num_rows($qst_clt_ddtl);
    if($bddr_cccnt==1)
    {
        echo "<script>window.location='index.php';window.alert('Request is already sent please try again');</script>";
    }
    
    
    
    
    
    
    
    
    
    
    
    
     $slt_dtl="select * from existing_bidders_request where bidder_id='$bdr_iid' and company_id='$actn_id' and status='requested' or status='approved' or status='disapproved'";
    
           $qst_slt_dtl=$db->query($slt_dtl);
           $clt_dnt=mysqli_num_rows($qst_slt_dtl);
           if($clt_dnt==0)
           {
       $ad_request="insert into existing_bidders_request set
       bidder_id='$bdr_iid',
       company_id='$actn_id',
       date='$crt_Det',
       liquidator_id='$lqdtr_id',
       pan_card_image='$filename6',
       annual_income='$annl_incem',
       
       status='requested'";
       $qst_ad_request=$db->query($ad_request);
       
       if($qst_ad_request)
       {
           echo "<script>window.location='index.php';window.alert('Request sent successfully');</script>";
       }
           }
    /*   else
       {
           echo "<script>window.location='index.php';window.alert('This request is already sent please try again');</script>";
       }*/
       
       
       
       $slt_ddftl="select * from existing_bidders_request where bidder_id='$bdr_iid' and company_id='$actn_id' and  status='disapproved'";
  
           $qst_slt_dsdtl=$db->query($slt_ddftl);
           $clsdt_dnt=mysqli_num_rows($qst_slt_dsdtl);
           if($clsdt_dnt==1)
           {
       $ad_rsdequest="update existing_bidders_request set
       date='$crt_Det',
        pan_card_image='$filename6',
       annual_income='$annl_incem',
       
       status='requested' where bidder_id='$bdr_iid' and company_id='$actn_id'";
       $qst_ad_requcest=$db->query($ad_rsdequest);
       
       if($qst_ad_requcest)
       {
           echo "<script>window.location='index.php';window.alert('Request sent successfully');</script>";
       }
           }
    /*   else
       {
           echo "<script>window.location='index.php';window.alert('This request is already sent please try again');</script>";
       }*/
       
       
       
       
       
       
       
       }
       ?>
<script type="text/javascript">
    $(window).on('load', function() {
        $('#myModal').modal({
    backdrop: 'static',
    keyboard: false
});
        $('#myModal').modal('show');
       
    });

</script>
</body>
</html>
<?php 
ob_flush();
?>
